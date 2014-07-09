<?php
Class Supplier extends CI_Model
{
 function getSupplier()
 {
	$this->db->select("id, supplierID, name, address, province_name, zipcode, title, contactName, taxID, telephone, fax, status, creditDay");
	$this->db->order_by("id", "asc");
	$this->db->from('supplier');
	$this->db->join('province', 'province.province_code = supplier.provinceID');	
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneSupplier($id=NULL)
 {
	$this->db->select("id, supplierID, name, address, province_name, zipcode, title, contactName, taxID, telephone, fax, status, creditDay");
	$this->db->order_by("id", "asc");
	$this->db->from('supplier');
	$this->db->join('province', 'province.province_code = supplier.provinceID');	
	$this->db->where('id', $id);
	$query = $this->db->get();		
	return $query->result();
 }

 function addSupplier($supplier=NULL)
 {		
	$this->db->insert('supplier', $supplier);
	return $this->db->insert_id();			
 }
 
 function delSupplier($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('supplier'); 
 }
 
 function editSupplier($supplier=NULL)
 {
	$this->db->where('id', $supplier['id']);
	unset($supplier['id']);
	$query = $this->db->update('supplier', $supplier); 	
	return $query;
 }
 
function searchName($term)
 {
	//$this->db->_protect_identifiers=false;
	$this->db->select("address, province_name,province_code, zipcode, supplier.id as supid, supplier.name as supname, supplier.status as supstatus, creditDay, contactName, telephone, fax");
	$this->db->from('supplier');	
	$this->db->join('province','province.province_code=supplier.provinceID');
	$this->db->like('supplier.name', $term,'after');
	$query = $this->db->get();
	return $query->result();
 }

}
?>

