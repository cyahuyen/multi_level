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
                    url: "<?php echo site_url('adminuser/deactive') ?>",
                    success: function(data) {
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
                    url: "<?php echo site_url('adminuser/active') ?>",
                    success: function(data) {
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
            <?php if (!empty($userdata->user_id)) { ?>
                <h1>View/Edit User</h1>
            <?php } else { ?>
                <h1>Add User</h1>
            <?php } ?>
        </div>

        <div class="content-actions">
            <input type="submit" value="Save" class="button" name="save-btn" id="save-btn">
            <a class="button checkdirty" href="<?php echo site_url('adminuser/manager') ?>">Cancel</a>
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
            <?php if (!empty($userdata->user_id)) { ?>
                <tr>
                    <td>User Name</td>
                    <td>
                        <?php echo $userdata->username; ?>            
                    </td>
                </tr>
                <tr>
                    <td>User Type</td>
                    <td>
                        <?php
                        if ($userdata->permission == 'administrator') {
                            echo 'Administrator';
                        } elseif ($userdata->usertype == 2) {
                            echo 'Gold';
                        } elseif ($userdata->usertype == 1) {
                            echo 'Silver';
                        } else {
                            echo 'Member';
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td>Status</td>
                <td>
                    <?php echo (isset($userdata->status) && $userdata->status == '0') ? 'Deactive' : 'Active'; ?>            
                </td>
            </tr>
            <tr>
                <td>FirstName: </td>
                <td>
                    <input type="text" style="width:300px" value="<?php echo!empty($userdata->firstname) ? $userdata->firstname : '' ?>" id="firstname" class="mandatory" name="firstname"><img class="mandatory" src="http://multilevel.lc/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>
            <tr>
                <td><div>LastName: </div></td>
                <td>
                    <input type="text" style="width:300px" value="<?php echo!empty($userdata->lastname) ? $userdata->lastname : '' ?>" id="lastname" class="mandatory" name="lastname"><img class="mandatory" src="http://multilevel.lc/img/sev/required.jpg" title="This is a required value">
                    <span class="fr-error"></span>
                </td>
            </tr>            

            <tr>
                <td><div>Address: </div></td>
                <td>
                    <input type="text" value="<?php echo!empty($userdata->address) ? $userdata->address : '' ?>" style="width:300px" id="address" name="address">
                    <span class="fr-error"></span>
                </td>
            </tr>
            <tr>
                <td><div>Phone: </div></td>
                <td>
                    <input type="text" value="<?php echo!empty($userdata->phone) ? $userdata->phone : '' ?>" style="width:300px" id="phone" name="phone">
                    <span class="fr-error"></span>
                </td>
            </tr>
            <tr>
                <td><div>Email: </div></td>
                <td>
                    <input type="text" value="<?php echo!empty($userdata->email) ? $userdata->email : '' ?>" style="width:300px" id="email" class="mandatory" name="email"><img class="mandatory" src="http://multilevel.lc/img/sev/required.jpg" title="This is a required value">
                    <span class="fr-error"></span>
                </td>
            </tr>
        </tbody>
    </table>
</form>