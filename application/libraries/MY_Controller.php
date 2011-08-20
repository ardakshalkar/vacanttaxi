<?php
class MY_Controller extends CI_Controller{
	var $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		if ($this->tank_auth->is_logged_in()){
			$this->data["logged_in"] = true;
			$this->load->database();
			$user = $this->db->select('*')->from('users')->join('user_profiles','users.id=user_profiles.user_id','left')->where('users.id',$this->session->userdata('user_id'))->get()->result();
			//print_r($this->session->userdata('user'));
			$this->data["user"] = $user[0];
			$this->data["username"] = $this->tank_auth->get_username();
		}
		else {
			$this->data["logged_in"] = false;
		}
		$this->data['title'] = 'vacanttaxi.kz';
	}
}
?>
