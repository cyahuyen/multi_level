<?php echo form_open('', array('id' => 'sign-up-form')); ?>
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
            <td><div>Username: </div></td>
            <td>
                <input type="text" name="username" class="mandatory"  id="username" value="<?php echo!empty($posts['username']) ? $posts['username'] : '' ?>" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>Password: </div></td>
            <td>
                <input type="password" name="password" class="mandatory"  id="password" value="" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>RePassword: </div></td>
            <td>
                <input type="password" name="repassword" class="mandatory"  id="repassword" value="" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>FirstName: </div></td>
            <td>
                <input type="text" name="firstname" class="mandatory"  id="firstname" value="<?php echo!empty($posts['firstname']) ? $posts['firstname'] : '' ?>" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>LastName: </div></td>
            <td>
                <input type="text" name="lastname" class="mandatory"  id="lastname" value="<?php echo!empty($posts['lastname']) ? $posts['lastname'] : '' ?>" style="width:300px">
            </td>
        </tr>

        <tr>
            <td><div>Address: </div></td>
            <td>
                <input name="address" type="text" id="address" style="width:300px" value="<?php echo!empty($posts['address']) ? $posts['address'] : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Address #2: </div></td>
            <td>
                <input name="address2" type="text" id="address2" style="width:300px" value="<?php echo!empty($posts['address2']) ? $posts['address2'] : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Phone: </div></td>
            <td>
                <input name="phone" type="text" id="phone" style="width:300px" value="<?php echo!empty($posts['phone']) ? $posts['phone'] : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <input name="email" class="mandatory" type="text" id="email" style="width:300px" value="<?php echo!empty($posts['email']) ? $posts['email'] : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Email address (repeat): </div></td>
            <td>
                <input name="email_repeat" class="mandatory" type="text" id="email_repeat" style="width:300px" value="<?php echo!empty($posts['email_repeat']) ? $posts['email_repeat'] : '' ?>" />
            </td>
        </tr>

        <tr>
            <td><div>Country: </div></td>
            <td>
                <select name="country" id="country" class="mandatory">
                    <option value="">-- Select --</option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->country_id ?>" <?php echo ($country->country_id == $posts['country']) ? 'selected' : '' ?>><?php echo $country->name ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><div>State/prov: </div></td>
            <td>
                <select name="state" id="state" class="mandatory">
                    <option value="">-- Select --</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><div>Postal/zip code: </div></td>
            <td>
                <input name="zip_code" class="mandatory" type="text" id="zip_code" style="width:300px" value="<?php echo!empty($posts['zip_code']) ? $posts['zip_code'] : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>City: </div></td>
            <td>
                <input name="city" class="" type="text" id="city" style="width:300px" value="<?php echo!empty($posts['city']) ? $posts['city'] : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Referring Member: </div></td>
            <td>
                <input name="referring" class="mandatory" type="text" id="referring" style="width:300px" value="<?php echo!empty($posts['referring']) ? $posts['referring'] : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Enrolment Entry Amount: </div></td>
            <td>
                <input name="entry_amount" type="text" id="entry_amount" style="width:300px" value="<?php echo!empty($posts['entry_amount']) ? $posts['entry_amount'] : '' ?>" />
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
            <?php foreach ($payments as $code => $title) { ?>
                <tr>
                    <td><?php echo $title ?></td>
                    <td><input type="radio" <?php echo (!empty($posts['payment']) && $posts['payment'] == $code) ? 'checked' : '' ?> name="payment" id="payment" value="<?php echo $code ?>"></td>
                </tr>

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
    
    function getState(country_id){
        var content = '<option value="">-- Select --</option>'
        var state_id = '<?php echo $posts['state'] ?>'
        $.ajax({
            url: "<?php echo site_url('register/get_zones') ?>/" + country_id,
            dataType: 'json',
            success: function(json) {
                $.each( json, function( key, value ) {
                    if(state_id == key)
                        content += '<option value="' + key + '" selected>' + value + '</option>'
                    else
                        content += '<option value="' + key + '">' + value + '</option>'
                });
                $('#state') .html(content);
            }
        });
        
    }
    $(document).ready(function() {
        getState($('#country').val())
        $("#referring").autocomplete({
            source: "<?php echo site_url('register/ajax_search') ?>"
        });
        
        $('#country').change(function(){
            var country_id = $(this).val();
            getState(country_id)
        })
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