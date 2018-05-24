<?php
    class AccountViewModel implements ModelInterface{
        public static function getAll(){
            $SQL = 'SELECT * FROM `account_view` ORDER BY account_id;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($accountId){
            $SQL='SELECT * FROM `account_view` WHERE account_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$accountId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByUserId($userId){
            $SQL='SELECT * FROM `account_view` WHERE user_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$userId]);
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function add(){
            return false;
        }
    }
