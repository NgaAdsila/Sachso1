<div id="newBook">
    <p class="new_title">SÁCH MỚI</p>
    <div class="container-fluid">
        <table class="table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "3%">STT</th>
                    <th width = "15%">Tên sách</th>
                    <th>Tác giả</th>
                    <th width = "25%">Tóm tắt</th>
                    <th>Nhà xuất bản</th>
                    <th>Năm xuất bản</th>
                    <th>Loại sách</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th width = "4%">Xóa</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php if ($book == NULL){ ?>
                <tr>
                    <td colspan="10" height="100" align="center">Chưa có dữ liệu sách</td>
                </tr>
                <?php } else { $i = 1; foreach ($book as $value): ?>
                    <tr>
                        <td align="center"><?php echo $i++;?></td>
                        <td><?php echo word_limiter($value['bookName'],6,'...')?></td>
                        <td><?php echo $value['author']?></td>
                        <td><?php echo word_limiter($value['bookContent'],15,'...')?></td>
                        <td><?php echo $value['publisher']?></td>
                        <td><?php echo $value['yearOfPublication']?></td>
                        <td><?php echo $value['typeName']?></td>
                        <td><?php echo '$'.$value['bookPrice']?></td>
                        <td align="center"><?php echo $value['bookQuantity']?></td>
                        <td align="center">
                            <a href="<?php echo site_url();?>seller/SellerMain/deleteBook/<?php echo $value['bookID'] ?>"
                               onClick="return confirm('Bạn muốn xóa sách <?php echo $value['bookName']; ?>?')">
                            <span class="glyphicon glyphicon-remove-circle"</a>
                        </td>
                    </tr>
                <?php endforeach;}?>
            </tbody>
        </table>
    </div>
</div>
<br/><br/>
<div id="newOrder">
    <p class="new_title">ĐƠN HÀNG MỚI</p>
    <div class="container-fluid">
        <table class="table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "5%">Mã ĐH</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Ngày yêu cầu giao hàng</th>
                    <th>Nhân viên giao hàng</th>
                    <th width = "10%">Trạng thái</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php if ($order == NULL){ ?>
                <tr>
                    <td colspan="10" height="100" align="center">Chưa có dữ liệu đơn hàng</td>
                </tr>
                <?php } else { foreach ($order as $value): ?>
                    <tr>
                        <td align="center"><?php echo $value['orderID']?></td>
                        <td><?php echo $value['fullName']?></td>
                        <td><?php echo $value['orderDate']?></td>
                        <td><?php echo $value['requireDate']?></td>
                        <td><?php echo $shipper[$value['orderID']];?></td>
                        <td><?php echo $value['status']?></td>
                    </tr>
                <?php endforeach;}?>
            </tbody>
        </table>
    </div>
</div>