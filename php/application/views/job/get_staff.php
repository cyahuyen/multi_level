<tr class="row">
    <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'">
        <input type="hidden" name="staff_id[]" value="<?php echo $staff->id ?>">
        <div><?php echo $staff->name ?></div>
    </td>
    <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->mobile ?></div></td>
    <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->phone ?></div></td>
    <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->email ?></div></td>
    <td>
        <div>
            <a onclick="if (!confirm('Confirm request to unassign staff member?')) { return false; }else{$(this).parent().parent().parent().remove();return false;}" href="javascript:void(0)">
                <img title="Unassign" alt="Unassign" src="<?php echo base_url() ?>/img/actions/deactivate.png">
            </a>
        </div>
    </td>
</tr>