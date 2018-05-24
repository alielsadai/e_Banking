<?php require 'app/views/template/beforeContent.php'; ?>
<?php require 'app/views/template/mainMenu.php'; ?>

<div class="container">
    <form class="form-horizontal" method="post" action="<?php echo Configuration::BASE . 'makeTransaction/'. e($DATA['account_id']); ?>">
        <div class="form-group">
            <label class="control-label col-sm-4">Reciever Account:</label>
            <div class="col-sm-6">
                 <input type="number" class="form-control" name="reciever_account_id" required title="Please, Enter the reciever account" placeholder="Recievr Account Number">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4">Purpose:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control col-sm-6" name="purpose" required title="Please, Enter the reason why you eant to send money" placeholder="Why you want to transfer money">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4">Transaction Amount:</label>
            <div class="col-sm-6">
                <input type="number" min="1" class="form-control" name="transaction_amount" required title="Please, Enter The Transaction Account" placeholder="Transaction Amount">
            </div>
        </div>

        <div class="form-group" id="buttons2">
            <button class="btn btn-primary" name="submit" type="submit" value="submit">Transfer</button>
            <a href="<?php echo Configuration::BASE;?>transactionsList/<?php echo $DATA['account_id'];?>" class="btn btn-danger">Go Back</a>
        </div>
    </form>
</div>    


<?php require_once 'app/views/template/afterContent.php';?>     
