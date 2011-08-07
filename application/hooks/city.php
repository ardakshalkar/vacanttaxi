<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class City{
	function defineCity(){
		$CI =& get_instance();
		$CI->load->library('session');
		if ($CI->session->userdata('city')){
			$CI->data["city"] = $CI->session->userdata('city');
			return;
		}
		if ($CI->input->cookie("city")){
			$CI->session->set_userdata('city',$CI->input->cookie("city"));
			$CI->load->database();
			$CI->db->where('name',$CI->input->cookie("city"));
			$query = $CI->db->get('city');
			$row = $query->row_array();
			$CI->session->set_userdata('city_id',$row["id"]);
			$CI->data["city"] = $CI->session->userdata('city');
			return;
		}
		$ip=$_SERVER['REMOTE_ADDR'];
		$t = "http://www.geobytes.com/IpLocator.htm?GetLocation&template=php3.txt&IpAddress=84.240.194.0";
		$tags = get_meta_tags($t);
		
		$city = $tags['city'];
		
		$CI->input->set_cookie('city',$city,5184000);
		
		$CI->load->database();
		$CI->db->where('name',$CI->input->cookie("city"));
		$query = $CI->db->get('city');
		$row = $query->row_array();
		$CI->session->set_userdata('city_id',$row["id"]);
		$CI->session->set_userdata('city', $city);
		$CI->data["city"] = $city;
		
	}
}
?>
