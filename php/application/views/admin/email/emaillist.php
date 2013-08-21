<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:20px;text-align: center;"><div>#</div></td>
            <td style="width:110px"><div>Code</div></td>
            <td style="width:80px"><div>Subject</div></td>
            <td style="width:60px"><div>Active</div></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($emails as $emaill) { ?>
            <tr class="row" id="row_<?php echo $emaill->id; ?>"> 
                <td style="text-align: center;"><div><?php echo $emaill->id; ?></div></td>
                <td onClick="window.location = '<?php echo admin_url('email/profile'); ?>/<?php echo $emaill->id; ?>'"><div><?php echo $emaill->code; ?></div></td>

                <td><div><?php echo $emaill->subject; ?></div></td>

                <td><div>
                        <a href="javascript:void(0);" class="deactivate" id="disable_<?php echo $emaill->id; ?>" rel="<?php echo $emaill->id; ?>"><img src='<?php echo base_url(); ?>img/actions/deactivate.png' alt='De-activate' title='De-activate'/></a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>