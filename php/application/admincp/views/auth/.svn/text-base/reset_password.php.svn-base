<h1><?php echo $change_pass; ?></h1>

<div id="infoMessage"><?php echo $message; ?></div>

<?php echo form_open('auth/reset_password/' . $code); ?>

<p><?php echo $change_new; ?> (at least <?php echo $min_password_length; ?> <?php echo $change_char; ?>):<br />
    <?php echo form_input($new_password); ?>
</p>

<p><?php echo $change_confirm; ?><br />
    <?php echo form_input($new_password_confirm); ?>
</p>

<?php echo form_input($user_id); ?>
<?php echo form_hidden($csrf); ?>
<p><?php echo form_submit('submit', 'Change'); ?></p>

<?php echo form_close(); ?>
