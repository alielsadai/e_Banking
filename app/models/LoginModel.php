<?php

    class LoginModel implements ModelInterface{
        public static function getAll() {
            $SQL = 'SELECT * FROM `login` ORDER BY login_post;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if ($result) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }

        public static function getById($login_id){
            $SQL = 'SELECT * FROM `login` WHERE login_id = ?;';
            $prep = Database::getInstance()()->prepare($SQL);
            $result = $prep->execute([$login_id]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByUserId($userId){
            $SQL = 'SELECT * FROM `login` WHERE user_id = ?;';
            $prep = Database::getInstance()()->prepare($SQL);
            $result = $prep->execute([$userId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }

        public static function add($userId){
            $SQL = 'INSERT INTO `login` (user_id) VALUES (?);';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$userId]);
            if($result){
                return true;
            }else{
                return false;
            }
        }
     }
    
