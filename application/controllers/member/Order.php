<?php
class Order extends CI_Controller{
    
    private $check = FALSE;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library(array('myclass', 'session', 'cart', 'form_validation'));
        $this->load->model(array('OrderModel','BookModel','MemberModel'));
    }
    
    public function confirm(){
        $show = $this->myclass->session_member();
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = "Xác nhận thông tin khách hàng";
        $show['title'] = "Xác nhận thông tin khách hàng";
        $show['content_main'] = "member/order";
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $show['data_content']['member'] = $this->MemberModel->getMemberById($memberID);
        $show['data_content']['orders'] = $this->cart->contents();
        $show['data_content']['check'] = $this->check;
        $this->load->view('layout', $show);
    }
    
    public function validate(){
        $this->form_validation->set_rules('receiverName', 'Họ tên người nhận', 'trim|required|xss_clean');
        $this->form_validation->set_rules('receiverAdd', 'Địa chỉ người nhận', 'trim|required|xss_clean');
        $this->form_validation->set_rules('receiverTel', 'Số điện thoại người nhận', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('requireTime', 'Thời gian giao hàng', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $this->confirm();
        } else {
            $session = $this->session->userdata('logged_in');
            $data['memberID'] = $session['id'];
            $data['name'] = addslashes($this->input->post('receiverName'));
            $data['receiverAdd'] = addslashes($this->input->post('receiverAdd'));
            $data['receiverTel'] = $this->input->post('receiverTel');
            //Thời gian gửi hóa đơn
            $datestr = "%y-%m-%d %h:%i:%s";
            $time = time();
            $data['orderDate'] = mdate($datestr, $time);
            //Thời gian giao hàng
            $data['requireDate'] = $this->input->post('requireTime');
            $data['status'] = "Chưa xử lý";
            
            $orderID = $this->OrderModel->addOrders($data);
            if ($orderID == 0) {
                echo "Không gửi được hóa đơn liên hệ cửa hàng để biết thêm thông tin";
            } else {
                //Lưu sản phẩm
                $cart = $this->cart->contents();
                foreach ($cart as $item) {
                    $ordersdetail['orderID'] = $orderID;
                    $ordersdetail['bookID'] = $item['id'];
                    $ordersdetail['quantity'] = $item['qty'];
                    $ordersdetail['price'] = $item['price'];
                    $checkOrder = $this->OrderModel->addOrderDetail($ordersdetail);
                    if ($checkOrder == FALSE) {
                        echo "Không gửi được hóa đơn liên hệ cửa hàng để biết thêm thông tin";
                        break;
                    }else{
                        $bookID = $item['id'];
                        $bookQty = $this->BookModel->getQuantity($bookID);
                        $max_qty = $bookQty[0]['bookQuantity'];
                        $dataBook['bookQuantity'] = $max_qty - $item['qty'];
                        $this->BookModel->editBook($dataBook,$bookID);
                    }
                }
                
                $this->cart->destroy();
                $this->check = TRUE;
                $this->confirm();
            }
        }
    }
}
