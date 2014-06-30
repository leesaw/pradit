<?php
Class Branch extends CI_Model
{
 function getBranch()
 {
	$this->db->select("id, name, address, province_name, zipcode, telephone, fax, taxid");
	$this->db->order_by("id", "asc");
	$this->db->from('branch');
	$this->db->join('province', 'province.province_code = branch.provinceID');	
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneBranch($id=NULL)
 {
	$this->db->select("id, name, address, province_name, zipcode, telephone, fax, taxid");
	$this->db->order_by("id", "asc");
	$this->db->from('branch');
	$this->db->join('province', 'province.province_code = branch.provinceID');	
	$this->db->where('id', $id);
	$query = $this->db->get();		
	return $query->result();
 }

 function addBranch($branch=NULL)
 {		
	$this->db->insert('branch', $branch);
	return $this->db->insert_id();			
 }
 
 function delBranch($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('branch'); 
 }
 
 function editBranch($branch=NULL)
 {
	$this->db->where('id', $branch['id']);
	unset($branch['id']);
	$query = $this->db->update('branch', $branch); 	
	return $query;
 }

}
?>

