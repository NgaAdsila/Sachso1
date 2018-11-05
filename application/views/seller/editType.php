<?php 
if ($check == TRUE){
    echo "<script type=\"text/javascript\">" .
        "alert('Sửa thông tin danh mục thành công');" .
        "</script>";
    redirect('seller/Type/viewListType', 'refresh');
}
?>
<p class="new_title">SỬA THÔNG TIN DANH MỤC</p>
<div class="col-md-offset-2">
    <form action="<?php echo site_url(); ?>seller/Type/validateEdit/<?php echo $type[0]['typeID']?>" 
        method="post" class="form-horizontal" role="form">
        <?php foreach ($type as $typeInfo):?>
        <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-5">
                <input type="hidden" class="form-control" name="typeID"
                       value="<?php echo $typeInfo['typeID']; ?>">
            </div>
            <div class="col-md-4 error">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label for="inputName">Tên danh mục: </label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="typeName" autofocus="true"
                       value="<?php echo $typeInfo['typeName']; ?>">
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
                <textarea style="max-width: 500px;max-height: 350px" class="form-control" name="typeInfo"><?php echo $typeInfo['typeInfo']; ?></textarea>
            </div>
            <div class="col-md-4">
                <span class="error"><?php echo form_error('typeInfo'); ?></span>
            </div>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-default col-md-offset-3" style="width: 100px">Cập nhật</button>
    </form>
</div>
