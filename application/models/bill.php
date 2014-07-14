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
 
 function getLastIDbill($isQuotation=NULL)
 {
	$result = $this->db->select("max(id) as lastid")
					  ->from("bill")
					  ->get()->result();
	return $result;
 }
 
 function getLastIDquotation($isQuotation=NULL)
 {
	$result = $this->db->select("max(id) as lastid")
					  ->from("quotation")
					  ->get()->result();
	return $result;
 }
 
 function getBillTemp()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, unit, category.name as cname, bill_product_temp.tempid as tid, stock.amount as sum, bill_product_temp.amount as _amount");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode','left');
	$this->db->join('stock', 'stock.productID = product.id', 'left');
	$this->db->join('category', 'product.categoryID = category.id', 'left');
	$this->db->where('status', 1);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getBillTemp2()
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, sum(amount) as sumamount,unit, bill_product_temp.tempid as tid, priceNoVAT, priceVAT, bill_product_temp.barcode as _barcode, product.id as _productid, lowestPrice");
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
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, sum(amount) as sumamount,unit,".$column.", bill_product_temp.tempid as tid, product.id as pid, price");
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
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, unit, category.name as cname, bill_product_temp.tempid as tid, amount");
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
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, sum(amount) as sumamount,unit, bill_product_temp.tempid as tid, priceNoVAT, priceVAT, bill_product_temp.barcode as _barcode, product.id as _productid, lowestPrice");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode','left');
	$this->db->where('status', 2);
	$this->db->group_by('bill_product_temp.barcode');
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getQuotationTemp3($column=NULL)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("CONCAT(product.standardID,' ', product.name) as productname, sum(amount) as sumamount,unit,".$column.", bill_product_temp.tempid as tid, product.id as pid, price");
	$this->db->from('bill_product_temp');
	$this->db->join('product', 'product.barcode = bill_product_temp.barcode', 'left');
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
 
 function checkIDBillid($billid=NULL)
 {
	$this->db->select("id");
	$this->db->from('bill');		
	$this->db->where('billID', $billid);
	$query = $this->db->get();		
	return $query->result();
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
	$this->db->select("bill.id as bid, billID, date, customer.customerID as _customerID, customerName, customerAddress, customerTel, customerFax, customerContact, bill.discount as bdiscount, tax, title, users.firstname as fname, users.lastname as lname, bill.creditDay as bcreditDay, bill.status as bstatus, transport");
	$this->db->from('bill');	
	$this->db->join('customer','customer.id=bill.customerID','left');
	$this->db->join('users','users.id=bill.userID');
	$this->db->where('bill.id', $id);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneQuotation($id=NULL)
 {
	$this->db->select("quotation.id as bid, quotationID, date, customerName, customerAddress, customerTel, customerFax, customerContact, quotation.discount as bdiscount, tax, title, users.firstname as fname, users.lastname as lname, quotation.creditDay as bcreditDay, quotation.status as bstatus, quotationDate");
	$this->db->from('quotation');	
	$this->db->join('customer','customer.id=quotation.customerID','left');
	$this->db->join('users','users.id=quotation.userID');
	$this->db->where('quotation.id', $id);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneBillProduct($billid=NULL)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("bill_product.productID as pid, amount, pricePerUnit, CONCAT(product.standardID,' ', product.name) as productname, unit, priceNoVAT, priceDiscount, tax, discount, discountPercent");
	$this->db->from('bill_product');	
	$this->db->join('product','product.id=bill_product.productID','left');
	$this->db->join('bill','bill.id=bill_product.billID','left');
	$this->db->where('bill_product.billID', $billid);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneQuotationProduct($billid=NULL)
 {
	$this->db->_protect_identifiers=false;
	$this->db->select("quotation_product.productID as pid, amount, pricePerUnit, CONCAT(product.standardID,' ', product.name) as productname, unit, priceNoVAT, priceDiscount, tax, discount, discountPercent");
	$this->db->from('quotation_product');	
	$this->db->join('product','product.id=quotation_product.productID','left');
	$this->db->join('quotation','quotation.id=quotation_product.quotationID','left');
	$this->db->where('quotation_product.quotationID', $billid);
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
 
 function addCashQuotationProduct($product=NULL)
 {
	$this->db->insert('quotation_product', $product);
	return $this->db->insert_id();
 }
 
 function addCashQuotation($bill=NULL)
 {
	$this->db->insert('quotation', $bill);
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
 
 function editAmountTemp($temp=NULL)
 {
	$this->db->where('tempid', $temp['tempid']);
	unset($stock['tempid']);
	$query = $this->db->update('bill_product_temp', $temp); 	
	return $query;
 }
 
 function editPriceTemp($temp=NULL)
 {
	$this->db->where('barcode', $temp['barcode']);
	unset($temp['barcode']);
	$query = $this->db->update('bill_product_temp', $temp); 	
	return $query;
 }
 
}
?>

