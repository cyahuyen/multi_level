<h4 class="color_red"><?php echo $res3_title; ?></h4>
<div class="simple-notice"><?php echo $renum_note; ?></div>
<p class="coloredB"><?php echo $res3_notice; ?></p>
<?php
if (isset($message) and ($message != ''))
    echo "<div class='simple-error'>$message</div>";
echo form_open('user/reset_password/', array('id' => 'sign-up-form'));
?>
<input type="hidden" name="step" value="3" />
<div style="clear: both;"></div>
<fieldset>
    <label><span class="required">*</span><?php echo $res3_new_pass; ?></label>
    <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" class="text requiredField"/>&nbsp;(at least 6 characters)
</fieldset>
<?php echo form_error('password', '<div class="simple-alert">', '</div>'); ?>    
<fieldset>
    <label><span class="required">*</span><?php echo $res3_confirm; ?></label>
    <input type="password" name="password2" id="password2" value="<?php echo set_value('password2'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('password2', '<div class="simple-alert">', '</div>'); ?>   
<div class="horizontal-line-small"></div>  
<input name="email" type="hidden" value="<?php echo $email; ?>" />
<input name="acc_number" type="hidden" value="<?php echo $acc_number; ?>" />
<fieldset>
    <label><span class="required">*</span><?php echo $res3_pin; ?></label>
    <input type="password" name="login_pin" id="login_pin" value="<?php echo set_value('login_pin'); ?>" class="text requiredField"/>&nbsp;(5 numeric characters)
</fieldset>
<?php echo form_error('login_pin', '<div class="simple-alert">', '</div>'); ?>    
<fieldset>
    <label><span class="required">*</span><?php echo $res3_con_pin; ?></label>
    <input type="password" name="login_pin2" id="login_pin2" value="<?php echo set_value('login_pin2'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('login_pin2', '<div class="simple-alert">', '</div>'); ?>   
<div class="horizontal-line-small"></div>  
<fieldset>
    <label><span class="required">*</span><?php echo $res3_master; ?></label>
    <input type="password" name="master_key" id="master_key" value="<?php echo set_value('master_key'); ?>" class="text requiredField"/>
    &nbsp;(3 numeric characters) 
</fieldset>
<?php echo form_error('master_key', '<div class="simple-alert">', '</div>'); ?>    
<fieldset>
    <label><span class="required">*</span><?php echo $res3_con_master; ?></label>
    <input type="password" name="master_key2" id="master_key2" value="<?php echo set_value('master_key2'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('master_key2', '<div class="simple-alert">', '</div>'); ?>  

<p>&nbsp;</p>       								
<fieldset>
    <input name="Change" value="<?php echo $button_change; ?>" class="button small orange Mysubmitted" type="submit"/>
</fieldset>  

<?php echo form_close(); ?>