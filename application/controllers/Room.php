<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

    public function index()
    {
        $this->db->where('room_hide',0);
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
                $this->js_alert('此房間已存在',site_url().'/room/add/');
            }
            $hash_code=$this->room_model->get_hash(32);
            $data = array(
                'room_name' => $_GET['name'],
                'room_hide' => $_GET['hide'],
                'room_hash' => $hash_code,
                );
            $this->db->insert('moontalk_room',$data);
            redirect('room/');
        }  

        $this->load->view('room_add.php');

    }
}
