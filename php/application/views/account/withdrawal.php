
<?php echo form_open('', array('id' => 'withdrawal-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Withdrawal</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Max Withdrawal Amount: </div></td>
            <td>
                <span class="currency">$<?php echo $balance; ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Withdrawal Amount: </div></td>
            <td>
                <input name="entry_amount" type="text" id="entry_amount" style="width:300px" value="" />
            </td>
        </tr>
        <tr>
            <td><div>Email paypal: </div></td>
            <td>
                <input name="email_paypal" type="text" id="email_paypal" style="width:300px" value="" />
            </td>
        </tr>

        
        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Sent Request">
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>
