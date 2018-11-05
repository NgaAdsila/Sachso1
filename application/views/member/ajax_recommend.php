<script src="<?php echo base_url(); ?>/template/js/jquery.rateit.js" type="text/javascript"></script>
<?php if(!count($book_cmd)): ?>
<h4 class="text-center">Không có kết quả trả về!</h4>
<?php else: ?>
    <div class="container-fluid">
    <div class="carousel slide row multi-car" data-type="multi" data-interval="false" id="recommendCarousel">
        <div class="carousel-inner">
    <?php $active = 0; $counter = 0; ?>
    <?php foreach ($book_cmd as $book_cmd):?>
        <?php if ($counter % 4 == 0): ?>
        <div class="item <?php if($active == 0) {echo 'active';$active = 1;} ?>">
        <?php endif; ?>
            <div class="col-md-3 item-list">               
                <a href="<?php echo site_url().'member/Book/index/'.$book_cmd['bookID'] ?>" class="thumbnail item-image img-responsive">
                    <img src="<?php echo $book_cmd['bookImg']; ?>" alt="<?php echo $book_cmd['bookName']; ?>" style="height: 120px">
                </a>
                <div style="text-align: center">
                    <?php 
                    if (count($book_cmd_avg)){
                        $i = 0;
                        while ($i < count($book_cmd_avg)){
                            if($book_cmd['bookID'] === $book_cmd_avg[$i]['bookID']){?>
                            <div class="rateit" data-rateit-value="<?php echo $book_cmd_avg[$i]['rate_avg'];?>" data-rateit-readonly="true"></div>
                            <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $book_cmd_avg[$i]['rate_num'].' lượt đ.giá'; ?>)</i></span>
                            <?php break;} else {
                                $i++;
                            }
                        }
                    } else { ?>
                            <div class="rateit" data-rateit-value="<?php echo $book_cmd['rate_avg'];?>" data-rateit-readonly="true"></div>
                            <span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $book_cmd['rate_num'].' lượt đ.giá'; ?>)</i></span>
                    <?php }?>
                </div>
                <a href="<?php echo site_url().'member/Book/index/'.$book_cmd['bookID'] ?>" class="item-name"><?php echo stripslashes($book_cmd['bookName']); ?></a>
                <p class="item-price"><?php echo 'Giá: $'.$book_cmd['bookPrice']; ?></p>              
            </div>
        <?php if ($counter % 4 == 3): ?>
        </div>
        <?php endif; $counter++;?>   
    <?php endforeach;?>
        </div>
        <a class="left carousel-control" href="#recommendCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control" href="#recommendCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> 
    </div>
    </div>
<?php endif; 
