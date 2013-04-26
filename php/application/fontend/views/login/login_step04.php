<h4 class="color_red"><?php echo $step4_title; ?></h4>
<p><?php echo $step4_note; ?></p>
<?php
if (isset($message) and ($message != ''))
    echo "<div class='simple-error'>$message</div>";
?>
<?php echo form_open('login/login_pin/', array('id' => 'sign-up-form')); ?>
<input type="hidden" name="step" value="<?php echo (isset($step) ? $step : 0); ?>" />
<fieldset>
    <label><?php echo $text_login_pin; ?> </label>
    <input type="password" name="pin" id="pin" value="<?php echo set_value('pin'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('pin', '<div class="simple-alert">', '</div>'); ?>    	
<fieldset>
    <input name="login" value="<?php echo $button_login; ?>" class="button small orange Mysubmitted" type="submit" />
    <a href="<?php echo site_url('login/logout'); ?>" class="button small orange Mysubmitted"/><?php echo $button_cancel; ?></a>
</fieldset>    
<p>&nbsp;</p><p>&nbsp;</p>
<?php echo form_close(); ?>
</div>
