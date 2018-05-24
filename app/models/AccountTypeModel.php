<?php
    class AccountTypeModel {
        public static function getAll(){
            $SQL = 'SELECT * FROM `account_type` ORDER BY account_type;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($accountTypeId){
            $SQL='SELECT * FROM `account_type` WHERE account_type_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$accountTypeId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByName($accountType){
            $SQL='SELECT * FROM `account_type` WHERE account_type = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$accountType]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
    }
