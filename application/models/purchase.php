<?php
Class Purchase extends CI_Model
{

 function getTempCount($status=NULL)
 {
	$this->db->select("tempid");
	$this->db->from('purchase_product_temp');		
	//$this->db->where('status', $status);
	$query = $this->db->get();		
	return $query->num_rows();
 }
 
 function getLastID()
 {
	$result = $this->db->select("max(id) as lastid")
					  ->from("purchase")
					  ->get()->result();
	return $result;
 }
 
 function getPurchaseTemp()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, unit, category.name as cname, purchase_product_temp.tempid as tid,amount");
	$this->db->from('purchase_product_temp');
	$this->db->join('product', 'product.barcode = purchase_product_temp.barcode','left');
	$this->db->join('category', 'product.categoryID = category.id','left');
	//$this->db->where('status', 0);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getPurchaseTemp2()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, sum(amount) as sumamount,unit, purchase_product_temp.tempid as tid, costPrice, purchase_product_temp.barcode as _barcode, product.id as _productid, lowestPrice");
	$this->db->from('purchase_product_temp');
	$this->db->join('product', 'product.barcode = purchase_product_temp.barcode','left');
	//$this->db->where('status', 1);
	$this->db->group_by('purchase_product_temp.barcode');
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getPurchaseTemp3()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, sum(amount) as sumamount,unit, costPrice, purchase_product_temp.tempid as tid, product.id as pid, price");
	$this->db->from('purchase_product_temp');
	$this->db->join('product', 'product.barcode = purchase_product_temp.barcode','left');
	//$this->db->where('status', 1);
	$this->db->group_by('purchase_product_temp.barcode');
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
	$this->db->from('purchase_product_temp');		
	$this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOnePurchase($id=NULL)
 {
	$this->db->select("purchase.id as bid, purchaseID, date, supplier.supplierID as _supplierid, supplierName, supplierAddress, supplierTel, supplierFax, purchase.creditDay as creditDay, purchase.status as purstatus, title, users.firstname as fname, users.lastname as lname, receiveDate, transport, vat, percentvat, tax");
	$this->db->from('purchase');	
	$this->db->join('supplier','supplier.id=purchase.supplierID','left');
	$this->db->join('users','users.id=purchase.userID','left');
	$this->db->where('purchase.id', $id);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOnePurchaseProduct($purchaseid=NULL)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("purchase_product.productID as pid, amount, pricePerUnit, CONCAT(product.standardID,' ', product.name) as productname, unit, costPrice, purchase.status as purstatus, creditDay");
	$this->db->from('purchase_product');	
	$this->db->join('product','product.id=purchase_product.productID','left');
	$this->db->join('purchase','purchase.id=purchase_product.purchaseID','left');
	$this->db->where('purchase_product.purchaseID', $purchaseid);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function addBarcodeTemp($barcode=NULL)
 {
	$this->db->insert('purchase_product_temp', $barcode);
	return $this->db->insert_id();	
 }
 
 function addCashPurchaseProduct($product=NULL)
 {
	$this->db->insert('purchase_product', $product);
	return $this->db->insert_id();
 }
 
 function addCashPurchase($purchase=NULL)
 {
	$this->db->insert('purchase', $purchase);
	return $this->db->insert_id();
 }

 function delAllPurchaseTemp($status=NULL)
 {
	$this->db->where('status', $status);
	$this->db->delete('purchase_product_temp'); 
 }
 
 function delPurchaseTemp($id=NULL)
 {
	$this->db->where('tempid', $id);
	$this->db->delete('purchase_product_temp'); 
 }
 
 function editAmountTemp($temp=NULL)
 {
	$this->db->where('tempid', $temp['tempid']);
	unset($stock['tempid']);
	$query = $this->db->update('purchase_product_temp', $temp); 	
	return $query;
 }
 
 function editPriceTemp($temp=NULL)
 {
	$this->db->where('barcode', $temp['barcode']);
	unset($temp['barcode']);
	$query = $this->db->update('purchase_product_temp', $temp); 	
	return $query;
 }
 
 //  for buycash table
 function addBuyCash($buycash=NULL)
 {
	$this->db->insert('buycash', $buycash);
	return $this->db->insert_id();
 }
 
 function checkBuycashID($buycashid=NULL)
 {
	$this->db->select("id");
	$this->db->from('buycash');		
	$this->db->where('buycashID', $buycashid);
	$query = $this->db->get();		
	return $query->num_rows();
 }
 
 function getBuycashID($buycashid=NULL)
 {
	$this->db->select("id");
	$this->db->from('buycash');		
	$this->db->where('buycashID', $buycashid);
	$query = $this->db->get();		
	return $query->num_rows();
 }
}
?>

