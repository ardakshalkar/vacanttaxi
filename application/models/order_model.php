<?php
class Order_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function insert_Order($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	function get_name($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		if($query->num_rows() == 1)
		{
			$data = $query->row_array();
			$name = $data['displayname']; 
			return $name;
		}
		return false;
	}
	function get_mobile($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('driver');
		if($query->num_rows() == 1)
		{
			$data = $query->row_array();
			$name = $data['m_phone']; 
			return $name;
		}
		return false;
	}
	function delete($id){
		$table = $_POST['table']."_msg";
		unset($_POST['table']);
		$this->db->delete($table,array('id'=>$id));
	}
	function update_unofficial_order($id){
		$table = $_POST['table']."_msg";
		unset($_POST['table']);
		$this->db->where('id', $id);
		$this->db->update($table, $_POST); 
	}
	function get_driver_messages(){
		$this->db->where('type', 1);
		return $this->db->get('unofficial_order')->result();
 	}
 	function get_client_messages(){
 		$this->db->where('type', 0);
 		return $this->db->get('unofficial_order')->result();
 	}
}
?>
