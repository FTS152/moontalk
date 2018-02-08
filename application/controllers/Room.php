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
        else if(!empty($_POST['name'])){
            $this->load->model('room_model');
            if($this->room_model->check_name($_POST['name'])){
                $this->js_alert('此房間已存在',site_url().'room/add');
            }
            $data = array(
                'room_name' => $_POST['name'],
                'room_lock' => $_POST['lock'],
                'room_pass' => $_POST['pass'],
                );
            $this->db->insert('moontalk_room',$data);
            redirect('room/');
        }  

        $this->load->view('room_add.php');

    }

    public function check()
    {
        $this->session->set_userdata(array('password'=>$_POST['value']));
        $this->js_alert($this->session->password);
    }

    public function delete()
    {
        $this->db->where('room_id',$_GET['id']);
        $this->db->delete('moontalk_room');
        $this->db->where('chat_room',$_GET['id']);
        $this->db->delete('moontalk_chat'); 

    }
}
