<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exceptions extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('Location_model');
				$this->load->model('Coupon_model');
				$this->load->model('group_model');
				$this->load->library('excel');
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function customer(){

	   		$getExceptionList = $this->Coupon_model->getExceptionData();
	   		$data['exceptionList']=$getExceptionList;
			$this->load->ftemplate('user_exception',$data);
	   	}


	   	public function region(){

	   		$getExceptionList = $this->Location_model->getExceptionData();
	   		$data['exceptionList']=$getExceptionList;
			$this->load->ftemplate('region_exception',$data);
	   	}


	   	public function group(){

	   		$getExceptionList = $this->group_model->getExceptionData();
	   		$data['exceptionList']=$getExceptionList;
			$this->load->ftemplate('group_exception',$data);
	   	}



	}

	?>