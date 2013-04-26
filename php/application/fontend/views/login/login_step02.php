<h4 class="color_red"><?php echo $step2_title; ?></h4>
<?php
if (isset($message) and ($message != ''))
    echo "<div class='simple-error'>$message</div>";
echo form_open('login/step3/', array('id' => 'sign-up-form'));
?>
<div id="verifyMessage" class="inner-content last">
    <div class="one-third">
        <p><h5><?php echo $text_welcom; ?></h5></p>
        <p><h3><?php echo $welcome_message; ?></h3></p>     
        <p>
            <input id="Confirm" name="Confirm" type="checkbox" value="false" />
            <input type="hidden" name="step" value="<?php echo (isset($step) ? $step : 0); ?>" /><?php echo $text_remember_me; ?>
        </p>
        <fieldset>          
            <input name="Continue" value="<?php echo $button_continue; ?>" class="button small grey Mysubmitted" type="submit"/>
            <a href="<?php echo site_url('login/logout'); ?>" class="button small orange Mysubmitted"/><?php echo $button_cancel; ?></a>
        </fieldset>           
    </div>
    <div class="one-third-big last">
        <p><?php echo $text_welcome_mess; ?></p><br>    
        <p><?php echo $text_close; ?></p>
    </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    disableContinueButton();
    $(document).ready(function () {
        $("#verifyMessage input[name='Confirm']").live("click", function (event) {
            var button = $("#verifyMessage input[name='Continue']");
            if (this.checked) {
                button.removeAttr("disabled");	
                $('#Confirm').val(true);

                button.removeClass('grey');		
                button.addClass('orange');
            }
            else { $('#Confirm').val(false);
                button.attr("disabled", "disabled");
                button.removeClass('orange');		
                button.addClass('grey');
            }
        });
    });
</script>