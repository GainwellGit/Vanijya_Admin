<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class History_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		 
	}


	public function getDataByCatId($data,$to_date='',$from_date='')
	{
        if($data =='1'){
            
            $this->db->distinct();
            $this->db->select('discount_detail.discount_on as code , customer_address.name1 as name');

            // $this->db->select('DISTINCT customer_code as code ,name1 as name');
            $this->db->from('discount_detail');
            $this->db->join('customer_address', 'customer_address.customer_code = discount_detail.discount_on', 'left');
            $this->db->where("discount_detail.discount_category", $data);
            $this->db->where("discount_detail.from_date <=", $to_date);
            $this->db->where("discount_detail.to_date >=", $from_date);
            $fetch_data = $this->db->get();
            $response = $fetch_data->result_array();
            return $response;

        }else if($data =='2'){
            $this->db->distinct();
            $this->db->select('discount_detail.discount_on as code,region_master.region_description as name');
            $this->db->from('discount_detail');
            $this->db->join('region_master', 'region_master.region_code = discount_detail.discount_on', 'left');
            $this->db->where("discount_detail.discount_category", $data);
            $this->db->where("discount_detail.from_date <=", $to_date);
            $this->db->where("discount_detail.to_date >=", $from_date);

            $fetch_data = $this->db->get();
            $response = $fetch_data->result_array();
            return $response;

        }else if($data =='3'){
            $this->db->distinct();
            $this->db->select('discount_detail.discount_on as code,material_group.group_description as name');
            $this->db->from('discount_detail');
            $this->db->join('material_group', 'material_group.group_code = discount_detail.discount_on', 'left');
            $this->db->where("discount_detail.discount_category", $data);
            $this->db->where("discount_detail.from_date <=", $to_date);
            $this->db->where("discount_detail.to_date >=", $from_date);
            $fetch_data = $this->db->get();
            $response = $fetch_data->result_array();
            return $response;

        }else{

            return array();
       
        }

    }



    public function getSearchResult($category,$code,$from_date,$to_date)
    {
        if($category == 1){

            $this->db->distinct();
            $this->db->select('customer_address.customer_code as uid ,customer_address.customer_code as code,customer_address.name1 as name,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.created_date,discount_detail.promocode,discount_detail.source_ip,discount_type.type');
            $this->db->from('customer_address');
            $this->db->join('discount_detail', 'discount_detail.discount_on = customer_address.customer_code', 'right');
            $this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
            $this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
            $this->db->where("customer_address.customer_code", $code);
            $this->db->where("discount_detail.discount_category", $category);
            $this->db->where("discount_detail.from_date <=", $to_date);
            $this->db->where("discount_detail.to_date >=", $from_date);
            $this->db->where("discount_detail.is_delete !=", '1');

            $fetch_data = $this->db->get();

        }else if($category == 2){

            $this->db->distinct();
            $this->db->select('region_master.region_code as uid ,region_master.region_code as code,region_master.region_description as name,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.created_date,discount_detail.promocode,discount_detail.source_ip,discount_type.type');
            $this->db->from('region_master');
            $this->db->join('discount_detail', 'discount_detail.discount_on = region_master.region_code');
            $this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id');
            $this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id');

            if($code !='all'){
                $this->db->where("region_master.region_code", $code);
            }
            $this->db->where("discount_detail.discount_category", $category);
            if($code =='all'){
                $this->db->order_by('discount_detail.discount_on');
            }
            $this->db->where("discount_detail.from_date <=", $to_date);
            $this->db->where("discount_detail.to_date >=", $from_date);
            $this->db->where("discount_detail.is_delete !=", '1');

            $fetch_data = $this->db->get();

        }else if($category == 3){
             
            $this->db->distinct();
            $this->db->select('material_group.group_code as uid,material_group.group_code as code,material_group.group_description as name,discount_detail.discount_value,discount_detail.min_ammount,discount_detail.from_date,discount_detail.to_date,discount_detail.created_date,discount_detail.promocode,discount_detail.source_ip,discount_type.type');
            $this->db->from('material_group');
            $this->db->join('discount_detail', 'discount_detail.discount_on = material_group.group_code', 'left');
            $this->db->join('discount_category', 'discount_detail.discount_category = discount_category.id', 'left');
            $this->db->join('discount_type', 'discount_detail.discount_type = discount_type.id', 'left');
            
            if($code !='all'){
                $this->db->where("material_group.group_code", $code);
            }
            $this->db->where("discount_detail.discount_category", $category);
            if($code =='all'){
                $this->db->order_by('discount_detail.discount_on');
            }
            $this->db->where("discount_detail.from_date <=", $to_date);
            $this->db->where("discount_detail.to_date >=", $from_date);
            $this->db->where("discount_detail.is_delete !=", '1');

            $fetch_data = $this->db->get();

        }    
        
		if(isset($fetch_data) && $fetch_data->num_rows() > 0 ){
			$getcoupon = $fetch_data->result_array();	
		}
		else{
			$getcoupon = array();
		}

		return $getcoupon;

    }



    public function getOrderSearch($orderNo,$orderNumber,$customer,$plant,$status,$reference,$part,$from_date,$to_date){

        $from_date  = date("Y-m-d H:i:s", strtotime($from_date));
        $to_date    = date("Y-m-d H:i:s", strtotime($to_date));

        $query =  $this->db->select('order_master.order_number,order_master.order_status,order_master.datetime, order_master.customer_number,order_master.payment_status,order_master.sap_order_no,order_master.plant_code,order_master.total_payment,customer_address.name1,plant_master.plant_name,order_line.quantity,order_line.unit_price,order_line.total_price, order_line.tax_rate,order_line.pmkit_number, order_line.pmkit_desc, order_promotion.discount_value , discount_category.description, order_promotion.discount_category , order_promotion.discount_type');
          $this->db->from('order_master');
          $this->db->join('customer_address', 'customer_address.customer_code  = order_master.customer_number', 'left');
          $this->db->join('plant_master', 'plant_master.plant_code  = order_master.plant_code', 'left');
          $this->db->join('order_line', 'order_line.order_number  = order_master.order_number', 'left');
          $this->db->join('order_promotion', 'order_promotion.order_number  = order_master.order_number', 'left');
          $this->db->join('discount_category', 'discount_category.id = order_promotion.discount_category', 'left');

          if($orderNo !='')
          $this->db->where("order_master.sap_order_no", $orderNo);

          if($orderNumber !='')
          $this->db->where("order_master.order_number", $orderNumber);

          if($customer !='')
          $this->db->where("order_master.customer_number", $customer); 

          if($plant !='')
          $this->db->where("order_master.plant_code", $plant); 

          if($status !='')
          $this->db->where("order_master.order_status", $status); 

          if($part !='')
          $this->db->where("order_line.pmkit_number", $part); 

          if($from_date !='')
          $this->db->where("DATE(order_master.datetime) >=", $from_date);
          
          if($to_date !='')
          $this->db->where("DATE(order_master.datetime) <=", $to_date);

          $this->db->group_by('order_master.order_number'); 
          $this->db->order_by('order_promotion.id');

          $fetch_data = $this->db->get();

          //print_r($this->db->last_query());
          if(isset($fetch_data) && $fetch_data->num_rows() > 0 ){
          $getcoupon = $fetch_data->result_array();   
          }else{
              $getcoupon = array();
          }
          //print_r($getcoupon);
          return $getcoupon;
  }
	
	public function getPaymentSearch($orderNo,$customer,$plant,$status,$reference,$part,$from_date,$to_date){

            $this->db->select('order_master.order_number,order_master.order_status,order_master.datetime, order_master.customer_number,order_master.payment_status,order_master.sap_order_no,order_master.plant_code,order_master.total_payment,customer_address.name1,plant_master.plant_name,order_line.quantity,order_line.unit_price,order_line.total_price, order_line.tax_rate,order_line.pmkit_number, order_line.pmkit_desc,');
            $this->db->from('order_master');
            $this->db->join('customer_address', 'customer_address.customer_code  = order_master.customer_number', 'left');
            $this->db->join('plant_master', 'plant_master.plant_code  = order_master.plant_code', 'left');
            $this->db->join('order_line', 'order_line.order_number  = order_master.order_number', 'left');

            if($orderNo !='')
            $this->db->where("order_master.sap_order_no", $orderNo);

            if($customer !='')
            $this->db->where("order_master.customer_number", $customer); 

            if($plant !='')
            $this->db->where("order_master.plant_code", $plant); 

            if($status !='')
            $this->db->where("order_master.order_status", $status); 

            if($part !='')
            $this->db->where("order_line.pmkit_number", $part); 
		
			if($reference !='')
            $this->db->where("order_master.payment_status", $reference); 

            $this->db->where("DATE(order_master.datetime) >=", $from_date);
            $this->db->where("DATE(order_master.datetime) <=", $to_date);

            $fetch_data = $this->db->get();

            if(isset($fetch_data) && $fetch_data->num_rows() > 0 ){
            $getcoupon = $fetch_data->result_array();   
            }
            else{
                $getcoupon = array();
            }

            return $getcoupon;
	}
	
	public function reconciliationPaymentSearch(){

            $this->db->select('order_master.order_number,order_master.order_status,order_master.datetime, order_master.customer_number,order_master.payment_status,order_master.sap_order_no,order_master.plant_code,order_master.total_payment,customer_address.name1,plant_master.plant_name,order_line.quantity,order_line.unit_price,order_line.total_price, order_line.tax_rate,order_line.pmkit_number, order_line.pmkit_desc,');
            $this->db->from('order_master');
            $this->db->join('customer_address', 'customer_address.customer_code  = order_master.customer_number', 'left');
            $this->db->join('plant_master', 'plant_master.plant_code  = order_master.plant_code', 'left');
            $this->db->join('order_line', 'order_line.order_number  = order_master.order_number', 'left');           

            $this->db->group_by('order_master.order_number'); 
            $this->db->where("order_master.payment_status", "N");
            //$this->db->limit(50, 0);

            $fetch_data = $this->db->get();

            if(isset($fetch_data) && $fetch_data->num_rows() > 0 ){
            $getcoupon = $fetch_data->result_array();   
            }
            else{
                $getcoupon = array();
            }

            return $getcoupon;
	}
	
	 public function updatePaymentStatusOrderno($status,$order_id,$sap_order_id=null)
		{
			$data = [
			//	'payment_status' => $status,
			//	'sap_order_no' => $sap_order_id,
                'order_status' => 'Order Placed',
			];
			$this->db->where('order_number', $order_id);
			return $this->db->update('order_master', $data);	
		}

    public function addSapOrderVerify($order_id){

            $data = [
                 'order_number' => $order_id
            ];
                     $this->db->insert('sap_order_verify', $data);
                     if ($this->db->insert_id()) {
                          return   array('ticket_id' => $this->db->insert_id(),'order_number'=> $order_id );
                     }
                    return false;
    }
}

?>
