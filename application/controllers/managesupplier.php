<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managesupplier extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('supplier','',TRUE);
	   $this->load->model('province','',TRUE);
	   $this->load->model('title','',TRUE);
	   $this->load->library('form_validation');
	   if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		$query = $this->supplier->getSupplier();
		if($query){
			$data['sup_array'] =  $query;
		}else{
			$data['sup_array'] = array();
		}
		

		$data['title'] = "Pradit and Friends - Supplier Management";
		$this->load->view('supplier_view',$data);
		
	 
	}
	
	public function getdatabyajax()
	{
		$this->load->library('Datatables');
		$this->datatables
		->select("supplierID, name, CONCAT(address,' ' , province_name,' ' ,zipcode) as addprozip, telephone, fax, id", FALSE)
		->from('supplier')
		->join('province', 'province.province_code = supplier.provinceID')
		->edit_column("id",'<div class="tooltip-demo">
	<a href="'.site_url("managesupplier/viewsupplier/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	<a href="'.site_url("managesupplier/editsupplier/$1").'" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="แก้ไข"><span class="glyphicon glyphicon-pencil"></span></a>
	<button class="btnDelete btn btn-danger btn-xs" onclick="del_confirm($1)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-trash"></span></button>
	</div>',"id");
		
		echo $this->datatables->generate(); 
	}
	
	function addsupplier()
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
		$data['title'] = "Pradit and Friends - Add Supplier";
		$this->load->view('addsupplier_view',$data);
	}

    function save()
	{
		$this->form_validation->set_rules('supplierid', 'supplierid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|xss_clean|required');
		$this->form_validation->set_rules('contactname', 'contactname', 'trim|xss_clean|required');
		$this->form_validation->set_rules('taxid', 'taxid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean|required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|xss_clean|required|min_length[5]|numeric');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('min_length', 'กรุณาใส่ตัวเลขให้ครบ 5 ตัว');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$supplierid= ($this->input->post('supplierid'));
			$title= ($this->input->post('title'));
			$name= ($this->input->post('name'));
			$telephone= ($this->input->post('telephone'));
			$fax= ($this->input->post('fax'));
			$contactname= ($this->input->post('contactname'));
			$taxid= ($this->input->post('taxid'));
			$status= ($this->input->post('status'));
			$address= ($this->input->post('address'));
			$province= ($this->input->post('province'));
			$zipcode= ($this->input->post('zipcode'));
			$creditday= ($this->input->post('creditday'));

			$supplier = array(
				'supplierID' => $supplierid,
				'title' => $title,
				'name' => $name,
				'telephone' => $telephone,
				'fax' => $fax,
				'contactName' => $contactname,
				'taxID' => $taxid,
				'status' => $status,
				'address' => $address,
				'provinceID' => $province,
				'zipcode' => $zipcode,
				'creditDay' => $creditday
			);

			$result = $this->supplier->addSupplier($supplier);
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
		
			$data['title'] = "Pradit and Friends - Add Branch";
			
			$this->load->view('addsupplier_view',$data);
	}
	
	function delete()
	{
		
		$id = $this->uri->segment(3);
		$result = $this->supplier->delSupplier($id);
		
		redirect('managesupplier', 'refresh');
	}
	
	function viewsupplier()
	{
		$id = $this->uri->segment(3);
		$query = $this->supplier->getOneSupplier($id);
		if($query){
			$data['sup_array'] =  $query;
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
		$data['title'] = "Pradit and Friends - View Supplier";
		$this->load->view('viewsupplier_view',$data);
	}
	
	function editsupplier()
	{
		$this->load->helper(array('form'));

		$id = $this->uri->segment(3);
		$query = $this->supplier->getOneSupplier($id);
		if($query){
			$data['sup_array'] =  $query;
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
		$data['title'] = "Pradit and Friends - Edit Supplier";
		$this->load->view('editsupplier_view',$data);

	}
	
	function update()
	{
		
		$this->form_validation->set_rules('supplierid', 'supplierid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|xss_clean|required');
		$this->form_validation->set_rules('contactname', 'contactname', 'trim|xss_clean|required');
		$this->form_validation->set_rules('taxid', 'taxid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean|required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|xss_clean|required|min_length[5]|numeric');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('min_length', 'กรุณาใส่ตัวเลขให้ครบ 5 ตัว');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		$id= ($this->input->post('id'));
		
		if($this->form_validation->run() == TRUE) {
			$supplierid= ($this->input->post('supplierid'));
			$title= ($this->input->post('title'));
			$name= ($this->input->post('name'));
			$telephone= ($this->input->post('telephone'));
			$fax= ($this->input->post('fax'));
			$contactname= ($this->input->post('contactname'));
			$taxid= ($this->input->post('taxid'));
			$status= ($this->input->post('status'));
			$address= ($this->input->post('address'));
			$province= ($this->input->post('province'));
			$zipcode= ($this->input->post('zipcode'));
			$creditday= ($this->input->post('creditday'));

			$supplier = array(
				'id' => $id,
				'supplierID' => $supplierid,
				'title' => $title,
				'name' => $name,
				'telephone' => $telephone,
				'fax' => $fax,
				'contactName' => $contactname,
				'taxID' => $taxid,
				'status' => $status,
				'address' => $address,
				'provinceID' => $province,
				'zipcode' => $zipcode,
				'creditDay' => $creditday
			);

			$result = $this->supplier->editSupplier($supplier);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
		
			$query = $this->supplier->getOneSupplier($id);
			if($query){
				$data['sup_array'] =  $query;
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
			$data['title'] = "Pradit and Friends - Edit Supplier";
			
			$this->load->view('editsupplier_view',$data);
	}
}