<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
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
                <input type="text" name="fullname"  id="fullname" value="<?php echo!empty($userdata->fullname) ? $userdata->fullname : '' ?>" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>Address: </div></td>
            <td>
                <input name="address" type="text" id="address" style="width:300px" value="<?php echo!empty($userdata->address) ? $userdata->address : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Phone: </div></td>
            <td>
                <input name="phone" type="text" id="phone" style="width:300px" value="<?php echo!empty($userdata->phone) ? $userdata->phone : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <input name="email" type="text" id="email" style="width:300px" value="<?php echo!empty($userdata->email) ? $userdata->email : '' ?>" />
                <input name="old_email" type="hidden" id="old_email" style="width:300px" value="<?php echo!empty($userdata->email) ? $userdata->email : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Fax: </div></td>
            <td>
                <input name="fax" type="text" id="fax" style="width:300px" value="<?php echo!empty($userdata->fax) ? $userdata->fax : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Birthday: </div></td>
            <td>
                <input name="birthday" type="text" id="birthday" style="width:300px" value="<?php echo!empty($userdata->birthday) ? $userdata->birthday : '' ?>" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="padding-left: 150px;">
                    <input type="submit" value="Save" class="button" name="save-btn" id="save-btn">
                    <a href="<?php echo site_url('account/index') ?>" class="button">Cancel</a>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>