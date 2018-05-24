<?php
    class AccountModel implements ModelInterface{
        public static function getAll(){
            $SQL = 'SELECT * FROM `account` ORDER BY account_id;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($accountId){
            $SQL='SELECT * FROM `account` WHERE account_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$accountId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByUserId($userId){
            $SQL='SELECT * FROM `account` WHERE user_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$userId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        /**
         * In the update query we can update only the balance because the type and the account number are not updatable
         * In case we want a new account we will use the add(); for adding a new account
         */
        public static function edit($balance, $accountId){
            $SQL = 'UPDATE `account` SET balance = ? WHERE account_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            return $prep->execute([$balance, $accountId]);
        }
        
        public static function add($userId, $accountTypeId, $balance){
            $SQL = 'INSERT INTO `account` (user_id, account_type_id, balance) VALUES (?,?,?);';
            $prep = Database::getInstance()->prepare($SQL);
            if (!$prep) {
                die('FOR PROGRAMMER: FIX the add method SQL query in the AccountModel class!');
            }
            $result = $prep->execute([$userId, $accountTypeId, $balance]);
            if($result){
                return true;
            } else {
                return false;
            }
        }
    }    