<?php
class Room_model extends CI_Model
{
	function get_hash($length){
		$code = '';
		$word = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';   //亂數內容
		$word_len = strlen($word);
		for ($i = 0; $i < $length; $i++) {
			$code .= $word[rand() % $word_len];
		}
		return $code;
	}

	function check_name($name){
		$this->db->select('room_name');
		$query = $this->db->get('moontalk_room');
		$data = $query->result();
		foreach($data as $row){
			if($row->room_name==$name) return true;
		}
		return false;
	}
}
?>