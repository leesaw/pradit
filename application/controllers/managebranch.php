<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managebranch extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('branch','',TRUE);
	   $this->load->model('province','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		

		$data['title'] = "Pradit and Friends - Branch Management";
		$this->load->view('branch_view',$data);
		
	 
	}
	
	function addbranch()
	{
		$this->load->helper(array('form'));
		
		$query = $this->province->getProvince();
		if($query){
			$data['province_array'] =  $query;
		}else{
			$data['province_array'] = array();
		}
		$data['title'] = "Pradit and Friends - Add Branch";
		$this->load->view('addbranch_view',$data);
	}

    function save()
	{
	
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean|required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|xss_clean|required|min_length[5]|numeric');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|xss_clean|required');
		$this->form_validation->set_rules('taxid', 'taxid', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('min_length', 'กรุณาใส่ตัวเลขให้ครบ 5 ตัว');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$name= ($this->input->post('name'));
			$address= ($this->input->post('address'));
			$province= ($this->input->post('province'));
			$zipcode= ($this->input->post('zipcode'));
			$telephone= ($this->input->post('telephone'));
			$fax= ($this->input->post('fax'));
			$taxid= ($this->input->post('taxid'));

			$branch = array(
				'name' => $name,
				'address' => $address,
				'provinceID' => $province,
				'zipcode' => $zipcode,
				'telephone' => $telephone,
				'fax' => $fax,
				'taxid' => $taxid
			);

			$result = $this->branch->addBranch($branch);
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
			$data['title'] = "Pradit and Friends - Add Branch";
			
			$this->load->view('addbranch_view',$data);
	}
	
	function delete()
	{
		
		$id = $this->uri->segment(3);
		$result = $this->branch->delBranch($id);
		
		redirect('managebranch', 'refresh');
	}
	
	function editbranch()
	{
		$this->load->helper(array('form'));

		
		$data['title'] = "Pradit and Friends - Edit Branch";
		
		$id = $this->uri->segment(3);
		$query = $this->branch->getOneBranch($id);
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		$query = $this->province->getProvince();
		if($query){
			$data['province_array'] =  $query;
		}else{
			$data['province_array'] = array();
		}
		$this->load->view('editbranch_view',$data);

	}
	
	function update()
	{
		
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean|required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|xss_clean|required|min_length[5]|numeric');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|xss_clean|required');
		$this->form_validation->set_rules('taxid', 'taxid', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('min_length', 'กรุณาใส่ตัวเลขให้ครบ 5 ตัว');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		$id= ($this->input->post('id'));
		
		if($this->form_validation->run() == TRUE) {
			$name= ($this->input->post('name'));
			$address= ($this->input->post('address'));
			$province= ($this->input->post('province'));
			$zipcode= ($this->input->post('zipcode'));
			$telephone= ($this->input->post('telephone'));
			$fax= ($this->input->post('fax'));
			$taxid= ($this->input->post('taxid'));

			$branch = array(
				'id' => $id,
				'name' => $name,
				'address' => $address,
				'provinceID' => $province,
				'zipcode' => $zipcode,
				'telephone' => $telephone,
				'fax' => $fax,
				'taxid' => $taxid
			);

			$result = $this->branch->editBranch($branch);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
			$query = $this->branch->getOneBranch($id);
			if($query){
				$data['branch_array'] =  $query;
			}else{
				$data['branch_array'] = array();
			}
			$query = $this->province->getProvince();
			if($query){
				$data['province_array'] =  $query;
			}else{
				$data['province_array'] = array();
			}
			$data['title'] = "Pradit and Friends - Edit Branch";
			
			$this->load->view('editbranch_view',$data);
	}
}