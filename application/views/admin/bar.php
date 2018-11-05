<li style="width: 210px;border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(2) == 'PersonalInfo') echo 'selected';?>
        href="<?php echo site_url();?>admin/Account/index">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Thông tin cá nhân</a>
</li>
<li style="border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(3) == 'viewListStaff') echo 'selected';?>
        href="<?php echo site_url();?>admin/Staff/viewListStaff">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Quản lý nhân viên</a>
</li>
<li style="border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(3) == 'staffRole') echo 'selected';?>
        href="<?php echo site_url();?>admin/Staff/staffRole">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Phân quyền nhân viên</a>
</li>
<li style="border-bottom: 1px dotted #ffccff;margin: 0px">
	<a <?php if($this->uri->segment(3) == 'viewListMember') echo 'selected';?>
        href="<?php echo site_url();?>admin/Member/viewListMember">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Quản lý thành viên</a>
</li>   
<li><a <?php if($this->uri->segment(3) == 'lockMember') echo 'selected';?>
        href="<?php echo site_url();?>admin/Member/lockMember">
    <span class="glyphicon glyphicon-triangle-right"></span>
    Khóa/mở khóa thành viên</a>
</li>