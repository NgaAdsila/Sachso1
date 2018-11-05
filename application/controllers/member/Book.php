<?php

class Book extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'text'));
        $this->load->library(array('session', 'myclass'));
        $this->load->model(array('BookModel', 'RatingModel'));
    }

    public function index() {
        $show = $this->myclass->session_member();
        $bookID = $this->uri->segment(4);
        $bookInfo = $this->BookModel->getBookById($bookID);
        $show['data_content']['bookInfo'] = $bookInfo;
        $show['title'] = 'BS - Thông tin chi tiết sách';
        $show['data_content']['bookName'] = $bookInfo[0]['bookName'];

        //nav-bar
        $show['nav_bar'] = "member/nav_bar_lv2";
        $show['bar_name']['typeID'] = $bookInfo[0]['typeID'];
        $show['bar_name']['typeName'] = $bookInfo[0]['typeName'];
        $show['bar_name']['name'] = $bookInfo[0]['bookName'];

        //Lấy thông tin rate
        $rate_avg = $this->RatingModel->getRateById($bookID);
        $show['data_content']['rate_avg'] = $rate_avg;
        //Lấy số lượt rate
        $count_rate = $this->RatingModel->countRateofBook($bookID);
        $show['data_content']['count_rate'] = $count_rate;

        //Đếm rate sao
        $count_star = $this->RatingModel->getCountRateById($bookID);
        $star = array();
        if (!empty($count_star)) {
            for ($i = 0; $i < 5; $i++) {
                $star[$i]['ratingScore'] = $i + 1;
                $star[$i]['rate_count'] = 0;
            }
            foreach ($count_star as $value) {
                for ($i = 0; $i < 5; $i++) {
                    if ($star[$i]['ratingScore'] == $value['ratingScore']) {
                        $star[$i]['rate_count'] = $value['rate_count'];
                        break;
                    }
                }
            }
        }
        $show['data_content']['count_star'] = $star;

        //Lấy đánh giá của member về cuốn sách
        $session = $this->session->userdata('logged_in');
        $memberID = $session['id'];
        $scoreRatingBook = $this->RatingModel->getRatingScoreABook($memberID, $bookID);
        $show['data_content']['scoreRatingBook'] = $scoreRatingBook;

        $book_top = $this->RS_Pearson_func($memberID, $bookID);
        if (!empty($book_top)) {
            $show['data_content']['book_cmd'] = $this->BookModel->getBookByListId($book_top);
            $show['data_content']['book_cmd_avg'] = $this->RatingModel->getRateByListId($book_top);
        } else {
            $book = $this->RS_Item_func($bookID);
            if (!empty($book)) {
                $show['data_content']['book_cmd'] = $this->BookModel->getBookByListId($book);
                $show['data_content']['book_cmd_avg'] = $this->RatingModel->getRateByListId($book);
            } else {
                $show['data_content']['topBook'] = $this->RatingModel->getTopRateofBook(10);
            }
        }
        $show['data_content']['typeBook'] = $this->RatingModel->getRateInTypeBook($bookInfo[0]['typeID'], $bookID, 10);
        $show['data_content']['authorBook'] = $this->RatingModel->getRateInAuthorBook($bookInfo[0]['author'], $bookID, 10);
        $show['content_main'] = "member/bookInfo";
        $this->session->set_userdata('referred_from', current_url());
        $this->load->view('layout', $show);
    }

    //recommendBook
    public function recommendBook() {
        $memberID = $this->input->post('memberID');
        $bookID = $this->input->post('bookID');
        $score = $this->input->post('rateScore');

        //Cập nhật ratingScore
        if ($this->RatingModel->isRatedABook($memberID, $bookID) == TRUE) {
            $data['ratingScore'] = $score;
            $this->RatingModel->updateRatingScore($memberID, $bookID, $data);
        } else {
            $data['memberID'] = $memberID;
            $data['bookID'] = $bookID;
            $data['ratingScore'] = $score;
            $this->RatingModel->addRating($data);
        }

        //Recommend
        $book_top = $this->RS_Pearson_func($memberID, $bookID);
        $data_rs = array();
        if (!empty($book_top)) {
            $data_rs['book_cmd'] = $this->BookModel->getBookByListId($book_top);
            $data_rs['book_cmd_avg'] = $this->RatingModel->getRateByListId($book_top);
        } else {
            $book = $this->RS_Item_func($bookID);
            if (!empty($book)) {
                $data_rs['book_cmd'] = $this->BookModel->getBookByListId($book);
                $data_rs['book_cmd_avg'] = $this->RatingModel->getRateByListId($book);
            } else {
                $data_rs['book_cmd'] = $this->RatingModel->getTopRateofBook(10);
                $data_rs['book_cmd_avg'] = array();
            }
        }
        $book_cmd = $this->load->view('member/ajax_recommend', $data_rs, true);
        $result = array('book_cmd' => $book_cmd);
        echo json_encode($result);
    }

    // User-based Collaborative Filtering
    //RS sử dụng độ tương đồng cosin
    public function RS_func($memberID, $bookID) {
        if ($this->RatingModel->isRated($memberID) == TRUE) {
            $rate = $this->RatingModel->getRateData();
            $user_id = $this->RatingModel->getMemberId($memberID);
            $book_id = $this->RatingModel->getBookId($bookID);
            $rate_data = array();
            $check_mem = array();
            //Loại user đánh giá dưới 20 sách
            foreach ($user_id as $value) {
                $check_mem[$value['memberID']] = $value['memberID'];
            }
            $k = 100;
            $check_mem[$memberID] = $memberID;
            $tmp = 0;
            foreach ($rate as $value) {
                if (array_key_exists($value['memberID'], $check_mem)) {
                    $rate_data[$tmp]['memberID'] = $value['memberID'];
                    $rate_data[$tmp]['bookID'] = $value['bookID'];
                    $rate_data[$tmp++]['ratingScore'] = $value['ratingScore'];
                }
            }
            $cuser = array(); // rate user hiện tại
            $cpow2 = 0;
            foreach ($user_id as $data) {
                $pow2[$data['memberID']] = 0;
            }
            foreach ($rate_data as $data) {
                if ($data['memberID'] === $memberID) {
                    $cuser[$data['bookID']] = $data['ratingScore']; //Đánh giá của user hiện tại
                    $cpow2 = $cpow2 + pow($data['ratingScore'], 2); //Tổng bình phương đánh giá user hiện tại
                } else {
                    $pow2[$data['memberID']] = $pow2[$data['memberID']] + pow($data['ratingScore'], 2); //Tổng bình phương đánh giá user khác
                }
            }
            $user = array();
            foreach ($user_id as $data) {
                $user[$data['memberID']] = 0;
            }
            $rui_ = array(); //rate user khác
            $i = 0;
            foreach ($rate_data as $data) {
                if ($data['memberID'] !== $memberID) {
                    if (array_key_exists($data['bookID'], $cuser)) {
                        $i++;
                        $temp = $data['ratingScore'] * $cuser[$data['bookID']];
                        $user[$data['memberID']] = $user[$data['memberID']] + $temp; //dot_x.y
                    }
                    $rui_[$data['memberID']][$data['bookID']] = $data['ratingScore'];
                }
            }
            $sim_cos = array(); // bảng độ tương tự cosin
            foreach ($user_id as $data) {
                if ($user[$data['memberID']] != 0) {
                    $sim_cos[$data['memberID']] = $user[$data['memberID']] / (sqrt($cpow2 * $pow2[$data['memberID']])); //Tính độ tương tự giữa các user
                }
            }
            //Lấy K user - láng giềng - của user hiện tại
            $sim_top = array();
            if (count($sim_cos) > $k) {
                $key = array_keys($sim_cos); //Bảng mã user
                $val = array_values($sim_cos); //Bảng giá trị tương tự
                rsort($val); //Sắp xếp giá trị tương tự
                $val_sim = array();
                for ($i = 0; $i < $k; $i++) {
                    $val_sim[$i] = $val[$i]; //lấy ra top 10
                }
                for ($i = 0; $i < count($key); $i++) {
                    for ($j = 0; $j < $k; $j++) {
                        if ($sim_cos[$key[$i]] == $val_sim[$j]) {
                            $sim_top[$key[$i]] = $val_sim[$j];
                        }
                    }
                }
            } else {
                $sim_top = $sim_cos;
            }
            $sum_sim = array_sum($sim_top); //Tổng sim(u,u')
            $key = array_keys($sim_top);
            $rui = array();
            foreach ($book_id as $data) {
                $ru_i = 0;
                for ($i = 0; $i < count($key); $i++) {
                    if (isset($rui_[$key[$i]][$data['bookID']])) {
                        $ru_i = $ru_i + $sim_top[$key[$i]] * $rui_[$key[$i]][$data['bookID']];
                    }
                }
                if ($ru_i != 0) {
                    $rui[$data['bookID']] = $ru_i / $sum_sim;
                }
            }
            $book_top = array();
            if (count($rui) > 10) {
                $book_key = array_keys($rui);
                $book_r = array_values($rui);
                rsort($book_r);
                $val_r = array();
                for ($i = 0; $i < 10; $i++) {
                    $val_r[$i] = $book_r[$i];
                }
                for ($i = 0; $i < count($book_key); $i++) {
                    for ($j = 0; $j < 10; $j++) {
                        if ($rui[$book_key[$i]] == $val_r[$j]) {
                            $book_top[$book_key[$i]] = $val_r[$j];
                        }
                    }
                }
            } else {
                $book_top = $rui;
            }
            return array_keys($book_top);
        } else {
            $book_top = array();
            return $book_top;
        }
    }

    //RS sử dụng độ tương đồng Pearson
    public function RS_Pearson_func($memberID, $bookID) {
        if ($this->RatingModel->isRated($memberID) == TRUE) {
            $rate = $this->RatingModel->getRateData();
            $user_id = $this->RatingModel->getMemberId($memberID);
            $book_data = $this->RatingModel->getBookId($bookID);
            $user_avg = $this->RatingModel->getRateAVGByMember();
            $rate_data = array();
            $check_mem = array();
            //Loại user đánh giá dưới 20 sách
            foreach ($user_id as $value) {
                $check_mem[$value['memberID']] = $value['memberID'];
            }
            $k = 100;
            $check_mem[$memberID] = $memberID;
            $tmp = 0;
            foreach ($rate as $value) {
                if (array_key_exists($value['memberID'], $check_mem)) {
                    $rate_data[$tmp]['memberID'] = $value['memberID'];
                    $rate_data[$tmp]['bookID'] = $value['bookID'];
                    $rate_data[$tmp++]['ratingScore'] = $value['ratingScore'];
                }
            }
            $avg = array();
            foreach ($user_avg as $data_avg) {
                $avg[$data_avg['memberID']] = $data_avg['rate_avg'];
            }
            $cuser = array(); // rate user hiện tại
            $cpow2 = 0;
            foreach ($user_id as $data) {
                $pow2[$data['memberID']] = 0;
            }
            foreach ($rate_data as $data) {
                if ($data['memberID'] === $memberID) {
                    $cuser[$data['bookID']] = $data['ratingScore']; //Đánh giá của user hiện tại
                    $cpow2 = $cpow2 + pow($data['ratingScore'] - $avg[$memberID], 2); //Tổng bình phương đánh giá user hiện tại
                } else {
                    $pow2[$data['memberID']] = $pow2[$data['memberID']] + pow($data['ratingScore'] - $avg[$data['memberID']], 2); //Tổng bình phương đánh giá user khác
                }
            }
//            $Iuu = array();
//            foreach ($rate_data as $data) {
//                if (($data['memberID'] !== $memberID)&&(array_key_exists($data['bookID'], $cuser))){
//                    $Iuu[$data['memberID']][$data['bookID']] = $data['bookID'];
//                }
//            }
//            foreach ($rate_data as $data) {
//                if (($data['memberID'] !== $memberID)&&(array_key_exists($data['memberID'], $Iuu))){
//                    if (array_key_exists($data['bookID'], $Iuu[$data['memberID']])) {
//                        $cpow2[$data['memberID']] = $cpow2[$data['memberID']] + pow($data['ratingScore'] - $avg[$memberID], 2);
//                        $pow2[$data['memberID']] = $pow2[$data['memberID']] + pow($data['ratingScore'] - $avg[$data['memberID']], 2);
//                    }
//                }
//            }
            //Loại sách user từng đánh giá
            $book_id = array();
            $i = 0;
            foreach ($book_data as $data) {
                if (!array_key_exists($data['bookID'], $cuser)) {
                    $book_id[$i++]['bookID'] = $data['bookID'];
                }
            }
            $user = array();
            foreach ($user_id as $data) {
                $user[$data['memberID']] = 0;
            }
            $rui_ = array(); //rate user khác
            foreach ($rate_data as $data) {
                if ($data['memberID'] !== $memberID) {
                    if (array_key_exists($data['bookID'], $cuser)) {
                        $temp = ($data['ratingScore'] - $avg[$data['memberID']]) * ($cuser[$data['bookID']] - $avg[$memberID]);
                        $user[$data['memberID']] = $user[$data['memberID']] + $temp; //dot_x.y
                    }
                    $rui_[$data['memberID']][$data['bookID']] = $data['ratingScore'] - $avg[$data['memberID']];
                }
            }
            $sim_cos = array(); // bảng độ tương tự Pearson
            foreach ($user_id as $data) {
                if ($user[$data['memberID']] != 0) {
                    $sim_cos[$data['memberID']] = $user[$data['memberID']] / (sqrt($cpow2 * $pow2[$data['memberID']])); //Tính độ tương tự giữa các user
                }
            }
            //Lấy K user - láng giềng - của user hiện tại
            $sim_top = array();
            if (count($sim_cos) > $k) {
                $key = array_keys($sim_cos); //Bảng mã user
                $val = array_values($sim_cos); //Bảng giá trị tương tự
                rsort($val); //Sắp xếp giá trị tương tự
                $val_sim = array();
                for ($i = 0; $i < $k; $i++) {
                    $val_sim[$i] = $val[$i]; //lấy ra top K
                }
                for ($i = 0; $i < count($key); $i++) {
                    for ($j = 0; $j < $k; $j++) {
                        if ($sim_cos[$key[$i]] == $val_sim[$j]) {
                            $sim_top[$key[$i]] = $val_sim[$j];
                        }
                    }
                }
            } else {
                $sim_top = $sim_cos;
            }
            $sim_temp = $sim_top;
            $key_temp = array_keys($sim_temp);
            for ($i = 0; $i < count($key_temp); $i++) {
                if ($sim_temp[$key_temp[$i]] < 0) {
                    $sim_temp[$key_temp[$i]] = abs($sim_temp[$key_temp[$i]]);
                }
            }
            $sum_sim = array_sum($sim_temp); //Tổng sim(u,u')
            $key = array_keys($sim_top); //Danh sách user láng giềng
            $rui = array();
            foreach ($book_id as $data) {
                $ru_i = 0;
                for ($i = 0; $i < count($key); $i++) {
                    if (isset($rui_[$key[$i]][$data['bookID']])) {
                        $ru_i = $ru_i + $sim_top[$key[$i]] * $rui_[$key[$i]][$data['bookID']];
                    }
                }
                if ($ru_i != 0) {
                    $rui[$data['bookID']] = $avg[$memberID] + $ru_i / $sum_sim;
                }
            }
            $book_top = array();
            if (count($rui) > 10) {
                $book_key = array_keys($rui);
                $book_r = array_values($rui);
                rsort($book_r);
                $book_r = array_slice($book_r, 0, 10);
                $count = 0;
                for ($j = 0; $j < 10; $j++) {
                    for ($i = 0; $i < count($book_key); $i++) {
                        if ($rui[$book_key[$i]] == $book_r[$j]) {
                            $book_top[$book_key[$i]] = $book_r[$j];
                            $count++;
                        }
                        if ($count == 10) {
                            break;
                        }
                    }
                }
            } else {
                $book_top = $rui;
            }
            return array_keys($book_top);
        } else {
            $book_top = array();
            return $book_top;
        }
    }

    //Item
    public function RS_Item_func($bookID) {
        $rate = $this->RatingModel->getRateData();
        $book_id = $this->RatingModel->getBookId($bookID);
        $rate_data = array();
        $check_book = array();
        //Loại sách có ít hơn 20 đánh giá
        foreach ($book_id as $value) {
            $check_book[$value['bookID']] = $value['bookID'];
        }
        $check_book[$bookID] = $bookID;
        $tmp = 0;
        foreach ($rate as $value) {
            if (array_key_exists($value['bookID'], $check_book)) {
                $rate_data[$tmp]['memberID'] = $value['memberID'];
                $rate_data[$tmp]['bookID'] = $value['bookID'];
                $rate_data[$tmp++]['ratingScore'] = $value['ratingScore'];
            }
        }
        $book_avg = $this->RatingModel->getRateByBook();
        $avg = array();
        foreach ($book_avg as $data) {
            $avg[$data['bookID']] = $data['rate_avg'];
        }
        $cbook = array();
        $cpow2 = 0;
        foreach ($book_id as $data) {
            $pow2[$data['bookID']] = 0;
            $obook[$data['bookID']] = 0;
        }
        foreach ($rate_data as $data) {
            if ($data['bookID'] === $bookID) {
                $cbook[$data['memberID']] = $data['ratingScore'];
                $cpow2 = $cpow2 + pow($data['ratingScore'] - $avg[$bookID], 2);
            } else {
                $pow2[$data['bookID']] = $pow2[$data['bookID']] + pow($data['ratingScore'] - $avg[$data['bookID']], 2);
            }
        }
        foreach ($rate_data as $data) {
            if ($data['bookID'] != $bookID) {
                if (array_key_exists($data['memberID'], $cbook)) {
                    $temp = ($data['ratingScore'] - $avg[$data['bookID']]) * ($cbook[$data['memberID']] - $avg[$bookID]);
                    $obook[$data['bookID']] = $obook[$data['bookID']] + $temp; //dot_x.y
                }
            }
        }
        $sim_cos = array(); // bảng độ tương tự Pearson
        foreach ($book_id as $data) {
            if ($obook[$data['bookID']] != 0) {
                $sim_cos[$data['bookID']] = $obook[$data['bookID']] / (sqrt($cpow2 * $pow2[$data['bookID']])); //Tính độ tương tự giữa các user
            }
        }
        $k = 10;
        $sim_top = array();
        if (count($sim_cos) > $k) {
            $key = array_keys($sim_cos); //Bảng mã user
            $val = array_values($sim_cos); //Bảng giá trị tương tự
            rsort($val); //Sắp xếp giá trị tương tự
            $val_sim = array();
            for ($i = 0; $i < $k; $i++) {
                $val_sim[$i] = $val[$i]; //lấy ra top K
            }
            $tmp = 0;
            for ($i = 0; $i < count($key); $i++) {
                for ($j = 0; $j < $k; $j++) {
                    if ($sim_cos[$key[$i]] == $val_sim[$j]) {
                        $sim_top[$tmp++] = $key[$i];
                    }
                }
            }
        } else {
            $sim_top = array_keys($sim_cos);
        }
        return $sim_top;
    }

}
