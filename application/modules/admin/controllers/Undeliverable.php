<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Undeliverable extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Undeliverable_model');
        $this->load->library('excel');
        $this->usersessiondata = $this->session->userdata('logged_in'); 		
        if(empty($this->usersessiondata)){
            redirect('/admin/authentication/login'); 
        }
    }
    
    public function partlist()
    {
        $getUndeliverablePartList = $this->Undeliverable_model->get_undeliverable_part_list();

        $data['partlists'] = $getUndeliverablePartList;

        $this->load->ftemplate('undeliverable_part_list',$data);
    }

    function excel_import(){
        if(isset($_FILES['file']['name'])){
            $this->Undeliverable_model->delete();
            $path = $_FILES['file']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row = 2; $row <= $highestRow ; $row++){
                    $part_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    if($part_no){
                        $part_desc = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $undeliver_remarks = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                        $data[] = array(
                            'part_no' => $part_no,
                            'part_description' => $part_desc,
                            'reason' => $undeliver_remarks
                        );
                    }
                    else{
                        continue;
                    }
                }
            }
            $this->Undeliverable_model->insert($data);
        }
    }

    public function download_excel()
    {
        $file_url = base_url('assets/csv/sample_undeliverable_parts.xlsx');
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
        readfile($file_url);
    }

}
?>