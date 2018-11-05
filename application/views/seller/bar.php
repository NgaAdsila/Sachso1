<li style="width: 210px;border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(2) == 'PersonalInfo') echo 'selected';?>
        href="<?php echo site_url();?>seller/Account/index">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Thông tin cá nhân</a>
</li>
<li style="border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(3) == 'viewListType') echo 'selected';?>
    href="<?php echo site_url();?>seller/Type/viewListType">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Quản lý danh mục sách</a>
</li>
<li style="border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(3) == 'viewListBook') echo 'selected';?>
    href="<?php echo site_url();?>seller/Book/viewListBook">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Quản lý sách</a>
</li>
<li style="border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(3) == 'viewListOrder') echo 'selected';?>
        href="<?php echo site_url();?>seller/Order/viewListOrder">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Quản lý đơn hàng</a>
</li>
<li style="border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(3) == 'viewListFB') echo 'selected';?>
        href="<?php echo site_url();?>seller/Feedback/viewListFB">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Quản lý ý kiến phản hồi</a>
</li>
<li class="dropdown-submenu"><a class="trigger" href="javascript: void(0)">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Báo cáo thống kê</a>
    <ul class="dropdown-menu sub-menu nav nav-pills nav-stacked">
        <li style="width: 200px;border-bottom: 1px dotted #ffccff;margin: 0px">
			<a <?php if($this->uri->segment(3) == 'reportDate') echo 'selected';?>
                href="<?php echo site_url();?>seller/Report/reportDate">
                <span class="glyphicon glyphicon-hand-right"></span>
                Báo cáo theo ngày</a></li>
        <li style="border-bottom: 1px dotted #ffccff;margin: 0px">
			<a <?php if($this->uri->segment(3) == 'reportMonth') echo 'selected';?>
                href="<?php echo site_url();?>seller/Report/reportMonth">
                <span class="glyphicon glyphicon-hand-right"></span>
                Báo cáo theo tháng</a></li>
<!--        <li><a <?php //if($this->uri->segment(3) == 'reportYear') echo 'selected';?>
                href="<?php //echo site_url();?>seller/Report/reportYear">
                <span class="glyphicon glyphicon-hand-right"></span>
                Báo cáo theo năm</a></li>-->
    </ul>
</li>
<script>
    $(function(){
	$(".dropdown-menu > li > a.trigger").on("click",function(e){
            var current=$(this).next();
            var grandparent=$(this).parent().parent();
            grandparent.find(".sub-menu:visible").not(current).hide();
            current.toggle();
            e.stopPropagation();
	});
    });
</script>
<style>
.dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    display:none;
    margin-top: -1px;
    border-top-left-radius:0;
    border-bottom-left-radius:0;
    border-left-color:#fff;
    box-shadow:none;
}
</style>