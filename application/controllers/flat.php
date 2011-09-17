<?php

require_once('application/libraries/MY_Controller.php');
class Flat extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function drivers()
	{
		$data = $this->data;
		$data['component'] = 'flat/drivers';
		$this->load->view('main/index',$data);
	}
	function passengers()
	{
		$data = $this->data;
		$data['component'] = 'flat/passengers';
		$this->load->view('main/index',$data);
	}
	function companies()
	{
		$data = $this->data;
		$data['component'] = 'flat/companies';
		$this->load->view('main/index',$data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
