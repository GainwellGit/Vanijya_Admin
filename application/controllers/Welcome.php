<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		

		$this->load->view('welcome_message'); 
		//redirect('/admin/authentication/login');
	}
	
	
	public function test(){
		
		$this->load->template('test');
		
		}

    public function xml(){

    	

    	//$xml = simplexml_load_string('C:/GWApps/gcpl/pmkit/GCPL_X_RUECustMast');

    	//$content = file_get_contents('https://qapps.gainwellindia.com/gcpl/pmkit/GCPL_X_RUECustMast');
        //$x = new SimpleXmlElement($content);

        $sxe = new SimpleXMLElement('https://qapps.gainwellindia.com/gcpl/pmkit/GCPL_X_RUECustMast.xml', NULL, TRUE);
        $array = json_decode(json_encode((array)$sxe), TRUE);
		print_r($array['ZRUE_INT1'][0]);

    	//echo $x;

    }		
		

}
