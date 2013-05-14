<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:20px;text-align: center;"><div>#</div></td>
            <td style="width:110px"><div>Email</div></td>
            <td style="width:110px"><div>Full name</div></td>
            <td style="width:110px"><div>Amount</div></td>
            <td style="width:80px"><div>Email Paypal</div></td>
            <td style="width:60px"><div>Status</div></td>
            <td style="width:100px"><div>Action</div></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($wallists as $wallist) { ?>
            <tr class="row" id="row_<?php echo $wallist->id; ?>"> 
                <td style="text-align: center;"><div><?php echo $wallist->id; ?></div></td>
                <td><div><?php echo $wallist->email; ?></div></td>

                <td><div><?php echo $wallist->fullname; ?></div></td>
                
                <td><div>$<?php echo $wallist->balance; ?></div></td>

                <td><div><?php echo $wallist->email_paypal; ?></div></td>

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
                    <a href="<?php echo site_url('adminwithdrawal/payment_sucess/'.$wallist->id) ?>">[Payment]</a>&nbsp;
                    <a href="<?php echo site_url('adminwithdrawal/payment_cancel/'.$wallist->id) ?>">[Cancel]</a>
                    <?php } ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>