<?php

class Map extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_list()
	{
		$this->load->model('map_model');
		$data=$this->map_model->get_online_list();
		if (count($data)==0) echo "[]";
		else echo json_encode($data);
	}
	function update_position()
	{
		$user_id = $this->session->userdata("user_id");
		echo $user_id;
		if ($user_id){
			$exist = $this->db->get_where('driver_location',array('uid'=>$user_id))->num_rows();
			$data = $_GET;
			if ($exist==0){
				$data["uid"] = $user_id;
				$this->db->insert('driver_location',$data);
			}
			else{
				$this->db->where('uid',$user_id);
				$this->db->update('driver_location',$data);
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
