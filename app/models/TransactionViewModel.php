<?php
    class TransactionViewModel implements ModelInterface{
        public static function getAll(){
            $SQL = 'SELECT * FROM `transaction_view` ORDER BY transaction_post;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        } 
        
        public static function getById($transactionId){
            $SQL='SELECT * FROM `transaction_view` WHERE transaction_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$transactionId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByAccountId($accountId){
            $SQL = 'SELECT * FROM `transaction_view` tv  WHERE tv.account_id = ? ORDER BY tv.transaction_post ASC;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$accountId]);
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