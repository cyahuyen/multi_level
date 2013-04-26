<!-- START SIMPLE FORM -->
<div class="simplebox grid740">
    <div class="titleh">
        <h3>Add/Edit User</h3>
    </div>
    <div class="body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" name="form">
            <div class="st-form-line">	
                <span class="st-labeltext">UserName: </span>	
                <input name="username" type="text" class="st-error-input" id="username" style="width:300px" value="<?php echo set_value('username', $username); ?>" />
                <input name="old_username" type="hidden" class="st-error-input" id="old_username" value="<?php echo set_value('username', $username); ?>" />
                <?php echo form_error('username'); ?>
                <div class="clear"></div>
            </div>
            <div class="st-form-line">	
                <span class="st-labeltext">Password: </span>	
                <input name="password" type="password"class="st-error-input" id="password" style="width:300px" value="" />
                <input type="hidden" name="old_password" value="<?php echo $password; ?>">
                <?php echo form_error('password'); ?>
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
                <input name="old_email" type="hidden" class="st-error-input" id="old_email" style="width:300px" value="<?php echo set_value('email', $email); ?>" />
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
                <span class="st-labeltext">User Type: </span>	
                <select name="usertype" id="usertype">
                    <?php if ($usertype == 2) { ?>
                        <option value="0">Member</option>
                        <option value="1">Silver</option>
                        <option value="2" selected="selected">Gold</option>
                    <?php } elseif ($usertype == 1) { ?>
                        <option value="0" >Member</option>
                        <option value="1" selected="selected">Silver</option>
                        <option value="2">Gold</option>
                    <?php } else { ?>
                        <option value="0" selected="selected">Member</option>
                        <option value="1">Silver</option>
                        <option value="2">Gold</option>
                    <?php } ?>
                </select>
                <div class="clear"></div>
            </div>
            <div class="st-form-line">	
                <span class="st-labeltext">Status: </span>	
                <select name="status" id="status">
                    <?php if ($status == 0) { ?>
                        <option value="0" selected="selected">Disable</option>
                        <option value="1">Enable</option>
                    <?php } else { ?>
                        <option value="0">Disable</option>
                        <option value="1" selected="selected">Enable</option>
                    <?php } ?>
                </select>
                <div class="clear"></div>
            </div>
            <div class="st-form-line">	
                <span class="st-labeltext">Referring member: </span>	
                <input name="referring" type="text" class="st-error-input" id="referring" style="width:300px" value="<?php echo set_value('referring', $referring); ?>" />
                <?php echo form_error('referring'); ?>
                <div class="clear"></div>
            </div>
            <div class="button-box">
                <input type="submit" name="button" id="submit" value="Save" class="st-button"/>
                <a href="<?php echo $cancel; ?>" class="st-clear">Cancel</a>
            </div>
        </form>
    </div>
</div>
<!-- END SIMPLE FORM -->