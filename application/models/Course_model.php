<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Course_model extends CI_Model
	{
		private $course_table = "courses";
		
		public function __construct() 
		{
			parent::__construct();
			$this->load->database();
		}
		
		public function add_courses()
		{
			$webfeedurl = 'http://etcweb.princeton.edu/webfeeds/courseofferings/?subject=all';
			$xml = simplexml_load_file($webfeedurl);
			
			$term_id 	= $xml->term->code;
			$term 		= $xml->term->reg_name;
			
			$this->db->where('term_id', $term_id);
			$this->db->delete($this->course_table);
			
			foreach ($xml->term->subjects->subject as $subject)
			{
				$subject_code = $subject->code;
				$subject_name = $subject->name;
				
				foreach ($subject->courses->course as $course)
				{
					$instructors = array();
					foreach ($course->instructors->instructor as $instructor) 
					{
						$instructors[] = $instructor->full_name;
					}
					
					$classes = array();
					foreach ($course->classes->{'class'} as $class) 
					{
						$classes[] = $class->section;
					}
					
					$data = array(
						'term_id'			=> $term_id,
						'term'				=> $term,
						'subject_code' 		=> $subject_code,
						'subject'			=> $subject_name,
						'catalog_number'	=> $course->catalog_number,
						'course_id'			=> $course->course_id,
						'title'				=> $course->title,
						'instructors'		=> implode(', ', $instructors),
						'class_options'		=> implode(';', $classes),
					);
					
					$this->db->insert($this->course_table, $data);
				}
			}
		}
		
		public function get_tags() 
		{
			$this->db->select('*');
			$query = $this->db->get($this->course_table);
			
			$tags = array();
			foreach($query->result_array() as $tag) {
				$tags[] = '{ label: "' . $tag['subject_code'] . ' ' . $tag['catalog_number'] . '", value: ' . $tag['id'] . ' }';
			}
			
			return implode(', ', $tags);
		}
	}
  
?>