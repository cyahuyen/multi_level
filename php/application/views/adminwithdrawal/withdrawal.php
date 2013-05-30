<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:100px;"><div>#</div></td>
            <td style="width:110px"><div>Email</div></td>
            <td style="width:200px"><div>Full name</div></td>
            <td style="width:80px"><div>Amount</div></td>
            <td style="width:80px"><div>Fees</div></td>
            <td style="width:80px"><div>Total</div></td>
            <td style="width:80px"><div>Email Paypal</div></td>
            <td style="width:80px"><div>Requested Date</div></td>
            <td style="width:80px"><div>Confirmed Date</div></td>
            <td style="width:60px"><div>Status</div></td>
            <td style="width:100px"><div>Action</div></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($wallists as $wallist) { ?>
            <tr class="row" id="row_<?php echo $wallist->id; ?>"> 
                <td ><div><?php echo $wallist->username; ?></div></td>
                <td><div><?php echo $wallist->email; ?></div></td>

                <td><div><?php echo $wallist->firstname . ' ' . $wallist->lastname; ?></div></td>

                <td><div>$<?php echo number_format(($wallist->total -  $wallist->fees), 2, '.', ' '); ?></div></td>
                
                <td><div>$<?php echo number_format($wallist->fees, 2, '.', ' '); ?></div></td>
                
                <td><div>$<?php echo number_format($wallist->total, 2, '.', ' '); ?></div></td>

                <td><div><?php echo $wallist->email_paypal; ?></div></td>

                <td><div><?php echo $wallist->created; ?></div></td>

                <td><div><?php echo $wallist->confirm_date; ?></div></td>

                <td>
                    <?php
                    if ($wallist->payment_status == 1)
                        echo '<span style="color:green">Success</span>';
                    elseif ($wallist->payment_status == 0)
                        echo '<span style="">Process</span>';
                    elseif ($wallist->payment_status == 2)
                        echo '<span style="color:red">Cancel</span>';
                    ?>
                </td>
                <td>
                    <?php if ($wallist->payment_status == 0) { ?>
                        <a href="<?php echo site_url('adminwithdrawal/payment_sucess/' . $wallist->id) ?>">[Payment]</a>&nbsp;
                        <a href="<?php echo site_url('adminwithdrawal/payment_cancel/' . $wallist->id) ?>">[Cancel]</a>
                    <?php } ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>