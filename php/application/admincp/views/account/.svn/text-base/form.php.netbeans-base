<!-- START SIMPLE FORM -->
<div class="simplebox grid740">
    <div class="titleh">
        <h3><?php echo $account_title; ?></h3>
    </div>
    <div class="body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" name="form">
            <div class="st-form-line">	
                <span class="st-labeltext"><?php echo $text_username; ?></span>	
                <input name="username" type="text"class="st-error-input" id="username" style="width:300px" value="<?php echo set_value('username', $username); ?>" /><span class="st-form-error">* <?php echo form_error('username'); ?></span>
                <input type="hidden" name="old_username" value="<?php echo $username; ?>">
                <div class="clear"></div>
            </div>

            <div class="st-form-line">	
                <span class="st-labeltext"><?php echo $text_contact_name; ?></span>	
                <input name="contactname" type="text" class="st-error-input" id="contactname" style="width:300px" value="<?php echo set_value('contactname', $contactname); ?>"/><span class="st-form-error">* <?php echo form_error('contactname'); ?></span>
                <div class="clear"></div>
            </div>
            <div class="st-form-line">	
                <span class="st-labeltext"><?php echo $text_group; ?></span>
                <select name="group_id" id="group_id">
                    <?php if ($groups) { ?>
                        <option value="none"><?php echo $text_select; ?></option>
                        <?php foreach ($groups as $group) { ?>
                            <?php if ($group['group_id'] == $group_id) { ?>
                                <option value="<?php echo $group['group_id']; ?>" selected="selected"><?php echo $group['name']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $group['group_id']; ?>"><?php echo $group['name']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </select>
                <span class="st-form-error">* <?php echo form_error('group_id'); ?></span>
                <div class="clear"></div>
            </div>

            <div class="st-form-line">	
                <span class="st-labeltext"><?php echo $text_email; ?></span>	
                <input name="email" type="text" class="st-error-input" id="email" style="width:300px" value="<?php echo set_value('email', $email); ?>" /><span class="st-form-error">* <?php echo form_error('email'); ?></span>
                <input type="hidden" name="old_email" value="<?php echo $email; ?>">
                <div class="clear"></div>
            </div>
            <div class="st-form-line">	
                <span class="st-labeltext"><?php echo $text_password; ?></span>	
                <input name="password" type="password" class="st-error-input" id="password" style="width:300px" value="<?php echo set_value('password'); ?>" /><span class="st-form-error">* <?php echo form_error('password'); ?></span>
                <input type="hidden" name="old_password" value="<?php echo $password; ?>">
                <div class="clear"></div>
            </div>
            <div class="st-form-line">	
                <span class="st-labeltext"><?php echo $text_con_password; ?></span>	
                <input name="password2" type="password" class="st-error-input" id="password2" style="width:300px" value="<?php echo set_value('password2'); ?>" /><span class="st-form-error">* <?php echo form_error('password2'); ?></span>
                <div class="clear"></div>
            </div>
            <div class="button-box">
                <input type="submit" name="button" id="submit" value="<?php echo $button_save; ?>" class="st-button"/>
                <a href="<?php echo $cancel; ?>" class="st-clear"><?php echo $button_cancel; ?></a>
            </div>

        </form>

    </div>
</div>
<!-- END SIMPLE FORM -->