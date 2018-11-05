<?php
class RatingModel extends CI_Model{
    
    private $_tbl = 'ratings_tbl';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //Lấy top đánh giá trung bình sách
    public function getTopRateofBook($limit){
        $sql = 'SELECT book_tbl.bookID,book_tbl.bookName,book_tbl.bookPrice,book_tbl.bookImg,avg_tbl.rate_avg,avg_tbl.rate_num '
                . 'FROM (SELECT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM '.
                $this->_tbl.' GROUP BY bookID HAVING COUNT(bookID)>50) avg_tbl,'
                . 'book_tbl where avg_tbl.bookID = book_tbl.bookID ORDER BY (rate_avg) DESC LIMIT '.$limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Lấy đánh giá trung bình sách mới
//    public function getNewRateofBook($limit){
//        $sql = 'SELECT book_tbl.bookID,book_tbl.bookName,book_tbl.bookPrice,book_tbl.bookImg,avg_tbl.rate_avg '
//                . 'FROM (SELECT bookID, AVG(ratingScore) AS rate_avg FROM '.
//                $this->_tbl.' GROUP BY (bookID)) avg_tbl,book_tbl where avg_tbl.bookID = book_tbl.bookID ORDER BY ('.
//                'avg_tbl.bookID) DESC LIMIT '.$limit;
//        $query = $this->db->query($sql);
//        return $query->result_array();
//    }
    
    //Lấy đánh giá trung bình sách theo thể loại
    public function getRateofTypeBook($typeID,$perpage,$offset){
        $sql = 'SELECT * FROM (SELECT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM '.
            $this->_tbl.' GROUP BY (bookID)) avg_tbl, book_tbl where avg_tbl.bookID = book_tbl.bookID '
                . 'and book_tbl.typeID = '.$typeID.' limit '.$offset.','.$perpage;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Lấy đánh giá trung bình sách cùng thể loại
    public function getRateInTypeBook($typeID,$bookID,$offset){
        $sql = 'SELECT * FROM (SELECT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM '.
            $this->_tbl.' GROUP BY (bookID) HAVING COUNT(bookID)>50) avg_tbl, book_tbl where avg_tbl.bookID = book_tbl.bookID '
                . 'and book_tbl.bookID != "'.$bookID.'" and book_tbl.typeID = '.$typeID.' order by rate_avg desc limit '.$offset;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Lấy đánh giá trung bình sách top thể loại
    public function getRateTopTypeBook($typeID,$offset){
        $sql = 'SELECT * FROM (SELECT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM '.
            $this->_tbl.' GROUP BY (bookID) HAVING COUNT(bookID)>50) avg_tbl, book_tbl where avg_tbl.bookID = book_tbl.bookID '
                . 'and book_tbl.typeID = '.$typeID.' order by rate_avg desc limit '.$offset;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Lấy đánh giá trung bình sách cùng tác giả
    public function getRateInAuthorBook($author,$bookID,$offset){
        $sql = 'SELECT * FROM (SELECT bookID, AVG(ratingScore) AS rate_avg, COUNT(bookID) AS rate_num FROM '.
            $this->_tbl.' GROUP BY (bookID)) avg_tbl, book_tbl where avg_tbl.bookID = book_tbl.bookID '
                . 'and book_tbl.bookID != "'.$bookID.'" and book_tbl.author = "'.$author.'" order by rate_avg desc limit '.$offset;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Lấy đánh giá trung bình theo user
    public function getRateAVGByMember(){
        $sql = 'SELECT memberID, AVG(ratingScore) AS rate_avg FROM '.
            $this->_tbl.' GROUP BY (memberID)';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    //Lấy giá trị trung bình của sách
    public function getRateByBook(){
        $this->db->select('bookID, AVG(ratingScore) as rate_avg, COUNT(bookID) AS rate_num');
        $this->db->from($this->_tbl);
        $this->db->group_by('bookID');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy giá trị trung bình của sách theo id
    public function getRateById($bookID){
        $this->db->select('AVG(ratingScore) as rate_avg');
        $this->db->from($this->_tbl);
        $this->db->where('bookID',$bookID);
        $this->db->group_by('bookID');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Đếm giá trị đánh giá của sách theo id
    public function getCountRateById($bookID){
        $this->db->select('ratingScore,COUNT(ratingScore) as rate_count');
        $this->db->from($this->_tbl);
        $this->db->where('bookID',$bookID);
        $this->db->group_by('ratingScore');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy giá trị trung bình của sách theo danh sách id
    public function getRateByListId($bookID){
        $this->db->select('bookID,AVG(ratingScore) as rate_avg, COUNT(bookID) AS rate_num');
        $this->db->from($this->_tbl);
        $this->db->where_in('bookID',$bookID);
        $this->db->group_by('bookID');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Đếm lượt rate của sách
    public function countRateofBook($bookID){
        $this->db->select('bookID');
        $this->db->from($this->_tbl);
        $this->db->where('bookID',$bookID);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Lấy đánh giá cho 1 cuốn sách của người dùng cụ thể
    public function getRatingScoreABook($memberID,$bookID){
        $this->db->select('ratingScore');
        $this->db->from($this->_tbl);
        $this->db->where('memberID',$memberID);
        $this->db->where('bookID',$bookID);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy danh sách sách member đã đánh giá
    public function getBookByMember($memberID,$bookID){
        $this->db->select('bookID,ratingScore');
        $this->db->from($this->_tbl);
        $this->db->where('memberID',$memberID);
        $this->db->where('bookID !=',$bookID);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Lấy danh sách sách member đã từng đánh giá
    public function getBookIsRatedByMember($memberID){
        $this->db->select('bookID');
        $this->db->from($this->_tbl);
        $this->db->where('memberID',$memberID);
        $this->db->where('ratingScore >',3);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy id thành viên
    public function getMemberId($id){
        $this->db->select('memberID');
        $this->db->from($this->_tbl);
        $this->db->where('memberID !=',$id);
        $this->db->group_by('memberID');
        $this->db->having('COUNT(memberID)>10');
        $query = $this->db->get();
        return $query->result_array();
    }
        
    //Lấy id sách
    public function getBookId($id){
        $this->db->select('bookID');
        $this->db->from($this->_tbl);
        $this->db->where('bookID !=',$id);
        $this->db->group_by('bookID');
        $this->db->having('COUNT(bookID)>20');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Lấy dữ liệu rate
    public function getRateData(){
        $this->db->select('*');
        $this->db->from($this->_tbl);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Kiểm tra member đã đánh giá cho sách chưa
    public function isRatedABook($memberID,$bookID){
        $this->db->select('ratingScore');
        $this->db->from($this->_tbl);
        $this->db->where('memberID',$memberID);
        $this->db->where('bookID',$bookID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Kiểm tra member đã từng đánh giá chưa
    public function isRated($memberID){
        $this->db->select('ratingScore');
        $this->db->from($this->_tbl);
        $this->db->where('memberID',$memberID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Thêm rate mới
    public function addRating($data) {
        $this->db->insert($this->_tbl, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Cập nhật điểm rate
    public function updateRatingScore($memberID,$bookID,$score) {
        $this->db->where('memberID', $memberID);
        $this->db->where('bookID', $bookID);
        $this->db->update($this->_tbl, $score);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
