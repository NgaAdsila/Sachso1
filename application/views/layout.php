<!DOCTYPE html>
<html>
    <head>
        <meta name=”viewport” content=”width=device-width, initial-scale=1.0 user-scalable="yes"″>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url(); ?>/template/js/rateit.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>/template/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/template/js/jquery.rateit.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/template/css/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/template/css/bootstrap/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>/template/icon/logo1.png" />
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url(); ?>/template/css/layout.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!--------------------------------header------------------------------->
        <div id="header">
                <?php $this->load->view('member/header'); ?>
        </div>
        <!--------------------------------menubar------------------------------>
        <div id="menu-bar">
                <?php if (isset($menubar_main) && isset($data_menubar)) {
                        $this->load->view($menubar_main, $data_menubar);
                }?>
        </div>
        <div id="layout">
            <!--------------------------------content------------------------------>
            <div id="content" class="row">
                <!--------------------------------nav_bar -------------------------------------->
                <?php if (isset($nav_bar) && isset($bar_name)) {
                    $this->load->view($nav_bar, $bar_name);
                }?>
                <!-------------------------- content_main ------------------------->
                <!--------------------------------banner------------------------------->
                <div id="banner">
                    <?php if (isset($banner_main) && isset($data_banner)) {
                        $this->load->view($banner_main, $data_banner);
                    }?>
                </div>
                <?php
                if (isset($content_main) && isset($data_content)) {
                    $this->load->view($content_main, $data_content);
                } else if (isset($content_main)) {
                    $this->load->view($content_main);
                }?>
            </div>
        </div>
    </body>
    <footer>
        <div id="footer">
            <?php $this->load->view('member/footer') ?>
        </div>
    </footer>
    <div class="scroll-top-wrapper ">
      <span class="scroll-top-inner">
        <i class="fa fa-2x fa-arrow-circle-up"></i>
      </span>
    </div>
    <script>
    $(document).ready(function(){
        $(function(){
            $(document).on( 'scroll', function(){
                if ($(window).scrollTop() > 100) {
                    $('.scroll-top-wrapper').addClass('show');
                } else {
                    $('.scroll-top-wrapper').removeClass('show');
                }
            });
            $('.scroll-top-wrapper').on('click', scrollToTop);
        });
        function scrollToTop() {
            verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
            element = $('body');
            offset = element.offset();
            offsetTop = offset.top;
            $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
        }
    });
    </script>
</html>