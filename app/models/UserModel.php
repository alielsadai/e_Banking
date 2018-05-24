<?php
    class UserModel implements ModelInterface{
        public static function getAll(){
            $SQL = 'SELECT * FROM `user` ORDER BY first_name AND last_name;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($userId){
            $SQL='SELECT * FROM `user` WHERE user_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$userId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByEmail($email){
            $SQL = 'SELECT * FROM `user` WHERE `email` = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$email]);
            //var_dump($prep->fetch(PDO::FETCH_OBJ));            //die();
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }           
        }
        
        public static function getByEmailAndPassword($email, $password) {
            $SQL = 'SELECT * From `user` WHERE email = ? AND password  = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$email, $password]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            } 
        }
        
        //HOW TO ADD THE FOREIGN KEY TO THE TABLE USER
        public static function add($firstName, $lastName, $email, $password, $userType, $gender, $status, $mobileNo, $address,
                $dateOfBirth, $birthCityId, $residendeCityId, $active){
            $SQL = 'INSERT INTO `user`(first_name, last_name, email, password, user_type, gender, status, 
                        mobile_no, address, date_of_birth, birth_city_id, residence_city_id, active)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);';
            $prep = Database::getInstance()->prepare($SQL);
//            var_dump($prep->execute([$firstName, $lastName, $email, $password, $userType, $gender, $status, $mobileNo, $address,
//                $dateOfBirth, $birthCityId, $residendeCityId, $active]));    die();
            $result = $prep->execute([$firstName, $lastName, $email, $password, $userType, $gender, $status, $mobileNo, $address,
                $dateOfBirth, $birthCityId, $residendeCityId, $active]);
           
            if ($result){
                return Database::getInstance()->lastInsertId();
            } else {
                return false;
            }
        }
        
        public static function edit($firstName, $lastName, $email, $userType, $gender, $status, $mobileNo, $address,
                $dateOfBirth, $birthCityId, $residendeCityId, $active, $userId){
            $SQL = 'UPDATE `user` SET first_name = ?, last_name = ?, email = ?, user_type = ?, gender = ?, status = ?,
                    mobile_no = ?, address = ?, date_of_birth = ?, birth_city_id = ?, residence_city_id = ?, active = ?
                    WHERE user_id = ? ;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$firstName, $lastName, $email, $userType, $gender, $status, $mobileNo, $address,
                $dateOfBirth, $birthCityId, $residendeCityId, $active, $userId]);
            
            if($result){
                //To display the user details after editing, we get his/her record by method getByEmail();
                return self::getByEmail($email);
            } else {
                return false;
            }
        }    
    }