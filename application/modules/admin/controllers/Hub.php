<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hub extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Hub_model');
        $this->load->model('Location_model');
        $this->load->library('excel');
        $this->usersessiondata = $this->session->userdata('logged_in'); 		
        if(empty($this->usersessiondata)){
            redirect('/admin/authentication/login'); 
        }
    }
    
    public function hublist()
    {
        $getHub = $this->Hub_model->get_hub();
        $data['hubs'] = $getHub;
        $this->load->ftemplate('hub_list',$data);
    }

    public function plantlist()
    {
        $getPlant = $this->Location_model->getAllPlants();
        $getHub = $this->Hub_model->get_hub();

        $data['plants'] = $getPlant;
        $data['hubs'] = $getHub;//echo '<pre>';print_r($data['hubs']);die();

        $this->load->ftemplate('plantmasterList',$data);
    }

    public function edit_hub(){
        $hubcode = $this->input->post('hubcode');
        $hubname = $this->input->post('hubname');
        $hubaddress = $this->input->post('hubaddress');
        $id 	 = ($this->input->post('id_x'))?$this->input->post('id_x'):'';
        
        $request = array();
        if ( !empty($hubaddress) ) {
            // code...
            $data_1 = $this->Hub_model->save_hub($hubcode,$hubname,$hubaddress); 
            $request = array('success'=>true , 'data' => $data_1);     
        }else{
            $request = array('success'=>false , 'data' => 'Empty values' , 'empmobile'=> $hubaddress , 'id'=> $id);
        }
        $response = json_encode($request);
        header('Content-Type: application/json');
        echo $response;

    }

    public function updateplant(){
        $hub      = $this->input->post('hub');
        $plant_id = $this->input->post('id_x');
        /* $plant_code  = $this->input->post('plant_code');
        $plant_name  = $this->input->post('plant_name');
        $city_name 	 = $this->input->post('city_name');
        $po_code 	 = $this->input->post('po_code');
        $region_code = $this->input->post('region_code'); */
        
        $getHubCode = $this->Hub_model->get_hubcode_by_id($hub);
        $request = array();
        if ( !empty($getHubCode) && !empty($plant_id) ) {
            // code...
            $data_1 = $this->Hub_model->save_plant_hub($getHubCode,$plant_id); 
            $request = array('success'=>true , 'data' => $data_1);     
        }else{
            $request = array('success'=>false , 'data' => 'Empty values' , 'hub_code'=> $getHubCode , 'plant_id'=> $plant_id);
        }
        $response = json_encode($request);
        header('Content-Type: application/json');
        echo $response;
    }
}
?>