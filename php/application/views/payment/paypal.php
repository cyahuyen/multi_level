
<tr>
    <td>Paypal</td>
    <td>
        <input type="radio"  name="payment" id="payment" value="paypal"/> Paypal
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="<?php echo $config['business'] ?>">
        <input type="hidden" name="amount" id="amount" value="">           
        <input type="hidden" name="item_name" value="<?php echo $title ?>">
        <input type="hidden" name="currency_code" value="<?php echo $config['currency_code'] ?>">
        <input type="hidden" name="no_shipping" value="2">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="mrb" value="3FWGC6LFTMTUG">
        <input type="hidden" name="bn" value="IC_Sample">
        <input type="hidden" name="return" value="<?php echo $return ?>"> 
        <input type="hidden" name="cancel_return" value="<?php echo $cancel_return ?>">
        <input type="hidden" name="notify_url" value="<?php echo $notify_url ?>">
        <input type="hidden" name="cbt" value="Continue">
        <input type="hidden" name="rm" value="2">
    </td>
</tr>


<script >
    $(document).ready(function(){
        getAmount();
        $('#payment').change(function(){
            
            getAmount()    
            
        });
        $('#entry_amount').keyup(function(){
            getAmount()    
        })
    })
    
    function getAmount(){
        var payment = $('#payment:checked').val();
                
        if(payment == 'paypal'){
            $('form').attr('action','https://www.<?php echo ($config['sandbox'] == 1) ? 'sandbox.' : '' ?>paypal.com/cgi-bin/webscr')
        }
        var open_fee = <?php echo $transaction_fees['open_fee'] ?>;
        var entry_amount = $('#entry_amount').val();
        if(!isNaN(entry_amount) && entry_amount > 0){
            if(entry_amount.length == 0)
                entry_amount = 0
            var total_fees = parseInt(open_fee) + parseInt(entry_amount);
            $('#amount').val(total_fees);
        }else{
            $('#amount').val(open_fee);
        }   
    }
</script>