<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("./cc_avenue/API.php");
class History extends CI_Controller {
	 	function __construct()
    	{
        	parent::__construct();
				$this->load->model('History_model');
				$this->load->library('excel');
				$this->load->library("nusoap_library");
				
				$this->usersessiondata = $this->session->userdata('logged_in'); 		
				if(empty($this->usersessiondata)){
					redirect('/admin/authentication/login'); 
				}
		}
	   
	   	public function index()
		{
			$this->load->ftemplate('history');
		}

		public function order(){
			$this->load->ftemplate('order_history');
		}
		
		public function payment(){
			$this->load->ftemplate('payment_history');
		}
		
		

		public function orderSearch(){

			$orderNo=$this->input->post('orderNo');
			$orderNumber=$this->input->post('orderNumber');
			$customer=$this->input->post('customer');
			$plant=$this->input->post('plant');
			$status=$this->input->post('status');
			$reference=$this->input->post('reference');
			$part=$this->input->post('part');
			$from_date=$this->input->post('from_date');
			$to_date="";
			if($this->input->post('to_date')){
				$to_date=$this->input->post('to_date');
			}else{
				$to_date=$from_date;
			}
			$sum = 0;

			$searchResult = $this->History_model->getOrderSearch($orderNo,$orderNumber,$customer,$plant,$status,$reference,$part,$from_date,$to_date,$formType);			
            
            if(!empty($searchResult)){
				foreach ($searchResult as $item) {
				    $sum = $item['total_payment'];
				}
            }            

			$data['orderNo'] = $orderNo;
			$data['orderNumber'] = $orderNumber;
			$data['customer'] = $customer;
			$data['plant'] = $plant;
			$data['status'] = $status;
			$data['part'] = $part;

			$data['searchResult'] = $searchResult;
			$data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
			$data['sum'] = $sum;
			
			$this->load->ftemplate('order_history',$data);			
		}

		public function paymentSearch(){

			$orderNo=$this->input->post('orderNo');
			$customer=$this->input->post('customer');
			$plant=$this->input->post('plant');
			$status=$this->input->post('status');
			$reference=$this->input->post('reference');
			$part=$this->input->post('part');
			$from_date=$this->input->post('from_date');
			$to_date=$this->input->post('to_date');
			$sum = 0;

			$searchResult = $this->History_model->getPaymentSearch($orderNo,$customer,$plant,$status,$reference,$part,$from_date,$to_date,$formType);			
            
            if(!empty($searchResult)){
				foreach ($searchResult as $item) {
				    $sum = $item['total_payment'];
				}
            }            

			$data['orderNo'] = $orderNo;
			$data['customer'] = $customer;
			$data['plant'] = $plant;
			$data['status'] = $status;
			$data['reference'] = $reference;
			$data['part'] = $part;

			$data['searchResult'] = $searchResult;
			$data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
			$data['sum'] = $sum;
			
			$this->load->ftemplate('payment_history',$data);			
		}

		public function reconciliation(){			
			
			$searchResult = $this->History_model->reconciliationPaymentSearch();		
            
            if(!empty($searchResult)){
				foreach ($searchResult as $item) {
				    $sum = $item['total_payment'];
				}
            }
			
			$data['searchResult'] = $searchResult;	
			$this->load->ftemplate('reconciliation_history',$data);			
		}		

		public function update_order_payment_status(){ 

			$merchant_id = 54711;
			$working_key = '347A911BEF6923B3D5C43534F502089C';
			$access_code = 'AVHM85GF78AI59MHIA';

			$ccavenue_api = new CCAvenue_API();

			//Get pendingorders list
			$pendingorders = array('reference_no' => '16708354258349807112232' , 'order_no'=> '70007812122022143132');
			$response=$ccavenue_api->orderStatusTracker($pendingorders);

			$searchResult = $this->History_model->reconciliationPaymentSearch();		
            
            if(!empty($searchResult)){
				foreach ($searchResult as $item) {
				    // var_dump($item);
				}
				die;
            }
		}

		public function getsearch()
		{
            $category=$this->input->post('category');
            $type=$this->input->post('type');
            $from_date=$this->input->post('from_date');
			$to_date=$this->input->post('to_date');
			$searchResult = $this->History_model->getSearchResult($category,$type,$from_date,$to_date);
			$categorydata = $this->History_model->getDataByCatId($category,$to_date,$from_date);

            $data['category'] = $category;
            $data['type'] = $type;
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
			$data['categorydata'] = $categorydata;
			$data['searchResult'] = $searchResult;
			if($category !='' || $type !='')
			$data['displayResult'] = '1';
            $this->load->ftemplate('history',$data);
            
		}
		public function getDataByCatId()
		{
            $data=$this->input->post('id');
            $end_date=$this->input->post('end_date');
            $start_date=$this->input->post('start_date');
            $data = $this->History_model->getDataByCatId($data,$end_date,$start_date);
			
            echo json_encode($data);     
		}
		

		public function updatePaymentStatus()
		{	
			$CI =& get_instance();

            $status = $this->input->post('status');
            $order_id = $this->input->post('orderID');
			
			$cust_no = $this->input->post('cust_no');
			$quant = $this->input->post('quant');
			$part_no = $this->input->post('part_no');
			$cond_type = $this->input->post('cond_type');
			$percent = $this->input->post('percent');
			$po_no = $this->input->post('po_no');
			$serial_no = $this->input->post('serial_no');
			$plant_code = $this->input->post('plant_code');
			$input_sap_order_id = $this->input->post('input_sap_order_id');
            

			$SapOrderData = $this->History_model->addSapOrderVerify($order_id);
			if (is_array($SapOrderData)) {
				# code...
				$ticket_id 	  = $SapOrderData['ticket_id'];
				$order_number = $SapOrderData['order_number'];
				//http://piqa:50000/XISOAPAdapter/MessageServlet
				$sap_base_url = $this->config->item('sap_base_url');
				print_r($sap_base_url); die();
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => $sap_base_url.'getSAPOrderId?ticketId='.$ticket_id.'&orderNumber='.$order_number,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				//CURLOPT_POSTFIELDS =>$xmlString,
				 
				));

				print_r($curl);

				$response = curl_exec($curl);

				print_r(curl_error($curl));
								
				curl_close($curl);

				$data = $this->History_model->updatePaymentStatusOrderno($status,$order_number,$sap_order_id);

				header('Content-Type: application/json; charset=utf-8');
				echo $response;

				return $response;
			}

			 
		}
		
		public function xmlPursor($myXMLData)
		{
			libxml_use_internal_errors(true);
			/* $request = '
			<?xml version="1.0" encoding="UTF-8"?>
			<ns0:MT_PlaceOrder_Request xmlns:ns0="urn:tipl.com:001:PMKPlaceOrder">
				<CUST_NO>0000912992</CUST_NO>
				<PART_INFO>
					<ORD_QTY>1</ORD_QTY>
					<PART_NUMBER>CPI-4402815</PART_NUMBER>
				</PART_INFO>
				<PART_INFO>
					<ORD_QTY>1</ORD_QTY>
					<PART_NUMBER>PMK-424PM3FLKT</PART_NUMBER>
				</PART_INFO>
				<PART_INFO>
					<ORD_QTY>1</ORD_QTY>
					<PART_NUMBER>K-82.060.10.0.13</PART_NUMBER>
				</PART_INFO>
				<Header_Disc>
					<ConditionType>ZPHD</ConditionType>
					<DiscountPercentage>5.0</DiscountPercentage>
				</Header_Disc>
				<PO_NUMBER>91299213122022112619</PO_NUMBER>
				<SERIAL_NO>01-01-S</SERIAL_NO>
				<PLANT_CODE>3083</PLANT_CODE>
			</ns0:MT_PlaceOrder_Request>
			'; */	

			/* $myXMLData =
			'<?xml version="1.0" encoding="UTF-8"?>
			<nm:MT_PlaceOrder_Response xmlns:nm="urn:tipl.com:001:PMKPlaceOrder" xmlns:prx="urn:sap.com:proxy:PE1:/1SAI/TAS0D6731E843E5F0F70993:702">
				<DOC_DATE>20221213</DOC_DATE>
				<DOC_NO>0053532575</DOC_NO>
				<DOC_TIME>112806</DOC_TIME>
				<ERROR_MESSAGE>Sales Order created successfully.</ERROR_MESSAGE>
			</nm:MT_PlaceOrder_Response>'; */

			$xml = simplexml_load_string($myXMLData);
			if ($xml === false) {
				echo "Failed loading XML: ";
				foreach(libxml_get_errors() as $error) {
					echo "<br>", $error->message;
				}
			} else {
				return $xml->DOC_NO;
			}           

		}

		public function reconciliation_test(){
			$xml = '<?xml version="1.0" encoding="UTF-8"?><ns0:MT_PlaceOrder_Request xmlns:ns0="urn:tipl.com:001:PMKPlaceOrder"><CUST_NO>0000994075</CUST_NO><PART_INFO><ORD_QTY>1</ORD_QTY><PART_NUMBER>CPI-4876205</PART_NUMBER></PART_INFO><Header_Disc><ConditionType>ZPHD</ConditionType><DiscountPercentage>5.0</DiscountPercentage></Header_Disc><PO_NUMBER>99407513122022144138</PO_NUMBER><SERIAL_NO>01-01-D</SERIAL_NO><PLANT_CODE>3053</PLANT_CODE></ns0:MT_PlaceOrder_Request>';


			 //$dataFromTheForm = $_POST['fieldName']; // request data from the form
			// $soapUrl = "http://piqa:50000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_TIPL_PMK&receiverParty=&receiverService=&interface=SI_PMK_PlaceOrder_Out&interfaceNamespace=urn:tipl.com:001:PMKPlaceOrder"; // asmx URL of WSDL
			 $soapUrl = "http://piqa:50000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_TIPL_PMK&receiverParty=&receiverService=&interface=SI_PMK_PlaceOrder_Out&interfaceNamespace=urn:tipl.com:001:PMKPlaceOrder"; // asmx URL of WSDL
			 $soapUser = "techbrawn";  //  username
			 $soapPassword = "Tech@123"; // password

			/* $query_build = array(
				    'foo' => 'bar',
				    'baz' => 'boom',
				    'cow' => 'milk',
				    'null' => null,
				    'php' => 'hypertext processor'
				);*/

			 
			 // xml post structure

			 $xml_post_string =  $xml;   // data from the form, e.g. some ID number

			    $headers = array(

			                 "Content-type: text/xml;charset=\"utf-8\"",
			                 "Accept: text/xml",
			                 "Cache-Control: no-cache",
			                 "Pragma: no-cache",
			                 "SOAPAction: DT_PlaceOrders", 
			                 "service: DT_PlaceOrders", 
			                 "Content-length: ".strlen($xml_post_string),
			             ); //SOAPAction: your op URL
			 
			     $url = $soapUrl;

			     // PHP cURL  for https connection with auth
			     $ch = curl_init();
			     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
			     curl_setopt($ch, CURLOPT_URL, $url);
			     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			     curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
			     curl_setopt($ch, CURLOPT_POSTFIELDS, 'senderParty=&senderService=BC_TIPL_PMK&receiverParty=&receiverService=&interface=SI_PMK_PlaceOrder_Out&interfaceNamespace=urn:tipl.com:001:PMKPlaceOrder');
			     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			     curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			     curl_setopt($ch, CURLOPT_POST, true);
			     curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
			     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			     // converting

			     $response = curl_exec($ch); 
			     curl_close($ch);
			var_dump($response);
			     // converting
			     $response1 = str_replace("<soap:Body>","",$response);
			     $response2 = str_replace("</soap:Body>","",$response1);

			     // convertingc to XML
			     $parser = simplexml_load_string($response2);
			print_r($parser);
			die('wait');
				return true;
		}

		public function reconciliation_test_new(){

			/*$xml = '<?xml version="1.0" encoding="UTF-8"?><ns0:MT_PlaceOrder_Request xmlns:ns0="urn:tipl.com:001:PMKPlaceOrder"><CUST_NO>'.$cust_no.'</CUST_NO><PART_INFO><ORD_QTY>'.$quant.'</ORD_QTY><PART_NUMBER>'.$part_no.'</PART_NUMBER></PART_INFO><Header_Disc><ConditionType>'.$cond_type.'</ConditionType><DiscountPercentage>'.$percent.'</DiscountPercentage></Header_Disc><PO_NUMBER>'.$po_no.'</PO_NUMBER><SERIAL_NO>'.$serial_no.'</SERIAL_NO><PLANT_CODE>'.$plant_code.'</PLANT_CODE></ns0:MT_PlaceOrder_Request>';*/
			$xml = '<?xml version="1.0" encoding="UTF-8"?><ns0:MT_PlaceOrder_Request xmlns:ns0="urn:tipl.com:001:PMKPlaceOrder"><CUST_NO>0000994075</CUST_NO><PART_INFO><ORD_QTY>1</ORD_QTY><PART_NUMBER>CPI-4876205</PART_NUMBER></PART_INFO><Header_Disc><ConditionType>ZPHD</ConditionType><DiscountPercentage>5.0</DiscountPercentage></Header_Disc><PO_NUMBER>99407513122022144138</PO_NUMBER><SERIAL_NO>01-01-D</SERIAL_NO><PLANT_CODE>3053</PLANT_CODE></ns0:MT_PlaceOrder_Request>';


			//$dataFromTheForm = $_POST['fieldName']; // request data from the form
			$api_url = "http://piqa:50000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_TIPL_PMK&receiverParty=&receiverService=&interface=SI_PMK_PlaceOrder_Out&interfaceNamespace=urn:tipl.com:001:PMKPlaceOrder"; 

			$api_username = 'techbrawn';
					$api_password = 'Tech@123';
					$service 	  = "DT_PlaceOrders"; // PMKPlaceOrder  DTStockInfoResponse
					$params = '';
					$params = array(
									'senderParty' => '',
									'senderService' => 'BC_TIPL_PMK',
									'receiverParty' => '',
									'receiverService' => '',
									'interface' => 'SI_PMK_PlaceOrder_Out',
									'interfaceNamespace' => 'urn:tipl.com:001:PMKPlaceOrder'
									//'namespace' => 'urn:tipl.com:001:PMKPlaceOrder'
							);  


					if ($api_url != '')
					{
						$result = $this->nusoap_library->soaprequest($api_url, $api_username, $api_password, trim($service), $params,$xml);
						echo 'controller-<br>' ; var_dump($result);
						if (is_array($result) && count($result) > 0)
							{
									$response_xml = $result;
							}
					}
		}

 }

	?>