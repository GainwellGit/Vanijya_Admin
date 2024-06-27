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

	public function get_dison_selectlist($disid, $dison){
		if($dison=='MATERIAL-GROUP'){
			$this->db->select('*');
			$this->db->from('promo_codes_material_group');
			$this->db->join('material_master', 'promo_codes_material_group.material_no = material_master.material_no');
		}
		if($dison=='CUSTOMER'){
			$this->db->select('*');
			$this->db->from('promo_codes_customer');
			$this->db->join('customer_address', 'promo_codes_customer.customer_code = customer_address.customer_code');
		}
		if($dison=='REGION'){
			$this->db->select('*');
			$this->db->from('promo_codes_region');
			$this->db->join('region_master', 'promo_codes_region.region = region_master.region_code');
		}
		if($dison=='ZONE'){
			$this->db->select('*');
			$this->db->from('promo_codes_zone');
		}
		$this->db->where('discount_id',$disid);
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

    public function save_promocode($id,$promocode,$desc,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismat,$discust,$disreg,$diszone,$disstatus){
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
