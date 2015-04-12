<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_model extends CI_Model
  	{  
		private $user_table = "user";
		
		public function __construct() 
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		public function check_exists($netID)
		{
			$this->db->select('netID');
			$this->db->where('netID', $netID);
			$query = $this->db->get($this->user_table);
			
			if ($query->num_rows() == 0) {
				return false;
			}
			else {
				return true;
			}
		}
		
		public function add_member($netID, $name, $phone)
		{
			$data = array(
				'netID'	=> $netID,
				'name'	=> $name,
				'phone' 	=> $phone,
			);
			
			$this->db->insert($this->user_table, $data);
		}
		
		public function get_member_from_netid($netID) {
			$this->db->select('*');
			$this->db->where('netID', $netID);
			$query = $this->db->get($this->user_table);
			
			return $query->row(0);
		}
		
		public function get_courses_from_netid($netID) {
			$this->db->select('*');
			$this->db->where('netID', $netID);
			$query = $this->db->get($this->user_table);
			
			$courses = $query->row(0)->courses;
			if($courses == NULL) {
				$courses = array();
			}
			else {
				$courses = explode(';', $courses);
			}
			
			for($i = 0; $i < count($courses); $i++) {
				if($courses[$i] == '') {
					unset($courses[$i]);
				}
			}
			
			return $courses;
		}
		
		public function get_groups_from_netid($netID) {
			$this->db->select('*');
			$this->db->where('netID', $netID);
			$query = $this->db->get($this->user_table);
			
			$groups = $query->row(0)->groups;
			if($groups == NULL) {
				$groups = array();
			}
			else {
				$groups = explode(';', $groups);
			}
			
			for($i = 0; $i < count($groups); $i++) {
				if($groups[$i] == '') {
					unset($groups[$i]);
				}
			}
			
			return $groups;
		}
		
		public function add_course($netID, $courseID) {
			$this->db->select('courses');
			$this->db->where('netID', $netID);
			$query = $this->db->get($this->user_table);
			
			$courses = $query->row(0)->courses;
			
			$courses = explode(';', $courses);
			if(!in_array($courseID, $courses)) {
				$courses[] = $courseID;
			}
			$courses = implode(';', $courses);
			
			$data = array(
				'courses' => $courses,
			);
			
			$this->db->where('netID', $netID);
			$this->db->update($this->user_table, $data);
		}
	}
?>