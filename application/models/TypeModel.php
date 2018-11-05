<?php
class TypeModel extends CI_Model{
    
    private $_tbl = 'type_tbl';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //Lấy danh sách danh mục
    public function getListType(){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy thông tin danh mục theo ID
    public function getTypeById($typeID){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->where('typeID',$typeID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy tên danh mục theo id
    public function getTypeNameById($bookID){
        $this->db->select('typeName');
        $this->db->from($this->_tbl.', book_tbl');
        $this->db->where($this->_tbl.'.typeID','book_tbl.typeID');
        $this->db->where('book_tbl.bookID', $bookID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Kiểm tra tên đã tồn tại chưa
    public function isNameExist($name) {
        $this->db->select('typeID');
        $this->db->from($this->_tbl);
        $this->db->where('typeName', $name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Kiểm tra tên danh mục mới của ID đã tồn tại chưa
    public function isNewNameExist($typeID,$typeName){
        $this->db->select('typeID');
        $this->db->from($this->_tbl);
        $this->db->where('typeID !=', $typeID);
        $this->db->where('typeName', $typeName);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Thêm danh mục mới
    public function addType($type) {
        $this->db->insert($this->_tbl, $type);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Sửa thông tin danh mục
    public function editType($data, $typeID) {
        $this->db->where('typeID', $typeID);
        $this->db->update($this->_tbl, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Xóa danh mục
    public function delType($typeID) {
        $this->db->delete($this->_tbl, array('typeID' => $typeID));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
