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
            <td><div>FullName: </div></td>
            <td>
                <input type="text" name="fullname" class="mandatory"  id="fullname" value="<?php echo set_value('fullname', $fullname); ?>" style="width:300px">
                <span class="fr-error"><?php echo form_error('fullname'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>UserName: </div></td>
            <td>
                <input type="text" name="username" class="mandatory" id="username" value="<?php echo set_value('username', $username); ?>" style="width:300px">
                <span class="fr-error"><?php echo form_error('username'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Password: </div></td>
            <td>
                <input name="password" type="password" class="mandatory" id="password" style="width:300px" value="" />
                <span class="fr-error"><?php echo form_error('password'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Confirm Password: </div></td>
            <td>
                <input name="repass" type="password" class="mandatory" id="repass" style="width:300px" value="" />
                <span class="fr-error"><?php echo form_error('repassword'); ?></span>
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
            <td><div>Fax: </div></td>
            <td>
                <input name="fax" type="text" id="fax" style="width:300px" value="<?php echo set_value('fax', $fax); ?>" />
                <span class="fr-error"><?php echo form_error('fax'); ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Birthday: </div></td>
            <td>
                <input name="birthday" type="text" id="birthday" style="width:300px" value="<?php echo set_value('birthday', $birthday); ?>" />
                <span class="fr-error"><?php echo form_error('birthday'); ?></span>
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
            </td>
        </tr>
        <tr>
            <td><div>Open Fees: </div></td>
            <td>
                <span class="currency">$<?php echo $transaction_fees['open_fee']; ?></span>
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
    
    function checkemailExists(email){
         
    }
    
    function checkUserExists(user){
        $.ajax({  
            url:"<?php echo site_url('register/checkUser') ?>/"+user,
            success: function(data){
                if(data == 'true')
                    return true;
                return false;
            } 
        }); 
    }
    
    function totalfees(){
        var entry_amount = $('#entry_amount').val();
        if(!isNaN(entry_amount) && entry_amount > 0){
            if(entry_amount.length == 0)
                entry_amount = 0
            total_fees = parseInt(open_fee) + parseInt(entry_amount);
            $('#total_fees').text('$'+total_fees);
        }   
    }
    
    $(document).ready(function(){
        totalfees()
    })
    $('#entry_amount').keyup(function(){
        totalfees()
    });
    
    
    
    $('#save-btn').live('click',function(){
        e = $(this);
        var fullname = $('#fullname').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var repassword = $('#repass').val();
        var email = $('#email').val();
        var entry_amount = $('#entry_amount').val();
        var payment = $('#payment:checked').val();
        var flag = true;
        removeCompMsgs();
        if(fullname.length == 0){
            $('#msgContainer').append('<input type="hidden" id="cmsgfullname" value="Full name is not null"/>');
            flag = false;
        }
        
        if(username.length < 6){
            $('#msgContainer').append('<input type="hidden" id="cmsgusername" value="Username greater than 6 character"/>');
            flag = false;
        }
        
        if(password.length < 6){
            $('#msgContainer').append('<input type="hidden" id="cmsgpassword" value="password greater than 6 character"/>');
            flag = false;
        }
        
        
        if(password !=  repassword){
            $('#msgContainer').append('<input type="hidden" id="cmsgrepass" value="Repassword wrong"/>');
            flag = false;
        }
        
        if(validateEmail(email)){
            $('#msgContainer').append('<input type="hidden" id="cmsgemail" value="Email wrong"/>');
            flag = false;
        }
        
        if(isNaN(entry_amount) || (entry_amount % 100 != 0) || entry_amount < 0){
            $('#msgContainer').append('<input type="hidden" id="cmsgentry_amount" value="Enrolment Entry Amount is numberic and divisible to 100"/>');
            flag = false;
        }
        
        if (typeof(payment) == "undefined"){
            $('#msgContainer').append('<input type="hidden" id="cmsgpayment" value="Payment method not null"/>');
            flag = false;
        }
        
        if(flag == false){
            showmessage('error', 'Validation errors found', 'Please see below');
            showCompMsgs();
            return false;
        } else{
            
            $.ajax({  
                data:'user='+username,
                url:"<?php echo site_url('register/checkUser') ?>",
                success: function(data){
                    if(data == 'true'){
                        $.ajax({  
                            data:'email='+email,
                            url:"<?php echo site_url('register/checkEmail') ?>",
                            success: function(data){
                                if(data == 'true'){
                                    $('#sign-up-form').submit();
                                }
                                    
                                else{
                                    $('#msgContainer').append('<input type="hidden" id="cmsgemail" value="Email is already registered in our system. Please use a different one."/>');
                                    showmessage('error', 'Validation errors found', 'Please see below');
                                    showCompMsgs();
                                }
                                
                            } 
                        });
                    }else{
                        $('#msgContainer').append('<input type="hidden" id="cmsgusername" value="Username is already registered in our system. Please use a different one."/>');
                        showmessage('error', 'Validation errors found', 'Please see below');
                        showCompMsgs();
                    }
                    
                } 
            });
            return false;    
            
        }
        
        
    })
    
    function validateEmail(x){
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
        {
            return false;
        }
    }
</script>
