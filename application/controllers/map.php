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
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
