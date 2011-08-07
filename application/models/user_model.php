<?php
class User_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_display_name($user_id){
		$this->db->where('id',$user_id);
		$users = $this->db->get('users')->result();
		$user = $users[0];
		return $user->displayname;
	}
	function look_for_user($profile){
		$search = array();
		if (isset($profile->email)){
			$search['email'] = $profile->email;
		}
		else if ($profile->provider == 'http://twitter.com/'){
			$search['email'] = "tw".$profile->uid."@twitter.com";
		}
		$query = $this->db->get_where('user',$search);
		return $query->result();
	}
	function register($profile){
		$log_profile = new LoginzaUserProfile($profile);
		$data = array('displayname'=>$log_profile->genDisplayName(),'provider'=>$profile->provider,'identity'=>$log_profile->genUserSite());
		if (isset($profile->email)) $data['email'] = $profile->email;
		else if ($profile->provider == 'http://twitter.com/') $data['email'] = "tw".$profile->uid."@twitter.com";
		if (isset($profile->photo)) $data['photo'] = $profile->photo;
		$this->db->insert('user',$data);
		return $this->db->insert_id();
	}
	function insert_userinfo($data){
		$userinfo = array();
		$driverinfo = array();
		foreach ($data as $k => $v){
			if ($k == 'login'||$k=='email'||$k=='surname'||$k=='middlename'||$k=='dob'||$k=='h_phone'||$k=='m_phone'||$k=='password'){
				$userinfo[$k] = $v;
			}
			else if ($k == 'address'||$k=='category'||$k=='experience'){
				$driverinfo[$k] = $v;
			}
		}
		$userinfo['password'] = sha1("kaskelen".$userinfo['password']);
		$this->db->insert('user',$userinfo);
	}
}
?>
