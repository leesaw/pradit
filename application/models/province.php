<?php
Class Province extends CI_Model
{
 function getProvince()
 {
	$this->db->select("province_code, province_name");
	$this->db->order_by("province_name", "asc");
	$this->db->from('province');
	$query = $this->db->get();		
	return $query->result();
 }

}
?>

