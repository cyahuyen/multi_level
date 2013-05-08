<div class="top">
    <div class="topright">
        <div class="usermenu">
            <ul>
                <li><a href="#" target="_blank">Help</a></li>
                <li><a href="#" target="_blank">Support</a></li>
                <li><a href="<?php echo site_url('authentication/signout') ?>">Log Out</a></li>
            </ul>
            <div class="clearer"></div>
        </div>
    </div>
    <div class="clearer" style="height:1px; background-color:#fff"></div>
    <div class="mainmenu">
        <ul class="sf-menu">
            <li class="<?php echo $menu_config[0] ?>"><?php echo anchor('home', 'Home'); ?></li>
            <li class="<?php echo $menu_config[1] ?>">
                <a href="<?php echo site_url('adminuser/manager') ?>">User</a>
                <ul>
                    <li><a href="<?php echo site_url('adminuser/profile') ?>">Create User</a></li>
                    <li><a href="<?php echo site_url('adminuser/manager') ?>">Manage User</a></li>
                </ul>
            </li>
            <li class="<?php echo $menu_config[2] ?>">
                <a href="<?php echo site_url('adminconfig') ?>">Config</a>
                <ul>
                    <li><a href="<?php echo site_url('adminconfig/emails') ?>">Email Config</a></li>
                    <li><a href="<?php echo site_url('adminconfig/transaction_fees') ?>">Transaction Fees</a></li>
                    <li><a href="<?php echo site_url('adminconfig/referral') ?>">Referral</a></li>
                    <li><a href="<?php echo site_url('adminconfig/timeconfig') ?>">Time config</a></li>
                </ul>
            </li>
            <li class="<?php echo $menu_config[3] ?>">
                <a href="#">Module</a>
                <ul>
                    <li>
                        <a href="<?php echo site_url('adminmodule/payment') ?>">Payment</a>
                        <ul>
                            <li><a href="<?php echo site_url('adminmodule/paypal') ?>">Paypal</a></li>
                            <li><a href="<?php echo site_url('adminmodule/creditcard') ?>">Credit Cart Payment</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $menu_config[4] ?>">
                <a href="<?php echo site_url('adminreport') ?>">Report</a>
            </li>
        </ul>
        <div class="clearer"></div>
    </div>
</div>
