<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Location extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('Location_model');
				$this->load->model('Coupon_model');
				$this->load->library('excel');
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function index()
		{
			$getlocation = $this->Location_model->getAllLocation(); 
			$getExceptionList = $this->Location_model->getExceptionData();

			$location_list = array();

			foreach ($getlocation as $key=>$location) {
				$location_coupon_list='';

				$location_id = $location['region_code'] ;

				$location_coupon_list = $this->Location_model->getlocationcoupon($location_id);

                $location['users_id']=$location['region_code'];
                $location['first_name']=$location['region_description'];
                $location['customer_code']=$location['region_code'];
                $location['coupon_code']=isset($location_coupon_list->promocode) ? $location_coupon_list->promocode : '' ;
                $location['coupon_type']=isset($location_coupon_list->type) ? $location_coupon_list->type : '' ;
                $location['coupon_ammount']=isset($location_coupon_list->discount_value) ? $location_coupon_list->discount_value : '' ;
				$location['min_ammount']=isset($location_coupon_list->min_ammount) ? $location_coupon_list->min_ammount : '' ;
				$location['valid_from']=isset($location_coupon_list->from_date) ? $location_coupon_list->from_date : '' ;
                $location['valid_to']=isset($location_coupon_list->to_date) ? $location_coupon_list->to_date : '' ;
                $location['is_delete']=isset($location_coupon_list->is_delete) ? $location_coupon_list->is_delete : '' ;

                $location_list[$key] = $location;
			}


			$data['locationlist'] = $location_list;
			$data['exceptionList']=$getExceptionList;
	
			$this->load->ftemplate('regionlist',$data);
		}

		public function flat(){

			$getzonecoupon = $this->Location_model->getAllZone();

			$data['zonecoupon'] = $getzonecoupon;
			$this->load->ftemplate('flatlistzone',$data);
		}

		public function zone($getzone){

			$zone = str_replace('_', ' ', $getzone);
			
			$today = new DateTime();
            $compare = $today->format('Y-m-d');
			$getzonedata = $this->Location_model->getZonedata($zone);
			
			$to_date = isset($getzonedata->to_date) ? $getzonedata->to_date : '';
			$z_id = isset($getzonedata->id) ? $getzonedata->id : '';
			if($to_date < $compare){
				$getzonedata = array();
			}
			$get_discount_type = $this->Coupon_model->get_discount_type();
			$get_location_by_zone = $this->Location_model->get_location_by_zone($zone,$to_date);
            $data['type'] = $get_discount_type;
			$data['zonecoupon'] = $getzonedata;
			$data['get_location_by_zone'] = $get_location_by_zone;
			$data['zone_to_date'] = $to_date;
			$data['zone_name'] = $zone;
			$data['z_id'] = $z_id;
			$this->load->ftemplate('flatlistzoneview',$data);
		}


        public function view($location_id)
		{
			$today = new DateTime();
            $compare = $today->format('Y-m-d');
			$location_coupon_list = $this->Location_model->getlocationcoupondetails($location_id);
			$to_date = isset($location_coupon_list->to_date) ? $location_coupon_list->to_date : '';
			$region_description = isset($location_coupon_list->region_description) ? $location_coupon_list->region_description : '';
			$region_code = isset($location_coupon_list->region_code) ? $location_coupon_list->region_code : '';
			$checkDelete = isset($location_coupon_list->is_delete) ? $location_coupon_list->is_delete : '';
			if($to_date < $compare || $checkDelete == '1'){
				$location_coupon_list = array();
			}
			$get_discount_type = $this->Coupon_model->get_discount_type();
			$data['locationcoupon'] = $location_coupon_list;
			$data['type'] = $get_discount_type;
			$data['region_description'] = $region_description;
		    $data['region_code'] = $region_code;

			$this->load->ftemplate('locationcouponview',$data); 
		}

		public function updatecoupon()
		{
            if(isset($_POST['delete'])){
				$location_auto_id=$this->input->post('location_auto_id');
				$locaion_delete= $this->Location_model->delete_coupon($location_auto_id);

			    $this->session->set_flashdata('success','Region Discount Updated Successfully');
			   redirect('/admin/location');

            }else{

            	
            
				$this->load->helper(array('form', 'url'));
	            $this->load->library('form_validation');

	            $location_id=$this->input->post('location_id');
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
	 						'discount_on'=>$location_id,
	                    	'promocode'=>$code,
						    'discount_type'=>$type,
							'discount_value'=>$ammount,
							'min_ammount'=>$min_ammount,
						    'from_date'=>$this->input->post('valid_from'),
						    'to_date'=>$this->input->post('valid_to'),
							'discount_category'=>2,
							'created_date'=>date('Y-m-d'),
							'source_ip'=>$ip
	                      );

				        $faq_content= $this->Location_model->insert_coupon($data,$location_id);

				        $this->session->set_flashdata('success','Region Discount Updated Successfully');
						redirect('/admin/location');
	            }

	        }    
		}


		public function updatezonecoupon()
		{
			
			$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

			$zone_id=$this->input->post('zone_id');
			$title=$this->input->post('title');
            $code=$this->input->post('code');
		    $type=$this->input->post('type');
			$ammount=$this->input->post('ammount');
			$min_ammount=$this->input->post('min_ammount');

			$zone_list=$this->input->post('zone');

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
 						'title'=>$title,
                    	'promocode'=>$code,
					    'discount_type'=>$type,
						'discount_value'=>$ammount,
						'min_ammount'=>$min_ammount,
					    'from_date'=>$this->input->post('valid_from'),
						'to_date'=>$this->input->post('valid_to'),
						'source_ip'=>$this->input->ip_address(),
                    );

					$faq_content= $this->Location_model->insert_zone_coupon($data,$zone_id);
					
					if(!empty($zone_list)){
						foreach($zone_list as $zones){

							$data=array(
							   'discount_on'=>$zones,
							   'promocode'=>$code,
							   'discount_type'=>$type,
							   'discount_value'=>$ammount,
							   'min_ammount'=>$min_ammount,
							   'from_date'=>$this->input->post('valid_from'),
							   'to_date'=>$this->input->post('valid_to'),
							   'discount_category'=>4,
							   'created_date'=>date('Y-m-d'),
							   'source_ip'=>$this->input->ip_address(),
							 );
	   
						   $faq_content= $this->Location_model->insert_coupon($data,$zone_id);
						}
					}

			        $this->session->set_flashdata('success','Zone wise Coupon Updated Successfully');
					redirect('/admin/zone');
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
								$location_code = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								$discount_type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
								$discount_value = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
								$min_ammount = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
								$from_date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
								$to_date = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

								$get_location_id = $this->Location_model->get_location_row($location_code,$row);
								$location_id = isset($get_location_id->region_code) ? $get_location_id->region_code : '';
							
                                $code =  'LGCPL'.rand ( 1000 , 9999).date("s");

								$date_from = PHPExcel_Shared_Date::ExcelToPHP($from_date); //unix
								$valid_from= gmdate("Y-m-d", $date_from); //date
								
								$date_to = PHPExcel_Shared_Date::ExcelToPHP($to_date); //unix
                                $valid_to= gmdate("Y-m-d", $date_to); //date 
								
								if($location_id !=''){

									$data=array(
										'discount_category'=>'2',
										'discount_type'=>$discount_type,
										'discount_value'=>$discount_value,
										'min_ammount' => $min_ammount,
										'from_date'=>$valid_from,
										'to_date'=>$valid_to,
										'promocode'=>$code,
										'discount_on'=> $location_code,
										'created_date'=>date('Y-m-d'),
										'source_ip'=>$this->input->ip_address()
									);
									$bulk_upload= $this->Location_model->insert_coupon_excel($data,$location_id,$valid_from,$valid_to,$row); 
								}		

							}
					}

					if ($bulk_upload)
					$this->session->set_flashdata('message', "Region Discount Updated Successfully");
				    else 
					$this->session->set_flashdata('message', $this->upload->display_errors());
					 
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename)) {
							$path = $_SERVER['DOCUMENT_ROOT'].'/gcpl/PMKit/assets/csv/'.$filename;
							unlink($path);
					}
				 }

				 else 
					 $this->session->set_flashdata('message', $this->upload->display_errors());
					 redirect("/admin/location");
			 }
			 
		}

		public function download_excel()
		{
			$file_url =$_SERVER["DOCUMENT_ROOT"]."/gcpl/PMKit/assets/csv/location_promocode.xls";
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
			readfile($file_url);
		}


		public function generatecode()
		{
			if($this->input->is_ajax_request()){
	        	$location_id = $this->input->post('location_id');

                //$getlocation = $this->Location_model->getlocationById($location_id);
               
	        	//$fname = isset($getlocation->region_description) ? substr($getlocation->region_description, 0,2) : 'code';
				//$uppername = strtoupper($fname);

                $code =  'LGCPL'.rand ( 1000 , 9999).date("s");

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


		public function getPlantById()
		{
			if($this->input->is_ajax_request()){
	        	$regionId = $this->input->post('regionId');

	        	$finalArr=[];
	        	$assignPlant=[];

                $getAllPlant = $this->Location_model->getplantbyId($regionId);
                $getAssignPlant = $this->Location_model->getAssignPlant($regionId);

                if(!empty($getAssignPlant)){

                	foreach ($getAssignPlant as $key => $plant) {

                		$assignPlant[] = $plant['plant_code'];
                		
                	}
                }

	        	if($getAllPlant){

                    foreach ($getAllPlant as $key => $value) {

                    	if(!in_array($value['plant_code'], $assignPlant)){
                           
                            $finalArr[]=$value;

                    	}
                    	
                    }

	        		$data['success'] = 1;
	        		$data['plant'] = $finalArr;
	        	}
	        	else{
	        		$data['success'] = 0;
	        	}
	        	echo json_encode($data);
	        	exit(0);
	        }
		}

		public function generatezonecode()
		{
			if($this->input->is_ajax_request()){
	        	
                $code =  'FGCPL'.rand ( 1000 , 9999).date("s");

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



		public function createmapping($id){

			$regionId = $id;

			$getRegionData = $this->Location_model->GetRegionById($regionId);
			$getOrderingDetails = $this->Location_model->GetOrderingById($regionId);
			$getAllPlant = $this->Location_model->getplantbyId($regionId);

			$data['getRegionData'] = $getRegionData;
			$data['getOrderingDetails'] = $getOrderingDetails;
			$data['getAllPlant'] = $getAllPlant;

			$this->load->ftemplate('locationmapping',$data); 
		}

		public function deletemapping(){

		    $plant_id = $this->input->post('plant_id');
		    $deleteData = $this->Location_model->delete_plant_delivery_data($plant_id);
			echo 1;


		}
		
		
		public function deleteemail(){

		    $email_id = $this->input->post('id');
		    $deleteData = $this->Location_model->delete_email($email_id);
			echo 1;


		}

		public function deletedelivery(){

		    $delivery_id = $this->input->post('delivery_id');
		    $deleteData = $this->Location_model->delete_delivery_data($delivery_id);
			echo 1;


		}

		public function mapping(){

            $getlocation = $this->Location_model->getAllLocationWithOutZone();

			$data['locationlist'] = $getlocation;

			$this->load->ftemplate('locationmappingList',$data); 
		}

		public function mappingordering(){

			
		
			$orderingId=$this->input->post('orderingId');
			$orderingCode=$this->input->post('orderingCode');

			$plant=$this->input->post('plant');
			$ord=$this->input->post('ord');
			$plantId=$this->input->post('plantId');
			$finalArr = array();

			if(!empty($plant)){

				foreach ($plant as $key => $value) {

					$newarr['plantname']=$value['name'];
					$newarr['plantid']=$plantId[$key]['id'];
					$newarr['deliveryName']=$ord[$key]['name'];
					$newarr['deliveryAddress']=$ord[$key]['address'];
					$newarr['deliveryId']=$ord[$key]['id'];
				
					$finalArr[] = $newarr;
				}
			}

			if(!empty($finalArr)){

				foreach ($finalArr as $key => $value) {

					$faq_content= $this->Location_model->update_plant_data($value['plantname'],$value['plantid']);

					foreach ($value['deliveryName'] as $key=>$deliveryname) {
                        
                        if($deliveryname !=''){
							$data=array(
										   'region_code_no'=>$orderingId,
										   'plant_id'=>$value['plantid'],
										   'delivery_centre_name'=>$deliveryname,
										   'delivery_centre_address'=>$value['deliveryAddress'][$key],
										);
							$faq_content= $this->Location_model->insert_delivery_data($data,$value['deliveryId'][$key]);
						}


						
					}
					
				}
			}

            if(!empty($orderingCode)){
				foreach ($orderingCode as $key=>$code) {

					if($code !=''){

						$plantName= $this->Location_model->getPlantNameByCode($code);
					
						$data=array(
									   'region_code_no'=>$orderingId,
									   'plant_code'=>$code,
									   'ordering_plant_name'=>isset($plantName) ? $plantName->plant_name : '',
									   'pin_code'=>isset($plantName) ? $plantName->po_code : '',
									   

									);
						$faq_content= $this->Location_model->insert_ordering_data($data);
					}
				}
			}
            $this->session->set_flashdata('message', 'Successfully Created');
            redirect("/admin/location/createmapping/".$orderingId);

		}

		

	}

	?>