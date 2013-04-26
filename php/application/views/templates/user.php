<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title; ?> | Job Management | William Loud Australia PTY LTD</title>

        <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />

        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/template.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui-1.9.0.custom.min.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/superfish.css"/>
        <link type="text/css" href="<?php echo base_url(); ?>css/autocomplete.css" rel="stylesheet" />

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.9.0.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/hoverIntent.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/superfish.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-jscontext-1.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete.js"></script>
        

        <script>
            $(document).ready(function() {
			
                /* Menu */
			
                $('ul.sf-menu').superfish();

                /* Collapsible panels */
			
                $(".collapsible div.header").click( function() {
                    var collapsible = $(this).parent();
                    if ($(this).hasClass("header-closed")) {
                        $(this).removeClass("header-closed");
                        $(this).find("img").attr("src",
                        $(this).find("img").attr("src").replace("col","exp"));
                        $(collapsible).find("div.body").removeClass("header-closed");
                    } else {
                        $(this).addClass("header-closed");
                        $(this).find("img").attr("src",
                        $(this).find("img").attr("src").replace("exp","col"));
                        $(collapsible).find("div.body").addClass("header-closed");
                    }
                    $(collapsible).find("div.body").slideToggle();
                });
			
                showCompMsgs();

                initDirtyCheck();

            });

            function showCompMsgs() {
                $("[id^=cmsg]").each(function() {
                    var target = $(this).attr("id").substring(4); /* everything after 'cmsg' */
                    var msg = $(this).val();
                    $("[id$=" + target + "]").not("[id^=cmsg]").addClass("error");
                    var icon = document.createElement("img");
                    $(icon).addClass("error");
                    $(icon).attr("src", "<?php echo base_url(); ?>img/sev/error.jpg");
                    $(icon).attr("title", msg);
                    $("[id$=" + target + "]").not("[id^=cmsg]").after(icon);
                });
                if ($('img.mandatory').length == 0) {
                    $(".mandatory").not("img.mandatory").each(function() {
                        var nextEl = $(this).next();
                        if (!$(nextEl).hasClass("error")) {
                            var icon = document.createElement("img");
                            $(icon).addClass("mandatory");
                            $(icon).attr("src", "<?php echo base_url(); ?>img/sev/required.jpg");
                            $(icon).attr("title", "This is a required value");
                            $(this).after(icon);
                        }
                    });
                }
            }

            var isdirty = false;
            function initDirtyCheck() {
                isdirty = false;
                $(":input").not(".allowdirty").change( function (objEvent) { 
                    isdirty = true;
                });
                /* set dirty check conf on menus, tabs and components with class '.checkdirty' */
                $(".mainmenu a").click( function () { return confirmAction(); } );
                $("td.tab").click( function () { return confirmAction(); } );
                $(".checkdirty").click( function () { return confirmAction(); } );
            }
    	
            function confirmAction(entity) {
                if (!isdirty) return true;
                if (entity == null || entity == "") entity = "Data";
                var msg = entity + " has been modified and not saved. If you continue your changes will be lost.";
                msg += "\n\nDo you wish to continue?";
                return confirm(msg);
            }
    	
            function confirmDelete() {
                return confirm("Delete is permanent, it cannot be undone.\n\nDo you wish to continue?");
            }

        </script>
    </head>
    <body>
        <div class="page-wrapper">

            <div id="msg" class="msg">
                <div id="msg_renderarea">
                    <div id="msgContainer" style="display:<?php if (isset($usermessage)) {
    echo 'block';
} else {
    echo 'none';
} ?>">
                        <table>
                            <tr>
                                <td class="msgicon">
                                    <img id="msgicon" src="<?php echo base_url(); ?>img/sev/<?php if (isset($usermessage)) echo $usermessage[0]; ?>.jpg" alt="" />
                                </td>
                                <td>
                                    <div id="msgtitle" style="color:<?php if (isset($usermessage)) echo $usermessage[1]; ?>"><?php if (isset($usermessage)) echo $usermessage[2]; ?></div>
                                    <div id="msgdesc"><?php if (isset($usermessage)) echo $usermessage[3]; ?></div>
                                </td>
                            </tr>
                        </table>
                        <?php
                        if (isset($fielderrors)) {
                            foreach (array_keys($fielderrors) as $fieldid) {
                                echo '<input type="hidden" id="cmsg' . $fieldid . '" value="' . $fielderrors[$fieldid] . '"/>';
                            }
                        }
                        ?>
                    </div>
                    <script type="text/javascript">
                        function showmessage(type, title, desc) {
                            $("#msgicon").attr("src", "<?php echo base_url(); ?>img/sev/" + type + ".jpg");
                            $("#msgtitle").html(title);
                            if (type == 'success')
                                $("#msgtitle").css("color", "green");
                            else if (type == 'warn')
                                $("#msgtitle").css("color", "darkorange");
                            else if (type == 'error' || type == 'fatal')
                                $("#msgtitle").css("color", "darkred");
                            else
                                $("#msgtitle").css("color", "#0000a0");
                            $("#msgdesc").html(desc);
                            $("#msgContainer").css("display", "block");
                        }
                        function hidemessage() { $("#msgContainer").css("display", "none"); }
                    </script>
                </div>
                <div id="msg_popup" title="<?php if (isset($popupmessage)) echo $popupmessage; ?>" style="display:block">
                    <?php
                    if (isset($popupmessages)) {
                        foreach ($popupmessages as $message) {
                            echo '<div>' . $message . '</div>';
                        }
                    }
                    ?>
                </div>
                <script>$("#msg_popup").dialog({ height:240,width:400,autoOpen:<?php if (isset($popupmessage)) {
                        echo 'true';
                    } else {
                        echo 'false';
                    } ?>,modal:false,resizable:false });</script>
            </div>

            <div class="wrapper">

                <div class="top">
                    <div class="logo">
                        <a href="index.html">William Loud Australia PTY LTD</a>
                    </div>
                    <div class="topright">
                        <div class="usermenu">
                            <ul>
                                <li><?php echo anchor('myprofile', $this->session->userdata('personname'), array('class' => 'checkdirty')); ?></li>
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
                            <?php if($user[0]->usertype == 'Administrator'){ ?>
                            <li class="<?php echo $menu_config[1] ?>">
                                <a href="<?php echo site_url('user/manage') ?>">User</a>
                                <ul>
                                    <li><a href="<?php echo site_url('user/profile') ?>">Create User</a></li>
                                    <li><a href="<?php echo site_url('user/manage') ?>">Manage User</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if(in_array($user[0]->usertype,array('StaffManager','Staff'))){ ?>
                            <li class="<?php echo $menu_config[2] ?>">
                                <a href="<?php echo site_url('job/manage') ?>">Jobs</a>
                                <ul>
                                    <?php if($user[0]->usertype == 'StaffManager'){ ?>
                                    <li><a href="<?php echo site_url('job/profile') ?>">Create Job</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo site_url('job/manage') ?>">Manage Jobs</a></li>
                                    <li><a href="<?php echo site_url('product/manage') ?>">Manage Products</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if(in_array($user[0]->usertype,array('StaffManager','Administrator'))){ ?>
                            <li class="<?php echo $menu_config[3] ?>">
                                <a href="<?php echo site_url('staff/manage') ?>">Staff</a>
                                <ul>
                                    <li><a href="<?php echo site_url('staff/profile') ?>">Add an Employee</a></li>
                                    <li><a href="<?php echo site_url('staff/manage') ?>">Manage Staff</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if(in_array($user[0]->usertype,array('StaffManager','Staff'))){ ?>
                            <li class="<?php echo $menu_config[4] ?>">
                                <a href="">Timesheets</a>
                                <ul>
                                    <li><a href="">My Current Timesheet</a></li>
                                    <li><a href="">My Timesheets</a></li>
                                    <?php if(in_array($user[0]->usertype,array('StaffManager'))){ ?>
                                    <li><a href="">Manage Staff Timesheets</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="<?php echo $menu_config[5] ?>"><a href="">Reports</a></li>
                            <?php } ?>
                            
                            
                        </ul>
                        <div class="clearer"></div>
                    </div>
                </div>

                <div class="content">

<?php echo $body; ?>

                </div>
            </div>

        </div>
    </body>
</html>