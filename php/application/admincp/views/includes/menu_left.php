<?php
$this->lang->load('home');
$ci = get_instance();
$controller_name = get_class($ci);
?>
<div id="sidebar">
    <div id="sidemenu">
        <ul>
            <li <?php echo (strtolower($controller_name) == 'account' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('/account'); ?>"><img src="<?php echo base_url(); ?>img/icons/sidemenu/mail.png" width="16" height="16" alt="icon"/><?php echo $this->lang->line('text_account'); ?></a></li>
            <li <?php echo (strtolower($controller_name) == 'user' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('/user'); ?>" title="Profile"><img src="<?php echo base_url(); ?>img/icons/sidemenu/user.png" width="16" height="16" alt="icon"/><?php echo $this->lang->line('text_user'); ?></a></li>
        </ul>
    </div>
</div>

