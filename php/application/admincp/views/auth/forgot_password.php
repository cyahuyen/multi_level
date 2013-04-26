<h1><?php echo $forgot_pass; ?></h1>
<p><?php echo $forgot_noti; ?></p>

<div id="infoMessage"><?php echo $message; ?></div>

<?php echo form_open("auth/forgot_password"); ?>

<p><?php echo $forgot_email; ?><br />
    <?php echo form_input($email); ?>
</p>

<p><?php echo form_submit('submit', 'Submit'); ?></p>
<?php echo form_close(); ?>