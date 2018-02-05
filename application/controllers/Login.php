<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
    /**
     * 登入頁
     */
    public function index()
    {
        $this->load->view('login');
    }

    /**
     * 登入驗證
     */
    public function check(){
        echo '資料驗證中......';
        $username = $this->input->post('user');
        $password = $this->input->post('passwd');
        $head = $this->input->post('head');

        if(empty($username)) $this->js_alert('未輸入名稱');
        if(mb_strlen($username)<4) $this->js_alert('名稱至少4個字');
        if(empty($head)) $this->js_alert('未選擇頭像');

        //顏色
        $colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
        $index= array_rand($colours);
        $user_colour = $colours[$index];

        //使用者名稱存成SESSION
        $session_data=array(
            'username'  => $username,
            'login_status' => true,
            'user_colour' => $user_colour,
            'head' => $head,
        );
        $this->session->set_userdata($session_data);

        header("location:".site_url()."room");
    }

    /**
     * 登入驗證
     */
    public function logout(){
        echo '登出中......';
        $session_data=array('username','login_status','user_colour');


        $this->session->unset_userdata($session_data);
        if(empty($this->session->username) && empty($this->session->login_status)){
            $this->js_alert('登出成功',site_url().'login');
        }

    }
}
