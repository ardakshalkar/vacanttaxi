<?php
require_once('application/libraries/MY_Controller.php');
class Order extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->helper('language');
		$this->lang->load('menu');
		$data = $this->data;		
		$data["main_title"]="Order";
		$data['component']	= 'order';
		$this->load->model("order_model");
		
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
				$d = $this->input->post('date');
				$h = $this->input->post('hours');
				$m = $this->input->post('mins');
				$otkuda = $this->input->post('otkuda');
				$kuda = $this->input->post('kuda');
				//echo $surname." ".$name." ".$contacts." ".$date." ".$h.":".$m." ".$otkuda."-".$kuda;
				$time = $h.":".$m;
				date_default_timezone_set('Asia/Almaty');
				$dateTime = DateTime::createFromFormat('d/m/Y', $d);
				$date = $dateTime->format('Y-m-d');
				$orders = array(
					'surname'  => $surname,
					'name'     => $name,
					'contacts' => $contacts,
					'when'     => $date,
					'time'     => $time,
					'from'     => $otkuda,
					'to'       => $kuda
				);
				$this->order_model->insert_Order('order', $orders);
				redirect('order');	
			}
		}
}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
