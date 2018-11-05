<div id="newStaff">
    <p class="new_title">NHÂN VIÊN MỚI</p>
    <div class="container-fluid">
        <table class="table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "5%">Mã NV</th>
                    <th width = "8%">Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th width = "10%">Chức vụ</th>
                    <th width = "5%">Giới tính</th>
                    <th>Địa chỉ</th>
                    <th width = "10%">Số điện thoại</th>
                    <th>Email</th>
                    <th>Quê quán</th>
                    <th width = "4%">Xóa</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php foreach ($staff as $value): ?>
                    <tr>
                        <td align="center"><?php echo $value['staffID']?></td>
                        <td><?php echo $value['staffName']?></td>
                        <td><?php echo $value['fullName']?></td>
                        <td><?php echo $value['roleName']?></td>
                        <td align="center">
                            <?php
                                ($value['sex'] == 1)?$sex = 'Nam':$sex = 'Nữ';
                                echo $sex;?>
                        </td>
                        <td><?php echo $value['add']?></td>
                        <td><?php echo $value['tel']?></td>
                        <td><?php echo $value['email']?></td>
                        <td><?php echo $value['homeLand']?></td>
                        <td align="center">
                            <a href="<?php echo site_url();?>admin/AdminMain/deleteStaff/<?php echo $value['staffID'] ?>"
                               onClick="return confirm('Bạn muốn xóa nhân viên <?php echo $value['fullName']; ?>?')">
                            <span class="glyphicon glyphicon-remove-circle"</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<br/><br/>
<div id="newMember">
    <p class="new_title">THÀNH VIÊN MỚI</p>
    <div class="container-fluid">
        <table class="table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "5%">Mã TV</th>
                    <th width = "10%">Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th width = "8%">Giới tính</th>
                    <th>Địa chỉ</th>
                    <th width = "10%">Số điện thoại</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th width = "4%">Xóa</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php foreach ($member as $value): ?>
                    <tr>
                        <td align="center"><?php echo $value['memberID']?></td>
                        <td><?php echo $value['memberName']?></td>
                        <td><?php echo $value['fullName']?></td>
                        <td align="center">
                            <?php
                                ($value['sex'] == 1)?$sex = 'Nam':$sex = 'Nữ';
                                echo $sex;?>
                        </td>
                        <td><?php echo $value['add']?></td>
                        <td><?php echo $value['tel']?></td>
                        <td><?php echo $value['email']?></td>
                        <td align="center">
                            <?php
                                ($value['status'] == 1)?$status = 'Bình thường':$status = 'Khóa';
                                echo $status;?>
                        </td>
                        <td align="center">
                            <a href="<?php echo site_url();?>admin/AdminMain/deleteMember/<?php echo $value['memberID'] ?>"
                               onClick="return confirm('Bạn muốn xóa thành viên <?php echo $value['fullName']; ?>?')">
                            <span class="glyphicon glyphicon-remove-circle"</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>