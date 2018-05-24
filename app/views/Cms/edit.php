<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">  
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title">Edit User Details</h4>  
        </div>  
          
        <!--HTML FORM FOR UPDATING DATABASE RECORDS-->  
        <div class="modal-body">  
            <!--HTML FORM FOR INSERTING AND UPDATING DATABASE RECORDS-->  
            <form class="form-horizontal" method="POST" action="<?php echo Configuration::BASE . 'admin/edit/' . e($DATA['user']->user_id); ?>">
                <div class="form-group">
                    <label for="first_name" class="control-label col-sm-4">First Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="first_name" value="<?php echo e($DATA['user']->first_name);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="last_name" class="control-label col-sm-4">Last Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="last_name" value="<?php echo e($DATA['user']->last_name);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label col-sm-4">E-mail:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control col-sm-6" name="email" value="<?php echo e($DATA['user']->email);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="user_type" class="control-label col-xs-4">User Type:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="user_type" value="<?php echo e($DATA['user']->user_type);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender" class="control-label col-xs-4">Gender:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="gender" value="<?php echo e($DATA['user']->gender);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="control-label col-xs-4">Status:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="status" value="<?php echo e($DATA['user']->status);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile_no" class="control-label col-sm-4">Mobile:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="mobile_no" value="<?php echo e($DATA['user']->mobile_no);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="control-label col-sm-4">Address:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="address" value="<?php echo e($DATA['user']->address);?>" required>
                    </div><!--
        -->                    <div class="col-sm-4"></div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="residence_city" value="<?php echo e($DATA['user']->residence_city); ?>" required>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="residence_country" value="<?php echo e($DATA['user']->residence_country); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_of_birth" class="control-label col-sm-4">Date of Birth:</label>
                    <div class="col-sm-6">
                        <input type="text" id="datepicker" class="form-control col-sm-6" name="date_of_birth" value="<?php echo e($DATA['user']->date_of_birth);?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="place_of_birth" class="control-label col-sm-4">Place of Birth:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="birth_city" value="<?php echo e($DATA['user']->birth_city);?>" required>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="birth_country" value="<?php echo e($DATA['user']->birth_country);?>" required>
                    </div>
                </div>

                <?php foreach ($DATA['account'] as $item => $account) : ?>
                <div class="form-group">
                    <label for="account_type" class="control-label col-xs-4">Account <?php echo $item+1?>:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control col-sm-2" name="account_id" value="<?php echo e($account->account_id); ?>" readonly>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control col-sm-2" name="account_type" value="<?php echo e($account->account_type); ?>" readonly>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control col-sm-2" name="balances[<?php echo e($account->account_id); ?>][]" value="<?php echo round(e($account->balance),2); ?>" required>
                        <input type="hidden" class="form-control col-sm-2" name="balances[<?php echo e($account->account_id); ?>][]" value="<?php echo round(e($account->balance),2); ?>" >
                        <input type="hidden" class="form-control col-sm-2" name="balances[<?php echo e($account->account_id); ?>][]" value="<?php echo e($account->account_id); ?>" >
                        
                    </div>
                </div>
                <?php endforeach; ?>


                <div class="form-group">
                    <label for="new_account" class="control-label col-xs-4">Add New Account:</label>
                    <div class="col-sm-3">
                    Type:<select class="form-control" name="new_account_type" id="account_type">
                            <option disabled selected>Choose your account type...</option>
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                            <option value="RSD">RSD</option>
                         </select>
                    </div>
                    <div class="col-sm-2">
                        Balance:<input type="text" class="form-control col-sm-2" name="new_account_balance" value="">
                    </div>
                </div>

                <div id="radio">
                    <div class="form-group" id="radio">
                        <label class="radio-inline col-sm-3">
                                <input <?php if($DATA['user']->active == "True"){ echo 'checked';} ?> type="radio" name="active" value="True">Enable
                        </label>
                        <label class="radio-inline col-sm-3">
                                <input <?php if($DATA['user']->active == "False"){ echo 'checked';}?> type="radio" name="active" value="False">Disable
                        </label>
                    </div>
                </div>

                <div class="modal-footer">  
                    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
            </form>
        </div>
    </div>  
</div>
