<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
   
    	$this->data['title'] = "Groupal Home";
		$this->data['name'] = $this->session->userdata('name');
		$this->data['tags'] = $this->course_model->get_tags();
	}

	public function index()
	{
		$post_data = $this->input->post();
		
		if(!empty($post_data)) {
			$this->user_model->add_course($this->session->userdata('netID'), $post_data['course_id']);
		}
		
		// $this->course_model->add_courses();
		$courses = $this->user_model->get_courses_from_netid($this->session->userdata('netID'));
		foreach($courses as $id => $course) {
			$c_data = $this->course_model->get_course_from_id($courses[$id]);
			$courses[$id] = array('data' => $c_data, 'groups' => $this->course_model->get_groups_for_course($courses[$id], $c_data->term_id));
		}
		
		$this->data['courses'] = $courses;
		
		$this->data['groups'] = $this->user_model->get_groups_from_netid($this->session->userdata('netID'));
		$this->data['user_id'] = $this->session->userdata('id');
		
		$this->load->view('overall_header', $this->data);
		$this->load->view('home_view', $this->data);
		$this->load->view('overall_footer', $this->data);
	}
	
	public function create($id = 0, $term = 0) {
		$courses = $this->user_model->get_courses_from_netid($this->session->userdata('netID'));
		if (in_array($id, $courses)) {
			$this->load->model('group_model');
			
			$api_key = 'a9da1ef0c2df0132778d5a2bf7f91165';
			require('GroupMePHP/src/groupme.php');
			$gm = new groupme($api_key);
			
			$id = $this->group_model->create_group($gm, $id, $term);
			$this->group_model->adduser_group($gm, $id, $this->session->userdata('id'));
		}
		redirect(base_url());
	}
	
	public function join($id = 0, $course_id = 0) {
		$courses = $this->user_model->get_courses_from_netid($this->session->userdata('netID'));
		if (in_array($course_id, $courses)) {
			$this->load->model('group_model');
			
			$api_key = 'a9da1ef0c2df0132778d5a2bf7f91165';
			require('GroupMePHP/src/groupme.php');
			$gm = new groupme($api_key);
			
			$this->group_model->adduser_group($gm, $id, $this->session->userdata('id'));
		}
		redirect(base_url());
	}
	
	public function remove($id = 0) {
		$groups = $this->user_model->get_groups_from_netid($this->session->userdata('netID'));
		if (in_array($id, $groups)) {
			$this->load->model('group_model');
			
			$api_key = 'a9da1ef0c2df0132778d5a2bf7f91165';
			require('GroupMePHP/src/groupme.php');
			$gm = new groupme($api_key);
			
			$this->group_model->removeuser_group($gm, $id, $this->session->userdata('id'));
		}
		redirect(base_url());
	}
	
	public function remove_course($id) {
		$this->user_model->remove_course($this->session->userdata('netID'), $id);
		redirect(base_url());
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(''));
	}
}
