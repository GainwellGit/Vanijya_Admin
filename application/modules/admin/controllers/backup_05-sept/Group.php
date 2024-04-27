<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Group extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('group_model');
				$this->load->model('Coupon_model');
				$this->load->library('excel');
				
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function index()
		{
			$this->load->ftemplate('grouplist');
		}

		public function coupon()
		{
			$getallGroup = $this->group_model->getAllGroup();
			$getExceptionList = $this->group_model->getExceptionData();
			$userlist = array();
			foreach ($getallGroup as $key=>$groups) {
				$user_coupon_list='';

				$group_id = $groups['group_code'] ;


				$user_coupon_list = $this->group_model->getgroupcoupon($group_id);
				

				$user['group_id']=$groups['group_code'];
				$user['code']=$groups['group_code'];
                $user['name']=$groups['group_description'];
                $user['coupon_code']=isset($user_coupon_list->promocode) ? $user_coupon_list->promocode : '' ;
                $user['coupon_type']=isset($user_coupon_list->type) ? $user_coupon_list->type : '' ;
                $user['coupon_ammount']=isset($user_coupon_list->discount_value) ? $user_coupon_list->discount_value : '' ;
				$user['min_ammount']=isset($user_coupon_list->min_ammount) ? $user_coupon_list->min_ammount : '' ;
				$user['valid_from']=isset($user_coupon_list->from_date) ? $user_coupon_list->from_date : '' ;
                $user['valid_to']=isset($user_coupon_list->to_date) ? $user_coupon_list->to_date : '' ;
                $user['is_delete']=isset($user_coupon_list->is_delete) ? $user_coupon_list->is_delete : '' ;


                $userlist[$key] = $user;
			}

			
			$data['userlist'] = $userlist;
			$data['exceptionList']=$getExceptionList;
	
			$this->load->ftemplate('groupcouponlist',$data);
		}

		public function view($group_id) 
		{   
			$today = new DateTime();
            $compare = $today->format('Y-m-d');
			$user_coupon_list = $this->group_model->getgroupcoupondetails($group_id);
			$to_date = isset($user_coupon_list->to_date) ? $user_coupon_list->to_date : '';
			$group_description = isset($user_coupon_list->group_description) ? $user_coupon_list->group_description : '';
			$group_code = isset($user_coupon_list->group_code) ? $user_coupon_list->group_code : '';
			$checkDelete = isset($user_coupon_list->is_delete) ? $user_coupon_list->is_delete : '';
			if($to_date < $compare || $checkDelete == '1'){
				$user_coupon_list = array();
			}
			$get_discount_type = $this->Coupon_model->get_discount_type();
			$data['usercoupon'] = $user_coupon_list;
			$data['type'] = $get_discount_type;
			$data['group_description'] = $group_description;
            $data['group_code'] = $group_code;
			$this->load->ftemplate('groupcouponview',$data);
		}

		public function download_excel()
		{
			$file_url =$_SERVER["DOCUMENT_ROOT"]."/gcpl/PMKit/assets/csv/sample_group.xls";
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
			readfile($file_url);
		}

		public function muliplequiz() {
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
								$code = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								$name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
								$data=array(
									'group_code'=>$code,
									'group_name'=>$name,
									'is_active'=>1,
        	                        'date_created'=>date('Y-m-d H:i:s')
								);
								$bulk_upload= $this->group_model->bulk_upload($data,$code);

							}
					}

					if ($bulk_upload)
					$this->session->set_flashdata('message', "Group Added Successfully");
				    else 
					$this->session->set_flashdata('message', $this->upload->display_errors());
					 
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename)) {
							$path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename;
							unlink($path);
					}
				 }

				 else 
					 $this->session->set_flashdata('message', $this->upload->display_errors());
					 redirect("/admin/Group");
			 }
			 
		 }

		 public function bulk_promocode() {
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
								$group_code = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								$discount_type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
								$discount_value = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
								$min_ammount = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
								$from_date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
								$to_date = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

								$get_group_id = $this->group_model->get_group_row($group_code,$row);
								$group_id = isset($get_group_id->group_code) ? $get_group_id->group_code : '';

                                $code =  'MGCPL'.rand ( 1000 , 9999).date("s");

								$date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
								$valid_from= gmdate("Y-m-d", $date_from); //date
								
								$date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                                $valid_to= gmdate("Y-m-d", $date_to); //date

			                    if($group_id !=''){
									$data=array(
										'discount_category'=>'3',
										'discount_type'=>$discount_type,
										'discount_value'=>$discount_value,
										'min_ammount' => $min_ammount,
										'from_date'=>$valid_from,
										'to_date'=>$valid_to,
										'promocode'=>$code,
										'discount_on'=> $group_code,
										'created_date'=>date('Y-m-d'),
										'source_ip'=>$this->input->ip_address()
									);
									$bulk_upload= $this->group_model->insert_coupon_excel($data,$group_id,$valid_from,$valid_to,$row);
								}		

							}
					}

					if ($bulk_upload)
					$this->session->set_flashdata('message', "Material Group Discount Updated Successfully");
				    else 
					$this->session->set_flashdata('message', $this->upload->display_errors());
					 
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename)) {
							$path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename;
							unlink($path);
					}
				 }

				 else 
					 $this->session->set_flashdata('message', $this->upload->display_errors());
					 redirect("/admin/material_group");
			 }
			 
		}

		public function download_promoexcel()
		{
			$file_url =$_SERVER["DOCUMENT_ROOT"]."/gcpl/PMKit/assets/csv/group_promocode.xls";
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
			readfile($file_url);
		}

		public function generatecode()
		{
			if($this->input->is_ajax_request()){
	        	$group_id = $this->input->post('group_id');

	        	//$getuser = $this->group_model->getgroupById($group_id);

	        	//$fname = isset($getuser->group_name) ? substr($getuser->group_name, 0,2) : 'code';
				//$uppername = strtoupper($fname);

                $code =  'MGCPL'.rand ( 1000 , 9999).date("s");

	        	if($code){
	        		$data['success'] = 1;
	        		$data['code'] = $code;
	        	}
	        	else{
	        		$data['success'] = 0;
	        	}
	        	echo json_encode($data);
	        	exit(0);
	        }
		}

		public function updatecoupon()
		{
			$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

             if(isset($_POST['delete'])){
				$group_auto_id=$this->input->post('group_auto_id');
				$group_delete= $this->group_model->delete_coupon($group_auto_id);

			    $this->session->set_flashdata('success','Material Group  Discount Updated Successfully');
				redirect('/admin/material_group');

            }else{

	            $g_id=$this->input->post('group_id');
	            $code=$this->input->post('code');
			    $type=$this->input->post('type');
				$ammount=$this->input->post('ammount');
				$min_ammount=$this->input->post('min_ammount');
				$ip = $this->input->ip_address();

				$date_from=date_create($this->input->post('valid_from'));
	            $valid_from =  date_format($date_from,"Y-m-d");

	            $date_to=date_create($this->input->post('valid_to'));
	            $valid_to =  date_format($date_to,"Y-m-d");

	            $this->form_validation->set_rules('code', 'Code', 'required');
	            $this->form_validation->set_rules('type', 'Type', 'required');
	            $this->form_validation->set_rules('ammount', 'Ammount', 'required');

	            if ($this->form_validation->run() == true)
	            {
						$data=array(
						'discount_on'=>$g_id,
						'promocode'=>$code,
						'discount_type'=>$type,
						'discount_value'=>$ammount,
						'min_ammount'=>$min_ammount,
						'from_date'=>$this->input->post('valid_from'),
						'to_date'=>$this->input->post('valid_to'),
						'discount_category'=>3,
						'created_date'=>date('Y-m-d'),
						'source_ip'=>$ip
						);

				        $faq_content= $this->group_model->insert_coupon($data,$g_id);

				        $this->session->set_flashdata('success','Material Group  Discount Updated Successfully');
						redirect('/admin/material_group');
	            }
	        }
        }

	    public function addgroup()
		{
			$postdata=$this->input->post();
			$group_title=$this->input->post('groupname');
			$group_code=$this->input->post('groupcode');
			$this->form_validation->set_rules('groupname','Group Name','required'); 
			$this->form_validation->set_rules('groupcode','Group Code','required'); 
			
        	if($this->form_validation->run() == true)
	         {
	        	$data=array(
					        'group_code'=>$group_code,
        		            'group_name'=>$group_title,
        		            'is_active'=>1,
        	                'date_created'=>date('Y-m-d H:i:s')
        	                );
	            
					$p = $this->group_model->addgroupdata($data);
					$this->session->set_flashdata('message', 'Group Added Successfully');
		              redirect('admin/group');

		    }
		    else
		    {
		     $result = array("status" =>false, "type"=>"verror", "message" =>validation_errors());
		    }
		    
		}

		public function group_list()
		{
			$list = $this->group_model->get_datatables();
				$data = array();
				$no = $_POST['start'];

				foreach ($list as $group) {
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $group->group_code;
					$row[] = ucfirst($group->group_name);
						
					$row[] = $group->is_active;
					$date = (isset($group->date_created) && ($group->date_created!='')) ? date_format(date_create($group->date_created),"Y-m-d") : '';
					$row[] = $date;
					$row[] = $group->id;
		
					$data[] = $row;
				}
				/*print_r($data);die;*/
		
				$output = array(
								"draw" => $_POST['draw'],
								"recordsTotal" => $this->group_model->count_all(),
								"recordsFiltered" => $this->group_model->count_filtered(),
								"data" => $data,
						);
				//output to json format
				echo json_encode($output);   
		}

		public function groupstatuschk()
        {
        	if($this->input->is_ajax_request()){
	        	$data['groupid'] = $this->input->post('group_id');
	        	$data['status_chk'] = $this->input->post('status_chk');

	        	$groupstatuschk = $this->group_model->groupstatus($data);

	        	if($groupstatuschk){
	        		$data['success'] = 1;
	        		$data['message'] = 'Group Status Updated Successfully.';
	        	}
	        	else{
	        		$data['success'] = 0;
	        	}
	        	echo json_encode($data);
	        	exit(0);
	        }
        }


        public function edit_group()
		 {
		 	$data=array();
		 	$id=$_POST['id'];
		 	$datanew=$this->group_model->edit_groupModel($id);
		 	echo json_encode($datanew);
		 }
          public function editgroup($id)
		 {
          $postdata=$this->input->post();
			$group_title=$this->input->post('groupname');
			$group_code=$this->input->post('groupcode');
			$this->form_validation->set_rules('groupname','Group Name','required'); 
			$this->form_validation->set_rules('groupcode','Group Code','required'); 
          if($this->form_validation->run() == true)
	        {
	        	$data=array(
					        'group_code'=>$group_code,
        		            'group_name'=>$group_title,
        		            'is_active'=>1,
        	                'date_created'=>date('Y-m-d H:i:s')
        	                );
	            
					$p = $this->group_model->updategroupdata($data,$id);
					$this->session->set_flashdata('message', 'Group Editted Successfully');
		              redirect('admin/group');

				}else{
	        	$result = array("status" =>false, "type"=>"verror", "message" =>validation_errors());
	        } 
		 }

		 public function groupdelete()
        {
        	if($this->input->is_ajax_request()){
	        	$groupid = $this->input->post('group_id');

	        	$isgroupdelete = $this->group_model->groupdelete($groupid);
	        	if($isgroupdelete)
	        	{
	        		$this->session->set_flashdata('success', 'Group Deleted Successfully.');
	        		$data['success'] = 1;
	        	}
	        	else{
	        		$data['success'] = 0;
	        	}
	        	echo json_encode($data);
	        	exit(0);
	        }
        }

        public function getgroup()
        {
        	$quizid=$this->input->post('quizid');

        	$grouplist=$this->group_model->listgroup($quizid);
        	if(!empty($grouplist) && isset($grouplist))
        	{
        		$data['isgrouplist']=$grouplist;
        		$data['success'] = 1;

        	}
        	else{
        		$data['success'] = 0;
        	}
        	echo json_encode($data);
	        	exit(0);
        }



	}

	?>