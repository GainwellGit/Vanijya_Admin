<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
					
			$this->load->model('authentication_model'); 
			            
			
       }
        
	  public function login(){
			$this->load->view('login');
	   }
	   
	   
	  public function loginprocess(){
		  $data = array(
				'user_name' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				); 
				$result = $this->authentication_model->getUserdata($data);
				if($result){
					$sess_array = array(
				'user_name' => $result['user_name'],
				);

				$this->session->set_userdata('logged_in', $sess_array);
				echo "<pre>"; print_r($sess_array); die();
				          redirect('admin/home');	
				}else{					
				    $this->session->set_flashdata('msg',"Wrong Username Or Password");
				          redirect('admin/authentication/login');		
					}
		  
		  }
		  
		  
	  public function logout(){
				$this->session->unset_userdata('logged_in');
				$this->session->sess_destroy();
                 redirect('admin/authentication/login');
				
				}
}
	   ?>