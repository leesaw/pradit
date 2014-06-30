<?php
Class Bill extends CI_Model
{

 function getTempCount($status=NULL)
 {
	$this->db->select("tempid");
	$this->db->from('bill_product_temp');		
	$this->db->where('status', $status);
	$query = $this->db->get();		
	return $query->num_rows();
 }
 
 function getBillTemp()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, unit, category.name as cname, bill_product_temp.tempid as tid, SUM(amount) as sum");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode');
	$this->db->join('stock', 'stock.productID = product.id');
	$this->db->join('category', 'product.categoryID = category.id');
	$this->db->where('status', 1);
	$this->db->group_by('stock.productID');
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getBillTemp2()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, count(*) as amount,unit, bill_product_temp.tempid as tid");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode');
	$this->db->where('status', 1);
	$this->db->group_by('bill_product_temp.barcode');
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getBillTemp3($column=NULL)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, count(*) as amount,unit,".$column.", bill_product_temp.tempid as tid, product.id as pid");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode');
	$this->db->where('status', 1);
	$this->db->group_by('bill_product_temp.barcode');
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getQuotationTemp()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, unit, category.name as cname, bill_product_temp.tempid as tid");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode');
	$this->db->join('category', 'product.categoryID = category.id');
	$this->db->where('status', 2);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getQuotationTemp2()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, count(*) as amount,unit, bill_product_temp.tempid as tid");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode');
	$this->db->where('status', 2);
	$this->db->group_by('bill_product_temp.barcode');
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getQuotationTemp3($column=NULL)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, count(*) as amount,unit,".$column.", bill_product_temp.tempid as tid, product.id as pid");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode');
	$this->db->where('status', 2);
	$this->db->group_by('bill_product_temp.barcode');
	$query = $this->db->get();		
	return $query->result();
 }
 
 function checkBarcodeProduct($barcode=NULL)
 {
	$this->db->select("id");
	$this->db->from('product');		
	$this->db->where('barcode', $barcode);
	$query = $this->db->get();		
	return $query->num_rows();
 }
 
 function getTempID()
 {
	$this->db->select("tempid");
	$this->db->order_by("tempid", "desc");
	$this->db->from('bill_product_temp');		
	$this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneBill($id=NULL)
 {
	$this->db->select("bill.id as bid, billID, date, customerName, customerAddress, customerContact, bill.discount as bdiscount, tax, title, users.firstname as fname, users.lastname as lname, bill.creditDay as bcreditDay, bill.status as bstatus");
	$this->db->from('bill');	
	$this->db->join('customer','customer.id=bill.customerID');
	$this->db->join('users','users.id=bill.userID');
	$this->db->where('bill.id', $id);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneBillProduct($billid=NULL)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("bill_product.productID as pid, amount, pricePerUnit, CONCAT(product.standardID,' ', product.name) as productname, unit, priceNoVAT, priceDiscount, tax, discount");
	$this->db->from('bill_product');	
	$this->db->join('product','product.id=bill_product.productID');
	$this->db->join('bill','bill.billID=bill_product.billID');
	$this->db->where('bill_product.billID', $billid);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function addBarcodeTemp($barcode=NULL)
 {
	$this->db->insert('bill_product_temp', $barcode);
	return $this->db->insert_id();	
 }
 
 function addCashBillProduct($product=NULL)
 {
	$this->db->insert('bill_product', $product);
	return $this->db->insert_id();
 }
 
 function addCashBill($bill=NULL)
 {
	$this->db->insert('bill', $bill);
	return $this->db->insert_id();
 }

 function delAllBillTemp($status=NULL)
 {
	$this->db->where('status', $status);
	$this->db->delete('bill_product_temp'); 
 }
 
 function delBillTemp($id=NULL)
 {
	$this->db->where('tempid', $id);
	$this->db->delete('bill_product_temp'); 
 }
 
}
?>

