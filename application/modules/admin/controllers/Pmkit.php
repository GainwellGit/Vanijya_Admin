<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pmkit extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('Location_model');
                $this->load->model('Coupon_model');
                $this->load->model('Pmkit_model');
				$this->load->library('excel');
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function index()
		{
            $finalArray=array();
            $getlocation = $this->Pmkit_model->getUniqueModel(); 

            $getallModel = $this->Pmkit_model->getModel();


            foreach ($getallModel as $model) {

                $model_no = $model->machine_id;
                $getPmkit = $this->Pmkit_model->getPmkitByModel($model_no); 
                if(!empty($getPmkit)){
                    foreach ($getPmkit as $getPmkits) {
                        $finalArray[$model_no] [] ='('.$getPmkits->pmkit_material_no.') '.$getPmkits->material_description;
                    } 
                }else{

                    $finalArray[$model_no] [] = ''; 
                }
                
            } 

            

            // foreach ($getlocation as $value) {
            //    echo  $model_no = $value->machinemodel_material_no;
            //     $ip = $value->source_ip;
            //     $getPmkit = $this->Pmkit_model->getPmkitByModel($model_no); 
            //     foreach ($getPmkit as $getPmkits) {
            //         $finalArray[$model_no] [] =$getPmkits->material_description .' - '. $getPmkits->pmkit_material_no;
            //     }                
            // }

           

            

            $data['finalArray']=$finalArray;


			$this->load->ftemplate('pmkit_maping_list',$data);
        }
		
		public function report()
        {
            
            $getAllPmkit = $this->Pmkit_model->getAllPmkit();            

            $data['finalArray']=$getAllPmkit;


            $this->load->ftemplate('model_component_mapping',$data);
        }
		
        public function create_mapping(){

            $selectedkit = array();
            $getallModel = $this->Pmkit_model->getModel();

            $getpmkitList = $this->Pmkit_model->getpmkitList();
            $getmapingpmkit = $this->Pmkit_model->getUniqueModel(); 

            if(!empty($getmapingpmkit)){

                foreach($getmapingpmkit as $getPmkits){

                    $selectedkit[]= $getPmkits->machinemodel_material_no;
                }
            }
			
			
            $data['models'] = $getallModel;
            $data['pmkit'] = $getpmkitList;
            $data['getPmkit'] = $selectedkit;

			$this->load->ftemplate('create_mapping',$data);

        } 

        public function edit_mapping($modelno){
			
			
			$modelno = str_ireplace("%20"," ",$modelno);
			
            $selectedkit = array();
            $selectedkitmapping = array();
            $getallModel = $this->Pmkit_model->getModel();
            $getpmkitList = $this->Pmkit_model->getpmkitList();
            $getPmkit = $this->Pmkit_model->getPmkitByModelID($modelno); 
            $getmapingpmkit = $this->Pmkit_model->getUniqueModel();
			
		

            $getModelById = $this->Pmkit_model->getModelByID($modelno); 





            if(!empty($getmapingpmkit)){

                foreach($getmapingpmkit as $getPmkits){

                    $selectedkitmapping[]= $getPmkits->material_no;
                }
            }
            

            if(!empty($getPmkit)){

                foreach($getPmkit as $getPmkits){

                    $selectedkit[]= $getPmkits->pmkit_material_no;
                }
            }
			
	

            $A = array($modelno);

            $clean1 = array_diff($A, $selectedkitmapping); 
            $clean2 = array_diff($selectedkitmapping, $A); 
            $final_output = array_merge($clean1, $clean2);
          
            $data['getPmkit'] = $selectedkit;
            $data['selectedkitmapping'] = $final_output;
            $data['modelno'] = $modelno;
            $data['models'] = $getallModel;
            $data['pmkit'] = $getpmkitList;
            $data['pmkitimage'] = $getPmkit;
            $data['getModelById'] = $getModelById;
			$this->load->ftemplate('edit_mapping',$data);

        }
        
        public function insert_mapping_data(){

            $models=$this->input->post('models');
            $pmkits=$this->input->post('pmkits');
            $submit=$this->input->post('submit');
            $model_id=$this->input->post('model_id'); 
            if($submit == 'submit'){
                $newArray = array();
                if(!empty($pmkits) && $models !=''){
                    
                    foreach($pmkits as $kits){

                        $data['machinemodel_material_no'] = $models;
                        $data['pmkit_material_no'] = $kits;
                        $data['source_ip'] = $this->input->ip_address();
                        $newArray[] = $data;
                    }

                    $mapping= $this->Pmkit_model->insert_mapping($newArray,$models);

                    $this->session->set_flashdata('success','Mapping Updated Successfully');
                    redirect('/admin/pmkit');

                }
            }else if($submit == 'delete'){
               
                $mapping= $this->Pmkit_model->Delete_mapping($model_id);

                $this->session->set_flashdata('success','Mapping and Model  Deleted Successfully');
                redirect('/admin/pmkit');

            }   

        }

        public function download_excel()
		{
			$file_url =$_SERVER["DOCUMENT_ROOT"]."/gcpl/PMKit/assets/csv/model_pmkit_mapping.xls";
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
			readfile($file_url);
        }


        public function download_model()
        {
            $file_url =$_SERVER["DOCUMENT_ROOT"]."/gcpl/PMKit/assets/csv/model.xls";
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
            readfile($file_url);
        }

        
        public function bulk_mapping() {
			if(isset($_FILES['uploadfile']['name'])) {
			 $filename =$_FILES['uploadfile']['name'];

			 $filename = strtotime("now").'.'.substr(strrchr($filename,'.'),1);
				$config['file_name'] = $filename;
				$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv';
				$config['allowed_types'] = 'xlsx|csv|xls';
				$config['overwrite'] = true;
				$config['encrypt_name'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('uploadfile')) {
					$path = $_SERVER["DOCUMENT_ROOT"].'/gcpl/PMKit/assets/csv/'.$filename;
				 	$object = PHPExcel_IOFactory::load($path);
					 $isSuccessfullyInserted = false;
					foreach($object->getWorksheetIterator() as $worksheet) {
							$highestRow = $worksheet->getHighestRow();
							$highestColumn = $worksheet->getHighestColumn();

							for($row=2; $row<=$highestRow; $row++) {
								$model_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								$pmkit_no = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
								
									$data=array(
										'machinemodel_material_no'=>$model_no,
                                        'pmkit_material_no'=>$pmkit_no,
                                        'source_ip' => $this->input->ip_address(),
										
                                    );
                                    
                                    // print_r($data);
                                    // die;
									$bulk_upload= $this->Pmkit_model->bulk_mapping($data,$model_no,$pmkit_no,$row); 

                            }
                            
                           
					}

					if ($bulk_upload)
					$this->session->set_flashdata('message', "Mapping Created Successfully");
				    else 
					$this->session->set_flashdata('message', $this->upload->display_errors());
					 
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename)) {
							$path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename;
							unlink($path);
					}
				 }

				 else 
					 $this->session->set_flashdata('message', $this->upload->display_errors());
					 redirect("/admin/pmkit");
			 }
			 
        }

        public function bulk_upload_model() {
			if(isset($_FILES['uploadfile']['name'])) {
			 $filename =$_FILES['uploadfile']['name'];

			 $filename = strtotime("now").'.'.substr(strrchr($filename,'.'),1);
				$config['file_name'] = $filename;
				$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv';
				$config['allowed_types'] = 'xlsx|csv|xls';
				$config['overwrite'] = true;
				$config['encrypt_name'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('uploadfile')) {
					$path = $_SERVER["DOCUMENT_ROOT"].'/gcpl/PMKit/assets/csv/'.$filename;
				 	$object = PHPExcel_IOFactory::load($path);
					 $isSuccessfullyInserted = false;
					foreach($object->getWorksheetIterator() as $worksheet) {
                        
							$highestRow = $worksheet->getHighestRow();
							$highestColumn = $worksheet->getHighestColumn();

							for($row=2; $row<=$highestRow; $row++) {
								    $machine_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								    $display_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                    $industry_div = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                    $business_grp = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
								
									$data=array(
										'machine_id'=>$machine_id,
										'display_name'=>$display_name,
                                        'industry_div'=>$industry_div,
                                        'business_grp'=>$business_grp,
                                    );

									$bulk_model= $this->Pmkit_model->bulk_upload_model($data,$machine_id); 

                            }
        
                    }

					if ($bulk_model)
					$this->session->set_flashdata('message', "Upload Models Successfully");
				    else 
					$this->session->set_flashdata('message', $this->upload->display_errors());
					 
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename)) {
							$path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename;
							unlink($path);
					}
				 }

				 else 
					 $this->session->set_flashdata('message', $this->upload->display_errors());
					 redirect("/admin/pmkit");
			 }
			 
        }
        
        public function insert_image($pmkit)
        {


            $pmkitno = str_replace('%20',' ', $pmkit);
			
            $postdata=$this->input->post();

            $dir_path=$_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/uploads/logo';

        	if(isset($_FILES['imgInp']) && !empty($_FILES['imgInp']['name'])){
                $thumbimagegroup = array('0' => array('width'=>300, 'height'=>250));    
                
                if(!is_dir($dir_path)){
                    mkdir($dir_path );
                }
                
                $config['upload_path'] = $dir_path.'/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                   
                $this->upload->initialize($config);
                if($this->upload->do_upload('imgInp')){
                    $uploaddata = $this->upload->data(); 
                    $filename = $uploaddata['file_name'];
                   
                    $data=array(
                        'material_number'=>"$pmkitno", 
                        //'thumbnail'=>$filename,
                       'thumbnail'=>file_get_contents($_FILES['imgInp']['tmp_name']),
                    );

                    $this->Pmkit_model->addimaghedata($data,$pmkitno);
                    $sourceimage = $dir_path.'/'.$filename;
                    foreach($thumbimagegroup as $resize){
                        $config = array();
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $sourceimage,
                            //'create_thumb' => TRUE,
                            'maintain_ratio' => FALSE,
                            'width' => $resize['width'],
                            'height' => $resize['height']
                        );
                        
                        // if(!is_dir($dir_path.'/'.$pmkitno)){
                        //     mkdir($dir_path.'/'.$pmkitno, 0777, true);
                        // }
                        
                        //$config['new_image'] = $dir_path.'/'.$resize['width'].'_'.$resize['height'].'/'.$filename;
                        //$config['new_image'] = $dir_path.'/'.$pmkitno.'/'.$filename;
                       //print_r($config);die("99");
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                            //echo $this->image_lib->display_errors();die();
                        $this->image_lib->clear();
                    }

                    $this->session->set_flashdata('message', 'Image Added Successfully');
                    redirect($_SERVER['HTTP_REFERER']);


                }else{

                    $this->session->set_flashdata('imgerror', $this->upload->display_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                    //$result = array("status"=>false, "type"=>"verror", "message"=>$this->upload->display_errors());
                }
            
                
                  //redirect('admin/pmkit');

            }
        }





	}

	?>