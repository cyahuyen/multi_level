<?php if (!empty($userdata->id)) { ?>
    <script>
        $(document).ready(function(){
            
            $('#deactivate-btn').live('click',function(){
                if (!confirm('Confirm request to de-activate staff member?')) return false;
                var id = $(this).attr('rel');
                var e = $(this);
                $.ajax({  
                    type:"post",
                    data:{id:"<?php echo$userdata->id ?>"},
                    url:"<?php echo site_url('user/deactive') ?>",
                    success: function(data){
                        window.location = "<?php echo site_url('user/manage') ?>"
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
                <input type="button" value="De-activate" class="button" name="deactivate-btn" id="deactivate-btn">
            <?php } ?>
        </div>
    </div>
    <br><br>
    <table class="datatable">
        <tbody>
            <tr>
                <td>status</td>
                <td>
                    Active            
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
                <td>type</td>
                <td>
                    <select onchange="showFranchise(this.value)" style="width:160px" id="usertype" name="usertype">
                        <option <?php echo(!empty($userdata->usertype) && $userdata->usertype == 'Administrator') ? 'selected' : '' ?> value="Administrator">Administrator</option>
                        <option <?php echo(!empty($userdata->usertype) && $userdata->usertype == 'StaffManager') ? 'selected' : '' ?> value="StaffManager">Staff Manager</option>
                        <option <?php echo(!empty($userdata->usertype) && $userdata->usertype == 'Staff') ? 'selected' : '' ?> value="Staff">Staff</option>
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
                <td>phone</td>
                <td>
                    <input type="text" style="width:180px" value="<?php echo!empty($userdata->phone) ? $userdata->phone : '' ?>" name="phone" id="phone" >
                </td>
            </tr>
            <tr>
                <td>mobile</td>
                <td>
                    <input type="text" style="width:180px" value="<?php echo!empty($userdata->mobile) ? $userdata->mobile : '' ?>" name="mobile" id="mobile" >
                </td>
            </tr>
        </tbody>
    </table>
</form>