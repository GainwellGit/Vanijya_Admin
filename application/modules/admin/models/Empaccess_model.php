<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Empaccess_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		$this->usersessiondata = $this->session->userdata('logged_in');
	}

    public function get_empaccess(){
          
		$this->db->select('*');
		$this->db->from('emp_app_access');
		$this->db->order_by("id", "desc");
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$gettype = $fetch_data->result_array();	
		}
		else{
			$gettype = array();
		}
		return $gettype;
    }

	public function save_empaccess($empid,$empname,$empmobile){
		$user_email = $this->usersessiondata['user_name'];
		$this->db->select('name');
		$this->db->from('admin_login');
		$this->db->where('user_name',$user_email);    
		$value = $this->db->get()->row();
		$updated_by =  ($value->name == '') ? '' : $value->name;

		$data = ['emp_id' => $empid, 'emp_name' => $empname, 'emp_mobile' => $empmobile, 'created_by'=>$updated_by];
		$this->db->select('*');
		$this->db->from('emp_app_access');
		$this->db->where('emp_id',$empid);    
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$Where = array('emp_id' => $empid );
			$this->db->where($Where);
			$this->db->update('emp_app_access', $data);
		}else{
			$this->db->insert('emp_app_access',$data);
		}
		return $updated_by;
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
