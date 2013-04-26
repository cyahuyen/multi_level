<h1><?php echo $change_pass; ?></h1>

<div id="infoMessage"><?php echo $message; ?></div>

<?php echo form_open("auth/change_password"); ?>

<p><?php echo $change_old; ?><br />
    <?php echo form_input($old_password); ?>
</p>

<p><?php echo $change_new; ?><br />
    <?php echo form_input($new_password); ?>
</p>

<p> <?php echo $change_confirm; ?><br />
    <?php echo form_input($new_password_confirm); ?>
</p>

<?php echo form_input($user_id); ?>
<p><?php echo form_submit('submit', 'Change'); ?></p>

<?php echo form_close(); ?>