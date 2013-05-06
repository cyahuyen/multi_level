<div class="top">
    <div class="logo">

    </div>
    <div class="clearer" style="height:1px; background-color:#fff"></div>
    <?php if ($this->session->userdata('user')) { ?>
        <div class="mainmenu">
            <ul class="sf-menu">
                <li><a href="<?php echo site_url('account/index') ?>">My Profile</a></li>
                <li><a href="<?php echo site_url('account/history') ?>">History</a></li>
                <li><a href="<?php echo site_url('account/transaction') ?>">Deposite</a></li>
                <li><a href="<?php echo site_url('authentication/signout') ?>">Log Out</a></li>
            </ul>
            <div class="clearer"></div>
        </div>
    <?php } else { ?>
        <div class="mainmenu">
            <ul class="sf-menu">
                <li class="<?php echo $menu_config[0] ?>"><?php echo anchor('home', 'Home'); ?></li>
                <li class="register"><a href="<?php echo site_url('register/index') ?>">Sign Up</a></li>
                <li class="register"><a href="<?php echo site_url('authentication') ?>">Login</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Support</a></li>
            </ul>
            <div class="clearer"></div>
        </div>
    <?php } ?>
</div>
