<?php
class UnofficialOrder extends CI_Controller
{
	function __construct()
	{
  		parent::__construct();
  	}
 
 	function index()
 	{
  		$this->lang->load('menu');
  		$data["main_title"]="Unofficial Order";
  		$data['component'] = 'front';
  		$this->load->model("order_model");
  		require('beaconpush.php');
  		$beaconpush = new BeaconPush();
		$checked = (isset($_POST['taxistbox']))?true:false;
		//echo $this->session->userdata['user_id'];
		
		
		if(isset($this->session->userdata['user_id']))
		{
			$id = $this->session->userdata['user_id'];
			$name = $this->order_model->get_name($id);
		}
		else{
			$id = 0;
			$name = $this->input->post('name');
		}
		$contacts = $this->input->post('contacts');
     	date_default_timezone_set('Asia/Almaty');
    	$date=unix_to_human(time(), TRUE, 'us');
    	$data = array(
			'name' => $name,
			'message' => $this->input->post('messages'),
			'contacts' => $contacts,
			'date' => $date,
			'from'  => $this->input->post('from'),
			'to' => $this->input->post('to'),
			'user_id' => $id,
			'type' => $this->input->post('type')
     	);
     	$this->order_model->insert_Order('unofficial_order', $data);
     	$beaconpush->add_channel('taxi');
     	if ($this->input->post('type')==1)
			$beaconpush->send_to_channel('taxi','driver_msg',$data);
     	else
			$beaconpush->send_to_channel('taxi','client_msg',$data);
     	
     	redirect('front');
     }
}
?>
