<div id="bodyform">
    <?php
    if (isset($message) && ($message != ''))
        echo "<div class='simple-error'>$message</div>";
    ?>
    <?php echo form_open('user/forgot/', array('id' => 'sign-up-form')); ?>
    <input type="hidden" name="step" value="1" />
    <div class="st-form-line">	
        <span class="st-labeltext">Your Email: </span>	
        <input name="email" type="email" class="st-error-input" id="password" style="width:300px" value="<?php echo set_value('email'); ?>" />
        <?php echo form_error('email'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">
        <div id="img_captcha"><?php echo $recaptcha; ?></div>
        <?php echo form_error('recaptcha_response_field'); ?>
    </div>
    <div class="button-box">
        <input name="submit" id="submit" value="Submit" class="st-clear" type="submit"/>
        <input name="submit" id="submit" value="Reset" class="st-clear" type="reset"/>
    </div> 
    <?php echo form_close(); ?>
</div>