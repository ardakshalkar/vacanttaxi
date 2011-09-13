<?php
class Catalogue_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function loadCatalogue($city)
	{
		//$city = $this->db->get_where('city',array('name'=>$city))->result();
		$city_id = $this->session->userdata('city_id');
		$query = $this->db->select('*')->from('driver')->join('car','driver.id=car.driver_id','left')->join('users','users.id=driver.user_id','left')->where('city',$city_id)->get();
		$drivers = $query->result();
		return $drivers;
		
	}
	function is_present_in_catalogue($user_id){
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('driver');
		if ($query->num_rows()>0)
			return true;
		else
			return false;
	}
	function get_driver($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('driver');
		$data = $query->row_array(); 
		return $data;
		
	}
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('driver');
	}

	function get_companies()
	{
		$query = $this->db->select("*")->from('company')->join('city','company.city=city.id')->get();
		$companies = $query->result(); 
		return $companies;
	}
}
?>
