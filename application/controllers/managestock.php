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
		
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}

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
        
		$data['count'] = $this->stock->getTempCount(1,$this->session->userdata('sessid'));
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_view", $data);
	}
	
	function returnstockfrombarcode()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->stock->getTempCount(2,$this->session->userdata('sessid'));
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("returnstockfrombarcode_view", $data);
	}
	
	function addstockfrombarcode_out()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->stock->getTempCount(3,$this->session->userdata('sessid'));
		
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_out_view", $data);
	}
		
	function saveBarcodeTemp_in()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
        
        $userid = $this->session->userdata("sessid");
		
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
					'amount' => 1,
                    'userid' => $userid
                    
				);
				$result2 = $this->stock->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->stock->getTempCount(1,$userid);
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_view", $data);
	}
	
	function saveBarcodeTemp_return()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
        
        $userid = $this->session->userdata("sessid");
		
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
					'amount' => 1,
                    'userid' => $userid
				);
				$result2 = $this->stock->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->stock->getTempCount(1,$userid);
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("returnstockfrombarcode_view", $data);
	}
	
	function saveBarcodeTemp_out()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
        
        $userid = $this->session->userdata("sessid");
		
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
					'amount' => 1,
                    'userid' => $userid
				);
				$result2 = $this->stock->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->stock->getTempCount(0,$userid);
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addstockfrombarcode_out_view", $data);
	}
	
	function ajaxGetStockAmount()
	{
		$catid = $this->uri->segment(3);
		$branchid = $this->uri->segment(4);
		$this->load->library('Datatables');
        if ($catid>0) {
		$this->datatables
		->select("product.standardID as pstandardid, product.barcode as pbarcode, product.name as pname, category.name as cname, amount")
		->from("stock")
		->join("product","product.id=stock.productID")
		->join("category","product.categoryID=category.id")
		->where("product.categoryID",$catid)
		->where("stock.branchID",$branchid);
        
        }else{
            $this->datatables
		->select("product.standardID as pstandardid, product.barcode as pbarcode, product.name as pname, category.name as cname, amount")
		->from("stock")
		->join("product","product.id=stock.productID")
		->join("category","product.categoryID=category.id")
		//->where("product.categoryID",$catid)
		->where("stock.branchID",$branchid);
        }
	
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockTemp()
	{
		$in = $this->uri->segment(3);
        $userid = $this->session->userdata('sessid');
		$this->load->library('Datatables');
		$this->datatables
		->select("stock_product_temp.barcode, product.barcode as pbarcode, product.name as pname, stock_product_temp.amount as samount, unit, stock_product_temp.tempid as tempid")
		->from('stock_product_temp')
		->join('product', 'product.barcode = stock_product_temp.barcode','left')
		->join('category', 'product.categoryID = category.id','left')
		->where('in', $in)
        ->where('stock_product_temp.userid', $userid)
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
        if ($catid>0) {
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
            
        }else{
            
        $this->datatables
		->select("standardID, product.name as pname, category.name as cname, branch.name as bname, onDate, stock_product.id as stockid")
		->from('stock_product')
		->join('product', 'product.id = stock_product.productID','left')
		->join('category', 'product.categoryID = category.id','left')
		->join('branch', 'branch.id = stock_product.branchID','left')
		//->where('category.id', $catid)
		//->edit_column("pid","$1","pid");
		
		->edit_column("stockid",'<div class="tooltip-demo">
	<a href="'.site_url("managestock/viewproductstockin/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"stockid");
            
        }
		
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryReturn()
	{
		$catid = $this->uri->segment(3);
		$this->load->helper('date');
		$this->load->library('Datatables');
        if ($catid>0) {
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
            
        }else{
            $this->datatables
		->select("standardID, product.name as pname, category.name as cname, branch.name as bname, onDate, stock_return.id as stockid")
		->from('stock_return')
		->join('product', 'product.id = stock_return.productID','left')
		->join('category', 'product.categoryID = category.id','left')
		->join('branch', 'branch.id = stock_return.branchID','left')
		//->where('category.id', $catid)
		//->edit_column("pid","$1","pid");
		
		->edit_column("stockid",'<div class="tooltip-demo">
	<a href="'.site_url("managestock/viewproductstockreturn/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"stockid");
        }
		
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryOut()
	{
		$catid = $this->uri->segment(3);
		$this->load->helper('date');
		$this->load->library('Datatables');
        if ($catid>0) {
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
            
        }else{
            $this->datatables
		->select("standardID, product.name as pname, category.name as cname, branch.name as bname, onDate, stock_out.id as stockid")
		->from('stock_out')
		->join('product', 'product.id = stock_out.productID','left')
		->join('category', 'product.categoryID = category.id','left')
		->join('branch', 'branch.id = stock_out.branchID','left')
		//->where('category.id', $catid)
		//->edit_column("pid","$1","pid");
		
		->edit_column("stockid",'<div class="tooltip-demo">
	<a href="'.site_url("managestock/viewproductstockout/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"stockid");
            
        }
		
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
        $userid = $this->session->userdata('sessid');
		$result = $this->stock->delAllStockTemp($in,$userid);
		if ($in>0)	redirect('managestock/addstockfrombarcode', 'refresh');
		else redirect('managestock/addstockfrombarcode_out', 'refresh');
	}
    
    function clearproduct_status0()
	{
		$table = $this->uri->segment(3);
        $userid = $this->session->userdata('sessid');
		$result = $this->stock->delAllStockProduct_status0($userid);
		redirect('managestock/addstockfrombarcode', 'refresh');
	}
	
	function savetemptostock()
	{
        /*
		if ($this->session->userdata('postdata') == FALSE) {
            $testpost = 1;
            $this->session->set_userdata('postdata',1);
        }else{
            $testpost = 2;
        }
        */

            $branchid = ($this->input->post('branchid'));
            $status = ($this->input->post('status'));
            //$carnumber = ($this->input->post('carnumber'));
            //$customername = ($this->input->post('customername'));
            $detail = ($this->input->post('detail'));
            $userid = $this->session->userdata('sessid');
        
            $currentdate= explode('/',date("d/m/Y/H/i/s"));
            $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
            
            $stock = array(
                'branchID' => $branchid,
                'status' => $status,
                //'carNumber' => $carnumber,
                //'customerName' => $customername,
                'onDate' => $currentdate,
                'detail' => $detail
		    );
        
            $query = $this->stock->getStockProduct_status0($this->session->userdata('sessid'));
            foreach($query as $loop) {
                $id = $loop->sid;
                $productid = $loop->pid;
                $amount = $loop->samount;
                $stock['id'] = $id;
                $this->stock->editStockProduct($stock);
                
                if ($this->stock->checkStock($productid,$branchid)<1) {
                    $pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
                    $this->stock->addNewStockTable($pid);
			    }
                $this->stock->incrementStock($productid,$branchid,$amount);
            }
        /*
        if ($testpost < 2) {
            $this->stock->copyTemptoStock_in($userid,$branchid,$status,$detail);
            $this->session->unset_userdata('postdata');
        }
		
		$query = $this->stock->getTemp(1,$userid);
		
		foreach($query as $loop) {
            
            $barcode = array(
                'branchID' => $branchid,
                'status' => $status,
                'userID' => $userid,
                'detail' => $detail
		    );
            
			$barcodeid = $loop->barcode;
			$amount = $loop->amount;
			$barcode['amount'] = $amount;
			
			$query2 = $this->stock->getProductIDfromBarcode($barcodeid);
			foreach($query2 as $loop2) {
				$productid = $loop2->id;
				$barcode['productID'] = $productid;
                break;
			}
			$this->stock->addStock($barcode);
			// increment amount in stock table
			if ($this->stock->checkStock($productid,$branchid)<1) {
				$pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
				$this->stock->addNewStockTable($pid);
			}
			$this->stock->incrementStock($productid,$branchid,$amount);
            unset($barcode);
		}
		*/
		$this->stock->delAllStockTemp(1,$userid);
        $this->session->set_flashdata('showresult', 'success');
        redirect('managestock/addstockfrombarcode', 'refresh');
        //echo '<script type="text/javascript">parent.$.fancybox.close();</script>';
		
	}
	
	function savetemptostock_return()
	{
		$branchid = ($this->input->post('branchid'));
		$billid = ($this->input->post('billid'));
		$detail = ($this->input->post('detail'));
		$userid = $this->session->userdata('sessid');
        $currentdate= explode('/',date("d/m/Y/H/i/s"));
        $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
        
        $stock = array(
                'branchID' => $branchid,
                'billID' => $billid,
                //'carNumber' => $carnumber,
                //'customerName' => $customername,
                'onDate' => $currentdate,
                'detail' => $detail
		    );
        
            $query = $this->stock->getStockReturn_status0($this->session->userdata('sessid'));
            foreach($query as $loop) {
                $id = $loop->sid;
                $productid = $loop->pid;
                $amount = $loop->samount;
                $stock['id'] = $id;
                $this->stock->editStockReturn($stock);
                
                if ($this->stock->checkStock($productid,$branchid)<1) {
                    $pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
                    $this->stock->addNewStockTable($pid);
			    }
                $this->stock->incrementStock($productid,$branchid,$amount);
            }
        /*
        if ($testpost < 2) {
            $this->stock->copyTemptoStock_return($userid,$branchid,$billid,$detail);
            $this->session->unset_userdata('postdata');
        }

		$query = $this->stock->getTemp(2,$userid);
		
		foreach($query as $loop) {
            $barcode = array(
                'branchID' => $branchid,
                'billID' => $billid,
                'userID' => $userid,
                'detail' => $detail
            );
            
			$barcodeid = $loop->barcode;
			$amount = $loop->amount;
			$barcode['amount'] = $amount;
			
			$query2 = $this->stock->getProductIDfromBarcode($barcodeid);
			foreach($query2 as $loop2) {
				$productid = $loop2->id;
				$barcode['productID'] = $productid;
                break;
			}
			
			$this->stock->addStock_return($barcode);
			// increment amount in stock table
			if ($this->stock->checkStock($productid,$branchid)<1) {
				$pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
				$this->stock->addNewStockTable($pid);
			}
			$this->stock->incrementStock($productid,$branchid,$amount);
            unset($barcode);
		}
        
		*/
		$this->stock->delAllStockTemp(2,$userid);
        $this->session->set_flashdata('showresult', 'success');
        redirect('managestock/returnstockfrombarcode', 'refresh');
		
	}
	
	function savetemptostock_out()
	{

            $branchid = ($this->input->post('branchid'));
            $status = ($this->input->post('status'));
            $carnumber = ($this->input->post('carnumber'));
            $customername = ($this->input->post('customername'));
            $detail = ($this->input->post('detail'));
            $userid = $this->session->userdata('sessid');
        
            $currentdate= explode('/',date("d/m/Y/H/i/s"));
            $currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0]." ".$currentdate[3].":".$currentdate[4].":".$currentdate[5];
        
        
            $stock = array(
                'branchID' => $branchid,
                'status' => $status,
                'carNumber' => $carnumber,
                'customerName' => $customername,
                'onDate' => $currentdate,
                'detail' => $detail
		    );
        
            $query = $this->stock->getStockOut_status0($this->session->userdata('sessid'));
            foreach($query as $loop) {
                $id = $loop->sid;
                $productid = $loop->pid;
                $amount = $loop->samount;
                $barcodeid = $loop->pbarcode;
                $listid = $loop->listid;
                $stock['id'] = $id;
                
                $query2 = $this->stock->getProductID_branch($barcodeid,$branchid);
                foreach($query2 as $loop2) {
                    $stock['stock'] = $loop2->amount;
                }
                
                $this->stock->editStockOut($stock);
                
                if ($this->stock->checkStock($productid,$branchid)<1) {
                    $pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
                    $this->stock->addNewStockTable($pid);
			    }
                $this->stock->decrementStock($productid,$branchid,$amount);
            }
		/*
        if ($testpost < 2) {
            $this->stock->copyTemptoStock_out($userid,$branchid,$status,$detail,$listid);
            $this->session->unset_userdata('postdata');
        }
        
		
		$query = $this->stock->getTemp(0,$userid);
		
		foreach($query as $loop) {
            $barcode = array(
                'branchID' => $branchid,
                'status' => $status,
                'userID' => $userid,
                'detail' => $detail,
                'listid' => $listid
            );
			$barcodeid = $loop->barcode;
			$amount = $loop->amount;
			$barcode['amount'] = $amount;
			
			$query2 = $this->stock->getProductIDfromBarcode($barcodeid);
			foreach($query2 as $loop2) {
				$productid = $loop2->id;
				$barcode['productID'] = $productid;
                break;
                //$barcode['stock'] = $loop2->amount;
			}
            
			$query2 = $this->stock->getProductID($barcodeid);
            foreach($query2 as $loop2) {
                $barcode['stock'] = $loop2->amount;
			}
            
			$this->stock->addStockOut($barcode);
			// decrement amount in stock table
			if ($this->stock->checkStock($productid,$branchid)<1) {
				$pid = array('productID'=>$productid, 'branchID'=>$branchid,'amount' =>0);
				$this->stock->addNewStockTable($pid);
			}
            
            
            
			$this->stock->decrementStock($productid,$branchid,$amount);
            unset($barcode);
		}
		*/
		$this->stock->delAllStockTemp(0,$userid);
		$this->session->set_flashdata('showresult', 'success');
		//echo '<script type="text/javascript">parent.$.fancybox.close();</script>';
        
        $data['listid'] = $listid;
        $data['title'] = "Print out";
        $this->load->view("showstockout_view", $data);
        //redirect('managestock/printStockOut/'.$listid, 'location');
		
	}
	
	function showtemptostock()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
        $this->stock->delAllStockProduct_status0($this->session->userdata('sessid'));
		//$data['count'] = $this->stock->getTempCount(1,$this->session->userdata('sessid'));

        $this->stock->copyTempProduct($this->session->userdata('sessid'));
        
        $query = $this->stock->getStockProduct_status0($this->session->userdata('sessid'));
        if($query){
			$data['product_array'] =  $query;
		}else{
			$data['product_array'] = array();
		}
		
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		
		$data['title'] = "Pradit and Friends - Add Detail";
		$this->load->view("adddetailtotemp_view", $data);
	}
	
	function showtemptostock_return()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
		$this->stock->delAllStockReturn_status0($this->session->userdata('sessid'));
		//$data['count'] = $this->stock->getTempCount(1,$this->session->userdata('sessid'));

        $this->stock->copyTempProduct_return($this->session->userdata('sessid'));
        
        $query = $this->stock->getStockReturn_status0($this->session->userdata('sessid'));
        if($query){
			$data['product_array'] =  $query;
		}else{
			$data['product_array'] = array();
		}
		
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
		
		$this->stock->delAllStockOut_status0($this->session->userdata('sessid'));
        
        $listid = $this->stock->getMaxlist()[0]['max'];
        $listid++;
        
		$this->stock->copyTempProduct_out($this->session->userdata('sessid'),$listid);
        
        $query = $this->stock->getStockOut_status0($this->session->userdata('sessid'));
        if($query){
			$data['product_array'] =  $query;
		}else{
			$data['product_array'] = array();
		}
        
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
    
    function historystockexcel_in()
    {
        $this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย, priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน, onDate as วันและเวลา, case stock_product.status when 1 then 'ซื้อเข้า' when 2 then 'ย้ายคลัง' end as สถานะ,  stock_product.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_product";
		$sql .= " left join product on product.id = stock_product.productID";
		$sql .= " left join branch on branch.id = stock_product.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_product.userID";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
        
    }
	
	function historystockexcel_out()
    {
        $this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน,onDate as วันและเวลา, case stock_out.status when 1 then 'ขายออก' when 2 then 'ย้ายคลัง' when 3 then 'เบิกใช้ซ่อม' when 4 then 'ของเคลม' when 5 then 'ของแถม' end as สถานะ, stock_out.carNumber as หมายเลขรถ, stock_out.customerName as ชื่อลูกค้า, stock_out.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_out";
		$sql .= " left join product on product.id = stock_out.productID";
		$sql .= " left join branch on branch.id = stock_out.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_out.userID";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
        
    }
	
	function historystockexcel_return()
    {
        $this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน,onDate as วันและเวลา,  stock_return.detail as รายละเอียด, stock_return.billID as เลขที่ใบส่งของ ,barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_return";
		$sql .= " left join product on product.id = stock_return.productID";
		$sql .= " left join branch on branch.id = stock_return.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_return.userID";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
        
    }
	
	function excelbetweendate_in()
	{
		$start = $this->input->post("startdate");
		if ($start != "") {
			$start = explode('/', $start);
			$start= $start[2]."-".$start[1]."-".$start[0];
		}
		$end = $this->input->post("enddate");
		if ($end != "") {
			$end = explode('/', $end);
			$end= $end[2]."-".$end[1]."-".$end[0];
		}
		
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน,onDate as วันและเวลา, case stock_product.status when 1 then 'ซื้อเข้า' when 2 then 'ย้ายคลัง' end as สถานะ, stock_product.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_product";
		$sql .= " left join product on product.id = stock_product.productID";
		$sql .= " left join branch on branch.id = stock_product.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_product.userID";
		$sql .= " where onDate between '".$start."' and '".$end." 23:59:59.999'";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
	
	function excelbetweendate_out()
	{
		$start = $this->input->post("startdate");
		if ($start != "") {
			$start = explode('/', $start);
			$start= $start[2]."-".$start[1]."-".$start[0];
		}
		$end = $this->input->post("enddate");
		if ($end != "") {
			$end = explode('/', $end);
			$end= $end[2]."-".$end[1]."-".$end[0];
		}
		
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน,onDate as วันและเวลา, case stock_out.status when 1 then 'ขายออก' when 2 then 'ย้ายคลัง' when 3 then 'เบิกใช้ซ่อม' when 4 then 'ของเคลม' when 5 then 'ของแถม' end as สถานะ, stock_out.carNumber as หมายเลขรถ, stock_out.customerName as ชื่อลูกค้า, stock_out.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_out";
		$sql .= " left join product on product.id = stock_out.productID";
		$sql .= " left join branch on branch.id = stock_out.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_out.userID";
		$sql .= " where onDate between '".$start."' and '".$end." 23:59:59.999'";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
    
    function excelcarnumber_out()
	{	
        $carnumber = $this->input->post("carnumber");
        $start = $this->input->post("startdate");
		if ($start != "") {
			$start = explode('/', $start);
			$start= $start[2]."-".$start[1]."-".$start[0];
		}
		$end = $this->input->post("enddate");
		if ($end != "") {
			$end = explode('/', $end);
			$end= $end[2]."-".$end[1]."-".$end[0];
		}
        
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน,onDate as วันและเวลา, case stock_out.status when 1 then 'ขายออก' when 2 then 'ย้ายคลัง' when 3 then 'เบิกใช้ซ่อม' when 4 then 'ของเคลม' when 5 then 'ของแถม' end as สถานะ, stock_out.carNumber as หมายเลขรถ, stock_out.customerName as ชื่อลูกค้า, stock_out.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_out";
		$sql .= " left join product on product.id = stock_out.productID";
		$sql .= " left join branch on branch.id = stock_out.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_out.userID";
		$sql .= " where (carNumber like '%".$carnumber."%' or stock_out.detail like '%".$carnumber."%')";
        $sql .= " and onDate between '".$start."' and '".$end." 23:59:59.999'";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
    
    function excelcustomername_out()
	{	
        $customername = $this->input->post("customername");
        
        $start = $this->input->post("startdate");
		if ($start != "") {
			$start = explode('/', $start);
			$start= $start[2]."-".$start[1]."-".$start[0];
		}
		$end = $this->input->post("enddate");
		if ($end != "") {
			$end = explode('/', $end);
			$end= $end[2]."-".$end[1]."-".$end[0];
		}
        
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน,onDate as วันและเวลา, case stock_out.status when 1 then 'ขายออก' when 2 then 'ย้ายคลัง' when 3 then 'เบิกใช้ซ่อม' when 4 then 'ของเคลม' when 5 then 'ของแถม' end as สถานะ, stock_out.carNumber as หมายเลขรถ, stock_out.customerName as ชื่อลูกค้า, stock_out.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_out";
		$sql .= " left join product on product.id = stock_out.productID";
		$sql .= " left join branch on branch.id = stock_out.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_out.userID";
		$sql .= " where (customerName like '%".$customername."%' or stock_out.detail like '%".$customername."%')";
        $sql .= " and onDate between '".$start."' and '".$end." 23:59:59.999'";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
	
	function excelbetweendate_return()
	{
		$start = $this->input->post("startdate");
		if ($start != "") {
			$start = explode('/', $start);
			$start= $start[2]."-".$start[1]."-".$start[0];
		}
		$end = $this->input->post("enddate");
		if ($end != "") {
			$end = explode('/', $end);
			$end= $end[2]."-".$end[1]."-".$end[0];
		}
		
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,priceVAT as ราคาขาย, amount*priceVAT as จำนวนเงิน,onDate as วันและเวลา,  stock_return.detail as รายละเอียด, stock_return.billID as เลขที่ใบส่งของ ,barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_return";
		$sql .= " left join product on product.id = stock_return.productID";
		$sql .= " left join branch on branch.id = stock_return.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_return.userID";
		$sql .= " where onDate between '".$start."' and '".$end." 23:59:59.999'";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
	
	function excelbetweendate_customer()
	{
		$id = $this->input->post("cusid");
		$start = $this->input->post("startdate");
		if ($start != "") {
			$start = explode('/', $start);
			$start= $start[2]."-".$start[1]."-".$start[0];
		}
		$end = $this->input->post("enddate");
		if ($end != "") {
			$end = explode('/', $end);
			$end= $end[2]."-".$end[1]."-".$end[0];
		}
		
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, bill_product.amount as จำนวน, pricePerUnit as ราคา, product.unit as หน่วย, bill_product.amount*pricePerUnit as รวมราคาที่ขาย";
		$sql .= " from bill";
		$sql .= " left join bill_product on bill_product.billID = bill.id";
		$sql .= " left join customer on customer.id = bill.customerID";
		$sql .= " left join product on product.id = bill_product.productID";
		$sql .= " where bill.date between '".$start."' and '".$end." 23:59:59.999' and bill.customerID =".$id;
		
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
	
	function excelstock()
	{
		$id = $this->input->post("bid");
		$catid = $this->input->post("catid");

		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, stock.amount as จำนวน, product.unit as หน่วย, costPrice as ราคา,  stock.amount*costPrice as จำนวนเงิน";
		$sql .= " from stock";
		$sql .= " left join product on product.id = stock.productID";
		$sql .= " where stock.branchID =".$id." and categoryID=".$catid;
		
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
	
	function excelproduct()
	{
		$id = $this->input->post("bid");

		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		
		$sql = "select onDate as ปี-เดือน-วัน, product.name as ชื่อสินค้า, stock.amount as จำนวน, product.unit as หน่วย, costPrice as ราคา,  stock.amount*costPrice as จำนวนเงิน";
		$sql .= " from stock";
		$sql .= " left join product on product.id = stock.productID";
		$sql .= " left join stock_product on product.id = stock_product.productID";
		$sql .= " left join stock_out on product.id = stock_product.productID";
		$sql .= " where stock.branchID =".$id;
		
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
    
    function excelrepair()
	{
		$repair = $this->input->post("repair");

        $this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select concat('\'',standardID,'\'') as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,onDate as วันและเวลา,  stock_out.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_out";
		$sql .= " left join product on product.id = stock_out.productID";
		$sql .= " left join branch on branch.id = stock_out.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_out.userID";
        $sql .= " where stock_out.detail like '%".$repair."%'";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
    
    function printStockOut()
    {

		$id = $this->uri->segment(3);
		
		$this->load->library('mpdf/mpdf');                
        $mpdf= new mPDF('th',array(203,279),'0', 'thsaraban');
		$stylesheet = file_get_contents('application/libraries/mpdf/css/styleStockout.css');

		$query = $this->stock->getOneStockOUTprint($id);
		if($query){
			$data['stock_array'] =  $query;
		}else{
            $data['stock_array'] = array();
        }
        
		//$html = "ทดสอบ<br>";
		/*
		$query = $this->bill->getOneQuotation($id);
		if($query){
			$data['bill_array'] =  $query;
		}else{
			$data['bill_array'] = array();
		}
		foreach($query as $loop) { 
			$bid = $loop->bid;  
		}
		
		$query = $this->bill->getOneQuotationProduct($bid);
		if($query){
			$data['billproduct_array'] =  $query;
		}else{
			$data['billproduct_array'] = array();
		}
		*/
		//echo $html;
        $mpdf->SetJS('this.print();');
		$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("printStockOuthtml", $data, TRUE));
        $mpdf->Output('', 'I');

    }
    
    function historyrepair()
    {
        $data['title'] = "Pradit and Friends -Repair History";
		$this->load->view("repair_view", $data);
    }
}