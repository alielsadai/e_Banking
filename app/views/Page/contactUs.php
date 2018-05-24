<?php require_once 'app/views/template/beforeContent.php';?>
<?php require_once 'app/views/template/mainMenu.php';?>

<form class="form-horizontal col-lg-10" method="post" action="<?php echo Configuration::BASE ?>contact-us">
        <legend>Contact Us</legend>
        <div class="form-group">
            <label for="first_name" class="col-lg-2 control-label">First Name *</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="last_name" class="col-lg-2 control-label">Last Name *</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-lg-2 control-label">Email *</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="email" placeholder="E-mail" required>
            </div>
        </div>
        <div class="form-group">
            <label for="subject" class="col-lg-2 control-label">Subject *</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-lg-2 control-label">Message *</label>
            <div class="col-lg-10">
                <textarea class="form-control" rows="3" name="message" required></textarea>
            </div>
        </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="submit" value="submit">Send Message</button>
    </div>
    <p>*These fields are requiered fields.</p>
</form>

<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5663.875890920086!2d20.479146099418394!3d44.782070427299644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a70675ad02739%3A0x497cd052aa221dc6!2sDanijelova+32%2C+Beograd!5e0!3m2!1sen!2srs!4v1510174787581" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<?php require_once 'app/views/template/afterContent.php';?>