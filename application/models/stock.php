<?php
Class Stock extends CI_Model
{
 function getStock()
 {
	$this->db->select("id, productID, userID, onDate, branchID, status");
	$this->db->order_by("id", "asc");
	$this->db->from('stock_product');		
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getTemp($in=NULL)
 {
	$this->db->select("barcode, amount");
	$this->db->from('stock_product_temp');	
	$this->db->where('in', $in);
	$query = $this->db->get();			
	return $query->result();
 }
 
 function getProductID($barcode=NULL)
 {
	$this->db->select("id");
	$this->db->from('product');		
	$this->db->where('barcode', $barcode);
	$query = $this->db->get();	
	return $query->result();
	
 }
 
 function getTempCount($in=NULL)
 {
	$this->db->select("tempid");
	$this->db->from('stock_product_temp');		
	$this->db->where('in', $in);
	$query = $this->db->get();		
	return $query->num_rows();
 }

 function getStockFull()
 {
 	$this->db->select("stock_product.id, onDate, stock_product.status, standardID, supplierID, barcode, product.name, category.name, unit, username, firstname, lastname, branch.name, stock_product.detail");
 	$this->db->from("stock_product");
 	$this->db->join("product", "product.id = stock_product.productID");
 	$this->db->join("branch", "branch.id = stock_product.branchID");
 	$this->db->join("category", "category.id = product.categoryID");
 	$this->db->join("users", "users.id = stock_product.userID");
 	$query = $this->db->get();
 	return $query->result();
 }
 
 function getStockAmount($catid=NULL, $branchid=NULL)
 {
 	$query = $this->db->query('select productID, sum(subtotal) as amount from (select productID, count(*) as subtotal from stock_product where branchID = '.$branchid.' group by productID union all select productID, -count(*) from stock_out where branchID = '.$branchid.' group by productID ) as dt group by productID');
 	//$query = $this->db->get();
 	return $query->result();
 }
 
 function getOneStockIN($id=NULL)
 {
 	$this->db->select("stock_product.id as stockid, onDate, stock_product.status as stockstatus, stock_product.detail as stockdetail, standardID, supplierID, barcode, product.name as pname, category.name as cname, unit, username, firstname, lastname, branch.name as bname, category.id as categoryID");
 	$this->db->from("stock_product");
 	$this->db->join("product", "product.id = stock_product.productID");
 	$this->db->join("branch", "branch.id = stock_product.branchID");
 	$this->db->join("category", "category.id = product.categoryID");
 	$this->db->join("users", "users.id = stock_product.userID");
	$this->db->where("stock_product.id", $id);
 	$query = $this->db->get();
 	return $query->result();
 }
 
 function getOneStockOUT($id=NULL)
 {
 	$this->db->select("stock_out.id as stockid, onDate, stock_out.status as stockstatus, stock_out.detail as stockdetail, standardID, supplierID, barcode, product.name as pname, category.name as cname, unit, username, firstname, lastname, branch.name as bname, category.id as categoryID");
 	$this->db->from("stock_out");
 	$this->db->join("product", "product.id = stock_out.productID");
 	$this->db->join("branch", "branch.id = stock_out.branchID");
 	$this->db->join("category", "category.id = product.categoryID");
 	$this->db->join("users", "users.id = stock_out.userID");
	$this->db->where("stock_out.id", $id);
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
	$this->db->from('stock_product_temp');		
	$this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
 
 // check productID in stock exist or not
 function checkStock($productid=NULL, $branchid=NULL)
 {
	$this->db->select("productID");
	$this->db->from("stock");
	$this->db->where("productID", $productid);
	$this->db->where('branchID', $branchid);
	$query = $this->db->get();		
	return $query->num_rows();
 }
 
 // add new productid to stock table
 function addNewStockTable($stock=NULL)
 {
	$this->db->insert('stock', $stock);
	return $this->db->insert_id();	
 }
 
 function incrementStock($productid=NULL, $branchid=NULL, $amount=NULL)
 {
	$this->db->set('amount', 'amount+'.$amount, FALSE);
	$this->db->where('productID', $productid);
	$this->db->where('branchID', $branchid);
	$this->db->update('stock');
 }
 
 function decrementStock($productid=NULL, $branchid=NULL)
 {
	$this->db->set('amount', 'amount-1', FALSE);
	$this->db->where('productID', $productid);
	$this->db->where('branchID', $branchid);
	$this->db->update('stock');
 }

 function addStock($stock=NULL)
 {		
	$this->db->set('onDate', 'NOW()', FALSE);
	$this->db->insert('stock_product', $stock);
	return $this->db->insert_id();			
 }
 
 function addStockOut($stock=NULL)
 {		
	$this->db->set('onDate', 'NOW()', FALSE);
	$this->db->insert('stock_out', $stock);
	return $this->db->insert_id();			
 }
 
 function delStock($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('stock_product'); 
 }
 
 function delStockTemp($id=NULL)
 {
	$this->db->where('tempid', $id);
	$this->db->delete('stock_product_temp'); 
 }
 
 function delAllStockTemp($in=NULL)
 {
	$this->db->where('in', $in);
	$this->db->delete('stock_product_temp'); 
 }
 
 function editStock($stock=NULL)
 {
	$this->db->where('id', $stock['id']);
	unset($stock['id']);
	$query = $this->db->update('stock_product', $stock); 	
	return $query;
 }
 
 function addBarcodeTemp($barcode=NULL)
 {
	$this->db->insert('stock_product_temp', $barcode);
	return $this->db->insert_id();	
 }
 
 function editAmountTemp($stocktemp=NULL)
 {
	$this->db->where('tempid', $stocktemp['tempid']);
	unset($stock['tempid']);
	$query = $this->db->update('stock_product_temp', $stocktemp); 	
	return $query;
 }
 

}
?>