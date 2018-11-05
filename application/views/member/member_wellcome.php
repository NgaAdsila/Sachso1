<ul class="nav navbar-nav navbar-right">
    <li><a href="<?php echo site_url(); ?>member/Account/personalManage">
            <span class="fa fa-user"></span> Xin chào: <?php echo $memberName; ?>
        </a>
    </li>
    <li>
        <a href="<?php echo site_url(); ?>member/Account/logout" onClick="return confirm('Bạn muốn đăng xuất?')">
            <span class="fa fa-sign-out"></span> Thoát
        </a>
    </li>
</ul>