<div class="col-md-12">
    <!----------------------------------top------------------------------------>
    <div id="topBook">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <div style="color: #3333ff"><span class="fa fa-book"></span> SÁCH ĐƯỢC ĐÁNH GIÁ CAO</div>
            </div>
            <div class="panel-body" id="list">
                <div class="container-fluid">
                    <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="topCarousel">
                        <div class="carousel-inner">
                        <?php $active = 0; $counter = 0; ?>
                        <?php foreach ($topBook as $topBook):?>
                        <?php if ($counter % 4 == 0): ?>
                        <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
                        <?php endif; ?>
                            <div class="col-md-3 item-list">               
                                <a href="<?php echo site_url().'member/Book/index/'.$topBook['bookID'] ?>" class="thumbnail item-image img-responsive">
                                    <img src="<?php echo $topBook['bookImg']; ?>" alt="<?php echo $topBook['bookName']; ?>" style="height: 120px">
                                </a>
                                <span style="position: absolute; z-index: 10;top:10px;right: 20px"><img src="<?php echo site_url(); ?>/template/icon/hot.gif" height="23"/></span>
                                <div style="text-align: center">
                                    <div class="rateit" data-rateit-value="<?php echo $topBook['rate_avg'] ?>" data-rateit-readonly="true"></div>
                                    <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $topBook['rate_num'].' lượt đ.giá' ?>)</i></span>
                                </div>
                                <a href="<?php echo site_url().'member/Book/index/'.$topBook['bookID'] ?>" class="item-name"><?php echo stripslashes($topBook['bookName']); ?></a>
                                <p class="item-price"><?php echo 'Giá: $'.$topBook['bookPrice']; ?></p>              
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
    <!----------------------------------new------------------------------------>
    <div id="newBook">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <div style="color: #3333ff"><span class="fa fa-book"></span> SÁCH MỚI</div>
            </div>
            <div class="panel-body" id="list">
                <div class="container-fluid">
                    <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="newCarousel">
                        <div class="carousel-inner">
                        <?php $active = 0; $counter = 0; ?>
                        <?php foreach ($newBook as $newBook):?>
                        <?php if ($counter % 4 == 0): ?>
                        <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
                        <?php endif; ?>
                            <div class="col-md-3 item-list">               
                                <a href="<?php echo site_url().'member/Book/index/'.$newBook['bookID'] ?>" class="thumbnail item-image img-responsive">
                                    <img src="<?php echo $newBook['bookImg']; ?>" alt="<?php echo $newBook['bookName']; ?>" style="height: 120px">
                                </a>
                                <span style="position: absolute; z-index: 10;top:10px;right: 20px"><img src="<?php echo site_url(); ?>/template/icon/new.gif" alt=""/></span>
                                <div style="text-align: center">
                                    <div class="rateit" data-rateit-value="<?php echo $newBook['rate_avg'] ?>" data-rateit-readonly="true"></div>
                                    <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $newBook['rate_num'].' lượt đ.giá' ?>)</i></span>
                                </div>
                                <a href="<?php echo site_url().'member/Book/index/'.$newBook['bookID'] ?>" class="item-name"><?php echo stripslashes($newBook['bookName']); ?></a>
                                <p class="item-price"><?php echo 'Giá: $'.$newBook['bookPrice']; ?></p>              
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
    <!----------------------------------hot-sell------------------------------------>
    <div id="selBook">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <div style="color: #3333ff"><span class="fa fa-book"></span> SÁCH ĐƯỢC MUA NHIỀU</div>
            </div>
            <div class="panel-body" id="list">
                <div class="container-fluid">
                    <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="selCarousel">
                        <div class="carousel-inner">
                        <?php $active = 0; $counter = 0; ?>
                        <?php foreach ($sellBook as $sellBook):?>
                        <?php if ($counter % 4 == 0): ?>
                        <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
                        <?php endif; ?>
                            <div class="col-md-3 item-list">               
                                <a href="<?php echo site_url().'member/Book/index/'.$sellBook['bookID'] ?>" class="thumbnail item-image img-responsive">
                                    <img src="<?php echo $sellBook['bookImg']; ?>" alt="<?php echo $sellBook['bookName']; ?>" style="height: 120px">
                                </a>
                                <div style="text-align: center">
                                    <div class="rateit" data-rateit-value="<?php echo $sellBook['rate_avg'] ?>" data-rateit-readonly="true"></div>
                                    <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $sellBook['rate_num'].' lượt đ.giá' ?>)</i></span>
                                </div>
                                <a href="<?php echo site_url().'member/Book/index/'.$sellBook['bookID'] ?>" class="item-name"><?php echo stripslashes($sellBook['bookName']); ?></a>
                                <div class="text-center"><?php echo 'L.mua: '.$sellBook['qty']; ?></div> 
                                <p class="item-price"><?php echo 'Giá: $'.$sellBook['bookPrice']; ?></p>              
                            </div>
                        <?php if ($counter % 4 == 3): ?>
                        </div>
                        <?php endif; $counter++;?>
                        <?php endforeach;?>
                        </div>
                        <a class="left carousel-control" href="#selCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#selCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------book-rated------------------------------------>
    <div id="ratedBook">
        <?php if(isset($login) && isset($wellcome) && count($listBookRated)):?>
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <div style="color: #3333ff"><span class="fa fa-book"></span> SÁCH TỪNG ĐƯỢC BẠN ĐÁNH GIÁ</div>
            </div>
            <div class="panel-body" id="list">
                <div class="container-fluid">
                    <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="ratedCarousel">
                        <div class="carousel-inner">
                        <?php $active = 0; $counter = 0; ?>
                        <?php foreach ($listBookRated as $sellBook):?>
                        <?php if ($counter % 4 == 0): ?>
                        <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
                        <?php endif; ?>
                            <div class="col-md-3 item-list">               
                                <a href="<?php echo site_url().'member/Book/index/'.$sellBook['bookID'] ?>" class="thumbnail item-image img-responsive">
                                    <img src="<?php echo $sellBook['bookImg']; ?>" alt="<?php echo $sellBook['bookName']; ?>" style="height: 120px">
                                </a>
                                <div style="text-align: center">
                                    <div class="rateit" data-rateit-value="<?php echo $sellBook['rate_avg'] ?>" data-rateit-readonly="true"></div>
                                    <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $sellBook['rate_num'].' lượt đ.giá' ?>)</i></span>
                                </div>
                                <a href="<?php echo site_url().'member/Book/index/'.$sellBook['bookID'] ?>" class="item-name"><?php echo stripslashes($sellBook['bookName']); ?></a>
                                <p class="item-price"><?php echo 'Giá: $'.$sellBook['bookPrice']; ?></p>              
                            </div>
                        <?php if ($counter % 4 == 3): ?>
                        </div>
                        <?php endif; $counter++;?>
                        <?php endforeach;?>
                        </div>
                        <a class="left carousel-control" href="#ratedCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#ratedCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> 
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
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