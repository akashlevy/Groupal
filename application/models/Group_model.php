<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model
{
	private $course_table = 'courses';
	private $group_table = 'group';
	private $user_table = 'user';
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}
	
	/* 
	 * Create new group
	 * @param int $course_id
	 * @param int $term_id
	 * @return int id
	 */
	public function create_group($gm, $course_id, $term_id)
	{
		// Get course data from database and process
		$this->db->select('*');
		$this->db->where(array('id' => $course_id, 'term_id' => $term_id));
		$query = $this->db->get($this->course_table);
		$course_data = $query->row(0);
		print_r($course_data);
		$subject_code = $course_data->subject_code;
		$subject = $course_data->subject;
		$catalog_number = $course_data->catalog_number;
		$title = $course_data->title;
		$instructors = $course_data->instructors;
		$term = $course_data->term;
		$name =  $subject_code.' '.$catalog_number.' Study Group';
		$description = 'Study group for people in '.$title.' ('.$subject_code.' '.$catalog_number.') for '.$term.' with '.$instructors.'.';
		
		// Create new groupme and get groupme_id
		$response = $gm->groups->create(array('name' => $name, 'description' => $description, 'image_url' => base_url('/images/logo.jpg')));
		// print_r($response); // REMOVE WHEN CHECK FOR SUCCESS (DECODE HTML RESPONSE?)
		$json_response = json_decode($response);
		$groupme_id = $json_response->response->id;
		
		// Create group and add to database
		$data = array('course_id' => $course_id, 'groupme_id' => $groupme_id, 'term_id' => $term_id);
		$this->db->insert($this->group_table, $data);
		
		return $this->db->insert_id();
	}
	
	/* 
	 * Add user to group
	 * @param int $group_id
	 * @param int $user_id
	 * @return boolean success
	 */
	public function adduser_group($gm, $group_id, $user_id)
	{	
		// Get group data from database
		$this->db->select('*');
		$this->db->where('id', $group_id);
		$query = $this->db->get($this->group_table);
		$row = $query->row(0);
		$member_ids = $row->member_ids.';'.$user_id;
		// print_r($member_ids);
		$groupme_id = $row->groupme_id;
		
		// Get user data from database and process
		$this->db->select('*');
		$this->db->where('id', $user_id);
		$query = $this->db->get($this->user_table);
		$row = $query->row(0);
		$nickname = $row->name;
		$phone_number = $row->phone;
		$groups = $row->groups.';'.$group_id;
		
		// Add member to groupme
		$response = $gm->members->add($groupme_id, array('members' => array(array('nickname' => $nickname, 'phone_number' => $phone_number))));
		// print_r($response); // REMOVE WHEN CHECK FOR SUCCESS (DECODE HTML RESPONSE?)
		
		// Add user_id to group.member_ids
		$this->db->where('id', $group_id);
		$this->db->update($this->group_table, array('member_ids' => $member_ids));
		
		// Add group to user.groups
		$this->db->where('id', $user_id);
		$this->db->update($this->user_table, array('groups' => $groups));
	}

    /*
	 * Remove user from group
	 * @param int $group_id
	 * @param int $user_id
	 * @return boolean success
	 */
	public function removeuser_group($gm, $group_id, $user_id)
	{
		// Get group data from database
		$this->db->select('*');
		$this->db->where('id', $group_id);
		$query = $this->db->get($this->group_table);
		$row = $query->row(0);
		$member_ids = explode(';', $row->member_ids);
		unset($member_ids[array_search($user_id, $member_ids)]);
		$member_ids = implode(';', $member_ids);
		// print_r($member_ids);
		$groupme_id = $row->groupme_id;
	
		// Get user data from database and process
		$this->db->select('*');
		$this->db->where('id', $user_id);
		$query = $this->db->get($this->user_table);
		$row = $query->row(0);
		$nickname = $row->name;
		$phone_number = $row->phone;
		$groups = explode(';', $row->groups);
		unset($groups[array_search($group_id, $groups)]);
		$groups = implode(';', $groups);
	
		// Remove user_id from group.member_ids
		$this->db->where('id', $group_id);
		$this->db->update($this->group_table, array('member_ids' => $member_ids));

		// Remove group from user.groups
		$this->db->where('id', $user_id);
		$this->db->update($this->user_table, array('groups' => $groups));
	}
}