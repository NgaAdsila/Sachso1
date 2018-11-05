<p class="new_title">CHI TIẾT ĐƠN HÀNG</p>
<div class="container-fluid">
    <div id="order-info">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php foreach ($order as $value):?>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputName">Họ tên người đặt hàng: </label>
                            </div>
                            <div class="col-md-7">
                                <p type="text" class="form-control"><?php echo $value['fullName'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputName">Họ tên người nhận: </label>
                            </div>
                            <div class="col-md-7">
                                <p type="text" class="form-control"><?php echo $value['name'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputAdd">Địa chỉ người nhận: </label>
                            </div>
                            <div class="col-md-7">
                                <p type="text" class="form-control"><?php echo $value['receiverAdd'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputTel">Số điện thoại người nhận: </label>
                            </div>
                            <div class="col-md-7">
                                <p type="text" class="form-control"><?php echo $value['receiverTel'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputTel">Thời gian gửi hóa đơn: </label>
                            </div>
                            <div class="col-md-7">
                                <p type="text" class="form-control"><?php echo $value['orderDate'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputName">Thời gian giao hàng: </label>
                            </div>
                            <div class="col-md-7">
                                <p type="text" class="form-control"><?php echo $value['requireDate'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="inputStatus">Trạng thái đơn hàng: </label>
                            </div>
                            <div class="col-md-7">
                                <p type="text" class="form-control"><?php echo $value['status'] ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div id="book-info-order">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: left">STT</th>
                        <th style="width: 50%; text-align: left">Tên sản phẩm</th>
                        <th style="width: 15%; text-align: left">Số lượng</th>
                        <th style="width: 15%; text-align: left">Giá bán</th>
                        <th style="width: 15%; text-align: left">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php $total = 0; ?>
                    <?php foreach ($orderDetail as $item): ?>
                        <tr>
                            <td data-th="STT" style="line-height: 35px">
                                <?php echo $i; ?>
                            </td>
                            <td data-th="Book" style="line-height: 35px">
                                <?php echo stripslashes(word_limiter($item['bookName'],10,'...')) ?>
                            </td>
                            <td data-th="Quantity" style="line-height: 35px"><?php echo $item['quantity']; ?></td>
                            <td data-th="Price" style="line-height: 35px">
                                <span class="glyphicon glyphicon-usd" style="font-size: 12px"></span><?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td data-th="Total" style="line-height: 35px">
                                <?php $subtotal = $item['quantity']*$item['price']; ?>
                                <span class="glyphicon glyphicon-usd" style="font-size: 12px"></span><?php echo number_format($subtotal, 2); ?>
                            </td>
                        </tr>
                        <?php $total = $total + $subtotal; ?>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-right">
                            <strong>TỔNG: <span class="glyphicon glyphicon-usd" style="font-size: 12px"></span><?php echo number_format($total, 2); ?></strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
    </div>
</div>