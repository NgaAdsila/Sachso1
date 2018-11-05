<?php
class Book extends CI_Controller{
    
    private $check = FALSE;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'text'));
        $this->load->library(array('myclass', 'form_validation', 'upload', 'pagination'));
        $this->load->model(array('BookModel','TypeModel'));
    }
    
    //Danh sách sách
    public function viewListBook(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Danh sách sách";
        $show['manager_content'] = "seller/bookList";
        
        //Tổng số sách
        if($this->input->get('kw')){
            $kw = trim($this->input->get('kw'));
            $keyWord = htmlspecialchars(addslashes($kw), ENT_QUOTES);
            $total_book = $this->BookModel->totalSearchBook(str_replace('-', '', $keyWord));
        } elseif ($this->input->get('kt')) {
            $kt = trim($this->input->get('kt'));
            $total_book = $this->BookModel->getTotalTypeBook($kt);
        } else { 
            $total_book = $this->BookModel->getTotalBook();
        }
        //Số sách trên 1 trang
        $per_page = 10;
        
        //Phân trang
        $config['total_rows'] = $total_book;
        $config['per_page'] = $per_page;
        if($this->input->get('kw')||$this->input->get('kt')||$this->input->get('sort')){
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $config['base_url'] = site_url().'seller/Book/viewListBook';
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET, '', "&");
        } else {
            $config['base_url'] = site_url().'seller/Book/viewListBook';
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
        
        //Lấy sách
        if($this->input->get('kw')){
            $book = $this->BookModel->searchBookSel(str_replace('-', '', $keyWord),$per_page,$offset);
        } elseif ($this->input->get('kt')) {
            $book = $this->BookModel->getTypeBook($kt,$per_page,$offset);
        } elseif ($this->input->get('sort')) {
            $sort = $this->input->get('sort');
            switch ($sort) {
                case 'ascname': $book = $this->BookModel->getListBookSortAsc('bookName',$per_page,$offset);
                    break;
                case 'descname': $book = $this->BookModel->getListBookSortDesc('bookName',$per_page,$offset);
                    break;
                case 'ascaut': $book = $this->BookModel->getListBookSortAsc('author',$per_page,$offset);
                    break;
                case 'descaut': $book = $this->BookModel->getListBookSortDesc('author',$per_page,$offset);
                    break;
                case 'ascpub': $book = $this->BookModel->getListBookSortAsc('publisher',$per_page,$offset);
                    break;
                case 'descpub': $book = $this->BookModel->getListBookSortDesc('publisher',$per_page,$offset);
                    break;
                case 'ascypub': $book = $this->BookModel->getListBookSortAsc('yearOfPublication',$per_page,$offset);
                    break;
                case 'descypub': $book = $this->BookModel->getListBookSortDesc('yearOfPublication',$per_page,$offset);
                    break;
                case 'ascprice': $book = $this->BookModel->getListBookSortAsc('bookPrice',$per_page,$offset);
                    break;
                case 'descprice': $book = $this->BookModel->getListBookSortDesc('bookPrice',$per_page,$offset);
                    break;
                case 'ascqty': $book = $this->BookModel->getListBookSortAsc('bookQuantity',$per_page,$offset);
                    break;
                case 'descqty': $book = $this->BookModel->getListBookSortDesc('bookQuantity',$per_page,$offset);
                    break;
            }
        } else {
            $book = $this->BookModel->getListBook($per_page, $offset);
        }
        $show['data_content']['book'] = $book;
        $show['data_content']['type'] = $this->TypeModel->getListType();
        $show['data_content']['per_page'] = $offset+1;
        $show['data_content']['pagination'] = $pagination;
        $this->load->view('manager/layout',$show);
    }

    //Thêm sách
    public function addBook() {
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Thêm sách";
        $show['manager_content'] = "seller/addBook";
        
        //Lấy danh mục
        $type = $this->TypeModel->getListType();
        $show['data_content']['type'] = $type;
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout', $show);
    }

    public function validateAdd() {
        //Thiết lập luật
        $this->form_validation->set_rules('bookID', 'Mã ISBN', 'trim|required|min_length[10]|max_length[13]|xss_clean|callback_bookID_check');
        $this->form_validation->set_rules('bookName', 'Tên sách', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookAuthor', 'Tác giả', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookContent', 'Tóm tắt', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookPublisher', 'Nhà xuất bản', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookYearOfPub', 'Năm xuất bản', 'trim|required|max_length[4]|numeric|xss_clean');
        $this->form_validation->set_rules('bookType', 'Thể loại', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookPrice', 'Giá sách', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('bookQuantity', 'Số lượng', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('bookImg', 'Hình ảnh', 'trim|xss_clean');
        //Kiểm tra tập luật
        if ($this->form_validation->run() == FALSE) {
            $this->addBook();
        } else {
            $data['bookID'] = $this->input->post('bookID');
            $data['bookName'] = addslashes($this->input->post('bookName'));
            $data['author'] = addslashes($this->input->post('bookAuthor'));
            $data['bookContent'] = addslashes($this->input->post('bookContent'));
            $data['publisher'] = addslashes($this->input->post('bookPublisher'));
            $data['yearOfPublication'] = $this->input->post('bookYearOfPub');
            $data['typeID'] = $this->input->post('bookType');
            $data['bookPrice'] = $this->input->post('bookPrice');
            $data['bookQuantity'] = $this->input->post('bookQuantity');
            $urlAdd = $this->do_upload();
            if ($urlAdd != ''){
                $data['bookImg'] = $urlAdd;
            }
            $check = $this->BookModel->addBook($data);
            if ($check == TRUE) {
                $this->check = TRUE;
            } else {
                echo 'Không thể thêm sách! Hãy kiểm tra lại!';
            }
            $this->addBook();
        }
    }

    //Sửa thông tin sách
    public function editBook(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Sửa thông tin sách";
        $show['manager_content'] = "seller/editBook";
        //Lấy thông tin sách
        $bookID = $this->uri->segment(4);
        $book = $this->BookModel->getBookById($bookID);
        $show['data_content']['book'] = $book;
        //Lấy danh mục
        $type = $this->TypeModel->getListType();
        $show['data_content']['type'] = $type;
        $show['data_content']['check'] = $this->check;
        $this->load->view('manager/layout', $show);
    }

    public function validateEdit(){
        //Thiết lập luật
        $this->form_validation->set_rules('bookID', 'Mã ISBN', 'trim|xss_clean');
        $this->form_validation->set_rules('bookName', 'Tên sách', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookAuthor', 'Tác giả', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookContent', 'Tóm tắt', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookPublisher', 'Nhà xuất bản', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookYearOfPub', 'Năm xuất bản', 'trim|required|max_length[4]|numeric|xss_clean');
        $this->form_validation->set_rules('bookType', 'Thể loại', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bookPrice', 'Giá sách', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('bookQuantity', 'Số lượng', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('bookNewImg', 'Hình ảnh mới', 'trim|xss_clean');
        //Kiểm tra tập luật
        if ($this->form_validation->run() == FALSE) {
            $this->editBook();
        } else {
            $bookID = $this->uri->segment(4);
            $data['bookName'] = addslashes($this->input->post('bookName'));
            $data['author'] = addslashes($this->input->post('bookAuthor'));
            $data['bookContent'] = addslashes($this->input->post('bookContent'));
            $data['publisher'] = addslashes($this->input->post('bookPublisher'));
            $data['yearOfPublication'] = $this->input->post('bookYearOfPub');
            $data['typeID'] = $this->input->post('bookType');
            $data['bookPrice'] = $this->input->post('bookPrice');
            $data['bookQuantity'] = $this->input->post('bookQuantity');
            $urlEdit = $this->do_upload();
            if ($urlEdit != ''){
                $data['bookImg'] = $urlEdit;
            }
            $check = $this->BookModel->editBook($data,$bookID);
            if ($check == TRUE) {
                $this->check = TRUE;
            } else {
                echo 'Không thể sửa thông tin sách! Hãy kiểm tra lại!';
            }
            $this->editBook();
        }
    }

    //upload ảnh
    private function do_upload(){
        $type = explode('.', $_FILES['bookImg']['name']);
        $type = $type[count($type)-1];
        $url = 'bookImg/'.time().'.'.$type;
        if (in_array($type, array('jpg', 'jpeg', 'gif', 'png'))) {
            if (is_uploaded_file($_FILES['bookImg']['tmp_name'])) {
                if (move_uploaded_file($_FILES['bookImg']['tmp_name'], './'.$url)) {
                    return site_url().$url;
                }
            }
        }
        return '';
    }

    //Thiết lập lỗi mã ISBN đã tồn tại chưa
    public function bookID_check($str) {
        if ($this->BookModel->isIDExist($str) == TRUE) {
            $this->form_validation->set_message('bookID_check', '%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    // Xóa sách
    public function deleteBook() {
        $bookID = $this->uri->segment(4);
        $check = $this->BookModel->delBook($bookID);
        if($check == TRUE){
            redirect('seller/Book/viewListBook', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }
}
