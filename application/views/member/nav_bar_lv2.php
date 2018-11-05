<div class="container-fluid">
    <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo site_url(); ?>">Trang chủ</a></li>
        <li><a href="<?php echo site_url().'Home/typeBook/'.$typeID; ?>"><?php echo $typeName; ?></a></li>
        <li class="active"><?php echo stripslashes($name); ?></li>
    </ol>
</div>