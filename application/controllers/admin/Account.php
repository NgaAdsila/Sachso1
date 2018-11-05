<?php
class Account extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('session', 'form_validation', 'myclass'));
        $this->load->model('StaffModel');
    }
    
    public function index(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Thông tin cá nhân";
        
        $session = $this->session->userdata('adm');
        $staff = $this->StaffModel->getStaffById($session['id']);
        $show['data_content']['staff'] = $staff;
        $show['manager_content'] = "admin/personalInfo";
        $this->load->view('manager/layout',$show);
    }
    
    public function editName(){
        $session = $this->session->userdata('adm');
        $staffID = $session['id'];
        $data['fullName'] = addslashes(trim($this->input->post('name')));
        $check = $this->StaffModel->editStaff($data,$staffID);
        if ($check == TRUE){
            echo 'Cập nhật thông tin thành công!';
        } else {
            echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
        }
    }
    
    public function editSex(){
        $session = $this->session->userdata('adm');
        $staffID = $session['id'];
        $data['sex'] = addslashes(trim($this->input->post('sex')));
        $check = $this->StaffModel->editStaff($data,$staffID);
        if ($check == TRUE){
            echo 'Cập nhật thông tin thành công!';
        } else {
            echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
        }
    }

    public function editAdd(){
        $session = $this->session->userdata('adm');
        $staffID = $session['id'];
        $data['add'] = addslashes(trim($this->input->post('addr')));
        $check = $this->StaffModel->editStaff($data,$staffID);
        if ($check == TRUE){
            echo 'Cập nhật thông tin thành công!';
        } else {
            echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
        }
    }
    
    public function editTel(){
        $session = $this->session->userdata('adm');
        $staffID = $session['id'];
        $tel = addslashes(trim($this->input->post('tel')));
        $rule = "/^[0]{1}[0-9]{9,10}+$/";
        if (!preg_match($rule, $tel)){
            echo 'errTel';
        }else{
            $data['tel'] = $tel;
            $check = $this->StaffModel->editStaff($data,$staffID);
            if ($check == TRUE){
                echo 'Cập nhật thông tin thành công!';
            } else {
                echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
            }
        }
    }
    
    public function editEmail(){
        $session = $this->session->userdata('adm');
        $staffID = $session['id'];
        $email = addslashes(trim($this->input->post('email')));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo 'errEmail';
        }else{
            $check_email = $this->StaffModel->isEmailExistId($staffID,$email);
            if($check_email == FALSE){
                $data['email'] = $email;
                $check = $this->StaffModel->editStaff($data,$staffID);
                if ($check == TRUE){
                    echo 'Cập nhật thông tin thành công!';
                } else {
                    echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
                }
            } else {
                echo 'existEmail';
            }
        }
    }
    
    public function editPass(){
        $session = $this->session->userdata('adm');
        $staffID = $session['id'];
        $oldPass = addslashes($this->input->post('oldPass'));
        $newPass = addslashes($this->input->post('newPass'));
        $rePass = addslashes($this->input->post('rePass'));
        $check_oldPass = $this->StaffModel->getOldPass($staffID);
        if(md5($oldPass) == $check_oldPass[0]['pwd']){
            $rule = "/^[a-zA-Z0-9]+$/";
            if ((!preg_match($rule, $newPass))||(strlen($newPass) < 6)){
                echo 'errNewPass';
            }elseif($rePass === $newPass){
                $data['pwd'] = md5($newPass);
                $check = $this->StaffModel->editStaff($data,$staffID);
                if ($check == TRUE){
                    echo 'Cập nhật thông tin thành công!';
                } else {
                    echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
                }
            } else {
                echo 'errRePass';
            }
        } else {
            echo 'errOldPass';
        }
        
    }
    
    public function logout(){
        $this->session->unset_userdata('adm');
        redirect("manager/Account/index", "refresh");
    }
}
