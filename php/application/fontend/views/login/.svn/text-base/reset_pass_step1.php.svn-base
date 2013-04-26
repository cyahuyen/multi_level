<h4 class="color_red"><?php echo $repass_title; ?></h4>
<p><?php echo $repass_notice1; ?></p>

<h6><?php echo $renum_notice2; ?></h6>

<div class="simple-notice"><?php echo $renum_notice3; ?></div>

<?php
if (isset($message) && ($message != ''))
    echo "<div class='simple-error'>$message</div>";
?>
<?php echo form_open('user/reset_password/', array('id' => 'sign-up-form')); ?>
<input type="hidden" name="step" value="1" />
<fieldset>
    <label><span class="required">*</span><?php echo $repass_acc_number; ?> </label>
    <input type="text" name="acc_number" id="acc_number" value="<?php echo set_value('acc_number'); ?>" class="text requiredField"/> 
    <a href="<?php echo site_url('user/reset_account/'); ?>"> (Forgot it?) </a>
</fieldset>
<?php echo form_error('acc_number', '<div class="simple-alert">', '</div>'); ?>     
<fieldset>
    <label><span class="required">*</span><?php echo $repass_email; ?> </label>
    <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="text requiredField email"/>
</fieldset>
<?php echo form_error('email', '<div class="simple-alert">', '</div>'); ?>   
<h6><?php echo $renum_enter_code; ?></h6>
<p><?php echo $renum_note; ?></p>
<?php echo form_error('recaptcha_response_field', "<div class='simple-alert'>", '</div>'); ?>
<p><div id="img_captcha"><?php echo $recaptcha; ?></div></p>
<fieldset>
    <input name="Agree" value="<?php echo $button_send_code; ?>" class="button small orange Mysubmitted" type="submit"/>
    <input name="Disagree" value="<?php echo $button_verify; ?>" class="button small orange Mysubmitted" type="submit"/>
</fieldset>  
<?php echo form_close(); ?>