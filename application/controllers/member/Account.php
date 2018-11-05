<?php
class Account extends CI_Controller{
    
    private $check = FALSE;
    private $lock = FALSE;
    private $unlock = FALSE;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url','cookie'));
        $this->load->library(array('session', 'form_validation','myclass','email'));
        $this->load->model('MemberModel');
    }
    
    //Quản lý thông tin cá nhân
    public function personalManage(){
        $show = $this->myclass->session_member();
        $show['title'] = "BS - Thông tin cá nhân";
        
        $session = $this->session->userdata('logged_in');
        $member = $this->MemberModel->getMemberById($session['id']);
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = "Quản lý thông tin cá nhân";
        $show['data_content']['member'] = $member;
        $show['content_main'] = "member/personalInfo";
        $this->load->view('layout',$show);
    }
    
    public function editName(){
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $data['fullName'] = addslashes(trim($this->input->post('name')));
        $check = $this->MemberModel->editMember($data,$memberID);
        if ($check == TRUE){
            echo 'Cập nhật thông tin thành công!';
        } else {
            echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
        }
    }
    
    public function editSex(){
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $data['sex'] = addslashes(trim($this->input->post('sex')));
        $check = $this->MemberModel->editMember($data,$memberID);
        if ($check == TRUE){
            echo 'Cập nhật thông tin thành công!';
        } else {
            echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
        }
    }

    public function editAdd(){
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $data['add'] = addslashes(trim($this->input->post('addr')));
        $check = $this->MemberModel->editMember($data,$memberID);
        if ($check == TRUE){
            echo 'Cập nhật thông tin thành công!';
        } else {
            echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
        }
    }
    
    public function editTel(){
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $tel = addslashes(trim($this->input->post('tel')));
        $rule = "/^[0]{1}[0-9]{7,10}+$/";
        if (!preg_match($rule, $tel)){
            echo 'errTel';
        }else{
            $data['tel'] = $tel;
            $check = $this->MemberModel->editMember($data,$memberID);
            if ($check == TRUE){
                echo 'Cập nhật thông tin thành công!';
            } else {
                echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
            }
        }
    }
    
    public function editEmail(){
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $email = addslashes(trim($this->input->post('email')));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo 'errEmail';
        }else{
            $check_email = $this->MemberModel->isEmailExistId($memberID,$email);
            if($check_email == FALSE){
                $data['email'] = $email;
                $check = $this->MemberModel->editMember($data,$memberID);
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
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $oldPass = addslashes($this->input->post('oldPass'));
        $newPass = addslashes($this->input->post('newPass'));
        $rePass = addslashes($this->input->post('rePass'));
        $check_oldPass = $this->MemberModel->getOldPass($memberID);
        if(md5($oldPass) == $check_oldPass[0]['pwd']){
            $rule = "/^[a-zA-Z0-9]+$/";
            if ((!preg_match($rule, $newPass))||(strlen($newPass) < 6)){
                echo 'errNewPass';
            }elseif($rePass === $newPass){
                $data['pwd'] = md5($newPass);
                $check = $this->MemberModel->editMember($data,$memberID);
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
    
    //Đăng ký
    public function regist(){
        $show = $this->myclass->session_member();
        $show['title'] = "BS - Đăng ký";
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = "Đăng ký";
        $show['content_main'] = "member/register";
        $show['data_content']['check'] = $this->check;
        $this->load->view("layout", $show);
    }
    
    public function registValidate() {

        $this->form_validation->set_rules('memberName', 'Tên đăng nhập', 'trim|required|min_length[4]|xss_clean|callback_memberName_check');
        $this->form_validation->set_rules('memberFullName', 'Họ tên', 'trim|required|xss_clean|callback_fullName_check');
        $this->form_validation->set_rules('memberSex', 'Giới tính', 'trim|required|xss_clean');
        $this->form_validation->set_rules('memberAdd', 'Địa chỉ', 'trim|required|xss_clean');
        $this->form_validation->set_rules('memberTel', 'Số điện thoại', 'trim|required|min_length[8]|max_length[11]|numeric|xss_clean|callback_tel_check');
        $this->form_validation->set_rules('memberEmail', 'Email', 'trim|required|valid_email|xss_clean|callback_memberEmail_check');
        $this->form_validation->set_rules('memberPass', 'Mật khẩu', 'trim|required|min_length[6]|xss_clean|callback_pass_check');
        $this->form_validation->set_rules('memberRePass', 'Nhập lại mật khẩu', 'trim|required|matches[memberPass]|xss_clean');

        //Kiểm tra tập luật
        if ($this->form_validation->run() == FALSE) {
            $this->regist();
        } else {
            $data['memberName'] = $this->input->post('memberName');
            $data['fullName'] = $this->input->post('memberFullName');
            $data['sex'] = $this->input->post('memberSex');
            $data['add'] = $this->input->post('memberAdd');
            $data['tel'] = $this->input->post('memberTel');
            $data['email'] = $this->input->post('memberEmail');
            $data['pwd'] = md5($this->input->post('memberPass'));
            $data['status'] = 1;

            $check = $this->MemberModel->addMember($data);
            if ($check == TRUE) {
                $this->check = TRUE;
                $member = $this->MemberModel->checkLogin($data['memberName'], $data['pwd']);
                $sess_array = array(
                    'id' => $member[0]['memberID'],
                    'name' => $member[0]['memberName']
                );
                $this->session->set_userdata('logged_in', $sess_array);
            } else {
                echo 'Không thể thực hiện đăng ký! Hãy kiểm tra lại!';
            }
            $this->regist();
        }
    }
    
    //Đăng nhập
    public function login() {
        $show = $this->myclass->session_member();
        $show['title'] = "BS - Đăng nhập";
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = "Đăng nhập";
        $show['content_main'] = "member/login";
        $show['data_content']['lock'] = $this->lock;
        $show['data_content']['unlock'] = $this->unlock;
        $this->load->view("layout", $show);
    }
    
    public function loginValidate() {
        $this->form_validation->set_rules('memberName', 'Tên đăng nhập', 'trim|required|xss_clean');
        $this->form_validation->set_rules('memberPass', 'Mật khẩu', 'trim|required|xss_clean|callback_login_check');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $inputName = $this->input->post('memberName');
            $inputPassword = md5($this->input->post('memberPass'));
            $remember = $this->input->post('remember');
            $member = $this->MemberModel->checkLogin($inputName, $inputPassword);
            if($member[0]['status'] == 0){
                $this->lock = TRUE;
                $this->login();
            } else{
                if ($remember == "on") {
                    $cookei = array(
                        'name' => 'rememberme',
                        'value' => $member[0]['memberID'],
                        'expire' => '86400'
                    );
                    set_cookie($cookei);
                }
                $sess_array = array(
                    'id' => $member[0]['memberID'],
                    'name' => $member[0]['memberName']
                );
                $this->session->set_userdata('logged_in', $sess_array);
                $this->unlock = TRUE;
                $this->login();
            }
        }
    }
    
    //Quên mật khẩu
    public function forgetPass(){
        $memberName = addslashes($this->input->post('nameFP'));
        $email = addslashes($this->input->post('emailFP'));
        $check_email = $this->MemberModel->isEmail($memberName,$email);
        if($check_email == TRUE){
            $memberID = $this->MemberModel->getIdByName($memberName);
            $repass['pwd'] = md5($memberName.'123');
            $check = $this->MemberModel->editMember($repass,$memberID[0]['memberID']);
            if ($check == TRUE){
                echo 'Mật khẩu mới của bạn là: '.$memberName.'123';
            } else {
                echo 'Có lỗi xảy ra! Liên hệ quản lý để được hỗ trợ';
            }
        } else {
            echo 'false';
        }
    }
        
    //Đăng xuất
    public function logout() {
        delete_cookie('rememberme');
        $this->session->unset_userdata('logged_in');
        redirect("Home/index", "refresh");
    }
    
    public function login_check($pass) {
        $name = $this->input->post('memberName');
        $password = md5($pass);
        $result = $this->MemberModel->checkLogin($name, $password);
        if (count($result) == 1) {
            return TRUE;
        } else {
            $this->form_validation->set_message('login_check', 'Tên đăng nhập hoặc mật khẩu không đúng');
            return FALSE;
        }
    }
    
    //Thiết lập lỗi tên đã tồn tại chưa
    public function memberName_check($str) {
        $rule = "/^[a-zA-Z0-9]+$/";
        if (!preg_match($rule, $str)){
            $this->form_validation->set_message('memberName_check', '%s chỉ bao gồm chữ cái không dấu và ký tự số!');
            return FALSE;
        }  elseif ($this->MemberModel->isNameExist($str) == TRUE) {
            $this->form_validation->set_message('memberName_check', '%s đã tồn tại');
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
    
    //Thiết lập lỗi email đã tồn tại chưa
    public function memberEmail_check($str) {
        if ($this->MemberModel->isEmailExist($str) == TRUE) {
            $this->form_validation->set_message('memberEmail_check', '%s đã tồn tại');
            return FALSE;
        } else {
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
}
