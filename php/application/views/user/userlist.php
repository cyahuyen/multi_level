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
            <tr class="row" id="row_<?php echo $user->id; ?>"> 
                <td onClick="window.location='<?php echo site_url('user/profile'); ?>/<?php echo $user->id; ?>'"><span></span></td>
                <td onClick="window.location='<?php echo site_url('user/profile'); ?>/<?php echo $user->id; ?>'"><span><?php echo $user->fullname; ?></span></td>
                <td onClick="window.location='<?php echo site_url('user/profile'); ?>/<?php echo $user->id; ?>'"><span><?php echo $user->username; ?></span></td>
                <td onClick="window.location='<?php echo site_url('user/profile'); ?>/<?php echo $user->id; ?>'"><span><?php echo $user->usertype; ?></span></td>
                <td onClick="window.location='<?php echo site_url('user/profile'); ?>/<?php echo $user->id; ?>'"><span><?php echo $user->email; ?></span></td>
                <td onClick="window.location='<?php echo site_url('user/profile'); ?>/<?php echo $user->id; ?>'"><span><?php echo $user->phone; ?></span></td>
                <td onClick="window.location='<?php echo site_url('user/profile'); ?>/<?php echo $user->id; ?>'"><span>Active</span></td>
                <td><span>

                        <?php //$attr = array('onclick'=>"if (!confirm('Confirm request to de-activate User?')) { return false; } else { showmessage('warn', 'User de-actvated', 'The user has been de-activated') }", 'class'=>'activatedeactivate' , 'id'=>'disable_'.$user->id);   ?>
                        <?php // echo anchor('admin/deactivate/?id='.$user->id, "<img src='".base_url()."img/actions/deactivate.png' alt='Deactivate' title='De-activate'/>",$attr);  ?>
                        <a href="javascript:void(0);" class="activatedeactivate" id="disable_<?php echo $user->id; ?>" rel="<?php echo $user->id; ?>"><img src='<?php echo base_url(); ?>img/actions/deactivate.png' alt='Deactivate' title='De-activate'/></a>
                    </span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>