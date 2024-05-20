<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restapi extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('restapi_model');
//   $this->load->library('form_validation');
 }
 
 function endpoint()
 {
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $data = json_decode(file_get_contents('php://input'), true);
        if($this->input->get('event')){
            $event = $this->input->get('event');
            $record = $this->restapi_model->insert_api($event, $data);
            echo $record;
            exit;
        }
    }elseif($_SERVER['REQUEST_METHOD'] === "GET"){

    }else{
        echo json_encode(["status_code"=> 400,"status" => "failed", "msg" => "Invalid Request!"], true);
        exit;
    }
 }
 
}