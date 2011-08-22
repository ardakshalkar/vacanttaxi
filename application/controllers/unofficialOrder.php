<?php
class UnofficialOrder extends CI_Controller
{
	function __construct()
	{
  		parent::__construct();
  		require('beaconpush.php');
  	}
 
 	function index()
 	{
  		$this->lang->load('menu');
  		$data["main_title"]="Unofficial Order";
  		$data['component'] = 'front';
  		$this->load->model("order_model");
  		
  		$beaconpush = new BeaconPush();
		$checked = (isset($_POST['taxistbox']))?true:false;
		//echo $this->session->userdata['user_id'];
		
		
		if(isset($this->session->userdata['user_id']))
		{
			$id = $this->session->userdata['user_id'];
			$name = $this->order_model->get_name($id);
			$access_token = '';
		}
		else{
			$id = 0;
			$name = $this->input->post('name');
			$this->load->helper('string');
			if ($this->input->cookie('access_token'))
				$access_token = $this->input->cookie('access_token');
			else
			{
				$access_token = random_string('unique');
				$cookie = array(
					'name'   => 'access_token',
					'value'  => $access_token,
					'expire' => '86500'
				);
				$this->input->set_cookie($cookie);
			}
		}
		$contacts = $this->input->post('contacts');
     	date_default_timezone_set('Asia/Almaty');
    	$date=unix_to_human(time(), TRUE, 'us');
    	$data = array(
			'name' => $name,
			'message' => $this->input->post('messages'),
			'contacts' => $contacts,
			//'date' => time(),//$date,
			'from'  => $this->input->post('from'),
			'to' => $this->input->post('to'),
			'user_id' => $id,
			'type' => $this->input->post('type'),
			'access_token'=> $access_token
     	);
     	$id = $this->order_model->insert_Order('unofficial_order', $data);
     	$data['id']	= $id;
     	$data['date'] = $date;
     	unset($data['access_token']);
     	$beaconpush->add_channel('taxi');
     	if ($this->input->post('type')==1)
			$beaconpush->send_to_channel('taxi','driver_msg',$data);
     	else
			$beaconpush->send_to_channel('taxi','client_msg',$data);
     	
     	//redirect('front');
     }
     function cancel_order($id){
		 $filter = array();
		 if(isset($this->session->userdata['user_id'])){
			 $filter['user_id'] = $this->session->userdata['user_id'];
		 }
		 else if ($this->input->cookie('access_token')){
			 $filter['access_token'] = $this->input->cookie('access_token');
		 }
		 $filter['id'] = $id;
		 $this->db->update('unofficial_order',array('accomplished'=>'1'),$filter);
		 redirect('front');
	 }
}
?>
