<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Authentication_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	

	public function getUserdata($data){	
	   
	    $username=$data['user_name'];
		$password=$data['password'];
	
		$this->db->select('*');
		$this->db->from('admin_login');
		$this->db->where('user_name',$username);
		$this->db->where('password',$password);    
		$value = $this->db->get();
		if($value->num_rows() > 0 ){
			$getvalue = $value->row_array();
			
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetLoginDetailsV2' WHERE serviceName = 'com.gcpl.service.GetLoginDetailsV2';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetLoginDetailsV2' WHERE serviceName = 'com.gcpl.service.Impl.LoginDetailsV2ServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKartNodeJSService:getNearestPlant' WHERE serviceName = 'getNearestPlant';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetOffersServiceImpl' WHERE serviceName = 'com.gcpl.service.GetOffersServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetOffersServiceImpl' WHERE serviceName = 'com.gcpl.service.Impl.OffersImageServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetLandingDetails' WHERE serviceName = 'com.gcpl.service.GetLandingDetails';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetLandingDetails' WHERE serviceName = 'com.gcpl.service.Impl.LandingDetailsServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKartNodeJSService:getRegion' WHERE serviceName = 'getRegion';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetOrderHistoryserviceImple' WHERE serviceName = 'com.gcpl.service.GetOrderHistoryserviceImple';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetOrderHistoryserviceImple' WHERE serviceName = 'com.gcpl.service.Impl.OrderHistoryServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetPartsAndPriceServiceImpl' WHERE serviceName = 'com.gcpl.service.GetPartsAndPriceServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetPartsAndPriceServiceImpl' WHERE serviceName = 'com.gcpl.service.Impl.PartsAndPriceServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetMaterialsDetails' WHERE serviceName = 'com.gcpl.service.GetMaterialsDetails';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.GetMaterialsDetails' WHERE serviceName = 'com.gcpl.service.Impl.MaterialsDetailsServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKartNodeJSService:checkOutPage' WHERE serviceName = 'checkOutPage';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.PlaceOrderServiceImpl' WHERE serviceName = 'com.gcpl.service.PlaceOrderServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.PlaceOrderServiceImpl' WHERE serviceName = 'com.gcpl.service.Impl.PlaceOrderServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.CalculateOrderServiceImpl' WHERE serviceName = 'com.gcpl.service.CalculateOrderServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.CalculateOrderServiceImpl' WHERE serviceName = 'com.gcpl.service.Impl.CalculateOrderServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.PostOrderServiceImpl' WHERE serviceName = 'com.gcpl.service.PostOrderServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.PostOrderServiceImpl' WHERE serviceName = 'com.gcpl.service.Impl.PostOrderServiceImpl';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKartNodeJSService:cancelOrder' WHERE serviceName = 'cancelOrder';", array());
			$this->db->query("update transaction_log SET serviceName = 'GCPLKart.com.gcpl.service.ApplyDiscountServiceImpl' WHERE serviceName = 'com.gcpl.service.ApplyDiscountServiceImpl';", array());
			$this->db->query("UPDATE transaction_log SET user_id = NULLIF(REPLACE(JSON_EXTRACT(CAST(`input` AS CHAR),'$.customerNumber') , '\"', ''), 'null') WHERE serviceName = 'GCPLKart.com.gcpl.service.GetLandingDetails' AND user_id IS NULL;", array());
						
			//$this->db->query("", array());

			return $getvalue; 	
		}else{
			
			return false;
			}
		
	
		 
		}
	

	
}