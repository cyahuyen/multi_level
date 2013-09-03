<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:20px;text-align: center;"><div>#</div></td>
            <td style="width:110px"><div>Username</div></td>
            <td style="width:110px"><div>Silver Account</div></td>
            <td style="width:110px"><div>Gold Account</div></td>
            <td style="width:110px"><div>Full Name</div></td>
            <td style="width:110px"><div>Referred User</div></td>
            <td style="width:110px"><div>Email</div></td>
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
            $sNumber = null;
            $gNumber = null;
            $account_list = getAllAcountByMainId($user->main_id);
            foreach ($account_list as $account_info) {
                if ($account_info->usertype == 1) {
                    $sNumber = $account_info->acount_number;
                } elseif ($account_info->usertype == 2) {
                    $gNumber = $account_info->acount_number;
                }
            }
            ?>
            <tr class="row" id="row_<?php echo $user->main_id; ?>"> 
                <td style="text-align: center;"><div><?php echo $user->main_id; ?></div></td>
                <td onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo $user->username; ?></div></td>
                <td style="text-align: center;" onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo $sNumber ?></div></td>
                <td style="text-align: center;" onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo $gNumber ?></div></td>
                <td onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo $user->firstname . ' ' . $user->lastname; ?></div></td>

                <td onClick="window.location = '<?php echo site_url('admin/user/profile'); ?>/<?php echo $user->main_id; ?>'"><div><?php echo!empty($user_data) ? ($fullname . '(' . $user_data->username . ')') : '' ?></div></td>
                <td><div><?php echo $user->email; ?></div></td>
                <td><div><?php echo!empty($user->status) ? 'Active' : 'De-active' ?></div></td>
                <td width="100"><div>
                        <?php if ($user->status == 1) { ?>
                            <a href="javascript:void(0);" class="activate" id="disable_<?php echo $user->main_id; ?>" rel="<?php echo $user->main_id; ?>"><img src='<?php echo base_url(); ?>img/actions/deactivate.png' alt='Activate' title='Activate'/></a>
                        <?php } else { ?>
                            <a href="javascript:void(0);" class="deactivate" id="disable_<?php echo $user->main_id; ?>" rel="<?php echo $user->main_id; ?>"><img src='<?php echo base_url(); ?>img/actions/activate.png' alt='Deactivate' title='Deactivate'/></a>
                            <?php } ?>
                        <a href="<?php echo admin_url('user/manager/' . $user->main_id); ?>" rel="<?php echo $user->main_id; ?>"><img src='<?php echo base_url(); ?>img/actions/manager-icon.png' alt='Rerered User' title='Rerered User'/></a>
                        <a href="<?php echo admin_url('transfer/index/' . $user->main_id); ?>" rel="<?php echo $user->main_id; ?>"><img src='<?php echo base_url(); ?>img/actions/Money-icon.png' alt='Transfer history' title='Transfer history'/></a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>