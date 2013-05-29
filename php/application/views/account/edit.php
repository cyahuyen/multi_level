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
            <td><div>Acount number: </div></td>
            <td>
                <?php echo!empty($userdata->username) ? $userdata->username : '' ?>
            </td>
        </tr>
        <tr>
            <td><div>Firstname: </div></td>
            <td>
                <input type="text" name="firstname"  id="firstname" value="<?php echo!empty($userdata->firstname) ? $userdata->firstname : '' ?>" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>Lastname: </div></td>
            <td>
                <input type="text" name="lastname"  id="firstname" value="<?php echo!empty($userdata->lastname) ? $userdata->lastname : '' ?>" style="width:300px">
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