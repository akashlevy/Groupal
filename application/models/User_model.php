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
			
			return $groups;
		}
	}
?>