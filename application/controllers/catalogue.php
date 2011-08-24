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
		$this->data["main_title"]="Каталог";
		$this->data["component"]	= 'catalogue';
		$drivers = $this->catalogue_model->loadCatalogue($this->session->userdata('city'));
		$tmpl = array('table_open'  => '<table id="catalogue">');
		$this->table->set_template($tmpl);
		$this->table->set_heading('Имя','Позиция','Описание (услуги, цены, тип)','Телефон','Машина','','Тип услуг','');
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
		if ($this->data['logged_in']){
			$presence = $this->catalogue_model->is_present_in_catalogue($this->data['user']->id);
			if (!$presence) 
				$this->data['message'] = "Если вы хотите добавить данные о себе в каталог, Заполните <a href='".base_url()."index.php/auth/edit_driver'>форму</a>";
		}
		else
			$this->data['message'] = "Если вы хотите добавить данные о себе в каталог, Зарегистрируйтесь";
		$this->data["drivers"]=$this->table->generate();
		$this->load->view('main/index',$this->data);
	}
	
	function companies()
	{
		$data = $this->data;
		$data['base_url']= $this->config->item('base_url');
		$data["main_title"]="Каталог Компаний";
		$data["component"]	= 'companies';
		$companies = $this->catalogue_model->get_companies();
		$data['city']=$this->session->userdata('city');
		$data['companies'] = $companies;
		$this->load->view('main/index',$data);
		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
