<h4 class="color_red"><?php echo $res2_title; ?></h4>

<div class="simple-notice"><?php echo $renum_notice3; ?></div>

<?php
if (isset($message) && ($message != ''))
    echo "<div class='simple-error'>$message</div>";
?>
<?php echo form_open('user/reset_password/', array('id' => 'sign-up-form')); ?>
<input type="hidden" name="step" value="2" />
<fieldset>
    <label><span class="required">*</span><?php echo $res2_account; ?> </label>
    <label class="coloredB"><?php echo $acc_number; ?></label>
    <input name="acc_number" type="hidden" value="<?php echo $acc_number; ?>" />
</fieldset>

<fieldset>
    <label><span class="required">*</span><?php echo $res2_mail; ?> </label>
    <label class="coloredB"><?php echo $email; ?></label>
    <input name="email" type="hidden" value="<?php echo $email; ?>" />
</fieldset>
<fieldset>
    <label><span class="required">*</span><?php echo $res2_resetcode; ?> </label>
    <input type="text" name="reset_code" id="reset_code" value="<?php echo set_value('reset_code'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('reset_code', '<div class="simple-alert">', '</div>'); ?>   
<fieldset>
    <label><span class="required">*</span><?php echo $security_question; ?> </label>
    <input type="text" name="answer" id="answer" value="<?php echo set_value('answer'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('answer', '<div class="simple-alert">', '</div>'); ?>   
<fieldset>
    <label><span class="required">*</span><?php echo $res2_fn; ?></label>
    <input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('first_name', '<div class="simple-alert">', '</div>'); ?>   
<p>&nbsp;</p> 

<p>&nbsp;</p>       								
<fieldset>
    <input name="Verify" value="<?php echo $button_verify_code; ?>" class="button small orange Mysubmitted" type="submit"/>
</fieldset>  

<?php echo form_close(); ?>