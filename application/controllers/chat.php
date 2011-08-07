<?php

class Chat extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front_model');
		require('beaconpush.php');
				
	}
	
	function start()
	{
		if(isset($this->session->userdata['user_id']))
		{$user_id=$this->session->userdata['user_id'];}
		else{$user_id=$this->session->userdata('session_id');}
		$beaconpush = new BeaconPush();
		$beaconpush->add_channel('taxi_chat');
		$data['user_id']=$user_id;
		$data['base_url'] = $this->config->item('base_url');
		$data['base_url']='Chat';
		$data['beaconpush']=$beaconpush;
		$this->load->view('driver/page/chat',$data);
	}
	
	function send_mes($id_to_send,$name,$text)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$from=$this->session->userdata['user_id'];
			//$chat_name='driver_chat';
		}else
		{
			$from=$this->session->userdata('session_id');
			
		}
			   
		$info = array('from'=>$from,
					   'to'=>$id_to_send,
					   'name'=>$name,
					   'text'=>$text,
					   //'date'=>$date
					   );
		//require('beaconpush.php');	
		$beaconpush = new BeaconPush();
		$beaconpush->add_channel('taxi_chat');  
		$this->front_model->insert_userinfo($info,'message');
		$beaconpush->send_to_user($info['to'], 'chat', $info);
	}
	
	function get()
	{
		if(isset($this->session->userdata['user_id']))
		{
			$from=$this->session->userdata['user_id'];
		}else
		{
			$from=$this->session->userdata('session_id');
			
		}
		$data = $this->front_model->getMessages($from);
		if (!isset($data)) echo "";
		else{
		foreach ($data as $row){
					echo '<li id='.$row->from.'><label class="name">'.$row->name.'</label><span class="ii">Otpr</span><a class="reply">Ответить</a></br>'.$row->text.'</li>';}
		}
	}
	
	function get_to($to)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$from=$this->session->userdata['user_id'];
		}else
		{
			$from=$this->session->userdata('session_id');
			
		}
		$data = $this->front_model->getMessages($from,$to);
		if (!isset($data)) echo "";
		else{
		foreach ($data as $row){
					echo '<li id='.$row->from.'><label class="name">'.$row->name.'</label><span class="ii">Otpr</span><a href="#" class="reply">Ответить</a></br>'.$row->text.'</li>';}
		}
	}
}
?>
