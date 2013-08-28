<?php echo form_open('https://sale.alliedwallet.com/quickpay.aspx', array('id' => 'transaction-form')); ?>
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
    <input name="MerchantID" type="hidden"
           value="<?php echo $payments_config['MerchantID'] ?>" />
    <input name="SiteID" type="hidden"
           value="<?php echo $payments_config['SiteID'] ?>" />
    <input name="AmountTotal" type="hidden"  value="<?php echo ($deposit_info->entry_amount + $config_data['transaction_fee']); ?>" />
    <input name="CurrencyID" type="hidden"  value="USD" />
    <input name="AmountShipping" type="hidden"  value="0" />
    <input name="ShippingRequired"  type="hidden" value="1" />
    <input name="ItemName[0]" type="hidden"  value="Register" />
    <input name="ItemQuantity[0]" type="hidden"  value="1" />
    <input name="ItemAmount[0]" type="hidden"  value="<?php echo ($deposit_info->entry_amount + $config_data['transaction_fee']) ?>" />
    <input name="ItemDesc[0]" type="hidden"  value="Register" />
    <input name="NoMembership" type="hidden"  value="1" />
    <input name="ReturnURL" type="hidden"
           value="<?php echo site_url('account/transaction?success=1'); ?>" />
    <input name="ConfirmURL" type="hidden"
           value="<?php echo site_url('confirm/aw_quickpay_process'); ?>" />
    <!-- *** Optional fields for AlliedWallet -->
    <input name="MerchantReference"  type="hidden" value="<?php echo $tmp_id ?>" />
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