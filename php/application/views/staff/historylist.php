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
        <?php foreach ($staffs as $staff) { ?>
            <tr class="row">
                <td ><div><?php echo $staff->job_id ?></div></td>
                <td ><div>
                        <?php echo $staff->title ?>
                    </div></td>
                <td ><div> <?php echo $staff->title ?></div></td>
                <td ><div><?php echo $staff->location ?></div></td>
                <td ><div><?php echo date('d/m/Y', strtotime(str_replace('/', '-', $staff->created_date))) ?></div></td>
                <td ><div><?php echo date('d/m/Y', strtotime(str_replace('/', '-', $staff->start_date))) ?></div></td>
                <td ><div><?php echo $staff->days ?></div></td>
                <td ><div><?php echo $staff->status ?></div></td>
                <td>
                    <div>
                        <a class="deactivate" href="javascript:void(0)" rel="<?php echo $staff->id ?>">
                            <img title="De-activate" alt="Deactivate" src="<?php echo base_url() ?>/img/actions/deactivate.png">
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>