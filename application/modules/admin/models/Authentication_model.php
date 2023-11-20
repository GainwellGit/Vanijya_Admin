<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Authentication_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	

	public function getUserdata($data){	
	   
	    $username=$data['user_name'];
		$password=$data['password'];
	
		$this->db->select('*');
		$this->db->from('admin_login');
		$this->db->where('user_name',$username);
		$this->db->where('password',$password);    
		$value = $this->db->get();
		if($value->num_rows() > 0 ){
			$getvalue = $value->row_array();
			return $getvalue; 	
		}else{
			
			return false;
			}
		
	
		 
		}
	

	
}