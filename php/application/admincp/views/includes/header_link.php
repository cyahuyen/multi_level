<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/reset.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/extends.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/root.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/grid.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/typography.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/jquery-plugin-base.css" />

<!--[if IE 7]>	  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/ie7-style.css" />	<![endif]-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-settings.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/toogle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.uniform.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/raphael.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/analytics.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popup.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fullcalendar.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.slider.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.accordion.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/core.js"></script>

<script type="text/javascript">
    //-----------------------------------------
    // Confirm Actions (delete, uninstall)
    //-----------------------------------------
    $(document).ready(function(){
        // Confirm Delete
        $('#form').submit(function(){
            if ($(this).attr('action').indexOf('delete',1) != -1) {
                if (!confirm('Are you sure delete')) {
                    return false;
                }
            }
        });
    	
        // Confirm Uninstall
        $('a').click(function(){
            if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
                if (!confirm('Are you sure delete')) {
                    return false;
                }
            }
        });
    });
</script>