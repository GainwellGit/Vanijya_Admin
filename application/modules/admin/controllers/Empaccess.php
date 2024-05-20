<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Empaccess extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Empaccess_model');
        $this->load->library('excel');
        $this->usersessiondata = $this->session->userdata('logged_in'); 		
        if(empty($this->usersessiondata)){
            redirect('/admin/authentication/login'); 
        }
    }
    
    public function list()
    {
        $getEmpAccess = $this->Empaccess_model->get_empaccess();

        $data['empaccess'] = $getEmpAccess;

        $this->load->ftemplate('empaccess_list',$data);
    }

    public function edit_empaccess(){
        $empid = $this->input->post('empid');
        $empname = $this->input->post('empname');
        $empmobile 	 = $this->input->post('empmobile');
        $empemail 	 = $this->input->post('empemail');
        $empgrade 	 = $this->input->post('empgrade');
        $emplocation = $this->input->post('emplocation');
        $empbroad 	 = $this->input->post('empbroad');
        $empjob 	 = $this->input->post('empjob');
        $id 	 = ($this->input->post('id_x'))?$this->input->post('id_x'):'';
        
        $request = array();
        if ( !empty($empmobile) ) {
            // code...
            $data_1 = $this->Empaccess_model->save_empaccess($empid,$empname,$empmobile,$empemail,$empgrade,$emplocation,$empbroad,$empjob); 
            $request = array('success'=>true , 'data' => $data_1);     
        }else{
            $request = array('success'=>false , 'data' => 'Empty values' , 'empmobile'=> $empmobile , 'id'=> $id);
        }
        $response = json_encode($request);
        header('Content-Type: application/json');
        echo $response;

    }

    public function delete_empaccess(){
        $empid = $this->input->post('empid');
        $empname = $this->input->post('empname');
        $empmobile 	 = $this->input->post('empmobile');
        $id 	 = $this->input->post('id_x');
        
        $request = array();
        if ( !empty($empmobile) ) {
            // code...
            $data_1 = $this->Empaccess_model->delete_empaccess($id,$empid,$empname,$empmobile); 
            $request = array('success'=>true , 'data' => $data_1);     
        }else{
            $request = array('success'=>false , 'data' => 'Empty values' , 'empmobile'=> $empmobile , 'id'=> $id);
        }
        $response = json_encode($request);
        header('Content-Type: application/json');
        echo $response;

    }
}
?>