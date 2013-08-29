<?php echo form_open('register/forgot', array('id' => 'sign-up-form')); ?>
<input type="hidden" name="step" value="3" />
<input name="email" type="hidden" value="<?php echo $username; ?>" />
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Reset Password step 3/4</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>New Password: </div></td>
            <td>
                <input name="password" type="password" id="password" style="width:300px" value="<?php echo set_value('password'); ?>" />
                <span class="fr-error"><?php echo form_error('password'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Re Password: </div></td>
            <td>
                <input name="repassword" type="password" id="repassword" style="width:300px" value="<?php echo set_value('repassword'); ?>" />
                <span class="fr-error"><?php echo form_error('repassword'); ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Save">
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>
