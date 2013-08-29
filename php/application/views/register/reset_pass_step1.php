
<?php echo form_open('register/forgot', array('id' => 'sign-up-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Reset Password step 1/4</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Username: </div></td>
            <td>
                <input name="username" type="text" id="username" style="width:300px" value="<?php echo !empty($posts['username'])?$posts['username']:''; ?>" />
                <span class="fr-error"><?php echo form_error('username'); ?></span>
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
