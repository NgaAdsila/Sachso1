<div class="container-fluid">
    <div id="searchKey">
		<?php if(!count($books)): ?>
		<h4 style="text-align: center">Rất tiếc, hệ thống không có sách bạn đang tìm kiếm!</h4>
		<?php else: ?>
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: left">
                <label style="color: #3333ff">
                    <span class="glyphicon glyphicon-link"></span> KẾT QUẢ TÌM KIẾM:
                </label>
                <div class="navbar-right">
                    <select class="form-control sort-search">
                        <option value="">Sắp xếp kết quả</option>
                        <option value="asc">Xếp giá tăng dần</option>
                        <option value="desc">Xếp giá giảm dần</option>
                    </select>
                </div>
            </div>
            <div class="panel-body" id="list">
		<?php foreach ($books as $books):?>
                    <div class="col-md-3 item-list">               
                        <a href="<?php echo site_url().'member/Book/index/'.$books['bookID'] ?>" class="thumbnail item-image img-responsive">
                            <img src="<?php echo $books['bookImg']; ?>" alt="<?php echo $books['bookName']; ?>" style="height: 120px">
                        </a>
                        <div style="text-align: center">
                            <div class="rateit" data-rateit-value="<?php echo $books['rate_avg'] ?>" data-rateit-readonly="true"></div>
							<span style="font-size: 85%;color: #cc00cc"><i>(<?php echo $books['rate_num'].' lượt đ.giá' ?>)</i></span>
                        </div>
                        <a href="<?php echo site_url().'member/Book/index/'.$books['bookID'] ?>" class="item-name"><?php echo stripslashes($books['bookName']); ?></a>
                        <p class="item-price"><?php echo 'Giá thành: $'.$books['bookPrice']; ?></p>              
                    </div>
                <?php endforeach;?>
                <div style="text-align: center" class="col-md-12">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
		<?php endif; ?>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('.sort-search').change(function (){
            if($('.sort-search').val() === ""){
                return false;
            } else {
                if ($('.sort-search').val() === "asc"){
                    window.location.replace("<?php echo site_url().'member/Search/'.$link.'&sort=asc'; ?>");
                }
                if ($('.sort-search').val() === "desc"){
                    window.location.replace("<?php echo site_url().'member/Search/'.$link.'&sort=desc'; ?>");
                }
                return true;
            }
        });
    });
</script>