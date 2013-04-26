<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>CYACASH - Payment Network Service</title>
        <meta name="description" content="Oldest, safest and most popular payment processor operating in World Wide and serving millions all around a world. Store your funds privately in gold, Euro or USD. Use e-GlobalCash digital money in on-line casinos, poker rooms, sports betting, forex or in any other on-line store."/>
        <meta name="keywords" content=""/>
        <!--META KEYWORDS-->
        <meta name="author" content="trendyWebstar"/>
        <?php $this->load->view('includes/header_link'); ?>
    </head>
    <body>
        <div id="wrapper">
            <div class="center">
                <div id="container">
                    <header id="header">
                        <div id="logo">
                            <a href="<?php echo site_url('home');?>">E-GLOBALCA$H</a>
                        </div>
                        <!--LOGO ENDS  -->
                        <nav id="main_navigation" class="main-menu ">
                            <!--  MAIN  NAVIGATION-->
                            <?php $this->load->view('includes/menu_top'); ?>
                        </nav>
                        <!-- MAIN NAVIGATION ENDS-->
                    </header>
                    <div id="content">
                        <div class="one">
                            <!-- COLUMNS CONTAINER STARTS-->
                            <!-- INTRO DIV STARTS-->
                            <div class="intro-pages">						
                                <?php $this->load->view('includes/intro'); ?>
                            </div>
                            <!-- INTRO ENDS-->
                        </div>

                        <div class="one">
                            <div class="one-fourth">
                                <?php $this->load->view('includes/menu_left'); ?>
                            </div>  
                            <div class="inner-content last">
                                <?php $this->load->view($main_content); ?>
                            </div>
                            <div class="horizontal-line">
                            </div>
                        </div>


                        <footer id="footer-wrapper">
                            <!-- FOOTER WRAPPER STARTS-->

                            <!-- FOOTER CONTAINER ENDS-->
                        </footer>
                        <!-- FOOTER WRAPPER ENDS-->
                        <div id="copyright-wrapper">
                            <?php $this->load->view('includes/copyright.php'); ?>
                        </div>
                        <!-- COPYRIGHTS WRAPPER ENDS-->
                    </div>
                </div>
            </div>
        </div>

        <!-- START SWITCHER-->
        <!--  END OF SWITCHER-->
    </div>
</body>
<!--BODY ENDS  -->
</html>
<!--HTML ENDS  -->