<?php
    class CountryModel {
         public static function getAll(){
            $SQL = 'SELECT * FROM `country` ORDER BY country_name;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($countryId){
            $SQL='SELECT * FROM `country` WHERE country_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$countryId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByName($countryName){
            $SQL='SELECT * FROM `country` WHERE name = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$countryName]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return null;
            }
        }
        
        public static function add($countryName){
            $SQL = 'INSERT INTO `country` (name) VALUES (?);';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$countryName]);
            if($result){
                return true;
            } else {
                return false;
            }
        }
    }
