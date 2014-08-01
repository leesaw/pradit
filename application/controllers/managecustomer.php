<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managecustomer extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('customer','',TRUE);
	   $this->load->model('province','',TRUE);
	   $this->load->model('title','',TRUE);
	   $this->load->library('form_validation');
	   if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		$query = $this->customer->getCustomer();
		if($query){
			$data['cus_array'] =  $query;
		}else{
			$data['cus_array'] = array();
		}
		

		$data['title'] = "Pradit and Friends - Customer Management";
		$this->load->view('customer_view',$data);
		
	 
	}
	
	public function getdatabyajax()
	{
		$this->load->library('Datatables');
		$this->datatables
		->select("customerID, name, CONCAT(address,' ' , province_name,' ' ,zipcode) as addprozip, telephone, fax, id", FALSE)
		->from('customer')
		->join('province', 'province.province_code = customer.provinceID')
		->edit_column("id",'<div class="tooltip-demo">
	<a href="'.site_url("managecustomer/viewcustomer/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	<a href="'.site_url("managecustomer/editcustomer/$1").'" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="แก้ไข"><span class="glyphicon glyphicon-pencil"></span></a>
	<button class="btnDelete btn btn-danger btn-xs" onclick="del_confirm($1)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-trash"></span></button>
	</div>',"id");
		
		echo $this->datatables->generate(); 
	}
	
	function addcustomer()
	{
		$this->load->helper(array('form'));
		
		$query = $this->province->getProvince();
		if($query){
			$data['province_array'] =  $query;
		}else{
			$data['province_array'] = array();
		}
		
		$query = $this->title->getTitle();
		if($query){
			$data['title_array'] =  $query;
		}else{
			$data['title_array'] = array();
		}
		$data['title'] = "Pradit and Friends - Add Customer";
		$this->load->view('addcustomer_view',$data);
	}

    function save()
	{
		$this->form_validation->set_rules('customerid', 'customerid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|xss_clean|required');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|xss_clean|required');
		$this->form_validation->set_rules('contactname', 'contactname', 'trim|xss_clean|required');
		$this->form_validation->set_rules('taxid', 'taxid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean|required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|xss_clean|required|min_length[5]|numeric');
		$this->form_validation->set_rules('credit', 'credit', 'trim|xss_clean|required|numeric');
		$this->form_validation->set_rules('discount', 'discount', 'trim|xss_clean|required|numeric');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('min_length', 'กรุณาใส่ตัวเลขให้ครบ 5 ตัว');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$customerid= ($this->input->post('customerid'));
			$title= ($this->input->post('title'));
			$name= ($this->input->post('name'));
			$telephone= ($this->input->post('telephone'));
			$fax= ($this->input->post('fax'));
			$mobile= ($this->input->post('mobile'));
			$contactname= ($this->input->post('contactname'));
			$taxid= ($this->input->post('taxid'));
			$address= ($this->input->post('address'));
			$province= ($this->input->post('province'));
			$zipcode= ($this->input->post('zipcode'));
			$credit= ($this->input->post('credit'));
			$discount= ($this->input->post('discount'));
			$saleprice= ($this->input->post('saleprice'));
			$status= ($this->input->post('status'));
			$creditday= ($this->input->post('creditday'));
			// add new column 05072014
			$part = ($this->input->post('part'));
			$note = ($this->input->post('note'));

			$customer = array(
				'customerID' => $customerid,
				'title' => $title,
				'name' => $name,
				'telephone' => $telephone,
				'fax' => $fax,
				'mobile' => $mobile,
				'contactName' => $contactname,
				'taxID' => $taxid,
				'address' => $address,
				'provinceID' => $province,
				'zipcode' => $zipcode,
				'credit' => $credit,
				'discount' => $discount,
				'salePrice' => $saleprice,
				'status' => $status,
				'creditDay' => $creditday,
				'part' => $part,
				'note' => $note
			);

			$result = $this->customer->addCustomer($customer);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
		
		$query = $this->province->getProvince();
		if($query){
			$data['province_array'] =  $query;
		}else{
			$data['province_array'] = array();
		}
		
		$query = $this->title->getTitle();
		if($query){
			$data['title_array'] =  $query;
		}else{
			$data['title_array'] = array();
		}
		
			$data['title'] = "Pradit and Friends - Add Customer";
			
			$this->load->view('addcustomer_view',$data);
	}
	
	function delete()
	{
		
		$id = $this->uri->segment(3);
		$result = $this->customer->delCustomer($id);
		
		redirect('managecustomer', 'refresh');
	}
	
	function viewcustomer()
	{
		$id = $this->uri->segment(3);
		$query = $this->customer->getOneCustomer($id);
		if($query){
			$data['cus_array'] =  $query;
		}
		
		$query = $this->province->getProvince();
		if($query){
			$data['province_array'] =  $query;
		}else{
			$data['province_array'] = array();
		}
		
		$query = $this->title->getTitle();
		if($query){
			$data['title_array'] =  $query;
		}else{
			$data['title_array'] = array();
		}
		$data['title'] = "Pradit and Friends - View Customer";
		$this->load->view('viewcustomer_view',$data);
	}
	
	function editcustomer()
	{
		$this->load->helper(array('form'));

		$id = $this->uri->segment(3);
		$query = $this->customer->getOneCustomer($id);
		if($query){
			$data['cus_array'] =  $query;
		}
		
		$query = $this->province->getProvince();
		if($query){
			$data['province_array'] =  $query;
		}else{
			$data['province_array'] = array();
		}
		
		$query = $this->title->getTitle();
		if($query){
			$data['title_array'] =  $query;
		}else{
			$data['title_array'] = array();
		}
		$data['title'] = "Pradit and Friends - Edit Customer";
		$this->load->view('editcustomer_view',$data);

	}
	
	function update()
	{
		
		//$this->form_validation->set_rules('customerid', 'customerid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|xss_clean|required');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|xss_clean|required');
		$this->form_validation->set_rules('contactname', 'contactname', 'trim|xss_clean|required');
		$this->form_validation->set_rules('taxid', 'taxid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean|required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|xss_clean|required|min_length[5]|numeric');
		$this->form_validation->set_rules('credit', 'credit', 'trim|xss_clean|required|numeric');
		$this->form_validation->set_rules('discount', 'discount', 'trim|xss_clean|required|numeric');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('min_length', 'กรุณาใส่ตัวเลขให้ครบ 5 ตัว');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		$id= ($this->input->post('id'));
		
		if($this->form_validation->run() == TRUE) {
			//$customerid= ($this->input->post('customerid'));
			$title= ($this->input->post('title'));
			$name= ($this->input->post('name'));
			$telephone= ($this->input->post('telephone'));
			$fax= ($this->input->post('fax'));
			$mobile= ($this->input->post('mobile'));
			$contactname= ($this->input->post('contactname'));
			$taxid= ($this->input->post('taxid'));
			$address= ($this->input->post('address'));
			$province= ($this->input->post('province'));
			$zipcode= ($this->input->post('zipcode'));
			$credit= ($this->input->post('credit'));
			$discount= ($this->input->post('discount'));
			$saleprice= ($this->input->post('saleprice'));
			$status= ($this->input->post('status'));
			$creditday= ($this->input->post('creditday'));
			// add new column 05072014
			$part = ($this->input->post('part'));
			$note = ($this->input->post('note'));
			

			$customer = array(
				'id' => $id,
				//'customerID' => $customerid,
				'title' => $title,
				'name' => $name,
				'telephone' => $telephone,
				'fax' => $fax,
				'mobile' => $mobile,
				'contactName' => $contactname,
				'taxID' => $taxid,
				'address' => $address,
				'provinceID' => $province,
				'zipcode' => $zipcode,
				'credit' => $credit,
				'discount' => $discount,
				'salePrice' => $saleprice,
				'status' => $status,
				'creditDay' => $creditday,
				'part' => $part,
				'note' => $note
			);

			$result = $this->customer->editCustomer($customer);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
		
			$query = $this->customer->getOneCustomer($id);
			if($query){
				$data['cus_array'] =  $query;
			}
			$query = $this->province->getProvince();
			
			if($query){
				$data['province_array'] =  $query;
			}else{
				$data['province_array'] = array();
			}
			
			$query = $this->title->getTitle();
			if($query){
				$data['title_array'] =  $query;
			}else{
				$data['title_array'] = array();
			}
			$data['title'] = "Pradit and Friends - Edit Customer";
			
			$this->load->view('editcustomer_view',$data);
	}
	
	function historystockexcel_in()
    {
        $this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
		$sql = "select standardID as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,onDate as วันและเวลา,  stock_product.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_product";
		$sql .= " left join product on product.id = stock_product.productID";
		$sql .= " left join branch on branch.id = stock_product.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_product.userID";
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
        
    }
	
	function excelbetweendate()
	{
		//$id = $this->input->post("cusid");
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
		$sql = "select standardID as รหัสสินค้า, product.name as ชื่อสินค้า, amount as จำนวน, unit as หน่วย,onDate as วันและเวลา,  stock_product.detail as รายละเอียด, barcode, category.name as ชนิดสินค้า,  branch.name as สาขา, firstname as ชื่อผู้ใส่ข้อมูล, lastname as นามสกุลผู้ใส่ข้อมูล";
		$sql .= " from stock_product";
		$sql .= " left join product on product.id = stock_product.productID";
		$sql .= " left join branch on branch.id = stock_product.branchID";
		$sql .= " left join category on category.id = product.categoryID";
		$sql .= " left join users on users.id = stock_product.userID";
		/*
		$sql = "select standardID as รหัสสินค้า, product.name as ชื่อสินค้า, bill_product.amount as จำนวน, pricePerUnit as ราคา, product.unit as หน่วย, bill_product.amount*pricePerUnit as รวมราคาที่ขาย";
		$sql .= " from bill";
		$sql .= " left join bill_product on bill_product.billID = bill.id";
		$sql .= " left join customer on customer.id = bill.customerID";
		$sql .= " left join product on product.id = bill_product.productID";
		$sql .= " where bill.date between '".$start."' and '".$end."' and bill.customerID =".$id;
		*/
        $result = $this->db->query($sql);

        $this->load->view('exportedToCsv', array('csv'=> $this->dbutil->csv_from_result($result, $delimiter, $newline)));
	}
}