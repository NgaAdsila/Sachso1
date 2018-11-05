<html>
    <head>
        <meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>/template/icon/logo1.png" />
        <title>Đăng nhập</title>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/template/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>/template/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/template/css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="text-center">
            <h3>BẠN ĐANG TRUY CẬP TRANG QUẢN TRỊ HỆ THỐNG</h3>
            <a href="#login-modal" class="btn btn-default" data-toggle="modal">Đăng nhập</a>
            <p style="color: red; margin-top: 5px">
                <span class="fa fa-warning"></span> Nếu bạn không phải là quản lý thì hãy 
                <a href="<?php echo site_url(); ?>"><span class="fa fa-reply-all"></span> quay lại trang chủ</a>
            </p>
        </div>
    <div class="modal fade" id="login-modal" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><strong>ĐĂNG NHẬP</strong></h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="managerName" id="managerName" autofocus="true"
                       placeholder="Tên đăng nhập" style="margin-bottom: 10px">
                    <input type="password" class="form-control" name="managerPass" id="managerPass"
                       placeholder="Mật khẩu" style="margin-bottom: 10px">
                    <div class="text-center" id="errorLogin" style="color: red;"></div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button id="sendLogin" type="submit" class="btn btn-danger">Đăng nhập</button>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sendLogin').click(function () {
            if (($('#managerName').val().trim() === "")||($('#managerPass').val().trim() === "")) {
                $('#errorLogin').html('Bạn chưa nhập đủ thông tin yêu cầu!');
                return false;
            } else {
                $.post(
                    "<?php echo site_url(); ?>manager/Account/ajax_login",
                    {managerName: $('#managerName').val(),managerPass: $('#managerPass').val()},
                    function (result) {
                        if(result === 'false'){
                            $('#errorLogin').html('Tên đăng nhập hoặc mật khẩu không chính xác!');
                        } else {
                            if (result === 'notMAN'){
                                $('#errorLogin').html('Bạn không có quyền truy cập trang quản trị!');
                            } else {
                                $('.modal-body').html('Đăng nhập thành công!');
                                window.location = "<?php echo site_url(); ?>"+result;
                            }
                        }
                    },
                    "text"
                );
                return true;
            }
        });
    });
</script>