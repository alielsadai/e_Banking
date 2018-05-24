<?php
    class transactionModel implements ModelInterface{
        public static function getAll(){
            $SQL = 'SELECT * FROM `transactions` ORDER BY transaction_post;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        } 
        
        public static function getById($transaction_id){
            $SQL='SELECT * FROM `transaction` WHERE transaction_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute(['?']);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }

        public static function add($accountId, $transactionTypeId, $exchangeRateId, $purpose, $transactionAmount){
            $SQL = 'INSERT INTO `transaction` (account_id, transaction_type_id, exchange_rate_id, purpose, transaction_amount) VALUES (?,?,?,?,?);';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$accountId, $transactionTypeId, $exchangeRateId, $purpose, $transactionAmount]);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
    

