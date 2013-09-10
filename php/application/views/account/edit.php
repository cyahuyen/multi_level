<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<?php echo form_open('account/edit', array('id' => 'sign-up-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Edit Account</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div>Account number: </div></td>
            <td>
                <?php echo!empty($userdata->username) ? $userdata->username : '' ?>
            </td>
        </tr>
        <tr>
            <td><div>Firstname: </div></td>
            <td>
                <input type="text" name="firstname"  id="firstname" value="<?php echo!empty($userdata->firstname) ? $userdata->firstname : '' ?>" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>Lastname: </div></td>
            <td>
                <input type="text" name="lastname"  id="firstname" value="<?php echo!empty($userdata->lastname) ? $userdata->lastname : '' ?>" style="width:300px">
            </td>
        </tr>
        <tr>
            <td><div>Address: </div></td>
            <td>
                <input name="address" type="text" id="address" style="width:300px" value="<?php echo!empty($userdata->address) ? $userdata->address : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Address #2: </div></td>
            <td>
                <input name="address2" type="text" id="address2" style="width:300px" value="<?php echo!empty($userdata->address2) ? $userdata->address2 : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Phone: </div></td>
            <td>
                <input name="phone" type="text" id="phone" style="width:300px" value="<?php echo!empty($userdata->phone) ? $userdata->phone : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <input name="email" type="text" id="email" style="width:300px" value="<?php echo!empty($userdata->email) ? $userdata->email : '' ?>" />
                <input name="old_email" type="hidden" id="old_email" style="width:300px" value="<?php echo!empty($userdata->email) ? $userdata->email : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>Country: </div></td>
            <td>
                <select name="country" id="country" class="mandatory">
                    <option value="">-- Select --</option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->country_id ?>" <?php echo ($country->country_id == $userdata->country_id) ? 'selected' : '' ?>><?php echo $country->name ?></option>
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
                <input name="zip_code" class="mandatory" type="text" id="zip_code" style="width:300px" value="<?php echo!empty($userdata->zip_code) ? $userdata->zip_code : '' ?>" />
            </td>
        </tr>
        <tr>
            <td><div>City: </div></td>
            <td>
                <input name="city" class="" type="text" id="city" style="width:300px" value="<?php echo!empty($userdata->city) ? $userdata->city : '' ?>" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="padding-left: 150px;">
                    <input type="submit" value="Save" class="button" name="save-btn" id="save-btn">
                    <a href="<?php echo site_url('account/index') ?>" class="button">Cancel</a>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>

<script>
    function getState(country_id){
        var content = '<option value="">-- Select --</option>'
        var state_id = '<?php echo $userdata->state_id ?>'
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
        
        $('#country').change(function(){
            var country_id = $(this).val();
            getState(country_id)
        })
    });
</script>