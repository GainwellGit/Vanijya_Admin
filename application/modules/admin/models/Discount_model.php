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
			$gettype = $fetch_data->result_array();	
		}
		else{
			$gettype = array();
		}
		return $gettype;
    }

	public function get_material($disid){
		$this->db->select('*');
		$this->db->from('global_discount_materials');
		$this->db->where('discount_id',$disid);
		$this->db->join('material_master', 'global_discount_materials.material_no = material_master.material_no');
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}

    public function save_discount($id,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismat,$disstatus){
		
		$this->db->select('*');
		$this->db->from('global_discounts');
		$this->db->where('id',$id);    
		$fetch_data = $this->db->get();

		if($disstatus=='A'){
			$Where = array('status' => 'A', 'id !=' => $id);
			$this->db->where($Where);
			$this->db->update('global_discounts', ['status' => 'I', 'updated_at' => date("Y-m-d h:i:s")]);
		}

		if($fetch_data->num_rows() > 0 ){
			$data = ['to_date' => $disto, 'status' => $disstatus, 'updated_at' => date("Y-m-d h:i:s")];

			$Where = array('id' => $id );
			$this->db->where($Where);
			$this->db->update('global_discounts', $data);
		}else{
			$data = ['discount_type' => $distype, 'discount_value' => $disval, 'min_ammount' => $dismina, 'from_date' => $disfrom, 'to_date' => $disto, 'discount_on' => $dison, 'status' => $disstatus, 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => date("Y-m-d h:i:s")];

			$this->db->insert('global_discounts',$data);
			$insert_id = $this->db->insert_id();
			
			$newArray=array();
			if($dison=='MATERIAL'){
				foreach($dismat as $mat){
					$matdata['discount_id'] = $insert_id;
					$matdata['material_no'] = $mat;
					$matdata['created_at'] = date("Y-m-d h:i:s");
					$matdata['updated_at'] = date("Y-m-d h:i:s");
					$newArray[] = $matdata;
				}
				
				$this->db->insert_batch('global_discount_materials', $newArray);
			}
		}
		return true;
	}

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
