<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promocode extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Promocode_model');
        $this->load->model('Home_model');
        $this->load->model('Location_model');
        $this->load->library('excel');
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

    public function check_promocode() {
        $promocode = $this->input->post('dispromo');
        $existpromocode = $this->Promocode_model->check_promocode($promocode);
        echo $existpromocode;
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

    public function bulk_matpromocode(){
        if(isset($_FILES['uploadfile']['name'])) {
            $filename =$_FILES['uploadfile']['name'];
            $path = $_FILES['uploadfile']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
                 
            foreach($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $materials_arr = array();
                $promocode='';
                $promo_des='';
                $discount_type='';
                $discount_value='';
                $min_ammount='';
                $status='';
                $valid_from='';
                $valid_to='';


                for($row=2; $row<=$highestRow; $row++) {
                    if($row == 2){
                        $promocode      = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $promo_des      = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $discount_type  = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $discount_value = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $min_ammount    = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $from_date      = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $to_date        = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $status         = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                        $date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
                        $valid_from= gmdate("Y-m-d", $date_from); //date
                        
                        $date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                        $valid_to= gmdate("Y-m-d", $date_to); //date
                    }
                    
                    if($worksheet->getCellByColumnAndRow(0, $row)->getValue()){
                        $materials_arr[] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();continue;

                    }else{
                        echo $discount_type.'<br>';die('128');
                        $bulk_upload= $this->Promocode_model->save_promocode('',$promocode,$promo_des,$discount_type,$discount_value,$min_ammount,$valid_from,$valid_to,'MATERIAL-GROUP',$materials_arr,null,null,null,$status);
                        break;
                    }
                    echo '<pre>';print_r($materials_arr);die('139');
                }
            }

            if ($bulk_upload)
            $this->session->set_flashdata('message', "Bulk Material Promocode Uploaded Successfully");
            else 
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect("/admin/promocode/list");
        }
    }

    public function bulk_custpromocode(){
        if(isset($_FILES['uploadfile']['name'])) {
            $filename =$_FILES['uploadfile']['name'];
            $path = $_FILES['uploadfile']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
                 
            foreach($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $customers_arr = array();

                for($row=2; $row<=$highestRow; $row++) {
                    if($row == 2){
                        $promocode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $promo_des = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $discount_type = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $discount_value = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $min_ammount = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $from_date = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); 
                        $to_date = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $status = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                        $date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
                        $valid_from= gmdate("Y-m-d", $date_from); //date

                        $date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                        $valid_to= gmdate("Y-m-d", $date_to); //date 
                    }

                    if($worksheet->getCellByColumnAndRow(0, $row)->getValue()){
                        $customers_arr[] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    }else{
                        $bulk_upload= $this->Promocode_model->save_promocode('',$promocode,$promo_des,$discount_type,$discount_value,$min_ammount,$valid_from,$valid_to,'CUSTOMER','',$customers_arr,'','','A');
                        break;
                    }
                }
            }

            if ($bulk_upload)
            $this->session->set_flashdata('message', "Bulk Customer Promocode Uploaded Successfully");
            else 
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect("/admin/promocode/list");

            /* if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename)) {
                $path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename;
                unlink($path);
            } */
        }
    }

    public function bulk_regpromocode(){
        if(isset($_FILES['uploadfile']['name'])) {
            $filename =$_FILES['uploadfile']['name'];
            $path = $_FILES['uploadfile']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
                 
            foreach($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $regions_arr = array();

                for($row=2; $row<=$highestRow; $row++) {
                    if($row == 2){
                        $promocode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $promo_des = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $discount_type = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $discount_value = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $min_ammount = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $from_date = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); 
                        $to_date = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $status = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                        $date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
                        $valid_from= gmdate("Y-m-d", $date_from); //date

                        $date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                        $valid_to= gmdate("Y-m-d", $date_to); //date 
                    }

                    if($worksheet->getCellByColumnAndRow(0, $row)->getValue()){
                        $regions_arr[] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    }else{
                        $bulk_upload= $this->Promocode_model->save_promocode('',$promocode,$promo_des,$discount_type,$discount_value,$min_ammount,$valid_from,$valid_to,'REGION','','',$regions_arr,'','A');
                        break;
                    }
                }
            }

            if ($bulk_upload)
            $this->session->set_flashdata('message', "Bulk Region Promocode Uploaded Successfully");
            else 
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect("/admin/promocode/list");

            /* if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename)) {
                $path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename;
                unlink($path);
            } */
        }
    }

    public function bulk_zonepromocode(){
        if(isset($_FILES['uploadfile']['name'])) {
            $filename =$_FILES['uploadfile']['name'];
            $path = $_FILES['uploadfile']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
                 
            foreach($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $zones_arr = array();

                for($row=2; $row<=$highestRow; $row++) {
                    if($row == 2){
                        $promocode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $promo_des = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $discount_type = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $discount_value = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $min_ammount = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $from_date = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); 
                        $to_date = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $status = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                        $date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
                        $valid_from= gmdate("Y-m-d", $date_from); //date

                        $date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                        $valid_to= gmdate("Y-m-d", $date_to); //date 
                    }

                    if($worksheet->getCellByColumnAndRow(0, $row)->getValue()){
                        $zones_arr[] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    }else{
                        $bulk_upload= $this->Promocode_model->save_promocode('',$promocode,$promo_des,$discount_type,$discount_value,$min_ammount,$valid_from,$valid_to,'ZONE','','','',$zones_arr,'A');
                        break;
                    }
                }
            }

            if ($bulk_upload)
            $this->session->set_flashdata('message', "Bulk Zone Promocode Uploaded Successfully");
            else 
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect("/admin/promocode/list");

            /* if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename)) {
                $path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename;
                unlink($path);
            } */
        }
    }
}

?>