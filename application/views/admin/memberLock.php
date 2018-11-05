<?php
if ($check == TRUE) {
    echo "<script type=\"text/javascript\">" .
    "alert('Cập nhật trạng thái thành công');" .
    "</script>";
    redirect('admin/Member/lockMember', 'refresh');
}
?>
<p class="new_title">KHÓA/MỞ KHÓA TÀI KHOẢN THÀNH VIÊN</p>
<span class="error"><?php echo validation_errors(); ?></span>
<div class="row">
    <div class="col-md-2 filter">
        <div class="form-group">
            <form action="<?php echo site_url().'admin/Member/lockMember'; ?>" method="get">
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
            <form action="<?php echo site_url().'admin/Member/lockMember'; ?>" method="get">
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
            <form action="<?php echo site_url().'admin/Member/lockMember'; ?>" method="get">
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
        <table class="table-striped table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "5%">Mã TV</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th>Trạng thái</th>
                    <th width = "25%">Trạng thái mới</th>
                    <th width = "4%">Cập nhật</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php foreach ($member as $value): ?>
                    <tr>
                        <td align="center"><?php echo $value['memberID'] ?></td>
                        <td><?php echo $value['memberName'] ?></td>
                        <td><?php echo $value['fullName'] ?></td>
                        <td align="center">
                            <?php
                            ($value['status'] == 1) ? $status = 'Bình thường' : $status = 'Khóa';
                            echo $status;
                            ?>
                        </td>
                        <form action="<?php echo site_url(); ?>admin/Member/validateLock" method="post">
                        <td>
                            <input type="hidden" name="memberID" value="<?php echo $value['memberID']; ?>" >
                            <select class="form-control" name="memberStatus">
                                <option value="" selected="selected">Chọn trạng thái</option>
                                <option value="1">Bình thường</option>
                                <option value="0">Khóa</option>
                            </select>
                        </td>
                        <td align="center">
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-edit"></span>
                            </button>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="text-align: center" class="col-md-12">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>