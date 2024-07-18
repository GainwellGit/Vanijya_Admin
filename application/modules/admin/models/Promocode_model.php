<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Promocode_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		
	}

	public function getAllZone()
    {
		$this->db->distinct();
		$this->db->select('Zone');
		$this->db->from('region_master');
		$this->db->where('Zone !=', '');
		$this->db->order_by('Zone', 'asc');
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
    }

    public function get_globalpromocode(){
		$this->db->select('*');
		$this->db->from('promo_codes');
		$this->db->where('status !=','D');
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

	public function get_material($matgrp){
		$this->db->select('*');
		$this->db->from('material_master');
		$this->db->where('material_group',$matgrp);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}

	public function statusChange($id){

    	$this->db->select('*');
		$this->db->from('promo_codes');
		$this->db->where('id',$id);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){

			$gettype = $fetch_data->row();	
			if($gettype->status == 'A'){

				$data = ['status' => 'I', 'updated_at' => date("Y-m-d h:i:s"),];
		
				$this->db->where('id',$id);
				$this->db->update('promo_codes', $data);

			}elseif($gettype->status == 'I'){

				$data = ['status' => 'A', 'updated_at' => date("Y-m-d h:i:s"),];
		
				$this->db->where('id',$id);
				$this->db->update('promo_codes', $data);
			}
            return TRUE;
		}else{
			return FALSE;
		}
    }

	/* public function get_dison_selectlist($disid, $dison){
		if($dison=='MATERIAL-GROUP'){
			$this->db->select('*');
			$this->db->from('promo_codes_material_group');
			$this->db->join('material_master', 'promo_codes_material_group.material_no = material_master.material_no', 'inner');
			$this->db->where('promo_codes_material_group.discount_id',$disid);
		}
		if($dison=='CUSTOMER'){
			$this->db->select('*');
			$this->db->from('promo_codes_customer');
			$this->db->join('customer_address', 'promo_codes_customer.customer_code = customer_address.customer_code', 'inner');
			$this->db->where('promo_codes_customer.discount_id',$disid);
		}
		if($dison=='REGION'){
			$this->db->select('*');
			$this->db->from('promo_codes_region');
			$this->db->join('region_master', 'promo_codes_region.region = region_master.region_code', 'inner');
			$this->db->where('promo_codes_region.discount_id',$disid);
		}
		if($dison=='ZONE'){
			$this->db->select('*');
			$this->db->from('promo_codes_zone');
			$this->db->where('discount_id',$disid);
		}
		
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	} */

	public function get_dison_selectlist($disid, $dison, $matgrp, $allselect){
		if($dison=='MATERIAL-GROUP'){
			if($allselect == 1){
				$this->db->select('material_group.group_code, material_group.group_description');
				$this->db->from('material_group');
				$this->db->where('material_group.group_code',$matgrp);
			}
			else{
				$this->db->select('promo_codes_material_group.material_no, material_master.material_description, material_group.group_code, material_group.group_description');
				$this->db->from('promo_codes_material_group');
				$this->db->join('material_master','promo_codes_material_group.material_no = material_master.material_no');
				$this->db->join('material_group','material_master.material_group = material_group.group_code');
				$this->db->where('promo_codes_material_group.discount_id',$disid);
			}
			/* $this->db->select('*');
			$this->db->from('promo_codes_material_group');
			$this->db->join('material_master', 'promo_codes_material_group.material_no = material_master.material_no', 'inner');
			$this->db->where('promo_codes_material_group.discount_id',$disid); */
		}
		if($dison=='CUSTOMER'){
			if($allselect != 1){
			$this->db->select('*');
			$this->db->from('promo_codes_customer');
			$this->db->join('customer_address', 'promo_codes_customer.customer_code = customer_address.customer_code', 'inner');
			$this->db->where('promo_codes_customer.discount_id',$disid);
			}else{
				$getdata = array();
				return $getdata;
			}
		}
		if($dison=='REGION'){
			$this->db->select('*');
			$this->db->from('promo_codes_region');
			$this->db->join('region_master', 'promo_codes_region.region = region_master.region_code', 'inner');
			$this->db->where('promo_codes_region.discount_id',$disid);
		}
		if($dison=='ZONE'){
			$this->db->select('*');
			$this->db->from('promo_codes_zone');
			$this->db->where('discount_id',$disid);
		}
		
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}

	public function get_allcustomers()
	{
		$this->db->select('id, customer_code, name1');
		$this->db->from('customer_address');
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}

	public function check_promocode($promocode) {
		$this->db->select('*');
		$this->db->from('promo_codes');
		$this->db->where('promocode', $promocode);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = 1;	
		}
		else{
			$getdata = 0;
		}
		return $getdata;
	}

    /* public function save_promocode($id,$promocode,$desc,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismat,$discust,$disreg,$diszone,$disstatus){
		$this->db->select('*');
		$this->db->from('promo_codes');
		$this->db->where('id',$id);    
		$fetch_data = $this->db->get();

		if($fetch_data->num_rows() > 0 ){
			$data = ['to_date' => $disto, 'status' => $disstatus, 'updated_at' => date("Y-m-d h:i:s")];

			$Where = array('id' => $id );
			$this->db->where($Where);
			$this->db->update('promo_codes', $data);
		}else{
			$data = ['promocode' => $promocode, 'description' => $desc, 'discount_type' => $distype, 'discount_value' => $disval, 'min_ammount' => $dismina, 'from_date' => $disfrom, 'to_date' => $disto, 'discount_on' => $dison, 'status' => $disstatus, 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => null];

			$this->db->insert('promo_codes',$data);
			$insert_id = $this->db->insert_id();
			
			$newArray=array();
			if($dison=='MATERIAL-GROUP'){
				foreach($dismat as $mat){
					$matdata['discount_id'] = $insert_id;
					$matdata['material_no'] = $mat;
					$matdata['created_at'] = date("Y-m-d h:i:s");
					$matdata['updated_at'] = date("Y-m-d h:i:s");
					$newArray[] = $matdata;
				}
				
				$this->db->insert_batch('promo_codes_material_group', $newArray);
			}

			if($dison=='REGION'){
				foreach($disreg as $reg){
					$matdata['discount_id'] = $insert_id;
					$matdata['region'] = $reg;
					$matdata['created_at'] = date("Y-m-d h:i:s");
					$newArray[] = $matdata;
				}
				
				$this->db->insert_batch('promo_codes_region', $newArray);
			}

			if($dison=='ZONE'){
				foreach($diszone as $zone){
					$matdata['discount_id'] = $insert_id;
					$matdata['zone'] = $zone;
					$matdata['created_at'] = date("Y-m-d h:i:s");
					$matdata['updated_at'] = date("Y-m-d h:i:s");
					$newArray[] = $matdata;
				}
				
				$this->db->insert_batch('promo_codes_zone', $newArray);
			}

			if($dison=='CUSTOMER'){
				foreach($discust as $cust){
					$matdata['discount_id'] = $insert_id;
					$matdata['customer_code'] = $cust;
					$matdata['created_at'] = date("Y-m-d h:i:s");
					$newArray[] = $matdata;
				}
				
				$this->db->insert_batch('promo_codes_customer', $newArray);
			}
		}
		return true;
	} */

	public function save_promocode($id,$dispromo,$dispdes,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismatgrp,$mattype,$dismat,$discust,$disreg,$diszone,$disstatus){
		if(is_string($dismat) && !empty($dismat)){
			$string_mat = $dismat;
			$dismat = explode(',', $string_mat);
		}
		if(is_string($discust) && !empty($discust)){
			$string_mat = $discust;
			$discust = explode(',', $string_mat);
		}

		if($dison=='MATERIAL-GROUP'||$dison=='CUSTOMER'){
			if ($mattype == '') {
				$all_select = 0;
			} else if ($mattype == 'All') {
				$all_select = 1;
			} else {
				$all_select = 0;
			}
		}else{$all_select = NULL;}

		if($dison != 'MATERIAL-GROUP'){
			$dismatgrp = NULL;
		}
		
		if($dison == 'ALL' || $mattype == 'All' || !empty($dismat) || !empty($discust) || !empty($disreg) || !empty($diszone)){
			$data = ['promocode' => $dispromo, 'description' => $dispdes, 'discount_type' => $distype, 'discount_value' => $disval, 'min_ammount' => $dismina, 'from_date' => $disfrom, 'to_date' => $disto, 'discount_on' => $dison, 'material_group_code' => $dismatgrp, 'all_select' => $all_select, 'status' => 'A', 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => null];

			$this->db->insert('promo_codes',$data);
			$insert_id = $this->db->insert_id();
		}

		$newArray=array();
		if($dison=='MATERIAL-GROUP' && $mattype != 'All' && !empty($dismat)){
			$newArray = array();
			$notexist_mat_arr = array();
			foreach($dismat as $mat){
				if ($this->validate_material_exist_ingrp($mat, $dismatgrp) == 1) {
					$matdata['discount_id'] = $insert_id;
					$matdata['material_no'] = $mat;
					$matdata['created_at'] = date("Y-m-d h:i:s");
					$matdata['updated_at'] = date("Y-m-d h:i:s");
					$newArray[] = $matdata;
				} else {
					$notextmatdata['material_no'] = $mat;
				}

				$notexist_mat_arr[] = $notextmatdata;
			}

			$newArray = array_values(array_filter($newArray));
			$notexist_mat_arr = array_values(array_filter($notexist_mat_arr));
			
			if(!empty($newArray)){
				$this->db->insert_batch('promo_codes_material_group', $newArray);
			}else{
				$this->db->delete('promo_codes', array('id' => $insert_id));
				//return $notexist_mat_arr;
			}

			if(!empty($notexist_mat_arr)){
				return $notexist_mat_arr;
			}else{
				return true;
			}
		}

		if($dison=='CUSTOMER' && $mattype != 'All' && !empty($discust)){
			$newArray = array();
			$notexist_cust_arr = array();
			foreach($discust as $cust){
				if ($this->validate_customer_exist($cust) == 1) {
					$matdata['discount_id'] = $insert_id;
					$matdata['customer_code'] = $cust;
					$matdata['created_at'] = date("Y-m-d h:i:s");
					$newArray[] = $matdata;
				} else {
					$notextcust['customer_code'] = $cust;
				}

				$notexist_cust_arr[] = $notextcust;
			}

			$newArray 		   = array_values(array_filter($newArray));
			$notexist_cust_arr = array_values(array_filter($notexist_cust_arr));
			
			if(!empty($newArray)){
				$this->db->insert_batch('promo_codes_customer', $newArray);
			}else{
				$this->db->delete('promo_codes', array('id' => $insert_id));
				//return $notexist_cust_arr;
			}

			if(!empty($notexist_cust_arr)){
				return $notexist_cust_arr;
			}else{
				return true;
			}
		}

		if($dison=='REGION'){
			foreach($disreg as $reg){
				$matdata['discount_id'] = $insert_id;
				$matdata['region'] = $reg;
				$matdata['created_at'] = date("Y-m-d h:i:s");
				$newArray[] = $matdata;
			}
			
			$this->db->insert_batch('promo_codes_region', $newArray);
		}

		if($dison=='ZONE'){
			foreach($diszone as $zone){
				$matdata['discount_id'] = $insert_id;
				$matdata['zone'] = $zone;
				$matdata['created_at'] = date("Y-m-d h:i:s");
				$matdata['updated_at'] = date("Y-m-d h:i:s");
				$newArray[] = $matdata;
			}
			
			$this->db->insert_batch('promo_codes_zone', $newArray);
		}
		return true;
	}

	public function validate_material_exist_ingrp($mat, $dismatgrp){
		$exist = 0;
		$this->db->select('*');
		$this->db->from('material_master');
		$this->db->where('material_group',$dismatgrp);
		$this->db->where('material_no',$mat);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$exist = 1;
		}else{
			$exist = 0;
		}

		return $exist;
	}

	public function validate_customer_exist($cust){
		$exist = 0;
		$this->db->select('*');
		$this->db->from('customer_address');
		$this->db->where('customer_code',$cust);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$exist = 1;
		}else{
			$exist = 0;
		}

		return $exist;
	}

	public function delete_promocode($id){
		$this->db->where(['id' => $id]);
		$this->db->update('promo_codes', ['status'=>'D']);
		
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

?>
