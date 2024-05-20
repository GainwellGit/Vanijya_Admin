<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('home_model');
				
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function index()
		{
			$data['user_details'] =$this->home_model->getalluser();
      		$this->load->ftemplate('userlist',$data);
		}
	   



	}

	?>