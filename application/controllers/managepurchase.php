<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managepurchase extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('purchase','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		
		$data['title'] = "Pradit and Friends - Product Management";
		$this->load->view('addpurchase_view',$data);
		
	 
	}
	
	function historypurchase()
	{
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		$data['branchid'] = 0;
		
		$data['title'] = "Pradit and Friends - History Purchase";
		$this->load->view('historypurchase_view',$data);
	}
	
	function viewPurchaseByBranch()
	{
		$data['branchid'] = $this->uri->segment(3);
		
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$data['title'] = "Pradit and Friends - History Purchase";
		$this->load->view('historypurchase_view',$data);
	}
	
	function addpurchase()
	{
		$data['title'] = "Pradit and Friends - Add Purchase";
		$this->load->view('addpurchase_view',$data);
	}
	
	function addpurchasefrombarcode()
	{
		$this->load->helper(array('form'));
		
		$data['count'] = $this->purchase->getTempCount();
		
		$query = $this->purchase->getPurchaseTemp();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		
		
		$data['title'] = "Pradit and Friends - Add Purchase";
		$this->load->view("addpurchasefrombarcode_view", $data);
	}
	
	function saveBarcodeTemp_purchase()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));

			$row = $this->purchase->checkBarcodeProduct($barcodeid);
			if ($row>0)	{
				$result = $this->purchase->getTempID();
				foreach ($result as $loop)
				{
					$tempid = $loop->tempid;
				}
				$tempid++;
				$barcode = array(
					'barcode' => $barcodeid,
					'tempid' => $tempid,
					'status' => 0  // 0 = no status
				);
				$result2 = $this->purchase->addBarcodeTemp($barcode);
				redirect(current_url());
			}else{
				$this->session->set_flashdata('showresult', 'fail');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->purchase->getTempCount(1);
		$query = $this->purchase->getPurchaseTemp();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("addpurchasefrombarcode_view", $data);
	}
	
	function ajaxGetPurchaseTemp()
	{
		$status = $this->uri->segment(3);
		$this->load->library('Datatables');
		$this->datatables
		->select("CONCAT(product.standardID,' ', product.name) as pname, unit, category.name as cname, purchase_product_temp.tempid as tempid")
		->from('purchase_product_temp')
		->join('product', 'product.barcode = purchase_product_temp.barcode')
		->join('category', 'product.categoryID = category.id')
		->where('status', $status)
		->edit_column("tempid",
		'<button class="btnDelete btn btn-danger btn-xs" onclick="del_confirm($1)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-remove"></span></button>
		',"tempid");
	
		echo $this->datatables->generate(); 
	}
	
	function ajaxGetStockHistoryPurchase()
	{
		$branchid = $this->uri->segment(3);
		$this->load->library('Datatables');
		$this->datatables
		->select("purchaseID, supplierName, date, id")
		->from('purchase')
		->where('branchID', $branchid)
		->edit_column("id",'<div class="tooltip-demo">
	<a href="'.site_url("managepurchase/printCashPurchase/$1").'" class="btn btn-primary btn-xs" target="_blank" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-print"></span></a>
	</div>',"id");
	
		echo $this->datatables->generate(); 
	}
	
	function cleartemp()
	{
		$status = $this->uri->segment(3);
		$result = $this->purchase->delAllPurchaseTemp($status);
		redirect('managepurchase/addpurchasefrombarcode', 'refresh');

	}
	
	function deletetemp_purchase()
	{
		$id = $this->uri->segment(3);
		$result = $this->purchase->delPurchaseTemp($id);
		redirect('managepurchase/addpurchasefrombarcode', 'refresh');
	}
	
	function showtemptopurchase()
	{
		$this->load->helper(array('form'));
		
		$this->load->model('branch','',TRUE);
		
		$data['count'] = $this->purchase->getTempCount();
		
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$query = $this->purchase->getPurchaseTemp2();
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
		
		$data['cusid'] = 0;
		$data['title'] = "Pradit and Friends - Add Barcode";
		$this->load->view("adddetailtotemp_purchase_view", $data);
	}
	
	function autocompleteResponse()
	{
		//$this->load->model('user');
		$term = $this->input->get('term', TRUE);
		$this->load->model('supplier','',TRUE);
		$supplier = $this->supplier->searchName($term);
		echo json_encode($supplier);
	}
	
	function purchase_is_exist($id)
    {
        
        if($this->purchase_validate($id))
        {
			$this->form_validation->set_message('purchase_is_exist', 'เลขที่ใบสั่งซื้อ '.$id.' มีอยู่ในระบบแล้ว');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
	function purchase_validate($id)
    {
        $this->db->where('purchaseID', $this->input->post('purchaseid'));
        $query = $this->db->get('purchase');
        
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
	
	function previewCashPurchase()
	{
		$this->load->model('branch','',TRUE);
		
		$this->form_validation->set_rules('purchaseid', 'purchaseid', 'trim|xss_clean|required|callback_purchase_is_exist');
		$this->form_validation->set_rules('cusname', 'cusname', 'trim|xss_clean|required');
		$this->form_validation->set_rules('cusaddress', 'cusaddress', 'trim|xss_clean|required');
		$this->form_validation->set_rules('cuscontact', 'cuscontact', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$data['purchaseid']= ($this->input->post('purchaseid'));
			$data['branchid']= ($this->input->post('branchid'));
			$data['cusid']= ($this->input->post('cusid'));
			$data['cusname']= ($this->input->post('cusname'));
			$data['cusaddress']= ($this->input->post('cusaddress'));
			$data['cuscontact']= ($this->input->post('cuscontact'));
			$data['condition']= ($this->input->post('condition'));
			$data['creditday']= ($this->input->post('creditday'));
			
			$query = $this->branch->getOneBranch($this->input->post('branchid'));
			if($query){
				$data['branch_array'] =  $query;
			}
						
			$query = $this->purchase->getPurchaseTemp3();
			if($query){
				$data['temp_array'] =  $query;
			}else{
				$data['temp_array'] = array();
			}
			
			$data['title'] = "Pradit and Friends - Preview Purchase";
			$this->load->view("previewpurchase_view", $data);
		}else{
		
		
			$query = $this->branch->getBranch();
			if($query){
				$data['branch_array'] =  $query;
			}else{
				$data['branch_array'] = array();
			}
			
			$query = $this->purchase->getPurchaseTemp2();
			if($query){
				$data['temp_array'] =  $query;
			}else{
				$data['temp_array'] = array();
			}
			
			$data['cusid'] = ($this->input->post('cusid'));
			$data['title'] = "Pradit and Friends - Add Barcode";
			$this->load->view("adddetailtotemp_purchase_view", $data);
		}
	}
	
	function saveCashPurchase()
	{
		// insert into purchase table
		$purchaseid = ($this->input->post('purchaseid'));
		$branchid = ($this->input->post('branchid'));
		$cusid = ($this->input->post('cusid'));
		$cusname = ($this->input->post('cusname'));
		$cusaddress = ($this->input->post('cusaddress'));
		$cuscontact = ($this->input->post('cuscontact'));
		$condition = ($this->input->post('condition'));
		$creditday = ($this->input->post('creditday'));
		$userid = $this->session->userdata('sessid');
		$totalprice = ($this->input->post('totalprice'));
		
	
		$purchase = array(
				'purchaseID' => $purchaseid,
				'branchID' => $branchid,
				'supplierID' => $cusid,
				'userID' => $userid,
				'supplierName' => $cusname,
				'supplierAddress' => $cusaddress,
				'supplierContact' => $cuscontact,
				'status' => $condition,
				'creditDay' => $creditday,
				'date' => date("Y-m-d")
				
			);
		$resultPurchase = $this->purchase->addCashPurchase($purchase);
		
		// insert into purchase_product
		// hidden array
		$productid = ($this->input->post('productid'));
		$price1 = ($this->input->post('price1'));
		$amount = ($this->input->post('amount'));
		
		$purchaseproduct = array( 'purchaseID' => $purchaseid );
		
		for($i=0; $i<count($productid); $i++) {
			$purchaseproduct['productID'] = $productid[$i];
			$purchaseproduct['pricePerUnit'] = $price1[$i];
			$purchaseproduct['amount'] = $amount[$i];
			
			$resultPurchaseProduct = $this->purchase->addCashPurchaseProduct($purchaseproduct);
		}
		$this->purchase->delAllPurchaseTemp(0);
		
		$data['showresult'] = 'success';
		$data['purchaseid'] = $resultPurchase;
		
		$data['title'] = "Pradit and Friends - Show Purchase";
		$this->load->view("showpurchase_view", $data);
		
	}
	
	function printCashPurchase()
	{
		$id = $this->uri->segment(3);
		
		$this->load->library('mpdf/mpdf');                
        $mpdf= new mPDF('th','A4','0', 'thsaraban');
		$stylesheet = file_get_contents('application/libraries/mpdf/css/style.css');
		
		$mpdf->SetHTMLHeader('<div style="text-align: left; font-weight: bold; font-size: 20pt;">บริษัท ประดิษฐ์ แอนด์ เฟรนด์ แมชีนเนอรี่ จำกัด</div><br\><div style="text-align: left; font-weight: font-size: 16pt;">102/17-20 หมู่ 9 ถ.ท่าเรือ-พระแท่น ต.ตะคร้ำเอน อ.ท่ามะกา จ.กาญจนบุรี 71130<br>โทรศัพท์ : (034) 561641 , 562895 FAX. : (034) 562896</div>'); 
		//$html = "ทดสอบ<br>";
		
		$query = $this->purchase->getOnePurchase($id);
		if($query){
			$data['purchase_array'] =  $query;
		}else{
			$data['purchase_array'] = array();
		}
		foreach($query as $loop) { 
			$purchaseid = $loop->purchaseID;  
		}
		
		$query = $this->purchase->getOnePurchaseProduct($purchaseid);
		if($query){
			$data['purchaseproduct_array'] =  $query;
		}else{
			$data['purchaseproduct_array'] = array();
		}
		
		//echo $html;
		$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("printPurchasehtml", $data, TRUE));
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
}