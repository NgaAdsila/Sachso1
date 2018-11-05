<div class="container-fluid">
    <?php if ($this->cart->total_items() > 0) { ?>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width: 5%">STT</th>
                <th style="width: 43%">Tên sản phẩm</th>
                <th style="width: 12%">Giá bán</th>
                <th style="width: 20%">Số lượng</th>
                <th style="width: 15%">Thành tiền</th>
                <th style="width: 5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            <?php $total = 0; ?>
            <?php foreach ($cart as $item): ?>
            <tr>
                <td data-th="STT" style="line-height: 35px">
                    <?php echo $i; ?>
                </td>
                <td data-th="Book" style="line-height: 35px">
                    <a href="<?php echo site_url(); ?>member/Book/index/<?php echo $item['id']; ?>"><?php echo stripslashes($item['name']) ?></a>
                </td>
                <td data-th="Price" style="line-height: 35px">
                    <span class="fa fa-usd"></span> <?php echo number_format($item['price'], 2); ?>
                </td>
                <td data-th="Quantity">
                    <form action="<?php echo site_url(); ?>member/Cart/update" method="post">
                    <div class="input-group">
                        <input class="form-control qty" type="number" name="qty" 
                               value="<?php echo $item['qty']; ?>" min="1" max="<?php echo $max_qty[$item['id']]; ?>"/>
                        <div class="input-group-btn">
                            <button class="update btn btn-default" type="submit" name="submit"><span class="fa fa-check"></span></button>
                        </div>
                        <input class="form-control" type="hidden" name="rowid" value="<?php echo $item['rowid']; ?>"/>
                    </div>
                    </form>
                </td>
                <td data-th="Total" style="line-height: 35px">
                    <span class="fa fa-usd"></span> <?php echo number_format($item['subtotal'], 2); ?>
                </td>
                <td data-th="Delete" style="line-height: 35px">
                    <a href="<?php echo site_url(); ?>member/Cart/delete/<?php echo $item['id']; ?>"
                       onclick="return confirm('Bạn muốn xóa sách <?php echo $item['name']; ?> ra khỏi giỏ hàng?')">
                        <span class="glyphicon glyphicon-remove-circle"></span></a>
                </td>
            </tr>
            <?php $total = $total + $item['subtotal']; ?>
            <?php $i++ ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right">
                    <strong>TỔNG: <span class="fa fa-usd"></span> <?php echo number_format($total, 2); ?></strong>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <ul class="navbar-right list-inline">
                        <li><a href="<?php echo site_url(); ?>" class="btn btn-warning">
                            <span class="glyphicon glyphicon-menu-left" style="font-size: 11px"></span> Tiếp tục mua hàng</a></li>
                        <li><a href="<?php echo site_url(); ?>member/Order/confirm" class="btn btn-success btn-block">
                            Gửi đơn hàng <span class="glyphicon glyphicon-menu-right" style="font-size: 11px"></span></a></li>
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php } else { ?>
        <div class="text-center"><h4>Giỏ hàng của bạn chưa có sản phẩm nào!</h4></div>
        <div class="text-center"><a href="<?php echo site_url(); ?>" class="btn btn-warning">Quay lại mua hàng</a></div><br/>
    <?php } ?>
</div>