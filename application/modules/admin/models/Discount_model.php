<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Discount_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		
	}

    public function get_globaldiscount(){
		$this->db->select('*');
		$this->db->from('global_discounts');
		$this->db->where('status !=','D');
		$this->db->order_by("id", "desc");
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();
		} else {
			$getdata = array();
		}

		foreach ($getdata as $key => $grp) {
			if ($grp['material_group_code'] != '') {
				$this->db->select('*');
				$this->db->from('material_group');
				$this->db->where("group_code", $grp['material_group_code']);
				$fetch_grp_qry = $this->db->get();
				$fetch_grp = $fetch_grp_qry->result_array();
				$getdata[$key]['group_code'] = $fetch_grp[0]['group_code'];
				$getdata[$key]['group_description'] = $fetch_grp[0]['group_description'];
			}
		}

		return $getdata;
    }

	public function statusChange($id){

    	$this->db->select('*');
		$this->db->from('global_discounts');
		$this->db->where('id',$id);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){

			$gettype = $fetch_data->row();	
			if($gettype->status == 'A'){

				$data = ['status' => 'I',];
		
				$this->db->where('id',$id);
				$this->db->update('global_discounts', $data);
				return FALSE;

			}elseif($gettype->status == 'I'){

				$data = ['status' => 'A',];
		
				$this->db->where('id',$id);
				$this->db->update('global_discounts', $data);
				return TRUE;
			}
		}else{
			return FALSE;
		}
    }

    public function get_all_group() {
		$this->db->select('*');
		$this->db->from('material_group');
		$this->db->order_by("group_description", "desc");
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		} else {
			$getdata = array();
		}

		foreach ($getdata as $key => $grp) {
			$this->db->select('*');
			$this->db->from('material_master');
			$this->db->where("material_group", $grp['group_code']);
			$fetch_data = $this->db->get();
			if($fetch_data->num_rows() == 0) {
				unset($getdata[$key]);
			}
		}

		return $getdata;
	}

	public function get_material($matgrp){
		$this->db->select('*');
		$this->db->from('material_master');
		$this->db->where('material_group',$matgrp);
		$fetch_data = $this->db->get();

		$grpwise_mat_nos = array();
		if($fetch_data->num_rows() > 0 ){
			$getrowdata = $fetch_data->result_array();

			foreach($getrowdata as $row){
				$grpwise_mat_nos[] = $row['material_no'];
			}

			$existing_active_mat_ids = array();
			$this->db->select('id');
			$this->db->from('global_discounts');
			$this->db->where('status','A');
			$this->db->where('discount_on','MATERIAL');
			$fetch_data = $this->db->get();

			if($fetch_data->num_rows() > 0 ){
				$gettype = $fetch_data->result_array();
				
				foreach($gettype as $row){
					$existing_active_mat_ids[] = $row['id'];
				}
			}

			$dis_mat_ids = array();
			if (count($existing_active_mat_ids) > 0) {
				$this->db->select('material_no');
				$this->db->from('global_discount_materials');
				$this->db->where_in('discount_id',$existing_active_mat_ids);
				$fetch_data = $this->db->get();
				if ($fetch_data->num_rows() > 0) {
					$existing_mat_ids = $fetch_data->result_array();
					foreach ($existing_mat_ids as $existing_mat_id) {
						array_push($dis_mat_ids, $existing_mat_id['material_no']);
					}
				}

				$getdiffdata = array_values(array_diff($grpwise_mat_nos, $dis_mat_ids));
				$this->db->select('*');
				$this->db->from('material_master');
				$this->db->where_in('material_no',$getdiffdata);
				$fetch_data = $this->db->get();

				$getdata = array();
				if($fetch_data->num_rows() > 0){
					$getdata = $fetch_data->result_array();
				}
			} else {
				$getdata = $getrowdata;
			}
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}

	public function get_materialby_disid($global_disid, $group_code, $allselect){
		/* $this->db->select('global_discount_materials.material_no, material_master.material_description, material_master.material_group, material_group.group_description');
		$this->db->from('global_discount_materials');
		$this->db->join('material_master','global_discount_materials.material_no = material_master.material_no');
		$this->db->join('material_group','material_master.material_group = material_group.group_code');
		$this->db->where('global_discount_materials.discount_id',$global_disid); */

		if($allselect == 1){
			$this->db->select('material_group.group_code, material_group.group_description');
			$this->db->from('material_group');
			$this->db->where('material_group.group_code',$group_code);
		}
		else{
			$this->db->select('global_discount_materials.material_no, material_master.material_description, material_group.group_code, material_group.group_description');
			$this->db->from('global_discount_materials');
			$this->db->join('material_master','global_discount_materials.material_no = material_master.material_no');
			$this->db->join('material_group','material_master.material_group = material_group.group_code');
			$this->db->where('global_discount_materials.discount_id',$global_disid);
		}

		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$gettype = $fetch_data->result_array();
		}else{
			$gettype = array();
		}
		return $gettype;
	}

	public function save_discount($id,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismatgrp,$mattype,$dismat,$disstatus){
		if (is_string($dismat)) {
			$dismat = explode(',', $dismat);
		}
		$query = 'SELECT `id` FROM `global_discounts` WHERE `status` = "A"';
		if ($dison == 'MATERIAL') {
			$query .= ' AND `discount_on` = "ALL"';
		}
		$query .= ' AND ((DATE(from_date) >= "' . $disfrom . '" AND DATE(from_date) <= "' . $disto . '")';
		$query .= ' OR (DATE(to_date) >= "' . $disfrom . '" AND DATE(to_date) <= "' . $disto . '"))';

		$fetch_data = $this->db->query($query);
		if ($fetch_data->num_rows() > 0) {
			$gettype = $fetch_data->result_array();
			// echo "<pre>"; print_r($gettype); die();
			foreach ($gettype as $row) {
				$this->db->where(['id' => $row['id']]);
				$this->db->update('global_discounts', ['status' => 'I', 'updated_at' => date("Y-m-d h:i:s")]);
			}
		}

		if ($mattype == '') {
			$all_select = 0;
		} else if ($mattype == 'All') {
			$all_select = 1;
		} else {
			$all_select = 0;
		}

		if ($all_select == 1) {
			$this->db->flush_cache();
			$this->db->reset_query();

			$query1 = 'UPDATE `global_discounts` SET `status` = "I", `updated_at` = "' . date("Y-m-d h:i:s") . '" WHERE ';
			$query1 .= ' `material_group_code` = "' . $dismatgrp . '"';
			$query1 .= ' AND ((DATE(from_date) >= "' . $disfrom . '" AND DATE(from_date) <= "' . $disto . '")';
			$query1 .= ' OR (DATE(to_date) >= "' . $disfrom . '" AND DATE(to_date) <= "' . $disto . '"))';

			$this->db->query($query1);
			// echo $this->db->last_query(); die();
		}

		$data = ['discount_type' => $distype, 'discount_value' => $disval, 'min_ammount' => $dismina, 'from_date' => $disfrom, 'to_date' => $disto, 'discount_on' => $dison, 'material_group_code' => $dismatgrp, 'all_select' => $all_select, 'status' => 'A', 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => date("Y-m-d h:i:s")];

		$this->db->insert('global_discounts', $data);

		if($dison == 'MATERIAL' && $all_select == 0){
			$insert_id = $this->db->insert_id();
			$exist_mat_arr = array();
			$new_mat_arr = array();
			$matdata = array();
			$extmatdata = array();
			foreach ($dismat as $mat) {
				if ($this->validate_material_exist($mat, $dismatgrp, $insert_id) == 0) {
					$new_mat_arr[]['discount_id'] = $insert_id;
					$new_mat_arr[]['material_no'] = $mat;
					$new_mat_arr[]['created_at'] 	= date("Y-m-d h:i:s");
					$new_mat_arr[]['updated_at'] 	= date("Y-m-d h:i:s");
				} else {
					$exist_mat_arr[]['material_no'] = $mat;
					break;
				}
			}

			$new_mat_arr = array_values(array_filter($new_mat_arr));
			$exist_mat_arr = array_values(array_filter($exist_mat_arr));

			if (empty($exist_mat_arr)) {
				$this->db->insert_batch('global_discount_materials', $new_mat_arr);
			} else {
				$this->db->delete('global_discounts', array('id' => $insert_id));
				return $exist_mat_arr;
			}
		}
		return true;
	}

	public function validate_material_exist($material_no, $mat_grp, $discount_id) {
		$exist = 0;
		$this->db->select('*');
		$this->db->from('material_master');
		$this->db->where('material_group',$mat_grp);
		$this->db->where('material_no',$material_no);
		$fetch_data = $this->db->get();
		if ($fetch_data->num_rows() > 0) {
			$this->db->select('id');
			$this->db->from('global_discounts');
			$this->db->where('discount_on','MATERIAL');
			$this->db->where('material_group_code',$mat_grp);
			$this->db->where('id !=',$discount_id);
			$this->db->where('status','A');
			$where = '(to_date > now())';
			$this->db->where($where);
			$fetch_query1 = $this->db->get();
			if ($fetch_query1->num_rows() == 0) {
				$mat_arr = array();
				$this->db->select('material_no');
				$this->db->from('global_discount_materials');
				$fetch_mat_query = $this->db->get();
				$fetch_mat_data = $fetch_mat_query->result_array();
				for ($j = 0; $j < count($fetch_mat_data); $j++) {
					array_push($mat_arr, $fetch_mat_data[$j]['material_no']);
				}
				if (in_array($material_no, $mat_arr)) {
					$exist = 1;
				} else {
					$exist = 0;
				}
			} else {
				$exist = 1;
			}
		} else {
			$exist = 1;
		}
		return $exist;
	}

    /* public function save_discount($id,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismat,$disstatus){
		
		$this->db->select('id');
		$this->db->from('global_discounts');
		$this->db->where('status','A');
		
		if($dison == 'ALL'){
			$fetch_data = $this->db->get();

			if($fetch_data->num_rows() > 0 ){
				$gettype = $fetch_data->result_array();
				
				foreach($gettype as $row){
					$this->db->where(['id' => $row['id']]);
					$this->db->update('global_discounts', ['status' => 'I', 'updated_at' => date("Y-m-d h:i:s")]);
				}
			}

			$data = ['discount_type' => $distype, 'discount_value' => $disval, 'min_ammount' => $dismina, 'from_date' => $disfrom, 'to_date' => $disto, 'discount_on' => $dison, 'status' => 'A', 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => date("Y-m-d h:i:s")];

			$this->db->insert('global_discounts',$data);
			$insert_id = $this->db->insert_id();
		}

		if($dison == 'MATERIAL'){
			$this->db->where('discount_on !=','MATERIAL');
			$fetch_data = $this->db->get();

			if($fetch_data->num_rows() > 0 ){
				$gettype = $fetch_data->result_array();
				
				foreach($gettype as $row){
					$this->db->where(['id' => $row['id']]);
					$this->db->update('global_discounts', ['status' => 'I', 'updated_at' => date("Y-m-d h:i:s")]);
				}
			}

			$existing_active_mat_ids = array();
			$this->db->select('id');
			$this->db->from('global_discounts');
			$this->db->where('status','A');
			$this->db->where('discount_on','MATERIAL');
			$fetch_data = $this->db->get();

			if($fetch_data->num_rows() > 0 ){
				$gettype = $fetch_data->result_array();
				
				foreach($gettype as $row){
					$existing_active_mat_ids[] = $row['id'];
				}
			}
			$dis_mat_ids = array();

			$this->db->select('material_no');
			$this->db->from('global_discount_materials');
			$this->db->where_in('discount_id',$existing_active_mat_ids);
			$fetch_data = $this->db->get();
			$existing_mat_ids = $fetch_data->result_array();
			foreach ($existing_mat_ids as $ss) {
				array_push($dis_mat_ids, $ss['material_no']);
			}
			$result = array_intersect($dis_mat_ids, $dismat);
			// echo "<pre>"; print_r($result); die();
			
			if(empty($result)){

				$data = ['discount_type' => $distype, 'discount_value' => $disval, 'min_ammount' => $dismina, 'from_date' => $disfrom, 'to_date' => $disto, 'discount_on' => $dison, 'status' => 'A', 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => date("Y-m-d h:i:s")];

				$this->db->insert('global_discounts',$data);
				$insert_id = $this->db->insert_id();
				
				$newArray=array();
				if($dison=='MATERIAL'){
					foreach($dismat as $mat){
						$matdata['discount_id'] = $insert_id;
						$matdata['material_no'] = $mat;
						$matdata['created_at'] 	= date("Y-m-d h:i:s");
						$matdata['updated_at'] 	= date("Y-m-d h:i:s");

						$newArray[] = $matdata;
					}
					$this->db->insert_batch('global_discount_materials', $newArray);
				}
				return $result;
			} 
			else{
				return $result;
			}
		}
		return true;
	} */

	public function delete_discount($id, $distype, $disval, $dismina, $disfrom, $disto, $dison, $disstatus){
		$this->db->where(['id' => $id, 'discount_type' => $distype, 'discount_value' => $disval, 'min_ammount' => $dismina, 'discount_on' => $dison]);
		$this->db->update('global_discounts', ['status'=>'D']);
		
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

?>
