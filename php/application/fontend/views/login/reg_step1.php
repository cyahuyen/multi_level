<h4 class="color_red"><?php echo $text_reg_1; ?></h4>
<p><?php echo $text_notice; ?></p>
<div class="simple-notice"><?php echo $text_notice2; ?></div>
<?php echo form_open('user/index/', array('id' => 'sign-up-form')); ?>

<div class="horizontal-line-small"></div>

<h5><?php echo $headding_title; ?><input type="hidden" name="s" value="1" /></h5>

<fieldset>
    <label><span class="required">*</span><?php echo $text_fn; ?></label>
    <input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" class="text requiredField"/>        
</fieldset>
<?php echo form_error('first_name', '<div class="simple-alert">', '</div>'); ?>  

<fieldset>
    <label><span class="required">*</span><?php echo $text_ln; ?> </label>
    <input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('last_name', '<div class="simple-alert">', '</div>'); ?>  

<fieldset>
    <label><span class="required">*</span><?php echo $text_acc_name; ?></label>
    <input type="text" name="acc_name" id="acc_name" value="<?php echo set_value('acc_name'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('acc_name', '<div class="simple-alert">', '</div>'); ?>

<fieldset>
    <label><span class="required">*</span><?php echo $text_email; ?></label>
    <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="text requiredField email"/>
</fieldset>
<?php echo form_error('email', '<div class="simple-alert">', '</div>'); ?>

<fieldset>
    <label><span class="required">*</span><?php echo $text_re_email; ?></label>
    <input type="text" name="email2" id="email2" value="<?php echo set_value('email2'); ?>" class="text requiredField email"/>
</fieldset>
<?php echo form_error('email2', '<div class="simple-alert">', '</div>'); ?>   

<div class="horizontal-line-small"></div>    

<h5><?php echo $text_security_ques; ?></h5>    
<p><?php echo $text_pin_pass; ?></p>      
<fieldset>
    <label><span class="required">*</span><?php echo $text_security; ?></label>
    <select name="question_id" id="question_id">
        <?php if ($questions) { ?>
            <option value="none"><?php echo $text_select; ?></option>
            <?php foreach ($questions as $question) { ?>
                <?php if ($question['question_id'] == $question_id) { ?>
                    <option value="<?php echo $question['question_id']; ?>" selected="selected"><?php echo $question['question']; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $question['question_id']; ?>"><?php echo $question['question']; ?></option>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </select>
    <?php echo form_error('question_id', '<div class="simple-alert">', '</div>'); ?>   
</fieldset>
<fieldset>
    <label><span class="required">*</span><?php echo $text_answer; ?></label>
    <input type="text" name="answer" id="answer" value="<?php echo set_value('answer'); ?>" class="text requiredField subject"/>
</fieldset>
<?php echo form_error('answer', '<div class="simple-alert">', '</div>'); ?>      
<fieldset>
    <label><span class="required">*</span><?php echo $text_personal; ?></label>
    <textarea name="mess" id="mess" rows="5" cols="20"><?php echo set_value('mess'); ?></textarea>
</fieldset>
<?php echo form_error('mess', '<div class="simple-alert">', '</div>'); ?>       							

<div class="horizontal-line-small"></div>    
<h5><?php echo $text_function; ?></h5>    
<p><?php echo $text_enable_api_text; ?></p>   
<fieldset>
    <label><span class="required">*</span><?php echo $text_function; ?></label>
    <select id="af" name="af">
        <option value="0" selected="selected"><?php echo $text_disable_api; ?></option>
        <option value="1"><?php echo $text_anable_api; ?></option>
    </select>
</fieldset>     
<fieldset>
    <h6><?php echo $text_captch; ?></h6>
    <p><?php echo $text_notice3; ?></p>

    <?php
    echo form_error('recaptcha_response_field', "<div class='simple-alert'>", '</div>');
    ?>
    <div id="img_captcha">
        <?php echo $recaptcha; ?>
    </div>
    <p><?php echo $text_agree; ?></p>
</fieldset>       								
<fieldset>
    <input name="Mysubmitted" id="Mysubmitted" value="<?php echo $button_agree; ?>" class="button small orange" type="submit"/>
    <input name="Mysubmitted" id="Mysubmitted" value="<?php echo $button_disagree; ?>" class="button small orange" type="submit"/>
</fieldset>    
<?php echo form_close(); ?>