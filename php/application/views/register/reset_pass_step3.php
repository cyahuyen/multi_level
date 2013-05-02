<div id="bodyform">
    <h4 class="color_red">Reset Password Step 3/4</h4>
    <?php
    if (isset($message) and ($message != ''))
        echo "<div class='simple-error'>$message</div>";
    echo form_open('user/forgot/', array('id' => 'sign-up-form'));
    ?>
    <input type="hidden" name="step" value="3" />
    <div style="clear: both;"></div>
    <div class="st-form-line">	
        <span class="st-labeltext">New Password: </span>	
        <input name="password" type="password" class="st-error-input" id="password" style="width:300px" value="<?php echo set_value('password'); ?>" />
        <?php echo form_error('password'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Re Password: </span>	
        <input name="repassword" type="password" class="st-error-input" id="repassword" style="width:300px" value="<?php echo set_value('repassword'); ?>" />
        <?php echo form_error('repassword'); ?>
        <div class="clear"></div>
    </div>
    <div class="horizontal-line-small"></div>  
    <input name="email" type="hidden" value="<?php echo $email; ?>" />
    <div class="button-box">
        <input name="submit" id="submit" value="Submit" class="st-clear" type="submit"/>
    </div>    
    <?php echo form_close(); ?>
</div>