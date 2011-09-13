<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class City{
	function defineCity(){
		$CI =& get_instance();
		$CI->load->library('session');
		if ($CI->session->userdata('city_id')){
			$CI->load->database();
			$CI->db->where('id',$CI->session->userdata('city_id'));
			$query = $CI->db->get('city');
			$row = $query->row_array();
			$CI->data["city"] = $row['ru_name'];
			return;
		}
		if ($CI->input->cookie('city_id')){
			$CI->session->set_userdata('city_id',$CI->input->cookie('city_id'));
			$CI->load->database();
			$CI->db->where('id',$CI->input->cookie('city_id'));
			$query = $CI->db->get('city');
			$row = $query->row_array();
			$CI->session->set_userdata('city_id',$row["id"]);
			$CI->data["city"] = $row['ru_name'];
			return;
		}
		$ip=$_SERVER['REMOTE_ADDR'];
		$t = "http://www.geobytes.com/IpLocator.htm?GetLocation&template=php3.txt&IpAddress=84.240.194.0";
		$tags = get_meta_tags($t);
		
		$city = $tags['city'];
		$CI->load->database();
		$CI->db->where('name',$city);
		$query = $CI->db->get('city');
		$row = $query->row_array();
		$CI->input->set_cookie('city_id',$row['id'],5184000);
		
		$CI->session->set_userdata('city_id',$row["id"]);
		$CI->session->set_userdata('city', $row['ru_name']);
		$CI->data["city"] = $city;
	}
}
?>
