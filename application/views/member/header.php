<nav class="navbar navbar-default" style="border-left: none; border-right: none;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 text-justify navbar-brand">
                <a href="<?php echo site_url(); ?>">
                    <img src="<?php echo site_url(); ?>/template/icon/logo.png" style="margin-left: 10px"/>
                </a>
                <i style="font-family: 'TimeNewRoman';font-size: 140%">
                    <span style="color: darkslategrey;font-weight: bold">Sách,</span>
                    <span style="color: lightslategray;font-weight: bold"> bạn thân của chúng ta!</span>
                </i>
            </div>
            <div class="col-md-5 right-header">
                <div class="container-fluid">
                    <div id="login">
                        <?php
                        if (isset($login)) {
                            if (isset($wellcome))
                                $this->load->view($login, $wellcome);
                            else {
                                $this->load->view($login);
                            }
                        }
                        ?>
                    </div>
                    <div style="clear: right"></div>
                    <div class="nav navbar-nav navbar-right">
                        Chào mừng bạn đến với cửa hàng!
                    </div>
                    <div style="clear: right"></div>
                    <div class="nav navbar-nav navbar-right quick-cart">
                        <a href="<?php
                        if (!isset($login) || !isset($wellcome)) {
                            echo 'javascript:void(0)';
                        } else {
                            echo site_url() . 'member/Cart/view';
                        }
                        ?>">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng của tôi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>