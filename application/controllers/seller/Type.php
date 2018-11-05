<?php
class Type extends CI_Controller{
    private $check = FALSE;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation', 'myclass'));
        $this->load->model('TypeModel');
    }
    //Danh sách danh mục
    public function viewListType(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Danh sách danh mục";
        $show['manager_content'] = "seller/typeList";
        
        //Lấy danh mục
        $type = $this->TypeModel->getListType();
        $show['data_content']['type'] = $type;
        $this->load->view('manager/layout',$show);
    }
    //Thêm danh mục
    public function addType(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Type - Thêm danh mục";
        $show['manager_content'] = "seller/addType";
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout', $show);
    }
    
    public function validateAdd() {

        //thiết lập tập luật
        $this->form_validation->set_rules('typeName', 'Tên danh mục', 'trim|required|xss_clean|callback_typeName_check');
        $this->form_validation->set_rules('typeInfo', 'Mô tả', 'trim|required|xss_clean');

        //Kiểm tra tập luật
        if ($this->form_validation->run() == FALSE) {
            $this->addType();
        } else {
            $data['typeName'] = addslashes($this->input->post('typeName'));
            $data['typeInfo'] = addslashes($this->input->post('typeInfo'));

            $check = $this->TypeModel->addType($data);
            if ($check == TRUE) {
                $this->check = TRUE;
            } else {
                echo 'Không thể thêm nhân viên! Hãy kiểm tra lại!';
            }
            $this->addType();
        }
    }
    //Sửa danh mục
    public function editType(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Sửa thông tin danh mục";
        $show['manager_content'] = "seller/editType";
        //Lấy thông tin danh mục
        $typeID = $this->uri->segment(4);
        $type = $this->TypeModel->getTypeById($typeID);
        $show['data_content']['type'] = $type;
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout', $show);
    }
    
    public function validateEdit() {
        //thiết lập tập luật
        $this->form_validation->set_rules('typeName', 'Tên danh mục', 'trim|required|xss_clean|callback_newName_check');
        $this->form_validation->set_rules('typeInfo', 'Mô tả', 'trim|required|xss_clean');

        //Kiểm tra tập luật
        if ($this->form_validation->run() == FALSE) {
            $this->editType();
        } else {
            $typeID = $this->input->post('typeID');
            
            $data['typeName'] = addslashes($this->input->post('typeName'));
            $data['typeInfo'] = addslashes($this->input->post('typeInfo'));
            $check = $this->TypeModel->editType($data,$typeID);
            if ($check == TRUE) {
                $this->check = TRUE;
                $this->editType();
            } else {
                echo 'Không thể thêm nhân viên! Hãy kiểm tra lại!';
            }
        }
    }
    
    //Kiểm tra tên danh mục
    public function typeName_check($str){
        if ($this->TypeModel->isNameExist($str) == TRUE) {
            $this->form_validation->set_message('typeName_check','%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    //Kiểm tra tên danh mục
    public function newName_check($str){
        $typeID = $this->uri->segment(4);
        if ($this->TypeModel->isNewNameExist($typeID,$str) == TRUE) {
            $this->form_validation->set_message('newName_check','%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    //Xóa danh mục
    public function deleteType() {
        $typeID = $this->uri->segment(4);
        $check = $this->TypeModel->delType($typeID);
        if($check == TRUE){
            redirect('seller/Type/viewListType', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }
}
