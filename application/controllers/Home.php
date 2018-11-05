<?php
class Home extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','date'));
        $this->load->library(array('session','myclass','pagination'));
        $this->load->model(array('BookModel','TypeModel','RatingModel','FeedbackModel'));
    }
    
    public function index(){
        $show = $this->myclass->session_member();
        $show['title'] = 'BS - Trang chủ';
        
        //banner
        $show['banner_main'] = 'member/banner';
        $type = $this->TypeModel->getListType();
        $show['data_banner']['type'] = $type;
        
        //content_main
        $show['content_main'] = "member/content_main";
        //$rateAVG = $this->RatingModel->getRateByBook();
        $show['data_content']['topBook'] = $this->RatingModel->getTopRateofBook(10);//top đánh giá
        $newBook = $this->BookModel->getNewBook(10);
        $show['data_content']['newBook'] = $this->addRateToBook($newBook);// sách mới
        $hotsel = $this->BookModel->getHotSelBook(10);
        $show['data_content']['sellBook'] = $this->addRateToBook($hotsel);// sách được mua nhiều
        if ($this->session->userdata('logged_in')){
            $session = $this->session->userdata('logged_in');
            $memberID = $session['id'];
            $listBook = $this->RatingModel->getBookIsRatedByMember($memberID);
            if (!empty($listBook)){
                $idBook = array();$i = 0;
                foreach ($listBook as $data) {
                    $idBook[$i++] = $data['bookID'];
                }
                $book = $this->BookModel->getBookByListId($idBook);
                $show['data_content']['listBookRated'] = $this->addRateToBook($book);// sách từng được đánh giá
            } else {
                $show['data_content']['listBookRated'] = array();
            }
        }
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout',$show);
    }
    
    //Lấy danh sách sách theo danh mục
    public function typeBook(){
        $show = $this->myclass->session_member(); 
        $typeID = $this->uri->segment(3);
        $type = $this->TypeModel->getTypeById($typeID);
        
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = 'Danh mục: '.$type[0]['typeName'];
        
        //Lấy tên danh mục
        $show['title'] = 'BS - '.$type[0]['typeName'];
        $show['data_content']['typeName'] = $type[0]['typeName'];
        
        //Lấy intro danh mục
        $show['data_content']['typeInfo'] = $type[0]['typeInfo'];
        
        //Tổng số sách
        $total_book = $this->BookModel->getTotalTypeBook($typeID);
        //Số sách trên 1 trang
        $per_page = 8;
        //Phân trang
        $config['total_rows'] = $total_book;
        $config['per_page'] = $per_page;
        $config['base_url'] = site_url().'Home/typeBook/'.$typeID;
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
        
        //Lấy sách
        $typeBook = $this->RatingModel->getRateofTypeBook($typeID,$per_page,$offset);
        $show['data_content']['typeBook'] = $typeBook;
        $show['data_content']['topTypeBook'] = $this->RatingModel->getRateTopTypeBook($typeID,10);
        $newTypeBook = $this->BookModel->getNewType($typeID,10);
        $show['data_content']['newTypeBook'] = $this->addRateToBook($newTypeBook);// sách mới
        $show['content_main'] = "member/type_book";
        $show['data_content']['pagination'] = $pagination;
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout', $show);
    }

    public function addRateToBook($listBook){
        $rateAVG = $this->RatingModel->getRateByBook();
        for ($i=0;$i<count($listBook);$i++){
            $listBook[$i]['rate_avg'] = 0;
            $listBook[$i]['rate_num'] = 0;
            foreach ($rateAVG as $rateAVG_data) {
                if ($listBook[$i]['bookID'] === $rateAVG_data['bookID']){
                    $listBook[$i]['rate_avg'] = $rateAVG_data['rate_avg'];
                    $listBook[$i]['rate_num'] = $rateAVG_data['rate_num'];
                    break;
                }
            }
        }
        return $listBook;
    }

    public function introduce(){
        $show = $this->myclass->session_member();
        $show['title'] = 'BS - Giới thiệu';
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = 'Giới thiệu';
        $show['content_main'] = "member/introduction";
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout', $show);
    }
    
    public function security(){
        $show = $this->myclass->session_member();
        $show['title'] = 'BS - Chính sách bảo mật';
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = 'Chính sách bảo mật';
        $show['content_main'] = "member/security";
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout', $show);
    }
    
    public function guide(){
        $show = $this->myclass->session_member();
        $show['title'] = 'BS - Điều khoản sử dụng';
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = 'Điều khoản sử dụng';
        $show['content_main'] = "member/guide";
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout', $show);
    }

    public function sendFB(){
        $session = $this->session->userdata('logged_in');
        $data['memberID'] = $session['id'];
        $data['feedbackContent'] = addslashes($this->input->post('feedbackContent'));
        //Thời gian gửi FB
        $time = time();
        $datestr = "%y-%m-%d %h:%i:%s";
        $data['sendDate'] = mdate($datestr, $time);
        $data['ratings'] = "";
        $check = $this->FeedbackModel->addFeedback($data);
        if ($check == TRUE){
            echo "Gửi thông tin phản hồi thành công! Cảm ơn bạn vì những đóng góp này!";
        }else{
            echo "Không thể gửi thông tin phản hồi!";
        }
    }
    
}
