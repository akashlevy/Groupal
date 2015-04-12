<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

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
		$this->load->helper('url');
		$this->load->helper('form');
    	$this->load->model('course_model');
		$this->load->model('user_model');
   
   		if ($this->session->userdata('logged_in') != true) {
			redirect(base_url('/auth'));
		}
   
    	$this->data['title'] = "Courses";
		$this->data['name'] = $this->session->userdata('name');
		$this->data['tags'] = $this->course_model->get_tags();
	}

	public function index()
	{
		$post_data = $this->input->post();
		
		if(!empty($post_data)) {
			redirect(base_url('/course/' . $post_data['course_id']));
		}
		
		// $this->course_model->add_courses();
		// $user_status = $this->user_model->check_exists("dk7");
		$this->data['groups'] = $this->user_model->get_groups_from_netid($this->session->userdata('netID'));
		
		$this->load->view('overall_header', $this->data);
		$this->load->view('home_view', $this->data);
		$this->load->view('overall_footer', $this->data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(''));
	}
}
