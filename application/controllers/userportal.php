<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Userportal extends Api {
	public function __construct() {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
		parent::__construct();
		$this->load->model('api_model');

	}
	public function quizset_post()
	{
		$quizsets = $this->api_model->get_quizset_list();
		if(isset($quizsets) && !empty($quizsets)){
			foreach($quizsets as $quizs){
				$data['id'] = $quizs->id;
				$data['title'] = $quizs->title;
				$data['title_image'] =$quizs->title_image;
				$mdata[] = $data;
			}
		}
		if(isset($mdata) && !empty($mdata)){
			$this->response($mdata, REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		}
	}

}
?>