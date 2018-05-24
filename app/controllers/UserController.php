<?php
    class UserController extends Controller{
        public function login(){
            $this->set('seo_title', 'Login');
            if (isset($_POST['submit'])) {
                $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                
                $passwordHash = hash('sha512', $password.Configuration::PASSWORD_SALT);
                $user = UserModel::getByEmailAndPassword($email, $passwordHash);
                
                if (!$user ) {
                    $this->set('error_message', 'Incorrect login, try again!');
                    return;
                } 
                if ($user->active == "False"){
                    $this->set('error_message', 'This account is not activated, contact us for more details!');
                    return;
                } 
                Session::set('user_id', $user->user_id);
                Session::set('first_name', $user->first_name);
                Session::set('last_name', $user->last_name);
                Session::set('user_type', $user->user_type);
                Session::set('user_logged_in', true);
                LoginModel::add($user->user_id);
                Misc::redirect('home');
                //header('Location:  home');
            }
        }
        
        public function logout(){
            Session::end();
            header('Location: home');
        }
    }
