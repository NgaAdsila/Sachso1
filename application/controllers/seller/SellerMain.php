<?php
class SellerMain extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','text'));
        $this->load->library('myclass');
        $this->load->model(array('BookModel','OrderModel'));
    }

    public function home() {
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Trang chủ";
        $show['manager_content'] = "seller/home";

        //lấy sách mới
        $book = $this->BookModel->getNewBook(6);
        $show['data_content']['book'] = $book;

        //lấy đơn hàng mới
        $order = $this->OrderModel->getNewOrder();
        $show['data_content']['order'] = $order;
        
        //Lấy nhân viên giao hàng
        foreach ($order as $order_data) {
            if ($order_data['staffID'] != 0) {
                $ship = $this->OrderModel->getShipper($order_data['orderID']);
                $shipper[$order_data['orderID']] = $ship[0]['fullName'];
            } else {
                $shipper[$order_data['orderID']] = '';
            }
        }
        $show['data_content']['shipper'] = $shipper;
        $this->load->view('manager/layout', $show);
    }

    public function introduce(){
        $show = $this->myclass->seller_default();
        $show['title'] = 'Seller - Giới thiệu';
        $show['manager_content'] = "seller/introduction";
        $this->load->view('manager/layout', $show);
    }
    
    public function deleteBook() {
        $bookID = $this->uri->segment(4);
        $check = $this->BookModel->delBook($bookID);
        if($check == TRUE){
            redirect('seller/SellerMain/home', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }

    public function deleteOrder() {
        $orderID = $this->uri->segment(4);
        $check = $this->OrderModel->delOrder($orderID);
        if($check == TRUE){
            redirect('seller/SellerMain/home', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }
    
}
