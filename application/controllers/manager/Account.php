<?php
class Account extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('StaffModel');
    }

    public function index() {
        $this->load->view('manager/login');
    }
    
    public function ajax_login(){
        $managerName = $this->input->post('managerName');
        $managerPass = md5($this->input->post('managerPass'));
        $staff = $this->StaffModel->getStaff($managerName, $managerPass);
        if(count($staff) == 1){
            //Xét quyền cho nhân viên
            $roleID = $staff[0]['roleID'];
            $id = $staff[0]['staffID'];
            $name = $staff[0]['staffName'];
            if ($roleID == 'ADM') {
                $session_adm = array(
                    'id' => $id,
                    'name' => $name
                );
                $this->session->set_userdata('adm', $session_adm);
                echo 'admin/AdminMain/home';
            } elseif ($roleID == 'SEL') {
                $session_sel = array(
                    'id' => $id,
                    'name' => $name
                );
                $this->session->set_userdata('sel', $session_sel);
                echo 'seller/SellerMain/home';
            } else {
                echo 'notMAN';
            }
        } else {
            echo 'false';
        }
    }
}
