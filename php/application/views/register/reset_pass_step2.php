<?php echo form_open('register/forgot', array('id' => 'sign-up-form')); ?>
<input type="hidden" name="step" value="2" />
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Reset Password step 2/4</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Your Email: </div></td>
            <td>
                <input name="email" type="text" id="password" style="width:300px" value="<?php echo set_value('email', $email); ?>" />
                <span class="fr-error"><?php echo form_error('email'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Reset code: </div></td>
            <td>
                <input name="reset_code" type="text" id="reset_code" style="width:300px" value="<?php echo set_value('reset_code'); ?>" />
                <span class="fr-error"><?php echo form_error('reset_code'); ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Verify code">
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>
