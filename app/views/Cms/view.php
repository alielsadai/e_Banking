<!--DIV WHICH CONTAINS A MODAL DIALOG-->
<div class="modal-dialog">  
    <!--DIV WITH CONTENT OF MODAL DIALOG-->
    <div class="modal-content">  
        <!--DIV WITH HEADER OF MODAL DIALOG-->
        <div class="modal-header">  
            <!--X BUTTON FOR CLOSING MODAL DIALOG-->
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <!--DIV WITH TITLE OF MODAL DIALOG-->
            <h4 class="modal-title">User Details</h4>  
        </div>
        <!--DIV WITH BODY OF MODAL DIALOG-->
        <div class="modal-body"> 
            <table class="table table-responsive">
                <tr>  
                    <th><label>Name:</label></th>  
                    <td><?php echo e($DATA['user']->first_name).' '.e($DATA['user']->last_name); ?></td>  
                </tr>  
                <tr>  
                    <th><label>E-mail:</label></th>  
                    <td><?php echo e($DATA['user']->email); ?></td>  
                </tr>
                <tr>  
                    <th><label>User Type:</label></th>  
                    <td><?php echo e($DATA['user']->user_type); ?></td>  
                </tr>  
                <tr>  
                    <th><label>Date/Place of Birth:</label></th>  
                    <td><?php echo e($DATA['user']->date_of_birth) .', '. e($DATA['user']->birth_city); ?></td>  
                </tr> 
                <tr>  
                    <th><label>Address:</label></th>  
                    <td><?php echo e($DATA['user']->address) . ', ' . e($DATA['user']->residence_city) . ', ' . e($DATA['user']->residence_country); ?></td>  
                </tr>
                <tr>  
                    <th><label>Gender:</label></th>  
                    <td><?php echo e($DATA['user']->gender); ?></td>  
                </tr>  
                <tr>  
                    <th><label>Status:</label></th>  
                    <td><?php echo e($DATA['user']->status); ?></td>  
                </tr>  
                <tr>  
                    <th><label>Phone:</label></th>  
                    <td><?php echo e($DATA['user']->mobile_no); ?></td>  
                </tr>
                
                <?php foreach($DATA['account'] as $item => $account)  : ?>
                <tr>
                    <th><label>Account <?php echo $item+1; ?>:</label></th>  
                    <td><?php echo e($account->account_id) .' '. e($account->account_type) .' '. e($account->balance); ?></td>  
                    
                </tr>
                
                <?php endforeach; ?>
            </table>
        </div>
       
        <!--DIV WITH FOOTER OF MODAL DIALOG-->
        <div class="modal-footer">  
            <!--BUTTON FOR CLOSING MODAL DIALOG-->
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
        </div>
    </div>
</div>
