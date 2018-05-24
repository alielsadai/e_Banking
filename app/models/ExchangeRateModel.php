<?php
    class ExchangeRateModel {
        public static function getAll(){
            $SQL = 'SELECT * FROM `exchange_rate`;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($exchangeRateId){
            $SQL = 'SELECT * FROM `exchange_rate` WHERE exchange_rate_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$exchangeRateId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByCurrency($currency){
            $SQL = 'SELECT * FROM `exchange_rate` WHERE currency = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$currency]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
    }    