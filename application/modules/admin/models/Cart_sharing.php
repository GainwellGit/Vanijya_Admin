	<?php
	if (!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Cart_sharing extends CI_Model {
		public function __construct() {
		parent::__construct();
		$this->sec_db = $this->load->database('secondary', true);
	}
	
	
	public function get_cart_shared(){
	
		$this->sec_db->select('COUNT(*) AS shared_c');
		$this->sec_db->from('shared_carts');		
		$value = $this->sec_db->get();
		if($value->num_rows() > 0 ){
			$getvalue = $value->row_array();
			return $getvalue['shared_c'];
			//print_r($getvalue);die();
		}else{
			return false;
		}
	
	}
	
	public function get_all_cart_shared(){
	
		$this->sec_db->select('*');
		$this->sec_db->from('shared_carts');		
		$value = $this->sec_db->get();
		if($value->num_rows() > 0 ){
			$getvalue = $value->row_array();
			return $value->result_array();
			//print_r($value->result_array());die();
		}else{
			return false;
		}
	
	}
	
	public function get_cart_shared_used(){
	
		$this->sec_db->select('COUNT(*) AS u_shared_c');
		$this->sec_db->from('redeemed_shared_carts');		
		$value = $this->sec_db->get();
		if($value->num_rows() > 0 ){
			$getvalue = $value->row_array();
			return $getvalue['u_shared_c'];
			//print_r($getvalue);die();
		}else{
			return false;
		}
	
	}
	
	public function get_all_cart_shared_used(){
	
		$this->sec_db->select('redeemed_shared_carts.*, shared_carts.user_mobile as creator_mobile');
		$this->sec_db->from('redeemed_shared_carts');	
		$this->sec_db->join('shared_carts', 'redeemed_shared_carts.redeemed_cart_uuid = shared_carts.shared_cart_uuid', 'left');  
		$value = $this->sec_db->get();
		if($value->num_rows() > 0 ){
			$getvalue = $value->row_array();
			return $value->result_array();
			//print_r($value->result_array());die();
		}else{
			return false;
		}
	
	}
	
}