<?php
Class Customer extends CI_Model
{
 function getCustomer()
 {
	$this->db->select("id, customerID, name, address, province_name, zipcode, title, contactName, taxID, credit, salePrice, discount, telephone, fax, status, creditDay, part, note");
	$this->db->order_by("id", "asc");
	$this->db->from('customer');
	$this->db->join('province', 'province.province_code = customer.provinceID', 'left');	
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneCustomer($id=NULL)
 {
	$this->db->select("id, customerID, name, address, province_name, zipcode, title, contactName, taxID, credit, salePrice, discount, telephone, fax, status, creditDay, part, note");
	$this->db->order_by("id", "asc");
	$this->db->from('customer');
	$this->db->join('province', 'province.province_code = customer.provinceID', 'left');	
	$this->db->where('id', $id);
	$query = $this->db->get();		
	return $query->result();
 }

 function addCustomer($customer=NULL)
 {		
	$this->db->insert('customer', $customer);
	return $this->db->insert_id();			
 }
 
 function delCustomer($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('customer'); 
 }
 
 function editCustomer($customer=NULL)
 {
	$this->db->where('id', $customer['id']);
	unset($customer['id']);
	$query = $this->db->update('customer', $customer); 	
	return $query;
 }
 
 function searchName($term)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("address, province_name,province_code, zipcode, customer.id as cusid, customer.name as cusname, saleprice, discount, contactName, status, creditDay, telephone, fax");
	$this->db->from('customer');	
	$this->db->join('province','province.province_code=customer.provinceID', 'left');
	$this->db->like('customer.name', $term,'after');
	$query = $this->db->get();
	return $query->result();
 }

}
?>

