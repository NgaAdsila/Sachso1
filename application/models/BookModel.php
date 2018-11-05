<?php
class BookModel extends CI_Model{
    
    private $_tbl = 'book_tbl';
            
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //Lấy danh sách sách có giới hạn
    public function getListBook($perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('type_tbl', $this->_tbl . '.typeID = type_tbl.typeID','left');
        $this->db->order_by('bookID','DESC');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách sách có giới hạn sort asc
    public function getListBookSortAsc($str,$perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('type_tbl', $this->_tbl . '.typeID = type_tbl.typeID','left');
        $this->db->order_by($str,'ASC');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách sách có giới hạn sort desc
    public function getListBookSortDesc($str,$perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('type_tbl', $this->_tbl . '.typeID = type_tbl.typeID','left');
        $this->db->order_by($str,'DESC');
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //lấy thông tin sách theo id
    public function getBookById($bookID){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('type_tbl', $this->_tbl . '.typeID = type_tbl.typeID','left');
        $this->db->where('bookID',$bookID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //lấy thông tin sách theo danh sách id
    public function getBookByListId($array){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('type_tbl', $this->_tbl . '.typeID = type_tbl.typeID');
        $this->db->where_in('bookID',$array);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //lấy thông tin sách theo thể loại
    public function getTypeBook($typeID,$perpage,$offset){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('type_tbl', $this->_tbl . '.typeID = type_tbl.typeID','left');
        $this->db->where('book_tbl.typeID',$typeID);
        $this->db->limit($perpage, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách sách mới
    public function getNewBook($limit) {
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->join('type_tbl', $this->_tbl . '.typeID = type_tbl.typeID','left');
        $this->db->order_by('bookID', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách sách mới theo thể loại
    public function getNewType($typeID,$limit) {
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $this->db->where('typeID',$typeID);
        $this->db->order_by('bookID', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách sách được mua nhiều
    public function getHotSelBook($limit) {
        $sql = 'SELECT book_tbl.bookID,book_tbl.bookName,book_tbl.bookPrice,book_tbl.bookImg,qty'
                . ' FROM (SELECT bookID, SUM(quantity) AS qty FROM orderdetail_tbl WHERE cancel != -1'
                . ' GROUP BY bookID ORDER BY (qty) DESC LIMIT '.$limit.') avg_tbl,'
                . ' book_tbl where avg_tbl.bookID = book_tbl.bookID AND qty>1 ORDER BY (qty) DESC';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Lấy số lượng sách
    public function getQuantity($bookID){
        $this->db->select('bookQuantity');
        $this->db->from($this->_tbl);
        $this->db->where('bookID',$bookID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy tên sách
    public function getBookName($bookID){
        $this->db->select('bookName');
        $this->db->from($this->_tbl);
        $this->db->where('bookID',$bookID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Lấy danh sách nhà xuất bản
    public function getPublisher(){
        $this->db->select('DISTINCT(publisher)');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Kiểm tra ID đã tồn tại chưa
    public function isIDExist($id) {
        $this->db->select('bookID');
        $this->db->from($this->_tbl);
        $this->db->where('bookID', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Thêm sách mới
    public function addBook($book) {
        $this->db->insert($this->_tbl, $book);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Sửa thông tin sách
    public function editBook($data, $bookID) {
        $this->db->where('bookID', $bookID);
        $this->db->update($this->_tbl, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // xóa sách
    public function delBook($bookID) {
        $this->db->delete($this->_tbl, array('bookID' => $bookID));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Lấy tổng số sách
    public function getTotalBook(){
        $this->db->select('bookID');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Lấy tổng số sách theo danh mục
    public function getTotalTypeBook($typeID){
        $this->db->select('bookID');
        $this->db->from($this->_tbl);
        $this->db->where('typeID',$typeID);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Tìm theo từ khóa
    function searchBook($keyword,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID and MATCH(bookName) AGAINST(? IN BOOLEAN MODE) limit "
                .$offset.",".$perpage;
        $query = $this->db->query($sql, array($keyword));
        return $query->result_array();
    }
    
    //Tìm theo từ khóa giá sắp xếp
    function searchBookSort($keyword,$sort,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID and MATCH(bookName) AGAINST(? IN BOOLEAN MODE) ORDER BY bookPrice "
                .$sort." limit ".$offset.",".$perpage;
        $query = $this->db->query($sql, array($keyword));
        return $query->result_array();
    }
    
    function searchBookSel($keyword,$perpage,$offset) {
        $sql = "SELECT * FROM book_tbl INNER JOIN type_tbl ON book_tbl.typeID = type_tbl.typeID "
                ."AND MATCH(bookName) AGAINST(? IN BOOLEAN MODE) limit "
                .$offset.",".$perpage;
        $query = $this->db->query($sql, array($keyword));
        return $query->result_array();
    }
    
    function totalSearchBook($keyword) {
        $sql = "SELECT * FROM  book_tbl WHERE MATCH(bookName) AGAINST(? IN BOOLEAN MODE)";
        $query = $this->db->query($sql, array($keyword));
        return $query->num_rows();
    }
    
    //Tìm nhà sản xuất
    function searchPub($pub,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID and publisher = '".$pub."' limit "
                .$offset.",".$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function totalSearchPub($pub) {
        $this->db->select('bookID');
        $this->db->from($this->_tbl);
        $this->db->where('publisher',$pub);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Tìm thấp hơn
    function searchLess($col,$var1,$typeID,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID and typeID = ".$typeID." and "
                .$col." < ".$var1." limit ".$offset.",".$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Tìm thấp hơn sắp giá
    function searchLessSort($col,$var1,$typeID,$sort,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID and typeID = ".$typeID." and "
                .$col." < ".$var1." order by bookPrice ".$sort." limit ".$offset.",".$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function totalSearchLess($col,$var1,$typeID) {
        $sql = "SELECT * FROM  book_tbl WHERE typeID = ".$typeID." and ".$col." <".$var1;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    //Tìm theo khoảng
    function searchRange($col,$var1,$var2,$typeID,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID AND typeID = ".$typeID." AND "
                .$col." >= ".$var1." AND ".$col." <= ".$var2." LIMIT ".$offset.",".$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Tìm theo khoảng sắp giá
    function searchRangeSort($col,$var1,$var2,$typeID,$sort,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID AND typeID = ".$typeID." AND "
                .$col." >= ".$var1." AND ".$col." <= ".$var2." ORDER BY bookPrice ".$sort." LIMIT ".$offset.",".$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function totalSearchRange($col,$var1,$var2,$typeID) {
        $sql = "SELECT * FROM  book_tbl WHERE typeID = ".$typeID." AND ".$col." >= ".$var1." AND ".$col." <= ".$var2;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    //Tìm lớn hơn
    function searchMore($col,$var2,$typeID,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID AND typeID = ".$typeID." AND "
                .$col." > ".$var2." LIMIT ".$offset.",".$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Tìm lớn hơn sắp giá
    function searchMoreSort($col,$var2,$typeID,$sort,$perpage,$offset) {
        $sql = "SELECT * FROM (SELECT DISTINCT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM "
                . "ratings_tbl GROUP BY (bookID)) avg_tbl, book_tbl "
                . "WHERE avg_tbl.bookID = book_tbl.bookID AND typeID = ".$typeID." AND "
                .$col." > ".$var2." ORDER BY bookPrice ".$sort." LIMIT ".$offset.",".$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function totalSearchMore($col,$var2,$typeID) {
        $sql = "SELECT * FROM  book_tbl WHERE typeID = ".$typeID." AND ".$col." >".$var2;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}
