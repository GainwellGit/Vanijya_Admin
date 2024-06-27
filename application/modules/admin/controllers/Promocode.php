<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promocode extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Promocode_model');
        $this->load->model('Home_model');
        $this->load->model('Location_model');
        $this->usersessiondata = $this->session->userdata('logged_in'); 		
        if(empty($this->usersessiondata)){
            redirect('/admin/authentication/login'); 
        }
    }

    public function list()
    {
        $getGlobalPromocode = $this->Promocode_model->get_globalpromocode();
        $getMaterials = $this->Home_model->get_material();
        $getAllCustomers = $this->Promocode_model->get_allcustomers();
        $getAllRegions = $this->Location_model->getAllLocation();
        $getAllZones = $this->Promocode_model->getAllZone();
        
        $data['globalpromocode'] = $getGlobalPromocode;
        $data['allmaterials'] = $getMaterials;
        $data['allcustomers'] = $getAllCustomers;
        $data['allregions'] = $getAllRegions;
        $data['allzones'] = $getAllZones;

        $this->load->ftemplate('global_promocode',$data);
    }

    public function get_discounton_typerecords(){
        $disid    = $this->input->post('dis_id');
        $dison    = $this->input->post('dison');
        $getlists = $this->Promocode_model->get_dison_selectlist($disid, $dison);
        echo json_encode($getlists);
    }

    public function edit_globalpromocode(){
        $dispromo  = $this->input->post('dispromo');
        $dispdes   = $this->input->post('dispdes');
        $distype   = $this->input->post('distype');
        $disval    = $this->input->post('disval');
        $dismina   = $this->input->post('dismina');
        $disfrom   = $this->input->post('disfrom');
        $disto 	   = $this->input->post('disto');
        $dison     = $this->input->post('dison');
        $dismat    = ($dison=='MATERIAL-GROUP')?$this->input->post('dismat'):'';
        $discust   = ($dison=='CUSTOMER')? $this->input->post('discust'):'';
        $disreg    = ($dison=='REGION')? $this->input->post('disreg'):'';
        $diszone   = ($dison=='ZONE')? $this->input->post('diszone'):'';
        $disstatus = $this->input->post('disstatus');
        $id 	   = ($this->input->post('id_x'))?$this->input->post('id_x'):'';
        
        $request = array();
        if ( !empty($dispromo) ) {
            // code...
            $data_1 = $this->Promocode_model->save_promocode($id,$dispromo,$dispdes,$distype,$disval,$dismina,$disfrom,$disto,$dison,$dismat,$discust,$disreg,$diszone,$disstatus); 
            $request = array('success'=>true , 'data' => $data_1);     
        }else{
            $request = array('success'=>false , 'data' => 'Empty values' , 'dismina'=> $dismina , 'id'=> $id);
        }
        $response = json_encode($request);
        header('Content-Type: application/json');
        echo $response;

    }

    public function delete_globalpromocode(){
        $id 	    = $this->input->post('disid');
        $promocode 	= $this->input->post('promocode');
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
            $data_1 = $this->Promocode_model->delete_promocode($id); 
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