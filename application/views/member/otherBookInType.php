<div class="panel panel-default">
    <div class="panel-heading" style="text-align: left">
        <div style="color: #3333ff"><span class="glyphicon glyphicon-book"></span> CÁC SÁCH CÙNG DANH MỤC</div>
    </div>
    <div class="panel-body" id="list">
        <div class="container-fluid">
            <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="authorCarousel">
                <div class="carousel-inner">
            <?php $active = 0; $counter = 0; ?>
            <?php foreach ($typeBook as $typeBook):?>
                <?php if ($counter % 4 == 0): ?>
                <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
                <?php endif; ?>
                <div class="col-md-3 item-list">               
                    <a href="<?php echo site_url().'member/Book/index/'.$typeBook['bookID'] ?>" class="thumbnail item-image img-responsive">
                        <img src="<?php echo $typeBook['bookImg']; ?>" alt="<?php echo $typeBook['bookName']; ?>" style="height: 120px">
                    </a>
                    <div style="text-align: center">
                        <div class="rateit" data-rateit-value="<?php echo $typeBook['rate_avg'] ?>" data-rateit-readonly="true"></div>
                        <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $typeBook['rate_num'].' lượt đ.giá' ?>)</i></span>
                    </div>
                    <a href="<?php echo site_url().'member/Book/index/'.$typeBook['bookID'] ?>" class="item-name"><?php echo stripslashes($typeBook['bookName']); ?></a>
                    <p class="item-price"><?php echo 'Giá: $'.$typeBook['bookPrice']; ?></p>              
                </div>
                <?php if ($counter % 4 == 3): ?>
                </div>
                <?php endif; $counter++;?>
            <?php endforeach;?>
                </div>
                <a class="left carousel-control" href="#authorCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <a class="right carousel-control" href="#authorCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> 
            </div>
        </div>
    </div>
</div>