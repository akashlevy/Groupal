<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $data;

	function __construct()
	{
		parent::__construct();

    	$this->load->model('course_model');
   
    	$this->data['title'] = "Index";
	}

	public function index()
	{
		// $this->course_model->add_courses();
		
		$this->load->view('overall_header', $this->data);
		$this->load->view('home_view', $this->data);
		$this->load->view('overall_footer', $this->data);
	}
}
