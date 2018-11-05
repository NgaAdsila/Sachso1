<div class="container-fluid">
    <div id="count-order-status">
        <h4><strong><span class="fa fa-pencil"></span> Đơn hàng trong ngày:</strong></h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-left">STT</th>
                    <th class="text-left">Trạng thái</th>
                    <th class="text-left">Số lượng</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; $totalO = 0;?>
            <?php foreach ($rp_status as $rp_date):?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $rp_date['status']; ?></td>
                    <td><?php echo $rp_date['qty']; ?></td>
                </tr>
                <?php $totalO = $totalO + $rp_date['qty']; ?>
            <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-left"><strong>TỔNG: <?php echo $totalO; ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="count-order-books">
        <h4><strong><span class="fa fa-pencil"></span> Sách được đặt hàng:</strong></h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-left">STT</th>
                    <th class="text-left">Tên sách</th>
                    <th class="text-left">Số lượng</th>
                    <th class="text-left">Giá</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; $total_price = 0;?>
            <?php if(!count($rp_book)): ?>
                <tr>
                    <td colspan="4" class="text-center"><strong><i>Không có dữ liệu!</i></strong></td>
                </tr>
            <?php else: ?>
            <?php foreach ($rp_book as $rp_date):?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo stripslashes(word_limiter($rp_date['bookName'],10,'...')); ?></td>
                    <td><?php echo $rp_date['qty']; ?></td>
                    <td><span class="fa fa-usd"></span> <?php echo $rp_date['price']; ?></td>
                </tr>
                <?php $total_price = $total_price + $rp_date['qty']*$rp_date['price']; ?>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div id="count-order-price">
        <h4><strong><span class="fa fa-pencil"></span> Tổng doanh thu: <span class="fa fa-usd"></span> <?php echo $total_price; ?></strong></h4>
    </div>
    <div id="count-feedback">
        <h4><strong><span class="fa fa-pencil"></span> Ý kiến phản hồi:</strong></h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-left">STT</th>
                    <th class="text-left">Trạng thái</th>
                    <th class="text-left">Số lượng</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; $total = 0;?>
            <?php foreach ($rp_fb as $rp_date):?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $rp_date['status']; ?></td>
                    <td><?php echo $rp_date['qty']; ?></td>
                </tr>
                <?php $total = $total + $rp_date['qty']; ?>
            <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-left"><strong>TỔNG: <?php echo $total; ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
<!--    <hr/>
    <div>
        <?php 
            //$data_dw = 'Báo cáo ngày '.$date.' Đơn hàng trong ngày: '.$totalO
                //.' Tổng doanh thu: $'.$total_price
                //.' Ý kiến phản hồi: '.$total;
        ?>
        <p>Nhấn <a href="<?php// echo site_url().'seller/Report/download?d='.$date.'&dw='.$data_dw;?>"><span class="fa fa-download"></span></a> để tải báo cáo xuống!</p>
    </div>-->
</div>