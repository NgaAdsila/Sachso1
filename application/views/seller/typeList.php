<div class="new_title">
    DANH SÁCH DANH MỤC
    <a href="<?php echo site_url();?>seller/Type/addType" title="Thêm thành viên mới"
       class="btn btn-default navbar-right" style="width: 120px;margin-left: 5px">
        <span class="fa fa-plus"></span>
    </a>
</div>
<div class="container-fluid">
    <table class="table-bordered" style="width: 100%;">
        <thead style="background: #33ffcc;">
            <tr>
                <th width = "8%" height="30px">Mã TL</th>
                <th width = "25%">Tên danh mục</th>
                <th>Mô tả</th>
                <th width = "4%">Sửa</th>
            </tr>
        </thead>
        <tbody style="background: transparent">
            <?php foreach ($type as $value): ?>
                <tr>
                    <td align="center"><?php echo $value['typeID']?></td>
                    <td><?php echo $value['typeName']?></td>
                    <td><?php echo $value['typeInfo']?></td>
                    <td align="center">
                        <a href="<?php echo site_url();?>seller/Type/editType/<?php echo $value['typeID'] ?>">
                            <span class="glyphicon glyphicon-edit"></span></a></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>