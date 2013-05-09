<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:20px;text-align: center;"><span>#</span></td>
            <td style="width:110px"><span>Full Name</span></td>
            <td style="width:80px"><span>User type</span></td>
            <td style="width:110px"><span>Email</span></td>
            <td style="width:80px"><span>Phone</span></td>
            <td style="width:60px"><span>Status</span></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr class="row" id="row_<?php echo $user->user_id; ?>"> 
                <td style="text-align: center;"><span><?php echo $user->user_id; ?></span></td>
                <td onClick="window.location = '<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><span><?php echo $user->fullname; ?></span></td>
                <td><span><?php
                        if ($user->usertype == 2) {
                            echo 'Gold';
                        } elseif ($user->usertype == 2) {
                            echo 'Silver';
                        } else {
                            echo 'Member';
                        }
                        ?></span></td>
                <td><span><?php echo $user->email; ?></span></td>
                <td><span><?php echo $user->phone; ?></span></td>
                <td><span>
                        <?php if ($user->status == 1) { ?>
                            <a href="javascript:void(0);" class="activate" id="disable_<?php echo $user->user_id; ?>" rel="<?php echo $user->user_id; ?>"><img src='<?php echo base_url(); ?>img/actions/deactivate.png' alt='Activate' title='Activate'/></a>
                        <?php } else { ?>
                            <a href="javascript:void(0);" class="deactivate" id="disable_<?php echo $user->user_id; ?>" rel="<?php echo $user->user_id; ?>"><img src='<?php echo base_url(); ?>img/actions/activate.png' alt='Deactivate' title='Deactivate'/></a>
                            <?php } ?>
                    </span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>