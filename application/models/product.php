<?php
Class Product extends CI_Model
{
 function getProduct()
 {
	$this->db->select("product.id AS pid, standardID, supplierID, barcode, product.name AS pname, category.name AS cname, unit, costPrice, priceNoVAT, priceVAT, priceDiscount, detail, reserve1, reserve2, reserve3, reserve4, reserve5, lowestprice, shelf");
	$this->db->order_by("product.id", "asc");
	$this->db->from('product');	
	$this->db->join('category', 'category.id = product.categoryID','left');		
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneCat($cid=NULL)
 {
	$this->db->select("product.id AS pid, standardID, supplierID, barcode, product.name AS pname, category.name AS cname, unit, costPrice, priceNoVAT, priceVAT, priceDiscount, detail, reserve1, reserve2, reserve3, reserve4, reserve5, lowestprice, shelf");
	$this->db->order_by("product.id", "asc");
	$this->db->from('product');	
	$this->db->join('category', 'category.id = product.categoryID','left');	
    if ($cid>0) { $this->db->where('category.id', $cid); }
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneProduct($id=NULL)
 {
	$this->db->select("product.id AS pid, standardID, supplierID, barcode, product.name AS pname, category.name AS cname, categoryID, unit, costPrice, priceNoVAT, priceVAT, priceDiscount, detail, reserve1, reserve2, reserve3, reserve4, reserve5, lowestprice, shelf");
	$this->db->order_by("product.id", "asc");
	$this->db->from('product');	
	$this->db->join('category', 'category.id = product.categoryID','left');	
	$this->db->where('product.id', $id);
	$query = $this->db->get();		
	return $query->result();
 }

 function addProduct($pro=NULL)
 {		
	$this->db->insert('product', $pro);
	return $this->db->insert_id();			
 }
 
 function delProduct($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('product'); 
 }
 
 function editProduct($pro=NULL)
 {
	$this->db->where('id', $pro['id']);
	unset($pro['id']);
	$query = $this->db->update('product', $pro); 	
	return $query;
 }

}
?>

