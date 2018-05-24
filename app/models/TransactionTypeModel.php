<?php
class TransactionTypeModel {
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
        
    public static function getById($transactionTypeId){
        $SQL = 'SELECT * FROM `transaction_type` WHERE transaction_type_id = ?;';
        $prep = Database::getInstance()->prepare($SQL);
        $result = $prep->execute([$transactionTypeId]);
        if($result){
            return $prep->fetch(PDO::FETCH_OBJ);
        }else{
           return [];
        }
    }      
}
