<p class="new_title">DANH SÁCH ĐƠN HÀNG</p>
<div class="row">
    <div class="col-md-2 filter" style="margin-bottom: 5px">
        <form action="<?php echo site_url().'seller/Order/viewListOrder'; ?>" method="get">
            <label for="search-name">Tìm nâng cao:</label>
            <input id="kn" name="kn" value="<?php echo set_value('kw'); ?>" type="text" 
                   class="form-control" placeholder="Nhập tài khoản..." style="margin-bottom: 5px">
            <div class="input-group date" id="kdoPicker" style="margin-bottom: 5px">
                <input id="kdo" name="kdo" type="text" class="form-control" placeholder="Ngày đặt hàng..."
                       value="<?php echo set_value('kdo'); ?>"/>
                <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
            </div>
            <div class="input-group date" id="kdrPicker" style="margin-bottom: 5px">
                <input id="kdr" name="kdr" type="text" class="form-control" placeholder="Ngày giao hàng..."
                       value="<?php echo set_value('kdr'); ?>"/>
                <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
            </div>
            <select id="kstf" name="kstf" class="form-control" style="margin-bottom: 5px">
                <option value="0">Chọn nhân viên giao hàng</option>
                <?php foreach ($shipper as $people): ?>
                <option value="<?php echo $people['staffID'] ?>"><?php echo $people['fullName'] ?></option>
                <?php endforeach; ?>
            </select>
            <select id="kstt" name="kstt" class="form-control" style="margin-bottom: 5px">
                <option value="0">Chọn trạng thái</option>
                <option value="Chưa xử lý">Chưa xử lý</option>
                <option value="Đang xử lý">Đang xử lý</option>
                <option value="Đã xử lý">Đã xử lý</option>
                <option value="Hủy">Hủy</option>
            </select>
            <button type="submit" class="btn btn-default" id="searchOrder">Tìm kiếm</button>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#kdoPicker').datepicker({
                format: 'yyyy-mm-dd',
                endDate: '<?php echo time(); ?>'
            });
            $('#kdrPicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#searchOrder').click(function (){
                if (($('#kn').val().trim() === "")&&($('#kdo').val().trim() === "")&&
                    ($('#kdr').val().trim() === "")&&(($('#kstf').val().trim() === "0")
                    &&($('#kstt').val().trim() === "0"))) {
                    alert("Mời bạn nhập thông tin tìm kiếm");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
    <div class="col-md-10" id="list-order" style="margin-top: 5px">
        <table class="table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width="5%">Mã ĐH</th>
                    <th width="10%">Tên tài khoản</th>
                    <th width="15%">Ngày đặt hàng</th>
                    <th width="15%">Ngày yêu cầu giao hàng</th>
                    <th width="18%">Nhân viên giao hàng</th>
                    <th width="18%">Trạng thái</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Chi tiết</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php if ($order == NULL){ ?>
                <tr>
                    <td colspan="10" height="100" align="center">Chưa có dữ liệu đơn hàng</td>
                </tr>
                <?php } else {foreach ($order as $value): ?>
                <form action="<?php echo site_url(); ?>seller/Order/updateStatus" method="post">
                    <tr>
                        <td align="center"><?php echo $value['orderID'];?></td>
                        <td><?php echo $value['memberName']?></td>
                        <td><?php echo $value['orderDate']?></td>
                        <td><?php echo $value['requireDate']?></td>
                        <td>
                            <input type="hidden" class="form-control" name="ordersID" value="<?php echo $value['orderID'] ?>">
                            <select class="form-control" name="shipper">
                                <option value="">Nhân viên giao hàng</option>
                                <?php foreach ($shipper as $people): ?>
                                    <option value="<?php echo $people['staffID'] ?>" 
                                        <?php if ($people['staffID'] == $value['staffID']) {echo "selected = selected";} ?>>
                                        <?php echo $people['fullName'] ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </td>
                        <td>
                            <select class="form-control" name="status">                                   
                                <option value="Chưa xử lý" <?php if ($value['status'] == "Chưa xử lý") {echo "selected = selected";} ?>>Chưa xử lý</option>
                                <option value="Đang xử lý" <?php if ($value['status'] == "Đang xử lý") {echo "selected = selected";} ?>>Đang xử lý</option>
                                <option value="Đã xử lý" <?php if ($value['status'] == "Đã xử lý") {echo "selected = selected";} ?>>Đã xử lý</option>
                                <option value="Hủy" <?php if ($value['status'] == "Hủy") {echo "selected = selected";} ?>>Hủy</option>                                  
                            </select>
                        </td>
                        <td align="center">
                            <button class="btn btn-default" type="submit" name="submit" <?php if ($value['status'] == "Hủy") {echo "disabled='true'";}?>>
                                <span class="glyphicon glyphicon-edit"></span></button></td>
                        <td align="center">
                            <a href="<?php echo site_url();?>seller/Order/orderDetail/<?php echo $value['orderID'] ?>">
                                <span class="glyphicon glyphicon-list-alt"></span></a></td>
                    </tr>
                </form>
                <?php endforeach; }?>
            </tbody>
        </table>
        <div class="col-md-12" style="text-align: center;">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>