<div class='mainInfo'>
    <div class="pageTitle"><?php echo $dea_user; ?></div>
    <div class="pageTitleBorder"></div>
    <p><?php echo $dea_sure; ?> '<?php echo $user->username; ?>'</p>

    <?php echo form_open("auth/deactivate/" . $user->id); ?>

    <p>
        <label for="confirm"><?php echo $dea_yes; ?></label>
        <input type="radio" name="confirm" value="yes" checked="checked" />
        <label for="confirm"><?php echo $dea_no; ?></label>
        <input type="radio" name="confirm" value="no" />
    </p>

    <?php echo form_hidden($csrf); ?>
    <?php echo form_hidden(array('id' => $user->id)); ?>

    <p><?php echo form_submit('submit', 'Submit'); ?></p>

    <?php echo form_close(); ?>

</div>
