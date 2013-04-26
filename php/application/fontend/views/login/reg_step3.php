<script type="text/javascript">
    $(document).ready(function(){ 
        $('#country').change(function(){ //any select change on the dropdown with id country trigger this code
            $("#cities > option").remove(); //first of all clear select items
            var country_id = $('#country').val();  // here we are taking country id of the selected one.
			
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?><?php echo $this->lang->lang(); ?>/home/get_cities/"+country_id, //here we are calling our user controller and get_cities method with the country_id
                dataType : "JSON",
                success: function(cities) //we're calling the response json array 'cities'
                {   console.log(cities); //found cities
                    $.each(cities,function(id,city) //here we're doing a foeach loop round each city with id as the key and city as the value
                    {
                        var opt = $('<option />'); // here we're creating a new select option with for each city
                        opt.val(id);
                        opt.text(city);
                        $('#cities').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                    });
                },
                error: function (){

                    alert('Error AJAX');

                }
 
            });
 
        });
    });
    
</script>
<h4 class="color_red"><?php echo $reg3_title; ?></h4>
<p><?php echo $reg3_your_account; ?></p>
<div class="simple-notice"><?php echo $text_notification; ?></div>
<?php echo form_open('account/acc_infor/', array('id' => 'sign-up-form')); ?>
<div class="horizontal-line-small"></div>
<?php echo form_hidden($csrf); ?>
<h5><?php echo $text_contact; ?></h5><input type="hidden" name="s" value="2" />
<fieldset>
    <label><span class="required">*</span><?php echo $text_address; ?> </label>
    <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('address', '<div class="simple-alert">', '</div>'); ?>   
<fieldset>
    <label><span class="required">*</span><?php echo $text_city; ?> </label>
    <input type="text" name="city" id="city" value="<?php echo set_value('city'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('city', '<div class="simple-alert">', '</div>'); ?>    
<fieldset>
    <label><span class="required">*</span><?php echo $text_country; ?></label>
    <select name="country_id" id="country">
        <option value=""><?php echo $text_select; ?></option>
        <?php foreach ($countries as $country) { ?>
            <?php if ($country['country_id'] == $country_id) { ?>
                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['country_name']; ?></option>
            <?php } else { ?>
                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
            <?php } ?>
        <?php } ?>
    </select>		
</fieldset>
<?php echo form_error('country_id', '<div class="simple-alert">', '</div>'); ?>   
<fieldset><?php $cities['#'] = 'Please Select'; ?>
    <label><span class="required">*</span><?php echo $text_state; ?></label>
    <?php echo form_dropdown('city_id', $cities, $city_id, 'id="cities"'); ?>   
</fieldset> 
<?php echo form_error('city_id', '<div class="simple-alert">', '</div>'); ?>    
<fieldset>
    <label><span class="required">*</span><?php echo $text_zip_code; ?></label>
    <input type="text" name="postcode" id="postcode" value="<?php echo set_value('postcode'); ?>" class="text requiredField"/>
</fieldset>
<?php echo form_error('postcode', '<div class="simple-alert">', '</div>'); ?>  
<fieldset>
    <label><span class="required">*</span><?php echo $text_dob; ?> </label>
    <input type="text" name="dob" id="dob" value="<?php echo set_value('dob'); ?>" class="text requiredField"/>
    <?php echo $text_format_date; ?>
</fieldset>
<?php echo form_error('dob', '<div class="simple-alert">', '</div>'); ?> 
<fieldset>
    <label><span class="required">*</span><?php echo $text_phone; ?> </label>
    <select name="code_phone" id="code_phone">
        <option value=""><?php echo $text_select; ?></option>
        <?php foreach ($phones as $phone) { ?>
            <?php if ($phone['code_phone'] == $code_phone) { ?>
                <option value="<?php echo $phone['code_phone']; ?>" selected="selected"><?php echo $phone['country_name']; ?></option>
            <?php } else { ?>
                <option value="<?php echo $phone['code_phone']; ?>"><?php echo $phone['country_name']; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
</fieldset>
<fieldset>
    <label>&nbsp;</label>
    <input id="phone" name="phone" type="text" value="<?php echo set_value('phone'); ?>" />
</fieldset>
<?php echo form_error('phone', '<div class="simple-alert">', '</div>'); ?> 
<fieldset>
    <label><?php echo $text_mobile; ?></label> 
    <select name="code_mobile" id="code_mobile">
        <option value=""><?php echo $text_select; ?></option>
        <?php foreach ($phones as $phone) { ?>
            <?php if ($phone['code_phone'] == $code_mobile) { ?>
                <option value="<?php echo $phone['code_phone']; ?>" selected="selected"><?php echo $phone['country_name']; ?></option>
            <?php } else { ?>
                <option value="<?php echo $phone['code_phone']; ?>"><?php echo $phone['country_name']; ?></option>
            <?php } ?>
        <?php } ?>
    </select>    								
</fieldset>
<fieldset>
    <label>&nbsp;</label>
    <input id="mobile" name="mobile" type="text" value="<?php echo set_value('mobile'); ?>" />
</fieldset>
<fieldset>
    <label><?php echo $text_company; ?></label>
    <input id="company" name="company" type="text" value="<?php echo set_value('company'); ?>" />
</fieldset>
<div class="horizontal-line-small"></div>

<h5><?php echo $text_statistical; ?></h5>
<fieldset>
    <label><span class="required">*</span><?php echo $reg3_used; ?></label>
    <select id="AccountDestinationId" name="AccountDestinationId">
        <option selected="selected" value="0"><?php echo $reg3_area; ?></option>
        <option value="1"><?php echo $reg3_game; ?></option>
        <option value="2"><?php echo $reg3_sales; ?></option>
        <option value="3"><?php echo $reg3_non_commercial; ?></option>
        <option value="4"><?php echo $reg3_commercial; ?></option>
        <option value="5"><?php echo $reg3_forex; ?></option>
        <option value="255"><?php echo $reg3_other; ?></option>
    </select>
</fieldset>

<fieldset> 
    <label><span class="required">*</span><?php echo $text_occupation; ?></label>
    <select id="CustomerOccupationId" name="CustomerOccupationId">
        <option selected="selected" value="0"><?php echo $reg3_choose; ?></option>
        <option value="1"><?php echo $reg3_manager; ?></option>
        <option value="2"><?php echo $reg3_it; ?></option>
        <option value="3"><?php echo $reg3_professional; ?></option>
        <option value="4"><?php echo $reg3_admin; ?></option>
        <option value="5"><?php echo $reg3_sale; ?></option>
        <option value="6"><?php echo $reg3_support; ?></option>
        <option value="7"><?php echo $reg3_manufacture; ?></option>
        <option value="8"><?php echo $reg3_employ; ?></option>
        <option value="9"><?php echo $reg3_student; ?></option>
        <option value="10"><?php echo $reg3_retired; ?></option>
        <option value="255"><?php echo $reg3_other; ?></option>
    </select>
</fieldset>
<fieldset>
    <input name="Mysubmitted" id="Mysubmitted" value="Submit" class="button small orange" type="submit"/>
    <a href="<?php echo site_url('login/logout'); ?>" class="button small orange Mysubmitted"/>Cancel</a>
</fieldset>    
<?php echo form_close(); ?>
