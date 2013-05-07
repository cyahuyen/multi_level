<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:20px"><span></span></td>
            <td style="width:110px"><span>Person name</span></td>
            <td style="width:110px"><span>Sign-in name</span></td>
            <td style="width:80px"><span>User type</span></td>
            <td style="width:80px"><span>Email</span></td>
            <td style="width:80px"><span>Phone</span></td>
            <td style="width:60px"><span>Status</span></td>
            <td style="width:80px"><span>Actions</span></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr class="row" id="row_<?php echo $user->user_id; ?>"> 
                <td onClick="window.location='<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><span></span></td>
                <td onClick="window.location='<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><span><?php echo $user->fullname; ?></span></td>
                <td onClick="window.location='<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><span><?php echo $user->usertype; ?></span></td>
                <td onClick="window.location='<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><span><?php echo $user->email; ?></span></td>
                <td onClick="window.location='<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><span><?php echo $user->phone; ?></span></td>
                <td onClick="window.location='<?php echo site_url('adminuser/profile'); ?>/<?php echo $user->user_id; ?>'"><span>Active</span></td>
                <td><span>
                        <?php if($user->status == 1){ ?>
                        <a href="javascript:void(0);" class="deactivate" id="disable_<?php echo $user->user_id; ?>" rel="<?php echo $user->user_id; ?>"><img src='<?php echo base_url(); ?>img/actions/deactivate.png' alt='Deactivate' title='De-activate'/></a>
                        <?php }else{ ?>
                        <a href="javascript:void(0);" class="activate" id="disable_<?php echo $user->user_id; ?>" rel="<?php echo $user->user_id; ?>"><img src='<?php echo base_url(); ?>img/actions/activate.png' alt='Activate' title='Activate'/></a>
                        <?php } ?>
                    </span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>