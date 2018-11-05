<?php
class Feedback extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','text'));
        $this->load->library(array('myclass','pagination'));
        $this->load->model(array('FeedbackModel','MemberModel'));
    }
    
    public function viewListFB(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Danh sách ý kiến phản hồi";
        $show['manager_content'] = "seller/feedbackList";
        
        //Lấy tổng số phản hồi
        if($this->input->get('kw')){
            $kw = $this->input->get('kw');
            $id_mem = $this->MemberModel->searchIDMember($kw);
            $i = 0;
            $id_search = array();
            if(!empty($id_mem)){
                foreach ($id_mem as $data) {
                    $id_search[$i++] = $data['memberID'];
                }
            }
            if(!empty($id_search)){
                $total_FBs = $this->FeedbackModel->getTotalFbMember($id_search);
            }  else {
                $total_FBs = 0;
            }
        }elseif ($this->input->get('kt')){
            $kt = $this->input->get('kt');
            if($kt === 'Chưa đánh giá'){
                $kt = '';
            }
            $total_FBs = $this->FeedbackModel->getTotalFbStt($kt);
        } else {
            $total_FBs = $this->FeedbackModel->getTotalFBs();
        }
        //Số phản hồi trên 1 trang
        $per_page = 10;
        
        //Phân trang
        $config['total_rows'] = $total_FBs;
        $config['per_page'] = $per_page;
        $config['base_url'] = site_url().'seller/Feedback/viewListFB';
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
        
        //Lấy phản hồi
        if($this->input->get('kw')){
            if(!empty($id_search)){
                $fb = $this->FeedbackModel->getListFbMember($id_search,$per_page,$offset);
            }  else {
                $fb = array();
            }
        } elseif ($this->input->get('kt')) {
            $fb = $this->FeedbackModel->getListFbStt($kt,$per_page,$offset);
        }else {
            $fb = $this->FeedbackModel->getListFB($per_page,$offset);
        }
        $show['data_content']['feedback'] = $fb;
        $show['data_content']['pagination'] = $pagination;
        $this->load->view('manager/layout',$show);
    }
    
    public function updateRatings(){
        $feebackID = $this->input->post('feedbackID');
        $data['ratings'] = $this->input->post('ratings');
        $check = $this->FeedbackModel->update($data, $feebackID);
        if ($check == TRUE) {
            $this->check = TRUE;
            $this->viewListFB();
        } else {
            echo "Không thể cập nhật thành công liên hệ nhân viên ký thuật để biết thêm thông tin";
        }
    }
}
