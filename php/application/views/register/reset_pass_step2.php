<div id="bodyform">
    <h4 class="color_red">Reset Password Step 2/4</h4>
    <?php
    if (isset($message) && ($message != ''))
        echo "<div class='simple-error'>$message</div>";
    ?>
    <?php echo form_open('user/forgot/', array('id' => 'sign-up-form')); ?>
    <input type="hidden" name="step" value="2" />
    <div class="st-form-line">	
        <span class="st-labeltext">Your Email: </span>	
        <input name="email" type="email" class="st-error-input" id="password" style="width:300px" value="<?php echo set_value('email',$email); ?>" />
        <?php echo form_error('email'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Reset code: </span>	
        <input name="reset_code" type="reset_code" class="st-error-input" id="reset_code" style="width:300px" value="<?php echo set_value('reset_code'); ?>" />
        <?php echo form_error('reset_code'); ?>
        <div class="clear"></div>
    </div>
    <div class="button-box">
        <input name="submit" id="submit" value="Verify code" class="st-clear" type="submit"/>
    </div>      								
    <?php echo form_close(); ?>