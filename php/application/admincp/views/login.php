<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>CYACASH - Payment Network Service</title>
        <meta name="description" content="Oldest, safest and most popular payment processor operating in World Wide and serving millions all around a world. Store your funds privately in gold, Euro or USD. Use e-GlobalCash digital money in on-line casinos, poker rooms, sports betting, forex or in any other on-line store."/>
        <meta name="keywords" content=""/>
        <!--META KEYWORDS-->
        <meta name="author" content="trendyWebstar"/>
        <?php $this->load->view('includes/header_link'); ?>
    </head>
    <body>
        <div class="loginform">
            <div class="title"></div>
            <div class="body">
                <?php
                if (isset($message) and ($message != ''))
                    echo "<div class='albox errorbox'>$message</div>";
                ?>
                <?php echo form_open('login', array('id' => 'sign-up-form')); ?>
                <label class="log-lab"><?php echo $text_account; ?></label>
                <input name="username" type="text" class="login-input-user" id="username" value="<?php echo set_value('username'); ?>"/>
                <label class="log-lab"><?php echo $text_password; ?></label>
                <input name="password" type="password" class="login-input-pass requiredField" id="password" value="<?php echo set_value('password'); ?>" autocomplete="off"/>
                <span id="img_captcha"><?php echo $recaptcha; ?></span>
                <input type="submit" name="button" id="button" value="<?php echo $button_login; ?>" class="button"/>
                <?php echo form_close(); ?>
            </div>
        </div>
    </body>
    <!--BODY ENDS  -->
</html>
<!--HTML ENDS  -->