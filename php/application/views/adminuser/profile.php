<?php if (!empty($userdata->id)) { ?>
    <script>
        $(document).ready(function() {
            $('#deactivate-btn').live('click', function() {
                if (!confirm('Confirm request to de-activate user?'))
                    return false;
                var id = $(this).attr('rel');
                var e = $(this);
                $.ajax({
                    type: "post",
                    data: {id: "<?php echo$userdata->id ?>"},
                    url: "<?php echo site_url('user/deactive') ?>",
                    success: function(data) {
                        //window.location = "<?php echo site_url('user/manage') ?>"
                        showmessage('info', 'User de-activated', 'The user has now been de-activated')
                    }
                });
            });
            $('#reactivate-btn').live('click', function() {
                if (!confirm('Confirm request to re-activate user?'))
                    return false;
                var id = $(this).attr('rel');
                var e = $(this);
                $.ajax({
                    type: "post",
                    data: {id: "<?php echo$userdata->id ?>"},
                    url: "<?php echo site_url('user/active') ?>",
                    success: function(data) {
                        //window.location = "<?php echo site_url('user/manage') ?>"
                        showmessage('info', 'User re-activated', 'The user has now been re-activated')
                    }
                });
            });
        })
    </script>
<?php } ?>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <?php if (!empty($userdata->id)) { ?>
                <h1>View/Edit User</h1>
                <span><?php echo!empty($userdata->fullname) ? $userdata->fullname : '' ?> ( <?php echo!empty($userdata->usertype) ? $userdata->usertype : '' ?> )</span>
            <?php } else { ?>
                <h1>Add User</h1>
<?php } ?>
        </div>
        <div class="content-actions">
            <input type="submit" value="Save" class="button" name="save-btn" id="save-btn">
            <a class="button checkdirty" href="<?php echo site_url('user/manage') ?>">Cancel</a>
            <?php if (!empty($userdata->id)) { ?>
                <?php if ($userdata->status == '1') { ?>
                    <input type="button" value="De-activate" class="button" name="deactivate-btn" id="deactivate-btn">
                <?php } else { ?>
                    <input type="button" value="Re-activate" class="button" name="reactivate-btn" id="reactivate-btn">
                <?php
                }
            }
            ?>
        </div>
    </div>
    <br><br>
    <table class="datatable">
        <tbody>
            <tr>
                <td>status</td>
                <td>
<?php echo (isset($userdata->status) && $userdata->status == '0') ? 'Deactive' : 'Active'; ?>            
                </td>
            </tr>
            <tr>
                <td>Full name</td>
                <td>
                    <input type="text" style="width:240px" class="mandatory" value="<?php echo!empty($userdata->fullname) ? $userdata->fullname : '' ?>" name="fullname" id="fullname"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" style="width:240px" class="mandatory" value="" name="password" id="password"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>               
            <tr>
                <td>Repassword</td>
                <td>
                    <input type="password" style="width:240px" class="mandatory" value="" name="repassword" id="repassword"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>               
            <tr>
                <td>Permission</td>
                <td>
                    <select onchange="" style="width:160px" id="permission" name="permission">
                        <option  value="">-- Select --</option>
                        <option <?php echo(!empty($userdata->permission) && $userdata->permission == 'administrator') ? 'selected' : '' ?> value="administrator">Administrator</option>
                    </select>

                </td>
            </tr>
            <tr>
                <td>User type</td>
                <td>
                    <select onchange="" style="width:160px" id="usertype" name="usertype">
<?php foreach ($usertype as $key => $val) { ?>
                            <option value="<?php echo $key ?>" <?php echo(!empty($userdata->usertype) && ($key == $userdata->usertype)) ? 'selected' : '' ?>><?php echo $val ?></option>
<?php } ?>
                    </select>

                </td>
            </tr>

            <tr>
                <td>email</td>
                <td>
                    <input type="text" style="width:240px" class="mandatory" value="<?php echo!empty($userdata->email) ? $userdata->email : '' ?>" name="email" id="email"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>
            <tr>
                <td>birthday</td>
                <td>
                    <input type="text" style="width:240px" class="mandatory" value="<?php echo!empty($userdata->birthday) ? $userdata->birthday : '' ?>" name="birthday" id="birthday">
                    <script>$("#birthday").datepicker({dateFormat: "yy-mm-dd"});</script>
                </td>
            </tr>
            <tr>
                <td>phone</td>
                <td>
                    <input type="text" style="width:180px" value="<?php echo!empty($userdata->phone) ? $userdata->phone : '' ?>" name="phone" id="phone" >
                </td>
            </tr>

            <tr>
                <td>fax</td>
                <td>
                    <input type="text" style="width:180px" value="<?php echo!empty($userdata->fax) ? $userdata->fax : '' ?>" name="fax" id="fax" >
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <textarea style="width:240px" name="address"><?php echo!empty($userdata->address) ? $userdata->address : '' ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
</form>