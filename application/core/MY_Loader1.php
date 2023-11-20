<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



/* load the MX_Loader class */

require APPPATH."third_party/MX/Loader.php";



class MY_Loader extends MX_Loader {
	
	public function __construct()
	{	
		parent::__construct();

		$this->library('user_agent');

		if ($this->agent->is_mobile())
		{
		  $this->theme_name = "mobile";
     	}
     	else
     	{
          $this->theme_name = "desktop";

     	}

		$this->theme = 'C:/XAMPP/htdocs/codeigniter/'.$this->theme_name.'/views/';
		$this->assets = 'C:/XAMPP/htdocs/codeigniter/'.$this->theme_name.'/assets/';
      
	}

	public function template($template_name, $vars = array(), $return = FALSE)

    {

        if(!empty($vars)):

        $this->view('template/header', $vars,$return);

        $this->view($template_name, $vars,$return);

        $this->view('template/footer', $vars,$return);

    else:

        $this->view('template/header', $return);

        $this->view($template_name, $return);

        $this->view('template/footer', $return); 

    endif;

    }
	
	
	

}