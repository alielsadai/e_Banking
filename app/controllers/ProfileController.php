<?php
    class ProfileController extends Controller{
       public function index(){
           $this->set('seo_title', 'Profile');
           $userId = Session::get('user_id');
           $userData = UserViewModel::getById($userId);
           $this->set('user_data', $userData);
           
           $accountData = AccountViewModel::getByUserId($userId);
           $this->set('account_data', $accountData);
       }
    }
