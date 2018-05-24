<?php   
    final class Database{
        private static $db = NULL;
        
        public static function getInstance(){
           if(self::$db === NULL){
              self::$db = new PDO('mysql:host=' . Configuration::DB_HOST.
                                      ';dbname=' . Configuration::DB_NAME .
                                      ';charset=utf8',
                                      Configuration::DB_USER,
                                      Configuration::DB_PASS);
                
              self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
           }
           return self::$db;
        }         
    }