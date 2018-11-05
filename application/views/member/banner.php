<div class="col-md-12" style="margin-bottom: 20px;">
    <div class="carousel slide" data-ride="carousel" data-interval="3000" id="mySlider">
        <ol class="carousel-indicators">  
            <li class="active" data-slide-to="0" data-target="#mySlider"></li>  
            <li data-slide-to="1" data-target="#mySlider"></li> 
            <li data-slide-to="2" data-target="#mySlider"></li>
            <li data-slide-to="3" data-target="#mySlider"></li>
            <li data-slide-to="4" data-target="#mySlider"></li>  
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="<?php echo site_url().'/bookImg/slider/1.jpg'; ?>" alt="Tiểu thuyết..."/>
                <div class="carousel-caption">
                    <a href="<?php echo site_url().'Home/typeBook/'.$type[0]['typeID']; ?>"><h3>Tiểu thuyết...</h3></a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo site_url(); ?>/bookImg/slider/2.jpg" alt="Truyện tranh..."/>
                <div class="carousel-caption">
                    <a href="<?php echo site_url().'Home/typeBook/'.$type[1]['typeID']; ?>"><h3>Truyện tranh...</h3></a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo site_url(); ?>/bookImg/slider/3.jpg" alt="Sách nghệ thuật..."/>
                <div class="carousel-caption">
                    <a href="<?php echo site_url().'Home/typeBook/'.$type[2]['typeID']; ?>"><h3>Sách nghệ thuật...</h3></a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo site_url(); ?>/bookImg/slider/4.png" alt="Sách khoa học..."/>
                <div class="carousel-caption">
                    <a href="<?php echo site_url().'Home/typeBook/'.$type[3]['typeID']; ?>"><h3>Sách khoa học...</h3></a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo site_url(); ?>/bookImg/slider/5.jpg" alt="Sách lịch sử..."/>
                <div class="carousel-caption">
                    <a href="<?php echo site_url().'Home/typeBook/'.$type[4]['typeID']; ?>"><h3>Sách lịch sử...</h3></a>
                </div>
            </div>
        </div>
    </div>
</div>