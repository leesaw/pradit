<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manageuser extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('user','',TRUE);
	   $this->load->library('form_validation');
	   if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		$query = $this->user->getUsers();
		if($query){
			$data['user_array'] =  $query;
		}

		$data['title'] = "Pradit and Friends - User Management";
		$this->load->view('manageuser_view',$data);
		
	 
	}
	
	function adduser()
	{
		$this->load->helper(array('form'));
		
		$data['title'] = "Pradit and Friends - Add Users";
		$this->load->view('adduser_view',$data);

	}
	
	function edituser()
	{
		$this->load->helper(array('form'));

		
		$data['title'] = "Pradit and Friends - Edit Users";
		
		$id = $this->uri->segment(3);
		$query = $this->user->getOneUser($id);
		if($query){
			$data['user_array'] =  $query;
		}
		$this->load->view('edituser_view',$data);

	}
	
    function save()
	{
	
		
		
		$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required|callback_username_is_exist');
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|md5');
		$this->form_validation->set_rules('passconf', 'Password confirmation', 'trim|xss_clean|required|matches[password]');
		$this->form_validation->set_rules('fname', 'ชื่อ', 'trim|xss_clean|required');
		$this->form_validation->set_rules('lname', 'นามสกุล', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('matches', 'กรุณาใส่รหัสให้ตรงกัน');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$username= ($this->input->post('username'));
			$password= ($this->input->post('password'));
			$firstName= ($this->input->post('fname'));
			$lastName= ($this->input->post('lname'));
			$status= ($this->input->post('status'));


			$user = array(
				'username' => $username,
				'password' => $password,
				'firstname' => $firstName,
				'lastname' => $lastName,
				'status' => $status
			);

			$result = $this->user->addUser($user);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
			$data['title'] = "Pradit and Friends - Add Users";
			
			$this->load->view('adduser_view',$data);
	}

	function username_is_exist($username)
    {
        
        if($this->username_validate($username))
        {
			$this->form_validation->set_message('username_is_exist', '%s นี้มีอยู่ในระบบแล้ว');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
	function username_validate($username)
    {
        $this->db->where('username', $this->input->post('username'));
        $query = $this->db->get('users');
        
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
	
	function delete()
	{
		
		$id = $this->uri->segment(3);
		$result = $this->user->delUser($id);
		
		redirect('manageuser', 'refresh');
	}
	
	function update()
	{
		
		$this->form_validation->set_rules('fname', 'ชื่อ', 'trim|xss_clean|required');
		$this->form_validation->set_rules('lname', 'นามสกุล', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'ข้อมูลผิดพลาด');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		$id= ($this->input->post('id'));
		
		if($this->form_validation->run() == TRUE) {
			$firstName= ($this->input->post('fname'));
			$lastName= ($this->input->post('lname'));
			$status= ($this->input->post('status'));
			


			$user = array(
				'id' => $id,
				'firstname' => $firstName,
				'lastname' => $lastName,
				'status' => $status
			);

			$result = $this->user->editUser($user);
			if ($result)
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
			$data['title'] = "Pradit and Friends - Edit Users";
			$query = $this->user->getOneUser($id);
			if($query){
				$data['user_array'] =  $query;
			}
			$this->load->view('edituser_view',$data);
	}
}