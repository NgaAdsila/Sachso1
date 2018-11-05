<!DOCTYPE html>
<html>
    <head>
        <meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>/template/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/template/css/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/template/css/bootstrap/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>/template/icon/logo1.png" />
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url(); ?>/template/css/manager/layout.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="header-man">
            <?php $this->load->view($header, $name); ?>
        </div>
        <div id="layout">
            <div id="layout_body">
                <?php if (isset($manager_content) & isset($data_content)) {
                    $this->load->view($manager_content, $data_content);
                } elseif (isset ($manager_content)) {
                    $this->load->view($manager_content);
                } ?>
            </div>
        </div>
    </body>
</html>