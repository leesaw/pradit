<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managestock extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('stock','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}

	function index()
	{
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$data['cat_array'] = array();

		$data['branchid'] = 0;
		$data['page'] = 0;
		$data['title'] = "Pradit and Friends - Stock Management";
		$this->load->view('stockproduct_view',$data);
		
	 
	}
	
	function viewStockByBranch()
	{
		$data['branchid'] = $this->uri->segment(3);
		
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		$data['page'] = 0;
		$data['title'] = "Pradit and Friends - Stock Management";
		$this->load->view('stockproduct_view',$data);
	}
	
	function viewStockBySelectedCat()
	{
		$catid = $this->uri->segment(3);
		$branchid = $this->uri->segment(4);
		
		
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
				
		
		$data['branchid'] = $branchid;
		$data['page'] = 1;
		$data['title'] = "Pradit and Friends - Stock Management";
		$this->load->view('stockproduct_view',$data);
	}

	function importstock() 
	{

		$data['title'] = "Pradit and Friends - Import Stock";
		$this->load->view("addstock_view", $data);
	}
	
	function exportstock() 
	{

		$data['title'] = "Pradit and Friends - Export Stock";
		$this->load->view("outstock_view", $data);
	}
	
	function returnstock() 
	{

		$data['title'] = "Pradit and Friends - Return Stock";
		$this->load->view("returnstock_view", $data);
	}

	function addstockfrombarcode()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->stock->getTempCount();
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_view", $data);
	}
	
	function returnstockfrombarcode()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->stock->getTempCount();
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("returnstockfrombarcode_view", $data);
	}
	
	function addstockfrombarcode_out()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->stock->getTempCount();
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_out_view", $data);
	}
		
	function saveBarcodeTemp_in()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));

			$row = $this->stock->checkBarcodeProduct($barcodeid);
			if ($row>0)	{
				$result = $this->stock->getTempID();
				foreach ($result as $loop)
				{
					$tempid = $loop->tempid;
				}
				$tempid++;
				$barcode = array(
					'barcode' => $barcodeid,
					'tempid' => $tempid,
					'in' => 1,
					'amount' => 1
				);
				$result2 = $this->stock->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->stock->getTempCount(1);
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_view", $data);
	}
	
	function saveBarcodeTemp_return()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));

			$row = $this->stock->checkBarcodeProduct($barcodeid);
			if ($row>0)	{
				$result = $this->stock->getTempID();
				foreach ($result as $loop)
				{
					$tempid = $loop->tempid;
				}
				$tempid++;
				$barcode = array(
					'barcode' => $barcodeid,
					'tempid' => $tempid,
					'in' => 2,
					'amount' => 1
				);
				$result2 = $this->stock->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->stock->getTempCount(1);
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_view", $data);
	}
	
	function saveBarcodeTemp_out()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));

			$row = $this->stock->checkBarcodeProduct($barcodeid);
			if ($row>0)	{
				$result = $this->stock->getTempID();
				foreach ($result as $loop)
				{
					$tempid = $loop->tempid;
				}
				$tempid++;
				$barcode = array(
					'barcode' => $barcodeid,
					'tempid' => $tempid,
					'in' => 0,
					'amount' => 1
				);
				$result2 = $this->stock->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->stock->getTempCount(0);
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_out_view", $data);
	}
	
	function ajaxGetStockAmount()
	{
		$catid = $this->uri->segment(3);
		$branchid = $this->uri->segment(4);
		$this->load->library('Datatables');
		$this->datatables
		->select("product.standardID as pstandardid, product.barcode as pbarcode, product.name as pname, category.name as cname, amount")
		->from("stock")
		->join("product","product.id=stock.productID")
		->join("category","product.categoryID=category.id")
		->where("product.categoryID",$catid)
		->where("stock.branchID",$branchid);
	
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockTemp()
	{
		$in = $this->uri->segment(3);
		$this->load->library('Datatables');
		$this->datatables
		->select("stock_product_temp.barcode, product.barcode as pbarcode, product.name as pname, stock_product_temp.amount as samount, unit, stock_product_temp.tempid as tempid")
		->from('stock_product_temp')
		->join('product', 'product.barcode = stock_product_temp.barcode','left')
		->join('category', 'product.categoryID = category.id','left')
		->where('in', $in)
		->edit_column("tempid",
		'<button class="btnAmount btn btn-success btn-xs" onclick="edit_amount($1)" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip" title="แก้ไขจำนวน"><span class="glyphicon glyphicon-plus"></span></button>
		<button class="btnDelete btn btn-danger btn-xs" onclick="del_confirm($1)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-remove"></span></button>
		',"tempid");
	
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryIn()
	{
		$catid = $this->uri->segment(3);
		$this->load->helper('date');
		$this->load->library('Datatables');
		$this->datatables
		->select("standardID, product.name as pname, category.name as cname, branch.name as bname, onDate, stock_product.id as stockid")
		->from('stock_product')
		->join('product', 'product.id = stock_product.productID','left')
		->join('category', 'product.categoryID = category.id','left')
		->join('branch', 'branch.id = stock_product.branchID','left')
		->where('category.id', $catid)
		//->edit_column("pid","$1","pid");
		
		->edit_column("stockid",'<div class="tooltip-demo">
	<a href="'.site_url("managestock/viewproductstockin/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"stockid");
		
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryReturn()
	{
		$catid = $this->uri->segment(3);
		$this->load->helper('date');
		$this->load->library('Datatables');
		$this->datatables
		->select("standardID, product.name as pname, category.name as cname, branch.name as bname, onDate, stock_return.id as stockid")
		->from('stock_return')
		->join('product', 'product.id = stock_return.productID','left')
		->join('category', 'product.categoryID = category.id','left')
		->join('branch', 'branch.id = stock_return.branchID','left')
		->where('category.id', $catid)
		//->edit_column("pid","$1","pid");
		
		->edit_column("stockid",'<div class="tooltip-demo">
	<a href="'.site_url("managestock/viewproductstockreturn/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"stockid");
		
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryOut()
	{
		$catid = $this->uri->segment(3);
		$this->load->helper('date');
		$this->load->library('Datatables');
		$this->datatables
		->select("standardID, product.name as pname, category.name as cname, branch.name as bname, onDate, stock_out.id as stockid")
		->from('stock_out')
		->join('product', 'product.id = stock_out.productID','left')
		->join('category', 'product.categoryID = category.id','left')
		->join('branch', 'branch.id = stock_out.branchID','left')
		->where('category.id', $catid)
		//->edit_column("pid","$1","pid");
		
		->edit_column("stockid",'<div class="tooltip-demo">
	<a href="'.site_url("managestock/viewproductstockout/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"stockid");
		
		echo $this->datatables->generate(); 
	}
	
	function deletestocktemp_in()
	{
		$id = $this->uri->segment(3);
		$result = $this->stock->delStockTemp($id);
		redirect('managestock/addstockfrombarcode', 'refresh');
	}
	
	function deletestocktemp_return()
	{
		$id = $this->uri->segment(3);
		$result = $this->stock->delStockTemp($id);
		redirect('managestock/returnstockfrombarcode', 'refresh');
	}
	
	function deletestocktemp_out()
	{
		$id = $this->uri->segment(3);
		$result = $this->stock->delStockTemp($id);
		redirect('managestock/addstockfrombarcode_out', 'refresh');
	}
	
	function cleartemp()
	{
		$in = $this->uri->segment(3);
		$result = $this->stock->delAllStockTemp($in);
		if ($in>0)	redirect('managestock/addstockfrombarcode', 'refresh');
		else redirect('managestock/addstockfrombarcode_out', 'refresh');
	}
	
	function savetemptostock()
	{
		
		$branchid = ($this->input->post('branchid'));
		$status = ($this->input->post('status'));
		$detail = ($this->input->post('detail'));
		$userid = $this->session->userdata('sessid');
		
		$barcode = array(
			'branchID' => $branchid,
			'status' => $status,
			'userID' => $userid,
			'detail' => $detail
		);
		
		$query = $this->stock->getTemp(1);
		
		foreach($query as $loop) {
			$barcodeid = $loop->barcode;
			$amount = $loop->amount;
			$barcode['amount'] = $amount;
			
			$query2 = $this->stock->getProductID($barcodeid);
			foreach($query2 as $loop2) {
				$productid = $loop2->id;
				$barcode['productID'] = $productid;
			}
			$this->stock->addStock($barcode);
			// increment amount in stock table
			if ($this->stock->checkStock($productid,$branchid)<1) {
				$pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
				$this->stock->addNewStockTable($pid);
			}
			$this->stock->incrementStock($productid,$branchid,$amount);
		}
		
		$this->stock->delAllStockTemp(1);
		
		echo '<script type="text/javascript">parent.$.fancybox.close();</script>';
		
	}
	
	function savetemptostock_return()
	{
		
		$branchid = ($this->input->post('branchid'));
		$billid = ($this->input->post('billid'));
		$detail = ($this->input->post('detail'));
		$userid = $this->session->userdata('sessid');
		
			
		$barcode = array(
			'branchID' => $branchid,
			'billID' => $billid,
			'userID' => $userid,
			'detail' => $detail
		);
		
		$query = $this->stock->getTemp(2);
		
		foreach($query as $loop) {
			$barcodeid = $loop->barcode;
			$amount = $loop->amount;
			$barcode['amount'] = $amount;
			
			$query2 = $this->stock->getProductID($barcodeid);
			foreach($query2 as $loop2) {
				$productid = $loop2->id;
				$barcode['productID'] = $productid;
			}
			
			$this->stock->addStock_return($barcode);
			// increment amount in stock table
			if ($this->stock->checkStock($productid,$branchid)<1) {
				$pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
				$this->stock->addNewStockTable($pid);
			}
			$this->stock->incrementStock($productid,$branchid,$amount);
		}
		
		$this->stock->delAllStockTemp(2);
		
		echo '<script type="text/javascript">parent.$.fancybox.close();</script>';
		
	}
	
	function savetemptostock_out()
	{
		
		$branchid = ($this->input->post('branchid'));
		$status = ($this->input->post('status'));
		$detail = ($this->input->post('detail'));
		$userid = $this->session->userdata('sessid');
		
		$barcode = array(
			'branchID' => $branchid,
			'status' => $status,
			'userID' => $userid,
			'detail' => $detail
		);
		
		$query = $this->stock->getTemp(0);
		
		foreach($query as $loop) {
			$barcodeid = $loop->barcode;
			$amount = $loop->amount;
			$barcode['amount'] = $amount;
			
			$query2 = $this->stock->getProductID($barcodeid);
			foreach($query2 as $loop2) {
				$productid = $loop2->id;
				$barcode['productID'] = $productid;
			}
			$this->stock->addStockOut($barcode);
			// decrement amount in stock table
			if ($this->stock->checkStock($productid,$branchid)<1) {
				$pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
				$this->stock->addNewStockTable($pid);
			}
			$this->stock->decrementStock($productid,$branchid,$amount);
		}
		
		$this->stock->delAllStockTemp(0);
		
		echo '<script type="text/javascript">parent.$.fancybox.close();</script>';
		
	}
	
	function showtemptostock()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
		$data['count'] = $this->stock->getTempCount();
		
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("adddetailtotemp_view", $data);
	}
	
	function showtemptostock_return()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
		$data['count'] = $this->stock->getTempCount();
		
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("adddetailtotemp_return_view", $data);
	}
	
	function showtemptostock_out()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
		$data['count'] = $this->stock->getTempCount(0);
		
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("adddetailtotemp_out_view", $data);
	}
	
	function historyimportstock()
	{
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}

		$data['page'] = 0;
		
		$data['title'] = "Pradit and Friends - History Stock";
		$this->load->view('historystockin_view',$data);
	}
	
	function historyreturnstock()
	{
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}

		$data['page'] = 0;
		
		$data['title'] = "Pradit and Friends - History Stock";
		$this->load->view('historystockreturn_view',$data);
	}
	
	function viewStockINSelectedCat() {
		$catid = $this->uri->segment(3);
		
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		$data['page'] = 1;
		$data['title'] = "Pradit and Friends - History Stock";
		$this->load->view('historystockin_view',$data);
	}
	
	function viewStockReturnSelectedCat() {
		$catid = $this->uri->segment(3);
		
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		$data['page'] = 1;
		$data['title'] = "Pradit and Friends - History Stock";
		$this->load->view('historystockreturn_view',$data);
	}
	
	function viewproductstockin()
	{
		$id = $this->uri->segment(3);
		$query = $this->stock->getOneStockIN($id);
		if($query){
			$data['stock_array'] =  $query;
		}
		
		$data['title'] = "Pradit and Friends - View Product";
		$this->load->view('viewstockproduct_in_view',$data);
	}
	
	function viewproductstockreturn()
	{
		$id = $this->uri->segment(3);
		$query = $this->stock->getOneStockReturn($id);
		if($query){
			$data['stock_array'] =  $query;
		}
		
		$this->load->model('bill','',TRUE);
		
		foreach($query as $loop) {
			$billid = $loop->stockbillid;
		}
		
		$query = $this->bill->checkIDBillid($billid);
		foreach($query as $loop) {
			$data['bid'] = $loop->id;
		}
		
		$data['title'] = "Pradit and Friends - View Product";
		$this->load->view('viewstockproduct_return_view',$data);
	}
	
	function historyexportstock()
	{
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}

		$data['page'] = 0;
		
		$data['title'] = "Pradit and Friends - History Stock";
		$this->load->view('historystockout_view',$data);
	}
	
	function viewStockOUTSelectedCat() {
		$catid = $this->uri->segment(3);
		
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		$data['page'] = 1;
		$data['title'] = "Pradit and Friends - History Stock";
		$this->load->view('historystockout_view',$data);
	}
	
	function viewproductstockout()
	{
		$id = $this->uri->segment(3);
		$query = $this->stock->getOneStockOUT($id);
		if($query){
			$data['stock_array'] =  $query;
		}
		
		$data['title'] = "Pradit and Friends - View Product";
		$this->load->view('viewstockproduct_out_view',$data);
	}
	
	function edit_amount_temp_in()
	{
		$tempid=$this->input->post('tempid');
		$amount=$this->input->post('amount');
		$stocktemp = array(
					'tempid' => $tempid,
					'amount' => $amount
				);
		$query = $this->stock->editAmountTemp($stocktemp);
		
	}
}