<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Thêm danh mục thành công');" .
        "</script>";
    redirect('seller/Type/viewListType', 'refresh');
}
?>
<p class="new_title">THÊM DANH MỤC MỚI</p>
<div class="col-md-offset-2">
    <form action="<?php echo site_url(); ?>seller/Type/validateAdd" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-md-3">
                <label for="inputName">Tên danh mục: </label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="typeName" autofocus="true"
                       value="<?php echo set_value('typeName'); ?>">
            </div>
            <div class="col-md-4 error">
                <span class="error"><?php echo form_error('typeName'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label for="inputFullName">Mô tả <span class="red">*</span>: </label>
            </div>
            <div class="col-md-5">
                <textarea style="max-width: 450px;max-height: 350px" class="form-control" name="typeInfo"><?php echo set_value('typeInfo'); ?></textarea>
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('typeInfo'); ?></span>
            </div>
        </div>
        <button type="submit" class="btn btn-default col-md-offset-3" style="width: 100px">Thêm</button>
    </form>
</div>
