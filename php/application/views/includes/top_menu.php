<div class="top">
    <div class="logo">
        MULTI LEVEL MARKETING
    </div>
    <div class="clearer" style="height:1px; background-color:#fff"></div>
    <?php if ($this->session->userdata('user')) { ?>
        <div class="mainmenu">
            <ul class="sf-menu">
                <li class="<?php echo $menu_config[0] ?>"><?php echo anchor('home', 'Home'); ?></li>
                <li><a class="<?php echo $menu_config[1] ?>" href="<?php echo site_url('account/index') ?>">My Profile</a></li>
                <li><a class="<?php echo $menu_config[2] ?>" href="<?php echo site_url('account/history') ?>">History</a></li>
                <li><a class="<?php echo $menu_config[3] ?>" href="<?php echo site_url('account/transaction') ?>">Deposite</a></li>
                <li><a class="<?php echo $menu_config[4] ?>" href="<?php echo site_url('account/withdrawal') ?>">Withdrawal</a></li>
                <li><a class="<?php echo $menu_config[5] ?>" href="<?php echo site_url('authentication/signout') ?>">Log Out</a></li>
                
            </ul>
            <div class="clearer"></div>
        </div>
    <?php } else { ?>
        <div class="mainmenu">
            <ul class="sf-menu">
                <li class="<?php echo $menu_config[0] ?>" class="<?php echo $menu_config[0] ?>"><?php echo anchor('home', 'Home'); ?></li>
                <li class="<?php echo $menu_config[1] ?>" class="register"><a href="<?php echo site_url('register/index') ?>">Sign Up</a></li>
                <li class="<?php echo $menu_config[2] ?>" class="register"><a href="<?php echo site_url('authentication') ?>">Login</a></li>
            </ul>
            <div class="clearer"></div>
        </div>
    <?php } ?>
</div>
