<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); 

class Main extends CI_Controller {
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('user','',TRUE);
	}
	function index()
	{
		if($this->session->userdata('sessid'))
		{
			$data['title'] = "Pradit and Friends - Main";
			$this->load->view('main_view',$data);
		}
	   else
	   {
		 //If no session, redirect to login page
		 redirect('login', 'refresh');
	   }
	}
	
	function logout()
	{
	   $this->session->unset_userdata('sessid');
	   $this->session->unset_userdata('sessusername');
	   $this->session->unset_userdata('sessfirstname');
	   $this->session->unset_userdata('sesslastname');
	   $this->session->unset_userdata('sessstatus');
	   session_destroy();
	   redirect('main', 'refresh');
	}
	
	function changepass()
	{
		$this->load->helper(array('form'));
		
		$data['id'] = $this->session->userdata('sessid');
		
		$data['title'] = "Pradit and Friends - Change Password";
		
		$this->load->view('changepass_view',$data);
	}
	
	function updatepass()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('opassword', 'old password', 'trim|xss_clean|required|md5');
		$this->form_validation->set_rules('npassword', 'new password', 'trim|xss_clean|required|md5');
		$this->form_validation->set_rules('passconf', 'Password confirmation', 'trim|xss_clean|required|matches[npassword]');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('matches', 'กรุณาใส่รหัสให้ตรงกัน');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$newpass= ($this->input->post('npassword'));
			$oldpass= ($this->input->post('opassword'));
			$id= ($this->input->post('id'));

			if ($this->user->checkpass($id,$oldpass)) {
					
				$user = array(
					'id' => $id,
					'password' => $newpass
				);

				$result = $this->user->editUser($user);
				if ($result)
					$this->session->set_flashdata('showresult', 'success');
				else
					$this->session->set_flashdata('showresult', 'fail');

			}else{
				$this->session->set_flashdata('showresult', 'failpass');
			}
			redirect(current_url());
		}
			$data['title'] = "Pradit and Friends - Change Password";
			
			$this->load->view('changepass_view',$data);
	}
}