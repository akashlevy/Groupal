<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $data;

	function __construct()
	{
		parent::__construct();
		
		/*
		require_once('CAS.php');
		phpCAS::setDebug();
 
		// initialize phpCAS
		phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
		 
		// no SSL validation for the CAS server
		phpCAS::setNoCasServerValidation();
		 
		// force CAS authentication
		phpCAS::forceAuthentication();
		*/
		
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('user_model');
		
		$this->data['admin'] = 0;
		$this->data['logged_in'] = 0;
   
    	$this->data['title'] = "Groupal Authentication";
	}

	public function index()
	{
		$post_data = $this->input->post();
		$this->data['action'] = "";
		if(!empty($post_data)) {
			if($post_data['action'] == 'register') {
				$this->data['action'] = 'register';
				
				// form validation
				$config = array(
				  array (
					'field'   => 'netID',
					'label'   => 'Net ID',
					'rules'   => 'required|callback_validate_member'  
				  ),
				  array (
					'field'   => 'name',
					'label'   => 'Name',
					'rules'   => 'required'  
				  ),
				  array (
					'field'   => 'phone1',
					'label'   => 'Area Code',
					'rules'   => 'required|min_length[3]|integer'
				  ),
				  array (
					'field'   => 'phone2',
					'label'   => 'First 3 Digits',
					'rules'   => 'required|min_length[3]|integer'
				  ),
				  array (
					'field'   => 'phone3',
					'label'   => 'Last 4 Digits',
					'rules'   => 'required|min_length[4]|integer'
				  )
				);
				$this->form_validation->set_rules($config);
			}
			if($post_data['action'] == 'login') {
				$this->data['action'] = 'login';
				
				// form validation
				$config = array(
				  array (
					'field'   => 'netID',
					'label'   => 'Net ID',
					'rules'   => 'required|callback_validate_member_reverse'  
				  ),
				  array (
					'field'   => 'password',
					'label'   => 'Password',
					'rules'   => 'required'  
				  ),
				);
				$this->form_validation->set_rules($config);
			}
		}
		
		$this->load->view('overall_header', $this->data);
		if ($this->form_validation->run() == false)
		{
			$this->load->view('auth_view', $this->data);
		}
		else {
			$post_data = $this->input->post();
			switch ($post_data['action']) {
				case 'login':
					$user = $this->user_model->get_member_from_netid($post_data['netID']);
					$session_data = array(
						'id'			=> $user->id,
						'netID'  		=> $user->netID,
						'name'			=> $user->name,
						'logged_in' 	=> true
					);
					break;
				case 'register':
					$phone = "(" . $post_data['phone1'] . ") " . $post_data['phone2'] . "-" . $post_data['phone3'];
					$this->user_model->add_member($post_data['netID'], $post_data['name'], $phone);
					$user = $this->user_model->get_member_from_netid($post_data['netID']);
					$session_data = array(
						'id'		=> $user->id,
						'netID'  	=> $post_data['netID'],
						'name'		=> $post_data['name'],
						'logged_in' 	=> true
					);
					break;
			}

			$this->session->set_userdata($session_data);
			
			redirect(base_url('/'));
		}
		$this->load->view('overall_footer', $this->data);
	}
	
	public function validate_member($netID)
	{
		if ($this->user_model->check_exists($netID))
		{
			$this->form_validation->set_message('validate_member', 'This netID already exists in our database');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function validate_member_reverse($netID)
	{
		if (!$this->user_model->check_exists($netID))
		{
			$this->form_validation->set_message('validate_member_reverse', 'This netID does not exist');
			return false;
		}
		else
		{
			return true;
		}
	}
}