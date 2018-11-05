<?php

class Staff extends CI_Controller{
    private $check = FALSE;
            
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation', 'myclass', 'pagination'));
        $this->load->model('StaffModel');
    }
    
    //Danh sách nhân viên
    public function viewListStaff(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Danh sách nhân viên";
        $show['manager_content'] = "admin/staffList";
        //Lấy thông tin chức vụ
        $role = $this->StaffModel->getRole();
        $show['data_content']['role'] = $role;
        
        //Tổng số nhân viên
        $total_staff = $this->StaffModel->getTotalStaff();
        //Số nhân viên trên 1 trang
        $per_page = 6;
        
        //Phân trang
        $config['total_rows'] = $total_staff;
        $config['per_page'] = $per_page;
        $config['base_url'] = site_url().'admin/Staff/viewListStaff';
        $config['uri_segment'] = 4;
        
        /* This Application Must Be Used With BootStrap 3 *  */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        
        $config['next_link'] = '<span class="glyphicon glyphicon-circle-arrow-right"></span>';
        $config['prev_link'] = '<span class="glyphicon glyphicon-circle-arrow-left"></span>';
        $config['first_link'] = '<span class="glyphicon glyphicon-backward"></span>';
        $config['last_link'] = '<span class="glyphicon glyphicon-forward"></span>';
        //Khởi tạo phân trang
        $this->pagination->initialize($config);
        
        //Tạo link phân trang
        $pagination = $this->pagination->create_links();
        
        //Lấy offset
        $offset = ($this->uri->segment(4) == '') ? 0 : $this->uri->segment(4);
        
        //Lấy nhân viên
        $staff = $this->StaffModel->getListStaff($per_page, $offset);
        
        $show['data_content']['staff'] = $staff;
        $show['data_content']['per_page'] = $offset+1;
        $show['data_content']['pagination'] = $pagination;
        $this->load->view('manager/layout',$show);
    }
    
    //Thêm nhân viên
    public function addStaff(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Thêm nhân viên";
        $show['manager_content'] = "admin/addStaff";

        //Lấy thông tin chức vụ
        $role = $this->StaffModel->getRole();
        $show['data_content']['role'] = $role;
        
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout', $show);
    }

    public function validateAdd() {

        $this->form_validation->set_rules('staffName', 'Tên đăng nhập', 'trim|required|min_length[4]|xss_clean|callback_staffName_check');
        $this->form_validation->set_rules('staffFullName', 'Họ tên', 'trim|required|xss_clean|callback_fullName_check');
        $this->form_validation->set_rules('staffSex', 'Giới tính', 'trim|required|xss_clean');
        $this->form_validation->set_rules('staffRole', 'Chức vụ', 'trim|required|xss_clean');
        $this->form_validation->set_rules('staffHomeLand', 'Quê quán', 'trim|required|xss_clean');
        $this->form_validation->set_rules('staffAdd', 'Nơi ở hiện tại', 'trim|required|xss_clean');
        $this->form_validation->set_rules('staffTel', 'Số điện thoại', 'trim|required|min_length[8]|max_length[11]|numeric|xss_clean|callback_tel_check');
        $this->form_validation->set_rules('staffEmail', 'Email', 'trim|required|valid_email|xss_clean|callback_staffEmail_check');
        $this->form_validation->set_rules('staffPass', 'Mật khẩu', 'trim|required|min_length[6]|xss_clean|callback_pass_check');
        $this->form_validation->set_rules('staffRePass', 'Nhập lại mật khẩu', 'trim|required|matches[staffPass]|xss_clean');

        //Kiểm tra tập luật
        if ($this->form_validation->run() == FALSE) {
            $this->addStaff();
        } else {
            $data['staffName'] = addslashes($this->input->post('staffName'));
            $data['fullName'] = addslashes($this->input->post('staffFullName'));
            $data['sex'] = $this->input->post('staffSex');
            $data['roleID'] = $this->input->post('staffRole');
            $data['homeLand'] = addslashes($this->input->post('staffHomeLand'));
            $data['add'] = addslashes($this->input->post('staffAdd'));
            $data['tel'] = $this->input->post('staffTel');
            $data['email'] = addslashes($this->input->post('staffEmail'));
            $data['pwd'] = md5($this->input->post('staffPass'));

            $check = $this->StaffModel->addStaff($data);
            if ($check == TRUE) {
                $this->check = TRUE;
            } else {
                echo 'Không thể thêm nhân viên! Hãy kiểm tra lại!';
            }
            $this->addStaff();
        }
    }
    
    //Sửa nhân viên
    public function editStaff(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Sửa thông tin nhân viên";
        $show['manager_content'] = "admin/editStaff";
        //Lấy thông tin nhân viên
        $staffID = $this->uri->segment(4);
        $staff = $this->StaffModel->getStaffById($staffID);
        $show['data_content']['staff'] = $staff;
        //Lấy thông tin chức vụ
        $role = $this->StaffModel->getRole();
        $show['data_content']['role'] = $role;
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout', $show);
    }
    
    public function validateEdit() {
        //thiết lập tập luật
        $this->form_validation->set_rules('staffName', 'Tên đăng nhập', 'trim|xss_clean');
        $this->form_validation->set_rules('staffFullName', 'Họ tên', 'trim|required|xss_clean|callback_fullName_check');
        $this->form_validation->set_rules('staffSex', 'Giới tính', 'trim|required|xss_clean');
        $this->form_validation->set_rules('staffRole', 'Chức vụ', 'trim|xss_clean');
        $this->form_validation->set_rules('staffHomeLand', 'Quê quán', 'trim|required|xss_clean');
        $this->form_validation->set_rules('staffAdd', 'Nơi ở hiện tại', 'trim|required|xss_clean');
        $this->form_validation->set_rules('staffTel', 'Số điện thoại', 'trim|required|min_length[8]|max_length[11]|numeric|xss_clean|callback_tel_check');
        $this->form_validation->set_rules('staffEmail', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('staffOldPass', 'Mật khẩu cũ', 'trim|required|min_length[6]|xss_clean|callback_oldPass_check');
        $this->form_validation->set_rules('staffNewPass', 'Mật khẩu mới', 'trim|min_length[6]|xss_clean');

        //Kiểm tra tập luật
        if ($this->form_validation->run() == FALSE) {
            $this->editStaff();
        } else {
            $staffID = $this->uri->segment(4);
            
            $data['fullName'] = addslashes($this->input->post('staffFullName'));
            $data['sex'] = $this->input->post('staffSex');
            $data['homeLand'] = addslashes($this->input->post('staffHomeLand'));
            $data['add'] = addslashes($this->input->post('staffAdd'));
            $data['tel'] = $this->input->post('staffTel');
            $data['email'] = addslashes($this->input->post('staffEmail'));
            if ($this->input->post('staffNewPass') != ''){
                $data['pwd'] = md5($this->input->post('staffNewPass'));
            }
            $check = $this->StaffModel->editStaff($data,$staffID);
            if ($check == TRUE) {
                $this->check = TRUE;
                $this->editStaff();
            } else {
                echo 'Không thể thêm nhân viên! Hãy kiểm tra lại!';
            }
        }
    }
    
    //Phân quyền nhân viên
    public function staffRole(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Phân quyền nhân viên";
        $show['manager_content'] = "admin/staffRole";
        //Lấy thông tin chức vụ
        $role = $this->StaffModel->getRole();
        $show['data_content']['role'] = $role;
        //Lấy thông tin nhân viên
        $staff = $this->StaffModel->getStaffRole();
        $show['data_content']['staff'] = $staff;
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout',$show);
    }

    public function validateRole(){
        $this->form_validation->set_rules('staffRole', 'Chức vụ mới', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->staffRole();
        } else {
            $staffID = $this->input->post('staffID');
            $data['roleID'] = $this->input->post('staffRole');

            $this->check = $this->StaffModel->editStaff($data,$staffID);
            $this->staffRole();
        }
    }

    //Kiểm tra mật khẩu cũ
    public function oldPass_check($str){
        $staffID = $this->uri->segment(4);
        $pwd = $this->StaffModel->getOldPass($staffID);
        if (md5($str) == $pwd[0]['pwd']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('oldPass_check','%s không đúng');
            return FALSE;
        }
    }

    //Thiết lập lỗi tên đã tồn tại chưa
    public function staffName_check($str) {
        $rule = "/^[a-zA-Z0-9]+$/";
        if (!preg_match($rule, $str)){
            $this->form_validation->set_message('staffName_check', '%s chỉ bao gồm chữ cái không dấu và ký tự số!');
            return FALSE;
        }  elseif ($this->StaffModel->isNameExist($str) == TRUE) {
            $this->form_validation->set_message('staffName_check', '%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Thiết lập luật cho tên đầy đủ
    public function fullName_check($str){
        if (strpbrk($str, '/\\:*?<>|"`!@#$%^&*()_-+={}[]~')){
            $this->form_validation->set_message('fullName_check', '%s không được chứa ký tự đặc biệt (ngoại trừ . và'." ')".'!');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    //Thiết lập luật cho số điện thoại
    public function tel_check($str){
        $rule = "/^[0]{1}[0-9]+$/";
        if (!preg_match($rule, $str)){
            $this->form_validation->set_message('tel_check', '%s phải bắt đầu là số 0!');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    //Thiết lập luật cho mật khẩu
    public function pass_check($str){
        $rule = "/^[a-zA-Z0-9]+$/";
        if (!preg_match($rule, $str)){
            $this->form_validation->set_message('pass_check', '%s chỉ bao gồm chữ cái không dấu và ký tự số!');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    //Thiết lập lỗi email đã tồn tại chưa
    public function staffEmail_check($str) {
        if ($this->StaffModel->isEmailExist($str) == TRUE) {
            $this->form_validation->set_message('staffEmail_check', '%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    // Xóa nhân viên
    public function deleteStaff() {
        $staffID = $this->uri->segment(4);
        $check = $this->StaffModel->delStaff($staffID);
        if($check == TRUE){
            redirect('admin/Staff/viewListStaff', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }
}
