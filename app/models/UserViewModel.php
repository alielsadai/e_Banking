<?php
    class UserViewModel implements ModelInterface{
         public static function getAll(){
            $SQL = 'SELECT * FROM `user_view` ORDER BY user_id;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($userId){
            $SQL = 'SELECT * FROM `user_view` WHERE user_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$userId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function add(){
            return false;
        }
    }   
