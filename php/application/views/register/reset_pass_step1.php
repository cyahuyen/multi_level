
<?php echo form_open('register/forgot', array('id' => 'sign-up-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Reset Password step 1/4</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <input name="email" type="text" id="password" style="width:300px" value="<?php echo set_value('email'); ?>" />
                <span class="fr-error"><?php echo form_error('email'); ?></span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>        
                <div id="img_captcha"><?php echo $recaptcha; ?></div>
                <span class="fr-error"><?php echo form_error('recaptcha_response_field'); ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Submit">
                    <input type="reset" id="save-btn" name="save-btn" class="button" value="Reset">
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>
