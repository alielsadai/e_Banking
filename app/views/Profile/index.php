<?php require 'app/views/template/beforeContent.php';?>
<?php require 'app/views/template/mainMenu.php';?>

<?php if(isset($DATA['user_data'])) : ?>
    <div class="container">
        <div class="text-left">
            <h3>Profile:</h3>
        </div>
      <!-- TABLE FOR USER DATA -->
        <div class="table table-responsive ">
              <table class="table  table-bordered">
                  <tr>
                      <th>Name</th>
                      <td><?php echo $DATA['user_data']->first_name . ' ' . $DATA['user_data']->last_name;?></td>
                  </tr>
                  <tr>
                      <th>Date/Place of Birth</th>
                      <td><?php echo $DATA['user_data']->date_of_birth . ' ' . $DATA['user_data']->birth_city;?></td>
                  </tr>
                  <tr>
                      <th>Address</th>
                      <td><?php echo $DATA['user_data']->address;?></td>
                  </tr>
                  <tr>
                      <th>Mobile</th>
                      <td><?php echo $DATA['user_data']->mobile_no;?></td>
                  </tr>
                  <tr>
                      <th>E-mail</th>
                      <td><?php echo $DATA['user_data']->email;?></td>
                  </tr>
              </table>
          </div>

          <br/><br/>

          <div class="text-center">
                <h3>Manage your Accounts in The Best Way!</h3>
          </div>
          <!-- TABLE FOR USER ACCOUNTS -->
          <div class="table table-responsive ">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Account Number</th>
                          <th>Type</th>
                          <th>Balance</th>
                          <th>Make Transactions</th>
                      </tr>
                  </thead>

                  <?php if(is_array($DATA['account_data'])) foreach($DATA['account_data'] as $account) : ?>

                    <tr>
                        <td><?php echo $account->account_id;?></td>
                        <td><?php echo $account->account_type;?></td>
                        <td><?php echo $account->balance;?></td>
                         <td>
                             <a href="<?php echo Configuration::BASE ?>transactionsList/<?php echo $account->account_id;?>" class="btn btn-default">
                                Transactions
                             </a>
                         </td>
                    </tr>

                  <?php endforeach;?>

              </table>
          </div>
      </div>
      <a id="button-1" class="btn btn-danger" href="<?php echo Configuration::BASE ?>home">Go Back</a>
<?php endif;?>

<?php require_once 'app/views/template/afterContent.php';?>

