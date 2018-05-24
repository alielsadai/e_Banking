<?php require 'app/views/template/beforeContent.php';?>
<?php require 'app/views/template/mainMenu.php';?>

    <p>
        <?php if (isset($DATA['user'])) : ?>
            <?php print_r($DATA['user']->user_id);?>
        <?php endif;?>
    </p>
    <!-- Modal-->
    <div id="login-overlay" class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- Modal header-->
            <div class="modal-header">
                <h4 class="modal-title" align="center" id="myModalLabel">Welcome to Our e-Banking</h4>
            </div>

            <!-- Modal body-->
            <div class="col-xs-6">
                <div class="well">

                    <div class="panel-heading ">
                        <h3 class="panel-title lead"><span class="text-success"><strong>Sign in</strong></span></p>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo Configuration::BASE ?>login">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required/>
                            </div>
                            <input class="btn btn-primary" name="submit" type="submit" value="Sign in" />
                            <a class="btn btn-danger" href="<?php echo Configuration::BASE ?>home">Cnacel</a>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-xs-6">
                <div class="well">
                    <p class="lead"><span class="text-success">ONLINE BANKING</span></p>
                    <p>ANY TIME, ANY WHERE.</p>
                    <ul class="list-unstyled">
                        <li class="text-warning"><span class="glyphicon glyphicon-lock"></span> Safe & Secure</li>
                        <p>More secure, more confidence</p>
                        <li class="text-warning"><span class="glyphicon glyphicon-time"></span> Save Time</li>
                        <p>Onlie transactions save your time</p>
                        <li class="text-warning"><span class="glyphicon glyphicon-retweet"></span> Transfer Money</li>
                        <p>Safe and reliable</p>
                        <li class="text-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Shop Online</li>
                        <p>Easy and fast</p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    
    
<?php require_once 'app/views/template/afterContent.php';?>