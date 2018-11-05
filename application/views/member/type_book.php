<div class="container-fluid">
    <div id="intro">
        <strong>Giới thiệu:</strong>
        <p class="text-justify"><i>&nbsp;&nbsp;&nbsp;&nbsp;"<?php echo $typeInfo; ?>"</i></p>
    </div>
    <div id="topType">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <div style="color: #3333ff"><span class="fa fa-book"></span> SÁCH ĐƯỢC ĐÁNH GIÁ CAO</div>
            </div>
            <div class="panel-body" id="list">
                <div class="container-fluid">
                    <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="topCarousel">
                        <div class="carousel-inner">
                    <?php $active = 0; $counter = 0; ?>
                    <?php foreach ($topTypeBook as $topTypeBook):?>
                        <?php if ($counter % 4 == 0): ?>
                        <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
                        <?php endif; ?>
                        <div class="col-md-3 item-list">               
                            <a href="<?php echo site_url().'member/Book/index/'.$topTypeBook['bookID'] ?>" class="thumbnail item-image img-responsive">
                                <img src="<?php echo $topTypeBook['bookImg']; ?>" alt="<?php echo $topTypeBook['bookName']; ?>" style="height: 120px">
                            </a>
                            <div style="text-align: center">
                                <div class="rateit" data-rateit-value="<?php echo $topTypeBook['rate_avg'] ?>" data-rateit-readonly="true"></div>
                                <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $topTypeBook['rate_num'].' lượt đ.giá' ?>)</i></span>
                            </div>
                            <a href="<?php echo site_url().'member/Book/index/'.$topTypeBook['bookID'] ?>" class="item-name"><?php echo stripslashes($topTypeBook['bookName']); ?></a>
                            <p class="item-price"><?php echo 'Giá: $'.$topTypeBook['bookPrice']; ?></p>              
                        </div>
                        <?php if ($counter % 4 == 3): ?>
                        </div>
                        <?php endif; $counter++;?>
                    <?php endforeach;?>
                        </div>
                        <a class="left carousel-control" href="#topCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#topCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="newType">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <div style="color: #3333ff"><span class="fa fa-book"></span> SÁCH MỚI</div>
            </div>
            <div class="panel-body" id="list">
                <div class="container-fluid">
                    <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="newCarousel">
                        <div class="carousel-inner">
                    <?php $active = 0; $counter = 0; ?>
                    <?php foreach ($newTypeBook as $newTypeBook):?>
                        <?php if ($counter % 4 == 0): ?>
                        <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
                        <?php endif; ?>
                        <div class="col-md-3 item-list">               
                            <a href="<?php echo site_url().'member/Book/index/'.$newTypeBook['bookID'] ?>" class="thumbnail item-image img-responsive">
                                <img src="<?php echo $newTypeBook['bookImg']; ?>" alt="<?php echo $newTypeBook['bookName']; ?>" style="height: 120px">
                            </a>
                            <div style="text-align: center">
                                <div class="rateit" data-rateit-value="<?php echo $newTypeBook['rate_avg'] ?>" data-rateit-readonly="true"></div>
                                <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $newTypeBook['rate_num'].' lượt đ.giá' ?>)</i></span>
                            </div>
                            <a href="<?php echo site_url().'member/Book/index/'.$newTypeBook['bookID'] ?>" class="item-name"><?php echo stripslashes($newTypeBook['bookName']); ?></a>
                            <p class="item-price"><?php echo 'Giá: $'.$newTypeBook['bookPrice']; ?></p>              
                        </div>
                        <?php if ($counter % 4 == 3): ?>
                        </div>
                        <?php endif; $counter++;?>
                    <?php endforeach;?>
                        </div>
                        <a class="left carousel-control" href="#newCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#newCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="typeBook">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <div style="color: #3333ff"><span class="fa fa-book"></span> TOÀN BỘ SÁCH</div>
            </div>
            <div class="panel-body" id="list">
                <?php foreach ($typeBook as $typeBook):?>
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
                <?php endforeach;?>
                <div style="text-align: center" class="col-md-12">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.arousel[data-type="multi"] .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  if (next.next().length>0) {
    next.next().children(':first-child').clone().appendTo($(this));
  } else {
  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
  }
});
</script>