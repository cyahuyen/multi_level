<table>
    <tbody><tr class="heading">
            <td style="width:40px"><div>Id</div></td>
            <td style="width:220px"><div>Name</div></td>
            <td style="width:80px"><div>Phone</div></td>
            <td style="width:80px"><div>Mobile</div></td>
            <td style="width:100px"><div>Email</div></td>
            <td style="width:60px"><div>Status</div></td>
            <td style="width:40px"><div>Actions</div></td>
        </tr>
        <?php foreach ($staffs as $staff) { ?>
            <tr class="row">
                <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->id ?></div></td>
                <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->name ?></div></td>
                <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->mobile ?></div></td>
                <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->phone ?></div></td>
                <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->email ?></div></td>
                <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo!empty($staff->status) ? 'Active' : 'Deactive' ?></div></td>
                <td>
                    <?php if (!empty($staff->status)) { ?>
                        <div>
                            <a class="deactive" rel="<?php echo $staff->id ?>">
                                <img title="De-activate" alt="Deactivate" src="<?php echo base_url() ?>/img/actions/deactivate.png">
                            </a>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>