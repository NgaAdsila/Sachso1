<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Thêm thành viên thành công');" .
        "</script>";
    redirect('admin/Member/viewListMember', 'refresh');
}
?>
<p class="new_title">THÊM THÀNH VIÊN MỚI</p>
<div class="col-md-offset-2">
    <form action="<?php echo site_url(); ?>admin/Member/validateAdd" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputName">Tên đăng nhập <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="memberName" autofocus="true"
                       value="<?php echo set_value('memberName'); ?>">
            </div>
            <div class="col-md-4 error">
                <span class="error"><?php echo form_error('memberName'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputFullName">Họ tên <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="memberFullName"
                       value="<?php echo set_value('memberFullName'); ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('memberFullName'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputSex">Giới tính <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <label class="radio-inline">
                    <input type="radio" name="memberSex" value="1" <?php echo set_radio('memberSex', '1'); ?>>Nam
                </label>
                <label class="radio-inline">
                    <input type="radio" name="memberSex" value="0" <?php echo set_radio('female', '0'); ?>>Nữ
                </label>
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('memberSex'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputAdd">Địa chỉ <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="memberAdd"
                       value="<?php echo set_value('memberAdd'); ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('memberAdd'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputTel">Số điện thoại <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="tel" class="form-control" name="memberTel"
                       value="<?php echo set_value('memberTel'); ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('memberTel'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputEmail">Email <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="email" class="form-control" name="memberEmail"
                       placeholder="vd: member@gmail.com"
                       value="<?php echo set_value('memberEmail'); ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('memberEmail'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputPass">Mật khẩu <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="password" class="form-control" name="memberPass">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('memberPass'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputRePass">Nhập lại mật khẩu <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="password" class="form-control" name="memberRePass">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('memberRePass'); ?></span>
            </div>
        </div>
        <div class="col-md-10 text-center">
            <button type="reset" class="btn btn-default" style="width: 100px">Nhập lại</button>
            <button type="submit" class="btn btn-default" style="width: 100px">Thêm</button>
        </div>
    </form>
</div>