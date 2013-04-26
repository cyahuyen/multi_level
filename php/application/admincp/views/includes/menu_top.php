<?php $this->lang->load('home'); ?>
<!-- logo -->
<div class="logo">

</div>
<!-- profile box -->
<div id="profilebox">
    <a href="#" class="display">

        <img src="<?php echo base_url(); ?>img/simple-profile-img.jpg" width="33" height="33" alt="profile"/>
        <b>Logged in as</b><span><?php echo $this->session->userdata('username'); ?></span>
    </a>

    <div class="profilemenu">
        <ul>
            <li><a href="<?php echo site_url('auth/logout'); ?>" class="Logout">Logout</a></li>
        </ul>
    </div>

</div>


<div class="clear"></div>

