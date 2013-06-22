<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<?php echo form_open(site_url('account/confirm_transaction'), array('id' => 'transaction-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Deposite Amount</h1></td>
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
                            <option <?php echo (!empty($post_data['user_id']) && $post_data['user_id'] == $acount->user_id) ? 'selected' : '' ?> value="<?php echo $acount->user_id ?>"><?php echo $acount->acount_number ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><div>Deposite Amount: </div></td>
            <td>
                <input name="entry_amount" type="text" id="entry_amount" style="width:300px" value="<?php echo (!empty($post_data['entry_amount'])) ? $post_data['entry_amount'] : '' ?>" />
            </td>
        </tr>

        <tr>
            <td><div>Max Transaction Amount: </div></td>
            <td>
                <span class="currency" id="max_transaction">$0</span>
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
                <span class="currency" id="total_fees">$0</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2"><h1>Select Payment Method</h1></td>
                        </tr>
                    </thead>
                </table>

            </td>
        </tr>
        <?php if (!empty($payments)) { ?>
            <?php foreach ($payments as $code => $data) { ?>
                <?php echo $data ?>
            <?php } ?>
        <?php } ?>
        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Deposit">
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
            url: "<?php echo site_url('account/ajax_transaction') ?>/" + $('#user_id').val(),
            dataType: 'json',
            success: function(json) {
                $('#max_transaction').text('$'+json.max_entry_amount)
                $('#total_fees').text('$'+json.total_transaction)
            }
        });
    }
    
</script>
