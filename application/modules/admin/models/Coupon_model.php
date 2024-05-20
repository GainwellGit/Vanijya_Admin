<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Coupon_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		$this->table = 'customer_address';
		$this->column_order = array(null,'customer_code','country_code','name1','pincode','id'); //set column field database for datatable orderable
		$this->column_search = array('customer_code','country_code','name1'); //set column field database for datatable searchable 
		//$this->order = array('id' => 'desc'); // default order 
	}


	public function getAllUser()
	{
		$this->db->select('id,customer_code,name1'); 
		$this->db->from('customer_address');
		$this->db->order_by("id", "desc");
		$this->db->limit(100);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->result_array();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}

	public function getuserById($userId)
	{
		$this->db->select('id,name1');
		$this->db->from('customer_address');
		$this->db->where("id", $userId);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{
				$getdata = array();
			}
		return $getdata;
	}


	public function get_customer_id($code,$row)
	{
		$this->db->select('id,customer_code,name1');
		$this->db->from('customer_address');
		$this->db->where("customer_code", $code);
		$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$getdata = $fetch_data->row();	
			}
			else{

				$data=array(

					'message'=>'Customer Code  '. $code .'  Not in Customer Table -- excel row--> '.$row,
					'date'=>date('Y-m-d'),
					'type'=>'customer'
				);

				$this->db->insert('exception_list',$data);

				$getdata = '';
			}
		return $getdata;
	}

	public function getExceptionData(){

		$this->db->select('*');
		$this->db->from('exception_list');
		$this->db->where("type", 'customer');
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

	public function update_coupon($data,$user_id)
	{
		$this->db->select('*');
		$this->db->from('discount_detail');
		$this->db->where("discount_on", $user_id); 
		$this->db->where("discount_category", 1); 
		$fetch_data = $this->db->get();

		if($fetch_data->num_rows() > 0 ){

			$this->db->where('discount_on', $user_id);
			$this->db->where("discount_category", 1); 
		    $this->db->update('discount_detail',$data);	
		}
		else{

			$this->db->insert('discount_detail',$data);
		}

		return TRUE ;
		
	}
	
	public function insert_coupon($data,$user_id)
	{
		$this->db->insert('discount_detail',$data);
		return TRUE;
	}

	public function insert_coupon_excel($data,$user_id,$valid_from='',$to_date='',$row)
	{
		$today = new DateTime();
        $compare = $today->format('Y-m-d');
        if($valid_from >= $compare && $to_date >= $compare){

        	$this->db->insert('discount_detail',$data);
		    return TRUE;
        }else{

        	$data=array(

				'message'=>'Customer Code  '. $user_id .'  From date or To date Is Past date-- excel row--> '.$row,
				'date'=>date('Y-m-d'),
				'type'=>'customer'
			);

			$this->db->insert('exception_list',$data);
			return TRUE;


        }

		
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

	public function getAllUserData(){

		$this->db->select('customer_address.customer_code as uid ,customer_address.customer_code,customer_address.name1,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.promocode,discount_type.type');
		$this->db->from('customer_address');
		$this->db->join('discount_detail', 'discount_detail.discount_on = customer_address.customer_code', 'left');
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
		//$this->db->where("customer_address.customer_code", $user);
		//$this->db->where('customer_address.customer_code  IN (SELECT customer_code FROM customer_address)');
		$this->db->where("discount_detail.discount_category", '1');
		$this->db->order_by("discount_detail.id", "desc");
		$this->db->group_by('discount_detail.discount_on');
		$this->db->limit(1);  
		$fetch_data = $this->db->get();

	echo $this->db->last_query();
	die;
		if($fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->row();	
		}
		else{
			$getcoupon = array();
		}

		return $getcoupon;


	}

	public function getusercoupon($user)
	{

		$this->db->select('customer_address.customer_code as uid ,customer_address.customer_code,customer_address.name1,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.promocode,discount_type.type');
		$this->db->from('customer_address');
		$this->db->join('discount_detail', 'discount_detail.discount_on = customer_address.customer_code', 'right');
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
		$this->db->where("customer_address.customer_code", $user);
		$this->db->where("discount_detail.discount_category", '1');
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

	public function delete_coupon($id=''){

		$this->db->where('id',$id);
		$this->db->update('discount_detail', array('is_delete' => '1'));
        return true;
	}



	public function getusercoupondetails($user) 
	{
		$this->db->select('customer_address.customer_code as uid ,customer_address.customer_code,customer_address.name1,discount_detail.id as aid,discount_detail.discount_value, discount_detail.min_ammount, discount_detail.discount_type,discount_detail.from_date,discount_detail.discount_type, discount_detail.to_date,discount_detail.promocode,discount_detail.is_delete,discount_type.type');
		$this->db->from('customer_address');
		$this->db->join('discount_detail', 'discount_detail.discount_on = customer_address.customer_code', 'left');
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
		$this->db->where("customer_address.customer_code", $user);
		$this->db->where("discount_detail.discount_category", '1');
		$this->db->order_by("discount_detail.id", "desc");
		$this->db->limit(1);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->row(); 	
		}
		else{
			$this->db->select('customer_code as uid,customer_code,name1');
            $this->db->from('customer_address');
            $this->db->where("customer_code", $user);
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

	function get_datatables()
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    
    private function _get_datatables_query($term='')
	{
		$column = array('customer_address.customer_code','customer_address.name1', 'customer_address.customer_code');
		$this->db->distinct();
	    $this->db->select('customer_address.customer_code as uid ,customer_address.customer_code,customer_address.name1,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.promocode,discount_detail.is_delete,discount_type.type');
		$this->db->from('customer_address');

		$this->db->join('(SELECT*
              FROM `discount_detail` 
              WHERE id IN (
                    SELECT MAX(id)
                    FROM discount_detail
                    GROUP BY discount_on
                )
              GROUP BY  `discount_on`) as `discount_detail`','`discount_detail`.`discount_on` = `customer_address`.`customer_code`', 'LEFT',NULL);
		$this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
		$this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
		$this->db->like('customer_address.customer_code', $term);
    	$this->db->or_like('customer_address.name1', $term);
    	$this->db->or_like('discount_detail.promocode', $term); 

		//$this->db->where("customer_address.customer_code", $user);
		//$this->db->where('customer_address.customer_code  IN (SELECT customer_code FROM customer_address)');
		//$this->db->where("discount_detail.discount_category", '1');
		$this->db->order_by("discount_detail.id", "desc");
		//$this->db->group_by('discount_detail.discount_on');

   //       $this->db->query('SELECT DISTINCT `customer_address`.`customer_code` as `uid`, `customer_address`.`customer_code`, `customer_address`.`name1`, `discount_detail`.`discount_value`, `discount_detail`.`min_ammount`, `discount_detail`.`from_date`, `discount_detail`.`to_date`, `discount_detail`.`promocode`, `discount_type`.`type`
			// FROM `customer_address`
			// LEFT JOIN (
			//               SELECT*
			//               FROM `discount_detail` 
			//               WHERE id IN (
			//                     SELECT MAX(id)
			//                     FROM discount_detail
			//                     GROUP BY discount_on
			//                 )
			//               GROUP BY  `discount_on`
			//           )  `discount_detail` ON (`discount_detail`.`discount_on` = `customer_address`.`customer_code`)

			// LEFT JOIN `discount_category` ON `discount_detail`.`discount_category` = `discount_category`.`id`
			// LEFT JOIN `discount_type` ON `discount_detail`.`discount_type` = `discount_type`.`id`
			// WHERE `customer_address`.`customer_code` LIKE "%'.$term.'%"
			// OR  `customer_address`.`name1` LIKE "%'.$term.'%"
			// OR  `discount_detail`.`promocode` LIKE "%'.$term.'%"
			// ORDER BY `discount_detail`.`id` DESC');

	    if(isset($_REQUEST['order'])) // here order processing
	    {
	       $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
	    } 
	    else if(isset($this->order))
	    {
	       $order = $this->order;
	       $this->db->order_by(key($order), $order[key($order)]);
	    }

	}


	private function _get_datatables_query11()
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
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		//$this->db->from($this->table);
        $this->db->distinct();
        $this->db->select('customer_code'); 
		$this->db->from('customer_address');
		$fetch_data = $this->db->get();

        return $fetch_data->num_rows() ;
		//return $this->db->count_all_results();
	}
	

}

?>
