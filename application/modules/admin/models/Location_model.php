<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Location_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		$this->usersessiondata = $this->session->userdata('logged_in');
	}


	public function getAllLocation()
	{
		$this->db->select('region_code,region_description');
		$this->db->from('region_master');
		$this->db->order_by("region_description", "desc");
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}

	public function getAllPlants()
	{
		$this->db->select('*');
		$this->db->from('plant_master');
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}


	public function getAllLocationWithOutZone()
	{
		$this->db->select('region_code,region_description');
		$this->db->from('region_master');
		$this->db->where('Zone !=','');
		$this->db->order_by("region_description", "desc");
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}

	public function getExceptionData(){

		$this->db->select('*');
		$this->db->from('exception_list');
		$this->db->where("type", 'region');
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

	public function get_location_row($location_code,$row)
	{
		$this->db->select('region_code');
		$this->db->from('region_master');
		$this->db->where("region_code", $location_code);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{

				$data=array(

					'message'=>'Region Code  '. $location_code .'  Not in Region Table -- excel row--> '.$row,
					'date'=>date('Y-m-d'),
					'type'=>'region'
				);

				$this->db->insert('exception_list',$data);

				$getdata = '';
			}
		return $getdata;
	}

	public function getlocationById($locationId)
	{
		$this->db->select('id,region_description');
		$this->db->from('region_master');
		$this->db->where("id", $locationId);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}

	public function get_location_id($code)
	{
		$this->db->select('id');
		$this->db->from('region_master');
		$this->db->where("region_code", $code);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{
				$getdata = '';
			}
		return $getdata;
	}

	public function update_coupon($data,$location_id)
	{
		$this->db->select('*');
		$this->db->from('discount_detail');
		$this->db->where("discount_on", $location_id); 
		$this->db->where("discount_category", 2); 
		$fetch_data = $this->db->get();

		if($fetch_data->num_rows() > 0 ){

			$this->db->where('discount_on', $location_id);
			$this->db->where("discount_category", 2); 
		    $this->db->update('discount_detail',$data);	
		}
		else{

			$this->db->insert('discount_detail',$data);
		}

		return TRUE ;
		
	}

	public function insert_zone_coupon($data,$zone_id)
	{
		echo "<pre>"; print_r($data); die();
		    $this->db->where('id', $zone_id);
		    $this->db->update('zone_coupon',$data);	
            return TRUE ;
	}

	public function get_ll($code){

		$this->db->select('*');
		$this->db->from('discount_detail');
		$this->db->where("discount_detail.discount_on", $code);
		$this->db->where("discount_detail.discount_category", '2'); 
		$this->db->order_by("discount_detail.id", "desc");
		$this->db->limit(1);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->row();	
		}
		else{
			$getcoupon = array();
		}
		return $getcoupon;

	}

	public function get_location_by_zone($zone,$to_date)
	{
		$this->db->select('*');
		$this->db->from('region_master');
		$this->db->where("zone", $zone); 
		$fetch_data = $this->db->get();

		if($fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->result_array();	
		}
		else{
			$getcoupon = array();
		}
		return $getcoupon;
	}

	public function insert_coupon($data,$location_id='')
	{
		$this->db->insert('discount_detail',$data);
		//return TRUE;
		return $this->db->insert_id();
	}

	public function select_zone_coupon($zone_id='')
	{
		$this->db->select('discount_detail_ids');
		$this->db->from('zone_coupon');
		$this->db->where("id", $zone_id); 
		$fetch_data = $this->db->get();
		
		return $fetch_data->row()->discount_detail_ids;
	}

	public function update_previous_discountdetail($ids='')
	{
		$data = [
            'is_delete' => 1,
        ];
		$this->db->where('id', $ids);
		$this->db->update('discount_detail',$data);	
		return TRUE ;
	}


	public function insert_coupon_excel($data,$location_id='',$valid_from='',$to_date='',$row)
	{
		$today = new DateTime();
        $compare = $today->format('Y-m-d');

      
        if($valid_from >= $compare && $to_date >= $compare){

        	$this->db->insert('discount_detail',$data);
		    return TRUE;
        }else{

        	$data=array(

				'message'=>'Region Code  '. $location_id .'  From date or To date Is Past date -- excel row--> '.$row,
				'date'=>date('Y-m-d'),
				'type'=>'region'
			);

			$this->db->insert('exception_list',$data);
			return TRUE;


        }

		
	}

	public function GetRegionById($id){

         $this->db->select('*');
		$this->db->from('region_master');
		$this->db->where("region_code", $id);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{
				$getdata = '';
			}
		return $getdata;
	}

	public function GetOrderingById($id){

         $this->db->select('*');
		$this->db->from('state_ordering_plant');
		$this->db->where("region_code_no", $id);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = '';
			}
		return $getdata;
	}

	// public function getusercoupon($user)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('user_coupon');
	// 	$this->db->where("user_id", $user); 
	// 	$fetch_data = $this->db->get();
	// 	if($fetch_data->num_rows() > 0 ){
	// 		$getcoupon = $fetch_data->row();	
	// 	}
	// 	else{
	// 		$getcoupon = array();
	// 	}
	// 	return $getcoupon;
	// }

	public function getlocationcoupon($location_id)
	{
		$this->db->select('region_master.region_code as uid ,region_master.region_code,region_master.region_description,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.promocode,discount_detail.is_delete,discount_type.type');
		$this->db->from('region_master');
		$this->db->join('discount_detail', 'discount_detail.discount_on = region_master.region_code', 'left');
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
        $this->db->where("region_master.region_code", $location_id);
		$this->db->where("discount_detail.discount_category", '2'); 
		$this->db->order_by("discount_detail.id", "desc");
		$this->db->limit(1); 
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->row();	
		}
		else{
			$getcoupon = array();
		}
		return $getcoupon;
	}

    public function getAllZone()
	{
		$today = new DateTime();
        $compare = $today->format('Y-m-d');
		$this->db->select('zone_coupon.*,discount_type.type');
		$this->db->from('zone_coupon');
		$this->db->join('discount_type', 'zone_coupon.discount_type = discount_type.id', 'left');
		$this->db->order_by("zone_coupon.id", "asc");
		$fetch_data = $this->db->get();
		
        if($fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->result_array();	
		}
		else{
			$getcoupon = array();
		}
		return $getcoupon;

	}

	public function getZonedata($zone)
	{
	  
		$this->db->select('*');
		$this->db->from('zone_coupon');
		$this->db->where("zone_name", $zone);
		$fetch_data = $this->db->get();
		
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{
				$getdata = '';
			}
		return $getdata;

	}


	public function get_discount_type()
	{
			$this->db->select('*');
			$this->db->from('discount_type');
			$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$gettype = $fetch_data->result_array();	
			}
			else{
				$gettype = array();
			}
			return $gettype;
	}



	public function getlocationcoupondetails($location_id)
	{

		$this->db->select('region_master.region_code as uid ,region_master.region_code,region_master.region_description,discount_detail.id as aid,discount_detail.discount_type,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.promocode,discount_detail.is_delete,discount_type.type');
		$this->db->from('region_master');
		$this->db->join('discount_detail', 'discount_detail.discount_on = region_master.region_code', 'left');
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
        $this->db->where("region_master.region_code", $location_id);
		$this->db->where("discount_detail.discount_category", '2');
		$this->db->order_by("discount_detail.id", "desc");
		$this->db->limit(1); 
		 
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->row(); 	
		}
		else{
			$this->db->select('region_code as uid,region_code,region_description');
            $this->db->from('region_master');
            $this->db->where("region_code", $location_id);
            $fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getcoupon = $fetch_data->row();	
			}
			else{
				$getcoupon = array();
			}
		}
		return $getcoupon;
	}
	public function addgroupdata($data)
	{
		$this->db->insert('ussd_group',$data);
		if($this->db->affected_rows()>0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


	public function insert_ordering_data($data)
	{
		$this->db->select('id');
		$this->db->from('state_ordering_plant');
		$this->db->where("plant_code", $data['plant_code']);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
             return false;
		}else{

			$this->db->insert('state_ordering_plant',$data);
			if($this->db->affected_rows()>0)
			{
				return $this->db->insert_id();
			}else{
				return false;
			}
		}

	}

    public function delete_plant_delivery_data($id)
	{
		$this->db->delete('state_ordering_plant', array('id' => $id)); 

		$this->db->delete('state_delivery_centre', array('plant_id' => $id)); 
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getplantbyId($id){


		$this->db->select('*');
		$this->db->from('plant_master');
		$this->db->where("region_code", $id);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$gettype = $fetch_data->result_array();	
		}
		else{
			$gettype = array();
		}
		return $gettype;
	}

	public function getAssignPlant($id){


		$this->db->select('plant_code');
		$this->db->from('state_ordering_plant');
		$this->db->where("region_code_no", $id);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$gettype = $fetch_data->result_array();	
		}
		else{
			$gettype = array();
		}
		return $gettype;
	}





	public function getPlantNameByCode($code){

        $this->db->select('*');
		$this->db->from('plant_master');
		$this->db->where("plant_code", $code);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$gettype = $fetch_data->row();	
		}
		else{
			$gettype = '';
		}
		return $gettype;

	}



	public function delete_delivery_data($id)
	{
		$this->db->delete('state_delivery_centre', array('delivery_id' => $id)); 
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function insert_delivery_data($data,$id='')
	{
        if($id !=''){

        	$this->db->where('delivery_id', $id);
			$this->db->update('state_delivery_centre',$data);
			
			if($this->db->affected_rows() >= 0){
				return TRUE;
			}else{
				return FALSE;
			}

        }else{



        	$this->db->insert('state_delivery_centre',$data);
			if($this->db->affected_rows()>0)
			{
				return $this->db->insert_id();
			}else{
				return false;
			}
        }
		
	}

	public function update_plant_data($name,$id){

		    $param['ordering_plant_name'] = $name;

		    $this->db->where('id', $id);
			$this->db->update('state_ordering_plant',$param);
			
			if($this->db->affected_rows() >= 0){
				return TRUE;
			}else{
				return FALSE;
			}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}


	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function groupstatus($data=array())
	{
		if($data['status_chk'] == 1){
			$param['is_active'] = 0;
		}else if($data['status_chk'] == 0){
			$param['is_active'] = 1;
		}
		
		
		$this->db->where('id', $data['groupid']);
		$this->db->update('ussd_group',$param);
		
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

    public function groupdelete($groupid)
    {
		$this->db->delete('ussd_group', array('id' => $groupid)); 
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_coupon($id=''){

		$this->db->where('id',$id);
		$this->db->update('discount_detail', array('is_delete' => '1'));
        return true;
	}

	public function delete_zone_coupon($id='',$promocode=''){

		$this->db->where('id',$id);
		$this->db->update('zone_coupon', array('is_delete' => '1'));

		
		$this->db->where('promocode',$promocode);
		$this->db->update('discount_detail', array('is_delete' => '1'));
        return true;
	}

	

	public function edit_groupModel($data)
	{
		$this->db->select('*');
		$this->db->from('ussd_group');
		$this->db->where('ussd_group.id',$data);
		$query=$this->db->get();
				if($query->num_rows() >0)
		{
			return $query->result();
		}
		else{
			return false; 
		}
	}
	 public function updategroupdata($data,$bid)
	{
		 $this->db->where('id',$bid);
		 return $this->db->update('ussd_group',$data);
	}

	public function save_region_surcharge($plant_surcharge,$plant_code,$plant_name,$city_name,$po_code,$region_code)
	{
		$data = ['plant_code' => $plant_code, 'plant_name' => $plant_name, 'city_name' => $city_name, 'po_code' => $po_code, 'surcharge' => $plant_surcharge, 'region_code' => $region_code];
		$this->db->select('surcharge');
		$this->db->from('plant_surcharge');
		$this->db->where('plant_code',$plant_code);
		$this->db->where('region_code',$region_code);
		$fetch_data = $this->db->get();
		$queryData  = $fetch_data->row_array();
		$old_surcharge = ($queryData['surcharge'] != '') ? $queryData['surcharge']:'';

		$user_email = $this->usersessiondata['user_name'];
		$this->db->select('name');
		$this->db->from('admin_login');
		$this->db->where('user_name',$user_email);    
		$value = $this->db->get()->row();
		$updated_by =  ($value->name == '') ? '' : $value->name;
		if($fetch_data->num_rows() > 0 ){
			$multipleWhere = array('plant_code' => $plant_code, 'region_code' => $region_code );
			$this->db->where($multipleWhere);
			$this->db->update('plant_surcharge', $data);
		}else{
			$this->db->insert('plant_surcharge',$data);
		}
		$audit_data = ['plant_code' => $plant_code, 'region_code' => $region_code, 'new_surcharge' => $plant_surcharge, 'changed_on' => date('Y-m-d H:i:s'), 'old_surcharge' => $old_surcharge, 'changed_by' => $updated_by];
		$this->db->insert('plant_surcharge_audit',$audit_data);
		return true;
	}

	public function delete_region_surcharge($plant_code,$region_code)
	{
		$user_email = $this->usersessiondata['user_name'];
		$this->db->select('name');
		$this->db->from('admin_login');
		$this->db->where('user_name',$user_email);    
		$value = $this->db->get()->row();
		$updated_by =  ($value->name == '') ? '' : $value->name;

		$this->db->select('surcharge');
		$this->db->from('plant_surcharge');
		$this->db->where('plant_code',$plant_code);
		$this->db->where('region_code',$region_code);
		$fetch_data = $this->db->get();
		$queryData  = $fetch_data->row_array();
		$old_surcharge = ($queryData['surcharge'] != '') ? $queryData['surcharge']:'';
		
		$audit_data = ['plant_code' => $plant_code, 'region_code' => $region_code, 'new_surcharge' => '', 'changed_on' => date('Y-m-d H:i:s'), 'old_surcharge' => $old_surcharge, 'changed_by' => $updated_by];
		$this->db->insert('plant_surcharge_audit',$audit_data);

		$this->db->delete('plant_surcharge', array('plant_code' => $plant_code, 'region_code' => $region_code));
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

?>
