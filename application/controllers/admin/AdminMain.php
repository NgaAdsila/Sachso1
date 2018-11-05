<?php
class AdminMain extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('myclass');
        $this->load->model('StaffModel');
        $this->load->model('MemberModel');
    }

    public function home() {
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Trang chủ";
        $show['manager_content'] = "admin/home";

        //lấy nhân viên mới
        $staff = $this->StaffModel->getNewStaff();
        $show['data_content']['staff'] = $staff;

        //lấy thành viên mới
        $member = $this->MemberModel->getNewMember();
        $show['data_content']['member'] = $member;
        
        $this->load->view('manager/layout', $show);
    }

    public function introduce(){
        $show = $this->myclass->admin_default();
        $show['title'] = 'Admin - Giới thiệu';
        $show['manager_content'] = "admin/introduction";
        $this->load->view('manager/layout', $show);
    }
    
    public function deleteStaff() {
        $staffID = $this->uri->segment(4);
        $check = $this->StaffModel->delStaff($staffID);
        if($check == TRUE){
            redirect('admin/AdminMain/home', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }

    public function deleteMember() {
        $memberID = $this->uri->segment(4);
        $check = $this->MemberModel->delMember($memberID);
        if($check == TRUE){
            redirect('admin/AdminMain/home', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }
    
}
