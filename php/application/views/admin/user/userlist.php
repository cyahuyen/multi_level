<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:20px;text-align: center;"><div>#</div></td>
            <td style="width:110px"><div>Username</div></td>
            <td style="width:110px"><div>Full Name</div></td>
            <td style="width:110px"><div>Referred User</div></td>
            <td style="width:110px"><div>Email</div></td>
            <td style="width:80px"><div>Phone</div></td>
            <td style="width:60px"><div>Status</div></td>
            <td style="width:60px"><div>Action</div></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <?php
            $fullname = '';
            $user_data = null;
            if (!empty($user->referring)) {
                $user_data = getMainUserByMainId($user->referring);
                $fullname = $user_data->firstname . ' ' . $user_data->lastname;
            }
            ?>
            <tr class="row" id="row_<?php echo $user->main_id; ?>"> 
                <td style="text-align: center;"><div><?php echo $user->main_id; ?></div></td>
                <td onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo $user->firstname . ' ' . $user->lastname; ?></div></td>
                <td onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo $user->username; ?></div></td>
                <td onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo !empty($user_data)?($user_data->username . '(' . $fullname . ')'):'' ?></div></td>
                <td><div><?php echo $user->email; ?></div></td>
                <td><div><?php echo $user->phone; ?></div></td>
                <td><div><?php echo!empty($user->status) ? 'Active' : 'De-active' ?></div></td>
                <td><div>
                        <?php if ($user->status == 1) { ?>
                            <a href="javascript:void(0);" class="activate" id="disable_<?php echo $user->main_id; ?>" rel="<?php echo $user->main_id; ?>"><img src='<?php echo base_url(); ?>img/actions/deactivate.png' alt='Activate' title='Activate'/></a>
                        <?php } else { ?>
                            <a href="javascript:void(0);" class="deactivate" id="disable_<?php echo $user->main_id; ?>" rel="<?php echo $user->main_id; ?>"><img src='<?php echo base_url(); ?>img/actions/activate.png' alt='Deactivate' title='Deactivate'/></a>
                            <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>