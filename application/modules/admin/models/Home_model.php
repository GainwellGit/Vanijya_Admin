	<?php
	if (!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Home_model extends CI_Model {
		public function __construct() {
		parent::__construct();
	}
	
	
	public function check_password($data,$user_name,$old_password){
	
		$this->db->select('*');
		$this->db->from('admin_login');
		$this->db->where('user_name',$user_name);
		$this->db->where('password',md5($old_password));
		//echo $this->db->last_query();
		$value = $this->db->get();
		if($value->num_rows() > 0 ){
			$getvalue = $value->row_array();
			return $getvalue;
			//print_r($getvalue);die();
		}else{
			return false;
		}
	
	}
	
	public function statusChange($email){

		$this->db->select('*');
		$this->db->from('admin_email_list');
		$this->db->where('email',$email);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){

				$gettype = $fetch_data->row();	
				if($gettype->active == 1){

					$data = ['active' => '0',];
			
					$this->db->where('email',$email);
					$this->db->update('admin_email_list', $data);

				}elseif($gettype->active == 0){

					$data = ['active' => '1',];
			
					$this->db->where('email',$email);
					$this->db->update('admin_email_list', $data);
				}

			return TRUE;
		}else{

			return FALSE;
		}

	}
	
	public function check_mail($email){
        
        $this->db->select('*');
		$this->db->from('admin_email_list');
		$this->db->where('email',$email);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			return true;
		}else{

			return false;
		}

	}


	public function insert_mail($data){

		$this->db->insert('admin_email_list',$data);
		return true;
	}
	
	public function get_email(){
	
		$this->db->select('*');
		$this->db->from('admin_email_list');
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	
	}
	
	
	
	public function saveNewPassword($data,$user_name,$old_password)
	{
	
		$this->db->where('user_name',$user_name);
		$this->db->where('password',md5($old_password));
		$query = $this->db->update('admin_login',$data);   
		
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}
	
	
	public function getuserdetails(){
	
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->order_by("id", "desc");
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	
	}
	public function getalluser(){
	
		$this->db->select('*');
		$this->db->from('user_login');
		$this->db->order_by("id_user", "desc");
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	
	}
	
	public function update_status($user_id,$status) {
	
		$this->db->set('status', $status); 
		$this->db->where('id', $user_id); 
		if($this->db->update('user_details'))   
		{
			return true;
		}else{
			return false;  
		}
	
	}
	
	
	
	
	
	public function count_customer()
	{

		// $this->db->select('count(id)');
		// $query = $this->db->get('customer_address');
		// $cnt = $query->row_array();
		// return $cnt['count(id)'];
        $this->db->distinct();
		$this->db->select('customer_code');
		$this->db->from('customer_address');
		$query=$this->db->get();
		if($query->num_rows() >0)
		{
			return $query->num_rows();
		}
		else{
			return 0; 
		}

	
	}
	
	public function count_location()
	{

		$this->db->select('count(*)');
		$query = $this->db->get('region_master');
		$cnt = $query->row_array();
		return $cnt['count(*)'];
	
	}


	public function count_group()
	{

		$this->db->select('count(*)');
		$query = $this->db->get('material_group');
		$cnt = $query->row_array();
		return $cnt['count(*)'];
	
	}


	public function count_zone()
	{

		$this->db->select('count(id)');
		$query = $this->db->get('zone_coupon');
		$cnt = $query->row_array();
		return $cnt['count(id)'];
	
	}


	public function count_mapping()
	{
        

    $this->db->distinct();
	$this->db->select('machinemodel_material_no');
	$this->db->where('mapping_status', 1); 
	$query = $this->db->get('pmkit_mapping');

		//$cnt = $query->row_array();
		return $query->num_rows();
	
	}


	public function count_promotion()
	{
        

        $this->db->select('count(id)');
		$query = $this->db->get('offer_storage');
		$cnt = $query->row_array();
		return $cnt['count(id)'];
	
	}

	public function get_machine_model(){


		$this->db->select('*');
		$this->db->from('machine_model_master');
		$this->db->order_by("id", "desc");
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}


	public function get_material_bom(){

        $this->db->distinct();
		$this->db->select('pmkit_material_no');
		$this->db->from('material_bom_master');
		//$this->db->limit(1); 
		//$this->db->group_by('pmkit_material_no'); 

		$fetch_data = $this->db->get();


			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}

	public function get_material(){


		$this->db->select('*');
		$this->db->from('material_master');
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}

	public function count_order_reconciliation()
	{
        
        $this->db->distinct();
		$this->db->select('count(payment_status) as total');
		$this->db->where('payment_status', 'N'); 
		$query = $this->db->get('order_master');
		$cnt = $query->row_array();
		return $cnt['total'];
	
	}

	public function get_server_log($start_date,$end_date){

		//$query = "SELECT id ,logtime, logData ,logtype,logtext FROM server_log_springboot where logtime between '".$start_date."' and '".$end_date."' ";
		$accommodation = 'logtime';
		$this->db->select('*'); //id , logtime , logData , logtype, logtext
		$this->db->from('server_log_springboot');
		$this->db->where("$accommodation BETWEEN '$start_date' AND '$end_date'");

		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}


	public function save_display_name($display_name,$material_no){
		$data = ['material_number' => $material_no, 'display_name' => $display_name , 'created' => date('Y-m-d H:i:s') ];

		$this->db->select('material_number');
		$this->db->from('material_display_name');
		$this->db->where('material_number',$material_no);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				 	$this->db->where('material_number', $material_no);
					$this->db->update('material_display_name', $data);
					return true;
			}else{
				$this->db->insert('material_display_name',$data);
				return true;
			}
		
	}


	
}