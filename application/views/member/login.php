<?php 
if ($lock == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Tài khoản của bạn đang bị khóa! Hãy liên hệ ADMIN để được hỗ trợ');</script>";
    redirect('member/Account/login', 'refresh');
}
if ($unlock == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Đăng nhập thành công!');</script>";
    $referred_from = $this->session->userdata('referred_from');
    redirect($referred_from, 'refresh');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">
                    <strong>ĐĂNG NHẬP HỆ THỐNG</strong>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container-fluid">
                            <form action="<?php  echo site_url(); ?>member/Account/loginValidate" method="post">
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label for="inputName">Tên đăng nhập <span class="red">(*)</span>: </label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="memberName"
                                               value="<?php echo set_value('memberName'); ?>" autofocus="true"
                                               placeholder="Nhập tên tài khoản" style="margin-bottom: 10px"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label for="inputPass">Mật khẩu <span class="red">(*)</span>: </label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="memberPass"
                                           value="<?php echo set_value('memberPass'); ?>"
                                           placeholder="Nhập mật khẩu" style="margin-bottom: 10px"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox text-center">
                                        <label>
                                            <input name="remember" type="checkbox"/> Ghi nhớ đăng nhập</label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-default" style="width: 100px;margin-bottom: 5px">Đăng nhập</button>
                                </div>
                            </form>
                            <span class="error"><?php echo validation_errors(); ?></span>
                            <p class="col-md-12 text-center">Bạn chưa có tài khoản? Hãy <a href="<?php echo site_url(); ?>member/Account/regist" style="color: red;"><b>Đăng ký ngay!</b></a></p>
                            <p class="col-md-12 text-center">
                                <a href="#forgetPass-modal" data-toggle="modal"><b>Quên mật khẩu?</b></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!-- Modal-forgetPass -->
<div class="modal fade" id="forgetPass-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>QUÊN MẬT KHẨU</strong></h4>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow: auto">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="infoName">Tên đăng nhập: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" autofocus="true" id="nameFP" style="margin-bottom: 5px"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="infoEmail">Nhập Email đăng ký: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="emailFP" style="margin-bottom: 5px"/>
                        </div>
                    </div>
                    <div class="text-center" id="errorFP" style="color: red;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="exitFP" type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button id="sendFP" type="submit" class="btn btn-info">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sendFP').click(function () {
            if (($('#nameFP').val().trim() === "")||($('#emailFP').val().trim() === "")) {
                $('#errorFP').html('Bạn chưa nhập đủ thông tin yêu cầu!');
                return false;
            } else {
                $.post(
                    "<?php echo site_url(); ?>member/Account/forgetPass",
                    {nameFP: $('#nameFP').val(),emailFP: $('#emailFP').val()},
                    function (result) {
                        if(result === 'false'){
                            $('#errorFP').html('Tài khoản hoặc email bạn nhập không chính xác!');
                        } else {
                            $('.modal-body').html(result);
                            $('#sendFP').attr('disabled', 'disabled');
                            $('#exitFP').text('Đóng');
                        }
                    },
                    "text"
                );
                return true;
            }
        });
    });
</script>