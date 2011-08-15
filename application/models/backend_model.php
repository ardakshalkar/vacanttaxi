<?php
class Backend_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	# Load general informations, like css,js paths
	function general()
	{
		$data['base_url'] = $this->config->item('base_url');
		$data['backend_css'] = $this->config->item('backend_css');
				
		return $data;
	}
	
	function page_info($page,$title,$side_items)
	{
		# General
		$data['PAGE'] = $page;
		$data['TITLE'] = $title;
				
		# left menu
		$data['SIDE_ITEMS'] = $side_items;
		
		return $data;
	}
	
	function return_userinfo($rule,$table)
	{
		$this->db->where($rule);
		$query = $this->db->get($table);
		$query = $query->result();
		return $query[0];
	}
	
	# Check backend user, SUPERADMIN, ADMIN, MODERATOR
	function check_backend_login($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get(ADMIN_TABLE);
		
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			
			if($row['type'] == SUPERADMIN || $row['type'] == ADMIN || $row['type'] == COMPANY || $row['type'] == DISPATCHER)
			{				
				$data['user_id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['type'] = $row['type'];
				$data['status'] = $row['status'];
						
				return $data;
			}
		}
		return false;
	}
	
	# Return all categories	
	function get_category_list()
	{
		$query = $this->db->query('SELECT `name` FROM `categories`');
		$c_list = NULL;
		foreach($query->result() as $i) { $c_list[$i->name] = $i->name; }
		return $c_list;
	}
	
	# Return all cities
	function get_city_list()
	{
		$query = $this->db->query('SELECT * FROM `city`');
		$c_list = NULL;
		foreach($query->result() as $i)
		{
			$c_list[$i->name] = $i->name; 
			$query2 = $this->db->query("SELECT * FROM `district` WHERE `city_id`=".$i->id);
			foreach($query2->result() as $j)
			{
				$c_list[$j->name] = "&hellip;".$j->name;
			}
		}
		return $c_list;
	}
		
	# Return backend users by type ( SUPERADMIN, ADMIN, MODERATOR ) or ALL, when type is 0
	function get_users($type,$table)
	{
		if($type > 0) { $this->db->where('type',$type); }

		$query = $this->db->get($table);
		
		return $query;		
	}
	
	function return_users($array,$table)
	{
		$this->db->where($array);
		$query = $this->db->get($table);
		return $query;
	}
	
	function do_online($id,$var,$table)
	{
		$this->db->where('id',$id);
		$this->db->update($table,array('online'=>$var));
	}
	
	# Return string
	function get_name($type)
	{
		switch($type)
		{
			case SUPERADMIN:
				return "SuperAdmin";
			case ADMIN:
				return "Admin";
			case MODERATOR:
				return "Moderator";
			default:
				return "Error!!!";
		}
	}
	
	function get_front_name($type)
	{
		switch($type)
		{
			case EMPLOYEE:
				return 'Employee';
			case EMPLOYER:
				return 'Employer';
			case AGENCY:
				return 'Agency';
			default:
				return 'Error!!!';
		}
	}
	
	# Return user information by id
	# Must return row, for this need $query[0], don't change it
	function get_userinfo($id,$table)
	{
		$this->db->where('id',$id);
		$query = $this->db->get($table);
		$query = $query->result();
		return $query[0];
	}
	
	function get_districts($city_id,$table)
	{
		$this->db->where('city_id',$city_id);
		$query = $this->db->get($table);
		$query = $query->result();
		return $query;
	}
	
	# Update the userinfo with $data
	function update_userinfo($id,$data,$table)
	{
		$this->db->where('id',$id);
     	$this->db->update($table,$data); 
	}
	
	function update_userinfo_1($rule,$data,$table)
	{
		$this->db->where($rule);
     	$this->db->update($table,$data); 
	}
	
	function do_blocked($username,$data,$table)
	{
		$this->db->where('username',$username);
		$this->db->update($table,$data);
	}
	
	# Delete user by id
	function delete_userinfo($id,$table)
	{
		$this->db->where('id',$id);
		$this->db->delete($table);
	}
	
	function delete_users($array,$table)
	{
		$this->db->where($array);
		$this->db->delete($table);
	}
	
	function delete_userinfo1($rule,$table)
	{
		$this->db->where($rule);
		$this->db->delete($table);
	}
	# Insert $data to the $table
	function insert_userinfo($data,$table)
	{
		$this->db->insert($table,$data);
	}
	
	# Note: Return true, if exist
	function check_email($email)
	{
		$q1 = $this->db->query("SELECT id FROM ".ADMIN_TABLE." WHERE email='".$email."'");
		$q2 = $this->db->query("SELECT id FROM ".USER_TABLE." WHERE email='".$email."'");
		if($q1->num_rows() == 0 && $q2->num_rows() == 0)
		{
			return false;
		}else
		{
			return true;
		}
	}
	
	# Return all companies
	function get_companies_list()
	{
		$query = $this->db->query('SELECT * FROM `company`');
		$c_list = NULL;
		$c_list['0']='Vacant Taxi';
		foreach($query->result() as $i)
		{
			$c_list[$i->id] = $i->company_name; 
		}
		return $c_list;
	}
	
	function get_company($id,$table)
 	{
  		$this->db->where('user_id',$id);
  		$query = $this->db->get($table);
  		$query = $query->result();
  		return $query[0];
 	}
	
	# Return all cities
	function get_cities()
	{
		$this->db->order_by('name','asc');
		$query = $this->db->get(CITY_TABLE);
		$c_list = NULL;
		foreach($query->result() as $i)
		{
			$c_list[$i->id] = $i->name; 
		}
		return $c_list;
	}

	# Return everything from table
	function all($table)
	{
		$query = $this->db->get($table);
		//$query = $query->result();
		return $query;	
	}

	#Take company drivers profile
	function get_taxi_drivers($c_id)
	{
 		$this->db->where('company_id', $c_id);
		$this->db->order_by("driver_id","asc");
		$query = $this->db->get('driver_to_company');
		$driver = NULL;
		$counter=0;
		foreach($query->result() as $dr_id)
		{
			$driver[$counter]['id'] = $dr_id->driver_id;
			$query2 = $this->db->query("SELECT * FROM `driver` WHERE `id`=".$dr_id->driver_id);
			$driver[$counter]['driver_profile']=$query2->result();
			$counter++;
		}
		return $driver;
 	}
	
	#Get id of driver
	function get_id($cname)
	{
		$this->db->select('id');
		$this->db->where('c_name',$cname);
		$query = $this->db->get('driver');
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			$id=$row['id'];
			return $id;
		}
		return false;
	}
	#Get company id
	function get_cid($user_id)
	{
		$this->db->select('id');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('company');
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			$id=$row['id'];
			return $id;
		}
		return false;
	}

	#Take name of logo of company
 	function getName($rule, $table, $col_name)
 	{
  		$this->db->where($rule);
  		$query = $this->db->get($table);
  		if($query->num_rows() == 1)
  		{
   			$data = $query->row_array();
   			$name = $data[$col_name]; 
   			return $name;
  		}
  		return false;
 	}

	function loadCatalogue($city)
	{
		$city = $this->db->get_where('city',array('name'=>$city))->result();
		$city_id = $city[0]->id;
		$query = $this->db->select("*")->from('driver')->join('car','driver.id=car.driver_id','left')->join('users','users.id=driver.user_id','left')->where('city',$city_id)->get();
		$drivers = $query->result();
		return $drivers;
		
	}
	
	#for statistics
	function get_orders()
	{
		$query = $this->db->select("*")->from('order')->join('city','order.city=city.id','left')->join('company_dispatcher','order.dispatcher_id=company_dispatcher.id','left')->order_by('order_date','desc')->get();
		$orders = $query->result(); 
		return $orders;
	}
	
	function statistics_for_day()
	{
		$query = $this->db->query("SELECT * FROM `order` where status = '1111' and DATE(ORDER_DATE)=curdate()");
		$query1 = $this->db->query("SELECT * FROM `order` where status = '1112' and DATE(ORDER_DATE)=curdate()");
		$query2 = $this->db->query("SELECT * FROM `order` where status = '1113' and DATE(ORDER_DATE)=curdate()");
		$query3 = $this->db->query("SELECT * FROM `order` where status = '1114' and DATE(ORDER_DATE)=curdate()");
		$query4 = $this->db->query("SELECT * FROM `order` where status = '1115' and DATE(ORDER_DATE)=curdate()");
		$query5 = $this->db->query("SELECT * FROM `order` where DATE(ORDER_DATE)=curdate()");
		$result = array();
		$result[0]= count($query->result());
		$result[1]= count($query1->result());
		$result[2]= count($query2->result());
		$result[3]= count($query3->result());
		$result[4]= count($query4->result());
		$result[5]= count($query5->result());
		return $result;
	}

	function statistics_for_week()
	{
		$query = $this->db->query("SELECT * FROM `order` WHERE status='1111' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()");
		$query1 = $this->db->query("SELECT * FROM `order` WHERE status='1112' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()");
		$query2 = $this->db->query("SELECT * FROM `order` WHERE status='1113' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()");
		$query3 = $this->db->query("SELECT * FROM `order` WHERE status='1114' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()");
		$query4 = $this->db->query("SELECT * FROM `order` WHERE status='1115' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()");
		$query5 = $this->db->query("SELECT * FROM `order` WHERE DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()");
		$result = array();
		$result[0]= count($query->result());
		$result[1]= count($query1->result());
		$result[2]= count($query2->result());
		$result[3]= count($query3->result());
		$result[4]= count($query4->result());
		$result[5]= count($query5->result());
		return $result;
	}

	function statistics_for_month()
	{
		$query = $this->db->query("SELECT * FROM `order` WHERE status='1111' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 31 DAY) AND CURDATE()");
		$query1 = $this->db->query("SELECT * FROM `order` WHERE status='1112' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 31 DAY) AND CURDATE()");
		$query2 = $this->db->query("SELECT * FROM `order` WHERE status='1113' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 31 DAY) AND CURDATE()");
		$query3 = $this->db->query("SELECT * FROM `order` WHERE status='1114' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 31 DAY) AND CURDATE()");
		$query4 = $this->db->query("SELECT * FROM `order` WHERE status='1115' and DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 31 DAY) AND CURDATE()");
		$query5 = $this->db->query("SELECT * FROM `order` WHERE DATE(order_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 31 DAY) AND CURDATE()"); 
		$result = array();
		$result[0]= count($query->result());
		$result[1]= count($query1->result());
		$result[2]= count($query2->result());
		$result[3]= count($query3->result());
		$result[4]= count($query4->result());
		$result[5]= count($query5->result());
		return $result;
	}
}
?>