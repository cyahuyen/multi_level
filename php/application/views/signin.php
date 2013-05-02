<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title; ?></title>
        <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <?php $this->load->view('includes/head_link'); ?>
    </head>
    <body>
        <div class="page-wrapper">
            <?php $this->load->view('includes/message'); ?>
            <div class="wrapper">
                <div class="top">
                    <div class="logo">
                        <a href="index.html">Logo</a>
                    </div>
                    <div class="topright">
                        <div class="usermenu">
                            
                            <div class="clearer"></div>
                        </div>
                    </div>
                    <div class="clearer" style="height:1px; background-color:#fff"></div>
                    <div class="mainmenu">
                        
                        <div class="clearer"></div>
                    </div>
                </div>

                <div class="content">
                    <?php $this->load->view($main_content); ?>
                </div>
            </div>
        </div>
    </body>
</html>