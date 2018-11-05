<p class="new_title">DANH SÁCH Ý KIẾN PHẢN HỒI</p>
<div class="row">
    <div class="col-md-2 filter">
        <div class="form-group">
            <form action="<?php echo site_url().'seller/Feedback/viewListFB'; ?>" method="get">
            <label for="search-name">Tìm khách hàng:</label>
            <div class="input-group">
                <input id="kw" name="kw" value="<?php echo set_value('kw'); ?>" type="text" class="form-control" placeholder="Nhập tên khách hàng...">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" id="searchByName"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
        <div class="form-group">
            <form action="<?php echo site_url().'seller/Feedback/viewListFB'; ?>" method="get">
            <label for="search-type">Lọc đánh giá:</label>
            <div class="input-group">  
                <select id="kt" name="kt" class="form-control">
                    <option value="0">Chọn đánh giá</option>
                    <option value="Chưa đánh giá">Chưa đánh giá</option>
                    <option value="Đóng góp">Đóng góp</option>
                    <option value="Spam">Spam</option>
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
                    alert("Mời bạn nhập tên khách hàng cần tìm kiếm");
                    return false;
                } else {
                    return true;
                }
            });
            $('#searchByStt').click(function (){
                if ($('#kt').val().trim() === "0") {
                    alert("Mời bạn chọn đánh giá cần tìm kiếm");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
    <div class="col-md-10" id="list-fb" style="margin-top: 5px">
        <table class="table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "6%" height="30px">Mã FB</th>
                    <th width = "20%">Tên khách hàng</th>
                    <th>Nội dung phản hồi</th>
                    <th width = "18%">Đánh giá</th>
                    <th width = "8%">Chi tiết</th>
                    <th width = "8%">Cập nhật</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php if ($feedback == NULL){ ?>
                <tr>
                    <td colspan="10" height="100" align="center">Chưa có dữ liệu!</td>
                </tr>
                <?php } else {foreach ($feedback as $value): ?>
                    <form action="<?php echo site_url(); ?>seller/Feedback/updateRatings" method="post">
                    <tr>
                        <td align="center"><?php echo $value['feedbackID'] ?></td>
                        <td><?php echo $value['fullName'] ?></td>
                        <td><?php echo word_limiter($value['feedbackContent'], 20,' ...') ?></td>
                        <td>
                            <input type="hidden" class="form-control" name="feedbackID" value="<?php echo $value['feedbackID'] ?>">
                            <select class="form-control" name="ratings">
                                <option value="" <?php if ($value['ratings'] == "") {echo "selected = selected";} ?>>Chưa đánh giá</option>
                                <option value="Đóng góp" <?php if ($value['ratings'] == "Đóng góp") {echo "selected = selected";} ?>>Đóng góp</option>
                                <option value="Spam" <?php if ($value['ratings'] == "Spam") {echo "selected = selected";} ?>>Spam</option>                                
                            </select>
                        </td>
                        <td align="center">
                            <a href="#feedback-modal<?php echo $value['feedbackID'] ?>" data-toggle="modal"><span class="glyphicon glyphicon-list-alt"></span></a></td>
                        <td align="center">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-edit"></span></button></td>
                    </tr>
                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="feedback-modal<?php echo $value['feedbackID'] ?>" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center"><strong>NỘI DUNG CHI TIẾT Ý KIẾN PHẢN HỒI</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="infoName">Họ tên: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $value['fullName'] ?>"
                                                   style="margin-bottom: 5px"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="infoName">Thời gian phản hồi: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $value['sendDate'] ?>"
                                                       style="margin-bottom: 5px"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="infoName">Nội dung phản hồi: </label>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea id="contentFB" class="form-control" name="feedbackContent" rows="5" placeholder="Nhập ý kiến phản hồi"
                                                      style="resize: vertical; max-height: 250px"><?php echo $value['feedbackContent']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; }?>
            </tbody>
        </table>
        <div class="col-md-12" style="text-align: center;">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
