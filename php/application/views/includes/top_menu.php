<div class="top">
    <div class="logo">

    </div>
    <div class="topright">
        <div class="usermenu">
            <ul>
                <li><a href="#" target="_blank">My Profile</a></li>
                <li><a href="#" target="_blank">Help</a></li>
                <li><a href="#" target="_blank">Support</a></li>
                <li><?php echo anchor('authentication/signout', 'Sign-out', array('class' => 'checkdirty')); ?></li>
            </ul>
            <div class="clearer"></div>
        </div>
    </div>
    <div class="clearer" style="height:1px; background-color:#fff"></div>
    <div class="mainmenu">
        <ul class="sf-menu">
            <li class="<?php echo $menu_config[0] ?>"><?php echo anchor('home', 'Home'); ?></li>
            <li class="register"><a href="<?php echo site_url('register/index') ?>">Sign Up</a></li>
            <li class="register"><a href="<?php echo site_url('authentication') ?>">Login</a></li>
        </ul>
        <div class="clearer"></div>
    </div>
</div>
