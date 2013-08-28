<?php echo form_open('', array('id' => 'transaction-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Deposite Amount</h1></td>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><div>Acount Number: </div></td>
            <td>
                <?php echo $user->acount_number ?>
            </td>
        </tr>
        <tr>
            <td><div>Deposite Amount: </div></td>
            <td>
                <?php echo $deposit_info->entry_amount ?>
            </td>
        </tr>

        <tr>
            <td><div>Fee: </div></td>
            <td>
                <span class="currency" id="fees">$<?php echo $config_data['transaction_fee'] ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Total: </div></td>
            <td>
                <span class="currency" id="total_fees">$<?php echo ($deposit_info->entry_amount + $config_data['transaction_fee']) ?></span>
            </td>
        </tr>
        <tr class="">
            <td >Card Owner</td>
            <td>
                <input type="text"  name="cc_owner" id="cc_owner" value=""/> 
            </td>
        </tr>
        <tr class="">
            <td>Card Number</td>
            <td>
                <input type="text" name="card_num" id="card_num" style="width:300px">
            </td>
        </tr>
        <tr class="">
            <td>Exp Date</td>
            <td>
                <input type="text" name="exp_date" id="exp_date" style="width:300px">
            </td>
        </tr>
        <tr class="">
            <td>CVV2</td>
            <td>
                <input type="text" name="cc_cvv2" id="cc_cvv2" style="width:300px">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Confirm">&nbsp;
                    <input type="button"  onclick="location='<?php echo site_url('account/transaction') ?>'" class="button" value="Back">
                </div>
            </td>
            <td colspan="2">
                <div style="padding-left: 130px;">

                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#payment').attr('checked', true);
        $('.creditcard').show();
    })
    
</script>
