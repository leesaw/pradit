<?php
Class Stock extends CI_Model
{
 function getStock()
 {
	$this->db->select("id, productID, userID, onDate, branchID, status, amount");
	$this->db->order_by("id", "asc");
	$this->db->from('stock_product');		
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getTemp($in=NULL,$userid=null)
 {
	$this->db->select("barcode, sum(amount) as amount");
	$this->db->from('stock_product_temp');	
	$this->db->where('in', $in);
    $this->db->where('userid',$userid);
    $this->db->group_by('barcode');
	$query = $this->db->get();			
	return $query->result();
 }
 
 function getProductID($barcode=NULL)
 {
	$this->db->select("product.id, amount");
	$this->db->from('product');	
    $this->db->join('stock','stock.productID = product.id');
	$this->db->where('barcode', $barcode);
	$query = $this->db->get();	
	return $query->result();
	
 }
    
 function getProductIDfromBarcode($barcode=null)
 {
    $this->db->select("product.id");
	$this->db->from('product');	
	$this->db->where('barcode', $barcode);
    $this->db->limit(1); 
	$query = $this->db->get();	
	return $query->result();
 }
 
 function getTempCount($in=NULL,$userid=null)
 {
	$this->db->select("tempid");
	$this->db->from('stock_product_temp');		
	$this->db->where('in', $in);
    $this->db->where('userid',$userid);
	$query = $this->db->get();		
	return $query->num_rows();
 }

 function getStockFull()
 {
 	$this->db->select("stock_product.id, onDate, stock_product.status, standardID, supplierID, barcode, product.name, category.name, unit, username, firstname, lastname, branch.name, stock_product.detail, amount");
 	$this->db->from("stock_product");
 	$this->db->join("product", "product.id = stock_product.productID",'left');
 	$this->db->join("branch", "branch.id = stock_product.branchID",'left');
 	$this->db->join("category", "category.id = product.categoryID",'left');
 	$this->db->join("users", "users.id = stock_product.userID",'left');
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
 	$this->db->select("stock_product.id as stockid, onDate, stock_product.status as stockstatus, stock_product.detail as stockdetail, standardID, supplierID, barcode, product.name as pname, category.name as cname, unit, username, firstname, lastname, branch.name as bname, category.id as categoryID, amount");
 	$this->db->from("stock_product");
 	$this->db->join("product", "product.id = stock_product.productID",'left');
 	$this->db->join("branch", "branch.id = stock_product.branchID",'left');
 	$this->db->join("category", "category.id = product.categoryID",'left');
 	$this->db->join("users", "users.id = stock_product.userID",'left');
	$this->db->where("stock_product.id", $id);
 	$query = $this->db->get();
 	return $query->result();
 }
 
 function getOneStockReturn($id=NULL)
 {
 	$this->db->select("stock_return.id as stockid, onDate, stock_return.billID as stockbillid, stock_return.detail as stockdetail, standardID, supplierID, barcode, product.name as pname, category.name as cname, unit, username, firstname, lastname, branch.name as bname, category.id as categoryID, amount");
 	$this->db->from("stock_return");
 	$this->db->join("product", "product.id = stock_return.productID",'left');
 	$this->db->join("branch", "branch.id = stock_return.branchID",'left');
 	$this->db->join("category", "category.id = product.categoryID",'left');
 	$this->db->join("users", "users.id = stock_return.userID",'left');
	$this->db->where("stock_return.id", $id);
 	$query = $this->db->get();
 	return $query->result();
 }
 
 function getOneStockOUT($id=NULL)
 {
 	$this->db->select("stock_out.id as stockid, onDate, stock_out.status as stockstatus, stock_out.detail as stockdetail, standardID, supplierID, barcode, product.name as pname, category.name as cname, unit, username, firstname, lastname, branch.name as bname, category.id as categoryID, amount, priceVAT");
 	$this->db->from("stock_out");
 	$this->db->join("product", "product.id = stock_out.productID",'left');
 	$this->db->join("branch", "branch.id = stock_out.branchID",'left');
 	$this->db->join("category", "category.id = product.categoryID",'left');
 	$this->db->join("users", "users.id = stock_out.userID",'left');
	$this->db->where("stock_out.id", $id);
 	$query = $this->db->get();
 	return $query->result();
 }
    
 function getOneStockOUTprint($id=null)
 {
 	$this->db->select("stock_out.id as stockid, onDate, stock_out.status as stockstatus, stock_out.detail as stockdetail, standardID, supplierID, barcode, product.name as pname, category.name as cname, unit, username, firstname, lastname, branch.name as bname, category.id as categoryID, stock_out.amount, priceVAT, stock_out.stock as stockamount");
 	$this->db->from("stock_out");
 	$this->db->join("product", "product.id = stock_out.productID",'left');
 	$this->db->join("branch", "branch.id = stock_out.branchID",'left');
 	$this->db->join("category", "category.id = product.categoryID",'left');
 	$this->db->join("users", "users.id = stock_out.userID",'left');
    $this->db->join("stock", "stock.productID = stock_out.productID");
	$this->db->where("stock_out.listid", $id);
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
    
 function getMaxlist()
 {
	$this->db->select("MAX(listid) as max");
	$this->db->from('stock_out');		
	$query = $this->db->get();		
	return $query->result_array();
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
 
 function decrementStock($productid=NULL, $branchid=NULL, $amount=NULL)
 {
	$this->db->set('amount', 'amount-'.$amount, FALSE);
	$this->db->where('productID', $productid);
	$this->db->where('branchID', $branchid);
	$this->db->update('stock');
 }

 function addStock($stock=NULL)
 {		
    $currentdate= explode('/',date("d/m/Y/H/i/s"));
    $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
	$this->db->set('onDate', $currentdate);
	$this->db->insert('stock_product', $stock);
	return $this->db->insert_id();			
 }
 
 function addStock_return($stock=NULL)
 {		
	$currentdate= explode('/',date("d/m/Y/H/i/s"));
    $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
	$this->db->set('onDate', $currentdate);
	$this->db->insert('stock_return', $stock);
	return $this->db->insert_id();			
 }
 
 function addStockOut($stock=NULL)
 {		
	$currentdate= explode('/',date("d/m/Y/H/i/s"));
    $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
	$this->db->set('onDate', $currentdate);
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
 
 function delAllStockTemp($in=NULL,$userid=NULL)
 {
	$this->db->where('in', $in);
    $this->db->where('userid',$userid);
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
    
 function copyTemptoStock_in($userid,$branch,$status,$detail)
 {
    $currentdate= explode('/',date("d/m/Y/H/i/s"));
    $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
     
    $sql = "insert into stock_product(productID,amount,userID,onDate,branchID,status,detail) ";
    $sql .=  "select product.id,sum(amount),'".$userid."','".$currentdate."','".$branch."','".$status."','".$detail."' ";
    $sql .= "from stock_product_temp left join product on stock_product_temp.barcode=product.barcode ";
    $sql .= "where `in`='1' and stock_product_temp.userid='".$userid."' group by stock_product_temp.barcode";
    $result = $this->db->query($sql);
    
    $sql2 = "select product.id,sum(amount) as samount from stock_product_temp left join product on stock_product_temp.barcode=product.barcode "; 
    $sql2 .= "where `in`='1' and stock_product_temp.userid='".$userid."' group by stock_product_temp.barcode";
     
    $query = $this->db->query($sql2);
    $this->delAllStockTemp(1,$userid);
    foreach ($query->result() as $row)
    {
        $productid = $row->id;
        $amount = $row->samount;
        if ($this->checkStock($productid,$branch)<1) {
            $pid = array('productID'=>$productid, 'branchID'=>$branch,'amount' =>0);
            $this->addNewStockTable($pid);
        }
        $this->incrementStock($productid,$branch,$amount);
    }
    
 }
    
 function copyTemptoStock_return($userid,$branch,$billid,$detail)
 {
    $currentdate= explode('/',date("d/m/Y/H/i/s"));
    $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
     
    $sql = "insert into stock_return(productID,amount,userID,onDate,branchID,billid,detail) ";
    $sql .=  "select product.id,sum(amount),'".$userid."','".$currentdate."','".$branch."','".$billid."','".$detail."' ";
    $sql .= "from stock_product_temp left join product on stock_product_temp.barcode=product.barcode ";
    $sql .= "where `in`='2' and stock_product_temp.userid='".$userid."' group by stock_product_temp.barcode";
    $result = $this->db->query($sql);
    
    $sql2 = "select product.id,sum(amount) as samount from stock_product_temp left join product on stock_product_temp.barcode=product.barcode "; 
    $sql2 .= "where `in`='2' and stock_product_temp.userid='".$userid."' group by stock_product_temp.barcode";
     
    $query = $this->db->query($sql2);
    $this->delAllStockTemp(2,$userid);
    foreach ($query->result() as $row)
    {
        $productid = $row->id;
        $amount = $row->samount;
        if ($this->checkStock($productid,$branch)<1) {
            $pid = array('productID'=>$productid, 'branchID'=>$branch,'amount' =>0);
            $this->addNewStockTable($pid);
        }
        $this->incrementStock($productid,$branch,$amount);
    }
    
 }
    
 function copyTemptoStock_out($userid,$branch,$billid,$detail,$listid)
 {
    $currentdate= explode('/',date("d/m/Y/H/i/s"));
    $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
     
    $sql = "insert into stock_out(productID,amount,stock,userID,onDate,branchID,status,detail,listid) ";
    $sql .=  "select product.id,sum(stock_product_temp.amount),stock.amount,'".$userid."','".$currentdate."','".$branch."','".$billid."','".$detail."','".$listid."' ";
    $sql .= "from stock_product_temp left join product on stock_product_temp.barcode=product.barcode left join stock on stock.productID=product.id ";
    $sql .= "where `in`='0' and stock_product_temp.userid='".$userid."' group by stock_product_temp.barcode";
    $result = $this->db->query($sql);
    
    $sql2 = "select product.id,sum(amount) as samount from stock_product_temp left join product on stock_product_temp.barcode=product.barcode "; 
    $sql2 .= "where `in`='0' and stock_product_temp.userid='".$userid."' group by stock_product_temp.barcode";
     
    $query = $this->db->query($sql2);
    $this->delAllStockTemp(0,$userid);
    foreach ($query->result() as $row)
    {
        $productid = $row->id;
        $amount = $row->samount;
        if ($this->checkStock($productid,$branch)<1) {
            $pid = array('productID'=>$productid, 'branchID'=>$branch,'amount' =>0);
            $this->addNewStockTable($pid);
        }
        $this->decrementStock($productid,$branch,$amount);
    }
    
 }
 

}
?>