<h4 class="color_red"><?php echo $renum_title; ?></h4>
<p><?php echo $renum_notice1; ?></p>

<h6><?php echo $renum_notice2; ?></h6>

<div class="simple-notice"><?php echo $renum_notice3; ?></div>

<?php
if (isset($message) and ($message != ''))
    echo "<div class='simple-error'>$message</div>";
echo form_open('user/reset_account/', array('id' => 'sign-up-form'));
?>
<div class="horizontal-line-small"></div>
<h5><?php echo $renum_acc_info; ?></h5>    
<fieldset>
    <label><span class="required">*</span><?php echo $renum_your_mail; ?> </label>
    <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="text requiredField email"/>
</fieldset>
<input type="hidden" name="step" value="1" />
<?php echo form_error('email', '<div class="simple-alert">', '</div>'); ?>   
<p>&nbsp;</p>     
<fieldset>
    <h6><?php echo $renum_enter_code; ?></h6>
    <p><?php echo $renum_note; ?></p>
    <?php
    echo form_error('recaptcha_response_field', "<div class='simple-alert'>", '</div>');
    ?>
    <div id="img_captcha">
        <?php echo $recaptcha; ?>
    </div>
    <p><?php echo $renum_notice4; ?></p>
</fieldset>       								
<fieldset>
    <input name="Agree" value="<?php echo $button_agree; ?>" class="button small orange Mysubmitted" type="submit"/>
    <input name="Disagree" value="<?php echo $button_disagree; ?>" class="button small orange Mysubmitted" type="submit"/>
</fieldset>    
<?php echo form_close(); ?>