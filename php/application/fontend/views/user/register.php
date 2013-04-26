<div id="bodyform">
    <h1>Register User!</h1>
    <?php if ($success) { ?>
        <h3><?php echo $success; ?></h3>
    <?php } ?>
    <?php echo form_open('user/index', array('id' => 'sign-up-form')); ?>
    <div class="st-form-line">	
        <span class="st-labeltext">UserName: </span>	
        <input name="username" type="text" class="st-error-input" id="username" style="width:300px" value="<?php echo set_value('username', $username); ?>" />
        <?php echo form_error('username'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Password: </span>	
        <input name="password" type="password" class="st-error-input" id="password" style="width:300px" value="" />
        <?php echo form_error('password'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Confirm Password: </span>	
        <input name="repassword" type="password" class="st-error-input" id="repassword" style="width:300px" value="" />
        <?php echo form_error('repassword'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Address: </span>	
        <input name="address" type="text" class="st-error-input" id="address" style="width:300px" value="<?php echo set_value('address', $address); ?>" />
        <?php echo form_error('address'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Phone: </span>	
        <input name="phone" type="text" class="st-error-input" id="phone" style="width:300px" value="<?php echo set_value('phone', $phone); ?>" />
        <?php echo form_error('phone'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Email: </span>	
        <input name="email" type="text" class="st-error-input" id="email" style="width:300px" value="<?php echo set_value('email', $email); ?>" />
        <?php echo form_error('email'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Fax: </span>	
        <input name="fax" type="text" class="st-error-input" id="fax" style="width:300px" value="<?php echo set_value('fax', $fax); ?>" />
        <?php echo form_error('fax'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Birthday: </span>	
        <input name="birthday" type="text" class="st-error-input" id="birthday" style="width:300px" value="<?php echo set_value('birthday', $birthday); ?>" />
        <?php echo form_error('birthday'); ?>
        <div class="clear"></div>
    </div>
    <div class="st-form-line">	
        <span class="st-labeltext">Referring member: </span>	
        <input name="referring" type="text" class="st-error-input" id="referring" style="width:300px" value="<?php echo set_value('referring', $referring); ?>" />
        <?php echo form_error('referring'); ?>
        <div class="clear"></div>
    </div>
    <div class="button-box">
        <input name="submit" id="submit" value="Submit" class="st-clear" type="submit"/>
        <input name="submit" id="submit" value="Reset" class="st-clear" type="reset"/>
    </div> 
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $('input[name=\'referring\']').autocomplete({
        delay: 500,
        source: function(request, response) {
            $.ajax({
                url: '<?php echo site_url('register/autocomplete'); ?>/filter_name=' + encodeURIComponent(request.term),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item.username,
                            value: item.user_id
                        }
                    }));
                }
            });
        },
        select: function(event, ui) {
            $('#product-related' + ui.item.value).remove();

            $('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

            $('#product-related div:odd').attr('class', 'odd');
            $('#product-related div:even').attr('class', 'even');

            return false;
        },
    });
</script>