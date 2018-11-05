<?php
class Search extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array("url", "cookie"));
        $this->load->library(array('pagination','myclass'));
        $this->load->model(array('BookModel','TypeModel'));
    }
    
    public function index(){
        $show = $this->myclass->session_member();
        $kw = trim($this->input->get('kw'));
        $keyWord = htmlspecialchars(addslashes($kw), ENT_QUOTES);
        $show['title'] = 'BS - Kết quả tìm kiếm';
        
        //nav-bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = strip_slashes($keyWord);
        
        $show['content_main'] = "member/searchKey";
        
        //Tổng số sách
        $total_book = $this->BookModel->totalSearchBook(str_replace('-', '', $keyWord));
        //Số sách trên 1 trang
        $per_page = 12;
        //Phân trang
        $config['total_rows'] = $total_book;
        $config['per_page'] = $per_page;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url'] = site_url().'member/Search/index';
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET, '', "&");
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
        if($this->input->get('sort')){
            $sort = $this->input->get('sort');
            $books = $this->BookModel->searchBookSort(str_replace('-', '', $keyWord),$sort,$per_page,$offset);
        } else {
            $books = $this->BookModel->searchBook(str_replace('-', '', $keyWord),$per_page,$offset);
        }
        $show['data_content']['books'] = $books;
        $show['data_content']['link'] = 'index?kw='.$kw;
        $show['data_content']['pagination'] = $pagination;
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout', $show);
    }
    
    public function link(){
        $show = $this->myclass->session_member();
        $show['title'] = 'BS - Kết quả tìm kiếm';
        $show['content_main'] = "member/searchKey";
       
        //Số sách trên 1 trang
        $per_page = 12;
        
        //Lấy offset
        $offset = ($this->uri->segment(4) == '') ? 0 : $this->uri->segment(4);
        $link = "link?";
        //Tìm theo giá
        if ($this->input->get('p')){
            $kw = $this->input->get('p');
            $val = explode("-", $kw);
            $val[0] = (double) $val[0];
            $val[1] = (double) $val[1];
            $typeID = $this->input->get('typeID');
            $link = $link.'p='.$kw.'&typeID='.$typeID;
            $type = $this->TypeModel->getTypeById($typeID);
            $bar_name = 'Sách "'.$type[0]['typeName'].'" có giá ';
            if($val[0] == 0){
                $bar_name .= ' dưới $'.$val[1].'.00';
                $total_book = $this->BookModel->totalSearchLess('bookPrice',$val[1],$typeID);
                if($this->input->get('sort')){
                    $sort = $this->input->get('sort');
                    $books = $this->BookModel->searchLessSort('bookPrice',$val[1],$typeID,$sort,$per_page,$offset);
                } else {
                    $books = $this->BookModel->searchLess('bookPrice',$val[1],$typeID,$per_page,$offset);
                }
            } elseif ($val[1]!=0) {
                $bar_name .= ' từ $'.$val[0].'.00 đến $'.$val[1].'.00';
                $total_book = $this->BookModel->totalSearchRange('bookPrice',$val[0],$val[1],$typeID);
                if($this->input->get('sort')){
                    $sort = $this->input->get('sort');
                    $books = $this->BookModel->searchRangeSort('bookPrice',$val[0],$val[1],$typeID,$sort,$per_page,$offset);
                } else {
                    $books = $this->BookModel->searchRange('bookPrice',$val[0],$val[1],$typeID,$per_page,$offset);
                }
            } else {
                $bar_name .= ' trên $'.$val[0].'.00';
                $total_book = $this->BookModel->totalSearchMore('bookPrice',$val[0],$typeID);
                if($this->input->get('sort')){
                    $sort = $this->input->get('sort');
                    $books = $this->BookModel->searchMoreSort('bookPrice',$val[0],$typeID,$sort,$per_page,$offset);
                } else {
                    $books = $this->BookModel->searchMore('bookPrice',$val[0],$typeID,$per_page,$offset);
                }
            }
        }
        
        //Tìm theo năm sản xuất
        if ($this->input->get('y')){
            $kw = $this->input->get('y');
            $val = explode("-", $kw);
            $val[0] = (double) $val[0];
            $val[1] = (double) $val[1];
            $typeID = $this->input->get('typeID');
            $link = $link.'y='.$kw.'&typeID='.$typeID;
            $type = $this->TypeModel->getTypeById($typeID);
            $bar_name = 'Sách "'.$type[0]['typeName'].'" sản xuất ';
            if($val[0] == 0){
                $bar_name .= ' trước năm '.$val[1];
                $total_book = $this->BookModel->totalSearchLess('yearOfPublication',$val[1],$typeID);
                if($this->input->get('sort')){
                    $sort = $this->input->get('sort');
                    $books = $this->BookModel->searchLessSort('yearOfPublication',$val[1],$typeID,$sort,$per_page,$offset);
                } else {
                    $books = $this->BookModel->searchLess('yearOfPublication',$val[1],$typeID,$per_page,$offset);
                }
            } elseif ($val[1]!=0) {
                $bar_name .= ' từ năm '.$val[0].' đến năm '.$val[1];
                $total_book = $this->BookModel->totalSearchRange('yearOfPublication',$val[0],$val[1],$typeID);
                if($this->input->get('sort')){
                    $sort = $this->input->get('sort');
                    $books = $this->BookModel->searchRangeSort('yearOfPublication',$val[0],$val[1],$typeID,$sort,$per_page,$offset);
                } else {
                    $books = $this->BookModel->searchRange('yearOfPublication',$val[0],$val[1],$typeID,$per_page,$offset);
                }
            } else {
                $bar_name .= ' từ năm '.$val[0].' đến nay';
                $total_book = $this->BookModel->totalSearchMore('yearOfPublication',$val[0],$typeID);
                if($this->input->get('sort')){
                    $sort = $this->input->get('sort');
                    $books = $this->BookModel->searchMoreSort('yearOfPublication',$val[0],$typeID,$sort,$per_page,$offset);
                } else {
                    $books = $this->BookModel->searchMore('yearOfPublication',$val[0],$typeID,$per_page,$offset);
                }
            }
        }
        
        //Tìm theo nhà sản xuất
//        if ($this->input->get('pub')){
//            $bar_name = 'Tìm kiếm theo nhà sản xuất';
//            $pub = addslashes($this->input->get('pub'));            
//            $total_book = $this->BookModel->totalSearchPub($pub);
//            $books = $this->BookModel->searchPub($pub,$per_page,$offset);
//        }
        
        //nav-bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = $bar_name; 
        
        //Phân trang
        $config['total_rows'] = $total_book;
        $config['per_page'] = $per_page;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url'] = site_url().'member/Search/link';
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET, '', "&");
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
        
        $show['data_content']['books'] = $books;
        $show['data_content']['link'] = $link;
        $show['data_content']['pagination'] = $pagination;
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout', $show);
    }
}
