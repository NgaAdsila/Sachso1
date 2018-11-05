<script type="text/javascript">
    function searchBook() {
        if ($('#search input[type=text]').val().trim() === "") {
            alert("Mời bạn nhập từ khóa tìm kiếm");
            return false;
        } else {
            return true;
        }
    }
    function errorContact() {
        alert("Bạn cần đăng nhập để thực hiện chức năng này!");
        return false;
    }
    $(document).ready(function () {
        $('#sendFB').click(function () {
            if ($('#contentFB').val().trim() === "") {
                $('#errorFB').html('Bạn chưa nhập thông tin phản hồi!');
                return false;
            } else {
                $.post(
                        "<?php echo site_url(); ?>Home/sendFB",
                        {feedbackContent: $('#contentFB').val()},
                function (result) {
                    $('.modal-body').html(result);
                    $('#sendFB').attr('disabled', 'disabled');
                    $('#exit').text('Đóng');
                },
                        "text"
                        );
                return true;
            }
        });
    });
</script>
<nav class="navbar navbar-default" role="navigation" style="background: lightgreen; font-family: 'Arial'">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menubar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo site_url(); ?>" class="navbar-brand"> 
                Sachso1
            </a>
        </div>
        <div class="collapse navbar-collapse" id="menubar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="javascript:void(0)" class="cate-menu dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-align-justify"></span> Danh mục sách<span class="caret"></span></a>
                    <ul class="dropdown-menu menu">
                        <?php foreach ($type as $type): ?>
                        <li style="width: 270px;border-bottom: 1px dotted #ffccff;margin: 0px">
                            <a href="<?php echo site_url().'Home/typeBook/'.$type['typeID']; ?>">
                                <span class="fa fa-book"></span> <?php echo $type['typeName']; ?>
                                <span style="font-size: 85%;color: #999999"><?php echo '(Gồm '.$countType[$type['typeID']].' sách)'; ?></span>
                            </a>
                            <p style="font-size: 80%;margin-left: 10px"><?php echo $type['typeTitle']; ?></p>
                            <ul class="menu-listbox" style="display: none">
                                <div class="sub" id="listbox-hightlight">
                                    <h4 class="text-center">Nổi Bật</h4>
                                    <hr />
                                    <div class="cell"><a href="<?php echo site_url().'Home/typeBook/'.$type['typeID']; ?>#topType">
                                            &bull;&nbsp;<?php echo 'Sách đang hot '; ?><img src="<?php echo site_url(); ?>/template/icon/hot.gif" height="20"/></a></div> 
                                    <div class="cell"><a href="<?php echo site_url().'Home/typeBook/'.$type['typeID']; ?>#newType">
                                            &bull;&nbsp;<?php echo 'Sách mới nhất '; ?><img src="<?php echo site_url(); ?>/template/icon/new.gif" height="20"/></a></div>
                                </div>
                                <div class="sub" id="listbox-searchprice">
                                    <h4 class="text-center">Tìm kiếm theo giá</h4>
                                    <hr />
                                    <div class="cell">
                                        <a <?php if (isset($_GET['p']) && $_GET['p'] == "duoi-5") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?p=duoi-5&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-money"></span> Dưới $5.00
                                        </a>
                                    </div> 
                                    <div class="cell">
                                        <a <?php if (isset($_GET['p']) && $_GET['p'] == "5-10") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?p=5-10&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-money"></span> Từ $5.00 đến $10.00
                                        </a>
                                    </div>
                                    <div class="cell">
                                        <a <?php if (isset($_GET['p']) && $_GET['p'] == "10-15") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?p=10-15&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-money"></span> Từ $10.00 đến $20.00
                                        </a>
                                    </div>
                                    <div class="cell">
                                        <a <?php if (isset($_GET['p']) && $_GET['p'] == "20-hon") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?p=20-hon&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-money"></span> Trên $20.00
                                        </a>
                                    </div> 
                                </div>
                                <div class="sub" id="listbox-searchprice">
                                    <h4 class="text-center">Tìm theo năm xuất bản</h4>
                                    <hr />
                                    <div class="cell">
                                        <a <?php if (isset($_GET['y']) && $_GET['y'] == "truoc-1980") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?y=truoc-1980&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-calendar"></span> Trước năm 1980
                                        </a>
                                    </div> 
                                    <div class="cell">
                                        <a <?php if (isset($_GET['y']) && $_GET['y'] == "1980-1989") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?y=1980-1989&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-calendar"></span> Từ năm 1980 đến năm 1989
                                        </a>
                                    </div>
                                    <div class="cell">
                                        <a <?php if (isset($_GET['y']) && $_GET['y'] == "1990-1999") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?y=1990-1999&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-calendar"></span> Từ năm 1990 đến năm 1999
                                        </a>
                                    </div>
                                    <div class="cell">
                                        <a <?php if (isset($_GET['y']) && $_GET['y'] == "2000-sau") echo "class=choose"; ?> 
                                            href="<?php echo site_url(); ?>member/Search/link?y=2000-sau&typeID=<?php echo $type['typeID'] ?>">
                                            <span class="fa fa-calendar"></span> Từ năm 2000 đến nay
                                        </a>
                                    </div> 
                                </div>
                            </ul>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <script type="text/javascript">
                        $(document).ready(function(e) {
                            $('ul.menu li').hover(function(e) {
                                $(this).find(".menu-listbox").show();},function(){
                                    $('.menu-listbox').hide();
                            });
                        });
                    </script> 
                </li>
                <li><a href="<?php echo site_url().'Home/introduce'?>"><span class="fa fa-info-circle"></span> Giới thiệu</a></li>
                <li><a href="<?php echo site_url().'Home/security'?>"><span class="fa fa-shield"></span> Chính sách bảo mật</a></li>
                <li>
                    <?php if (!isset($login) || !isset($wellcome)) { ?>
                        <a href="#" onclick="return errorContact()"><span class="fa fa-reply-all"></span> Phản hồi ý kiến</a>
                    <?php } else { ?>
                        <a href="#contact-modal" data-toggle="modal"><span class="fa fa-reply-all"></span> Phản hồi ý kiến</a>
                    <?php } ?>
                </li>
            </ul>
            <form id="search" action="<?php echo site_url(); ?>member/Search/index" class="navbar-form navbar-right" method="get" role="search">
                <div class="input-group">
                    <input type="text" name="kw" class="form-control" placeholder="Nhập tên sách..."/>
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit" onclick="return searchBook()"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>
<!-- Modal-contact -->
<div class="modal fade" id="contact-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>THÔNG TIN Ý KIẾN PHẢN HỒI</strong></h4>
            </div>
            <div class="modal-body">
                <textarea id="contentFB" class="form-control" name="feedbackContent" rows="5" placeholder="Nhập ý kiến phản hồi"
                          style="resize: vertical; max-height: 250px"><?php echo set_value('feedbackContent'); ?></textarea>
                <div id="errorFB" style="color: red; margin: 5px 0px 0px 10px"></div>
            </div>
            <div class="modal-footer">
                <button id="exit" type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button id="sendFB" type="submit" class="btn btn-info">Gửi ý kiến phản hồi</button>
            </div>
        </div>
    </div>
</div>