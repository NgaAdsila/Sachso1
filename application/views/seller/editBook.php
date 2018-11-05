<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Sửa thông tin sách thành công');" .
        "</script>";
    redirect('seller/Book/viewListBook', 'refresh');
}
?>
<p class="new_title">SỬA THÔNG TIN SÁCH</p>
<div>
    <?php echo form_open_multipart(site_url().'seller/Book/validateEdit/'.$book[0]['bookID'], 'class="form-horizontal"');?>
        <?php foreach ($book as $book_data):?>
        <div class="form-group">
            <div class="col-md-2">
                <label for="inputID">Mã ISBN: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookID"
                       value="<?php echo $book_data['bookID']; ?>" disabled>
            </div>
            <div class="col-md-2">
                <label for="inputYearOfPub">Năm xuất bản <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookYearOfPub"
                       value="<?php echo $book_data['yearOfPublication']; ?>">
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
                <input type="text" class="form-control" name="bookName" autofocus="true"
                       value="<?php echo $book_data['bookName']; ?>">
            </div>
            <div class="col-md-2">
                <label for="inputType">Danh mục <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="bookType">
                    <?php foreach ($type as $type_data): ?>
                        <option value="<?php echo $type_data['typeID'] ?>"
                            <?php if ($book_data['typeID'] == $type_data['typeID']) {
                                echo "selected = selected";
                            }?>>
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
                       value="<?php echo $book_data['author']; ?>">
            </div>
            <div class="col-md-2">
                <label for="inputPrice">Giá sách <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookPrice"
                       value="<?php echo $book_data['bookPrice']; ?>">
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
                <textarea style="resize: vertical" class="form-control" 
                    name="bookContent"><?php echo $book_data['bookContent']; ?></textarea>
            </div>
            <div class="col-md-2">
                <label for="inputQuantity">Số lượng <span class="red">*</span>: </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bookQuantity"
                       value="<?php echo $book_data['bookQuantity']; ?>">
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
                       value="<?php echo $book_data['publisher']; ?>">
            </div>
            <div class="col-md-2">
                <label for="inputImg">Hình ảnh: </label>
            </div>
            <div class="col-md-4">
                <img name="bookOldImg" src="<?php echo $book_data['bookImg'];?>" height="100"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookPublisher'); ?></span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookOldImg'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6"></div>
            <div class="col-md-2">
                <label for="inputNewImg">Hình ảnh mới: </label>
            </div>
            <div class="col-md-4">
                <?php echo form_upload('bookImg'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('bookImg'); ?></span>
            </div>
        </div>
        <?php endforeach; ?>
        <?php echo form_submit('submit', 'Cập nhật', 'class="btn btn-default col-md-offset-5" style="width: 100px"');?>
    <?php echo form_close(); ?>
</div>
