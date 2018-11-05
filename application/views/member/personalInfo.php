<div class="container-fluid">
    <div class="row">
        <?php foreach ($member as $memberInfo):?>
        <div class="col-md-2 text-center">
            <img src="<?php echo site_url(); ?>/template/icon/<?php 
                if($memberInfo['sex'] == 1){ 
                    echo 'male.png';
                }else{
                    echo 'female.png';
                }?>" alt="avatar" height="120"/>
            <p><strong><?php echo $memberInfo['fullName']; ?></strong></p>
        </div>
        <div class="col-md-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Tên</td>
                        <td><?php echo $memberInfo['fullName']; ?></td>
                        <td align="right"><a href="#name-modal" data-toggle="modal">Chỉnh sửa</a></td>
                    </tr>
                    <!-- Modal-name -->
                    <div class="modal fade" id="name-modal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center"><strong>Thay đổi họ tên</strong></h4>
                                </div>
                                <div class="modal-body" style="max-height: 500px; overflow: auto">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="inputFullName" style="line-height: 35px">Họ tên mới <span class="red">*</span>: </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="memberFullName" name="memberFullName" autofocus="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center" id="errorName" style="color: red;"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button id="saveName" type="submit" class="btn btn-info">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </thead>
                <tbody>
                    <tr>
                        <td>Giới tính</td>
                        <td>
                            <label class="radio-inline">
                                <input type="radio" name="memberSex" value="1" 
                                    <?php if ($memberInfo['sex'] == 1){echo 'checked=checked';}?>>Nam
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="memberSex" value="0" 
                                    <?php if ($memberInfo['sex'] == 0){echo 'checked=checked';}?>>Nữ
                            </label>
                        </td>
                        <td align="right"><a id="saveSex" href="javascript: void(0)" data-toggle="modal">Chỉnh sửa</a></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td><?php echo $memberInfo['add']; ?></td>
                        <td align="right"><a href="#add-modal" data-toggle="modal">Chỉnh sửa</a></td>
                    </tr>
                    <!-- Modal-name -->
                    <div class="modal fade" id="add-modal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center"><strong>Thay đổi địa chỉ</strong></h4>
                                </div>
                                <div class="modal-body" style="max-height: 500px; overflow: auto">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="inputAdd" style="line-height: 35px">Địa chỉ mới <span class="red">*</span>: </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="memberAdd" name="memberAdd">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center" id="errorAdd" style="color: red;"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button id="saveAdd" type="submit" class="btn btn-info">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td><?php echo $memberInfo['tel']; ?></td>
                        <td align="right"><a href="#tel-modal" data-toggle="modal">Chỉnh sửa</a></td>
                    </tr>
                    <!-- Modal-name -->
                    <div class="modal fade" id="tel-modal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center"><strong>Thay đổi số điện thoại</strong></h4>
                                </div>
                                <div class="modal-body" style="max-height: 500px; overflow: auto">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="inputTel" style="line-height: 35px">Số điện thoại mới <span class="red">*</span>: </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="tel" class="form-control" id="memberTel" name="memberTel">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center" style="color: lightcoral;">
                                        Lưu ý: Bạn nên nhập đúng số điện thoại của mình để tiện cho các tác vụ sau này!
                                    </div>
                                    <div class="col-md-12 text-center" id="errorTel" style="color: red;"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button id="saveTel" type="submit" class="btn btn-info">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><i style="color: blue"><?php echo $memberInfo['email']; ?></i></td>
                        <td align="right"><a href="#email-modal" data-toggle="modal">Chỉnh sửa</a></td>
                    </tr>
                    <!-- Modal-name -->
                    <div class="modal fade" id="email-modal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center"><strong>Thay đổi Email</strong></h4>
                                </div>
                                <div class="modal-body" style="max-height: 500px; overflow: auto">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="inputEmail" style="line-height: 35px">Email mới <span class="red">*</span>: </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" id="memberEmail" name="memberEmail">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center" style="color: lightcoral;">
                                        Lưu ý: Địa chỉ Email là duy nhất với mỗi tài khoản thành viên, bạn nên nhập
                                        đúng email để tiện cho các tác vụ sau này!
                                    </div>
                                    <div class="col-md-12 text-center" id="errorEmail" style="color: red;"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button id="saveEmail" type="submit" class="btn btn-info">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tr>
                    <tr>
                        <td>Mật khẩu</td>
                        <td>Bạn muốn cập nhật mật khẩu mới?</td>
                        <td align="right"><a href="#pass-modal" data-toggle="modal">Chỉnh sửa</a></td>
                    </tr>
                    <!-- Modal-name -->
                    <div class="modal fade" id="pass-modal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center"><strong>Thay đổi mật khẩu</strong></h4>
                                </div>
                                <div class="modal-body" style="max-height: 500px; overflow: auto">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="inputOldPass" style="line-height: 35px">Mật khẩu cũ <span class="red">*</span>: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" id="memberOldPass" name="memberOldPass">
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="inputNewPass" style="line-height: 35px">Mật khẩu mới <span class="red">*</span>: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" id="memberNewPass" name="memberNewPass">
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="inputRePass" style="line-height: 35px">Xác nhận mật khẩu <span class="red">*</span>: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" id="memberRePass" name="memberRePass">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center" style="color: lightcoral;">
                                            Lưu ý: Mật khẩu chỉ bao gồm chữ cái không dấu và ký tự số!
                                        </div>
                                        <div class="col-md-12 text-center" id="errorPass" style="color: red;"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button id="savePass" type="submit" class="btn btn-info">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endforeach;?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#saveName').click(function () {
            if ($('#memberFullName').val().trim() === "") {
                $('#errorName').html('Bạn chưa nhập họ tên mới!');
                return false;
            } else {
                $.post(
                    "<?php echo site_url(); ?>member/Account/editName",
                    {name: $('#memberFullName').val()},
                    function (result) {
                        $('.modal-body').html(result);
                        window.location.reload();
                    },
                    "text"
                );
                return true;
            }
        });
        $('#saveSex').click(function () {
            $.post(
                "<?php echo site_url(); ?>member/Account/editSex",
                {sex: $('[name="memberSex"]:radio:checked').val()},
                function (result) {
                    window.location.reload();
                },
                "text"
            );
            return true;
        });
        $('#saveAdd').click(function () {
            if ($('#memberAdd').val().trim() === "") {
                $('#errorAdd').html('Bạn chưa nhập địa chỉ mới!');
                return false;
            } else {
                $.post(
                    "<?php echo site_url(); ?>member/Account/editAdd",
                    {addr: $('#memberAdd').val()},
                    function (result) {
                        $('.modal-body').html(result);
                        window.location.reload();
                    },
                    "text"
                );
                return true;
            }
        });
        $('#saveTel').click(function () {
            if ($('#memberTel').val().trim() === "") {
                $('#errorTel').html('Bạn chưa nhập số điện thoại mới!');
                return false;
            } else {
                $.post(
                    "<?php echo site_url(); ?>member/Account/editTel",
                    {tel: $('#memberTel').val()},
                    function (result) {
                        if(result === 'errTel'){
                            $('#errorTel').html('Số điện thoại không hợp lệ!');
                        } else {
                            $('.modal-body').html(result);
                            window.location.reload();
                        }
                    },
                    "text"
                );
                return true;
            }
        });
        $('#saveEmail').click(function () {
            if ($('#memberEmail').val().trim() === "") {
                $('#errorEmail').html('Bạn chưa nhập địa chỉ Email mới!');
                return false;
            } else {
                $.post(
                    "<?php echo site_url(); ?>member/Account/editEmail",
                    {email: $('#memberEmail').val()},
                    function (result) {
                        if(result === 'errEmail'){
                            $('#errorEmail').html('Email không hợp lệ!');
                        } else if(result === 'existEmail'){
                            $('#errorEmail').html('Email đã tồn tại!');
                        } else {
                            $('.modal-body').html(result);
                            window.location.reload();
                        }
                    },
                    "text"
                );
                return true;
            }
        });
        $('#savePass').click(function () {
            if (($('#memberOldPass').val().trim() === "")||($('#memberNewPass').val().trim() === "")
                    ||($('#memberRePass').val().trim() === "")) {
                $('#errorPass').html('Bạn chưa nhập dủ thông tin yêu cầu!');
                return false;
            } else {
                $.post(
                    "<?php echo site_url(); ?>member/Account/editPass",
                    {oldPass: $('#memberOldPass').val(),newPass: $('#memberNewPass').val(),rePass: $('#memberRePass').val()},
                    function (result) {
                        if(result === 'errOldPass'){
                            $('#errorPass').html('Mật khẩu cũ không đúng!');
                        } else if(result === 'errNewPass'){
                            $('#errorPass').html('Mật khẩu mới không hợp lệ!');
                        } else if(result === 'errRePass'){
                            $('#errorPass').html('Xác nhận mật khẩu không khớp!');
                        } else {
                            $('.modal-body').html(result);
                            window.location.reload();
                        }
                    },
                    "text"
                );
                return true;
            }
        });
    });
</script>