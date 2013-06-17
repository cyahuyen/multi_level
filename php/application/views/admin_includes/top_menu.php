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
            <li class="<?php echo $menu_config[0] ?>"><?php echo anchor('admin', 'Home'); ?></li>
            <li class="<?php echo $menu_config[1] ?>">
                <a href="<?php echo site_url('adminuser/manager') ?>">Users</a>
                <ul>
                    <li><a href="<?php echo site_url('adminuser/profile') ?>">Create User</a></li>
                    <li><a href="<?php echo site_url('adminuser/manager') ?>">Manage Users</a></li>
                </ul>
            </li>
            <li class="<?php echo $menu_config[2] ?>">
                <a href="<?php echo site_url('adminconfig') ?>">Configuration</a>
                <ul>
                    <li><a href="<?php echo site_url('adminconfig/emails') ?>">Email</a></li>
                    <li><a href="<?php echo site_url('adminconfig/transaction_fees') ?>">Transaction Fee</a></li>
                    <li><a href="<?php echo site_url('adminconfig/referral') ?>">Referral</a></li>
                    <li><a href="<?php echo site_url('adminconfig/timeconfig') ?>">Date/Time</a></li>
                    <li><a href="<?php echo site_url('adminconfig/referraldefault') ?>">Referral Default Config</a></li>
                    <li><a href="<?php echo site_url('adminconfig/withdrawal') ?>">Withdrawal Config</a></li>
                </ul>
            </li>
            <li class="<?php echo $menu_config[3] ?>">
                <a href="#">Modules</a>
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
            <li class="<?php echo $menu_config[5] ?>"><a href="<?php echo site_url('admintransfer') ?>">Transaction</a></li>
            <li class="<?php echo $menu_config[6] ?>"><a href="<?php echo site_url('adminemail/manager') ?>">Email Manager</a></li>
            <li class="<?php echo $menu_config[7] ?>"><a href="<?php echo site_url('adminwithdrawal/manager') ?>">Withdrawal Manager</a></li>
            <li class="<?php echo $menu_config[8] ?>">
                <a href="#">Tools</a>
                <ul>
                    <li>
                        <a href="<?php echo site_url('admintool/sent_mail') ?>">Sent Mail</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="clearer"></div>
    </div>
</div>
