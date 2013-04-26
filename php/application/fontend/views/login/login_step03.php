<h4 class="color_red"><?php echo $step3_title; ?></h4>
<p><?php echo $step3_notice; ?></p>
<?php
if (isset($message) and ($message != ''))
    echo "<div class='simple-error'>$message</div>";
?>
<h5><b><?php echo $step3_notice2; ?></b></h5>

<p align="center"><input name="one_pin" value="Pay from your wallet" class="button small grey round Mysubmitted" type="submit" disabled="disabled"/><p>
<h4 class="color_red"><?php echo $text_account_balance; ?></h4>
<?php foreach ($currencies as $currencie) { ?>
    <fieldset>
        <label><b><?php echo $currencie->title; ?>:</b> </label>
        <label class="currency"><?php echo $currencie->blance; ?></label>         
    </fieldset>
<?php } ?>
<p><?php echo $step3_notice3; ?></p>
<?php echo form_open('login/login_pin/', array('id' => 'sign-up-form')); ?>
<fieldset>  
    <input type="hidden" name="step" value="<?php echo (isset($step) ? $step : 0); ?>" />
    <input name="one_pin" value="<?php echo $button_login_pin; ?>" class="button small orange Mysubmitted" type="submit" />
    <input name="one_time_pin" value="<?php echo $button_one_pin; ?>" class="button small grey Mysubmitted" type="submit" disabled="disabled"/>
    <a href="<?php echo site_url('login/logout'); ?>" class="button small orange Mysubmitted"/><?php echo $button_cancel; ?></a>
</fieldset>    
<?php echo form_close(); ?>

</div>
