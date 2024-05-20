<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Undeliverable_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		$this->usersessiondata = $this->session->userdata('logged_in');
	}

    public function get_undeliverable_part_list(){
		$this->db->select('*');
		$this->db->from('undeliverable_parts');
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$gettype = $fetch_data->result_array();	
		}
		else{
			$gettype = array();
		}
		return $gettype;
    }

	public function insert($data){
		$this->db->insert_batch('undeliverable_parts', $data);
	}

	function delete(){
		$this->db->truncate('undeliverable_parts');
	}
}
?>
