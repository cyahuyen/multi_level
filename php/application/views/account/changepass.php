<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<?php echo form_open('account/changepassword', array('id' => 'sign-up-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Edit Account</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Password: </div></td>
            <td>
                <input name="password" type="password" id="password" style="width:300px" value="<?php echo set_value('password'); ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Confirm Password: </div></td>
            <td>
                <input name="repassword" type="password" id="repass" style="width:300px" value="<?php echo set_value('repassword'); ?>" />
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