<?php echo form_open('register/index', array('id' => 'sign-up-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Register User</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="<?php echo site_url('register/forgot') ?>">(if you forgot password ?)</a></td>
        </tr>
        <tr>
            <td><div>FirstName: </div></td>
            <td>
                <input type="text" name="firstname" class="mandatory"  id="firstname" value="<?php echo set_value('firstname', $firstname); ?>" style="width:300px">
                <span class="fr-error"><?php echo form_error('firstname'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>LastName: </div></td>
            <td>
                <input type="text" name="lastname" class="mandatory"  id="lastname" value="<?php echo set_value('lastname', $lastname); ?>" style="width:300px">
                <span class="fr-error"><?php echo form_error('lastname'); ?></span>
            </td>
        </tr>
        
        <tr>
            <td><div>Address: </div></td>
            <td>
                <input name="address" type="text" id="address" style="width:300px" value="<?php echo set_value('address', $address); ?>" />
                <span class="fr-error"><?php echo form_error('address'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Phone: </div></td>
            <td>
                <input name="phone" type="text" id="phone" style="width:300px" value="<?php echo set_value('phone', $phone); ?>" />
                <span class="fr-error"><?php echo form_error('phone'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <input name="email" class="mandatory" type="text" id="email" style="width:300px" value="<?php echo set_value('email', $email); ?>" />
                <span class="fr-error"><?php echo form_error('email'); ?></span>
            </td>
        </tr>
        
        
        <tr>
            <td><div>Referring Member: </div></td>
            <td>
                <input name="referring" type="text" id="referring" style="width:300px" value="<?php echo set_value('referring', $referring); ?>" />
                <span class="fr-error"><?php echo form_error('referring'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Enrolment Entry Amount: </div></td>
            <td>
                <input name="entry_amount" type="text" id="entry_amount" style="width:300px" value="<?php echo set_value('entry_amount', $entry_amount); ?>" />
                <span class="fr-error"><?php echo form_error('referring'); ?></span>
                <input type="hidden" name="custom" id="custom" value="" />
            </td>
        </tr>
        <tr>
            <td><div>Open Fees: </div></td>
            <td>
                <span class="currency">$<?php echo $transaction_fees['open_fee']; ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Deposite Fees: </div></td>
            <td>
                <span id="deposite" class="currency">$0</span>
            </td>
        </tr>
        <tr>
            <td><div>Total Fees: </div></td>
            <td>
                <span class="currency" id="total_fees">$<?php echo $transaction_fees['open_fee']; ?></span>
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
                    <input type="reset" id="" name="" class="button" value="Reset">
                </div>
            </td>
        </tr>


    </tbody>
</table>
<?php echo form_close(); ?>
<script type="text/javascript">
    var open_fee = '<?php echo $transaction_fees['open_fee']; ?>';
    $(document).ready(function() {
        $("#referring").autocomplete({
            source: "<?php echo site_url('register/get_suggest') ?>"
        });
    });
    function totalfees() {
        var open_fee = '<?php echo $transaction_fees['open_fee']; ?>';
        var entry_amount = $('#entry_amount').val();
        var deposite = '<?php echo $transaction_fees['transaction_fee'] ?>';
        if (!isNaN(entry_amount) && entry_amount > 0) {
            if (entry_amount.length == 0)
                entry_amount = 0
            var total_fees = parseInt(open_fee) + parseInt(entry_amount) + parseInt(deposite);
            $('#total_fees').text('$' + total_fees);
        }
    }

    $(document).ready(function() {
        totalfees()
        getAmount();
    })
    $('#entry_amount').keyup(function() {
        totalfees()
        getAmount();
    });
    $('#entry_amount').blur(function() {
        totalfees()
        getAmount();
    });
    $('#save-btn').live('click', function() {
        var open_fee = '<?php echo $transaction_fees['open_fee']; ?>';
        var min_enrolment_entry_amount = '<?php echo $transaction_fees['min_enrolment_entry_amount']; ?>';
        var max_enrolment_entry_amount = '<?php echo $transaction_fees['max_enrolment_entry_amount']; ?>';
        e = $(this);
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var entry_amount = $('#entry_amount').val();
        var payment = $('input[name=payment]:checked').val();
        var address = $('#address').val();
        var phone = $('#phone').val();
        var deposite = '<?php echo $transaction_fees['transaction_fee'] ?>';
       
        var referring = $('#referring').val();
        $('#custom').val('firstname=' + firstname + '|lastname=' + lastname + '|email=' + email + '|entry_amount=' + entry_amount + '|address=' + address + '|phone=' + phone + '|referring=' + referring + '|entry_amount=' + entry_amount)
        if (!isNaN(entry_amount) && entry_amount > 0) {
            if (entry_amount.length == 0)
                entry_amount = 0
            var total_fees = parseInt(open_fee) + parseInt(entry_amount) + parseInt(deposite);
            $('#amount').val(total_fees);
        } else {
            $('#amount').val(open_fee);
        }
        var flag = true;
        removeCompMsgs();
        if (firstname.length == 0) {
            $('#msgContainer').append('<input type="hidden" id="cmsgfirstname" value="Firstname is not null"/>');
            flag = false;
        }
        if (lastname.length == 0) {
            $('#msgContainer').append('<input type="hidden" id="cmsglastname" value="Lastname is not null"/>');
            flag = false;
        }
        
        if (!validateEmail(email)) {
            $('#msgContainer').append('<input type="hidden" id="cmsgemail" value="Email wrong"/>');
            flag = false;
        }
        if (isNaN(entry_amount) || (entry_amount % 100 != 0) || ((entry_amount != '') && entry_amount < min_enrolment_entry_amount) || ((entry_amount != '') && entry_amount > max_enrolment_entry_amount)) {
            $('#msgContainer').append('<input type="hidden" id="cmsgentry_amount" value="Enrolment Entry Amount is numberic , divisible to 100, greater than ' + min_enrolment_entry_amount + ' and litter than ' + max_enrolment_entry_amount + '"/>');
            flag = false;
        }
        if (typeof(payment) == "undefined") {
            $('#msgContainer').append('<input type="hidden" id="cmsgpayment" value="Payment method not null"/>');
            flag = false;
        }
        
        if(payment == 'creditcard'){
            var card_num = $('#card_num').val();
            var exp_date = $('#exp_date').val();
            if (card_num.length <= 0) {
                $('#msgContainer').append('<input type="hidden" id="cmsgcard_num" value="Card Number is not null"/>');
                flag = false;
            }
            if (exp_date.length <= 0) {
                $('#msgContainer').append('<input type="hidden" id="cmsgexp_date" value="Exp Date is not null"/>');
                flag = false;
            }
        }
        if (flag == false) {
            showmessage('error', 'Validation errors found', 'Please see below');
            showCompMsgs();
            return false;
        } else {
            $.ajax({
                data: 'email=' + email,
                url: "<?php echo site_url('register/checkEmail') ?>",
                success: function(data) {
                    if ($.trim(data) == 'true') {
                        $('#sign-up-form').submit();
                    }
                    else {
                        $('#msgContainer').append('<input type="hidden" id="cmsgemail" value="Email is already registered in our system. Please use a different one."/>');
                        showmessage('error', 'Validation errors found', 'Please see below');
                        showCompMsgs();
                    }

                }
            });
            return false;
        }
    })

    function validateEmail(x) {
        var email = document.getElementById('email');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (filter.test(email.value)) {
            return true;
        }
    }
</script>

<script >
    $(document).ready(function() {
        getAmount();
        $('input[name=payment]').change(function() {
            getAmount()
        });
        $('#entry_amount').keyup(function() {
            getAmount()
        })
    })

    function getAmount() {
        var payment = $('input[name=payment]:checked').val();
        var deposite = '<?php echo $transaction_fees['transaction_fee'] ?>';
        
        $('.creditcard').hide();
        if (payment == 'paypal') {
            $('form').attr('action', 'https://www.<?php echo ($config['sandbox'] == 1) ? 'sandbox.' : '' ?>paypal.com/cgi-bin/webscr')
        }else if (payment == 'creditcard'){
            
            $('form').attr('action', '<?php echo site_url('register/creditcard') ?>');
            $('.creditcard').show();
        }
        var open_fee = <?php echo $transaction_fees['open_fee'] ?>;
        var entry_amount = $('#entry_amount').val();
        if (!isNaN(entry_amount) && entry_amount > 0) {
            if (entry_amount.length == 0)
                entry_amount = 0
            var total_fees = parseInt(open_fee) + parseInt(entry_amount) + parseInt(deposite);
            $('#amount').val(total_fees);
            $('#deposite').text('$'+deposite);
        } else {
            $('#deposite').text('$0');
            $('#amount').val(open_fee);
        }
    }
</script>