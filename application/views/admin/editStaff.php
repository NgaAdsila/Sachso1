<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Sửa thông tin nhân viên thành công');" .
        "</script>";
    redirect('admin/Staff/viewListStaff', 'refresh');
}
?>
<p class="new_title">SỬA THÔNG TIN NHÂN VIÊN</p>
<div class="col-md-offset-2">
    <form action="<?php echo site_url(); ?>admin/Staff/validateEdit/<?php echo $staff[0]['staffID']?>" 
        method="post" class="form-horizontal" role="form">
        <?php foreach ($staff as $staffInfo):?>
        <div class="form-group">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <input type="hidden" class="form-control" name="staffID"
                       value="<?php echo $staffInfo['staffID']; ?>">
            </div>
            <div class="col-md-4 error">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputName">Tên đăng nhập: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="staffName"
                       value="<?php echo $staffInfo['staffName']; ?>" disabled>
            </div>
            <div class="col-md-4 error">
                <span class="error"><?php echo form_error('staffName'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputFullName">Họ tên <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="staffFullName" autofocus="true"
                       value="<?php echo $staffInfo['fullName']; ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffFullName'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputSex">Giới tính <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <label class="radio-inline">
                    <input type="radio" name="staffSex" value="1" 
                        <?php if ($staffInfo['sex'] == 1){echo 'checked=checked';}?>>Nam
                </label>
                <label class="radio-inline">
                    <input type="radio" name="staffSex" value="0" 
                        <?php if ($staffInfo['sex'] == 0){echo 'checked=checked';}?>>Nữ
                </label>
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffSex'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputRole">Chức vụ <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="staffRole"
                       value="<?php echo $staffInfo['roleName']; ?>" disabled>
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffRole'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputHomeLand">Quê quán <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="staffHomeLand"
                       value="<?php echo $staffInfo['homeLand']; ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffHomeLand'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputAdd">Nơi ở hiện tại <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="staffAdd"
                       value="<?php echo $staffInfo['add']; ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffAdd'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputTel">Số điện thoại <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="tel" class="form-control" name="staffTel"
                       value="<?php echo $staffInfo['tel']; ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffTel'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputEmail">Email <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="email" class="form-control" name="staffEmail"
                       value="<?php echo $staffInfo['email']; ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffEmail'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputOldPass">Mật khẩu cũ <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="password" class="form-control" name="staffOldPass">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffOldPass'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputNewPass">Mật khẩu mới: </label>
            </div>
            <div class="col-md-4">
                <input type="password" class="form-control" name="staffNewPass">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffNewPass'); ?></span>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="col-md-10 text-center">
            <button type="reset" class="btn btn-default" style="width: 100px">Nhập lại</button>
            <button type="submit" class="btn btn-default" style="width: 100px">Cập nhật</button>
        </div>
    </form>
</div>
