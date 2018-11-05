<?php
class MemberModel extends CI_Model {

    private $_tbl = 'member_tbl';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Lấy danh sách thành viên có giới hạn
    public function getListMember($perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->order_by('memberID','DESC');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách thành viên theo tên đăng nhập có giới hạn
    public function getListMemberName($name,$perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->where('memberName',$name);
        $this->db->order_by('memberID','DESC');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách thành viên theo trạng thái có giới hạn
    public function getListMemberStt($stt,$perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->where('status',$stt);
        $this->db->order_by('memberID','DESC');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //lấy thông tin thành viên theo id
    public function getMemberById($memberID){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->where('memberID',$memberID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách thành viên mới
    public function getNewMember() {
        $this->db->select('memberID,memberName,fullName,tel,add,sex,email,status');
        $this->db->from($this->_tbl);
        $this->db->order_by('memberID', 'desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy id thành viên theo tên đăng nhập
    public function getIdByName($name) {
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('memberName',$name);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy mật khẩu của $memberID
    public function getOldPass($memberID) {
        $this->db->select('pwd');
        $this->db->from($this->_tbl);
        $this->db->where('memberID', $memberID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Kiểm tra đăng nhập
    public function checkLogin($membername, $password){
        $this->db->select('memberID, memberName, status');
        $this->db->from($this->_tbl);
        $this->db->where('memberName', $membername);
        $this->db->where('pwd', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Kiểm tra tên đăng nhập đã tồn tại hay chưa
    public function isNameExist($name) {
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('memberName', $name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Kiểm tra email đã tồn tại hay chưa
    public function isEmailExist($email) {
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Kiểm tra email đã tồn tại hay chưa
    public function isEmailExistId($id,$email) {
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('memberID !=', $id);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Kiểm tra email
    public function isEmail($name,$email) {
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('memberName', $name);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Thêm thành viên mới
    public function addMember($member) {
        $this->db->insert($this->_tbl, $member);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Sửa thông tin thành viên
    public function editMember($data, $memberID) {
        $this->db->where('memberID', $memberID);
        $this->db->update($this->_tbl, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Xóa thành viên
    public function delMember($memberID) {
        $this->db->delete($this->_tbl, array('memberID' => $memberID));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //lấy tổng số thành viên
    public function getTotalMember(){
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //lấy tổng số thành viên theo tên đăng nhập
    public function getTotalMemberByName($name){
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('memberName',$name);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //lấy tổng số thành viên theo trạng thái
    public function getTotalMemberByStt($stt){
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('status',$stt);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function searchIDMember($keyword) {
        $sql = "SELECT DISTINCT memberID FROM feedback_tbl WHERE memberID in (SELECT memberID FROM member_tbl WHERE MATCH(fullName) AGAINST(? IN BOOLEAN MODE))";
        $query = $this->db->query($sql, array($keyword));
        return $query->result_array();
    }
    
    public function searchMember($keyword,$perpage,$offset) {
        $sql = "SELECT * FROM member_tbl WHERE MATCH(fullName) AGAINST(? IN BOOLEAN MODE) limit "
                .$offset.",".$perpage;
        $query = $this->db->query($sql, array($keyword));
        return $query->result_array();
    }
    
    public function totalSearchMember($keyword) {
        $sql = "SELECT * FROM  member_tbl WHERE MATCH(fullName) AGAINST(? IN BOOLEAN MODE)";
        $query = $this->db->query($sql, array($keyword));
        return $query->num_rows();
    }
    
//    //Thêm code
//    public function addCode($data){
//        $this->db->insert('code_tbl', $data);
//        if ($this->db->affected_rows() > 0) {
//            return TRUE;
//        } else {
//            return FALSE;
//        }
//    }
//    
//    //get code
//    public function getCode($email){
//        $this->db->select('*');
//        $this->db->from('code_tbl');
//        $this->db->where('email',$email);
//        $this->db->limit(1);
//        $query = $this->db->get();
//        return $query->result_array();
//    }
}
