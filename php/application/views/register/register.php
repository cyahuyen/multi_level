<?php echo form_open('register/index', array('id' => 'sign-up-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Register User</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="<?php echo site_url('register/forgot') ?>">(if you forgot password ?)</a></td>
        </tr>
        <tr>
            <td><div>FullName: </div></td>
            <td>
                <input type="text" name="fullname" id="job-customer" value="<?php echo set_value('fullname', $fullname); ?>" style="width:300px">
                <span class="fr-error"><?php echo form_error('fullname'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>UserName: </div></td>
            <td>
                <input type="text" name="username" id="job-customer" value="<?php echo set_value('username', $username); ?>" style="width:300px">
                <span class="fr-error"><?php echo form_error('username'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Password: </div></td>
            <td>
                <input name="password" type="password" id="password" style="width:300px" value="" />
                <span class="fr-error"><?php echo form_error('password'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Confirm Password: </div></td>
            <td>
                <input name="repassword" type="password" id="repassword" style="width:300px" value="" />
                <span class="fr-error"><?php echo form_error('repassword'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Address: </div></td>
            <td>
                <input name="address" type="text" id="address" style="width:300px" value="<?php echo set_value('address', $address); ?>" />
                <span class="fr-error"><?php echo form_error('address'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Phone: </div></td>
            <td>
                <input name="phone" type="text" id="phone" style="width:300px" value="<?php echo set_value('phone', $phone); ?>" />
                <span class="fr-error"><?php echo form_error('phone'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <input name="email" type="text" id="email" style="width:300px" value="<?php echo set_value('email', $email); ?>" />
                <span class="fr-error"><?php echo form_error('email'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Fax: </div></td>
            <td>
                <input name="fax" type="text" id="fax" style="width:300px" value="<?php echo set_value('fax', $fax); ?>" />
                <span class="fr-error"><?php echo form_error('fax'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Birthday: </div></td>
            <td>
                <input name="birthday" type="text" id="birthday" style="width:300px" value="<?php echo set_value('birthday', $birthday); ?>" />
                <span class="fr-error"><?php echo form_error('birthday'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Referring Member: </div></td>
            <td>
                <input name="referring" type="text" id="referring" style="width:300px" value="<?php echo set_value('referring', $referring); ?>" />
                <span class="fr-error"><?php echo form_error('referring'); ?></span>
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
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Save">
                    <input type="reset" id="save-btn" name="save-btn" class="button" value="Reset">
                </div>
            </td>
        </tr>

    </tbody>
</table>
<?php echo form_close(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#referring").autocomplete({
            source: "<?php echo site_url('register/get_suggest') ?>"
        });
    });
</script>
