<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Discount extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Discount_model');
        $this->load->model('Home_model');
        $this->load->library('excel');
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
        //$data['allmaterials'] = $getMaterials;
        echo json_encode($getMaterials);
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

    public function download_excel()
    {
        $file_url =base_url('assets/csv/global_discount.xlsx');;//echo $file_url;die;
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
        readfile($file_url);
    }

    public function bulk_promocode() {
        if(isset($_FILES['uploadfile']['name'])) {
            $filename =$_FILES['uploadfile']['name'];
            $path = $_FILES['uploadfile']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
                 
            foreach($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $materials_arr = array();
                $global_dis_id;

                for($row=2; $row<=$highestRow; $row++) {
                    if($row == 2){
                        $discount_type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $discount_value = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $min_ammount = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $from_date = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); 
                        $to_date = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $status = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                        $date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
                        $valid_from= gmdate("Y-m-d", $date_from); //date

                        $date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                        $valid_to= gmdate("Y-m-d", $date_to); //date 
                    }

                    if($worksheet->getCellByColumnAndRow(0, $row)->getValue()){
                        $materials_arr[] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    }else{
                        $bulk_upload= $this->Discount_model->save_discount('',$discount_type,$discount_value,$min_ammount,$valid_from,$valid_to,'MATERIAL',$materials_arr,$status);
                        break;
                    }
                }
            }

            if ($bulk_upload)
            $this->session->set_flashdata('message', "Bulk global Discount Uploaded Successfully");
            else 
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect("/admin/discount/list");

            /* if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename)) {
                $path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename;
                unlink($path);
            } */
        }
    }
}
?>