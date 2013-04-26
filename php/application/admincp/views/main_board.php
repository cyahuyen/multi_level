<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $title; ?></title>
        <meta name="description" content="Oldest, safest and most popular payment processor operating in World Wide and serving millions all around a world. Store your funds privately in gold, Euro or USD. Use e-GlobalCash digital money in on-line casinos, poker rooms, sports betting, forex or in any other on-line store."/>
        <meta name="keywords" content=""/>
        <!--META KEYWORDS-->
        <meta name="author" content="ngoclc"/>
        <?php $this->load->view('includes/header_link'); ?>
    </head>
    <body>
        <div class="wrapper">
            <!-- START HEADER -->
            <div id="header">
                <?php $this->load->view('includes/menu_top'); ?>
            </div>
            <!-- END HEADER -->
            <!-- START MAIN -->
            <div id="main">
                <!-- START SIDEBAR -->
                <div id="sidebar">
                    <!-- start sidemenu -->
                    <div id="sidemenu">
                        <?php $this->load->view('includes/menu_left'); ?>
                    </div>
                    <!-- end sidemenu -->
                </div>
                <!-- END SIDEBAR -->
                <!-- START PAGE -->
                <div id="page">
                    <div class="content">
                        <?php if (!empty($notice_permission)) { ?>
                            <div class="simple-tips">
                                <ul>
                                    <li><?php echo $notice_permission; ?></li>
                                </ul>
                                <a href="#" class="close tips" title="Close">close</a>
                            </div>
                        <?php } ?>
                        <?php $this->load->view($main_content); ?>
                    </div>
                </div>
                <!-- END PAGE -->
                <div class="clear"></div>
            </div>
            <!-- END MAIN -->
            <!-- START FOOTER -->
            <div id="footer">
                <div class="left-column"><?php $this->load->view('includes/copyright.php'); ?></div>
                <div class="right-column"></div>
            </div>
            <!-- END FOOTER -->
        </div>
    </body>
</html>
<!--HTML ENDS  -->