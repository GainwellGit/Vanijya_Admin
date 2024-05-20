<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	
	public function login(){

		die("Authentication login");
		
		$this->load->view('login');
		
		}
		
		
	public function loginprocess(){
		
		
		
		}
}
