<div class="new_title">
    DANH SÁCH THÀNH VIÊN
    <a href="<?php echo site_url();?>admin/Member/addMember" title="Thêm thành viên mới"
       class="btn btn-default navbar-right" style="width: 120px;margin-left: 5px">
        <span class="fa fa-user-plus"></span>
    </a>
    <a href="#forgetPass-modal" data-toggle="modal" title="Đổi mật khẩu thành viên"
       class="btn btn-default navbar-right">
        Lấy lại mật khẩu
    </a>
</div>
<div class="row list-mem">
    <div class="filter col-md-2">
        <div class="form-group">
            <form action="<?php echo site_url().'admin/Member/viewListMember'; ?>" method="get">
            <label for="search-name">Tìm theo tên đăng nhập:</label>
            <div class="input-group">
                <input id="kw" name="kw" value="<?php echo set_value('kw'); ?>" type="text" class="form-control" placeholder="Nhập tên đăng nhập...">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" id="searchByName"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
        <div class="form-group">
            <form action="<?php echo site_url().'admin/Member/viewListMember'; ?>" method="get">
            <label for="search-name">Tìm theo tên thành viên:</label>
            <div class="input-group">
                <input id="kfn" name="kfn" value="<?php echo set_value('kfn'); ?>" type="text" class="form-control" placeholder="Nhập tên thành viên...">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" id="searchByFullName"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
        <div class="form-group">
            <form action="<?php echo site_url().'admin/Member/viewListMember'; ?>" method="get">
            <label for="search-type">Lọc trạng thái:</label>
            <div class="input-group">
                <select id="kt" name="kt" class="form-control">
                    <option value="-1">Chọn trạng thái</option>
                    <option value="1">Bình thường</option>
                    <option value="2">Khóa</option>
                </select>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" id="searchByStt"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#searchByName').click(function (){
                if ($('#kw').val().trim() === "") {
                    alert("Mời bạn nhập tên đăng nhập cần tìm kiếm");
                    return false;
                } else {
                    return true;
                }
            });
            $('#searchByFullName').click(function (){
                if ($('#kfn').val().trim() === "") {
                    alert("Mời bạn nhập tên thành viên cần tìm kiếm");
                    return false;
                } else {
                    return true;
                }
            });
            $('#searchByStt').click(function (){
                if ($('#kt').val().trim() === "-1") {
                    alert("Mời bạn chọn trạng thái cần lọc");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
    <div class="col-md-10">
        <table class="table table-striped table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "5%">Mã TV</th>
                    <th width = "8%">Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th width = "4%">Xóa</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php if ($member == NULL){ ?>
                    <tr>
                        <td colspan="10" height="100" align="center">Chưa có dữ liệu thành viên</td>
                    </tr>
                    <?php } else { foreach ($member as $value): ?>
                    <tr>
                        <td align="center"><?php echo $value['memberID'] ?></td>
                        <td><?php echo $value['memberName'] ?></td>
                        <td><?php echo $value['fullName'] ?></td>
                        <td align="center">
                            <?php
                            ($value['sex'] == 1) ? $sex = 'Nam' : $sex = 'Nữ';
                            echo $sex;
                            ?>
                        </td>
                        <td><?php echo $value['add'] ?></td>
                        <td><?php echo $value['tel'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td align="center">
                            <?php
                            ($value['status'] == 1) ? $status = 'Bình thường' : $status = 'Khóa';
                            echo $status;
                            ?>
                        </td>
                        <td align="center">
                            <a href="<?php echo site_url(); ?>admin/Member/deleteMember/<?php echo $value['memberID'] ?>"
                               onClick="return confirm('Bạn muốn xóa nhân viên <?php echo $value['fullName']; ?>?')">
                                <span class="glyphicon glyphicon-remove-circle"></span></a>
                        </td>
                    </tr>
                    <?php endforeach; }?>
            </tbody>
        </table>
        <div style="text-align: center" class="col-md-12">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
<!-- Modal-forgetPass -->
<div class="modal fade" id="forgetPass-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>LẤY LẠI MẬT KHẨU</strong></h4>
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
                <button id="sendFP" type="submit" class="btn btn-default">Xác nhận</button>
                <button id="exitFP" type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
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