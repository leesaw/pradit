<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managebill extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('bill','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		
		$data['title'] = "Pradit and Friends - Product Management";
		$this->load->view('addbill_view',$data);
		
	 
	}
	
	function historybill()
	{
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		$data['branchid'] = 0;
		
		$data['title'] = "Pradit and Friends - History Bill";
		$this->load->view('historybill_view',$data);
	}
	
	function historyquotation()
	{
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		$data['branchid'] = 0;
		
		$data['title'] = "Pradit and Friends - History Quotation";
		$this->load->view('historyquotation_view',$data);
	}
	
	function viewBillByBranch()
	{
		$data['branchid'] = $this->uri->segment(3);
		
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$data['title'] = "Pradit and Friends - History Bill";
		$this->load->view('historybill_view',$data);
	}
	
	function viewQuotationByBranch()
	{
		$data['branchid'] = $this->uri->segment(3);
		
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$data['title'] = "Pradit and Friends - History Quotation";
		$this->load->view('historyquotation_view',$data);
	}
	
	function addbill()
	{
		$data['title'] = "Pradit and Friends - Add Bill";
		$this->load->view('addbill_view',$data);
	}
	
	function addquotation()
	{
		$data['title'] = "Pradit and Friends - Add Quotation";
		$this->load->view('addquotation_view',$data);
	}
	
	function addbillfrombarcode()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->bill->getTempCount(1);
		
		$query = $this->bill->getBillTemp();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		
		
		$data['title'] = "Pradit and Friends - Add Bill";
		$this->load->view("addbillfrombarcode_view", $data);
	}
	
	function addquotationfrombarcode()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->bill->getTempCount(2);
		
		$query = $this->bill->getQuotationTemp();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		
		
		$data['title'] = "Pradit and Friends - Add Bill";
		$this->load->view("addquotationfrombarcode_view", $data);
	}
	
	function saveBarcodeTemp_bill()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));

			$row = $this->bill->checkBarcodeProduct($barcodeid);
			if ($row>0)	{
				$result = $this->bill->getTempID();
				foreach ($result as $loop)
				{
					$tempid = $loop->tempid;
				}
				$tempid++;
				$barcode = array(
					'barcode' => $barcodeid,
					'tempid' => $tempid,
					'status' => 1,  // 1 = cash bill
					'amount' => 1
				);
				$result2 = $this->bill->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->bill->getTempCount(1);
		$query = $this->bill->getBillTemp();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addbillfrombarcode_view", $data);
	}
	
	function saveBarcodeTemp_quotation()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));

			$row = $this->bill->checkBarcodeProduct($barcodeid);
			if ($row>0)	{
				$result = $this->bill->getTempID();
				foreach ($result as $loop)
				{
					$tempid = $loop->tempid;
				}
				$tempid++;
				$barcode = array(
					'barcode' => $barcodeid,
					'tempid' => $tempid,
					'status' => 2,  // 2 = quotation
					'amount' => 1
				);
				$result2 = $this->bill->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->bill->getTempCount(2);
		$query = $this->bill->getQuotationTemp();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addquotationfrombarcode_view", $data);
	}
	
	function ajaxGetBillTemp()
	{
		$status = $this->uri->segment(3);
		$this->load->library('Datatables');
		$this->datatables
		->select("CONCAT(product.standardID,' ', product.name) as pname, unit, category.name as cname, bill_product_temp.tempid as tempid")
		->from('bill_product_temp')
		->join('product', 'product.barcode = bill_product_temp.barcode')
		->join('category', 'product.categoryID = category.id')
		->where('status', $status)
		->edit_column("tempid",
		'<button class="btnDelete btn btn-danger btn-xs" onclick="del_confirm($1)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-remove"></span></button>
		',"tempid");
	
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryBill()
	{
		$branchid = $this->uri->segment(3);
		$this->load->library('Datatables');
		$this->datatables
		->select("billID, customerName, date, id")
		->from('bill')
		->where('branchID', $branchid)
		->edit_column("id",'<div class="tooltip-demo">
	<a href="'.site_url("managebill/printCashBill/$1").'" class="btn btn-primary btn-xs" target="_blank" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-print"></span></a>
	</div>',"id");
	
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryQuotation()
	{
		$branchid = $this->uri->segment(3);
		$this->load->library('Datatables');
		$this->datatables
		->select("quotationID, customerName, date, id")
		->from('quotation')
		->where('branchID', $branchid)
		->edit_column("id",'<div class="tooltip-demo">
	<a href="'.site_url("managebill/printCashQuotation/$1").'" class="btn btn-primary btn-xs" target="_blank" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-print"></span></a>
	</div>',"id");
	
		echo $this->datatables->generate(); 
	}
	
	function cleartemp()
	{
		$status = $this->uri->segment(3);
		$result = $this->bill->delAllBillTemp($status);
		if ($status==1)	redirect('managebill/addbillfrombarcode', 'refresh');
		if ($status==2)	redirect('managebill/addquotationfrombarcode', 'refresh');

	}
	
	function deletetemp_bill()
	{
		$id = $this->uri->segment(3);
		$result = $this->bill->delBillTemp($id);
		redirect('managebill/addbillfrombarcode', 'refresh');
	}
	
	function deletetemp_quotation()
	{
		$id = $this->uri->segment(3);
		$result = $this->bill->delBillTemp($id);
		redirect('managebill/addquotationfrombarcode', 'refresh');
	}
	
	function showtemptobill()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
		$data['count'] = $this->bill->getTempCount(1);
		foreach($this->bill->getLastIDbill() as $loop) {
			$data['lastid']=$loop->lastid;
		}
		if ($loop->lastid ==null) $data['lastid'] = 0;
		
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$query = $this->bill->getBillTemp2();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		
		$data['cusid'] = 0;
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("adddetailtotemp_bill_view", $data);
	}
	
	function showtemptoquotation()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
		$data['count'] = $this->bill->getTempCount(2);
		foreach($this->bill->getLastIDquotation() as $loop) {
			$data['lastid']=$loop->lastid;
		}
		if ($loop->lastid ==null) $data['lastid'] = 0;
		
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$query = $this->bill->getQuotationTemp2();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		
		$data['cusid'] = 0;
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("adddetailtotemp_quotation_view", $data);
	}
	
	function autocompleteResponse()
	{
		//$this->load->model('user');
		$term = $this->input->get('term', TRUE);
		$this->load->model('customer','',TRUE);
		$customer = $this->customer->searchName($term);
		echo json_encode($customer);
	}
	
	function bill_is_exist($id)
    {
        
        if($this->bill_validate($id))
        {
			$this->form_validation->set_message('bill_is_exist', 'เลขที่บิล '.$id.' มีอยู่ในระบบแล้ว');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
	function bill_validate($id)
    {
        $this->db->where('billID', $this->input->post('cashid'));
        $query = $this->db->get('bill');
        
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
	
	function previewCashBill()
	{
		$this->load->model('branch','',TRUE);
		
		$this->form_validation->set_rules('cashid', 'cashid', 'trim|xss_clean|required|callback_bill_is_exist');
		$this->form_validation->set_rules('cusname', 'cusname', 'trim|xss_clean|required');
		$this->form_validation->set_rules('cusaddress', 'cusaddress', 'trim|xss_clean|required');
		$this->form_validation->set_rules('discount', 'discount', 'trim|xss_clean');
		$this->form_validation->set_rules('saleprice', 'saleprice', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$data['cashid']= ($this->input->post('cashid'));
			$data['branchid']= ($this->input->post('branchid'));
			$data['cusid']= ($this->input->post('cusid'));
			$data['cusname']= ($this->input->post('cusname'));
			$data['cusaddress']= ($this->input->post('cusaddress'));
			$data['saleprice']= ($this->input->post('saleprice'));
			$data['discount']= ($this->input->post('discount'));
			$data['discount2']= ($this->input->post('discount2'));
			$data['transport']= ($this->input->post('transport'));
			// vat
			$data['vat'] = ($this->input->post('vat'));
			$data['percentvat'] = ($this->input->post('percentvat'));
			
			if (($this->input->post('discount2')) =="") $data['discount2'] = 0;
			
			if (($this->input->post('discount')) =="") $data['discount'] = 0;
			
			$query = $this->branch->getOneBranch($this->input->post('branchid'));
			if($query){
				$data['branch_array'] =  $query;
			}
			
			$barcode = ($this->input->post('barcode'));
			$price = ($this->input->post('price'));
			for ($i=0; $i<count($barcode); $i++) {
				$temp = array('barcode' =>$barcode[$i], 'price' => $price[$i] );
				$this->bill->editPriceTemp($temp);
			}
			
			$sale = $this->input->post('saleprice');
			if ($sale==1 || $sale==2) $column = "priceNoVAT";
			elseif ($sale==2) $column = "priceVAT";
			elseif ($sale==3) $column = "priceDiscount";
			else $column="";
			
			$query = $this->bill->getBillTemp3($column);
			if($query){
				$data['temp_array'] =  $query;
			}else{
				$data['temp_array'] = array();
			}
			
			$data['title'] = "Pradit and Friends - Preview Bill";
			$this->load->view("previewbill_view", $data);
		}else{
		
		
			$query = $this->branch->getBranch();
			if($query){
				$data['branch_array'] =  $query;
			}else{
				$data['branch_array'] = array();
			}
			
			$query = $this->bill->getBillTemp2();
			if($query){
				$data['temp_array'] =  $query;
			}else{
				$data['temp_array'] = array();
			}
			
			$data['cusid'] = ($this->input->post('cusid'));
			$data['title'] = "Pradit and Friends - Add Barcode";
			redirect('managebill/showtemptobill', 'refresh');
			//$this->load->view("adddetailtotemp_bill_view", $data);
		}
	}
	
	function previewCashQuotation()
	{
		$this->load->model('branch','',TRUE);
		
		$this->form_validation->set_rules('cashid', 'cashid', 'trim|xss_clean|required|callback_bill_is_exist');
		$this->form_validation->set_rules('cusname', 'cusname', 'trim|xss_clean|required');
		$this->form_validation->set_rules('cusaddress', 'cusaddress', 'trim|xss_clean|required');
		$this->form_validation->set_rules('discount', 'discount', 'trim|xss_clean');
		$this->form_validation->set_rules('saleprice', 'saleprice', 'trim|xss_clean|required');
		$this->form_validation->set_rules('cuscontact', 'cuscontact', 'trim|xss_clean');
		$this->form_validation->set_rules('condition', 'condition', 'trim|xss_clean');
		$this->form_validation->set_rules('creditday', 'creditday', 'trim|xss_clean');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$data['cashid']= ($this->input->post('cashid'));
			$data['branchid']= ($this->input->post('branchid'));
			$data['cusid']= ($this->input->post('cusid'));
			$data['cusname']= ($this->input->post('cusname'));
			$data['cusaddress']= ($this->input->post('cusaddress'));
			$data['custelephone']= ($this->input->post('custelephone'));
			$data['cusfax']= ($this->input->post('cusfax'));
			$data['saleprice']= ($this->input->post('saleprice'));
			$data['discount']= ($this->input->post('discount'));
			$data['cuscontact']= ($this->input->post('cuscontact'));
			$data['condition']= ($this->input->post('condition'));
			$data['creditday']= ($this->input->post('creditday'));
			$data['receivedate']= ($this->input->post('receivedate'));
			$data['discount2']= ($this->input->post('discount2'));
			// vat
			$data['vat'] = ($this->input->post('vat'));
			$data['percentvat'] = ($this->input->post('percentvat'));
			
			if (($this->input->post('discount2')) =="") $data['discount2'] = 0;
			
			if (($this->input->post('discount')) =="") $data['discount'] = 0;
			
			$query = $this->branch->getOneBranch($this->input->post('branchid'));
			if($query){
				$data['branch_array'] =  $query;
			}
			
			$barcode = ($this->input->post('barcode'));
			$price = ($this->input->post('price'));
			for ($i=0; $i<count($barcode); $i++) {
				$temp = array('barcode' =>$barcode[$i], 'price' => $price[$i] );
				$this->bill->editPriceTemp($temp);
			}
			
			$sale = $this->input->post('saleprice');
			if ($sale==1) $column = "priceVAT";
			elseif ($sale==2) $column = "priceVAT";
			elseif ($sale==3) $column = "priceDiscount";
			else $column="";
			
			$query = $this->bill->getQuotationTemp3($column);
			if($query){
				$data['temp_array'] =  $query;
			}else{
				$data['temp_array'] = array();
			}
			
			$data['title'] = "Pradit and Friends - Preview Quotation";
			$this->load->view("previewquotation_view", $data);
		}else{
		
		
			$query = $this->branch->getBranch();
			if($query){
				$data['branch_array'] =  $query;
			}else{
				$data['branch_array'] = array();
			}
			
			$query = $this->bill->getQuotationTemp2();
			if($query){
				$data['temp_array'] =  $query;
			}else{
				$data['temp_array'] = array();
			}
			
			$data['cusid'] = ($this->input->post('cusid'));
			$data['title'] = "Pradit and Friends - Add Barcode";
			redirect('managebill/showtemptoquotation', 'refresh');
			//$this->load->view("adddetailtotemp_quotation_view", $data);
		}
	}
	
	function saveCashBill()
	{
		// insert into bill table
		$billid = ($this->input->post('cashid'));
		$branchid = ($this->input->post('branchid'));
		$cusid = ($this->input->post('cusid'));
		$cusname = ($this->input->post('cusname'));
		$cusaddress = ($this->input->post('cusaddress'));
		$saleprice = ($this->input->post('saleprice'));
		$discount = ($this->input->post('discount'));
		$discount2 = ($this->input->post('discount2'));
		$userid = $this->session->userdata('sessid');
		$totalprice = ($this->input->post('totalprice'));
		$tax = ($this->input->post('totalvat'));
		$transport = ($this->input->post('transport'));
		$percentvat = ($this->input->post('percentvat'));
		
		$currentdate= explode('/',date("d/m/Y"));
		$currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0];
		
		
		$bill = array(
				'billID' => $billid,
				'branchID' => $branchid,
				'customerID' => $cusid,
				'userID' => $userid,
				'customerName' => $cusname,
				'customerAddress' => $cusaddress,
				'discount' => $discount,
				'saleprice' => $saleprice,
				'tax' => $tax,
				'percentvat' => $percentvat,
				'date' => $currentdate,
				'discountPercent' => $discount2,
				'transport' => $transport
				
				
			);
		$resultBill = $this->bill->addCashBill($bill);
		
		// insert into bill_product
		// hidden array
		$productid = ($this->input->post('productid'));
		$price1 = ($this->input->post('price1'));
		$amount = ($this->input->post('amount'));
		
		$bid = $this->db->insert_id();
		
		$billproduct = array( 'billID' => $bid );
		
		for($i=0; $i<count($productid); $i++) {
			$billproduct['productID'] = $productid[$i];
			$billproduct['pricePerUnit'] = $price1[$i];
			$billproduct['amount'] = $amount[$i];
			
			$resultBillProduct = $this->bill->addCashBillProduct($billproduct);
		}
		$this->bill->delAllBillTemp(1);
		
		$data['showresult'] = 'success';
		$data['billid'] = $resultBill;
		
		$data['title'] = "Pradit and Friends - Show Bill";
		$this->load->view("showbill_view", $data);
		
	}
	
	function saveCashQuotation()
	{
		// insert into bill table
		$billid = ($this->input->post('cashid'));
		$branchid = ($this->input->post('branchid'));
		$cusid = ($this->input->post('cusid'));
		$cusname = ($this->input->post('cusname'));
		$cusaddress = ($this->input->post('cusaddress'));
		$custelephone= ($this->input->post('custelephone'));
		$cusfax= ($this->input->post('cusfax'));
		$saleprice = ($this->input->post('saleprice'));
		$discount = ($this->input->post('discount'));
		$discount2 = ($this->input->post('discount2'));
		$userid = $this->session->userdata('sessid');
		$totalprice = ($this->input->post('totalprice'));
		$cuscontact = ($this->input->post('cuscontact'));
		$condition = ($this->input->post('condition'));
		$creditday = ($this->input->post('creditday'));
		$tax = ($this->input->post('totalvat'));
		//$quotationDate = ($this->input->post('receivedate'));
		$percentvat = ($this->input->post('percentvat'));

		if ($this->input->post('receivedate') != "") {
			$quotationDate = explode('/', $this->input->post('receivedate'));
			$quotationDate= $quotationDate[2]."-".$quotationDate[1]."-".$quotationDate[0];
		}
		
		$currentdate= explode('/',date("d/m/Y"));
		$currentdate= ($currentdate[2]+543)."-".$currentdate[1]."-".$currentdate[0];
		
		$bill = array(
				'quotationID' => $billid,
				'branchID' => $branchid,
				'customerID' => $cusid,
				'userID' => $userid,
				'customerName' => $cusname,
				'customerAddress' => $cusaddress,
				'discount' => $discount,
				'saleprice' => $saleprice,
				'customerContact' => $cuscontact,
				'status' => $condition,
				'creditDay' => $creditday,
				'tax' => $tax,
				'percentvat' => $percentvat,
				'date' => $currentdate,
				'quotationDate' => $quotationDate,
				'discountPercent' => $discount2,
				'customerTel' => $custelephone,
				'customerFax' => $cusfax
				
			);
		$resultBill = $this->bill->addCashQuotation($bill);
		
		// insert into bill_product
		// hidden array
		$productid = ($this->input->post('productid'));
		$price1 = ($this->input->post('price1'));
		$amount = ($this->input->post('amount'));
		
		$bid = $this->db->insert_id();
		
		$billproduct = array( 'quotationID' => $bid );
		
		for($i=0; $i<count($productid); $i++) {
			$billproduct['productID'] = $productid[$i];
			$billproduct['pricePerUnit'] = $price1[$i];
			$billproduct['amount'] = $amount[$i];
			
			$resultBillProduct = $this->bill->addCashQuotationProduct($billproduct);
		}
		$this->bill->delAllBillTemp(2);
		
		$data['showresult'] = 'success';
		$data['billid'] = $resultBill;
		
		$data['title'] = "Pradit and Friends - Show Bill";
		$this->load->view("showquotation_view", $data);
		
	}
	
	function printCashBill()
	{
		$id = $this->uri->segment(3);
		
		$this->load->library('mpdf/mpdf');                
        $mpdf= new mPDF('th',array(220,279),'0', 'thsaraban');
		$stylesheet = file_get_contents('application/libraries/mpdf/css/style.css');
		
		//$mpdf->SetHTMLHeader('<div style="text-align: left; font-weight: bold; font-size: 20pt;">บริษัท ประดิษฐ์ แอนด์ เฟรนด์ แมชีนเนอรี่ จำกัด</div><br\><div style="text-align: left; font-weight: font-size: 16pt;">102/17-20 หมู่ 9 ถ.ท่าเรือ-พระแท่น ต.ตะคร้ำเอน อ.ท่ามะกา จ.กาญจนบุรี 71130<br>โทรศัพท์ : (034) 561641 , 562895 FAX. : (034) 562896</div>'); 
		//$html = "ทดสอบ<br>";
		
		$query = $this->bill->getOneBill($id);
		if($query){
			$data['bill_array'] =  $query;
		}else{
			$data['bill_array'] = array();
		}
		foreach($query as $loop) { 
			$bid = $loop->bid;  
		}
		
		$query = $this->bill->getOneBillProduct($bid);
		if($query){
			$data['billproduct_array'] =  $query;
		}else{
			$data['billproduct_array'] = array();
		}
		
		//echo $html;
        $mpdf->SetJS('this.print();');
		$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("printBillhtml", $data, TRUE));
        $mpdf->Output();
		
		
	}
	
	function printCashQuotation()
	{
		$id = $this->uri->segment(3);
		
		$this->load->library('mpdf/mpdf');                
        $mpdf= new mPDF('th','A4','0', 'thsaraban');
		$stylesheet = file_get_contents('application/libraries/mpdf/css/style.css');
		
		$mpdf->SetHTMLHeader('<div style="text-align: left; font-weight: bold; font-size: 20pt;">บริษัท ประดิษฐ์ แอนด์ เฟรนด์ แมชีนเนอรี่ จำกัด</div><br\><div style="text-align: left; font-weight: font-size: 16pt;">102/17-20 หมู่ 9 ถ.ท่าเรือ-พระแท่น ต.ตะคร้ำเอน อ.ท่ามะกา จ.กาญจนบุรี 71130<br>โทรศัพท์ : (034) 561641 , 562895 FAX. : (034) 562896</div>'); 
		//$html = "ทดสอบ<br>";
		
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
		
		//echo $html;
        $mpdf->SetJS('this.print();');
		$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("printQuotationhtml", $data, TRUE));
        $mpdf->Output();
		
		
	}
	
	function mpdf()
    {
        $this->load->library('mpdf/mpdf');                
        $mpdf= new mPDF('th','A4','0', 'thsaraban');
		$stylesheet = file_get_contents('application/libraries/mpdf/css/style.css');
		
		$html = "<b><i>ทดสอบ</i></b>";
		
		//echo $html;
		$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    } 
	
	function edit_amount_quotation()
	{
		$tempid=$this->input->post('tempid');
		$amount=$this->input->post('amount');
		$purchasetemp = array(
					'tempid' => $tempid,
					'amount' => $amount
				);
		$query = $this->bill->editAmountTemp($purchasetemp);
		
	}
	
	function edit_amount_bill()
	{
		$tempid=$this->input->post('tempid');
		$amount=$this->input->post('amount');
		$purchasetemp = array(
					'tempid' => $tempid,
					'amount' => $amount
				);
		$query = $this->bill->editAmountTemp($purchasetemp);
		
	}
}