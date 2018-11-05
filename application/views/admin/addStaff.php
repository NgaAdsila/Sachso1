<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Thêm nhân viên thành công');" .
        "</script>";
    redirect('admin/Staff/viewListStaff', 'refresh');
}
?>
<p class="new_title">THÊM NHÂN VIÊN MỚI</p>
<div class="col-md-offset-2">
    <form action="<?php echo site_url(); ?>admin/Staff/validateAdd" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputName">Tên đăng nhập <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="staffName" autofocus="true"
                       value="<?php echo set_value('staffName'); ?>">
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
                <input type="text" class="form-control" name="staffFullName"
                       value="<?php echo set_value('staffFullName'); ?>">
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
                    <input type="radio" name="staffSex" value="1" <?php echo set_radio('staffSex', '1'); ?>>Nam
                </label>
                <label class="radio-inline">
                    <input type="radio" name="staffSex" value="0" <?php echo set_radio('female', '0'); ?>>Nữ
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
                <select class="form-control" name="staffRole">
                    <option value="" selected="selected">Chọn chức vụ</option>
                    <?php foreach ($role as $role_data): ?>
                        <option value="<?php echo $role_data['roleID'] ?>"
                                <?php echo set_select('staffRole', $role_data['roleID']); ?>>
                                    <?php echo $role_data['roleName'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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
                       value="<?php echo set_value('staffHomeLand'); ?>">
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
                       value="<?php echo set_value('staffAdd'); ?>">
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
                       value="<?php echo set_value('staffTel'); ?>">
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
                       placeholder="vd: staff@gmail.com"
                       value="<?php echo set_value('staffEmail'); ?>">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffEmail'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputPass">Mật khẩu <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="password" class="form-control" name="staffPass">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffPass'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="inputRePass">Nhập lại mật khẩu <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="password" class="form-control" name="staffRePass">
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('staffRePass'); ?></span>
            </div>
        </div>
        <div class="col-md-10 text-center">
            <button type="reset" class="btn btn-default" style="width: 100px">Nhập lại</button>
            <button type="submit" class="btn btn-default" style="width: 100px">Thêm</button>
        </div>
    </form>
</div>
