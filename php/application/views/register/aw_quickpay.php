<?php echo form_open('https://sale.alliedwallet.com/quickpay.aspx', array('id' => 'transaction-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Allied Wallet QuickPay</h1></td>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><div>Username: </div></td>
            <td>
                <?php echo $register_info->username ?>
            </td>
        </tr>
        <tr>
            <td><div>Firstname: </div></td>
            <td>
                <?php echo $register_info->firstname ?>
            </td>
        </tr>
        <tr>
            <td><div>Lastname: </div></td>
            <td>
                <?php echo $register_info->lastname ?>
            </td>
        </tr>
        <tr>
            <td><div>Address: </div></td>
            <td>
                <?php echo $register_info->address ?>
            </td>
        </tr>
        <tr>
            <td><div>Phone: </div></td>
            <td>
                <?php echo $register_info->phone ?>
            </td>
        </tr>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <?php echo $register_info->email ?>
            </td>
        </tr>

        <tr>
            <td><div>Fee: </div></td>
            <td>
                <span class="currency" id="fees">$<?php echo $register_fees ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Total: </div></td>
            <td>
                <span class="currency" id="total_fees">$<?php echo ($register_info->entry_amount + $register_fees ) ?></span>
            </td>
        </tr>

        <!--    <Input name = "MerchantID" type = "hidden"
                   value = "<?php echo $payments_config['MerchantID'] ?>" />
            <Input name = "SiteID" type = "hidden"
                   value = "<?php echo $payments_config['SiteID'] ?>" />
            <input name="AmountTotal" type=hidden value="<?php echo $register_info->entry_amount + $register_fees; ?>" />
            <input name="CurrencyID" type=hidden value="USD" />
            <input name="AmountShipping" type=hidden value="0" />
            <input name="ShippingRequired" type=hidden value="1" />
            <input name="ItemName[0]" type=hidden value="Register" />
            <input name="ItemQuantity[0]" type=hidden value="1" />
            <input name="ItemAmount[0]" type=hidden value="<?php echo $register_info->entry_amount + $register_fees ?>" />
            <input name="ItemDesc[0]" type=hidden value="Register" />
            <input name="NoMembership" type=hidden value="1" />
            <Input name = "ReturnURL" type = "hidden"
                   value = "<?php echo site_url('home/index?success=1'); ?>" />
            <Input name = "confirmurl" type = "hidden"
                   value = "<?php echo site_url('register/aw_quickpay_process'); ?>" />
            
            <input name="MerchantReference"  type="hidden" value="<?php echo $register_info_json ?>" />-->

        <!-- *** Required fields for AlliedWallet -->
    <input name="MerchantID" type="hidden"
           value="<?php echo $payments_config['MerchantID'] ?>" />
    <input name="SiteID" type="hidden"
           value="<?php echo $payments_config['SiteID'] ?>" />
    <input name="AmountTotal" type="hidden"  value="<?php echo $register_info->entry_amount + $register_fees; ?>" />
    <input name="CurrencyID" type="hidden"  value="USD" />
    <input name="AmountShipping" type="hidden"  value="0" />
    <input name="ShippingRequired"  type="hidden" value="1" />
    <input name="ItemName[0]" type="hidden"  value="Register" />
    <input name="ItemQuantity[0]" type="hidden"  value="1" />
    <input name="ItemAmount[0]" type="hidden"  value="<?php echo $register_info->entry_amount + $register_fees ?>" />
    <input name="ItemDesc[0]" type="hidden"  value="Register" />
    <input name="NoMembership" type="hidden"  value="1" />
    <input name="ReturnURL" type="hidden"
           value="<?php echo site_url('home/index?success=1'); ?>" />
    <input name="ConfirmURL" type="hidden"
           value="<?php echo site_url('register/aw_quickpay_process'); ?>" />
    <!-- *** Optional fields for AlliedWallet -->
    <input name="MerchantReference"  type="hidden" value="<?php echo $tmp_id ?>" />
    
    <tr>
        <td colspan="2">
            <div style="padding-left: 130px;">
                <input type="submit" id="save-btn" name="save-btn" class="button" value="Confirm">&nbsp;
                <input type="button"  onclick="location='<?php echo site_url('register') ?>'" class="button" value="Back">
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