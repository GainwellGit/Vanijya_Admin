<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct()
	{	
		parent::__construct();
		 //$Settings = $this ->site->get_setting();
		//$this->load->model(array('cart_model','wishlist_model'));

		$this->load->library('user_agent');

		if ($this->agent->is_mobile())
		{
		  $this->theme_name = "mobile";
     	}
     	else
     	{
          $this->theme_name = "desktop";

     	}

		$this->theme = $this->theme_name.'/views/';
		//echo VIEWPATH.$this->theme_name.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
        if(is_dir(VIEWPATH.$this->theme_name.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR)) {
             $this->data['assets'] = base_url() . 'themes/' . $this->theme_name;
        } else {
           $this->data['assets'] = base_url() . 'themes/default/assets/';
        }

         

	}
    function template($page, $meta = array(), $data = array()) {
   
		$usersessiondata = array(); 
         $meta['assets']=$this->data['assets'];
         $data['assets']=$this->data['assets'];
		$meta['lang'] = $this->lang->language;
		$usersessiondata = $this->session->userdata('newcustomerdata');
		$meta['usersessiondata'] = $usersessiondata;
		$meta['Settings'] = $this->site->get_setting(); 
		$meta['categorylist'] = $this->site->get_categories();
		if(!empty($usersessiondata)){  
			 $user_id = $usersessiondata['customerid'];
			 
			/*if(!empty($this->cart->contents())){
				$cartProd = $this->cart->contents();
				foreach($cartProd as $pr){
					if($pr['type'] == 'custom_ring'){
						$cIds[] = $pr['rdetails']->cart_id;
						$cIds[] = $pr['ddetails']->cart_id;	
					}
					if($pr['type'] == 'jewellery'){
						$cIds[] = $pr['details']->cart_id;
						$subtotal['cart_id'] = $pr['details']->cart_id;
						$subtotal['qty'] = $pr['qty'];
						$subtotal['sprice'] = $pr['qty'] * $pr['price'];
						
						$sub[] = $subtotal;
					}	
				}
				if(!empty($cIds)){
					foreach($cIds as $cid){
						$this->site->updateCartById($cid,$user_id);	
					}	
				}
				
				if(!empty($sub)){
					foreach($sub as $sb){
						$this->site->updateSubtotal($sb);	
					}	
				}
				
			}*/
			
			$cart_items = $this->site->getCartItemsByUId($user_id);
			if(!empty($cart_items)){
				foreach($cart_items as $citems){
					$cartIds[] = $citems->cart_id;
				}
				$cartProducts = $this->cart_model->getCartProducts($user_id,$cartIds);
			}else{
				$cartProducts = array();
			}
			$cart_total = $this->site->getTotalAmountByUid($user_id);
			$cart_total = (isset($cart_total) && !empty($cart_total)) ? getPriceFormat($cart_total->total) : 0;
			
			
			$all_wishlist = $this->wishlist_model->getwishlistbyUid($user_id);
			$wishlist = count($all_wishlist);
			
			/*$wishlist_items = $this->site->getWishlistItemsByUId($user_id);
			if(!empty($wishlist_items)){
				foreach($wishlist_items as $witems){
					$wIds[] = $witems->wid;
				}
				
				$wishProducts = $this->wishlist_model->getWishlistProducts($user_id,$wIds);
			}else{
				$wishProducts = array();
			}*/
		}else{ 
			$cartProducts = $this->cart->contents();
			$cart_total = getPriceFormat($this->cart->total());
			//$wishProducts = isset($_SESSION['wishlist_products_final']) ? $_SESSION['wishlist_products_final'] : array();
		}
		$meta['cart'] = !empty($cartProducts) ? $cartProducts : array();
		//$meta['wishlist'] = !empty($wishProducts) ? $wishProducts : array();
		$meta['wishlist'] = isset($wishlist) ? $wishlist : 0;
		$meta['total'] = !empty($cart_total) ? $cart_total : '';
		$default_currency = $this->site->getCurrencyByCode($meta['Settings']->default_currency);
        $meta['code'] = isset($default_currency) ? $default_currency->code : '$';
		$meta['page_title'] = 'Bienvenido a Emmablair';
		//$display_currency_symbol = $this->site->getCurrencyByCode($meta['Settings']->display_symbol);
		
        //$meta['display_symbol'] = $display_currency_symbol;
		//echo display_currency_position(4); die();	
		 $this->load->view($this->theme."templates/header",$meta);
		 $this->load->view($this->theme.$page, $data);
		 $this->load->view($this->theme."templates/footer");
    }
	
	function is_logged_in(){
		$sessUser = $this->session->userdata('newcustomerdata');	
		if(isset($sessUser) && !empty($sessUser)){
			$uid = $sessUser['customerid'];
			if($uid > 0)
				return true;
		}else{
			return false;	
		}
	}
	
}
