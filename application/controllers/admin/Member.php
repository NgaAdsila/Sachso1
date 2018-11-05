<?php
class Member extends CI_Controller{
    
    private $check = FALSE;
            
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation','myclass','pagination'));
        $this->load->model('MemberModel');
    }
    
    //Danh sách thành viên
    public function viewListMember(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Danh sách thành viên";
        $show['manager_content'] = "admin/memberList";
        //Tổng số thành viên
        if($this->input->get('kw')){
            $kw = trim($this->input->get('kw'));
            $keyWord = htmlspecialchars(addslashes($kw), ENT_QUOTES);
            $total_member = $this->MemberModel->getTotalMemberByName(str_replace('-', '', $keyWord));
        } elseif ($this->input->get('kfn')) {
            $kfn = trim($this->input->get('kfn'));
            $keyWord = htmlspecialchars(addslashes($kfn), ENT_QUOTES);
            $total_member = $this->MemberModel->totalSearchMember(str_replace('-', '', $keyWord));
        } elseif ($this->input->get('kt')) {
            $kt = trim($this->input->get('kt'));
            if ($kt == 2){
                $kt = 0;
            }
            $total_member = $this->MemberModel->getTotalMemberByStt($kt);
        } else { 
            $total_member = $this->MemberModel->getTotalMember();
        }
        //Số thành viên trên 1 trang
        $per_page = 10;
        //Phân trang
        $config['total_rows'] = $total_member;
        $config['per_page'] = $per_page;
        if($this->input->get('kw')||$this->input->get('kfn')||$this->input->get('kt')){
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $config['base_url'] = site_url().'admin/Member/viewListMember';
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET, '', "&");
        } else {
            $config['base_url'] = site_url().'admin/Member/viewListMember';
        }
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
        
        //Lấy thành viên
        if($this->input->get('kw')){
            $member = $this->MemberModel->getListMemberName(str_replace('-', '', $keyWord),$per_page,$offset);
        } elseif ($this->input->get('kfn')) {
            $member = $this->MemberModel->searchMember(str_replace('-', '', $keyWord),$per_page,$offset);
        } elseif ($this->input->get('kt')) {
            $member = $this->MemberModel->getListMemberStt($kt,$per_page,$offset);
        } else {
            $member = $this->MemberModel->getListMember($per_page, $offset);
        }
        $show['data_content']['member'] = $member;
        $show['data_content']['per_page'] = $offset+1;
        $show['data_content']['pagination'] = $pagination;
        $this->load->view('manager/layout',$show);
    }
    
    //Thêm thành viên
    public function addMember(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Thêm thành viên";
        $show['manager_content'] = "admin/addMember";
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout', $show);
    }
    
    public function validateAdd() {

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
            $this->addMember();
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
            } else {
                echo 'Không thể thêm thành viên! Hãy kiểm tra lại!';
            }
            $this->addMember();
        }
    }
    
    //Sửa thông tin thành viên
//    public function editMember(){
//        $show = $this->myclass->admin_default();
//        $show['title'] = "Admin - Sửa thông tin thành viên";
//        $show['manager_content'] = "admin/editMember";
//        //Lấy thông tin thành viên
//        $memberID = $this->uri->segment(4);
//        $member = $this->MemberModel->getMemberById($memberID);
//        $show['data_content']['member'] = $member;
//        $show['data_content']['check'] = $this->check;
//        $this->load->view('manager/layout', $show);
//    }
//
//    public function validateEdit() {
//        //thiết lập tập luật
//        $this->form_validation->set_rules('memberName', 'Tên đăng nhập', 'trim|xss_clean');
//        $this->form_validation->set_rules('memberFullName', 'Họ tên', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('memberSex', 'Giới tính', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('memberAdd', 'Địa chỉ', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('memberTel', 'Số điện thoại', 'trim|required|min_length[8]|max_length[11]|numeric|xss_clean|callback_tel_check');
//        $this->form_validation->set_rules('memberEmail', 'Email', 'trim|required|valid_email|xss_clean');
//        $this->form_validation->set_rules('memberOldPass', 'Mật khẩu cũ', 'trim|required|min_length[6]|xss_clean|callback_oldPass_check');
//        $this->form_validation->set_rules('memberNewPass', 'Mật khẩu mới', 'trim|min_length[6]|xss_clean');
//
//        //Kiểm tra tập luật
//        if ($this->form_validation->run() == FALSE) {
//            $this->editMember();
//        } else {
//            $memberID = $this->uri->segment(4);
//            
//            $data['fullName'] = addslashes($this->input->post('memberFullName'));
//            $data['sex'] = $this->input->post('memberSex');
//            $data['add'] = addslashes($this->input->post('memberAdd'));
//            $data['tel'] = $this->input->post('memberTel');
//            $data['email'] = addslashes($this->input->post('memberEmail'));
//            if ($this->input->post('memberNewPass') != ''){
//                $data['pwd'] = md5($this->input->post('memberNewPass'));
//            }
//            $check = $this->MemberModel->editMember($data,$memberID);
//            if ($check == TRUE) {
//                $this->check = TRUE;
//                $this->editMember();
//            } else {
//                echo 'Không thể thêm thành viên! Hãy kiểm tra lại!';
//            }
//        }
//    }
    
    //Khóa-mở khóa thành viên
    public function lockMember(){
        $show = $this->myclass->admin_default();
        $show['title'] = "Admin - Khóa/mở khóa thành viên";
        $show['manager_content'] = "admin/memberLock";
        
        //Tổng số thành viên
        if($this->input->get('kw')){
            $kw = trim($this->input->get('kw'));
            $keyWord = htmlspecialchars(addslashes($kw), ENT_QUOTES);
            $total_member = $this->MemberModel->getTotalMemberByName(str_replace('-', '', $keyWord));
        } elseif ($this->input->get('kfn')) {
            $kfn = trim($this->input->get('kfn'));
            $keyWord = htmlspecialchars(addslashes($kfn), ENT_QUOTES);
            $total_member = $this->MemberModel->totalSearchMember(str_replace('-', '', $keyWord));
        } elseif ($this->input->get('kt')) {
            $kt = trim($this->input->get('kt'));
            if ($kt == 2){
                $kt = 0;
            }
            $total_member = $this->MemberModel->getTotalMemberByStt($kt);
        } else { 
            $total_member = $this->MemberModel->getTotalMember();
        }
        //Số thành viên trên 1 trang
        $per_page = 10;
        
        //Phân trang
        $config['total_rows'] = $total_member;
        $config['per_page'] = $per_page;
        if($this->input->get('kw')||$this->input->get('kfn')||$this->input->get('kt')){
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url'] = site_url().'admin/Member/lockMember';
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET, '', "&");
        } else {
        $config['base_url'] = site_url().'admin/Member/lockMember';
        }
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
        
        //Lấy thành viên
        if($this->input->get('kw')){
            $member = $this->MemberModel->getListMemberName(str_replace('-', '', $keyWord),$per_page,$offset);
        } elseif ($this->input->get('kfn')) {
            $member = $this->MemberModel->searchMember(str_replace('-', '', $keyWord),$per_page,$offset);
        } elseif ($this->input->get('kt')) {
            $member = $this->MemberModel->getListMemberStt($kt,$per_page,$offset);
        } else {
            $member = $this->MemberModel->getListMember($per_page, $offset);
        }
        
        $show['data_content']['member'] = $member;
        $show['data_content']['per_page'] = $offset+1;
        $show['data_content']['pagination'] = $pagination;
        
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout',$show);
    }

    public function validateLock(){
        $this->form_validation->set_rules('memberStatus', 'Trạng thái mới', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->lockMember();
        } else {
            $memberID = $this->input->post('memberID');
            $data['status'] = $this->input->post('memberStatus');

            $this->check = $this->MemberModel->editMember($data,$memberID);
            $this->lockMember();
        }
    }

    //Kiểm tra mật khẩu cũ
    public function oldPass_check($str){
        $memberID = $this->uri->segment(4);
        $pwd = $this->MemberModel->getOldPass($memberID);
        if (md5($str) == $pwd[0]['pwd']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('oldPass_check','%s không đúng');
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
    public function memberEmail_check($str) {
        if ($this->MemberModel->isEmailExist($str) == TRUE) {
            $this->form_validation->set_message('memberEmail_check', '%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Xóa thành viên
    public function deleteMember() {
        $memberID = $this->uri->segment(4);
        $check = $this->MemberModel->delMember($memberID);
        if($check == TRUE){
            redirect('admin/MemberList/index', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }
}
