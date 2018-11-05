<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Thêm sách thành công');" .
        "</script>";
    redirect('seller/Book/viewListBook', 'refresh');
}
?>
<p class="new_title">THÊM SÁCH MỚI</p>
<div>
    <?php echo form_open_multipart(site_url().'seller/Book/validateAdd', 'class="form-horizontal"');?>
        <div class="form-group">
            <div class="col-md-2">
                <label for="inputID">Mã ISBN <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookID" autofocus="true"
                       value="<?php echo set_value('bookID'); ?>">
            </div>
            <div class="col-md-2">
                <label for="inputYearOfPub">Năm xuất bản <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookYearOfPub"
                       value="<?php echo set_value('bookYearOfPub'); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookID'); ?></span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookYearOfPub'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label for="inputName">Tên sách <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookName"
                       value="<?php echo set_value('bookName'); ?>">
            </div>
            <div class="col-md-2">
                <label for="inputType">Danh mục <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="bookType">
                    <option value="" selected="selected">Chọn danh mục</option>
                    <?php foreach ($type as $type_data): ?>
                        <option value="<?php echo $type_data['typeID'] ?>"
                                <?php echo set_select('bookType', $type_data['typeID']); ?>>
                                    <?php echo $type_data['typeName'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookName'); ?></span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookType'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label for="inputAuthor">Tác giả <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookAuthor"
                       value="<?php echo set_value('bookAuthor'); ?>">
            </div>
            <div class="col-md-2">
                <label for="inputPrice">Giá sách <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookPrice"
                       value="<?php echo set_value('bookPrice'); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookAuthor'); ?></span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookPrice'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label for="inputContent">Tóm tắt <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <textarea style="resize: vertical;max-height: 300px" class="form-control"
                    name="bookContent"><?php echo set_value('bookContent'); ?></textarea>
            </div>
            <div class="col-md-2">
                <label for="inputQuantity">Số lượng <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookQuantity"
                       value="<?php echo set_value('bookQuantity'); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookContent'); ?></span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookQuantity'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <label for="inputPublisher">Nhà xuất bản <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookPublisher"
                       value="<?php echo set_value('bookPublisher'); ?>">
            </div>
            <div class="col-md-2">
                <label for="inputImg">Hình ảnh: </label>
            </div>
            <div class="col-md-4">
                <?php echo form_upload('bookImg'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookPublisher'); ?></span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookImg'); ?></span>
            </div>
        </div>
        <?php echo form_submit('submit', 'Thêm', 'class="btn btn-default col-md-offset-5" style="width: 100px"');?>
    <?php echo form_close(); ?>
</div>
