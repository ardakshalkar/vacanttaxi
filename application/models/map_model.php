<?php
class Map_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_userinfo($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('user');
		$data = $query->row_array(); 
		return $data;
		
	}
	
	function get_driver($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('driver');
		$data = $query->row_array(); 
		return $data;
		
	}
	
	
	function get_driver_info($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('driver');
		if($query->num_rows() == 1)
		{
			$row = $query->row_array();
			$exp='';
			if($row['experience'] == 0)
				{
					$exp= "Без опыта";
				}else if($row['experience'] == 1)
				{
					$exp= "1 год";
				}else if($row['experience'] > 1 &$row['experience'] <= 4)
				{
					$exp= $row['experience']." года";
				}else
				{
					$exp= $row['experience']." лет";
				}
			
			$data = '<div class = "infowindow"><img src="http://localhost/VacanTaxi/style/uploads/'.$row['photo'].'" style="float:left; width:80px; padding-right:5px; overflaw:hidden;" alt="driver photo"><h2>'.$row['lastname'].' '.$row['firstname'].' '.$row['middlename'].'</h2><p>Опыт: '.$exp.'.  Номер телефона: '.$row['m_phone'].'</p><p onclick="startChat('.$row['user_id'].')">Чат</p></div>';			
			return $data;
		}
		return 'no info';
	}
	
	function get_driver_info2($id)
	{	
		$this->db->select('*');
		$this->db->where('user_id',$id);
		$this->db->from('driver');
		$this->db->join('rating', 'rating.driver_id = driver.user_id');
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$row = $query->row_array();
			$exp='';
			if($row['experience'] == 0)
				{
					$exp= "Р‘РµР· РѕРїС‹С‚Р°";
				}else if($row['experience'] == 1)
				{
					$exp= "1 РіРѕРґ";
				}else if($row['experience'] > 1 &$row['experience'] <= 4)
				{
					$exp= $row['experience']." РіРѕРґР°";
				}else
				{
					$exp= $row['experience']." Р»РµС‚";
				}
				
			return $row;
		}
		return false;
	}
	
	function get_online_list()
	{
		$query = $this->db->get('position');
		$list = array();$j = 0;
		foreach ($query->result() as $i){
			$list[$j]['lat'] = $i->lat;
			$list[$j]['lon'] = $i->lon;
			$j++;
		}
		return $list;
	}
	
	function updateRating($p_id, $p_rating)
    {   
    	$this->db->where('driver_id',$p_id);
		$query = $this->db->get('rating');                
        $data = $query->row_array();
        $new_total_rating = $data['total_rating'] + $p_rating;
		$new_total_ratings = $data['total_ratings'] + 1;
		$new_rating = $new_total_rating / $new_total_ratings; 
		$data = array(
				'driver_id'=>$p_id,
               'rating' => $new_total_rating,
               'total_rating' => $new_total_rating,
               'total_ratings' => $new_total_ratings
            );
		$this->db->where('driver_id',$p_id);
		$query=$this->db->update('rating', $data);
        return $data;
    }
	
	
	function getCity(){
		$this->db->order_by("name","asc");
		$query = $this->db->get('city');
		$cities = $query->result();
		return $cities;
	}
	
	function get_messages($type){
 		$this->db->where('type', $type);
		$this->db->order_by("date","desc");
		$query = $this->db->get('unofficial_order');
		$msg_clients = NULL;
		$counter=0;
		foreach($query->result() as $i)
		{
			$msg_clients[$counter]['id'] = $i->id;
			$msg_clients[$counter]['name'] = $i->name;
			$msg_clients[$counter]['message'] = $i->message;
			$msg_clients[$counter]['contacts'] = $i->contacts;
			$msg_clients[$counter]['from'] = $i->from;
			$msg_clients[$counter]['to'] = $i->to;
			$msg_clients[$counter]['date'] = $i->date;
			$query2 = $this->db->query("SELECT * FROM `comments` WHERE `message_id`=".$i->id);
			$msg_clients[$counter]['comments']=$query2->result();
			$counter++;
		}
		return $msg_clients;
 	}
}
?>
