<?php
class Myclass {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
    }
    
    public function session_member() {
        $this->ci->load->model(array('MemberModel','TypeModel','BookModel'));

        if ($this->ci->session->userdata('logged_in')) {
            $session_data = $this->ci->session->userdata('logged_in');
            $show['login'] = "member/member_wellcome";
            $show['wellcome']['memberID'] = $session_data['id'];
            $show['wellcome']['memberName'] = $session_data['name'];
        } else if (get_cookie('rememberme')) {
            $idmember = get_cookie('rememberme');
            $result = $this->ci->MemberModel->getMemberById($idmember);
            $array = array(
                'id' => $result[0]['memberID'],
                'name' => $result[0]['memberName']
            );
            $this->ci->session->set_userdata('logged_in', $array);
            $session_data = $this->ci->session->userdata('logged_in');
            $show['login'] = "member/member_wellcome";
            $show['wellcome']['memberID'] = $session_data['id'];
            $show['wellcome']['memberName'] = $session_data['name'];
        } else {
            $show['login'] = "member/login_wellcome";
        }
        $show['menubar_main'] = 'member/menubar';
        $type = $this->ci->TypeModel->getListType();
        $show['data_menubar']['type'] = $type;
        foreach ($type as $type_data) {
            $countType[$type_data['typeID']] = $this->ci->BookModel->getTotalTypeBook($type_data['typeID']);
        }
        $show['data_menubar']['countType'] = $countType;
        return $show;
    }

    public function admin_default() {
        if ($this->ci->session->userdata('adm')) {
            $session_data = $this->ci->session->userdata('adm');
            $show['header'] = "admin/header";
            $show['name']['admin_name'] = $session_data['name'];
            return $show;
        } else {
            redirect("manager/Login/index", "refresh");
        }
    }

    public function seller_default() {
        if ($this->ci->session->userdata('sel')) {
            $session_data = $this->ci->session->userdata('sel');
            $show['header'] = "seller/header";
            $show['name']['seller_name'] = $session_data['name'];
            return $show;
        } else {
            redirect("manager/Login/index", "refresh");
        }
    }

}
