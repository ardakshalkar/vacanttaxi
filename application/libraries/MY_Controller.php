<?php
class MY_Controller extends CI_Controller{
	var $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		if ($this->tank_auth->is_logged_in()){
			$this->load->database();
			$user = $this->db->select('users.*')->from('users')->join('user_profiles','users.id=user_profiles.user_id','left')->where('users.id',$this->session->userdata('user_id'))->get()->result();
			//print_r($user);
			//print_r($this->session->userdata('user'));
			$this->data["user"] = $user[0];
			$this->data["username"] = $this->tank_auth->get_username();
			if ($this->data["user"]->activated)
				$this->data["logged_in"] = true;
		}
		else {
			$this->data["logged_in"] = false;
		}
		$this->data['main_title'] = 'vacanttaxi.kz';
	}
}
?>
