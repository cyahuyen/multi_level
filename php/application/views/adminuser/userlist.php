<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:20px;text-align: center;"><div>#</div></td>
            <td style="width:110px"><div>Full Name</div></td>
            <td style="width:80px"><div>User type</div></td>
            <td style="width:110px"><div>Email</div></td>
            <td style="width:80px"><div>Phone</div></td>
            <td style="width:60px"><div>Status</div></td>
            <td style="width:60px"><div>Active</div></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr class="row" id="row_<?php echo $user->user_id; ?>"> 
                <td style="text-align: center;"><div><?php echo $user->user_id; ?></div></td>
                <td onClick="window.location = '<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><div><?php echo $user->fullname; ?></div></td>
                <td><div><?php
                        if ($user->usertype == 2) {
                            echo 'Gold';
                        } elseif ($user->usertype == 2) {
                            echo 'Silver';
                        } else {
                            echo 'Member';
                        }
                        ?></div></td>
                <td><div><?php echo $user->email; ?></div></td>
                <td><div><?php echo $user->phone; ?></div></td>
                <td><div><?php echo !empty($user->status)?'Active':'De-Active' ?></div></td>
                <td><div>
                        <?php if ($user->status == 1) { ?>
                            <a href="javascript:void(0);" class="activate" id="disable_<?php echo $user->user_id; ?>" rel="<?php echo $user->user_id; ?>"><img src='<?php echo base_url(); ?>img/actions/deactivate.png' alt='Activate' title='Activate'/></a>
                        <?php } else { ?>
                            <a href="javascript:void(0);" class="deactivate" id="disable_<?php echo $user->user_id; ?>" rel="<?php echo $user->user_id; ?>"><img src='<?php echo base_url(); ?>img/actions/activate.png' alt='Deactivate' title='Deactivate'/></a>
                            <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>