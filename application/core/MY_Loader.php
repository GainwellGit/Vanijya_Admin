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
		$path=$_SERVER['DOCUMENT_ROOT'];
		$this->theme = $path.'/themes/'.$this->theme_name.'/views/';
		$this->assets = $path.'/themes/'.$this->theme_name.'/assets/';
      
	}

	public function template($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
		$content  = $this->themeview($this->theme,'templates/header', $vars, $return);
		$content .= $this->themeview($this->theme,$template_name, $vars, $return);
		$content .= $this->themeview($this->theme,'templates/footer', $vars, $return);
		return $content;
    else:
		$this->themeview($this->theme,'templates/header', $vars,FALSE);
		$this->themeview($this->theme,$template_name, $vars,FALSE);
		$this->themeview($this->theme,'templates/footer', $vars,FALSE);	
    endif;
    }	
	
	public function ftemplate($template_name, $vars = array(), $return = FALSE)
    {
		// $this->load->model('quizset_model');
		// $quizsets = $this->quizset_model->getquizsetlist();
		// if(!empty($quizsets)){
		// 	foreach($quizsets as $quizset){
		// 		$data[$quizset->id] = $quizset->title;	
		// 	}	
		// 	$vars['quizsets'] = $data;
		// }
		
        if(!empty($vars)):
        $this->view('template/header', $vars,$return);
        $this->view($template_name, $vars,$return);
        $this->view('template/footer', $vars,$return);
    else:
        $this->view('template/header', $vars,$return);
        $this->view($template_name, $vars,$return);
        $this->view('template/footer',$vars,$return); 
    endif;
    }

}