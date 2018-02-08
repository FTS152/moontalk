<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    public function index()
    {
        if(!$this->session->login_status) $this->js_alert('尚未登入',site_url().'login');
        if(empty($this->session->username)) $this->js_alert('名稱錯誤',site_url().'login');
        $this->db->where('room_id',$_GET['id']);
        $query = $this->db->get('moontalk_room');
        $passcheck = $query->result()[0];
        if($passcheck->room_pass != $this->session->password)
            redirect(site_url().'room');

        $data['socket_url'] = "ws://192.168.0.105:9000/web_socket/Chat-Using-WebSocket-and-PHP-Socket-master/CI_talk/moontalk/server.php";//socket server 路徑指向
        $data['username'] = $this->session->username ;
        $data['user_colour'] = $this->session->user_colour ;
        $data['head'] = $this->session->head;
        $this->load->view('chat.php',$data);
    }

    public function history()
    {
        $this->db->where('room_id',$_GET['id']);
        $query = $this->db->get('moontalk_room');
        $room = $query->result();
        if(!$room)
            $this->js_alert('不存在的房間！',site_url().'room');
        $this->db->where('chat_room',$_GET['id']);
        $query = $this->db->get('moontalk_chat');
        $history = $query->result();
        echo json_encode($history);
    }


    public function save()
    {
        $data = array(
            'chat_user' => $this->session->username,
            'chat_color' => $this->session->user_colour,
            'chat_head' => $this->session->head,
            'chat_msg' => $_GET['msg'],
            'chat_room' => $_GET['room'],
            );
            $this->db->insert('moontalk_chat',$data);
    }

    public function export()
    {
        header("Content-type: application/text");
        header("Content-Disposition: attachment; filename=save.txt");
        $this->db->where('chat_room',$_GET['id']);
        $query = $this->db->get('moontalk_chat');
        $history = $query->result();
        echo json_encode($history);         

    }
}
