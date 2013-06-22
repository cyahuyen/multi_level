
<?php echo form_open('', array('id' => 'withdrawal-form')); ?>

<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Withdrawal</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Select Acount Number: </div></td>
            <td>
                <select name="user_id" id="user_id">
                    <option value="">-- Select --</option>
                    <?php if (!empty($acounts)) { ?>
                        <?php foreach ($acounts as $acount) { ?>
                            <option <?php echo ($this->input->post('user_id') == $acount->user_id) ? 'selected' : '' ?> value="<?php echo $acount->user_id ?>"><?php echo $acount->acount_number ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><div>My Balance: </div></td>
            <td>
                <span id="my_balance" class="currency">$0</span>
            </td>
        </tr>
        <tr>
            <td><div>Max Withdrawal Amount: </div></td>
            <td>
                <span id="max_transaction" class="currency">$0</span>
            </td>
        </tr>
        <tr>
            <td><div>Withdrawal Fee: </div></td>
            <td>
                <span id="withdrawal_fees" class="currency">$0</span>
            </td>
        </tr>
        <tr>
            <td><div>Avaiable Date Of Withdrawal: </div></td>
            <td>
                <span id="withdrawal_date" class="date"><?php echo!empty($withdrawal_date) ? $withdrawal_date : ''; ?></span>
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
<script type="text/javascript">
    $(document).ready(function() {
        get_acount();
        $('#user_id').live('change',function(){
            get_acount()
        });
    });
    
    function get_acount(){
        $.ajax({
            url: "<?php echo site_url('account/ajax_withdraw') ?>/" + $('#user_id').val(),
            dataType: 'json',
            success: function(json) {
                if(json.max_balance != undefined)
                    $('#max_transaction').text('$'+json.max_balance)
                if(json.fees != undefined)
                    $('#withdrawal_fees').text('$'+json.fees)
                if(json.total_transaction != undefined)
                    $('#withdrawal_date').text('$'+json.total_transaction)
                if(json.balance != undefined)
                    $('#my_balance').text('$'+json.balance)
                if(json.withdrawal_date != undefined)
                    $('#withdrawal_date').text(json.withdrawal_date)
            }
        });
    }
    
</script>