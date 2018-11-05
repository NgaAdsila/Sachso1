<?php
class StaffModel extends CI_Model {

    private $_tbl = 'staff_tbl';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Lấy danh sách nhân viên
    public function getStaffRole(){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('role_tbl', $this->_tbl . '.roleID = role_tbl.roleID');
        $this->db->where($this->_tbl . '.roleID !=', 'ADM');
        $this->db->order_by('staffID','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách nhân viên có giới hạn
    public function getListStaff($perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('role_tbl', $this->_tbl . '.roleID = role_tbl.roleID');
        $this->db->where($this->_tbl . '.roleID !=', 'ADM');
        $this->db->order_by('staffID','DESC');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Lấy thông tin nhân viên theo ID
    public function getStaffById($staffID){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('role_tbl', $this->_tbl . '.roleID = role_tbl.roleID');
        $this->db->where('staffID',$staffID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Lấy thông tin nhân viên với tên $name và $password
    public function getStaff($name, $password) {
        $this->db->select('staffID, staffName, roleID');
        $this->db->from($this->_tbl);
        $this->db->where('staffName', $name);
        $this->db->where('pwd', $password);
        //$this->db->where('roleID !=', 'SHI');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Lấy danh sách Shipper
    public function getListShipper() {
        $this->db->select('staffID, fullName');
        $this->db->from($this->_tbl);
        $this->db->where('roleID', 'SHI');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách nhân viên mới
    public function getNewStaff() {
        $this->db->select('staffID,staffName,fullName,sex,tel,homeLand,add,email,roleName');
        $this->db->from($this->_tbl);
        $this->db->join('role_tbl', $this->_tbl . '.roleID = role_tbl.roleID');
        $this->db->where($this->_tbl . '.roleID !=', 'ADM');
        $this->db->order_by('staffID', 'desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Kiểm tra tên đăng nhập đã tồn tại hay chưa
    public function isNameExist($name) {
        $this->db->select('staffID');
        $this->db->from($this->_tbl);
        $this->db->where('staffName', $name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Kiểm tra email đã tồn tại hay chưa
    public function isEmailExist($email) {
        $this->db->select('staffID');
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
        $this->db->select('staffID');
        $this->db->from($this->_tbl);
        $this->db->where('staffID !=', $id);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Lấy mật khẩu của $staffID
    public function getOldPass($staffID) {
        $this->db->select('pwd');
        $this->db->from($this->_tbl);
        $this->db->where('staffID', $staffID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Thêm nhân viên mới
    public function addStaff($staff) {
        $this->db->insert($this->_tbl, $staff);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Sửa thông tin nhân viên
    public function editStaff($data, $staffID) {
        $this->db->where('staffID', $staffID);
        $this->db->update($this->_tbl, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Xóa nhân viên
    public function delStaff($staffID) {
        $this->db->delete($this->_tbl, array('staffID' => $staffID));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Lấy tổng số nhân viên
    public function getTotalStaff(){
        $this->db->select('staffID');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->num_rows();
    }


    //Lấy thông tin chức vụ nhân viên
    public function getRole() {
        $this->db->select('*');
        $this->db->from('role_tbl');
        $this->db->where('roleID !=', 'ADM');
        $query = $this->db->get();
        return $query->result_array();
    }

}
