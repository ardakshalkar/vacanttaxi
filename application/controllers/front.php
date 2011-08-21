<?php 
require_once('application/libraries/MY_Controller.php');
class Front extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front_model');
		$this->load->library('form_validation');
		$this->load->library('calendar');
		$this->load->helper('language');
		$this->lang->load('menu');
	}
	
	
	# General Page
	function index()
	{
		$data = $this->data;
		$data['base_url'] = $this->config->item('base_url');
		$data['main_title'] = 'Главная';
		$data['component']	= 'front';
		$this->load->helper('url');
		$data['client_msg'] = $this->front_model->get_messages(0);
		$data['taxist_msg'] = $this->front_model->get_messages(1);
		require('beaconpush.php');
		$beaconpush = new BeaconPush();
		$data['beaconpush'] = $beaconpush;
		$this->load->view('main/index',$data);
		/*
		if(isset($this->session->userdata['user_id']))
		{
			redirect('front/driver_profile');
		}
		else{
			$data['page'] = 'login';		
			$this->load->view('main/index',$data);
		}*/
		
	}
	
	function register()
	{
		$data['image_error_message'] = NULL;
		
		if(isset($_POST["cancel"])) redirect("front/index");
		
		if(isset($_POST["send"]))
		{
				
			$bool = true;
			$image_error_message = NULL;
			$image_name = "default.png";
			$config['upload_path'] = 'style/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$this->load->model('user_model');
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
	
			if ( ! $this->upload->do_upload())
			{
				$image_error_message = $this->upload->display_errors();
				$bool = false;
			}
			else	
			{
				$image_name=$this->upload->data('file_name');
				$image_name=$image_name['file_name'];
			}
			
			
			$this->form_validation->set_rules('email','Email','required|xss_clean|valid_email');
			$this->form_validation->set_rules('login','Username','required|xss_clean');
			$this->form_validation->set_rules('name','Name','xss_clean');
			$this->form_validation->set_rules('surname','Surname','xss_clean');
			$this->form_validation->set_rules('middlename','Middle name','xss_clean');
			$this->form_validation->set_rules('address','Address','xss_clean');
			$this->form_validation->set_rules('password','Password','required|alpha_numeric|xss_clean');
			$this->form_validation->set_rules('passconf','Confirm','required|matches[password]|xss_clean');
			$this->form_validation->set_rules('h_phone','Home number','numeric|xss_clean');
			$this->form_validation->set_rules('m_phone','Mobile phone','numeric|xss_clean');
			$this->form_validation->set_rules('no_li','Name','numeric|xss_clean');
			$data = $_POST;
			if($this->form_validation->run()&& $bool)
			{
				$m = $this->input->post('birthDate_m');
				$d = $this->input->post('birthDate_d');
				$y = $this->input->post('birthDate_y');
				$date = new DateTime();
				date_default_timezone_set('Asia/Almaty');
				$date->setDate($y, $m,$d);
				$str=$date->format('Y-m-d');
				$data['dob'] = $str;
				$this->user_model->insert_userinfo($_POST);
				
				redirect("front/index");
				
			}
			else {
				$this->load->view('main/blocks/register_taxist');
			}
		}
		$data['page'] = 'register_taxist';
		$data['main_title'] = 'Registration';
		$data['component'] = 'front';
		//$this->load->view('main/index',$data);
	}
	
	function get_clients_order(){
				$this->load->model("front_model");
				$msgs = $this->front_model->get_client_msg();
				foreach ($msgs as $row){
					echo "<li><span class=\"twit_name\">".$row->name."</span><br/><span class=\"twit_message\">".$row->message."</span><br/><span class=\"twit_from\">(A) ".$row->from."</span> <span class=\"twit_to\">(B) ".$row->to."</span><span class=\"twit_contacts\">(T) ".$row->contacts."</span><br/><span class=\"twit_date\" title=\"".$row->date."\">".$row->date."</span></li>";
				}
	}
	function get_taxists_order(){
				$this->load->model("front_model");
				$msgs = $this->front_model->get_taxist_msg();
				foreach ($msgs as $row){
					echo "<li><span class=\"twit_name\">".$row->name."</span><br/><span class=\"twit_message\">".$row->message."</span><br/><span class=\"twit_from\">(A) ".$row->from."</span> <span class=\"twit_to\">(B) ".$row->to."</span><span class=\"twit_contacts\">(T) ".$row->contacts."</span><br/><span class=\"twit_date\" title=\"".$row->date."\">".$row->date."</span></li>";
				}
	}
	
	#Client Side
	function client_info()
	{
		echo $this->load->view("front/blocks/client_side");
	}
	
	function get_driver()
	{
		$id =  $this->input->post('id');
		echo $this->front_model->get_driver_info($id);
	}
	
	function get_driver2()
	{
		$id =  $this->input->post('id');
		$data['a']=$this->front_model->get_driver_info2($id);
		$data['base_url'] = $this->config->item('base_url');
		echo $this->load->view('front/blocks/forTaxi',$data);
	}
	
	function driver_profile()
	{
		$this->load->model('unofficialOrder_model');
		$id = $this->session->userdata['user_id'];
		$data = $this->data;
		$data['base_url'] = $this->config->item('base_url');
		$data['main_title'] = 'Ваш профиль';
		$data['name'] = $this->unofficialOrder_model->get_name($id);
		$data['contacts'] = $this->unofficialOrder_model->get_contact($id);
		$data['page'] = 'chat';		
		$data['component'] = 'front';
		require('beaconpush.php');
		$beaconpush = new BeaconPush();
		$data['beaconpush'] = $beaconpush;
		$data['city'] = $this->session->userdata('city');
		$this->load->view('main/index',$data);
	}
	
	function driver_edit()
	{		
		if(isset($_POST["cancel"])) redirect("front/driver_profile");
		
		if(isset($_POST["send"]))
		{				
			$this->form_validation->set_rules('login','Username','required|xss_clean');
			$this->form_validation->set_rules('fname','First name','xss_clean');
			$this->form_validation->set_rules('name','Last name','xss_clean');
			$this->form_validation->set_rules('mname','Middle name','xss_clean');
			$this->form_validation->set_rules('address','Address','xss_clean');
			$this->form_validation->set_rules('pass','Password','required|alpha_numeric|xss_clean');
			$this->form_validation->set_rules('passconf','Confirm','required|matches[pass]|xss_clean');
			$this->form_validation->set_rules('hphone','Home number','numeric|xss_clean');
			$this->form_validation->set_rules('mphone','Mobile phone','numeric|xss_clean');
			$this->form_validation->set_rules('no_li','Name','required|numeric|xss_clean');
			
			
			if($this->form_validation->run())
			{
				$login = $this->input->post('login');
				$fname = $this->input->post('name');
				$lname = $this->input->post('lname');
				$mname = $this->input->post('mname');
				$address = $this->input->post('address');
				$password = $this->input->post('pass');
				$confirm = $this->input->post('passconf');
				$hphone = $this->input->post('tel');
				$mphone = $this->input->post('cell');
				$noli = $this->input->post('no_li');
				$category = $this->input->post('category');
				$exp = $this->input->post('exp');
				$m = $this->input->post('birthDate_m');
				$d = $this->input->post('birthDate_d');
				$y = $this->input->post('birthDate_y');
				
				
				
				
				$info = array('login'=>$login,
							   'password'=>$password);
							   
				$this->front_model->update_data($this->session->userdata('user_id'),$info,'user');
				date_default_timezone_set('Asia/Almaty');
				
				$date = new DateTime();
				$date->setDate($y, $m,$d);
				$str=$date->format('Y-m-d');
				
				$info2 = array('firstname'=>$fname,
							   'lastname'=>$lname,
							   'middlename'=>$mname,
							   'dob'=>$str,
							   'address'=>$address,
							   'h_phone'=>$hphone,
							   'm_phone'=>$mphone,
							   'no_license'=>$noli,
							   'category'=>$category,
							   'experience'=>$exp);
				
				$this->front_model->update_data($this->session->userdata('user_id'),$info2,'driver');
				$data['success_message'] = "Вы успешно поменяли информацию";
				
				
			}
			
			
		}							
		$data['driver']=$this->front_model->get_driver($this->session->userdata('user_id'));
		$data['user']=$this->front_model->get_userinfo($this->session->userdata('user_id'));
		$data['base_url'] = $this->config->item('base_url');
		$data['main_title'] = 'Ваш профиль';
		$data['page'] = 'edit';		
		$this->load->view('driver/index',$data);		
	}
	
	function change_message()
	{
		$info2=array('custom_message'=>$this->input->post('message'));
		$this->front_model->update_data($this->session->userdata('user_id'),$info2,'user');
	}
	
	function submitRating()
    {
    	$rating = (int)$_POST['rating'];
        $id = (int)$_POST['id'];
        if(isset($_COOKIE['rated'.$id])) 
        {
          	echo"<div class='highlight'>You already voted</div>";
            break;
        }
        else
        {
        setcookie("rated".$id, $id, time()+60*60*24*365);
        $data['a']=$this->front_model->updateRating($id,$rating);
		$data['base_url'] = $this->config->item('base_url');
		echo $this->load->view('front/blocks/ratingDiv',$data);
		}	
	}
	
	
	function setCityOnMap($city){
		if(isset($city)){
			$this->session->set_userdata('city',$city);
			$this->input->set_cookie('city', $city,5184000);
			redirect("front/index");
		
		}
	}
	function getCityFromDb(){
		$this->load->model('front_model');
		$cities = $this->front_model->getCity();
		foreach ($cities as $row){
			echo "<li><a href = '".base_url()."/index.php/front/setCityOnMap/".$row->name."'>".$row->name."</a></li>";
		}
	}
 
 	function ajaxComment()
 	{
		$this->load->model('user_model');
  		$this->form_validation->set_rules('commentArea','Comment','required|xss_clean');
  		$this->form_validation->set_rules('nameArea','Name','xss_clean');
  		if($this->form_validation->run())
  		{
			$name = "Паленбай";
    		$msg_id = $this->input->post('id');
    		if(isset($this->session->userdata['user_id']))
    		{
    			$user_id = $this->session->userdata['user_id'];
				$name = $this->user_model->get_display_name($user_id);
    		}
    		else{ 
				$user_id = 0;
				$name = $this->input->post('nameArea');
			}
    		date_default_timezone_set('Asia/Almaty');
    		$time = time();
    		$str=unix_to_human($time, TRUE, 'us');
    		$data = array(
				'message_id' => $msg_id,
				'user_id' => $user_id,
				'name' => $name,
				'text' => $this->input->post('commentArea')
   			);
			$this->front_model->insert_userinfo($data, 'comments'); 
       		echo '<li><span class="commentator_name">'.$name.':</span><span class="comment">'.$this->input->post('commentArea').'</span><br/><span class="twit_date" title="'.$str.'">'.$str.'</span></li>';
   		}
  		else {echo $this->form_validation->error_string();}
 	}
 	function map(){
		$data = $this->data;
		$data['component'] = 'map';
		$data['main_title'] = 'Map';
		$this->load->view('main/index',$data);
	}
}
?>
