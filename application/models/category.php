<?php
Class Category extends CI_Model
{
 function getCat()
 {
	$this->db->select("id, name");
	$this->db->order_by("id", "asc");
	$this->db->from('category');				
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneCat($id=NULL)
 {
	$this->db->select("id, name");
	$this->db->order_by("id", "asc");
	$this->db->from('category');
	$this->db->where('id', $id);
	$query = $this->db->get();		
	return $query->result();
 }

 function addCat($cat=NULL)
 {		
	$this->db->insert('category', $cat);
	return $this->db->insert_id();			
 }
 
 function delCat($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('category'); 
 }
 
 function editCat($cat=NULL)
 {
	$this->db->where('id', $cat['id']);
	unset($cat['id']);
	$query = $this->db->update('category', $cat); 	
	return $query;
 }

}
?>

