<?php
class FeedbackModel extends CI_Model{
    
    private $_tbl = 'feedback_tbl';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //Lấy thông tin feedback có giới hạn
    public function getListFB($perpage,$offset){
        $this->db->select($this->_tbl.'.*, member_tbl.fullName');
        $this->db->from($this->_tbl);
        $this->db->join('member_tbl', $this->_tbl .'.memberID = member_tbl.memberID');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy thông tin feedback theo member có giới hạn
    public function getListFbMember($id,$perpage,$offset){
        $this->db->select($this->_tbl.'.*, member_tbl.fullName');
        $this->db->from($this->_tbl);
        $this->db->join('member_tbl', $this->_tbl .'.memberID = member_tbl.memberID');
        $this->db->where_in($this->_tbl .'.memberID',$id);
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy thông tin feedback theo đánh giá có giới hạn
    public function getListFbStt($id,$perpage,$offset){
        $this->db->select($this->_tbl.'.*, member_tbl.fullName');
        $this->db->from($this->_tbl);
        $this->db->join('member_tbl', $this->_tbl .'.memberID = member_tbl.memberID');
        $this->db->where('ratings',$id);
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy trạng thái FB theo tháng
     public function getFBByMonth($date){
        $this->db->select('ratings, count(ratings) qty');
        $this->db->from($this->_tbl);
        $this->db->where_in('sendDate',$date);
        $this->db->group_by('ratings');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy trạng thái FB theo ngày
     public function getFBByDate($date){
        $this->db->select('ratings, count(ratings) qty');
        $this->db->from($this->_tbl);
        $this->db->where('sendDate',$date);
        $this->db->group_by('ratings');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Thêm feedback mới
    public function addFeedback($feedback) {
        $this->db->insert($this->_tbl, $feedback);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Cập nhật đánh giá phản hồi
    public function update($data,$feedbackID){
        $this->db->where('feedbackID', $feedbackID);
        $this->db->update($this->_tbl, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Lấy tổng số FB
    public function getTotalFBs(){
        $this->db->select('feedbackID');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Lấy tổng số FB theo member
    public function getTotalFbMember($id){
        $this->db->select('feedbackID');
        $this->db->from($this->_tbl);
        $this->db->where_in('memberID',$id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Lấy tổng số FB theo đánh giá
    public function getTotalFbStt($id){
        $this->db->select('feedbackID');
        $this->db->from($this->_tbl);
        $this->db->where('ratings',$id);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
