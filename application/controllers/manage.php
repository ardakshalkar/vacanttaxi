<?php

class Manage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
			$this->load->view('manage/index');
	}
	function catalogue()
	{
				
		$this->lang->load("menu");
		$this->lang->load("general");

		$this->load->helper(array('url','form'));
		$this->load->library('table');
		$data["main_title"]="Catalogue";
		$data["component"]	= 'catalogue_manage';
		$this->load->library('table');
		$this->load->model("catalogue_model");
		$drivers = $this->catalogue_model->loadCatalogue();
		$tmpl = array('table_open'  => '<table id="catalogue">');
		$this->table->set_template($tmpl);
		$this->table->set_heading('Name','Location','Description','Phone','Car Type','','Trip type','','Id','state');
		foreach ($drivers as $row){
			$cartype = "";
			if ($row->type=='6111') $cartype = lang("car");
			else if ($row->type=='6112') $cartype = lang("bus");
			$triptype = array();
			$mask = ((int)$row->category)-5000;
			if ($mask/100==1) $triptype[]=lang("incity");
			if ($mask/10%10==1) $triptype[]=lang("cities");
			if ($mask%10==1) $triptype[]=lang("suburb");
			$triptype = implode(", 	",$triptype);
			$this->table->add_row(
				array($row->firstname." ".$row->lastname,$row->address,$row->about,$row->m_phone,$cartype,$row->type,$triptype,$row->category,$row->id,"V")
			);
		}
		$data["city"] = $this->session->userdata("city");
		$data["drivers"]=$this->table->generate();
		$this->load->view('main/index',$data);
	}
	function catalogue_delete($id){
		$this->load->model("catalogue_model");
		$this->catalogue_model->delete($id);
		return;
	}
	function unofficial_order(){
		$this->load->library('table');
		$this->load->helper(array('url','form'));
		$data["component"]	= 'unorder_manage';
		$data["main_title"] = 'Messages';
		$this->load->model("unOfficialOrder_model");
		$driver_messages = $this->unOfficialOrder_model->get_driver_messages();
		$client_messages = $this->unOfficialOrder_model->get_client_messages();
		$tmpl = array('table_open'  => '<table class="message_table" id="driver_message">');
		$this->table->set_template($tmpl);
		$this->table->set_heading('Name','Message','contacts','date','From','To','','');
		foreach ($driver_messages as $row){
			$this->table->add_row(
				array($row->name,$row->message,$row->contacts,$row->date,$row->from, $row->to,
				"<button class='delButton' itemid='".$row->id."'>Delete</button>","<button class='editButton' itemid='".$row->id."'>Edit</button><button class='saveButton' itemid='".$row->id."'>Save</button>")
			);
		}
		
		$data["city"] = $this->session->userdata("city");
		$data["taxist_msg"]=$this->table->generate();
		$this->table->clear();
		$tmpl = array('table_open'  => '<table class="message_table" id="client_message">');
		$this->table->set_template($tmpl);
		$this->table->set_heading('Name','Message','contacts','date','From','To','','');
		foreach ($client_messages as $row){
			$this->table->add_row(
				array($row->name,$row->message,$row->contacts,$row->date,$row->from, $row->to,
				"<button class='delButton' itemid='".$row->id."'>Delete</button>","<button class='editButton' itemid='".$row->id."'>Edit</button><button class='saveButton' itemid='".$row->id."'>Save</button>")
			);
		}
		$data["client_msg"]=$this->table->generate();
		
		
		
		$this->load->view('main/index',$data);
	}
	function update_unofficial_order($id){
		$this->load->model("unOfficialOrder_model");
		$this->unOfficialOrder_model->update_unofficial_order($id);
		
	}
	
	function unofficial_delete($id){
		$this->load->model("unOfficialOrder_model");
		$this->unOfficialOrder_model->delete($id);
		return;
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
