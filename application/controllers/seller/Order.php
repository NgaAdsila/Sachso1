<?php
class Order extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','text'));
        $this->load->library(array('myclass','pagination'));
        $this->load->model(array('OrderModel','BookModel','StaffModel','MemberModel'));
    }
    
    public function viewListOrder(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Danh sách đơn hàng";
        $show['manager_content'] = "seller/orderList";
        //mảng điều kiện lọc
        $i=0;
        $data_search = array();
        if($this->input->get('kn')){
            $kn =  $this->input->get('kn');
            if($kn !== ""){
                $id_mem = $this->MemberModel->getIdByName($kn);
                if(!empty($id_mem)){
                    $data_search[$i] = "order_tbl.memberID = ".$id_mem[0]['memberID'];
                    $i++;
                } else{
                    $data_search[$i] = "order_tbl.memberID = 0";
                    $i++;
                }
            }
        }
        if($this->input->get('kdo')){
            $kdo =  $this->input->get('kdo');
            if($kdo !== ""){
                $data_search[$i] = "orderDate = '".$kdo."'";
                $i++;
            }
        }
        if($this->input->get('kdr')){
            $kdr =  $this->input->get('kdr');
            if($kdr !== ""){
                $data_search[$i] = "requireDate like '".$kdr."%'";
                $i++;
            }
        }
        if($this->input->get('kstf')){
            $kstf =  $this->input->get('kstf');
            if($kstf !== "0"){
                $data_search[$i] = "staffID = ".$kstf;
                $i++;
            }
        }
        if($this->input->get('kstt')){
            $kstt =  $this->input->get('kstt');
            if($kstt !== "0"){
                $data_search[$i] = "order_tbl.status = '".$kstt."'";
                $i++;
            }
        }
        if(empty($data_search)){
            $dsearch = "";
        }  else {
            $dsearch = implode($data_search, ' and ');
        }
        ////////////////////////////////////////////////////////////
        //Lấy tổng số đơn hàng
        if($dsearch !== ""){
            $total_orders = $this->OrderModel->getTotalOrderSearch($dsearch);
        } else {
            $total_orders = $this->OrderModel->getTotalOrders();
        }
        //Số đơn hàng trên 1 trang
        $per_page = 10;
        
        //Phân trang
        $config['total_rows'] = $total_orders;
        $config['per_page'] = $per_page;
        if($dsearch !== ""){
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $config['base_url'] = site_url().'seller/Order/viewListOrder';
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET, '', "&");
        }  else {
            $config['base_url'] = site_url().'seller/Order/viewListOrder';
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
        
        //Lấy đơn hàng
        if($dsearch !== ""){
            $order = $this->OrderModel->getListOrderSearch($dsearch,$per_page, $offset);
        }  else {
            $order = $this->OrderModel->getListOrder($per_page, $offset);
        }
        
        $show['data_content']['order'] = $order;
        $show['data_content']['per_page'] = $offset+1;
        $show['data_content']['pagination'] = $pagination;
        //Lấy danh sách Shipper
        $shipper = $this->StaffModel->getListShipper();
        $show['data_content']['shipper'] = $shipper;
        $this->load->view('manager/layout',$show);
    }
    
    public function updateStatus(){
        $ordersID = $this->input->post('ordersID');
        $data['staffID'] = $this->input->post('shipper');
        $data['status'] = $this->input->post('status');
        if ($data['status'] == 'Hủy'){
            $infoOrder = $this->OrderModel->getOrderDetail($ordersID);
            foreach ($infoOrder as $order_data) {
                $bookID = $order_data['bookID'];
                $bookQty = $this->BookModel->getQuantity($bookID);
                $max_qty = 0;
                if (!empty($bookQty)){$max_qty = $bookQty[0]['bookQuantity'];}
                $book_data['bookQuantity'] = $max_qty + $order_data['quantity'];
                $this->BookModel->editBook($book_data,$bookID);
            }
            $detail['cancel'] = -1;
            $this->OrderModel->updateDetail($detail,$ordersID);
        }
        $check = $this->OrderModel->update($data, $ordersID);
        if ($check == TRUE) {
            $this->check = TRUE;
            $this->viewListOrder();
        } else {
            echo "Không thể cập nhật thành công liên hệ nhân viên ký thuật để biết thêm thông tin";
        }
    }
    
    public function orderDetail(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Chi tiết đơn hàng";
        $show['manager_content'] = "seller/orderDetail";
        
        $orderID = $this->uri->segment(4);
        //Lấy thông tin đơn hàng
        $order = $this->OrderModel->getOrderById($orderID);
        $show['data_content']['order'] = $order;
        
        $orderDetail = $this->OrderModel->getOrderDetail($orderID);
        $show['data_content']['orderDetail'] = $orderDetail;
        $this->load->view('manager/layout',$show);
    }

    //Xóa đơn hàng
    public function deleteOrder() {
        $orderID = $this->uri->segment(4);
        $check = $this->OrderModel->delOrder($orderID);
        if($check == TRUE){
            redirect('seller/Order/viewListOrder', 'refresh');
        } else{
            echo 'Không thể thực hiện thao tác xóa! Hãy kiểm tra lại!';
        }
    }
}
