<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managecat extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('category','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		

		$data['title'] = "Pradit and Friends - Category Management";
		$this->load->view('category_view',$data);
		
	 
	}
	
	function addcat()
	{
		$this->load->helper(array('form'));
		
		$data['title'] = "Pradit and Friends - Add Category";
		$this->load->view('addcat_view',$data);
	}

    function save()
	{
	
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$name= ($this->input->post('name'));


			$cat = array(
				'name' => $name
			);

			$result = $this->category->addCat($cat);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
			$data['title'] = "Pradit and Friends - Add Category";
			
			$this->load->view('addcat_view',$data);
	}
	
	function delete()
	{
		
		$id = $this->uri->segment(3);
		$result = $this->category->delCat($id);
		
		redirect('managecat', 'refresh');
	}
	
	function editcat()
	{
		$this->load->helper(array('form'));

		
		$data['title'] = "Pradit and Friends - Edit Category";
		
		$id = $this->uri->segment(3);
		$query = $this->category->getOneCat($id);
		if($query){
			$data['cat_array'] =  $query;
		}
		$this->load->view('editcat_view',$data);

	}
	
	function update()
	{
		
		$this->form_validation->set_rules('name', 'name', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'ข้อมูลผิดพลาด');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		$id= ($this->input->post('id'));
		
		if($this->form_validation->run() == TRUE) {
			$name= ($this->input->post('name'));
			


			$cat = array(
				'id' => $id,
				'name' => $name
			);

			$result = $this->category->editCat($cat);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
			$query = $this->category->getOneCat($id);
			if($query){
				$data['cat_array'] =  $query;
			}
			$data['title'] = "Pradit and Friends - Edit Category";
			
			$this->load->view('editcat_view',$data);
	}
}