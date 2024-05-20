<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Hub_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		$this->usersessiondata = $this->session->userdata('logged_in');
	}

    public function get_hub(){   
		$this->db->select('*');
		$this->db->from('hub_master');
		$this->db->order_by("hub_name", "asc");
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$gettype = $fetch_data->result_array();	
		}
		else{
			$gettype = array();
		}
		return $gettype;
    }

	public function save_hub($hubcode,$hubname,$hubaddress){
		$data = ['hub_code' => $hubcode, 'hub_name' => $hubname, 'hub_address' => $hubaddress];
		$this->db->select('*');
		$this->db->from('hub_master');
		$this->db->where('hub_code',$hubcode); 
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$Where = array('hub_code' => $hubcode);
			$this->db->where($Where);
			$this->db->update('hub_master', $data);
		}else{
			$this->db->insert('hub_master',$data);
		}
		return true;
	}

	public function get_hubcode_by_id($hub){
		$this->db->select('hub_code');
		$this->db->from('hub_master');
		$this->db->where('id', $hub);
		$value = $this->db->get()->row();
		$hub_code =  ($value->hub_code == '') ? '' : $value->hub_code;
		
		return $hub_code;
	}

	public function save_plant_hub($getHubCode,$plant_id){
		$data = ['hub_code' => $getHubCode];
		$this->db->select('*');
		$this->db->from('plant_master');
		$this->db->where('id',$plant_id); 
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$Where = array('id' => $plant_id);
			$this->db->where($Where);
			$this->db->update('plant_master', $data);
		}

		$this->db->select('hub_name');
		$this->db->from('hub_master');
		$this->db->where('hub_code', $getHubCode);
		$chk = $this->db->get()->row();
		$hub_name = $chk->hub_name;
		return $hub_name;
	}

	public function delete_empaccess($id,$empid,$empname,$empmobile){
		$this->db->delete('emp_app_access', array('emp_id' => $empid, 'emp_name' => $empname, 'emp_mobile' => $empmobile));
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
?>
