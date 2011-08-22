<?php
class Backend extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('backend_model');	
		$this->load->library('form_validation');
		$this->lang->load("general");
		$this->load->library('table');
		require('beaconpush.php');
		session_start();	
	}
	
	function login($logout = NULL)
	{
		# The message that will occur when user doesn't exist, or something else
		$message_type = 0;
		$messages = array("","Имя пользователя либо пароль неверны",
						  "Ваш аккаунт заблокирован!",
						  "Ваш аккаунт будет заблокирован!");
						  
		$data['admin_log_message'] = "";
		
		# Logout
		if(isset($logout))
		{ 
			if(isset($this->session->userdata['admin_id']))
			{
				$_SESSION['login_times'] = 0;
				$this->backend_model->do_online($this->session->userdata['admin_id'],0,ADMIN_TABLE);
				$this->session->sess_destroy();  
			}
		}
		
		# If the user has already authorized...
		if(isset($this->session->userdata['admin_id'])) { redirect('backend/index'); }
		
		# Login
		if(isset($_POST['admin_log_username']) && isset($_POST['admin_log_password']))
		{
			
			# For security ( xss attack )
			$this->form_validation->set_rules('admin_log_username','Username','xss_clean');
			$this->form_validation->set_rules('admin_log_password','Password','xss_clean');
			
			if($this->form_validation->run())
			{
				$username = $this->input->post('admin_log_username');
				$password = $this->input->post('admin_log_password');
				
				$result = $this->backend_model->check_backend_login($username,$password);
				
				if($result)
				{
					if($result['status'] == '0')
					{
						$_SESSION['login_times'] = 0;
						$this->session->set_userdata('admin_id',$result['user_id']);
						$this->session->set_userdata('admin_username',$result['username']);
						$this->session->set_userdata('admin_type',$result['type']);
						
						$this->backend_model->do_online($result['user_id'],1,ADMIN_TABLE);
						redirect('backend/index');
					}else
					{
						$message_type = 2;
					}
				}else
				{
					$message_type = 1;
					if(strlen($this->input->post('admin_log_username')) > 0)
					{
						if(!isset($_SESSION['login_times']))
							$_SESSION['login_times'] = 1;
						$_SESSION['login_times']++;
					}
				}
										
				$data['admin_log_message'] = $messages[$message_type];			
			}
		}
		
		if(isset($_SESSION['login_times']))
		{
			if($_SESSION['login_times'] > 3)
			{
				$username = $this->input->post('admin_log_username');
				if(strlen($username) > 0)
					$this->backend_model->do_blocked($username,array('blocked'=>1),ADMIN_TABLE);
			}
		}
		
		$data += $this->backend_model->general();
											
		$this->load->view('backend/login',$data);
	}
	
	# General Admin Page
	function index()
	{
		if(isset($this->session->userdata['admin_id']))
		{
			$data = $this->backend_model->general();
			$menu_items=NULL;
			if($this->session->userdata['admin_type'] >= ADMIN)
			{
			$menu_items = array('backend/manage_cities'=>'Посмотр Городов',
								'backend/manage_un_orders'=>'Просмотр Заказов');
			}
			$data += $this->backend_model->page_info('page/main-content','Бакенд',$menu_items);							
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	#FOR ADMIN PART
		
	#Manage unofficial orders
	function manage_un_orders($id = 0)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] >= ADMIN)
		{
			if($id > 0)
			{
				$this->backend_model->delete_userinfo($id,UNOFFICIAL_ORDER_TABLE);
				redirect("backend/manage_categories");
			}	
			
			$data = $this->backend_model->general();

			$menu_items = array('backend/manage_cities'=>'Просмотр Городов',
								'backend/manage_un_orders'=>'Просмотр Заказов',
								'backend/add_un_order'=>'Новый заказ');
								
			$data += $this->backend_model->page_info('page/manage_un_orders','Просмотр Заказов',$menu_items);
			$data['orders'] = $this->db->get(UNOFFICIAL_ORDER_TABLE);
													
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	function edit_un_order($id)
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= ADMIN)
		{
			if(isset($_POST['cancel'])) redirect("backend/manage_un_orders");
			
			if(isset($_POST['submit']))
			{	
				$this->form_validation->set_rules('edit_name','Name',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
				$this->form_validation->set_rules('edit_message','Message',
												'required|xss_clean');
												
				$this->form_validation->set_rules('edit_contacts','Contacts',
												'required|alpha_numeric|min_length[6]|xss_clean');
												
				$this->form_validation->set_rules('edit_from','From',
												'required|alpha_numeric|xss_clean');
												
				$this->form_validation->set_rules('edit_to','to',
												'required|alpha_numeric|xss_clean');
												
				$this->form_validation->set_rules('edit_type','Type',
												'required|number|xss_clean');
												
																
				if($this->form_validation->run())
				{
				$name = $this->input->post('edit_name');
     			$contacts = $this->input->post('edit_contacts');
     			$from = $this->input->post('edit_from');
     			$to = $this->input->post('edit_to');
     			$messages = $this->input->post('edit_message');
     			$type = $this->input->post('edit_type');
     			$info1 = array(
      					'name' => $name,
      					'message' => $messages,
      					'contacts' => $contacts,
      					'from'  => $from,
      					'to' => $to,
      					'type' => $type
     					);
											   	
				$this->backend_model->update_userinfo($id,$info1,UNOFFICIAL_ORDER_TABLE);
								
				redirect("backend/manage_un_orders");
				}			
			}
			
			$data = $this->backend_model->general();
			
			$menu_items = array('backend/manage_cities'=>'Посмотр Городов',
								'backend/manage_un_orders'=>'Просмотр Заказов',
								'backend/add_un_order'=>'Новый заказ');
									
			$data += $this->backend_model->page_info('page/edit_un_order','Редактировать',$menu_items);
			$data['order'] = $this->backend_model->get_userinfo($id,UNOFFICIAL_ORDER_TABLE);									
			$data['id'] = $id;										
			$this->load->view('backend/index',$data);
		}
		else
		{
			redirect("backend/login");
		}
	}
	
	function add_un_order()
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= ADMIN)
		{
			if(isset($_POST['cancel'])) redirect("backend/manage_un_orders");
			
			if(isset($_POST['submit']))
			{	
				$this->form_validation->set_rules('add_name','Name',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
				$this->form_validation->set_rules('add_message','Message',
												'required|xss_clean');
												
				$this->form_validation->set_rules('add_contacts','Contacts',
												'required|alpha_numeric|min_length[6]|xss_clean');
												
				$this->form_validation->set_rules('add_from','From',
												'required|alpha_numeric|xss_clean');
												
				$this->form_validation->set_rules('add_to','to',
												'required|alpha_numeric|xss_clean');
												
				$this->form_validation->set_rules('add_type','Type',
												'required|number|xss_clean');
												
																
				if($this->form_validation->run())
				{
				$name = $this->input->post('add_name');
     			$contacts = $this->input->post('add_contacts');
     			$from = $this->input->post('add_from');
     			$to = $this->input->post('add_to');
     			$messages = $this->input->post('add_message');
     			$type = $this->input->post('add_type');
     			$info1 = array(
      					'name' => $name,
      					'message' => $messages,
      					'contacts' => $contacts,
      					'from'  => $from,
      					'to' => $to,
      					'type' => $type
     					);
											   	
				$this->backend_model->insert_userinfo($info1,UNOFFICIAL_ORDER_TABLE);
								
				redirect("backend/manage_un_orders");
				}			
			}
			
			$data = $this->backend_model->general();
			
			$menu_items = array('backend/manage_cities'=>'Посмотр Городов',
								'backend/manage_un_orders'=>'Просмотр Заказов',
								'backend/add_un_order'=>'Новый заказ');
									
			$data += $this->backend_model->page_info('page/add_un_order','Добавить',$menu_items);									
			$this->load->view('backend/index',$data);
		}
		else
		{
			redirect("backend/login");
		}
	}
	
	# Manage Administrators (SUPERADMIN, ADMIN)
	function manage_admin_users($type,$id = 0)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == SUPERADMIN)
		{
			if($id > 0)
			{
				$this->backend_model->delete_userinfo($id,ADMIN_TABLE);
			}
			
			$data = $this->backend_model->general();

			$menu_items = array('backend/manage_admin_users/'.SUPERADMIN=>'Супер Администраторы',
								'backend/manage_admin_users/'.ADMIN=>'Администраторы');
								
			$data += $this->backend_model->page_info('page/manage_admin_users',
												'Administrators',$menu_items);
												
			$data['query'] = $this->backend_model->get_users($type,ADMIN_TABLE);
			
							
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# Manage one user, Edit
	function manage_admin_user($type,$id)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == SUPERADMIN)
		{
			if(isset($_POST['edit']))
			{
				if(isset($_POST['save']))
				{
					$this->form_validation->set_rules('edit_username','Username',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
					$this->form_validation->set_rules('edit_email','Email',
												'required|valid_email|xss_clean');
												
					$this->form_validation->set_rules('edit_type','Type','xss_clean');
					
					if($this->form_validation->run())
					{
						$username = $this->input->post('edit_username');
						$email = $this->input->post('edit_email');
						$type = $this->input->post('edit_type');
						$category = $this->input->post('edit_category',0);
						
						$info = array('username'=>$username,
									  'email'=>$email,
									  'type'=>$type,
									  'category'=>$category);
									  
						$this->backend_model->update_userinfo($id,$info,ADMIN_TABLE);
						redirect('backend/manage_admin_users/'.$type);
					}
				}
				
				if(isset($_POST['cancel']))
				{
					redirect('backend/manage_admin_users/'.$type);
				}
			}
			$data = $this->backend_model->general();

			$menu_items = array('backend/manage_admin_users/'.SUPERADMIN=>'Супер Администраторы',
								'backend/manage_admin_users/'.ADMIN=>'Администраторы');
								
			$data += $this->backend_model->page_info('page/manage_admin_user',
											'Администраторы',$menu_items);
											
			$data['userinfo'] = $this->backend_model->get_userinfo($id,ADMIN_TABLE);						
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	function view_admin_user($type,$id)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == SUPERADMIN)
		{
			$data = $this->backend_model->general();

			$menu_items = array('backend/manage_admin_users/'.SUPERADMIN=>'Супер Администраторы',
								'backend/manage_admin_users/'.ADMIN=>'Администраторы');
								
			$data += $this->backend_model->page_info('page/view_admin_user',
													'Администраторы',$menu_items);
													
			$data['userinfo'] = $this->backend_model->get_userinfo($id,ADMIN_TABLE);						
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	function add_admin_user()
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == SUPERADMIN)
		{	
			# Add new user
			if(isset($_POST['add']))
			{
				if(isset($_POST['save']))
				{
					$this->form_validation->set_rules('add_username','Username',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
					$this->form_validation->set_rules('add_email','Email',
												'required|valid_email|xss_clean');
												
					$this->form_validation->set_rules('add_password','Password',
												'required|xss_clean');
					
					$this->form_validation->set_rules('add_confirm','Confirm',
												'required|matches[add_password]|xss_clean');							
					
					
					if($this->form_validation->run())
					{
						$username = $this->input->post('add_username');
						$email = $this->input->post('add_email');
						$type = $this->input->post('add_type');
						$category = $this->input->post('add_category',0);
						
						$info = array('username'=>$username,
									  'email'=>$email,
									  'type'=>$type,
									  'category'=>$category);
									  
						$this->backend_model->insert_userinfo($info,ADMIN_TABLE);
						redirect('backend/manage_admin_users/0');
					}
				}
				
				if(isset($_POST['cancel']))
				{
					redirect('backend/manage_admin_users/0');
				}
			}	
			$data = $this->backend_model->general();

			$menu_items = array('backend/manage_admin_users/'.SUPERADMIN=>'Супер Администраторы',
								'backend/manage_admin_users/'.ADMIN=>'Администраторы');
								
			$data += $this->backend_model->page_info('page/add_admin_user',
													'Добавить пользователя',$menu_items);							
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# Manage Users (DRIVER,DISPATCHER,COMPANY)
	function manage_users($type = 0)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] >= ADMIN)
		{
			$data = $this->backend_model->general();

			$menu_items = array('backend/manage_companies/'=>'Компании',
								'backend/manage_dispatchers/'=>'Диспетчеры',
								'backend/manage_drivers/'=>'Водители');
			if($type == 0)
			{
				$data['query'] = true;
			}else
			{
				$data['query'] = $this->backend_model->get_users($type,USER_TABLE);	
			}
						
			$data += $this->backend_model->page_info('page/manage_users',
													'Управление пользователями',$menu_items);
												
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	function manage_dispatchers($id = 0)
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= COMPANY)
		{
			if($id > 0)
			{
				$this->backend_model->delete_userinfo($id,ADMIN_TABLE);
				$this->backend_model->delete_users(array('user_id'=>$id),DISPATCHER_TABLE);
				redirect("backend/manage_dispatchers");
			}
			
			$data = $this->backend_model->general();

			$menu_items = array('backend/add_dispatcher'=>'Добавить диспетчера',
								'backend/manage_dispatchers'=>'Все диспетчера');
									
			$data += $this->backend_model->page_info('page/manage_dispatchers',
													'Управление Диспетчерами',$menu_items);
			if($this->session->userdata['admin_type'] == COMPANY)
			{
			$c_id = $this->backend_model->get_cid($this->session->userdata['admin_id']);
			$data['dispatchers'] = $this->backend_model->return_users(array('company_id'=>$c_id),DISPATCHER_TABLE);	
			}else										
			$data['dispatchers'] = $this->backend_model->all(DISPATCHER_TABLE);									
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	function add_dispatcher()
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= COMPANY)
		{
			if(isset($_POST['add_dispatcher']))
			{
				# If cancel was pressed
				if(isset($_POST['cancel']))
					redirect("backend/manage_dispatchers");
					
				$this->form_validation->set_rules('add_username','Username',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
				$this->form_validation->set_rules('add_email','Email',
												'required|valid_email|xss_clean');		
																		
				$this->form_validation->set_rules('add_password','Password',
												'required|alpha_numeric|min_length[3]|xss_clean');
												
				$this->form_validation->set_rules('add_confirm','Confirm',
												'mathces[add_password]|xss_clean');
												
				$this->form_validation->set_rules('add_name','Name',
												'required|alpha_numeric|min_length[3]|xss_clean');
												
				$this->form_validation->set_rules('add_company','Company',
												'numeric|xss_clean');
												
				$this->form_validation->set_rules('add_phone','Phone',
												'required|numeric|min_length[6]|xss_clean');
				$this->form_validation->set_rules('add_mode','Mode',
												'required|numeric|xss_clean');								
				if($this->form_validation->run())
				{
					$username = $this->input->post('add_username');
					$email = $this->input->post('add_email');
					$password = $this->input->post('add_password');
					$type = DISPATCHER;
					$name = $this->input->post('add_name');
					$company_id = $this->input->post('add_company');
					$phone=$this->input->post('add_phone');
					$mode=$this->input->post('add_mode');
					# For admins table
					$info1 = array('username'=>$username,
								  'email'=>$email,
								  'password'=>$password,
								  'type'=>$type);
					
					$this->backend_model->insert_userinfo($info1,ADMIN_TABLE);
					$id = $this->db->query("SELECT id FROM ".ADMIN_TABLE." WHERE username='".$username."'");	
					$id = $id->row_array();
					# For dispatchers table, profiles
					if($this->session->userdata['admin_type'] == COMPANY)
					$company_id= $this->backend_model->get_cid($this->session->userdata['admin_id']);
					
					$info2 = array('user_id'=>$id['id'],
								   'dname'=>$name,
								   'company_id'=>$company_id,
								   'phone'=>$phone,
								  'mode'=>$mode );
								   
					//dobavit' rezhim raboty
								   
					$this->backend_model->insert_userinfo($info2,DISPATCHER_TABLE);
					redirect("backend/manage_dispatchers");
				}				
			}
			$data = $this->backend_model->general();

			$menu_items = array('backend/add_dispatcher'=>'Добавить Диспетчера',
								'backend/manage_dispatchers'=>'Все Диспетчера');
									
			$data += $this->backend_model->page_info('page/add_dispatcher',
													'Добавить Диспетчера',$menu_items);
			if($this->session->userdata['admin_type'] >= ADMIN)
			$data['companies']=$this->backend_model->get_companies_list();									
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# Edit Dispatcher
	function edit_dispatcher($id=0)
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= DISPATCHER)
		{
			if($this->session->userdata['admin_type'] == DISPATCHER)
			{
				$id=$this->session->userdata['admin_id'];
				$menu_items=NULL;
			}
			else 
			{
				$menu_items = array('backend/add_dispatcher'=>'Добавить Диспетчера',
								'backend/manage_dispatchers'=>'Все Диспетчера');
			}
			if(isset($_POST['edit_dispatcher']))
			{
				# If cancel was pressed
				if(isset($_POST['cancel']))
					redirect("backend/manage_dispatchers");
					
				$this->form_validation->set_rules('edit_username','Username',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
				$this->form_validation->set_rules('edit_email','Email',
												'required|valid_email|xss_clean');		
																		
				$this->form_validation->set_rules('edit_password','Password',
												'required|alpha_numeric|min_length[3]|xss_clean');
												
				$this->form_validation->set_rules('edit_confirm','Confirm',
												'mathces[add_password]|xss_clean');
												
				$this->form_validation->set_rules('edit_name','Name',
												'required|alpha_numeric|min_length[3]|xss_clean');
												
				$this->form_validation->set_rules('edit_company','Company',
												'numeric|xss_clean');
												
				$this->form_validation->set_rules('edit_phone','Phone',
												'required|numeric|min_length[6]|xss_clean');
				$this->form_validation->set_rules('edit_mode','Mode',
												'required|numeric|xss_clean');	
												
				if($this->form_validation->run())
				{
					$username = $this->input->post('edit_username');
					$email = $this->input->post('edit_email');
					$password = $this->input->post('edit_password');
					$name = $this->input->post('edit_name');
					$company_id = $this->input->post('edit_company');
					$phone=$this->input->post('edit_phone');
					$mode=$this->input->post('edit_mode');
					
					# For admins table
					$info1 = array('username'=>$username,
								  'email'=>$email,
								  'password'=>$password,
								  );
					
					# For dispatcher table, profiles
					if($this->session->userdata['admin_type'] == COMPANY)
						$company_id= $this->backend_model->get_cid($this->session->userdata['admin_id']);
						
					if($this->session->userdata['admin_type'] >= COMPANY)
					{
						$info2 = array('dname'=>$name,
								   'company_id'=>$company_id,
								   'phone'=>$phone,
								   'mode'=>$mode);
					}else if($this->session->userdata['admin_type'] == DISPATCHER)
					{				
						$info2 = array('name'=>$name,
								   'phone'=>$phone,
								   'mode'=>$mode);
					}
					
					$this->backend_model->update_userinfo($id,$info1,ADMIN_TABLE);	   
					$this->backend_model->update_userinfo_1(array('user_id'=>$id),$info2,DISPATCHER_TABLE);
					redirect("backend/manage_dispatchers");
				}				
			}
			$data = $this->backend_model->general();
			$data['id']  = $id;
			$data['info1'] = $this->backend_model->get_userinfo($id,ADMIN_TABLE);
			$data['info2'] = $this->backend_model->return_userinfo(array('user_id'=>$id),DISPATCHER_TABLE);
			
			
			if($this->session->userdata['admin_type'] >= ADMIN)
				$data['companies']=$this->backend_model->get_companies_list();
										
			$data += $this->backend_model->page_info('page/edit_dispatcher',
													'Добавить диспетчера',$menu_items);
												
			$this->load->view('backend/index',$data);
			}else
			{
				redirect('backend/login');
			}
		}
		
		#  For view info about Dispatcher
		function view_dispatcher($id)
		{
			if(isset($this->session->userdata['admin_id']) &&
				($this->session->userdata['admin_type'] == SUPERADMIN || 
						$this->session->userdata['admin_type'] == COMPANY))
			{
			$data = $this->backend_model->general();

			$menu_items = array('backend/add_dispatcher'=>'Добавить диспетчера',
								'backend/manage_dispatchers'=>'Все диспетчера');
								
			$data += $this->backend_model->page_info('page/view_dispatcher',
													'Диспетчеры',$menu_items);
													
			$data['id']  = $id;			
			$data['userinfo1'] = $this->backend_model->get_userinfo($id,ADMIN_TABLE);
			$data['userinfo2'] = $this->backend_model->return_userinfo(array('user_id'=>$id),DISPATCHER_TABLE);
			
			$this->load->view('backend/index',$data);
			}else
			{
				redirect('backend/login');
			}
		}
		
	function manage_drivers($id = 0)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] >= ADMIN)
		{
			# Delete user
			if($id > 0)
			{
				$this->backend_model->delete_userinfo($id,USER_TABLE);
				$this->backend_model->delete_users(array('user_id'=>$id),DRIVER_TABLE);
				$this->backend_model->delete_users(array('driver_id'=>$id),DRIVER_TO_COMPANY_TABLE);
				redirect("backend/manage_drivers");
			}
				
			$data = $this->backend_model->general();
			$menu_items = array('backend/add_driver'=>'Добавить Водителя',
								'backend/manage_drivers'=>'Все Водители');
									
			$data += $this->backend_model->page_info('page/manage_drivers',
													'Управление водителями',$menu_items);
			$data['users'] = $this->backend_model->all(USER_TABLE);
												
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# Add a new driver
	function add_driver()
	{
		$data['image_error_message'] = NULL;
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= ADMIN)
		{
			if(isset($_POST['add_driver']))
			{
				if(isset($_POST['cancel'])) redirect("backend/manage_employees");
				
				$config['upload_path'] = '/home/saltanat/projects/VacanTaxi/style/uploads/'; 
                $config['allowed_types'] = 'jpg|png|gif|jpeg';
				$config['max_size']    = '1000'; 
				$config['max_width']  = '1024'; 
				$config['max_height']  = '768'; 
            
                $this->load->library('upload', $config);
			
				$bool = true;
				$image_error_message = NULL;
				$image_name = "style/user_images/default.png";
				
				if($this->upload->do_upload())
				{				
					$image_name = $this->upload->data('file_name');
					$image_name = "style/user_images/".$image_name['file_name'];
				}else
				{
					$bool = false;
					$data['image_error_message'] = $this->upload->display_errors();
				}
				
				$this->form_validation->set_rules('add_username','Username','required|alpha_numeric');
				
				if($this->form_validation->run() && $bool)
				{
				$info1 = array('username'=>$this->input->post('add_username'),
							   'email'=>$this->input->post('add_email'),
							   'password'=>$this->input->post('add_password'));
				
				$this->backend_model->insert_userinfo($info1,USER_TABLE);
				
				$user_id = $this->db->query("SELECT `id` FROM ".USER_TABLE." WHERE `username`='".$this->input->post('add_username')."'");
				$user_id = $user_id->row_array();
				
				$info2 = array(
				      'user_id'=>$user_id['id'],
					  'c_name'=>$this->input->post('add_cname'),
					  'photo'=>$image_name,
					  'city'=>$this->input->post('add_city'),
					  'category'=>$this->input->post('add_category'),
					  'schedule'=>$this->input->post('add_schedule'),
					  'experience'=>$this->input->post('add_experience'),
					  'address'=>$this->input->post('add_address'),
					  'smoke'=>$this->input->post('add_smoke'),
					  'status'=>$this->input->post('add_status'),
					  'h_phone'=>$this->input->post('add_home_phone'),
					  'm_phone'=>$this->input->post('add_mobile_phone'),
					  'about'=>$this->input->post('add_about'));
					  
				$this->backend_model->insert_userinfo($info2,DRIVER_TABLE);
				redirect("backend/manage_drivers");							
				}
			}
			$data += $this->backend_model->general();

			$menu_items = array('backend/add_driver'=>'Добавить Водителя',
								'backend/manage_drivers'=>'Все Водители');
									
			$data += $this->backend_model->page_info('page/add_driver',
													'Добавить Водителя',$menu_items);
													
			$data['city_list'] = $this->backend_model->get_cities();
												
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	function edit_driver($id)
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= ADMIN)
		{
			if(isset($_POST['edit_driver']))
			{
				if(isset($_POST['cancel'])) redirect("backend/manage_drivers");
				
				$this->form_validation->set_rules('edit_username','Username','required|alpha_numeric');
				if($this->form_validation->run())
				{
								
				$info1 = array('username'=>$this->input->post('edit_username'),
							   'email'=>$this->input->post('edit_email'),
							   'password'=>$this->input->post('edit_password'));
				
				$this->backend_model->update_userinfo($id,$info1,USER_TABLE);
				
				$info2 = array(
					  'c_name'=>$this->input->post('edit_cname'),
					  'city'=>$this->input->post('edit_city'),
					  'category'=>$this->input->post('edit_category'),
					  'schedule'=>$this->input->post('edit_schedule'),
					  'experience'=>$this->input->post('edit_experience'),
					  'address'=>$this->input->post('edit_address'),
					  'smoke'=>$this->input->post('edit_smoke'),
					  'status'=>$this->input->post('edit_status'),
					  'h_phone'=>$this->input->post('edit_home_phone'),
					  'm_phone'=>$this->input->post('edit_mobile_phone'),
					  'about'=>$this->input->post('edit_about'));
							   
				$this->backend_model->update_userinfo_1(array('user_id'=>$id),$info2,DRIVER_TABLE);
				redirect("backend/manage_drivers");
				}
				
			}	
			
			$data = $this->backend_model->general();

			$menu_items = array('backend/add_driver'=>'Добавить Водителя',
								'backend/manage_drivers'=>'Все Водители');
									
			$data += $this->backend_model->page_info('page/edit_driver',
													'Редактировать водителя',$menu_items);
			$profile = $this->db->get_where('user_profiles',array('user_id'=>$id))->result();
			$profile = $profile[0];
			$data['profile'] = $profile;
			$data['info1'] = $this->backend_model->get_userinfo($id,USER_TABLE);
			$data['info2'] = $this->backend_model->return_userinfo(array('user_id'=>$id),DRIVER_TABLE);										
			$data['city_list'] = $this->backend_model->get_cities();
			$data['id']=$id;									
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# For view info about driver
	function view_driver($id)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] >= ADMIN)
		{
		$data = $this->backend_model->general();

		$menu_items = array('backend/add_driver'=>'Добавить работника',
								'backend/manage_drivers'=>'Все работники');
							
		$data += $this->backend_model->page_info('page/view_driver',
												'Водитель',$menu_items);
												
		$data['userinfo1'] = $this->backend_model->get_userinfo($id,USER_TABLE);
		$data['userinfo2'] = $this->backend_model->return_userinfo(array('user_id'=>$id),DRIVER_TABLE);
		
		$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
		
	# Manage Companies
	function manage_companies($id = 0)
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= ADMIN)
		{
			if($id > 0)
			{
				$this->backend_model->delete_userinfo($id,ADMIN_TABLE);
				$this->backend_model->delete_users(array('user_id'=>$id),COMPANY_TABLE);
				$id2 = $this->db->query("SELECT user_id FROM ".DISPATCHER_TABLE." WHERE company_id='".$id."'");
				if(isset($id2))	$this->backend_model->delete_userinfo($id,ADMIN_TABLE);
				$this->backend_model->delete_users(array('company_id'=>$id),DISPATCHER_TABLE);
				$this->backend_model->delete_users(array('company_id'=>$id),DRIVER_TO_COMPANY_TABLE);
//driver to company, udalyat' teh chto byli dobavleny companiyami
				
				redirect("backend/manage_companies");
			}
			$data = $this->backend_model->general();

			$menu_items = array('backend/add_company'=>'Добавить Компанию',
								'backend/manage_companies'=>'Все Компании');
									
			$data += $this->backend_model->page_info('page/manage_companies',
													'Управление компаниями',$menu_items);
			$data['users'] = $this->backend_model->get_users(COMPANY,ADMIN_TABLE);
												
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# Add a new Company
	function add_company()
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= ADMIN)
		{
			if(isset($_POST['add_company']))
			{
				# If cancel was pressed
				if(isset($_POST['cancel'])) redirect('backend/manage_company');
				
				$this->form_validation->set_rules('add_username','Username',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
				$this->form_validation->set_rules('add_email','Email',
												'required|valid_email|xss_clean');
												
				$this->form_validation->set_rules('add_password','Password',
												'required|alpha_numeric|min_length[3]|xss_clean');
												
				$this->form_validation->set_rules('add_confirm','Confirm',
												'required|mathces[add_password]|xss_clean');
												
				$this->form_validation->set_rules('add_name','Company Name',
												'required|min_length[4]|xss_clean');
				
				$this->form_validation->set_rules('add_driver_max','Driver Amount',
												'number|max_length[3]|xss_clean');
				
				$this->form_validation->set_rules('add_dispatcher_max','Dispatcher Amount',
												'number|max_length[3]|xss_clean');
				$this->form_validation->set_rules('add_city','City',
												'required|number|xss_clean');
				$this->form_validation->set_rules('add_contacts','Contacts',
												'max_length[500]|xss_clean');				
				$this->form_validation->set_rules('add_site','Site',
												'max_length[500]|xss_clean');
				$this->form_validation->set_rules('add_about','About',
												'max_length[500]|xss_clean');
				
												
				if($this->form_validation->run())
				{
					$username = $this->input->post('add_username');
					$email = $this->input->post('add_email');
					$password = $this->input->post('add_password');
					$name = $this->input->post('add_name');
					$driver_max = $this->input->post('add_driver_max');
					$dispatcher_max = $this->input->post('add_dispatcher_max');
					$city = $this->input->post('add_city');
					$contacts = $this->input->post('add_contacts');
					$site = $this->input->post('add_site');
					$about = $this->input->post('add_about');
					
					$info1 = array('username'=>$username,
								   'email'=>$email,
								   'password'=>$password,
								   'type'=>COMPANY);
								   
				$this->backend_model->insert_userinfo($info1,ADMIN_TABLE);
				$user_id = $this->db->query("SELECT `id` FROM ".ADMIN_TABLE." WHERE `username`='".$username."'");
				$user_id = $user_id->row_array();
				
				$info2 = array('user_id'=>$user_id['id'],
							   'company_name'=>$name,
							   'driver_max'=>$driver_max,
							   'disp_max'=>$dispatcher_max,
							   'city'=>$city,
							   'contacts'=>$contacts,
							   'about'=>$about,
							   'site'=>$site
							   );
				
				$this->backend_model->insert_userinfo($info2,COMPANY_TABLE);
								
				redirect("backend/manage_companies");
				}
				
			}
			$data = $this->backend_model->general();

			$menu_items = array('backend/add_company'=>'Добавить Компанию',
								'backend/manage_companies'=>'Все Компании');
			$data['cities']=$this->backend_model->get_cities();						
			$data += $this->backend_model->page_info('page/add_company',
													'Добавить Компанию',$menu_items);
												
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# For view info about Company
	function view_company($id)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] >= ADMIN)
		{
		$data = $this->backend_model->general();

		$menu_items = array('backend/add_company'=>'Добавить Компанию',
								'backend/manage_companies'=>'Все Компании');
							
		$data += $this->backend_model->page_info('page/view_company',
												'Компания',$menu_items);
												
		$data['userinfo1'] = $this->backend_model->get_userinfo($id,ADMIN_TABLE);
		$data['userinfo2'] = $this->backend_model->return_userinfo(array('user_id'=>$id),COMPANY_TABLE);
		
		$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	# Edit Company
	function edit_company($id)
	{
		if($this->session->userdata['admin_id'] > 0 && $this->session->userdata['admin_type'] >= ADMIN)
		{
			$data['info1'] = $this->backend_model->get_userinfo($id,ADMIN_TABLE);
			$data['info2'] = $this->backend_model->return_userinfo(array('user_id'=>$id),COMPANY_TABLE);
		
			if(isset($_POST['edit_company']))
			{
				if(isset($_POST['cancel'])) redirect("backend/manage_companies");
				
				$this->form_validation->set_rules('edit_username','Username',
												'required|alpha_numeric|min_length[4]|xss_clean');
												
				$this->form_validation->set_rules('edit_email','Email',
												'required|valid_email|xss_clean');
												
				$this->form_validation->set_rules('edit_password','Password',
												'required|alpha_numeric|min_length[3]|xss_clean');
												
				$this->form_validation->set_rules('edit_confirm','Confirm',
												'required|mathces[add_password]|xss_clean');
												
				$this->form_validation->set_rules('edit_name','Company Name',
												'required|min_length[4]|xss_clean');
				
				$this->form_validation->set_rules('edit_driver_max','Driver Amount',
												'number|max_length[3]|xss_clean');
				
				$this->form_validation->set_rules('edit_dispatcher_max','Dispatcher Amount',
												'number|max_length[3]|xss_clean');
				$this->form_validation->set_rules('edit_city','City',
												'required|number|xss_clean');
				$this->form_validation->set_rules('edit_contacts','Contacts',
												'max_length[500]|xss_clean');				
				$this->form_validation->set_rules('edit_site','Site',
												'max_length[500]|xss_clean');
				$this->form_validation->set_rules('edit_about','About',
												'max_length[500]|xss_clean');
												
																
				if($this->form_validation->run())
				{
				$username = $this->input->post('edit_username');
				$email = $this->input->post('edit_email');
				$password = $this->input->post('edit_password');
				$name = $this->input->post('edit_name');
				$driver_max = $this->input->post('edit_driver_max');
				$dispatcher_max = $this->input->post('edit_dispatcher_max');
				$city = $this->input->post('edit_city');
				$contacts = $this->input->post('edit_contacts');
				$site = $this->input->post('edit_site');
				$about = $this->input->post('edit_about');
					
				
				$info1 = array('username'=>$username,
							   'email'=>$email,
							   'password'=>$password,);
							   
					
				$this->backend_model->update_userinfo($id,$info1,ADMIN_TABLE);
				
				$info2 = array('company_name'=>$name,
							   'driver_max'=>$driver_max,
							   'disp_max'=>$dispatcher_max,
							   'city'=>$city,
							   'contacts'=>$contacts,
							   'about'=>$about,
							   'site'=>$site
							   );
							   
				$this->backend_model->update_userinfo_1(array('user_id'=>$id),$info2,COMPANY_TABLE);
				
				redirect("backend/manage_companies");
				}			
			}
			
			$data += $this->backend_model->general();
			
			$menu_items = array('backend/add_company'=>'Добавить Компанию',
								'backend/manage_companies'=>'Все Компании');
			$data['cities']=$this->backend_model->get_cities();								
			$data += $this->backend_model->page_info('page/edit_company',
													'Редактировать Компанию',$menu_items);
												
			$data['id'] = $id;										
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}	

	#FOR COMPANIES ADMIN
	
	#Statistics of orders
	function statistics()
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
		{
			$data = $this->backend_model->general();
		
			$menu_items = array('backend/statistics_for/1'=>'Ежедневный',
								'backend/statistics_for/7'=>'Еженедельный',
								'backend/statistics_for/30'=>'Ежемесячный');
									
			$data += $this->backend_model->page_info('page/statistics',
														'Отчет',$menu_items);
			
			$report = $this->backend_model->get_orders();
			$tmpl = array('table_open'  => '<table id="orders_catalogue">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Name','From','To','Status',' Dispatcher','Order date','City');
			foreach ($report as $row){
			$status = "";
			if ($row->status=='1111') $status = lang("unknown");
			else if ($row->status=='1112') $status = lang("auction");
			else if ($row->status=='1113') $status = lang("descarded");
			else if ($row->status=='1114') $status = lang("taken");
			else if ($row->status=='1115') $status = lang("done");
				$this->table->add_row(
					array($row->surname,$row->from,$row->to,$status,$row->dname,$row->order_date, $row->name)
				);
			}
			$data["report"]=$this->table->generate();
			//$data['city']=$this->session->userdata('city');
				
			$this->load->view('backend/index',$data);
		}else
		{
				redirect('backend/login');
		}
	}
	
	function statistics_for($id)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
		{
			$data = $this->backend_model->general();
		
			$menu_items = array('backend/statistics_for/1'=>'Ежедневный',
								'backend/statistics_for/7'=>'Еженедельный',
								'backend/statistics_for/30'=>'Ежемесячный');
									
			$data += $this->backend_model->page_info('page/statistics_for',
														'Отчет',$menu_items);
			if($id==1){$data["report"]=$this->backend_model->statistics_for_day();}
			else if($id==7){$data["report"]=$this->backend_model->statistics_for_week();}
			else if($id==30){$data["report"]=$this->backend_model->statistics_for_month();}
			$data['id'] = $id;
			$this->load->view('backend/index',$data);
		}else
		{
				redirect('backend/login');
		}
	}

	
	# Manage taxi drivers
	function manage_company_drivers()
	{		
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
		{
			$id = $this->session->userdata['admin_id'];
			$data = $this->backend_model->general();

			$menu_items = array('backend/add_company_driver'=>'Добавить Водителя');
								
			$data += $this->backend_model->page_info('page/manage_company_drivers','Все Водители',$menu_items);
			$company_id = $this->backend_model->getName(array('user_id'=>$id),COMPANY_TABLE, 'id');
			$data['manage_company_drivers'] = $this->backend_model->get_taxi_drivers($company_id);
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
			function view_company_driver($id)
			{
				if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
				{
				$data = $this->backend_model->general();
		
				$menu_items = array('backend/add_company_driver'=>'Добавить Водителя');
									
				$data += $this->backend_model->page_info('page/view_company_driver',
														'Посмотреть Водителя',$menu_items);
														
				$data['userinfo1'] = $this->backend_model->get_userinfo($id,DRIVER_TABLE);
			
				$this->load->view('backend/index',$data);
				}else
				{
					redirect('backend/login');
				}
			}
			
			function edit_company_driver($id)
			{
				if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
				{
					if(isset($_POST['edit_company_driver']))
					{
						if(isset($_POST['cancel']))
							redirect("backend/manage_company_drivers");
							$this->form_validation->set_rules('edit_cname','Name',
														'required|xss_clean');								
							$this->form_validation->set_rules('edit_home_phone','Home Phone',
														'required|xss_clean');		
							$this->form_validation->set_rules('edit_mobile_phone','Mobile Phone',
														'required|xss_clean');							
							$this->form_validation->set_rules('edit_address','Address',
														'required|xss_clean');
							$this->form_validation->set_rules('edit_experience','Experience',
														'required|xss_clean');
							$this->form_validation->set_rules('edit_about','About',
														'required|xss_clean');
							
							if($this->form_validation->run())
							{				
									$info1 = array(
										  'c_name'=>$this->input->post('edit_cname'),
										  'status'=>$this->input->post('edit_status'),
										  'smoke'=>$this->input->post('edit_smoke'),
										  'city'=>$this->input->post('edit_city'),
										  'experience'=>$this->input->post('edit_experience'),
										  'category'=>$this->input->post('edit_category'),
										  'schedule'=>$this->input->post('mode'),
										  'h_phone'=>$this->input->post('edit_home_phone'),
										  'm_phone'=>$this->input->post('edit_mobile_phone'),
										  'address'=>$this->input->post('edit_address'),
										  'about'=>$this->input->post('edit_about'));
												   
									$this->backend_model->update_userinfo_1(array('id'=>$id),$info1,DRIVER_TABLE);
									redirect("backend/manage_company_drivers");
							}
						}
					
					$data = $this->backend_model->general();
					$menu_items = array('backend/add_company_driver'=>'Добавить Водителя');
											
					$data += $this->backend_model->page_info('page/edit_company_driver',
															'Редактировать Водителя',$menu_items);
															
					$data['id']  = $id;
					$data['info1'] = $this->backend_model->get_userinfo($id,DRIVER_TABLE);
					$data['cities'] = $this->backend_model->get_cities();										
													
					$this->load->view('backend/index',$data);
				}else
				{
					redirect('backend/login');
				}
				
			}

			function add_company_driver()
			{
				if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
				{
					
					if(isset($_POST['add_company_driver']))
					{
						if(isset($_POST['cancel']))
							redirect("backend/manage_company_drivers");
							
							$this->form_validation->set_rules('add_cname','Name',
														'required|xss_clean');
							$this->form_validation->set_rules('add_status','Status',
														'required|xss_clean');
							$this->form_validation->set_rules('add_smoke','Smoke',
														'required|xss_clean');
							$this->form_validation->set_rules('add_city','City',
														'required|xss_clean');
							$this->form_validation->set_rules('add_category','Category',
														'required|xss_clean');								
							$this->form_validation->set_rules('add_home_phone','Home Phone',
														'required|xss_clean');		
							$this->form_validation->set_rules('add_mobile_phone','Mobile Phone',
														'required|xss_clean');							
							$this->form_validation->set_rules('add_schedule','Schedule',
														'required|xss_clean');
							$this->form_validation->set_rules('add_address','Address',
														'required|xss_clean');
							$this->form_validation->set_rules('add_experience','Experience',
														'required|xss_clean');
							$this->form_validation->set_rules('add_about','About',
														'required|xss_clean');
							
							if($this->form_validation->run())
							{				
									$image_name = 'company.png';
									$info1 = array(
										  'user_id'=>NULL,
										  'c_name'=>$this->input->post('add_cname'),
										  'status'=>$this->input->post('add_status'),
										  'smoke'=>$this->input->post('add_smoke'),
										  'photo'=>$image_name,
										  'city'=>$this->input->post('add_city'),
										  'category'=>$this->input->post('add_category'),
										  'experience'=>$this->input->post('add_experience'),
										  'schedule'=>$this->input->post('add_schedule'),
										  'h_phone'=>$this->input->post('add_home_phone'),
										  'm_phone'=>$this->input->post('add_mobile_phone'),
										  'address'=>$this->input->post('add_address'),
										  'about'=>$this->input->post('add_about'));
												   
									$this->backend_model->insert_userinfo($info1,DRIVER_TABLE);
									
									$id = $this->backend_model->get_id($this->input->post('add_cname'));
									$c_id = $this->backend_model->get_cid($this->session->userdata['admin_id']);
									
									$info2 = array(
										'driver_id'=>$id,
										'company_id'=>$c_id
									);
									$this->backend_model->insert_userinfo($info2,DRIVER_TO_COMPANY_TABLE);
									
									redirect("backend/manage_taxi_drivers");
							}
						}
					
					$data = $this->backend_model->general();
					$menu_items = array('backend/add_company_driver'=>'Добавить Водителя');
											
					$data += $this->backend_model->page_info('page/add_company_driver',
															'Добавить Водителя',$menu_items);
															
					$data['cities'] = $this->backend_model->get_cities();										
													
					$this->load->view('backend/index',$data);
				}else
				{
					redirect('backend/login');
				}
				
			}
			
			function delete_company_driver($id)
			{
				if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
				{
						$this->backend_model->delete_userinfo($id,DRIVER_TABLE);
						$this->backend_model->delete_userinfo1(array('driver_id'=>$id),DRIVER_TO_COMPANY_TABLE);
						redirect("backend/manage_company_drivers");
				}else
				{
					redirect('backend/login');
				}
				
			}

	# Company profile nado upload dodelat'
	function company_profile()
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == COMPANY)
		{
			$id = $this->session->userdata['admin_id'];
			if(isset($_POST['edit']))
			{
				if(isset($_POST['save']))
				{
					$this->form_validation->set_rules('edit_company_name','Company name',
												'required|xss_clean');
												
					$this->form_validation->set_rules('edit_contacts','Contacts',
												'required|xss_clean');
												
					$this->form_validation->set_rules('edit_site','Site','required|xss_clean');
					
					$this->form_validation->set_rules('edit_about','About',
												'required|xss_clean');
					
					if($this->form_validation->run())
					{
						
						/*$bool = true;
						$image_error_message = NULL;
						$image_name = "default.png";
						$config['upload_path'] = 'style/company/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']	= '1000';
						$config['max_width']  = '1024';
						$config['max_height']  = '768';
			
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
				
						if ( ! $this->upload->do_upload())
						{
							$image_error_message = $this->upload->display_errors();
							$bool = false;
						}
						else	
						{
							$image = $this->backend_model->getName(array('user_id'=>$id),COMPANY_TABLE,'logo');
							unlink('/style/company/'.$image);
							$image_name=$this->upload->data('file_name');
							$image_name=$image_name['file_name'];
						}*/

						$company = $this->input->post('edit_company_name');
						$contacts = $this->input->post('edit_contacts');
						$site = $this->input->post('edit_site');
						$about = $this->input->post('edit_about');
						$city = $this->input->post('edit_city');
						
						$info = array('company_name'=>$company,
									  'contacts'=>$contacts,
									  'site'=>$site,
									  'about'=>$about,
									  'city'=>$city);
									  //'logo'=>$image_name);
									  
						$this->backend_model->update_userinfo_1(array('user_id'=>$id),$info,COMPANY_TABLE);
						redirect('backend/index');
					}
				}
				
				if(isset($_POST['cancel']))
				{
					redirect('backend/index');
				}
			}
			$data = $this->backend_model->general();

			$menu_items = array();
								
			$data += $this->backend_model->page_info('page/company_profile','Параметры Компании',$menu_items);
			$data['company_profile'] = $this->backend_model->get_company($id,COMPANY_TABLE);
			$data['cities'] = $this->backend_model->get_cities();										
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	
# For DISPATCHER users

	function manage_orders($id=0)
	{
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == DISPATCHER)
		{
			
			
  			$beaconpush = new BeaconPush();
			
			$tmpl = array('table_open'  => '<table id="catalogue">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Имя','Откуда','Куда','Телефон','Когда','Статус','Время','session_id');
			$orders =$this->db->get(ORDER_TABLE);
			$orders=$orders->result();
			foreach ($orders as $row){
			$status = "";
			if ($row->status=='1111') {$status = lang("unknown");$class='ui-icon ui-icon-help';}
			else if ($row->status=='1112') {$status = lang("auction"); $class='ui-icon ui-icon-radio-on';}
			else if ($row->status=='1113') {$status = lang("descarded"); $class='ui-icon ui-icon-minus';}
			else if ($row->status=='1114') {$status = lang("taken"); $class='ui-icon ui-icon-plus';}
			else if ($row->status=='1115') {$status = lang("done"); $class='ui-icon ui-icon-check';}
			
			$this->table->add_row(
				array(isset($row->name)?$row->oname:$row->surname,$row->from,$row->to,$row->contacts,$row->when.' '.$row->time,'<button id="'.$row->id.'" class="pro_order '.$class.'">'.$row->status.'</button>',$row->order_date,$row->session_id)
			);
			}
			
			if($id > 0)
			{
				$this->backend_model->delete_userinfo($id,UNOFFICIAL_ORDER_TABLE);
				redirect("backend/manage_categories");
			}	
			
			
			$data = $this->backend_model->general();
			$data['company']=$this->backend_model->get_company_channel($this->session->userdata['admin_id'],DISPATCHER_TABLE);
			$data["orders"]=$this->table->generate();
			$menu_items = array('backend/new_orders'=>'Новые',
								'backend/done_orders'=>'Выполненные',
								'backend/manage_orders'=>'Все');
			$data["beaconpush"]=$beaconpush;					
			$data += $this->backend_model->page_info('page/manage_orders','Заказы',$menu_items);									
			$this->load->view('backend/index',$data);
		}else
		{
			redirect('backend/login');
		}
	}
	
	function edit_order(){
		if(isset($this->session->userdata['admin_id']) && $this->session->userdata['admin_type'] == DISPATCHER){
		$status = $this->input->post('status');
		$message = $this->input->post('message');
		$id = $this->input->post('order_id');
		$arr=array('status'=>$status,'dispatcher_id'=>$this->session->userdata['admin_id']);
		if($status='1113'){	$arr['message']=$message;}
		$this->backend_model->update_userinfo($id,$arr,ORDER_TABLE);
		if($status='1112')//send to other companies
		{
			$beaconpush = new BeaconPush();
			$order=$this->backend_model->get_userinfo($id,ORDER_TABLE);
			$channels=$this->backend_model->get_company_channels();
			$beaconpush->send_to_channels($channels,'client_order',$order);
		}
		echo done;
		}
		else return 0;
	}

	function change_photo($mode=0)
	{
		$id=$_POST['user_id'];
		if ($mode==0)//for drivers
		{
			$column_name='photo';
			$next_page='backend/edit_driver/'.$id;
			$uppath = "style/uploads/user_photos/";	
			$table = USER_PROFILES_TABLE;
			$rule = array('user_id'=> $id);
		}
		else if($mode==1) //for cars 
		{
			$column_name='photo';
			$next_page='backend/edit_company/'.$id;
			$uppath = "style/uploads/cars/";
			$table = CAR_TABLE;
			$rule = array('driver_id'=> $id);
		}
		else if($mode==2)// for companies
		{
			$column_name='logo';
			$next_page='backend/edit_company/'.$id;
			$uppath = "style/uploads/company_logos/";
			$table = COMPANY_TABLE;
			$rule = array('user_id'=> $id);
		}
		if (isset($_POST["photo"]))
		{
			$this->form_validation->set_rules('photo', 'Photo', 'required|xss_clean');
			if ($this->form_validation->run())
			{
				$data = array($column_name => $_POST['photo']);						
				$this->backend_model->update_userinfo_1($rule,$data,$table);
			}
		}
		else 
		{
			$config['upload_path'] = './'.$uppath;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload())
			{
				$error = array('up_error' => $this->upload->display_errors());
			}
			else
			{
				$data = $this->upload->data();
				$img_name = $data['file_name'];
				$config['image_library'] = 'gd2';
				$config['source_image']	= $data['full_path'];
				$config['thumb_marker']='';
				$config['new_image'] = './'.$uppath.'thumbs/';
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']	 = 75;
				$config['height']	= 50;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//print_r($this->image_lib->display_errors());
				$error = array('img_error' => $this->upload->display_errors());
				$data = array($column_name => base_url().$uppath.$data['file_name']);
				$string = $this->backend_model->getName($rule, $table, $column_name);
				$this->backend_model->update_userinfo_1($rule,$data,$table);
							
				$tok = strtok($string, "/");		
				while ($tok !== false) {
    				$prev=$tok;
    				$tok = strtok("/");
				}
				
				unlink(realpath($uppath.$prev));
				unlink(realpath($uppath.'thumbs/'.$prev));
			}
		}
		redirect($next_page);
	} 
}
	
?>
