<?php echo form_open('', array('id' => 'transaction-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Deposite Amount</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Max Transaction Fees: </div></td>
            <td>
                <span class="currency">$<?php echo $max_entry_amount; ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Deposite Fees: </div></td>
            <td>
                <input name="entry_amount" type="text" id="entry_amount" style="width:300px" value="" />
            </td>
        </tr>

        <tr>
            <td><div>Total Fees: </div></td>
            <td>
                <span class="currency" id="total_fees">$0</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2"><h1>Payment</h1></td>
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
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Save">
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#save-btn').live('click',function(){
            var flag;
            var entry_amount = $('#entry_amount').val();
            var min_enrolment_entry_amount = '<?php echo $transaction_fees['min_enrolment_entry_amount']; ?>';
            var max_enrolment_entry_amount = '<?php echo $max_entry_amount; ?>';
            if(isNaN(entry_amount) || (entry_amount % 100 != 0) || ((entry_amount != '') && entry_amount < min_enrolment_entry_amount) || ((entry_amount != '') && entry_amount > max_enrolment_entry_amount)){
                $('#msgContainer').append('<input type="hidden" id="cmsgentry_amount" value="Enrolment Entry Amount is numberic , divisible to 100, greater than '+ min_enrolment_entry_amount +' and litter than '+ max_enrolment_entry_amount +'"/>');
                flag = false;
            }
            var payment = $('#payment:checked').val();
            if (typeof(payment) == "undefined"){
                $('#msgContainer').append('<input type="hidden" id="cmsgpayment" value="Payment method not null"/>');
                flag = false;
            }
        
            if(flag == false){
                showmessage('error', 'Validation errors found', 'Please see below');
                showCompMsgs();
                return false;
            } else{
                $('#transaction-form').submit();
            }
            
            
        });
        $('#entry_amount').keyup(function(){
            totalfees()
        });
          
    })
    function totalfees(){
        var min_enrolment_entry_amount = '<?php echo $transaction_fees['min_enrolment_entry_amount']; ?>';
        var max_enrolment_entry_amount = '<?php echo $max_entry_amount; ?>';
        var entry_amount = $('#entry_amount').val();
        if(!isNaN(entry_amount) && (entry_amount % 100 == 0)  && entry_amount >= min_enrolment_entry_amount  && entry_amount <= max_enrolment_entry_amount){
            if(entry_amount.length == 0)
                entry_amount = 0
            $('#total_fees').text('$'+entry_amount);
        }else{
            $('#total_fees').text('$'+0);
        }   
    }
</script>

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
        var entry_amount = $('#entry_amount').val();
        if(!isNaN(entry_amount) && entry_amount > 0){
            if(entry_amount.length == 0)
                entry_amount = 0
            var total_fees = parseInt(entry_amount);
            $('#amount').val(total_fees);
        }else{
            $('#amount').val(0);
        }   
    }
</script>