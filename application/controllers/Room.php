<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

    public function index()
    {
        $query = $this->db->get('moontalk_room');
        $data = array('data' => $query->result());
        $this->load->view('room_list.php',$data);
    }

    public function add()
    {
        if(!$this->session->userdata('username'))
        {
           redirect('login/');
        }
        else if(!empty($_GET['name'])){
            $this->load->model('room_model');
            if($this->room_model->check_name($_GET['name'])){
                $this->js_alert('此房間已存在',site_url().'room/add');
            }
            $data = array(
                'room_name' => $_GET['name'],
                'room_lock' => $_GET['lock'],
                'room_pass' => $_GET['pass'],
                );
            $this->db->insert('moontalk_room',$data);
            redirect('room/');
        }  

        $this->load->view('room_add.php');

    }

    public function check()
    {
        $this->db->where('room_id',$_GET['id']);
        $query = $this->db->get('moontalk_room');
        $data = $query->result()[0];
        if($data->room_lock){
            if($data->room_pass == $_GET['pass'])
                redirect('chat/?id='.$data->room_id);
            else
                $this->js_alert('密碼錯誤！',site_url().'room');                
        }
        else
            redirect('chat/?id='.$data->room_id);

    }
}
