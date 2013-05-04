<?php echo form_open('account/edit', array('id' => 'sign-up-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Edit Account</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>FullName: </div></td>
            <td>
                <input type="text" name="fullname"  id="fullname" value="<?php echo set_value('fullname', $fullname); ?>" style="width:300px">
                <span class="fr-error"><?php echo form_error('fullname'); ?></span>
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
                <input name="old_email" type="hidden" id="old_email" style="width:300px" value="<?php echo $email; ?>" />
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
            <td colspan="2">
                <div style="padding-left: 150px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Save">
                    <a href="<?php echo site_url('account/index') ?>" class="button">Cancel</a>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>