
<?php echo form_open('', array('id' => 'withdrawal-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Withdrawal</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>My Balance: </div></td>
            <td>
                <span class="currency">$<?php echo (($balance) > 0) ? number_format($balance, 2, '.', ' ') : 0; ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Max Withdrawal Amount: </div></td>
            <td>
                <span class="currency">$<?php echo (($max_balance-$fees) > 0) ? number_format($max_balance-$fees, 2, '.', ' ') : 0; ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Withdrawal Fee: </div></td>
            <td>
                <span class="currency">$<?php echo number_format($fees, 2, '.', ' '); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Avaiable Date Of Withdrawal: </div></td>
            <td>
                <span class="date"><?php echo!empty($withdrawal_date) ? $withdrawal_date : ''; ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Amount: </div></td>
            <td>
                <input name="entry_amount" type="text" id="entry_amount" style="width:300px" value="<?php echo $this->input->post('entry_amount') ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Email paypal: </div></td>
            <td>
                <input name="email_paypal" type="text" id="email_paypal" style="width:300px" value="<?php echo $this->input->post('email_paypal') ?>" />
            </td>
        </tr>


        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Send Request">
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>
