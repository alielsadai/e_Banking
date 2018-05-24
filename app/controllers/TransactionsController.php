<?php
    class TransactionsController extends Controller{
        
        public function transactionsList($accountId){
            $this->set('seo_title', 'Transactions List');
            
            $accountData = AccountViewModel::getById($accountId);
            $this->set('account_data', $accountData);
            
            /* @var $transactionList String */
            $transactionList = TransactionViewModel::getByAccountId($accountId);
            $this->set('transaction_list', $transactionList);
            
            //Block of code to download excel file with list of transactions usinf PHPExcel library
            if(isset($_POST['download'])){
                $objPHPExcel = new PHPExcel();
                
                $objPHPExcel->setActiveSheetIndex(0);
                
                $objPHPExcel->getActiveSheet()->setCellValue('A1','Transaction Type');
                $objPHPExcel->getActiveSheet()->setCellValue('B1','Amount');
                $objPHPExcel->getActiveSheet()->setCellValue('C1','Purpose');
                $objPHPExcel->getActiveSheet()->setCellValue('D1','Date');
                
                $row=2;
                
                foreach ($transactionList as $key => $value) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $value->transaction_type);
                    $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, $value->transaction_amount);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'. $row, $value->purpose);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $value->transaction_post);
                    $row++;
                }
                
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="Transactions List.xls"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                exit;
            }
        }
        
//        public function downloadExcel($accountId){
//            if(isset($_POST['download'])){
//                $this->set('transaction_list', TransactionViewModel::getByAccountId(28));
//                echo 'heeeeeeey' . $accountId;
//            }
//        }
        
        public function makeTransaction($senderAccount) {
            $this->set('seo_title', 'Transfer Money');
            
            $this->set('account_id', $senderAccount);
            $senderAccountType = AccountViewModel::getById($senderAccount)->account_type;
            $senderBalance     = AccountViewModel::getById($senderAccount)->balance;
            
            if (isset($_POST['submit'])) {
                $recieverAccount   = filter_input(INPUT_POST, 'reciever_account_id', FILTER_SANITIZE_STRING);
                $purpose           = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);
                $transactionAmount = filter_input(INPUT_POST, 'transaction_amount', FILTER_SANITIZE_STRING);
                
                //Check if the reciever account number exists or not
                if(AccountViewModel::getById($recieverAccount) != NULL){
                    //Getting the reciever account data
                    $recieverAccountData = AccountViewModel::getById($recieverAccount);
                    $recieverAccount     = $recieverAccountData->account_id;
                    $recieverAccountType = $recieverAccountData->account_type;
                    $recieverBalance     = $recieverAccountData->balance;
               } else {
                    $this->set('error_message', 'Invalid account number, try again!');
                    return;
                }
                
                //Check if the reciever account same as the sender account
                if($recieverAccount == $senderAccount){
                    $this->set('error_message', 'You cannot transfer money to the same account, try another account!');
                    return;
                }
                
                //Check whether the transaction amount is valid
                if ($transactionAmount <= 0) {
                   $this->set('error_message', 'Invalid amount of money, try bigger amount!');
                   return; 
                }
                
                //In case the reciever and the sender have the same account type
                if($senderAccountType == $recieverAccountType){
                    $senderBalance    -= $transactionAmount;     //Intreduce transaction amount from sender balance
                    $recieverBalance  += $transactionAmount;     //Add the transaction amount to the reciever balance
                    
                    if($senderBalance < 0){
                        $this->set('error_message', 'You have insuffcient amount, try smaller amount!');
                        return;
                    } else {
                        //Update sender balance
                        AccountModel::edit($senderBalance, $senderAccount);
                        //Update redciever balance
                        AccountModel::edit($recieverBalance, $recieverAccount);
                        //Insert new transactions into table transaction for the sender as Withdrawal
                        TransactionModel::add($senderAccount, 1, NULL, $purpose, $transactionAmount);
                        //Insert new transactions into table transaction for the reciver as Deposite
                        TransactionModel::add($recieverAccount, 2, NULL, $purpose, $transactionAmount);
                        $this->set('success_message', 'Money was transaferd successfull, congratulations!');
                        return;
                    }
                    
                //In case the sender account type is 'EUR' and the reciever account type is 'RSD'
                 }elseif ($senderAccountType == 'EUR' && $recieverAccountType == 'RSD'){
                    $exchangeRateId = ExchangeRateModel::getByCurrency($senderAccountType)->exchange_rate_id;
                    $buyingRate  = ExchangeRateModel::getByCurrency($senderAccountType)->buying_rate;
                    
                    $convertedAmount  = $transactionAmount * $buyingRate;     //Converting the transfered amount to same cuurency type as the reciever account
                    $senderBalance   -= $transactionAmount;
                    $recieverBalance += $convertedAmount;
                    
                    if ($senderBalance  < 0) {
                         $this->set('error_message', 'You have insuffcient amount, try smaller amount!');
                         return;
                    } else {
                        //Update sender balance
                        AccountModel::edit($senderBalance, $senderAccount); 
                        //Insert new transactions into table transaction for the sender as Withdrawal
                        TransactionModel::add($senderAccount, 1, $exchangeRateId, $purpose, $transactionAmount);
                        //Update redciever balance
                        AccountModel::edit($recieverBalance, $recieverAccount);
                        //Insert new transactions into table transaction for the reciever as Deposite
                        TransactionModel::add($recieverAccount, 2, $exchangeRateId, $purpose, $convertedAmount);
                        $this->set('success_message', 'Money was transaferd successfully, congratulations!');
                        return;
                   }
                
                //In case the sender account type is 'USD' and the reciever account type is 'RSD'   
                }elseif($senderAccountType == "USD" && $recieverAccountType == "RSD"){
                    $exchangeRateId = ExchangeRateModel::getByCurrency($senderAccountType)->exchange_rate_id;
                    $buyingRate  = ExchangeRateModel::getByCurrency($senderAccountType)->buying_rate;
                    
                    $convertedAmount  = $transactionAmount * $buyingRate;     //Converting the transfered amount to same cuurency type as the reciever account
                    $senderBalance   -= $transactionAmount;
                    $recieverBalance += $convertedAmount;
                    
                    if ($senderBalance  < 0) {
                         $this->set('error_message', 'You have insuffcient amount, try smaller amount!');
                    } else {
                        //Update sender balance
                        AccountModel::edit($senderBalance, $senderAccount); 
                        //Insert new transactions into table transaction for the sender as Withdrawal
                        TransactionModel::add($senderAccount, 1, $exchangeRateId, $purpose, $transactionAmount);
                        //Update redciever balance
                        AccountModel::edit($recieverBalance, $recieverAccount);
                        //Insert new transactions into table transaction for the reciever as Deposite
                        TransactionModel::add($recieverAccount, 2, $exchangeRateId, $purpose, $convertedAmount);
                        $this->set('success_message', 'Money was transaferd successfully, congratulations!');
                    }
                    
                 //In case the sender account type is 'RSD' and the reciever account type is 'EUR'   
                } elseif ($senderAccountType == "RSD" && $recieverAccountType == "EUR"){
                    $exchangeRateId = ExchangeRateModel::getByCurrency($recieverAccountType)->exchange_rate_id;
                    $sellingRate  = ExchangeRateModel::getByCurrency($recieverAccountType)->selling_rate;
                    
                    $convertedAmount  = $transactionAmount / $sellingRate;     //Converting the transfered amount to same cuurency type as the reciever account
                    $senderBalance   -= $transactionAmount;
                    $recieverBalance += $convertedAmount;
                    
                    if ($senderBalance  < 0) {
                         $this->set('error_message', 'You have insuffcient amount, try smaller amount!');
                         return;
                    } else {
                        //Update sender balance
                        AccountModel::edit($senderBalance, $senderAccount); 
                        //Insert new transactions into table transaction for the sender as Withdrawal
                        TransactionModel::add($senderAccount, 1, $exchangeRateId, $purpose, $transactionAmount);
                        //Update redciever balance
                        AccountModel::edit($recieverBalance, $recieverAccount);
                        //Insert new transactions into table transaction for the reciever as Deposite
                        TransactionModel::add($recieverAccount, 2, $exchangeRateId, $purpose, $convertedAmount);
                        $this->set('success_message', 'Money was transaferd successfully, congratulations!');
                        return;
                    }
                    
                //In case the sender account type is 'RSD' and the reciever account type is 'USD'   
                } elseif ($senderAccountType == "RSD" && $recieverAccountType == "USD"){
                    $exchangeRateId = ExchangeRateModel::getByCurrency($recieverAccountType)->exchange_rate_id;
                    $sellingRate  = ExchangeRateModel::getByCurrency($recieverAccountType)->selling_rate;
                    
                    $convertedAmount  = $transactionAmount / $sellingRate;     //Converting the transfered amount to same cuurency type as the reciever account
                    $senderBalance   -= $transactionAmount;
                    $recieverBalance += $convertedAmount;
                    
                    if ($senderBalance  < 0) {
                         $this->set('error_message', 'You have insuffcient amount, try smaller amount!');
                         return;
                    } else {
                        //Update sender balance
                        AccountModel::edit($senderBalance, $senderAccount); 
                        //Insert new transactions into table transaction for the sender as Withdrawal
                        TransactionModel::add($senderAccount, 1, $exchangeRateId, $purpose, $transactionAmount);
                        //Update redciever balance
                        AccountModel::edit($recieverBalance, $recieverAccount);
                        //Insert new transactions into table transaction for the reciever as Deposite
                        TransactionModel::add($recieverAccount, 2, $exchangeRateId, $purpose, $convertedAmount);
                        $this->set('success_message', 'Money was transaferd successfully, congratulations!');
                        return;
                    }
                    
                //In case the sender account type is 'EUR' and the reciever account type is 'USD'   
                } elseif ($senderAccountType == "EUR" && $recieverAccountType == "USD"){
                    //Get buying rate and selling rate where the currency is same is sender account type 'EUR'
                    $eurExchangeRateId = ExchangeRateModel::getByCurrency($senderAccountType)->exchange_rate_id;
                    $eurSellingRate  = ExchangeRateModel::getByCurrency($senderAccountType)->selling_rate;
                    $eurBuyingRate   = ExchangeRateModel::getByCurrency($senderAccountType)->buying_rate;
                    
                    //Get buying rate and selling rate where the currency is same is reciever account type 'USD'
                    $usdExchangeRateId = ExchangeRateModel::getByCurrency($recieverAccountType)->exchange_rate_id;
                    $usdSellingRate  = ExchangeRateModel::getByCurrency($recieverAccountType)->selling_rate;
                    $usdBuyingRate   = ExchangeRateModel::getByCurrency($recieverAccountType)->buying_rate;
                    
                    //Convert from 'EUR' to 'RSD'
                    $eurConvertedAmount  = $transactionAmount * $eurBuyingRate;
                    //Convert from 'RSD' to 'USD'
                    $usdConvertedAmount = $eurConvertedAmount / $usdSellingRate;
                    //Reduce the transfered amount from the sender balance
                    $senderBalance   -= $transactionAmount;
                    //Add the transfered amount to the reciever balance
                    $recieverBalance += $usdConvertedAmount;
                    
                    if ($senderBalance  < 0) {
                         $this->set('error_message', 'You have insuffcient amount, try smaller amount!');
                    } else {
                        //Update sender balance
                        AccountModel::edit($senderBalance, $senderAccount); 
                        //Insert new transactions into table transaction for the sender as Withdrawal
                        TransactionModel::add($senderAccount, 1, $eurExchangeRateId, $purpose, $transactionAmount);
                        //Update redciever balance
                        AccountModel::edit($recieverBalance, $recieverAccount);
                        //Insert new transactions into table transaction for the reciever as Deposite
                        TransactionModel::add($recieverAccount, 2, $usdExchangeRateId, $purpose, $usdConvertedAmount);
                        $this->set('success_message', 'Money was transaferd successfully, congratulations!');
                    }
                    
                //In case the sender account type is 'USD' and the reciever account type is 'EUR'
                 } elseif ($senderAccountType == "USD" && $recieverAccountType == "EUR"){
                    //Get buying rate and selling rate where the currency is same is sender account type 'EUR'
                    $eurExchangeRateId = ExchangeRateModel::getByCurrency($recieverAccountType)->exchange_rate_id;
                    $eurSellingRate  = ExchangeRateModel::getByCurrency($recieverAccountType)->selling_rate;
                    $eurBuyingRate   = ExchangeRateModel::getByCurrency($recieverAccountType)->buying_rate;
                    
                    //Get buying rate and selling rate where the currency is same is reciever account type 'USD'
                    $usdExchangeRateId = ExchangeRateModel::getByCurrency($senderAccountType)->exchange_rate_id;
                    $usdSellingRate  = ExchangeRateModel::getByCurrency($senderAccountType)->selling_rate;
                    $usdBuyingRate   = ExchangeRateModel::getByCurrency($senderAccountType)->buying_rate;
                    
                    //Convert from 'EUR' to 'RSD'
                    $usdConvertedAmount  = $transactionAmount * $usdBuyingRate;
                    //Convert from 'RSD' to 'USD'
                    $eurConvertedAmount = $usdConvertedAmount / $eurSellingRate;
                    //Reduce the transfered amount from the sender balance
                    $senderBalance   -= $transactionAmount;
                    //Add the transfered amount to the reciever balance
                    $recieverBalance += $eurConvertedAmount;
                    
                    if ($senderBalance  < 0) {
                         $this->set('error_message', 'You have insuffcient amount, try smaller amount!');
                    } else {
                        //Update sender balance
                        AccountModel::edit($senderBalance, $senderAccount); 
                        //Insert new transactions into table transaction for the sender as Withdrawal
                        TransactionModel::add($senderAccount, 1, $eurExchangeRateId, $purpose, $transactionAmount);
                        //Update redciever balance
                        AccountModel::edit($recieverBalance, $recieverAccount);
                        //Insert new transactions into table transaction for the reciever as Deposite
                        TransactionModel::add($recieverAccount, 2, $usdExchangeRateId, $purpose, $usdConvertedAmount);
                        $this->set('success_message', 'Money was transaferd successfully from, congratulations!');
                    }
                }
            }
         }
     }         
