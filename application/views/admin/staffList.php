<div class="new_title">
    DANH SÁCH NHÂN VIÊN
    <a href="<?php echo site_url();?>admin/Staff/addStaff" title="Thêm nhân viên mới"
       class="btn btn-default navbar-right" style="width: 150px">
        <span class="fa fa-user-plus"></span>
    </a>
</div>
<div class="container-fluid">
    <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-search"></span></span>
        <input id="filter" type="text" class="form-control" placeholder="Nhập thông tin tìm kiếm...">
    </div>
    <table class="table table-striped table-bordered" style="margin-top: 5px; width: 100%;">
        <thead style="background: #33ffcc;">
            <tr>
                <th width = "5%">Mã NV</th>
                <th>Tên đăng nhập</th>
                <th>Họ tên</th>
                <th>Chức vụ</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th width = "4%">Sửa</th>
                <th width = "4%">Xóa</th>
            </tr>
        </thead>
        <tbody class="searchable" style="background: transparent">
            <?php foreach ($staff as $value): ?>
                <tr>
                    <td align="center"><?php echo $value['staffID']?></td>
                    <td><?php echo $value['staffName']?></td>
                    <td><?php echo $value['fullName']?></td>
                    <td align="center"><?php echo $value['roleName']?></td>
                    <td align="center">
                        <?php
                            ($value['sex'] == 1)?$sex = 'Nam':$sex = 'Nữ';
                            echo $sex;?>
                    </td>
                    <td><?php echo $value['add']?></td>
                    <td><?php echo $value['tel']?></td>
                    <td><?php echo $value['email']?></td>
                    <td align="center">
                        <a href="<?php echo site_url();?>admin/Staff/editStaff/<?php echo $value['staffID'] ?>">
                            <span class="glyphicon glyphicon-edit"></span></a></td>
                    <td align="center">
                        <a href="<?php echo site_url();?>admin/Staff/deleteStaff/<?php echo $value['staffID'] ?>"
                           onClick="return confirm('Bạn muốn xóa nhân viên <?php echo $value['fullName']; ?>?')">
                            <span class="glyphicon glyphicon-remove-circle"></span></a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div style="text-align: center" class="col-md-12">
        <?php echo $pagination; ?>
    </div>
</div>
<script>
$(document).ready(function () {
    (function ($) {
        $('#filter').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();
        });
    }(jQuery));
});
</script>