<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Chúc mừng bạn đã đăng ký thành viên thành công!');</script>";
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
                    <strong>ĐĂNG KÝ THÀNH VIÊN</strong>
                </div>
                <div class="panel-body">
                    <form action="<?php echo site_url(); ?>member/Account/registValidate" 
                        method="post" class="form-horizontal" role="form" id="regist-form">
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputName">Tên đăng nhập <span class="red">(*)</span>:</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="memberName"
                                       value="<?php echo set_value('memberName'); ?>"
                                       autofocus="true" placeholder="Tên đăng nhập">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberName'); ?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputFullName">Họ tên <span class="red">(*)</span>: </label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="memberFullName"
                                       value="<?php echo set_value('memberFullName'); ?>"
                                       placeholder="Họ tên">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberFullName'); ?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputSex">Giới tính <span class="red">(*)</span>: </label>
                            </div>
                            <div class="col-md-7">
                                <label class="radio-inline">
                                    <input type="radio" name="memberSex" value="1" <?php echo set_radio('memberSex', '1'); ?>>Nam
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="memberSex" value="0" <?php echo set_radio('female', '0'); ?>>Nữ
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberSex'); ?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputAdd">Địa chỉ <span class="red">(*)</span>: </label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="memberAdd"
                                       value="<?php echo set_value('memberAdd'); ?>"
                                       placeholder="Địa chỉ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberAdd'); ?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputTel">Số điện thoại <span class="red">(*)</span>: </label>
                            </div>
                            <div class="col-md-7">
                                <input type="tel" class="form-control" name="memberTel"
                                       value="<?php echo set_value('memberTel'); ?>"
                                       placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberTel'); ?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputEmail">Email <span class="red">(*)</span>: </label>
                            </div>
                            <div class="col-md-7">
                                <input type="email" class="form-control" name="memberEmail"
                                       placeholder="Email (vd: member@gmail.com)"
                                       value="<?php echo set_value('memberEmail'); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberEmail'); ?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputPass">Mật khẩu <span class="red">(*)</span>: </label>
                            </div>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="memberPass"
                                       placeholder="Mật khẩu (Tối thiểu 6 ký tự)">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberPass'); ?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputRePass">Nhập lại mật khẩu <span class="red">(*)</span>: </label>
                            </div>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="memberRePass"
                                       placeholder="Nhập lại mật khẩu">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="error"><?php echo form_error('memberRePass'); ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="reset" id="reset" class="btn btn-default" style="width: 100px">Nhập lại</button>
                            <button type="submit" class="btn btn-default" style="width: 100px">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>