<table>
    <tbody><tr class="heading">
            <td style="width:40px"><div>Id</div></td>
            <td style="width:140px"><div>Job</div></td>
            <td style="width:120px"><div>Customer</div></td>
            <td style="width:80px"><div>Location</div></td>
            <td style="width:60px"><div>Created Date</div></td>
            <td style="width:60px"><div>Start Date</div></td>
            <td style="width:20px"><div>Days</div></td>
            <td style="width:60px"><div>Status</div></td>
            <td style="width:40px"><div>Actions</div></td>
        </tr>
        <?php foreach ($jobs as $job) { ?>
            <tr class="row">
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->id ?></div></td>
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->title ?></div></td>
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->customer ?></div></td>
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->location ?></div></td>
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->created_date ?></div></td>
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->start_date ?></div></td>
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->days ?></div></td>
                <td onclick="window.location='<?php echo site_url('job/profile') . '/' . $job->id ?>'"><div><?php echo $job->status ?></div></td>
                <td><div>
                        <a class="deactivate" href="javascript:void(0)" rel="<?php echo $job->id ?>">
                            <img title="Close" alt="Close" src="<?php echo base_url() ?>/img/actions/deactivate.png">
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>