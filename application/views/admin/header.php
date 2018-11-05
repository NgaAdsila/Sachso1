<nav class="navbar navbar-default" role="navigation" style="background: lightgreen;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menubar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo site_url().'admin/AdminMain/home';?>" class="navbar-brand">Quản trị hệ thống</a>
        </div>
        <div class="collapse navbar-collapse" id="menubar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="javascript:void(0)" class="cate-menu dropdown-toggle" data-toggle="dropdown" style="color: #777;font-size: 13pt">
                    <span class="fa fa-list"></span> Menu quản lý <span class="caret"></span></a>
                    <ul class="dropdown-menu menu nav nav-pills nav-stacked" role="menu" aria-labelledby="multi-level">
                        <?php $this->load->view('admin/bar'); ?>
                    </ul>
                </li>
                <li><a href="<?php echo site_url().'admin/AdminMain/introduce';?>" style="font-size: 13pt">Giới thiệu</a></li>
            </ul>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo site_url();?>admin/Account/index">
                            <span class="glyphicon glyphicon-user"></span>Xin chào: <?php echo $admin_name; ?>
                        </a></li>
                    <li>
                        <a href="<?php echo site_url();?>admin/Account/logout" onClick="return confirm('Bạn muốn đăng xuất?')">
                            <span class="glyphicon glyphicon-log-out"></span>Thoát
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>