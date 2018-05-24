<nav class="navbar navbar-default">
    <div class="container ">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <div id="logo">
                <img src="<?php echo Configuration::BASE; ?>/assets/images/logo2.svg" alt="logo">
            </div>  
            <div>
                <a class="navbar-brand" href="<?php echo Configuration::BASE; ?>">eBanking</a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo Configuration::BASE; ?>home">Home</a></li>
                <li><a href="<?php echo Configuration::BASE; ?>about-us">About Us</a></li>
                <li><a href="<?php echo Configuration::BASE; ?>contact-us">Contact Us</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if(Session::get('user_logged_in') != NULL) : ?>
                <li><a href="#">Welcome <?php echo Session::get('first_name') . ' ' . Session::get('last_name');?></a></li>
                <li><a href="<?php echo Configuration::BASE; ?>logout">Logout</a></li>

                <?php else: ?>
                      <li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                      <li><a href="contact-us"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>


<?php if (isset($DATA['error_message'])): ?>
<div class="alert alert-danger">
    <?php echo htmlspecialchars($DATA['error_message']); ?>
</div>
<?php endif; ?>

<?php if (isset($DATA['success_message'])): ?>
<div class="alert alert-success">
    <?php echo htmlspecialchars($DATA['success_message']); ?>
</div>
<?php endif; ?>
