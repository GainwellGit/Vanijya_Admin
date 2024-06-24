<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Discount extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Discount_model');
        $this->load->model('Home_model');
        $this->usersessiondata = $this->session->userdata('logged_in'); 		
        if(empty($this->usersessiondata)){
            redirect('/admin/authentication/login'); 
        }
    }
	   
    public function list()
    {
        $getGlobalDiscount = $this->Discount_model->get_globaldiscount();
        $getMaterials = $this->Home_model->get_material();
        
        $data['globaldiscount'] = $getGlobalDiscount;
        $data['allmaterials'] = $getMaterials;

        $this->load->ftemplate('global_discount',$data);
    }

    public function get_materials(){
        $disid        = $this->input->post('dis_id');
        $getMaterials = $this->Discount_model->get_material($disid);
        $data['allmaterials'] = $getMaterials;
        echo json_encode($data);
    }

    public function edit_globaldiscount(){
        $distype    = $this->input->post('distype');
        $disval     = $this->input->post('disval');
        $dismina 	= $this->input->post('dismina');
        $disfrom 	= $this->input->post('disfrom');
        $disto 	    = $this->input->post('disto');
        $dison      = $this->input->post('dison');
        $dismat     = $this->input->post('dismat');
        $disstatus  = $this->input->post('disstatus');
        $id 	    = ($this->input->post('id_x'))?$this->input->post('id_x'):'';
        
        $request = array();
        if ( !empty($dismina) ) {
            // code...
            $data_1 = $this->Discount_model->save_discount($id,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismat,$disstatus); 
            $request = array('success'=>true , 'data' => $data_1);     
        }else{
            $request = array('success'=>false , 'data' => 'Empty values' , 'dismina'=> $dismina , 'id'=> $id);
        }
        $response = json_encode($request);
        header('Content-Type: application/json');
        echo $response;
    }

    public function delete_globaldiscount(){
        $id 	    = $this->input->post('disid');
        $distype 	= $this->input->post('distype');
        $disval 	= $this->input->post('disval');
        $dismina 	= $this->input->post('dismina');
        $disfrom 	= $this->input->post('disfrom');
        $disto 	    = $this->input->post('disto');
        $dison 	    = $this->input->post('dison');
        $disstatus 	= $this->input->post('disstatus');
        
        $request = array();
        if ( !empty($disstatus) ) {
            // code...
            $data_1 = $this->Discount_model->delete_discount($id, $distype, $disval, $dismina, $disfrom, $disto, $dison, $disstatus); 
            $request = array('success'=>true , 'data' => $data_1);     
        }else{
            $request = array('success'=>false , 'data' => 'Empty values' , 'status'=> $disstatus , 'id'=> $id);
        }
        $response = json_encode($request);
        header('Content-Type: application/json');
        echo $response;
    }
}
?>