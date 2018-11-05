<?php
class Report extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','date','text'));
        $this->load->library(array('myclass','pagination'));
        $this->load->model(array('OrderModel','FeedbackModel'));
    }
    
    public function reportDate(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Báo cáo ngày";
        $show['manager_content'] = "seller/reportDate";
        $this->load->view('manager/layout',$show);
    }
    
    public function viewDate(){
        $dateFocus = $this->input->post('dateFocus');
        $rp_date = $this->OrderModel->getOrderByDate($dateFocus);
        //status
        $data[0]['status'] = 'Chưa xử lý';
        $data[0]['qty'] = 0;
        $data[1]['status'] = 'Đang xử lý';
        $data[1]['qty'] = 0;
        $data[2]['status'] = 'Đã xử lý';
        $data[2]['qty'] = 0;
        $data[3]['status'] = 'Hủy';
        $data[3]['qty'] = 0;
        if (!empty($rp_date)){
            foreach ($rp_date as $value) {
                for($i=0;$i<4;$i++){
                    if ($data[$i]['status'] === $value['status']){
                        $data[$i]['qty'] = $value['qty_stt'];
                        break;
                    }
                }
            }
        }
        $rpd['rp_status'] = $data;
        //books
        $orderid = $this->OrderModel->getIdOrderByDate($dateFocus);
        $id = array();
        if (!empty($orderid)){
            $i = 0;
            foreach ($orderid as $value) {
                $id[$i++] = $value['orderID'];
            }
        }
        if(!empty($id)){
            $rp_book = $this->OrderModel->getOrderDetailGroupBook($id);
        }  else {
            $rp_book = array();
        }
        $rpd['rp_book'] = $rp_book;
        //FB
        $fb[0]['status'] = 'Chưa lọc';
        $fb[0]['qty'] = 0;
        $fb[1]['status'] = 'Đóng góp';
        $fb[1]['qty'] = 0;
        $fb[2]['status'] = 'Spam';
        $fb[2]['qty'] = 0;
        $rp_fb = $this->FeedbackModel->getFBByDate($dateFocus);
        if (!empty($rp_fb)){
            foreach ($rp_fb as $value) {
                if($value['ratings'] == ""){
                    $fb[0]['qty'] = $value['qty'];
                }
                for($i=1;$i<3;$i++){
                    if ($fb[$i]['status'] === $value['ratings']){
                        $fb[$i]['qty'] = $value['qty'];
                        break;
                    }
                }
            }
        }
        $rpd['rp_fb'] = $fb;
        $rpdate = $this->load->view('seller/ajax_viewDate',$rpd,true);
        $result = array('rpdate' => $rpdate);
        echo json_encode($result);
    }

//    public function download(){
//        $this->load->helper('download');
//        $data = $this->input->get('dw');
//        $name = 'Baocao'.$this->input->get('d').'.txt';
//        force_download($name,$data);
//    }
    
    public function reportMonth(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Báo cáo tháng";
        $show['manager_content'] = "seller/reportMonth";
        $this->load->view('manager/layout',$show);
    }
    
    public function viewMonth(){
        $monthFocus = trim($this->input->post('monthFocus'));
        $yearFocus = trim($this->input->post('yearFocus'));
        $month = $yearFocus.'-'.$monthFocus;
        $days = array();
        switch ($month) {
            case 2: if ($yearFocus % 4 == 0){
                    $MAX_DAYS = 29;
                } else{
                    $MAX_DAYS = 28;
                }
                break;
            case 4: $MAX_DAYS = 30;
                break;
            case 6: $MAX_DAYS = 30;
                break;
            case 9: $MAX_DAYS = 30;
                break;
            case 11: $MAX_DAYS = 30;
                break;
            default: $MAX_DAYS = 31;
                break;
        }
        for ($i=0;$i<$MAX_DAYS;$i++){
            $days[$i] = $month.'-'.($i + 1);
        }
        $rp_date = $this->OrderModel->getOrderByMonth($days);
        //status
        $data[0]['status'] = 'Chưa xử lý';
        $data[0]['qty'] = 0;
        $data[1]['status'] = 'Đang xử lý';
        $data[1]['qty'] = 0;
        $data[2]['status'] = 'Đã xử lý';
        $data[2]['qty'] = 0;
        $data[3]['status'] = 'Hủy';
        $data[3]['qty'] = 0;
        if (!empty($rp_date)){
            foreach ($rp_date as $value) {
                for($i=0;$i<4;$i++){
                    if ($data[$i]['status'] === $value['status']){
                        $data[$i]['qty'] = $value['qty_stt'];
                        break;
                    }
                }
            }
        }
        $rpd['rp_status'] = $data;
        //book
        $orderid = $this->OrderModel->getIdOrderByMonth($days);
        $id = array();
        if (!empty($orderid)){
            $i = 0;
            foreach ($orderid as $value) {
                $id[$i++] = $value['orderID'];
            }
        }
        if(!empty($id)){
            $rp_book = $this->OrderModel->getOrderDetailGroupBook($id);
        }  else {
            $rp_book = array();
        }
        $rpd['rp_book'] = $rp_book;
        //FB
        $fb[0]['status'] = 'Chưa lọc';
        $fb[0]['qty'] = 0;
        $fb[1]['status'] = 'Đóng góp';
        $fb[1]['qty'] = 0;
        $fb[2]['status'] = 'Spam';
        $fb[2]['qty'] = 0;
        $rp_fb = $this->FeedbackModel->getFBByMonth($days);
        if (!empty($rp_fb)){
            foreach ($rp_fb as $value) {
                if($value['ratings'] == ""){
                    $fb[0]['qty'] = $value['qty'];
                }
                for($i=1;$i<3;$i++){
                    if ($fb[$i]['status'] === $value['ratings']){
                        $fb[$i]['qty'] = $value['qty'];
                        break;
                    }
                }
            }
        }
        $rpd['rp_fb'] = $fb;
        $rpMonth = $this->load->view('seller/ajax_viewMonth',$rpd,true);
        $result = array('rpMonth' => $rpMonth);
        echo json_encode($result);
    }
    
    public function reportYear(){
        $show = $this->myclass->seller_default();
        $show['title'] = "Seller - Báo cáo năm";
        $show['manager_content'] = "seller/reportYear";
        $this->load->view('manager/layout',$show);
    }
}
