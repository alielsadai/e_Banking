<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">  
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title">Add New User</h4>  
        </div>  
        <div class="modal-body">  
            <!--HTML FORM FOR INSERTING AND UPDATING DATABASE RECORDS-->  
            <form class="form-horizontal" method="POST" action="<?php echo Configuration::BASE; ?>admin/add/">
                <div class="form-group">
                    <label for="first_name" class="control-label col-sm-4">First Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="first_name" required title="Please, Enter your first name" placeholder="First Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="last_name" class="control-label col-sm-4">Last Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="last_name" required title="Please, Enter your last name" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label col-sm-4">E-mail:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control col-sm-6" name="email" required title="Please, Enter your email" placeholder="Example@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label col-sm-4">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control col-sm-6" name="password" required title="Please, Enter your password">
                    </div>
                </div>

                <div class="dropdown form-group ">
                    <label for="user_type" class="control-label col-xs-4">User Type:</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="user_type" id="user_type">
                            <option disabled selected>Choose user type...</option>
                            <option value="Client">Client</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="dropdown form-group">
                    <label for="gender" class="control-label col-xs-4">Gender:</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="gender" id="gender">
                            <option disabled selected>I am...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="dropdown form-group">
                    <label for="status" class="control-label col-xs-4">Status:</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="status" id="status">
                            <option disabled selected>I am...</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile_no" class="control-label col-sm-4">Mobile:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control col-sm-6" name="mobile_no" required title="Please, Enter your mobile number" placeholder="Mobile Number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="control-label col-sm-4">Address:</label>
                    <div class="col-sm-6">
                        <input type="text" id="add-address" class="form-control col-sm-6" name="address" required title="Please, Enter your address" placeholder="Address">
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="residence_city" required title="Please, Enter residence city" placeholder="City">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="residence_country" required title="Please, Enter birth country" placeholder="Couuntry">
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_of_birth" class="control-label col-sm-4">Date of Birth:</label>
                    <div class="col-sm-6">
                        <input type="text" id="datepicker" class="form-control col-sm-6" name="date_of_birth" required title="Please, Enter your date of birth">
                    </div>
                </div>

                <div class="form-group">
                    <label for="place_of_birth" class="control-label col-sm-4">Place of Birth:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="birth_city" required title="Please, Enter your birth city" placeholder="City">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control col-sm-6" name="birth_country" required title="Please, Enter your birth country" placeholder="Country">
                    </div>
                </div>

                <div class="dropdown form-group">
                    <label for="account_type" class="control-label col-xs-4">Account Type:</label>

                    <div class="col-xs-6">
                        <select class="form-control" name="account_type" id="account_type">
                            <option disabled selected>Choose your account type...</option>
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                            <option value="RSD">RSD</option>
                        </select>
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


<script>
//    $( function() {
//        $( "#datepicker" ).datepicker({
//            changeMonth: true,
//            changeYear: true
//        });
//    
//     } );

$( function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true
    });
  } );
</script>