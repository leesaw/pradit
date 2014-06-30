<?php
Class Title extends CI_Model
{
 function getTitle()
 {
	$this->db->select("name");
	$this->db->order_by("id", "asc");
	$this->db->from('title');
	$query = $this->db->get();		
	return $query->result();
 }

}
?>

