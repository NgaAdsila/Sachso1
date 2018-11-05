<div class="container-fluid">
    <?php foreach ($bookInfo as $bookInfo): ?>
        <?php $max_quantity = $bookInfo['bookQuantity']; ?>
        <div id="info-header">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div style=" width: 90%; height: 230px;">
                        <img src="<?php echo $bookInfo['bookImg']; ?>" alt="<?php echo stripslashes($bookInfo['bookName']) ?>" height="228px"/>
                    </div>
                    <div id="rate_default">
                        <div class="rateit" data-rateit-value="<?php if (count($rate_avg)){echo $rate_avg[0]['rate_avg'];}else{echo '0';} ?>" data-rateit-readonly="true"></div>
                        <span style="color: #999999">(<?php echo 'Có ' . $count_rate . ' lượt đánh giá'; ?>)</span>
                        <p class="btn btn-default rate-star" style="border: none; background: transparent">
                            <span id="icon-btn" class="fa fa-angle-double-down"></span></p>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('.rate-star').hover(function (){
                                if( $("#rate_star").is(":hidden") ) {
                                    $('#rate_star').show('slow');
                                    $('#icon-btn').attr('class','fa fa-angle-double-up');
                                }else{
                                    $("#rate_star").hide('slow');
                                    $('#icon-btn').attr('class','fa fa-angle-double-down');
                                }
                            });
                        });
                    </script>
                    <div id="rate_star" class="container-fluid text-justify" style="display: none">    
                        <p><i>Chi tiết:</i></p>
                        <?php foreach ($count_star as $count_star):?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="rateit" data-rateit-value="<?php echo $count_star['ratingScore'] ?>" 
                                     data-rateit-readonly="true"></div>
                            </div>
                            <div class="col-md-8">
                                <?php $number = number_format((100*$count_star['rate_count']/$count_rate),2) ?>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                         aria-valuenow="<?php echo $number; ?>" 
                                         aria-valuemin="0" aria-valuemax="100" 
                                         style="color: black;width:<?php echo $number.'%' ?>">
                                        <?php echo $number.'%' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div style="clear: both"></div>
                    <div class="sharing">
                        <span style="font-weight: bold">Chia sẻ: </span>
                        <a href="https://www.facebook.com/dialog/feed?app_id=1625478237777642
                           &redirect_uri=<?php echo site_url(); ?>member/Book/index/<?php echo $bookInfo['bookID'] ?>
                           &picture=<?php echo $bookInfo['bookImg'] ?>
                           &caption=<?php echo stripslashes($bookInfo['bookName']) ?>
                           &description=<?php echo word_limiter(stripslashes($bookInfo['bookContent']), '20') ?>"
                           title="Chia sẻ qua Facebook" target="_top">
                            <span class="fa fa-facebook-square fa-2x"></span>
                        </a>
                        <?php 
                            if(isset($_GET['post_id'])){
                                echo "<script> alert('Chia sẻ thành công!'); </script>";
                                redirect(site_url().'member/Book/index/'.$bookInfo['bookID'], 'refresh');
                            }?>
                        <a href="mailto:?subject=Chia sẻ sách <?php echo stripslashes($bookInfo['bookName']) ?>&amp;body=Hãy truy cập tại <?php echo site_url(); ?>member/Book/index/<?php echo $bookInfo['bookID']; ?>"
                            title="Chia sẻ qua Email" style="margin-left: 5px;">
                            <span class="fa fa-envelope-square fa-2x"></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <p style="font-size: 23px;height: 35px;overflow: hidden;border-bottom: 1px solid #cccccf">
                        <strong><span class="fa fa-book"></span> <?php echo stripslashes($bookInfo['bookName']); ?></strong>
                    </p>
                    <div id="info-content" style="margin-bottom: 5px;border-bottom: 1px solid #cccccf">
                        <div class="row">
                            <div class="col-md-6" style="border-right: 1px solid #66ffff">
                                <p><strong>
                                    <span>Tình trạng: </span>
                                    <span style="color: red;"><?php
                                        if ($max_quantity < 1) {
                                            echo 'Hết hàng!';
                                        } else {
                                            echo 'Còn hàng';
                                        }
                                        ?></span>
                                </strong></p>
                                <ul style="list-style-type: none;color: #333333;">
                                    <li><span class="fa fa-info-circle"></span> Mã ISBN: <?php echo $bookInfo['bookID']; ?></li>
                                    <li><span class="fa fa-info-circle"></span> Danh mục: 
                                        <a href="<?php echo site_url() . 'Home/book_cmd/' . $bookInfo['typeID']; ?>">
                                            <?php echo $bookInfo['typeName']; ?></a></li>
                                    <li style="height: 20px; overflow: hidden">
                                        <span class="fa fa-info-circle"></span> Tác giả: <?php echo $bookInfo['author']; ?>
                                    </li>
                                    <li style="height: 20px; overflow: hidden">
                                        <span class="fa fa-info-circle"></span> Nhà xuất bản: <?php echo $bookInfo['publisher']; ?>
                                    </li>
                                    <li><span class="fa fa-info-circle"></span> Năm xuất bản: <?php echo $bookInfo['yearOfPublication']; ?></li>
                                </ul>
                                <p style="font-size: 16px; color: red;">
                                    Giá sách: <span class="fa fa-usd"></span> <?php echo $bookInfo['bookPrice']; ?> 
                                    <span style="font-size: 12px;font-weight: bold"> (Đã có VAT)</span></p>
                            </div>
                            <div class="col-md-6">
                                <br/><br/>
                                <b style="color: red"><span class="fa fa-gift" style="font-size: 20px"></span> Ưu đãi từ Bookstore:</b>
                                <ul class="text-justify"><i>
                                    <li>Miễn phí đổi trả trong vòng 7 ngày.</li>
                                    <li>Nhận giao hàng phạm vi toàn quốc.</li>
                                    <li>Chi tiết xem tại "<a href="<?php echo site_url().'Home/introduce'?>">giới thiệu về cửa hàng</a>"</li>
                                </i></ul>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <div class="add-cart">
                        <form action="<?php echo site_url(); ?>member/Cart/add/<?php echo $bookInfo['bookID']; ?>" method="post">
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="quantity" 
                                       min="1" max="<?php echo $max_quantity; ?>" value="1" 
                                       <?php
                                       if ($max_quantity < 1) {
                                           echo 'disabled';
                                       }
                                       ?>/>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger" style="font-weight: bold" 
                                        <?php if (!isset($login) || !isset($wellcome) || $max_quantity < 2) {
                                            echo 'disabled=true';
                                        } ?>>
                                    <span class="fa fa-cart-plus" style="font-size: 13pt"></span> Thêm vào giỏ hàng
                                </button>
                            </div>
                        </form>
                        <div class="col-md-6">
                            <a href='<?php echo site_url(); ?>member/Account/login' style="color: red">
                                <?php
                                if (!isset($login) || !isset($wellcome)) {
                                    echo 'Bạn cần đăng nhập để thực hiện chức năng này!';
                                }
                                ?></a>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div><br/>
        <div class="book-content">
            <label>Tóm tắt nội dung:</label><br/>
            <textarea rows="4" style="width: 100%; resize: vertical; background: transparent; 
                      text-align: justify;border: none;max-height: 200px; overflow: auto"><?php echo stripslashes($bookInfo['bookContent']) ?></textarea>
        </div>
        <div class="rating">
            <div class="rating-title" style="float: left; margin-right: 20px">
                <label for="inputRating">Đánh giá của bạn: </label>
            </div>
            <div class="rating-star">
                <?php if (isset($login) && isset($wellcome)) { ?>
                    <div id="mem_rate" class="rateit" data-rateit-value="<?php if (count($scoreRatingBook) != 0) {
                        echo $scoreRatingBook[0]['ratingScore'];
                    } ?>" data-rateit-min="0" data-rateit-max="5" data-rateit-step="1"></div>
                <?php } else { ?>
                    <a href='<?php echo site_url(); ?>member/Account/login' style="line-height: 30px; color: red">
                <?php echo 'Bạn cần đăng nhập để thực hiện chức năng này!'; ?>
                    </a>
                <?php } ?>
            </div>
            <!--Lấy giá trị đánh giá-->
            <script type="text/javascript">
                $(function () {
                    $('#mem_rate').bind('rated', function (e) {
                        var ri = $(this);
                        var value = ri.rateit('value');
                        var memberID = '<?php if (isset($login) && isset($wellcome)) {echo $memberID;} ?>';
                        var bookID = '<?php echo $bookInfo['bookID']; ?>';
                        if (value === 0) {
                            alert('Giá trị đánh giá tối thiểu là 1 sao');
                        } else {
                            resultLoad();
                            $.ajax({
                                url: "<?php echo site_url(); ?>member/Book/recommendBook",
                                type: "post",
                                data: {
                                    rateScore: value,
                                    bookID: bookID,
                                    memberID: memberID
                                },
                                success: function (result) {
                                    response = JSON.parse(result);
                                    book_cmd = response.book_cmd;               
                                    $('#recommendBook').html(book_cmd);
                                    resultShow();
                                }
                            });
                            function resultLoad() {
                                $('#main-ajax-loader').show();
                                $('#recommendBook').css({
                                    'opacity': '0.3',
                                    'filter': 'alpha(opacity=30)'
                                });
                            }
                            function resultShow() {
                                $('#main-ajax-loader').hide();
                                $('#recommendBook').css({
                                    'opacity': '1',
                                    'filter': 'alpha(opacity=100)'
                                });
                            }
                        }
                    });
                });
            </script>
        </div>
    <?php endforeach; ?>
    <div style="clear: both"></div>
    <!----------------Recommend--------------->
    <div id="recommend">
        <?php $this->load->view('member/recommend'); ?>
    </div>
    <!----------------Sách được đánh giá--------------->
    <div id="OtherBookInType">
        <?php //if (count($list_book_rated)):?>
        <?php //$this->load->view('member/otherBookRated');?>
        <?php //endif; ?>
    </div>
    <!----------------Sách cùng danh mục--------------->
    <div id="OtherBookInType">
        <?php $this->load->view('member/otherBookInType');?>
    </div>
    <!----------------Sách cùng tác giả--------------->
    <div id="OtherBookWithAuthor">
        <?php $this->load->view('member/otherBookWithAuthor');?>
    </div>
    <!--<div id="comment" class="text-center" style="clear: both">
        <div class="fb-comments" data-href="https://www.facebook.com/book.wonfriend" data-numposts="5"></div>
    </div>-->
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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=1625478237777642";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>