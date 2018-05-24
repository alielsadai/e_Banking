<?php require 'app/views/template/beforeContent.php';?>
<?php require 'app/views/template/mainMenu.php';?>

<div class="text-center">
     <h1>Welcome To Our eBanking </h1>
     <p class="lead">Manage your finance in the best way, feel safe and secure</p>
     <p class="lead">With us, Now Worries!</p>
</div>

<div id="buttons" class="center-block">
    <?php if (Session::get('user_type') == 'Admin') : ?>
        <a href="<?php echo Configuration::BASE ?>admin/index" class="btn btn-default">Manage Users</a>
        <a href="<?php echo Configuration::BASE ?>profile" class="btn btn-default">View Accounts</a>
    <?php elseif(Session::get('user_type') == 'Client') : ?>
        <a href="<?php echo Configuration::BASE ?>profile/" class="btn btn-default">View Accounts</a>
    <?php endif;?>
</div>
        
<?php require_once 'app/views/template/afterContent.php';?>


