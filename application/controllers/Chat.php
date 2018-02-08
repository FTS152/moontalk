<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    public function index()
    {
        if(!$this->session->login_status) $this->js_alert('尚未登入',site_url().'login');
        if(empty($this->session->username)) $this->js_alert('名稱錯誤',site_url().'login');

        $data['socket_url'] = "ws://192.168.0.105:9000/web_socket/Chat-Using-WebSocket-and-PHP-Socket-master/CI_talk/moontalk/server.php";//socket server 路徑指向
        $data['username'] = $this->session->username ;
        $data['user_colour'] = $this->session->user_colour ;
        $data['sex'] = $this->session->sex ;
        $data['head'] = $this->session->head;
        $this->load->view('chat.php',$data);
    }

    public function history()
    {
        $this->db->where('chat_room',$_GET['id']);
        $query = $this->db->get('moontalk_chat');
        $history = $query->result();
        if(!$history)
            $this->js_alert('不存在的房間！',site_url().'room');
        header('Content-Type: application/json');
        echo json_encode($history);
    }


    public function save()
    {


    }

    public function export()
    {


    }
}
