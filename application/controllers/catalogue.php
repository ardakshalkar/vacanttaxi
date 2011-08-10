<?php

require_once('application/libraries/MY_Controller.php');
class Catalogue extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->lang->load("menu");
		$this->lang->load("general");
		$this->load->library('table');
		$this->load->model("catalogue_model");
	}
	
	function index()
	{
		$this->data["main_title"]="Catalogue";
		$this->data["component"]	= 'catalogue';
		$drivers = $this->catalogue_model->loadCatalogue($this->session->userdata('city'));
		$tmpl = array('table_open'  => '<table id="catalogue">');
		$this->table->set_template($tmpl);
		$this->table->set_heading('Name','Location','Description','Phone','Car Type','','Trip type','');
		foreach ($drivers as $row){
			$cartype = "";
			if ($row->type=='6111') $cartype = lang("car");
			else if ($row->type=='6112') $cartype = lang("bus");
			else $cartype = lang('no_car_info');
			$triptype = array();
			$mask = ((int)$row->category)-5000;
			if ((int)($mask/100)==1) $triptype[0]=lang("incity");
			if ((int)($mask/10)%10==1) $triptype[1]=lang("cities");
			if ($mask%10==1) $triptype[2]=lang("suburb");
			$triptype = implode(", 	",$triptype);
			$this->table->add_row(
				array(isset($row->displayname)?$row->displayname:$row->c_name,$row->address,$row->about,$row->m_phone,$cartype,$row->type,$triptype,$row->category)
			);
		}
		$this->data["drivers"]=$this->table->generate();
		$this->load->view('main/index',$this->data);
	}
	
	function companies()
	{
		$data = $this->data;
		$data['base_url']= $this->config->item('base_url');
		$data["main_title"]="Catalogue of Companies";
		$data["component"]	= 'companies';
		$companies = $this->catalogue_model->get_companies();
		$tmpl = array('table_open'  => '<table id="companies_catalogue">');
		$this->table->set_template($tmpl);
		$this->table->set_heading('Taxi company','City','Contacts','About','Site');
		foreach ($companies as $row){
			$this->table->add_row(
				array($row->company_name,$row->name,$row->contacts,$row->about,$row->site)
			);
		}
		$data["companies"]=$this->table->generate();
		$data['city']=$this->session->userdata('city');
		$this->load->view('main/index',$data);
		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
