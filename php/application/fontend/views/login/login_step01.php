<h4 class="color_red"><?php echo $step1_title; ?></h4>
<p><?php echo $sep1_note; ?></p>
<?php
if (isset($message) and ($message != ''))
    echo "<div class='simple-error'>$message</div>";
?>

<div class="simple-notice"><?php echo $sep1_note2; ?></div>
<?php echo form_open('login', array('id' => 'sign-up-form')); ?>
<input type="hidden" name="step" value="1" />
<fieldset>
    <label><span class="required">*</span><?php echo $text_account_number; ?></label>
    <?php if ($eg_acc_from) { ?>
        <input type="text" name="acc_number" id="acc_number" value="<?php echo $eg_acc_from; ?>" class="text requiredField"/>
    <?php } else { ?>
        <input type="text" name="acc_number" id="acc_number" value="<?php echo set_value('acc_number'); ?>" class="text requiredField"/>
    <?php } ?>
    <a href="<?php echo site_url('user/reset_account/'); ?>"><?php echo $text_forgot; ?></a>
</fieldset>
<fieldset>
    <label>&nbsp;</label>	 
    <p><?php echo form_checkbox('remember', '1', FALSE); ?>
        <?php echo $text_remember_me; ?></p>
</fieldset>
<fieldset>
    <label><span class="required">*</span><?php echo $text_pass; ?></label>
    <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" class="text requiredField" autocomplete="off"/>
    <a href="<?php echo site_url('user/reset_password/'); ?>"><?php echo $text_forgot; ?></a>
</fieldset>
<h6><?php echo $text_enter_capt; ?></h6>
<p><?php echo $text_note_capt; ?></p>
<div class="one-third">
    <div id="img_captcha">
        <?php echo $recaptcha; ?>
    </div>
    <p>&nbsp;</p>
    <fieldset>
        <a onclick="$('#sign-up-form').submit();" class="button small orange Mysubmitted2"><?php echo $button_next; ?></a>
        <?php echo form_close(); ?>
        <?php if ($link_cancel) { ?>
            <div id="inputsci">
                <?php if ($eg_fail_url_method == 'POST') { ?>
                    <form action = "<?php echo $eg_fail_url; ?>" method = "POST" id="failformlogin">
                        <?php foreach ($dataposts as $key => $post) { ?>
                            <?php if ($key != 'eg_acc_from' && $key != 'eg_comments' && $key != 'eg_success_url' && $key != 'eg_success_url_method' && $key != 'eg_fail_url' && $key != 'eg_fail_url_method' && $key != 'eg_status_url' && $key != 'eg_status_url_method' && $key != 'browser' && $key != 'token_sci' && $key != 'eg_status_url_method' && $key != 'ip_user') { ?>
                                <input type = "hidden" name = "<?php echo $key; ?>" value = "<?php echo $post; ?>">
                            <?php } ?>
                        <?php } ?>
                        <a onclick="$('#failformlogin').submit();" class="button small orange inputsci"/><?php echo $button_cancel; ?></a>
                    </form>
                <?php } elseif ($eg_fail_url_method == 'LINK') { ?>
                    <a href="<?php echo $eg_fail_url; ?>" class="button small orange inputsci"/><?php echo $button_cancel; ?></a>
                <?php } else { ?>
                    <a href="<?php echo $url_return_fail; ?>" class="button small orange inputsci"><?php echo $button_cancel; ?></a>
                <?php } ?>
            </div>
        <?php } else { ?>
            <a href="<?php echo $cancel; ?>" class="button small orange Mysubmitted2"><?php echo $button_cancel; ?></a>
        <?php } ?>
    </fieldset>    

</div>
<div class="one-third-big last">
    <p align="center"><h4 align="center"><?php echo $text_no_account; ?></h4></p>
<p align="center"><a href="<?php echo $action_register; ?>" class="button big round green"><?php echo $text_register; ?></a></p>
</div>