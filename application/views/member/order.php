<?php
if ($check == TRUE) {
    echo "<script type=\"text/javascript\">" .
    "alert('Gửi đơn hàng thành công!');</script>";
    redirect('Home/index', 'refresh');
}
?>
<div class="container-fluid">
    <div id="cart-order">
        <?php if ($this->cart->total_items() > 0) { ?>
            <table id="cart" class="table table-hover table-condensed" style="width: 90%">
                <thead>
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th style="width: 55%">Tên sản phẩm</th>
                        <th style="width: 10%">Số lượng</th>
                        <th style="width: 15%">Giá bán</th>
                        <th style="width: 15%">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php $total = 0; ?>
                    <?php foreach ($orders as $item): ?>
                        <tr>
                            <td data-th="STT" style="line-height: 35px">
                                <?php echo $i; ?>
                            </td>
                            <td data-th="Book" style="line-height: 35px">
                                <a href="<?php echo site_url(); ?>member/Book/index/<?php echo $item['id']; ?>"><?php echo stripslashes($item['name']) ?></a>
                            </td>
                            <td data-th="Quantity" style="line-height: 35px"><?php echo $item['qty']; ?></td>
                            <td data-th="Price" style="line-height: 35px">
                                <span class="glyphicon glyphicon-usd" style="font-size: 12px"></span><?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td data-th="Total" style="line-height: 35px">
                                <span class="glyphicon glyphicon-usd" style="font-size: 12px"></span><?php echo number_format($item['subtotal'], 2); ?>
                            </td>
                        </tr>
                        <?php $total = $total + $item['subtotal']; ?>
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
        <?php } ?>
    </div>
    <div id="payment">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;">
                        <strong>THÔNG TIN KHÁCH HÀNG</strong>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo site_url(); ?>member/Order/validate" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="inputName">Họ tên người nhận <span class="red">(*)</span>: </label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="receiverName"
                                           value="<?php echo $member[0]['fullName']; ?>" id="name"
                                           placeholder="Nhập họ tên người nhận">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span class="error"><?php echo form_error('receiverName'); ?></span>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="inputAdd">Địa chỉ người nhận <span class="red">(*)</span>: </label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="receiverAdd"
                                           value="<?php echo $member[0]['add']; ?>" id="add"
                                           placeholder="Nhập địa chỉ người nhận">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span class="error"><?php echo form_error('receiverAdd'); ?></span>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="inputTel">Số điện thoại người nhận <span class="red">(*)</span>: </label>
                                </div>
                                <div class="col-md-7">
                                    <input type="tel" class="form-control" name="receiverTel"
                                           value="<?php echo $member[0]['tel']; ?>" id="tel"
                                           placeholder="Nhập số điện thoại người nhận">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span class="error"><?php echo form_error('receiverTel'); ?></span>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="inputTime">Thời gian giao hàng <span class="red">(*)</span>: </label>
                                </div>
                                <div class="col-md-7">
                                    <div class='input-group date' id='datetime'>
                                        <input type='text' class="form-control" name="requireTime"
                                               value="<?php echo set_value('requireTime'); ?>" id="time"
                                               placeholder="Thời gian giao hàng"/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <script type="text/javascript">
                                        $('#datetime').datetimepicker({
                                            format: "yyyy-mm-dd hh:ii:ss",
                                            startDate: '+1d'
                                        });
                                        
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span class="error"><?php echo form_error('requireTime'); ?></span>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-default" style="width: 120px" id="reset">Nhập lại</button>
                                <button id="sendOrder" type="submit" class="btn btn-default">Gửi đơn hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<script>
    $('#reset').click(function (){
        document.getElementById('name').value = "";
        document.getElementById('add').value = "";
        document.getElementById('tel').value = "";
        document.getElementById('time').value = "";
    });
</script>