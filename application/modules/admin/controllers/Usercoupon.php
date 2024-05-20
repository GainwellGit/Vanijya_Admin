<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usercoupon extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('Coupon_model');
				$this->load->library('excel');
				
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function index()
		{

			$getExceptionList = $this->Coupon_model->getExceptionData();


			//  $getallUserData = $this->Coupon_model->getAllUserData();

		 // print_r($getallUserData);
			//  die;

			// $getallUser = $this->Coupon_model->getAllUser();
			// $userlist = array();

			// foreach ($getallUser as $key=>$users) {
			// 	$user_coupon_list='';

			// 	$user_id = $users['customer_code'] ;

			// 	$user_coupon_list = $this->Coupon_model->getusercoupon($user_id);

   //              $user['users_id']=$users['customer_code'];
   //              $user['first_name']=$users['name1'];
   //              $user['customer_code']=$users['customer_code'];
   //              $user['coupon_code']=isset($user_coupon_list->promocode) ? $user_coupon_list->promocode : '' ;
   //              $user['coupon_type']=isset($user_coupon_list->type) ? $user_coupon_list->type : '' ;
			// 	$user['coupon_ammount']=isset($user_coupon_list->discount_value) ? $user_coupon_list->discount_value : '' ;
			// 	$user['min_ammount']=isset($user_coupon_list->min_ammount) ? $user_coupon_list->min_ammount : '' ;
   //              $user['valid_from']=isset($user_coupon_list->from_date) ? $user_coupon_list->from_date : '' ;
   //              $user['valid_to']=isset($user_coupon_list->to_date) ? $user_coupon_list->to_date : '' ;

   //              $userlist[$key] = $user;
			// }

			// $data['userlist'] = $userlist;

			$data['exceptionList']=$getExceptionList;
	
			$this->load->ftemplate('usercouponlist',$data);
		}


		public function all_user_list(){ 

			$list = $this->Coupon_model->get_datatables();
				$data = array();
				$no = $_POST['start'];
				$today = new DateTime();
                $compare = $today->format('Y-m-d');
                $count =1;
				foreach ($list as $group) {
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $group->customer_code;
					$row[] = $group->name1;
					if($group->to_date >= $compare && $group->is_delete != '1')	{
						$row[] = $group->promocode ; 
						$row[] = ($group->type =='VALUE') ? 'RS '.$group->discount_value : $group->discount_value . $group->type;
						$row[] = $group->min_ammount;
						$date=date_create($group->from_date);
						$row[] = ($group->from_date !='') ? date_format($date,"jS F, Y") : '';
						$valid_to=date_create($group->to_date);
						$row[] = ($group->to_date !='') ? date_format($valid_to,"jS F, Y") : '';
						$row[] =  $group->title ;
				    }else{

				    	$row[] = ''; 
						$row[] = '';
						$row[] = '';
						$row[] = '';
						$row[] = '';
				    }

					$row[] = $group->customer_code;
		
					$data[] = $row;

					$count++;
				}
		
				$output = array(
								"draw" => $_POST['draw'],
								"recordsTotal" => $this->Coupon_model->count_all(),
								"recordsFiltered" => $this->Coupon_model->count_filtered(),
								"data" => $data,
						);
				//output to json format
				echo json_encode($output); 
		}

        public function view($user_id)
		{
			$today = new DateTime();
            $compare = $today->format('Y-m-d');
			$user_coupon_list = $this->Coupon_model->getusercoupondetails($user_id);
			$to_date = isset($user_coupon_list->to_date) ? $user_coupon_list->to_date : '';
			$name1 = isset($user_coupon_list->name1) ? $user_coupon_list->name1 : '';
			$customer_code = isset($user_coupon_list->customer_code) ? $user_coupon_list->customer_code : '';
			$checkDelete = isset($user_coupon_list->is_delete) ? $user_coupon_list->is_delete : '';
            if($to_date < $compare || $checkDelete == '1'){
				$user_coupon_list = array();
			}

			
			$get_discount_type = $this->Coupon_model->get_discount_type();
			$data['usercoupon'] = $user_coupon_list;
			$data['type'] = $get_discount_type;
			$data['name1'] = $name1;
			$data['customer_code'] = $customer_code;
			//$data['title'] = $title;

			$this->load->ftemplate('usercouponview',$data); 
		}

		public function updatecoupon()
		{
			$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            if(isset($_POST['delete'])){
				$customer_auto_id=$this->input->post('user_auto_id');
				$customer_delete= $this->Coupon_model->delete_coupon($customer_auto_id);

			    $this->session->set_flashdata('success','Customer Discount Updated Successfully');
				redirect('/admin/customer');

            }else{

	            $user_id=$this->input->post('user_id');
	            $code=$this->input->post('code');
			    $type=$this->input->post('type');
				$ammount=$this->input->post('ammount');
				$min_ammount=$this->input->post('min_ammount');
				$ip = $this->input->ip_address();

				$date_from=date_create($this->input->post('valid_from'));
	            $valid_from =  date_format($date_from,"Y-m-d");

	            $date_to=date_create($this->input->post('valid_to'));
	            $valid_to =  date_format($date_to,"Y-m-d");
	            $title = $this->input->post('title');
	            
	            $this->form_validation->set_rules('code', 'Code', 'required');
	            $this->form_validation->set_rules('type', 'Type', 'required');
	            $this->form_validation->set_rules('ammount', 'Ammount', 'required');

	           

	            if ($this->form_validation->run() == true)
	            {
	                    $data=array(
	 						'discount_on'=>$user_id,
	                    	'promocode'=>$code,
						    'discount_type'=>$type,
							'discount_value'=>$ammount,
							'min_ammount'=>$min_ammount,
						    'from_date'=>$this->input->post('valid_from'),
						    'to_date'=>$this->input->post('valid_to'),
							'discount_category'=>1,
							'created_date'=>date('Y-m-d'),
							'source_ip'=>$ip,
							'title'=>$title
							
	                      );

				        $faq_content= $this->Coupon_model->insert_coupon($data,$user_id);

				        $this->session->set_flashdata('success','Customer Discount Updated Successfully');
						redirect('/admin/customer');
	            }

	        }
		}

		public function bulk_promocode() {
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
								$customer_code = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								$discount_type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
								$discount_value = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
								$min_ammount = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

								$from_date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
								$to_date = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
								$get_customer_id = $this->Coupon_model->get_customer_id($customer_code,$row);
								$customer_id = isset($get_customer_id->id) ? $get_customer_id->id : '';
								$customer_code = isset($get_customer_id->customer_code) ? $get_customer_id->customer_code : '';

                                $code =  'CGCPL'.rand ( 1000 , 9999).date("s");

								$date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
								$valid_from= gmdate("Y-m-d", $date_from); //date
								
								$date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                                $valid_to= gmdate("Y-m-d", $date_to); //date

			
								if($customer_id !=''){
									
									$data=array(
										'discount_category'=>'1',
										'discount_type'=>$discount_type,
										'discount_value'=>$discount_value,
										'min_ammount' => $min_ammount,
										'from_date'=>$valid_from,
										'to_date'=>$valid_to,
										'promocode'=>$code,
										'discount_on'=> $customer_code,
										'created_date'=>date('Y-m-d'),
										'source_ip'=>$this->input->ip_address()
									);
									$bulk_upload= $this->Coupon_model->insert_coupon_excel($data,$customer_code,$valid_from,$valid_to,$row);


								}

							}
					}



					if ($bulk_upload)
					$this->session->set_flashdata('message', "Customer Discount Updated Successfully");
				    else 
					$this->session->set_flashdata('message', $this->upload->display_errors());
					 
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename)) {
							$path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/pmkit/assets/csv/'.$filename;
							unlink($path);
					}
				 }

				 else 
					 $this->session->set_flashdata('message', $this->upload->display_errors());
					 redirect("/admin/customer");
			 }
			 
		}

		public function download_excel()
		{
			$file_url =$_SERVER["DOCUMENT_ROOT"]."/gcpl/pmkit/assets/csv/customer_promocode.xls";
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
			readfile($file_url);
		}

	
		public function generatecode()
		{
			if($this->input->is_ajax_request()){
	        	$user_id = $this->input->post('user_id'); 

	        	//$getuser = $this->Coupon_model->getuserById($user_id);
	        	//$fname = isset($getuser->name1) ? substr($getuser->name1, 0,2) : 'code';
				//$uppername = strtoupper($fname);

                $code =  'CGCPL'.rand ( 1000 , 9999).date("s");

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


		


	}

	?>