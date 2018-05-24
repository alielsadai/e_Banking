<?php
    class CityModel {
        public static function getAll(){
            $SQL = 'SELECT * FROM `city` ORDER BY city_name;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute();
            if($result){
                return $prep->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        
        public static function getById($cityId){
            $SQL='SELECT * FROM `city` WHERE city_id = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$cityId]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return [];
            }
        }
        
        public static function getByName($cityName){
            $SQL='SELECT * FROM `city` WHERE name = ?;';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$cityName]);
            if($result){
                return $prep->fetch(PDO::FETCH_OBJ);
            }else{
               return null;
            }
        }
        
        //HOW TO ADD THE FOREIGN KEY OF `COUNTRY` TABLE TO THE TABLE `CITY`
        public static function add($cityName, $countryId){
            $SQL = 'INSERT INTO `city` (name,country_id) VALUES (?,?);';
            $prep = Database::getInstance()->prepare($SQL);
            $result = $prep->execute([$cityName, $countryId]);
            if($result){
                return true;
            } else {
                return false;
            }
        }
    }
