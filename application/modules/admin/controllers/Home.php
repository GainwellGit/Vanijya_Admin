<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
		
			$this->load->model('authentication_model');
			$this->load->model('home_model');
			$this->load->model('Pmkit_model');
			$this->load->model('Cart_sharing');
			
			$this->usersessiondata = $this->session->userdata('logged_in'); 		
			if(empty($this->usersessiondata)){

				
				redirect(base_url().'admin/authentication/login'); 
			}
			
 
       }
	   
	    public function index(){
		   
		        $data['customer'] = $this->home_model->count_customer();
				$data['totalLocation'] = $this->home_model->count_location();
				$data['totalgroup'] = $this->home_model->count_group();
				$data['totalzone'] = $this->home_model->count_zone();
				$data['totalmapping'] = $this->home_model->count_mapping();
				$data['totalpromotion'] = $this->home_model->count_promotion();
				$data['orderReconciliation'] = $this->home_model->count_order_reconciliation();
				
				$data['shared_cart'] = $this->Cart_sharing->get_cart_shared();
				$data['used_shared_cart'] = $this->Cart_sharing->get_cart_shared_used();


				$this->load->ftemplate('home',$data);
		}
		
		public function email(){

        	$getEmail = $this->home_model->get_email();

            $data['email'] = $getEmail;

			$this->load->ftemplate('email_list',$data);
        }

         public function log(){

        	 $dir = 'C:/mobileapp-nodejs-api/';
        	 $response = array();
			  // Check if the directory exists
			  if (file_exists($dir) && is_dir($dir) ) {
			    
			      // Get the files of the directory as an array
			      $scan_arr = scandir($dir);
			      $files_arr = array_diff($scan_arr, array('.','..') );
			      // echo "<pre>"; print_r( $files_arr ); echo "</pre>";
			      // Get each files of our directory with line break
			      foreach ($files_arr as $file) {
			        //Get the file path
			        $file_path = "C:/mobileapp-nodejs-api/".$file;
			        // Get the file extension
			        $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
			        if ($file_ext=="csv") {
			          //echo $file.date ("Y-m-d.", filemtime($file_path))."<br/>";

			          $data['file']= $file;
			          $data['date']=date ("Y-m-d", filemtime($file_path));
			          $response[]=$data;
			        }
			        
			      }
			  }
			  else {
			    $response[]='';
			  }

			 

            $data['log'] = $response;

			$this->load->ftemplate('log_list',$data);
        }

         public function download_log($file)
        {
            $file_url ="C:/mobileapp-nodejs-api/".$file;
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
            readfile($file_url);
        }
		
		public function filelist(){
			
			$allFilesList= glob('D:/GWApps/gcpl/PMKit/upload/*');
			
		}
		
		public function changestatus(){

            $email=$this->input->post('email');
            $chageStatus = $this->home_model->statusChange($email);
            
            $response['success']='true';
            return $response;

        }
		
		public function insert_email(){

        	$name = $this->input->post('name');
			$email = $this->input->post('email');

			$data=array(
                        'full_name'=>$name,
                        'email'=>$email,
                        'active'=>'1',
                    );

            $check_email = $this->home_model->check_mail($email);
            if($check_email){
                       
                $this->session->set_flashdata('error', 'Email Already Exist.');
                    redirect('admin/home/email');
            }else{


            	$insert_email = $this->home_model->insert_mail($data);
               
               $this->session->set_flashdata('message', 'Email Insert Successfully');
                    redirect('admin/home/email');

            }

        }
		

		


      
		public function userlisting(){
			
			$data['user_details'] =$this->home_model->getuserdetails();
			$this->load->ftemplate('userlist',$data);
			
			}
			public function change_status($user_id) {
			if($this->input->is_ajax_request()){
			 $user_id = $this->input->post('user_id');
			 $status = $this->input->post('status');
			 
			$query=$this->home_model->update_status($user_id,$status);
				if(!empty($query)){				
				$response['success'] = 1;
				$response['error'] = 0;
				$response['details'] = $query;
				$this->session->set_flashdata('msg',"Status Updated Successfully"); 
			}else{
				$response['success'] = 0;
				$response['error'] = 1;
				$response['details'] = $query;
				$this->session->set_flashdata('msg',"Status Not Updated"); 

			}
		
			echo json_encode($response);
			exit(0);
			
			}
			
		}

		public function machine_model(){

            $data['machine_model'] =$this->home_model->get_machine_model();
			$this->load->ftemplate('machine_model_master',$data);

		}


		public function material_bom(){

			//SELECT pmkit_material_no,COUNT(DISTINCT bom_material_no) FROM `material_bom_master` GROUP BY pmkit_material_no

            $data['material_bom'] =$this->home_model->get_material_bom();

			$this->load->ftemplate('material_bom_master',$data);

		}


		public function material(){

            $data['material'] =$this->home_model->get_material();
			$this->load->ftemplate('material_master',$data);

		}
		public function machine_model_list(){
			// $data['machine_model_list'] =$this->home_model->get_machine_model_list();
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
            $data['finalArray']=$finalArray;
			$this->load->ftemplate('machine_model_list',$data);
		}
		
		public function machine_model_edit($modelno){
			$modelno = str_ireplace("%20"," ",$modelno);
			
            $selectedkit = array();
			$getPmkit = $this->Pmkit_model->getPmkitByModelID($modelno);
            /*$selectedkitmapping = array();
            $getallModel = $this->Pmkit_model->getModel();
            $getpmkitList = $this->Pmkit_model->getpmkitList();
            $getPmkit = $this->Pmkit_model->getPmkitByModelID($modelno); 
            $getmapingpmkit = $this->Pmkit_model->getUniqueModel();
			
            $getModelById = $this->Pmkit_model->getModelByID($modelno); 

            if(!empty($getmapingpmkit)){

                foreach($getmapingpmkit as $getPmkits){

                    $selectedkitmapping[]= $getPmkits->material_no;
                }
            }*/
            
            if(!empty($getPmkit)){

                foreach($getPmkit as $getPmkits){

                    $selectedkit[]= $getPmkits->pmkit_material_no;
                }
            }

            /*$A = array($modelno);

            $clean1 = array_diff($A, $selectedkitmapping); 
            $clean2 = array_diff($selectedkitmapping, $A); 
            $final_output = array_merge($clean1, $clean2);*/
          
            $data['getPmkit'] = $selectedkit;
			$data['modelno'] = $modelno;
			$data['pmkitimage'] = $getPmkit;
            /*$data['selectedkitmapping'] = $final_output;
            $data['models'] = $getallModel;
            $data['pmkit'] = $getpmkitList;
            $data['pmkitimage'] = $getPmkit;
            $data['getModelById'] = $getModelById;*/
			//echo '<pre>';print_r($data);die();
			$this->load->ftemplate('bulk_image_upload',$data);
		}
		public function bulk_image_submit(){
			$postdata=$this->input->post('modelno');
			$selectedkit = array();
			$getPmkit = $this->Pmkit_model->getPmkitByModelID($postdata);
            
            if(!empty($getPmkit)){

                foreach($getPmkit as $getPmkits){

                    $selectedkit[]= $getPmkits->pmkit_material_no;
                }
            }

			// If files are selected to upload 
            if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
                $filesCount = count($_FILES['files']['name']); 
                for($i = 0; $i < $filesCount; $i++){ 
                    $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                    $_FILES['file']['error']    = $_FILES['files']['error'][$i]; 
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 

					$file_name = explode('.',$_FILES['files']['name'][$i]);

					if(in_array($file_name[0], $selectedkit)){
                     
						// File upload configuration
						$uploadPath = 'upload/'.$postdata; 
						$config['upload_path'] = $uploadPath; 
						$config['allowed_types'] = 'jpg|jpeg|png'; 
						$config['remove_spaces'] = FALSE;
						//$config['max_size']    = '100'; 
						//$config['max_width'] = '1024'; 
						//$config['max_height'] = '768'; 
						
						$fileName = basename($_FILES['file']['name']); 
						$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
								
						// Allow certain file formats 
						$allowTypes = array('jpg','png','jpeg'); 
						if(in_array($fileType, $allowTypes)){

							if(!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, TRUE);}

							// Load and initialize upload library 
							$this->load->library('upload', $config); 
							$this->upload->initialize($config); 
						
							// Upload file to server 
							if($this->upload->do_upload('file')){ 
								// Uploaded file data 
								$fileData = $this->upload->data(); 
								$uploadData[$i]['file_name'] = $fileData['file_name']; 
								$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s"); 

								// Insert image content into database 
								$data=array(
									//'material_number'=>"CAT- NR1804",
									'material_number'=>"$file_name[0]",
									'thumbnail'=>file_get_contents($_FILES['file']['tmp_name']),
								);
			
								//$insert=$this->Pmkit_model->addimaghedata($data,'CAT- NR1804');
								$insert=$this->Pmkit_model->addimaghedata($data,"$file_name[0]"); 
								if($insert){ 
									$status = 'success'; 
									unlink($fileData['full_path']);
									$statusMsg = "File uploaded successfully.";
								}else{ 
									$statusMsg = "File upload failed, please try again."; 
								}
							}else{  
								$errorUploadType .= $_FILES['file']['name'].' | ';  //echo $errorUploadType;die('321');
								$statusMsg = "Sorry, there was an error uploading your file: ".$errorUploadType;
							}
						}else{ 
							$statusMsg = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.'; 
						}
					} else {
						$statusMsg = "Sorry, this material ".$_FILES['files']['name'][$i]." is not for Model No: ".$postdata; 
					}
                }
            }else{ 
                $statusMsg = 'Please select image files to upload.'; 
            }
          
			$dir ='upload/'.$postdata; // dir path assign here
			$q = (count(glob("$dir/*")) === 0) ? 'Empty' : 'Not empty';
			
			if ($q == "Empty") { 
				rmdir($dir); // Delete the folder
			}
			else
				die("the folder is NOT empty");

			
			//$this->load->view('bulk_image_upload', $statusMsg);
			//$this->load->ftemplate('bulk_image_upload',$statusMsg);
			$this->session->set_flashdata('bulkimg_success',$statusMsg);
			$this->load->helper('url');
			redirect('admin/home/machine_model_edit/'.$postdata, 'refresh');
		}


 		public function serverlog(){
 			$start_date 	 = $this->input->post('start_date');
			$end_date 		 = $this->input->post('end_date');
			//var_dump($start_date);
			//die('w');
			if ( !empty($start_date) && !empty($end_date) ) {
				// code...
            	$data['server_log'] = $this->home_model->get_server_log($start_date,$end_date);
            	$data['start_date'] = $start_date;
            	$data['end_date'] 	= $end_date;
			}else{
				$data['server_log'] = '';
			}
			//var_dump($data);
			//die('w');
			$this->load->ftemplate('serverlog',$data);

		}
		public function material_display_name(){
 			$display_name 	 = $this->input->post('display_name');
 			$material_number 	 = $this->input->post('material_number');
			//var_dump($start_date);
			//die('w');
			$request = array();
			if ( !empty($display_name) && !empty($material_number) ) {
				// code...
            	$data_1 = $this->home_model->save_display_name($display_name,$material_number); 
            	$request = array('success'=>true , 'data' => $data_1);     
			}else{
            	$request = array('success'=>false , 'data' => 'Empty values' , 'display_name'=> $display_name , 'material_number'=> $material_number);     

			}
			$response = json_encode($request);
			header('Content-Type: application/json');
			echo $response;
		}

		
		public function cart_shared(){

            $data['cart_shared'] =$this->Cart_sharing->get_all_cart_shared();
			$this->load->ftemplate('cart_shared',$data);

		}
		
		public function shared_cart_used(){

            $data['cart_shared'] =$this->Cart_sharing->get_all_cart_shared_used();
			$this->load->ftemplate('cart_shared_used',$data);

		}
		
	}
?>