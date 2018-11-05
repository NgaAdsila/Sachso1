<?php
if ($check == TRUE) {
    echo "<script type=\"text/javascript\">" .
    "alert('Cập nhật thông tin thành công');" .
    "</script>";
    redirect('admin/Staff/staffRole', 'refresh');
}
?>
<p class="new_title">PHÂN QUYỀN NHÂN VIÊN</p>
<span class="error"><?php echo validation_errors(); ?></span>
<div class="container-fluid">
    <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-search"></span></span>
        <input id="filter" type="text" class="form-control" placeholder="Nhập thông tin tìm kiếm...">
    </div>
    <table class="table-bordered" style="margin-top: 5px;width: 100%;">
        <thead style="background: #33ffcc;">
            <tr>
                <th height="30px">Mã NV</th>
                <th>Tên đăng nhập</th>
                <th>Họ tên</th>
                <th>Chức vụ</th>
                <th width="20%">Chức vụ mới</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody class="searchable" style="background: transparent">
            <?php foreach ($staff as $value): ?>
                <tr>
                    <td align="center"><?php echo $value['staffID']?></td>
                    <td><?php echo $value['staffName']?></td>
                    <td><?php echo $value['fullName']?></td>
                    <td align="center"><?php echo $value['roleName']?></td>
                    <?php echo form_open(site_url().'admin/Staff/validateRole'); ?>
                    <td>
                        <input type="hidden" name="staffID" value="<?php echo $value['staffID']; ?>" >
                        <select class="form-control" name="staffRole">
                            <option value="" selected="selected">Chọn chức vụ</option>
                            <?php foreach ($role as $role_data): ?>
                                <option value="<?php echo $role_data['roleID'] ?>">
                                    <?php echo $role_data['roleName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td align="center">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-edit"></span>
                        </button>
                    </td>
                    <?php echo form_close(); ?>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
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