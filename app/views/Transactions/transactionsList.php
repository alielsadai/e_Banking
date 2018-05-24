<?php require 'app/views/template/beforeContent.php';?>
<?php require 'app/views/template/mainMenu.php';?>

<div class="container">
    <!-- TABLE FOR USER ACCOUNT DATA -->
    <?php if(is_array($DATA['transaction_list'])) : ?>
        <h4 id="top"><?php echo $DATA['account_data']->account_type; ?> Account:</h4>

          <table class="table tabel-bordered" id="transactions-table">
            <!-- ACCOUNT DATA -->
            <thead>
                <tr>
                    <th>Account Number</th>
                    <th>Balance</th>
                    <th>Type</th>
                </tr>
            </thead>

            <tr>
                <td><?php echo $DATA['account_data']->account_id; ?></td>
                <td><?php echo $DATA['account_data']->balance; ?></td>
                <td><?php echo $DATA['account_data']->account_type; ?></td>
            </tr>
          </table>

    <?php endif;?>

    <br/>
    <br/>

    <!-- TRANSACTION DATA -->
    <h4><?php echo $DATA['account_data']->account_type; ?> Account Transactions:</h4>

    <div class="table table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Transaction Type</th>
                    <th>Transaction Amount</th>
                    <th>Purpose</th>
                    <th>Transaction Post</th>
                </tr>
            </thead>

            <?php foreach($DATA['transaction_list'] as $transaction) : ?>
            <tr>
                <?php if($transaction->transaction_type == "Deposite") : ?>
                    <td class="text-success"><span class="glyphicon glyphicon-plus"></span></span><?php echo '      '.$transaction->transaction_type;?></td>
                    <td class="text-success"><?php echo round($transaction->transaction_amount, 2);?></td>
                    <td class="text-success"><?php echo $transaction->purpose;?></td>
                    <td class="text-success"><?php echo $transaction->transaction_post;?></td>
                <?php else : ?>
                    <td class="text-danger"><span class="glyphicon glyphicon-minus"></span><?php echo '      '.$transaction->transaction_type;?></td>
                    <td class="text-danger"><?php echo round($transaction->transaction_amount, 2);?></td>
                    <td class="text-success"><?php echo $transaction->purpose;?></td>
                    <td class="text-danger"><?php echo $transaction->transaction_post;?></td>
                <?php endif;?>
            </tr>
            <?php endforeach;?>
        </table>
    </div>

    <div>
        <a class="btn btn-primary" href="<?php echo Configuration::BASE ?>makeTransaction/<?php echo $DATA['account_data']->account_id; ?>">Transfer Money</a>
        <form method="post" id="excel-form" action="<?php echo Configuration::BASE . 'transactionsList/' . $DATA['account_data']->account_id;?>">
            <input type="submit" name="download" value="Download Excel" class="btn btn-primary"/>
        </form>
        <a class="btn btn-danger" href="<?php echo Configuration::BASE ?>profile">Go Back</a>
        <a class="btn btn-default" href="#top">Top</a>
    </div>    
</div>

        
<?php require_once 'app/views/template/afterContent.php';?>

        