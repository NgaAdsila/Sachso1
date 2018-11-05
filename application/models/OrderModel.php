<?php
class OrderModel extends CI_Model{
    
    private $_tbl = 'order_tbl';
            
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //Lấy danh sách đơn hàng có giới hạn
    public function getListOrder($perpage,$offset){
        $this->db->select($this->_tbl.'.*, member_tbl.memberName');
        $this->db->from($this->_tbl);
        $this->db->join('member_tbl', $this->_tbl .'.memberID = member_tbl.memberID');
        $this->db->order_by('orderID','desc');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách đơn hàng có giới hạn với điều kiện
    public function getListOrderSearch($dsearch,$perpage,$offset){
        $sql = 'SELECT order_tbl.*,member_tbl.memberName FROM '
                .$this->_tbl.', member_tbl where '.$this->_tbl.'.memberID = member_tbl.memberID and '
                .$dsearch.' limit '.$offset.','.$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //lấy thông tin đơn hàng theo id
    public function getOrderById($orderID){
        $this->db->select($this->_tbl.'.*, member_tbl.fullName');
        $this->db->from($this->_tbl);
        $this->db->join('member_tbl', $this->_tbl .'.memberID = member_tbl.memberID');
        $this->db->where('orderID',$orderID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách đơn hàng mới
    public function getNewOrder() {
        $this->db->select($this->_tbl.'.*, member_tbl.fullName');
        $this->db->from($this->_tbl);
        $this->db->join('member_tbl', $this->_tbl .'.memberID = member_tbl.memberID');
        $this->db->order_by('orderID', 'desc');
        $this->db->limit(6);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy nhân viên giao hàng theo đơn hàng
    public function getShipper($orderID){
        $this->db->select('fullName');
        $this->db->from($this->_tbl);
        $this->db->join('staff_tbl', $this->_tbl.'.staffID = staff_tbl.staffID');
        $this->db->where('orderID',$orderID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy trạng thái đơn hàng theo ngày
     public function getOrderByDate($date){
        $this->db->select('status, count(status) qty_stt');
        $this->db->from($this->_tbl);
        $this->db->where('orderDate',$date);
        $this->db->group_by('status');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy trạng thái đơn hàng theo tháng
     public function getOrderByMonth($date){
        $this->db->select('status, count(status) qty_stt');
        $this->db->from($this->_tbl);
        $this->db->where_in('orderDate',$date);
        $this->db->group_by('status');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy id đơn hàng theo ngày
    public function getIdOrderByDate($date){
        $this->db->select('orderID');
        $this->db->from($this->_tbl);
        $this->db->where('orderDate',$date);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy id đơn hàng theo tháng
    public function getIdOrderByMonth($date){
        $this->db->select('orderID');
        $this->db->from($this->_tbl);
        $this->db->where_in('orderDate',$date);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy chi tiết đơn hàng theo bookID
    public function getOrderDetailGroupBook($orderID){
        $this->db->select('sum(orderdetail_tbl.quantity) qty,orderdetail_tbl.price, book_tbl.bookName');
        $this->db->from('orderdetail_tbl');
        $this->db->join('book_tbl', 'orderdetail_tbl.bookID = book_tbl.bookID');
        $this->db->where_in('orderdetail_tbl.orderID',$orderID);
        $this->db->where('orderdetail_tbl.cancel !=','-1');
        $this->db->group_by('orderdetail_tbl.bookID');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy chi tiết đơn hàng
    public function getOrderDetail($orderID){
        $this->db->select('orderdetail_tbl.*, book_tbl.bookName');
        $this->db->from('orderdetail_tbl');
        $this->db->join('book_tbl', 'orderdetail_tbl.bookID = book_tbl.bookID');
        $this->db->where('orderdetail_tbl.orderID',$orderID);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //thêm đơn hàng mới
    public function addOrders($orders){
        $this->db->insert($this->_tbl, $orders);
        $ordersID = $this->db->insert_id();
        if($this->db->affected_rows()>0){
            return $ordersID;
        }  else {
            return 0;    
        }
    }
    
    //thêm chi tiết đơn hàng
    public function addOrderDetail($book){
        $this->db->insert('orderdetail_tbl', $book);
        if ($this->db->affected_rows()>0){
            return TRUE;
        }  else {
            return FALSE;    
        }
    }
    
    //Cập nhật đơn hàng
    public function update($data,$orderID){
        $this->db->where('orderID', $orderID);
        $this->db->update($this->_tbl, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Cập nhật chi tiết đơn hàng
    public function updateDetail($data,$orderID){
        $this->db->where('orderID', $orderID);
        $this->db->update('orderdetail_tbl', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //xóa đơn hàng
    public function delOrder($orderID) {
        $this->db->delete($this->_tbl, array('orderID' => $orderID));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //xóa chi tiết đơn hàng
    public function delOrderDetail($orderID) {
        $this->db->delete('orderdetail_tbl', array('orderID' => $orderID));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Lấy tổng đơn hàng
    public function getTotalOrders(){
        $this->db->select('orderID');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Lấy tổng đơn hàng có điều kiện
    public function getTotalOrderSearch($dsearch){
        $sql = "select orderID from ".$this->_tbl." where ".$dsearch;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}
