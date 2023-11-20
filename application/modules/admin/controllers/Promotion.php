<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promotion extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('Promotion_model');
                $this->load->model('Coupon_model');
                $this->load->model('Pmkit_model');
				$this->load->library('excel');
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function list()
		{

            $getPromotion = $this->Promotion_model->get_promotion();

            $data['promotion'] = $getPromotion;

			$this->load->ftemplate('promotion_list',$data);
        }
        public function create_promotion(){


			$this->load->ftemplate('create_promotion');

        }


        public function edit_promotion($id){

            $get_promotion_by_id = $this->Promotion_model->get_promotion_by_id($id);
            $data['promo'] = $get_promotion_by_id;
            $this->load->ftemplate('edit_promotion',$data);

        }

        public function changestatus(){

            $id=$this->input->post('promotionId');
            $chageStatus = $this->Promotion_model->statusChange($id);
            
            $response['success']='true';
            return $response;

        }


        public function update_promotion()
        {
            $start_date=$this->input->post('start_date');
            $end_date=$this->input->post('end_date');
            $id=$this->input->post('id');
            if($_FILES['imgInp']['tmp_name'] !=''){

                $config['upload_path'] = $dir_path.'/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                   
                $this->upload->initialize($config);
                if($this->upload->do_upload('imgInp')){
                    $uploaddata = $this->upload->data(); 
                    $filename = $uploaddata['file_name'];
                   
                    $data=array(
                        'offer_image'=>file_get_contents($_FILES['imgInp']['tmp_name']),
                        'from_date'=>$start_date,
                        'to_date'=>$end_date,

                    );


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

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }

                    $check_name = $this->Promotion_model->edit_promotion($data,$id);

                    if($check_name){
                       
                        $this->session->set_flashdata('message', 'Promotion Updated Successfully');
                            redirect('admin/promotion/list');
                    }else{
                       
                       $this->session->set_flashdata('message', 'Promotion Name Already Exist');
                            redirect('admin/promotion/create_promotion');

                    }

                }else{
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                            redirect('admin/promotion/edit_promotion/'.$id);
                }



            }else{

                $data=array(
                        'from_date'=>$start_date,
                        'to_date'=>$end_date,
                    );

                $check_name = $this->Promotion_model->edit_promotion($data,$id);

                if($check_name){
                   
                    $this->session->set_flashdata('message', 'Promotion Updated Successfully');
                        redirect('admin/promotion/list');
                }else{
                   
                   $this->session->set_flashdata('message', 'Promotion Name Already Exist');
                        redirect('admin/promotion/edit_promotion');

                }

            }
        }

        public function add_promotion1()
        {
            $start_date=$this->input->post('start_date');
            $end_date=$this->input->post('end_date');
            $postdata=$this->input->post();

            $data=array(
                        'offer_image'=>file_get_contents($_FILES['imgInp']['tmp_name']),
                        'from_date'=>$start_date,
                        'to_date'=>$end_date,

                    );

            $check_name = $this->Promotion_model->add_promotion($data);

            if($check_name){
               
                $this->session->set_flashdata('message', 'Promotion Created Successfully');
                    redirect('admin/promotion/list');
            }else{
               
               $this->session->set_flashdata('message', 'Promotion Name Already Exist');
                    redirect('admin/promotion/create_promotion');

            }

        }

        public function add_promotion()
        {
            $start_date=$this->input->post('start_date');
            $end_date=$this->input->post('end_date');
            $postdata=$this->input->post();

            $dir_path=$_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/uploads/promotion';

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
                        'offer_image'=>file_get_contents($_FILES['imgInp']['tmp_name']),
                        'from_date'=>$start_date,
                        'to_date'=>$end_date,

                    );


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

                    $check_name = $this->Promotion_model->add_promotion($data);

                    if($check_name){
                       
                        $this->session->set_flashdata('message', 'Promotion Created Successfully');
                            redirect('admin/promotion/list');
                    }else{
                       
                       $this->session->set_flashdata('message', 'Promotion Name Already Exist');
                            redirect('admin/promotion/create_promotion');

                    }

                }else{
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                            redirect('admin/promotion/create_promotion');
                }
            
                //$this->session->set_flashdata('message', 'Pmkit Image Added Successfully');
                  //redirect('admin/pmkit');

            }
        }


        public function edit_mapping($modelno){
            $selectedkit = array();
            $selectedkitmapping = array();
            $getallModel = $this->Pmkit_model->getModel();
            $getpmkitList = $this->Pmkit_model->getpmkitList();
            $getPmkit = $this->Pmkit_model->getPmkitByModelID($modelno); 
            $getmapingpmkit = $this->Pmkit_model->getUniqueModel(); 

            if(!empty($getmapingpmkit)){

                foreach($getmapingpmkit as $getPmkits){

                    $selectedkitmapping[]= $getPmkits->machinemodel_material_no;
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
									$bulk_upload= $this->Pmkit_model->bulk_mapping($data,$model_no,$pmkit_no); 

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
				$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv';
				$config['allowed_types'] = 'xlsx|csv|xls';
				$config['overwrite'] = true;
				$config['encrypt_name'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('uploadfile')) {
					$path = $_SERVER["DOCUMENT_ROOT"].'/gcpl/pmkit/assets/csv/'.$filename;
				 	$object = PHPExcel_IOFactory::load($path);
					 $isSuccessfullyInserted = false;
					foreach($object->getWorksheetIterator() as $worksheet) {
                        
							$highestRow = $worksheet->getHighestRow();
							$highestColumn = $worksheet->getHighestColumn();

							for($row=2; $row<=$highestRow; $row++) {
								    $machine_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								    $display_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
								
									$data=array(
										'machine_id'=>$machine_id,
										'display_name'=>$display_name,
                                    );

									$bulk_model= $this->Pmkit_model->bulk_upload_model($data,$machine_id); 

                            }
        
                    }

					if ($bulk_model)
					$this->session->set_flashdata('message', "Upload Models Successfully");
				    else 
					$this->session->set_flashdata('message', $this->upload->display_errors());
					 
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename)) {
							$path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename;
							unlink($path);
					}
				 }

				 else 
					 $this->session->set_flashdata('message', $this->upload->display_errors());
					 redirect("/admin/pmkit");
			 }
			 
        }
        
        public function insert_image($pmkitno)
        {
            $postdata=$this->input->post();

            $dir_path=$_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/uploads/logo';

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
                        'material_number'=>$pmkitno,
                        'thumbnail'=>$filename,
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
                }else{
                    $result = array("status"=>false, "type"=>"verror", "message"=>$this->upload->display_errors());
                }
            
                $this->session->set_flashdata('message', 'Pmkit Image Added Successfully');
                  redirect('admin/pmkit');

            }
        }





	}

	?>