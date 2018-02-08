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
        if($passcheck->room_lock && $passcheck->room_pass != $this->session->password)
            $this->js_alert('密碼錯誤！',site_url().'room');

        $data['socket_url'] = "ws://192.168.1.101:9000/moontalk/server.php";//socket server 路徑指向
        $data['username'] = $this->session->username ;
        $data['user_colour'] = $this->session->user_colour ;
        $data['head'] = $this->session->head;
        $this->session->set_userdata(array('room'=>$_GET['id']));
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
            'chat_room' => $this->session->room,
            );
            $this->db->insert('moontalk_chat',$data);
    }

    public function export()
    {
        header("Content-type: application/text");
        header("Content-Disposition: attachment; filename=save.txt");
        $room = $this->session->room;
        $this->db->where('chat_room',$room);
        $query = $this->db->get('moontalk_chat');
        $history = $query->result();
        foreach($history as $row){
            echo $row->chat_user.' : '.$row->chat_msg.PHP_EOL;
        }
    }
}
