<?php
class Cart extends CI_Controller{
    
    private $checkAdd = FALSE;
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('cart','myclass'));
        $this->load->model('BookModel');
    }
    
    public function add() {
        $book_id = $this->uri->segment(4);
        $book = $this->BookModel->getBookById($book_id);
        $cart = $this->cart->contents();
        $qty = $this->input->post('quantity');
        foreach ($cart as $item) {
            if ($item['id'] == $book[0]['bookID']) {
                $qty = $item['qty'] + 1;
            }
        }

        $data = array(
            'id' => $book[0]['bookID'],
            'qty' => $qty,
            'price' => $book[0]['bookPrice'],
            'name' => $book[0]['bookName']
        );

        $this->cart->insert($data);
        redirect("member/Cart/view", "refresh");
    }
    
    public function view() {
        $show = $this->myclass->session_member();
        
         $show['title'] = "Giỏ hàng của bạn";
        //nav_bar
        $show['nav_bar'] = "member/nav_bar_lv1";
        $show['bar_name']['name'] = "Giỏ hàng của bạn";
       
        $show['content_main'] = "member/cart";
        $cart = $this->cart->contents();
        $show['data_content']['cart'] = $cart;
        $max_qty = array();
        foreach ($cart as $cart_data) {
            $bookQty = $this->BookModel->getQuantity($cart_data['id']);
            $max_qty[$cart_data['id']] = $bookQty[0]['bookQuantity'];
        }
        $show['data_content']['max_qty'] = $max_qty;
        $show['data_content']['checkAdd'] = $this->checkAdd;
        $this->load->view('layout', $show);
    }
    
    function update() {
        $rowID = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        $data = array(
            'rowid' => $rowID,
            'qty' => $qty
        );
        $this->cart->update($data);
        redirect("member/Cart/view", "refresh");
    }
    
    public function delete(){
        $cart = $this->cart->contents();
        foreach ($cart as $item){
            if($item['id'] == $this->uri->segment(4)){
                $data['rowid'] = $item['rowid'];
                $data['qty'] = 0;
                break;
            }
        }
        $this->cart->update($data);
        redirect("member/Cart/view", "refresh");
    }
}
