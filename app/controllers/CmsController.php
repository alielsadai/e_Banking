<?php
    class CmsController extends Controller{
        public function index(){
            $this->set('seo_title', 'CMS');
            
            $users = UserModel::getAll();
            $this->set('users', $users);
        }
        
        public function addTemplate() {
            
        }
        
        public function add() {
            $this->set('seo_title', 'Add New user');
            
            if(isset($_POST['submit'])){              
                $firstName            = filter_input(INPUT_POST, 'first_name',  FILTER_SANITIZE_STRING);
                $lastName             = filter_input(INPUT_POST, 'last_name',  FILTER_SANITIZE_STRING);
                $email                = filter_input(INPUT_POST, 'email',  FILTER_SANITIZE_STRING);
                $password             = filter_input(INPUT_POST, 'password',  FILTER_SANITIZE_STRING);
                $userType             = filter_input(INPUT_POST, 'user_type',  FILTER_SANITIZE_STRING);
                $gender               = filter_input(INPUT_POST, 'gender',  FILTER_SANITIZE_STRING);
                $status               = filter_input(INPUT_POST, 'status',  FILTER_SANITIZE_STRING);
                $mobileNo             = filter_input(INPUT_POST, 'mobile_no',  FILTER_SANITIZE_STRING);
                $address              = filter_input(INPUT_POST, 'address',  FILTER_SANITIZE_STRING);
                $residenceCountryName = filter_input(INPUT_POST, 'residence_country',  FILTER_SANITIZE_STRING);
                $residenceCityName    = filter_input(INPUT_POST, 'residence_city',  FILTER_SANITIZE_STRING);
                $dateOfBirth          = filter_input(INPUT_POST, 'date_of_birth',  FILTER_SANITIZE_STRING);
                $birthCityName        = filter_input(INPUT_POST, 'birth_city',  FILTER_SANITIZE_STRING);
                $birthCountryName     = filter_input(INPUT_POST, 'birth_country',  FILTER_SANITIZE_STRING);
                $accountType          = filter_input(INPUT_POST, 'account_type',  FILTER_SANITIZE_STRING);
                $encrypt_password     = (hash('sha512', $password.Configuration::PASSWORD_SALT));


                //Check if the residnce country does not exist insert a new country and assign its ID to the variable $residenceCountryId
                //if it exists get the ID of the country and assign it to the variable $residenceCountryId
                if(CountryModel::getByName($residenceCountryName) == NULL){
                    CountryModel::add($residenceCountryName);
                    $residenceCountry = CountryModel::getByName($residenceCountryName);
                } else {
                    $residenceCountry = CountryModel::getByName($residenceCountryName);
                }
                $residenceCountryId =  $residenceCountry->country_id;
                
                //Check if the birth country does not exist insert a new country and assign its ID to the variable $birthCountryId
                //if it exists get the ID of the country and assign it to the variable $birthCountryId
                if(CountryModel::getByName($birthCountryName) == NULL){
                    CountryModel::add($birthCountryName);
                    $birthCountry = CountryModel::getByName($birthCountryName);
                } else {
                    $birthCountry = CountryModel::getByName($birthCountryName);
                }
                $birthCountryId = $birthCountry->country_id;
                
                //Check if the residnce city does not exist insert a new city and assign its ID to the variable $residenceCityId
                //if it exists get the ID of the city and assign it to the variable $residenceCityId
                if(CityModel::getByName($residenceCityName) == NULL){
                    CityModel::add($residenceCityName, $residenceCountryId);
                    $residenceCity = CityModel::getByName($residenceCityName);
                } else {
                    $residenceCity = CityModel::getByName($residenceCityName);
                }
                
                $residenceCityId = $residenceCity->city_id;
                    
                //Check if the birth city does not exist insert a new city and assign its ID to the variable $birthCityId
                //if it exists get the ID of the city and assign it to the variable $birthCityId
                if(CityModel::getByName($birthCityName) == NULL){
                    CityModel::add($birthCityName, $birthCountryId);
                    $birthCity = CityModel::getByName($birthCityName);
                } else {
                    $birthCity = CityModel::getByName($birthCityName);
                }
                $birthCityId = $birthCity->city_id;
                
                //Insert user data into table user
                if (UserModel::getByEmail($email) === false){
                    $lastUserId = UserModel::add($firstName, $lastName, $email, $encrypt_password, $userType, $gender, $status, $mobileNo, $address, $dateOfBirth, $birthCityId, $residenceCityId , "True");
                    if (!AccountModel::add($lastUserId, AccountTypeModel::getByName($accountType)->account_type_id, 0)){
                        $this->set('error_message', 'Account is not added, try again!');
                    }else{
                        Misc::redirect('admin/index#view-' . $lastUserId);
                     }
                } else {
                    $this->set('error_message', 'This email already exists, try another account!');
                }
            }
        }
        
        public function view($userId) {
            $this->set('user', UserViewModel::getById($userId));
            $this->set('account', AccountViewModel::getByUserId($userId));
        }
        
        public function editTemplate() {

        }
        
        public function edit($userId) {
           $this->set('user', UserViewModel::getById($userId));
           $this->set('account', AccountViewModel::getByUserId($userId));
           if(isset($_POST['submit'])){
                $firstName            = filter_input(INPUT_POST, 'first_name',  FILTER_SANITIZE_STRING);
                $lastName             = filter_input(INPUT_POST, 'last_name',  FILTER_SANITIZE_STRING);
                $email                = filter_input(INPUT_POST, 'email',  FILTER_SANITIZE_STRING);
                $userType             = filter_input(INPUT_POST, 'user_type',  FILTER_SANITIZE_STRING);
                $gender               = filter_input(INPUT_POST, 'gender',  FILTER_SANITIZE_STRING);
                $status               = filter_input(INPUT_POST, 'status',  FILTER_SANITIZE_STRING);
                $mobileNo             = filter_input(INPUT_POST, 'mobile_no',  FILTER_SANITIZE_STRING);
                $address              = filter_input(INPUT_POST, 'address',  FILTER_SANITIZE_STRING);
                $residenceCountryName = filter_input(INPUT_POST, 'residence_country',  FILTER_SANITIZE_STRING);
                $residenceCityName    = filter_input(INPUT_POST, 'residence_city',  FILTER_SANITIZE_STRING);
                $dateOfBirth          = filter_input(INPUT_POST, 'date_of_birth',  FILTER_SANITIZE_STRING);
                $birthCityName        = filter_input(INPUT_POST, 'birth_city',  FILTER_SANITIZE_STRING);
                $birthCountryName     = filter_input(INPUT_POST, 'birth_country',  FILTER_SANITIZE_STRING);
                $active               = filter_input(INPUT_POST, 'active',  FILTER_SANITIZE_STRING);
                $accountId            = filter_input(INPUT_POST, 'account_id',  FILTER_SANITIZE_STRING);
                $balance              = filter_input(INPUT_POST, 'balance',  FILTER_SANITIZE_STRING);
                $newAccountType       = filter_input(INPUT_POST, 'new_account_type',  FILTER_SANITIZE_STRING);
                $newAccountBalance    = filter_input(INPUT_POST, 'new_account_balance', FILTER_SANITIZE_STRING);
                $balanceId            = filter_input(INPUT_POST, 'balance_id',  FILTER_SANITIZE_STRING);
                
                print_r($_POST['balances']);
                //Check if the residnce country does not exist insert a new country and assign its ID to the variable $residenceCountryId
                //if it exists get the ID of the country and assign it to the variable $residenceCountryId
                if(CountryModel::getByName($residenceCountryName) == NULL){
                    CountryModel::add($residenceCountryName);
                    $residenceCountry = CountryModel::getByName($residenceCountryName);
                } else {
                    $residenceCountry = CountryModel::getByName($residenceCountryName);
                }
                $residenceCountryId =  $residenceCountry->country_id;
                
                //Check if the birth country does not exist insert a new country and assign its ID to the variable $birthCountryId
                //if it exists get the ID of the country and assign it to the variable $birthCountryId
                if(CountryModel::getByName($birthCountryName) == NULL){
                    CountryModel::add($birthCountryName);
                    $birthCountry = CountryModel::getByName($birthCountryName);
                } else {
                    $birthCountry = CountryModel::getByName($birthCountryName);
                }
                $birthCountryId = $birthCountry->country_id;
                
                //Check if the residnce city does not exist insert a new city and assign its ID to the variable $residenceCityId
                //if it exists get the ID of the city and assign it to the variable $residenceCityId
                if(CityModel::getByName($residenceCityName) == NULL){
                    CityModel::add($residenceCityName, $residenceCountryId);
                    $residenceCity = CityModel::getByName($residenceCityName);
                } else {
                    $residenceCity = CityModel::getByName($residenceCityName);
                }
                
                $residenceCityId = $residenceCity->city_id;
                    
                //Check if the birth city does not exist insert a new city and assign its ID to the variable $birthCityId
                //if it exists get the ID of the city and assign it to the variable $birthCityId
                if(CityModel::getByName($birthCityName) == NULL){
                    CityModel::add($birthCityName, $birthCountryId);
                    $birthCity = CityModel::getByName($birthCityName);
                } else {
                    $birthCity = CityModel::getByName($birthCityName);
                }
                $birthCityId = $birthCity->city_id;
                
                //Get all user details from the form and update the user's record in the table user
                UserModel::edit($firstName, $lastName, $email, $userType, $gender, $status, $mobileNo, $address, $dateOfBirth, $birthCityId, $residenceCityId, $active, $userId);
                
                //Edit the user balance
               foreach ($_POST['balances'] as $item => $balance) {
                   $i = 0;
                   echo $balance[$i++].'<br>';
                    if ($balance[0] != $balance[1]){
                        $newBalance = $balance[0];
                        $accountId  = $item;
                        AccountModel::edit($balance[0], $accountId);
                    }
                }

            //Check whether if the field of the new account are filled
                if($newAccountType != '' && $newAccountBalance != ''){
                    $newAccountTypeId = AccountTypeModel::getByName($newAccountType)->account_type_id;
                    //If the user does not have any accounts, add the new account without any checks
                    if(AccountModel::getByUserId($userId) === NULL){
                        AccountModel::add($userId, $newAccountTypeId, $newAccountBalance);
                    } else {
                        //Check whether the user has this type of the new account
                        foreach(AccountViewModel::getByUserId($userId) as $userAccount){
                            if($userAccount->account_type === $newAccountType){
                                $this->set('error_message', 'This user already have this type of account!');
                                break;
                            } else {
                                AccountModel::add($userId, $newAccountTypeId, $newAccountBalance);
                                $this->set('success_message', 'A new account was successfully added!');
                                break;
                            }
                        }
                    }
                }
                Misc::redirect('admin/index#view-' . $userId);
            } 
        }
    }
