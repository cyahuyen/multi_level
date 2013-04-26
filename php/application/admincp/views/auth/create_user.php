<div class='mainInfo'>

    <h1><?php echo $text_create_user; ?></h1>
    <p><?php echo $text_notice; ?></p>

    <div id="infoMessage"><?php echo $message; ?></div>

    <?php echo form_open("auth/create_user"); ?>
    <p><?php echo $text_first_name; ?><br />
        <?php echo form_input($first_name); ?>
    </p>

    <p><?php echo $text_last_name; ?><br />
        <?php echo form_input($last_name); ?>
    </p>

    <p><?php echo $text_company; ?><br />
        <?php echo form_input($company); ?>
    </p>

    <p><?php echo $text_email; ?><br />
        <?php echo form_input($email); ?>
    </p>

    <p><?php echo $text_phone; ?><br />
        <?php echo form_input($phone1); ?>-<?php echo form_input($phone2); ?>-<?php echo form_input($phone3); ?>
    </p>

    <p><?php echo $text_pass; ?><br />
        <?php echo form_input($password); ?>
    </p>

    <p><?php echo $text_con_pass; ?><br />
        <?php echo form_input($password_confirm); ?>
    </p>

    <p><?php echo form_submit('submit', 'Create User'); ?></p>


    <?php echo form_close(); ?>

</div>
