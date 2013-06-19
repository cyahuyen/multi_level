
<?php echo form_open(!empty($href_link) ? $href_link : '', array('id' => 'transaction-form')); ?>
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
                <?php echo $posts['entry_amount'] ?>
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
                <span class="currency" id="total_fees">$<?php echo ($posts['entry_amount'] + $config_data['transaction_fee']) ?></span>
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
        <?php echo $payment; ?>
    <input type="hidden" name="user_id" value="<?php echo $posts['user_id'] ?>"/>
    <input type="hidden" name="entry_amount" value="<?php echo $posts['entry_amount'] ?>"/>
    <?php
    $custom = '';
    foreach ($posts as $key => $post) {
        $custom .= $key . '=' . $post . '|';
    }
    ?>
    <input type="hidden" name="custom" id="custom" value="<?php echo $custom; ?>" />
    <tr>
        <td colspan="2">
            <div style="padding-left: 130px;">
                <input type="submit" id="save-btn" name="save-btn" class="button" value="Confirm">
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
