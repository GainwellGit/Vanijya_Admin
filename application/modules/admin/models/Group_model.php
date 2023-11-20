<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Group_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		$this->table = 'ussd_group';
		$this->column_order = array(null,'group_code','group_name','is_active','date_created','id'); //set column field database for datatable orderable
		$this->column_search = array('group_code','group_name','date_created'); //set column field database for datatable searchable 
		$this->order = array('id' => 'desc'); // default order 
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

	public function get_group_row($group_code,$row)
	{
		$this->db->select('group_code');
		$this->db->from('material_group');
		$this->db->where("group_code", $group_code);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{

				$data=array(

					'message'=>'Group Code  '. $group_code .'  Not in Material Group Table -- excel row--> '.$row,
					'date'=>date('Y-m-d'),
					'type'=>'group'
				);

				$this->db->insert('exception_list',$data);

				$getdata = '';
			}
		return $getdata;
	}

	public function bulk_upload($data,$code)
	{

		$this->db->select('*');
		$this->db->from('ussd_group');
		$this->db->where("group_code", $code); 
		$fetch_data = $this->db->get();

        if($fetch_data->num_rows() > 0 ){

			$this->db->where('group_code', $code);
			$this->db->update('ussd_group',$data);
			return true;		
		}
		else{

			 $this->db->insert('ussd_group',$data);
			 return true;
		}

	}

	public function get_group_id($code)
	{
		$this->db->select('id');
		$this->db->from('material_group');
		$this->db->where("group_code", $code);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{
				$getdata = '';
			}
		return $getdata;
	}

	public function getgroupcoupon($groupid) 
	{
		
		$this->db->select('material_group.group_code as uid,material_group.group_description,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.promocode,discount_detail.is_delete,discount_type.type,discount_detail.title');
		$this->db->from('material_group');
		$this->db->join('discount_detail', 'discount_detail.discount_on = material_group.group_code', 'left');
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
		$this->db->where("material_group.group_code", $groupid);
		$this->db->where("discount_detail.discount_category", '3');
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

	public function getAllGroup()
	{
		$this->db->select('*');
		$this->db->from('material_group');
		$this->db->order_by("group_description", "desc");
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getdata = $fetch_data->result_array();	
		}
		else{
			$getdata = array();
		}
		return $getdata;
	}

	public function delete_coupon($id=''){

		$this->db->where('id',$id);
		$this->db->update('discount_detail', array('is_delete' => '1'));
        return true;
	}

	public function getgroupcoupondetails($group_id)
	{
      
		$this->db->select('material_group.group_code as uid ,material_group.group_code,material_group.group_description,discount_detail.id as aid,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.discount_type,discount_detail.to_date,discount_detail.promocode,discount_detail.is_delete,discount_type.type,discount_detail.title');
		$this->db->from('material_group');
		$this->db->join('discount_detail', 'discount_detail.discount_on = material_group.group_code', 'left');
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left'); 
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
		$this->db->where("material_group.group_code", $group_id);
		$this->db->where("discount_detail.discount_category", '3');
		$this->db->order_by("discount_detail.id", "desc");
		$this->db->limit(1);

		$fetch_data = $this->db->get();

		if($fetch_data->num_rows() > 0 ){
		
			$getcoupon = $fetch_data->row();	
		}
		else{
			
			$this->db->select('group_code as uid,group_description,group_code'); 
            $this->db->from('material_group');
            $this->db->where("group_code", $group_id);
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

	public function update_coupon($data,$g_id)
	{
		$this->db->select('*');
		$this->db->from('discount_detail');
		$this->db->where("discount_on", $g_id); 
		$this->db->where("discount_category", 3); 
		$fetch_data = $this->db->get();

		if($fetch_data->num_rows() > 0 ){

			$this->db->where('discount_on', $g_id);
			$this->db->where("discount_category", 3); 
		    $this->db->update('discount_detail',$data);		
		}
		else{

			$this->db->insert('discount_detail',$data);
		}

		return TRUE ;
		
	}
	public function getExceptionData(){

		$this->db->select('*');
		$this->db->from('exception_list');
		$this->db->where("type", 'group');
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
	public function insert_coupon($data,$g_id='')
	{
		$this->db->insert('discount_detail',$data);
		return TRUE;
	}

	public function insert_coupon_excel($data,$group_id='',$valid_from='',$to_date='',$row)
	{
		$today = new DateTime();
        $compare = $today->format('Y-m-d');

      
        if($valid_from >= $compare && $to_date >= $compare){

        	$this->db->insert('discount_detail',$data);
		    return TRUE;
        }else{

        	$data=array(

				'message'=>'Group Code  '. $group_id .'  From date or To date Is Past date -- excel row--> '.$row,
				'date'=>date('Y-m-d'),
				'type'=>'group'
			);

			$this->db->insert('exception_list',$data);
			return TRUE;


        }

		
	}

	public function getgroupById($groupId)
	{
		$this->db->select('id,group_name');
		$this->db->from('ussd_group');
		$this->db->where("id", $groupId);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
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

	public function groupstatus($data=array()){
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

       public function groupdelete($groupid){
		$this->db->delete('ussd_group', array('id' => $groupid)); 
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
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
	

}

?>
