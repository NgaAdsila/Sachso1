<div class="panel panel-default">
    <div class="panel-body">
        <h3 style="font-family: 'Book Antiqua';font-weight: bolder; text-align: center; margin-bottom: 20px">
            Bạn có điều gì thắc mắc? Hãy liên hệ với chúng tôi ngay!</h3>
        <div class="row">
            <div class="container-fluid">
                <div class="col-md-3">
                    <div class="footer-header" style="margin-bottom: 10px">
                        <strong><span class="fa fa-home"></span> Về cửa hàng</strong>
                    </div>
                    <div class="footer-links">
                        <ul style="list-style-type: none;padding-left: 0px">
                            <li><a href="<?php echo site_url().'Home/introduce'?>">Giới thiệu website</a></li>
                            <li><a href="<?php echo site_url().'Home/security'?>">Chính sách bảo mật</a></li>
                            <li><a href="<?php echo site_url().'Home/guide'?>">Điều khoản sử dụng</a></li>
                            <li><a href="<?php echo site_url().'Home/guide'?>">Hình thức thanh toán</a></li>
                            <li><a href="<?php echo site_url().'Home/guide'?>">Giao hàng toàn quốc</a></li>
                            <li><a href="<?php echo site_url().'Home/guide'?>">Hỗ trợ khách hàng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-header" style="margin-bottom: 10px">
                        <strong><span class="fa fa-user"></span> Tài khoản của bạn</strong>
                    </div>
                    <div class="footer-links">
                        <ul style="list-style-type: none;padding-left: 0px">
                            <?php 
                            if (isset($login)){
                                if(isset($wellcome)){
                            ?>
                            <li><a href="<?php echo site_url(); ?>member/Account/personalManage">Quản lý tài khoản</a></li>
                            <li><a href="<?php echo site_url(); ?>member/Account/logout" onClick="return confirm('Bạn muốn đăng xuất?')">Đăng xuất</a></li>
                            <li><a href="<?php echo site_url() . 'member/Cart/view';?>">Giỏ hàng của tôi</a></li>
                            <?php } else { ?>
                            <li><a href="<?php echo site_url(); ?>member/Account/login">Đăng nhập</a></li>
                            <li><a href="<?php echo site_url(); ?>member/Account/regist">Đăng ký</a></li>                            
                            <?php }} ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-header" style="margin-bottom: 10px">
                        <strong><span class="glyphicon glyphicon-link"></span> Liên kết</strong>
                    </div>
                    <div class="footer-links">
                        <ul style="list-style-type: none;padding-left: 0px">
                            <li>
                                <a href="https://www.facebook.com/book.wonfriend/" target="_blank">
                                    <span class="fa fa-facebook-square" style="font-size: 20px"></span> Fanpage
                                </a>
                            </li>
                            <li>
                                <a href="https://youtube.com/" target="_blank">
                                    <span class="fa fa-youtube-square" style="font-size: 20px"></span> Youtube
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/book.wonfriend/" target="_blank">
                                    <span class="fa fa-twitter-square" style="font-size: 20px"></span> Twitter
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <div class="footer-header" style="margin-bottom: 10px;border-bottom: 1px dotted #cccccc">
                            <strong><span class="fa fa-info-circle"></span> Thông tin liên hệ</strong>
                        </div>
                        <div class="foot-info" style="font-size: 9pt">
                            <p>TRUNG TÂM DỊCH VỤ TRỰC TUYẾN</p>
                            <p><strong>Quản trị viên: Hà Quang Ngà</strong></p>
                            <p>
                                <strong style="color: red">HUST</strong>
                                - 
                                <i>Hanoi University of Science and Technology</i>
                            </p>
                            <p>Trụ sở: Số 1, Đại Cồ Việt, Hai Bà Trưng, Hà Nội</p>
                            <p>(+84)168 819 1991 - (+84)127 709 1266</p>
                            <p>
                                <a href="#">hotro@Sachso1.com</a>
                            </p>
                            <h5>Sản phẩm đồ án tốt nghiệp Hệ thống thông tin năm 2016!</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4 style="text-align: center;font-family: 'TimeNewRoman'">
            Copy right &copy; 2016 - Sachso1 - Sách, người bạn tuyệt vời của chúng ta!</h4>
    </div>
</div>