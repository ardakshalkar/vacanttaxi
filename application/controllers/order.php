<?php
require_once('application/libraries/MY_Controller.php');
class Order extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		require('beaconpush.php');
  		$beaconpush = new BeaconPush();
		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->helper('language');
		$this->lang->load('menu');
		$data = $this->data;		
		$data["main_title"]="Order";
		$data['component']	= 'order';
		$this->load->model("order_model");
		$data['companies']=$this->order_model->get_companies();
		$data['cities']=$this->order_model->get_cities();
		
			$this->form_validation->set_rules('surname','Surname','required|xss_clean');
			$this->form_validation->set_rules('name','Name','required|min_length[2]|xss_clean');
			$this->form_validation->set_rules('contacts','Contact','required|numeric|exact_length[11]|xss_clean');
			$this->form_validation->set_rules('otkuda','Pickup Address','required|xss_clean');
			$this->form_validation->set_rules('kuda','Drop off Address','required|xss_clean');
			$this->form_validation->set_rules('date','Date','required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{			
				$this->load->view('main/index',$data);		
			}
			else
			{
				$surname = $this->input->post('surname');
				$name = $this->input->post('name');
				$contacts = $this->input->post('contacts');
				$company_id=$this->input->post('company');
				$city_id=$this->input->post('city');
				$d = $this->input->post('date');
				$h = $this->input->post('hours');
				$m = $this->input->post('mins');
				$otkuda = $this->input->post('otkuda');
				$kuda = $this->input->post('kuda');
				$time = $h.":".$m;
				$orders = array(
					'session_id'=>$this->session->userdata['session_id'],
					'surname'  => $surname,
					'oname'     => $name,
					'contacts' => $contacts,
					'when'     => $d,
					'time'     => $time,
					'from'     => $otkuda,
					'to'       => $kuda,
					'company_id'=>$company_id,
					'city'=>$city_id
				);
				$id=$this->order_model->insert_Order('order', $orders);
				$co_name='company'.$company_id;
				$order=$this->order_model->get_data($id);
				$beaconpush->add_channel($co_name);
				$beaconpush->send_to_channel($co_name,'client_order',$order);	
				print_r($co_name);
			}
		}
}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
