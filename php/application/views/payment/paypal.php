
<tr>
    <td>Paypal</td>
    <td>
        <input type="radio"  name="payment" id="payment" value="paypal"/> Paypal
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="<?php echo $config['business'] ?>">
        <input type="hidden" name="amount" id="amount" value="<?php echo !empty($paypal_amount) ? $paypal_amount : '' ?>">           
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


