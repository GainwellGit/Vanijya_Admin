<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	define('SECRET_KEY','ussd@12345');  
	define('ALGORITHM','HS512');
	require(APPPATH.'/libraries/REST_Controller.php');
	use Restserver\Libraries\REST_Controller;
class Api extends REST_Controller {
	public function __construct() {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Headers: *");
		parent::__construct();
		$this->load->model('api_model');
	}    
	
	public function quizset_post() {
		$quizsets = $this->api_model->get_quizset_list();
		if(isset($quizsets) && !empty($quizsets)){
			foreach($quizsets as $quizs){
				$data['id'] = $quizs->id;
				$data['title'] = $quizs->title;
				$data['title_image'] =$quizs->title_image;
				$mdata[] = $data;
			}
		}
		if(isset($mdata) && !empty($mdata)){
			$this->response($mdata, REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function getcategoriesbygroup_post() {
		$page = $this->input->post('page');
	  	$groups= $this->api_model->get_group_list($page); 
	  	// print_r($groups);
	  	// die;
	  	if($groups)
	  		$this->response(['groups'=>$groups[0],
                'success'=>1,
                'error'=>0,
                'status'=>200 ,
                'hasMore'=>$groups[1]
            ], REST_Controller::HTTP_OK);
	  	else
	  		$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);
	}

	public function latestquiz_post() {
		
		$quizsets = $this->api_model->get_latestquiz_list();
		/*print_r($quizsets);
		die();*/

		/*if(isset($quizsets) && !empty($quizsets)){
			foreach($quizsets as $quizs){
				$data['id'] = $quizs->id;
				$data['title'] = $quizs->title;
				//$data['description'] = $quizs->description;
				$data['title_image'] =$quizs->title_image;
				$data['total_question']=$quizs->total;
				$mdata[] = $data;
			}
		}*/
		if(isset($quizsets) && !empty($quizsets)){
			$this->response(['latestquiz'=>$quizsets,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		} 
	}
	public function popularquiz_post() //get popular quiz category
	{
		$quizsets = $this->api_model->get_popularquiz_list();
		/*print_r($quizsets);
		die();*/

		/*if(isset($quizsets) && !empty($quizsets)){
			foreach($quizsets as $quizs){
				$data['id'] = $quizs->id;
				$data['title'] = $quizs->title;
				//$data['description'] = $quizs->description;
				$data['title_image'] =$quizs->title_image;
				$data['total_question']=$quizs->total;
				$mdata[] = $data;
			}
		}*/
		if(isset($quizsets) && !empty($quizsets)){
			$this->response(['popularquiz'=>$quizsets,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);
			
		}
	}

	//************************   pvp controllers   *********************************

	//16.10.2020
	public function pvpquizcategory_post() 
	{
		$categoryid=$this->post('category_id');
		$getcategory=$this->api_model->getpvpquestionid($categoryid);


		// $headers=$this->input->request_headers();
  		// $jwt=$headers['Jwt'];
  		// $secretKey = base64_decode(SECRET_KEY);
		// $data = Api::decode($jwt,$secretKey);
  		// $msisdn=$data->data[0]->msisdn;
  		// $is_msisdn=$this->api_model->check_msisdn($msisdn);
  		// print_r($is_msisdn);die('fff');

		$user_id=$this->post('user_id');
		$is_user=$this->api_model->check_user_id($user_id);

		if($is_user==TRUE || !empty($is_user))
		{
			$data = array(
				//'user_id'=>$data->data[0]->id,
        		'user_id'=>$this->post('user_id'),
				'category_id'=>$this->input->post('category_id'),
				'play_button_click'=>date("Y-m-d H:i:s")
			);
        	$pvpuser=$this->api_model->insertpvpuser($data);

			// $getallquestion=$this->api_model->getpvpquestionall($categoryid);
			// $question_ids = array_column($getallquestion, 'quiz_id');
  			// $getanswerRes=$this->api_model->getanswerlist_all($question_ids);

			if($getcategory){
			
				$this->response(['category_details'=>$getcategory,
								//'questionlist'=>$getallquestion,
								//'answerlist'=>$getanswerRes,
			                    'success'=>1,
			                    'error'=>0,
			                    'status'=>200 
			                ], REST_Controller::HTTP_OK);
			}else{

				$this->response([
					'success'=>0,
			         'error'=>1,
	                'status' => 400,
	                'message' => 'No data found.'
	            ], REST_Controller::HTTP_OK);
				
			}
		}
		else
		{
			$this->response([
				'success'=>0,
		        'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);		
		}    
	}

	//19.10.2020
	public function pvp_noOfuserCheck_post()
    {
		// $headers=$this->input->request_headers();
		// $jwt=$headers['Jwt'];
		// $secretKey = base64_decode(SECRET_KEY);
		// $data = Api::decode($jwt,$secretKey);
		// $msisdn=$data->data[0]->msisdn;
		// $user_id=$data->data[0]->id;
		// $msisdn=$data->data[0]->msisdn;
		
		$user_id=$this->post('user_id');
		$is_user=$this->api_model->check_user_id($user_id);

		if($is_user==TRUE || !empty($is_user))
		{

		 	$category=$this->input->post('category_id');
		 	//print_r($category);die("pppppp");

		 	$current_date = date("Y-m-d");
		 	$start_time = date("Y-m-d H:i:s");
		 	//print_r($start_time);echo "++++";
		 	//****$end_time = (date('Y-m-d H:i:s', strtotime('+ 30 seconds')));
		 	$end_time = (date('Y-m-d H:i:s', strtotime('+ 1 day')));
		 	//print_r($end_time);die("++++");

		 	$totaluserpresent=$this->api_model->check_total_user($start_time,$end_time,$category,$user_id);

		 	
		 	if(!empty($totaluserpresent) && isset($totaluserpresent))
		 	{
		 		$this->response([
		 			'player_details'=>$totaluserpresent,
					'success'=>1,
			         'error'=>0,
		            'status' => 200,
		            'message' => 'Players available for play now.'
		        ], REST_Controller::HTTP_OK);
		 	}
		 	else
		 	{
		 		$this->response([
				'success'=>0,
		    	'error'=>1,
		    	'status' => 400,
		    	'message' => 'No players available for play now.'
		    	], REST_Controller::HTTP_NOT_FOUND);
		 	}
		}
		else
		{
			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);
		}
    }

    //20.10.2020
    public function pvp_getquestion_post()
	{
     	$category_id=$this->post('category_id');
		$questiondetails=$this->api_model->getpvpquestionall($category_id);

		$question_ids = array_column($questiondetails, 'quiz_id');
		$getanswerRes=$this->api_model->getanswerlist_all($question_ids);

		//***********  testing data  **************************

		$start_time = date("Y-m-d H:i:s");
	 	$end_time = (date('Y-m-d H:i:s', strtotime('+ 1 day')));
	 	$totaluserpresent=$this->api_model->check_total_user_test($start_time,$end_time,$category_id);
	 	//print_r($totaluserpresent);die("ppooooo");
	 	$player_ids = array_column($totaluserpresent, 'user_id');

		//***********  testing data  **************************

    	$player_getquestion = [];
    	foreach ($totaluserpresent as $value) 
    	{
    		$player_getquestion[$value["user_id"]]=(object) array(
    		"question_list" => $questiondetails,
    		"answare_list" => $getanswerRes);
    	}
 
		$this->response(['playerdatalist'=>(object) $player_getquestion,
                    	'success'=>1,
                    	'error'=>0,
                    	'status'=>200 
                		], REST_Controller::HTTP_OK);
	     
	}

	//21.10.2020
	public function pvp_submitquiz_post() 
	{
	 	// $headers=$this->input->request_headers();
  		// $jwt=$headers['Jwt'];
 		// $secretKey = base64_decode(SECRET_KEY);
	 	// $data = Api::decode($jwt,$secretKey);
  		// $msisdn=$data->data[0]->msisdn;
  		// $uid=$data->data[0]->id;
		// $is_msisdn=$this->api_model->check_msisdn($msisdn);

		$user_id=$this->post('user_id');
		$is_user=$this->api_model->check_user_id($user_id);
	
        if($is_user==TRUE || !empty($is_user)) 
        {
			//$playedQuiz = json_decode($this->input->post('playedquiz'));
			//$answersId = array_column($playedQuiz, 'answer_id');
			//$answerdetails = $this->api_model->answersById($answersId);
			
			$data = array(
				//'user_id'=>$data->data[0]->id,
				'user_id'=>$user_id,
				'category_id'=>$this->input->post('category_id'),
				'score'=> 10,
				'accurate'=>100,
				'not_answer' => 0,
				'right'	=> 10,
				'wrong'	=> 0,
				'total_time'=>10.10,
				'date_created'=>date('Y-m-d H:i:s')
			);
			// foreach ($playedQuiz as $value) 
			// {
			// 	foreach ($answerdetails as $value_answer) 
			// 	{
			// 		if($value_answer->questioninput=="yes")
			// 		{
			// 			if($value->answer_id==$value_answer->id)
			// 			{
			// 				$data['total_time'] += $value->option_choose_time;
			// 				if($value->userAnseredMatched=="yes")
			// 				{
			// 					// These Questions answered right.
			// 					$data['right']++;
			// 					$data['score'] += $value->points;
			// 				}
			// 				elseif ($value->userAnseredMatched=="no") 
			// 				{
			// 					// These Questions are answered wrong.
			// 					$data['wrong']++;
			// 				}
			// 				elseif ($value->option_choose=="") 
			// 				{
			// 					// These Question are not choosen.
			// 					$data['not_answer']++;
			// 				}
			// 			}	
			// 		}
			// 		elseif ($value_answer->questioninput=="no") 
			// 		{
			// 			if($value->answer_id==$value_answer->id)
			// 			{
			// 				$data['total_time'] += $value->option_choose_time;
			// 				if ($value->option_choose == '') 
			// 				{
			// 					// These Question are not choosen.
			// 					$data['not_answer']++;
			// 				} 
			// 				else if ($value->option_choose == $value_answer->option_number)
			// 				{
			// 					// These Questions answered right.
			// 					$data['right']++;
			// 					$data['score'] += $value->points;
			// 				} 
			// 				else 
			// 				{
			// 					// These Questions are answered wrong.
			// 					$data['wrong']++;
			// 				}
			// 			}
			// 		}
			// 		elseif ($value_answer->questioninput=="") 
			// 		{
			// 			if($value->answer_id==$value_answer->id)
			// 			{
			// 				$data['total_time'] += $value->option_choose_time;
			// 				if ($value->option_choose == '') 
			// 				{
			// 					// These Question are not choosen.
			// 					$data['not_answer']++;
			// 				} 
			// 				else if ($value->option_choose == $value_answer->option_number)
			// 				{
			// 					// These Questions answered right.
			// 					$data['right']++;
			// 					$data['score'] += $value->points;
			// 				} 
			// 				else 
			// 				{
			// 					// These Questions are answered wrong.
			// 					$data['wrong']++;
			// 				}
			// 			}
			// 		}
					
			// 	}
			// 	// echo json_encode($value);
			// }
			//$total_question = count($playedQuiz);
			//$data['accurate'] = ($data['right']*100)/$total_question;
			//print_r($data);die("ppp");
		    $quizhistory=$this->api_model->insert_pvpuserquizhistory($data);
		    
            if($quizhistory )
			$this->response([
				            'last_id'=>$quizhistory,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
        } 
        else 
        {
            $this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

        }
	}

	//21.10.2020
	public function pvp_getresult_post() 
	{
		$all_result_id=$this->api_model->pvp_resultid_test();
		print_r($all_result_id);die("ppppp");
		foreach ($all_result_id as $value) 
		{
			//print_r($value["user_id"]);die("aaappppp");
		}

		if($this->post('result_id'))
		{
			$result_id = $this->post('result_id');
			$quizhistory=$this->api_model->pvp_getuserquizhistorybyid($result_id);
			// print_r($quizhistory);
   			// die;
			if(isset($quizhistory) && !empty($quizhistory))
			{
		
				$data['id'] =$quizhistory['id'];
				$data['category_id'] =$quizhistory['category_id'];
	            $data['not_answer'] =$quizhistory['not_answer'];
				$data['right'] = $quizhistory['right'];
				$data['accurate'] =$quizhistory['accurate'];
				$data['score']=$quizhistory['score'];
				$data['total_time'] =$quizhistory['total_time'];
				$data['user_id'] =$quizhistory['user_id'];
	            $data['wrong']=$quizhistory['wrong'];
				$data['image'] =$quizhistory['image'];
				$data['category_title'] =$this->api_model->getcattile($quizhistory['category_id']);			
			}
				
			if(isset($data) && !empty($data))
			{
				$this->response([
				    'result'=> $data,
		            'success'=>1,
		            'error'=>0,
		            'status'=>200 
		        ], REST_Controller::HTTP_OK);
			}
				
            else
            {
            	$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'No data found.'
				], REST_Controller::HTTP_OK);
            }         	
		}		
	}

	//************************   pvp controllers   *********************************

	public function searchcategory_post()
	{
	 $categorytitle=strtolower($this->post('title'));
	 $quizsetslist = $this->api_model->getsearchlist($categorytitle);
		/*print_r($quizsetslist);
		die();*/

		
		if($quizsetslist!=false){
			$this->response(['search_details'=>$quizsetslist,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}
		else if($quizsetslist==false || !empty($quizsetslist))
			{ 
				$this->response([
		                    'success'=>0,
		                    'error'=>1,
		                    'status'=>400,
		                    'message'=> 'No Record found.'
		                ], REST_Controller::HTTP_OK);
			}
			else{
			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);
			
		}	
	}
	public function getfaq_post()  //get faq page
	{
		$getfaqdetails=$this->api_model->getfaq();
		/*print_r($getfaqdetails);
		die();*/
		if(isset($getfaqdetails) && !empty($getfaqdetails)){
			foreach($getfaqdetails as $faq){
				$data['id'] = $faq->id;
				$data['faq_question'] = $faq->faq_question;
				$data['faq_answer'] =$faq->faq_answer;
				$mdata[] = $data;
			}
		}
		if(isset($mdata) && !empty($mdata)){
			$this->response(['faq_details'=>$mdata,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		} 
	}
	public function getpage_post() //get privacy &termofservices page
	{
		$page=strtolower($this->post('page'));

		$getpagedetails=$this->api_model->getpagecontent($page);
	/*	print_r($getpagedetails);
		die();*/
		if(isset($getpagedetails) && !empty($getpagedetails)){
			foreach($getpagedetails as $pages){
				$data['id'] = $pages->id;
				$data['type'] = $pages->type;
				$data['content'] =$pages->content;
				$mdata[] = $data;
			}
		}
		if(isset($mdata) && !empty($mdata)){
			$this->response(['page_details'=>$mdata,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		} 
	}
	public function detailsbycatid_post() {
		$categoryid=$this->post('category_id');
		$getcategory=$this->api_model->getcategorybyid($categoryid);
		
		// if(isset($getcategory) && !empty($getcategory)){
		// 	$data['id'] =$getcategory->id;
		// 	$data['title'] = $getcategory->title;
		// 	$data['description'] = $getcategory->description;
		// 	$data['title_image'] =$getcategory->banner_image;
		// 	$data['total_question']=$getcategory->total;
		// 		$mdata[] = $data;
			
		// }
		if($getcategory){
		
			$this->response(['category_details'=>$getcategory,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{

			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);
			
		} 
	}

	public function getbannerlist_post()
	{ 
		$bannerlist=$this->api_model->getbannernew(); //15-01-19
		//$bannerlist=$this->api_model->getbanner();
		/*print_r($bannerlist);
		die;*/
		/*if(isset($bannerlist) && !empty($bannerlist)){
	
         foreach($bannerlist as $getbannerlist){
			$data['id'] =$getbannerlist->id;
			$data['banner_description'] = $getbannerlist->banner_description;
			$data['banner_image'] =$getbannerlist->banner_image;
			$data['category_id']=$getbannerlist->category_id;
			$data['categorydetails']=  
			array(
                  'id'=>$getbannerlist->id,
                  'title'=>$getbannerlist->title,
                  'description'=>$getbannerlist->description,
                  'title_image'=>$getbannerlist->title_image,
                 'total_question'=>$getbannerlist->total,
              );
				$mdata[] = $data;
			
			}

			
		}*/
		if(isset($bannerlist) && !empty($bannerlist)){
		
			$this->response(['banner_details'=>$bannerlist,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{

			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		} 

	}
	public function rewards_banner_post()
	{
		$bannerrwdlist=$this->api_model->getrwdbanner();
		// print_r($bannerrwdlist);die('hhh2');
		//die;
		/*if(isset($bannerrwdlist) && !empty($bannerrwdlist)){
	
         foreach($bannerrwdlist as $bannerrwd){
			$data['bannerid'] =$bannerrwd->banner_id;
			$data['banner_description'] = $bannerrwd->banner_description;
			$data['banner_image'] =$bannerrwd->banner_image;
			$data['category_id']=$getbannerlist->category_id;
			$data['rewarddetails']=  
			array(
                  'id'=>$bannerrwd->reward_id,
                  'title'=>$bannerrwd->title,
                  'description'=>$bannerrwd->description,
                  'reward_image'=>$bannerrwd->reward_image,
                  'coin'=>$bannerrwd->coin,
              );
				$mdata[] = $data;
			
			}

			
		}*/
		if(isset($bannerrwdlist) && !empty($bannerrwdlist)){
		
			$this->response(['banner_rwd_details'=>$bannerrwdlist,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{

			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		}
	}
	

	public function getrewardslist_post()
	{
	  $rewardlist=$this->api_model->getreward();
		/*if(isset($rewardlist) && !empty($rewardlist)){
	
         foreach($rewardlist as $getrewardlist){
			$data['id'] =$getrewardlist->id;
			$data['title'] = $getrewardlist->title;
			$data['description'] = $getrewardlist->description;
			$data['reward_image'] =$getrewardlist->reward_image;
			$data['coin']=$getrewardlist->coin;
				$mdata[] = $data;
			
			}

			
		}*/
		if(isset($rewardlist) && !empty($rewardlist)){
		
			$this->response(['reward_details'=>$rewardlist,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{

			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		} 	
	}


	public function gettoprewards_post()
	{
	  $rewardlist=$this->api_model->gettopreward();
		/*if(isset($rewardlist) && !empty($rewardlist)){
	
         foreach($rewardlist as $getrewardlist){
			$data['id'] =$getrewardlist->id;
			$data['title'] = $getrewardlist->title;
			$data['description'] = $getrewardlist->description;
			$data['reward_image'] =$getrewardlist->reward_image;
			$data['coin']=$getrewardlist->coin;
			$data['click_reward']=$getrewardlist->click_reward;
			$data['date_created']=$getrewardlist->date_created;
				$mdata[] = $data;
			
			}

			
		}*/
		if(isset($rewardlist) && !empty($rewardlist)){
		
			$this->response(['reward_details'=>$rewardlist,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{

			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		} 	
	}

	public function getrewardbyid_post()
	{
		$rewardid=$this->post('reward_id');

		$getreward=$this->api_model->getrewardbyid($rewardid);
		/*if(isset($getreward) && !empty($getreward)){
	
			$data['id'] =$getreward->id;
			$data['title'] = $getreward->title;
			$data['description']=$getreward->description;
			$data['reward_image'] =$getreward->reward_image;
			
				$mdata[] = $data;
			
		}*/
		if(isset($getreward) && !empty($getreward)){
		
			$this->response(['each_reward'=>$getreward,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}else{

			$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
			
		} 
	}

	public function myreward_post() {
		$headers=$this->input->request_headers();
		$jwt=$headers['Jwt'];
		$secretKey = base64_decode(SECRET_KEY);
		$data = Api::decode($jwt,$secretKey);
		 
		$msisdn=$data->data[0]->msisdn;
	 	$user_id=$data->data[0]->id;
		$is_msisdn=$this->api_model->check_msisdn($msisdn);
	
		if($is_msisdn==TRUE || !empty($is_msisdn)) {
			$page = $this->post('page');	
       		$buy_rewardlist=$this->api_model->getmyrewardlist($user_id, $page);
       		$mdata = array();
       		if(isset($buy_rewardlist) && !empty($buy_rewardlist)) {
         		foreach($buy_rewardlist as $buyrewardlist){
					$datanew['id'] = $buyrewardlist['id'];
					$datanew['title'] = $buyrewardlist['title'];
					$datanew['description'] = $buyrewardlist['description'];
					$datanew['reward_image'] =$buyrewardlist['reward_image'];
					$datanew['coin']=$buyrewardlist['coin'];
					$mdata[] = $datanew;
				}
			/*print_r($mdata);die;*/
			}
			if(isset($mdata) && !empty($mdata)) {
				$this->response(['myreward_details'=>$mdata,
								'success'=>1,
								'error'=>0,
								'status'=>200 
							], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'success'=>0,
					'error'=>1,
					'status' => 400,
					'message' => 'No data found.'
				], REST_Controller::HTTP_OK);
			} 
		} else {
			$this->response([
				'success'=>0,
				'error'=>1,
				'status' => 400,
				'message' => 'Invalid user id.'
			], REST_Controller::HTTP_NOT_FOUND);
		} 
	}
	public function buyreward_post()
	{
	$headers=$this->input->request_headers();
	$jwt=$headers['Jwt'];
	$secretKey = base64_decode(SECRET_KEY);
	$data = Api::decode($jwt,$secretKey);
	/*print_r($data);
	die;*/
	 $msisdn=$data->data[0]->msisdn;
	 $user_id=$data->data[0]->id;
	$is_msisdn=$this->api_model->check_msisdn($msisdn);
	

	if($is_msisdn==TRUE || !empty($is_msisdn))
	{

	//$user_id=trim($this->post('user_id'));
	$reward_id=trim($this->post('reward_id'));
	$getusercoin=$this->api_model->userdetails($user_id);
	if(isset($getusercoin) && !empty($getusercoin))
	{
	$total_coin=$getusercoin->coin;

	$rewardcoin=$this->api_model->getrewardbyid($reward_id);
	if(isset($rewardcoin) && !empty($rewardcoin))
	{
	$reward_coin=$rewardcoin->coin;

	if($total_coin >=$reward_coin)
	{
     $remaining_coin=$total_coin-$reward_coin;

	$data=array(
	'user_id'=>$user_id,
	'reward_id'=>$reward_id,
	'created_at'=>date('Y-m-d H:i:s'),
	'is_active'=>1
	);
	$isuserreward=$this->api_model->userreward($data);
	if($isuserreward==TRUE || !empty($isuserreward))
	{

	$updateusercoin=$this->api_model->updatecoin($remaining_coin,$user_id);
	if($updateusercoin==TRUE || !empty($updateusercoin))
	{
    $this->api_model->rewardclick($reward_id);
	$this->response([
	'success'=>1,
	'error'=>0,
	'status'=>200 
	], REST_Controller::HTTP_OK);
	}
	}
	} 
	else
	{
	$this->response([
	'success'=>0,
	'error'=>1,
	'status' => 200,
	'message' => 'You are unable to get this rewards.'
	], REST_Controller::HTTP_OK);

	}
     }
     else
     {
     	$this->response([
	'success'=>0,
	'error'=>1,
	'status' => 400,
	'message' => 'No data found.'
	], REST_Controller::HTTP_NOT_FOUND);

     }

	}

	else       
	{
	$this->response([
	'success'=>0,
	'error'=>1,
	'status' => 400,
	'message' => 'No data found.'
	], REST_Controller::HTTP_NOT_FOUND);


	}
}
	else       
	{
	$this->response([
	'success'=>0,
	'error'=>1,
	'status' => 400,
	'message' => 'Invalid user id.'
	], REST_Controller::HTTP_NOT_FOUND);

	}
		

	}
	public function user_details_post()
	{
	$headers=$this->input->request_headers();
	$jwt=$headers['Jwt'];
	$secretKey = base64_decode(SECRET_KEY);
	$data = Api::decode($jwt,$secretKey);
	/*print_r($data);
	die;*/
	 $msisdn=$data->data[0]->msisdn;
	 $user_id=$data->data[0]->id;
	$is_msisdn=$this->api_model->check_msisdn($msisdn);
	if($is_msisdn==TRUE || !empty($is_msisdn))
	{
		$user_list=$this->api_model->userdetails($user_id);
		/*print_r($user_list);
		die;*/
		if(isset($user_list) && !empty($user_list)){
	
			$datanew['first_name'] =$user_list->first_name;
			$datanew['last_name']=$user_list->last_name;
			$datanew['username'] =$user_list->username;
			$datanew['msisdn'] =$user_list->msisdn;
			$datanew['coin'] = $user_list->coin;
			$datanew['image'] =$user_list->image;
			
				/*$mdata[] = $datanew;*/
			
		}
		
		
			$this->response(['eachuserdetails'=>$datanew,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
	
	}
	else       
	{
	$this->response([
	'success'=>0,
	'error'=>1,
	'status' => 400,
	'message' => 'Invalid user id.'
	], REST_Controller::HTTP_NOT_FOUND);

	}


	}


	public function userquizhistory_post()
	{
		$headers=$this->input->request_headers();
             $jwt=$headers['Jwt'];
             $secretKey = base64_decode(SECRET_KEY);
			 $data = Api::decode($jwt,$secretKey);
             $msisdn=$data->data[0]->msisdn;
              $user_id=$data->data[0]->id;
             $is_msisdn=$this->api_model->check_msisdn($msisdn);

             if($is_msisdn==TRUE || !empty($is_msisdn))
             {

             	$category_id=$this->post('category_id');
             	$accurate=$this->post('accurate');
             	$usr_score=$this->post('score');
             	$not_answer=$this->post('not_answered');
             	$rightanswer=$this->post('right');
             	$wronganswer=$this->post('wrong');
             	$total_time=$this->post('total_time');
             	
             	$datanew=array(
                  'user_id'=>$user_id,
                  'category_id'=>$category_id,
                  'score'=>$usr_score,
                  'accurate'=>$accurate,
                  'not_answer'=>$not_answer,
                   'right'=>$rightanswer,
                   'wrong'=>$wronganswer,
                   'total_time'=>$total_time
                
             	);
             	/*print_r($datanew);
			    die;*/
		    $quizhistory=$this->api_model->insertuserquizhistory($datanew);

		/*	 print_r($quizhistory);
			 die;*/
			 if($quizhistory)
         
			$this->response([
				            'last_id'=>$quizhistory,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		     }
             else       
             {
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

             }
	}

	public function getresult_post() {
		if($this->post('result_id')){
			$result_id = $this->post('result_id');
			$quizhistory=$this->api_model->getuserquizhistorybyid($result_id);
			/*print_r($quizhistory);
              die;*/
		if(isset($quizhistory) && !empty($quizhistory)){
	
			$data['id'] =$quizhistory['id'];
			$data['category_id'] =$quizhistory['category_id'];
            $data['not_answer'] =$quizhistory['not_answer'];
			$data['right'] = $quizhistory['right'];
			$data['accurate'] =$quizhistory['accurate'];
			$data['score']=$quizhistory['score'];
			$data['best_score']=$this->api_model->bestScore($quizhistory['user_id'], $quizhistory['category_id']);
			$data['total_time'] =$quizhistory['total_time'];
			//$data['user_id'] =$quizhistory['user_id'];
            $data['wrong']=$quizhistory['wrong'];
			$data['image'] =$quizhistory['image'];
			$data['category_title'] =$this->api_model->getcattile($quizhistory['category_id']);
 
			
				
			
		}
			
			if(isset($data) && !empty($data))
				$this->response([
				    'result'=> $data,
		            'success'=>1,
		            'error'=>0,
		            'status'=>200 
		        ], REST_Controller::HTTP_OK);
            else       
             	$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'No data found.'
			], REST_Controller::HTTP_OK);
		}
		
	}
     


      public function noOfAttemptquiz_post()
      {
      		 $headers=$this->input->request_headers();
             $jwt=$headers['Jwt'];
             $secretKey = base64_decode(SECRET_KEY);
			 $data = Api::decode($jwt,$secretKey);
             $msisdn=$data->data[0]->msisdn;
              $user_id=$data->data[0]->id;
             $is_msisdn=$this->api_model->check_msisdn($msisdn);

             if($is_msisdn==TRUE || !empty($is_msisdn))
             {

             	$category=$this->input->post('category_id');
             	$getmaximumattempt=$this->api_model->getNoOfAttempt($category);
             	$maximumcategory= $getmaximumattempt['no_of_attempt'];
             	$totalplayquiz=$this->api_model->quizplayuser($user_id, $category);
             	//echo $maximumcategory;
             /*	$totalplayquiz;*/
		//****************************************************************
             // print_r($maximumcategory);echo"++++++++++++++++";print_r($totalplayquiz);die("pppp");

      //        	  if($maximumcategory<=$totalplayquiz) {

      //        	  	// block
      //                $this->response([
						// 'success'=>0,
				  //        'error'=>1,
		    //             'status' => 400,
		    //             'message' => 'No Of Attempt Exceeded.'
		    //         ], REST_Controller::HTTP_OK);
      //        	  } else {
      //        	  	//allow
      //                $this->response([
						// 'success'=>1,
				  //        'error'=>0,
		    //             'status' => 200
		    //         ], REST_Controller::HTTP_OK);
      //        	  }
             //******************08.06.2020*********************************
             	$this->response([
						'success'=>1,
				         'error'=>0,
		                'status' => 200
		            ], REST_Controller::HTTP_OK);
             //*************************************************
              	}
        	

              else       
             {
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

             }



      }
public function userInfoNew_post()
      {

      		 $headers=$this->input->request_headers();
             $jwt=$headers['Jwt'];
             $secretKey = base64_decode(SECRET_KEY);
			 $data = Api::decode($jwt,$secretKey);
			 $msisdn=$data->data[0]->msisdn;
			 $user_id=$data->data[0]->id;
			 $is_msisdn=$this->api_model->check_msisdn($msisdn);
           if($is_msisdn==TRUE || !empty($is_msisdn))
             {
             	//$user_id=$this->input->post('user_id');
             	$getuserdetails=$this->api_model->userinfo($user_id);
             	//print_r($getuserdetails);
             	//die;
             	 
			   $this->response(['userinfo'=>$getuserdetails,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
          
             	
             	}
              else       
             {
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_ok);

             }
         }





	public function updateprofile_post() {
		$headers = $this->input->request_headers();
        $jwt = $headers['Jwt'];

        $secretKey = base64_decode(SECRET_KEY);
		$data = Api::decode($jwt,$secretKey);
	
        $msisdn = $data->data[0]->msisdn;
        $user_id = $data->data[0]->id;
        $is_msisdn = $this->api_model->check_msisdn($msisdn);

        if($is_msisdn==TRUE || !empty($is_msisdn)) {
            $username=$this->input->post('username');
            $dir_path=$_SERVER['DOCUMENT_ROOT'].'/assets/uploads/profiles/';
            $datanew=array();
            
            if(isset($username) && !empty($username)) {
                $datanew=array('username' => $username);
                 	if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
	                	$thumbimagegroup = array('0' => array('width'=>300, 'height'=>250),'1' => array('width'=>50, 'height'=>50),'2' => array('width'=>125, 'height'=>125));    
	                //get image from userlogin for check already image exits//
	                $getuserdetails=$this->api_model->userdetails($user_id);
	                $getuserimage=$getuserdetails->image;
	                
	                if($getuserimage != '') {
                      unlink($dir_path.$getuserimage);
	                }
	                
	                $config['upload_path'] = $dir_path.'/';
	                $config['allowed_types'] = 'jpg|jpeg|png';
	                $config['remove_spaces'] = TRUE;
	                $config['encrypt_name'] = TRUE;
	                   
	                $this->upload->initialize($config);
	                if($this->upload->do_upload('image')){
	                    $uploaddata = $this->upload->data(); 
	                  $filename = $uploaddata['file_name'];
	                    $datanew['image'] = $filename; 
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
	                    	 /*print_r($config);
	                    	 die;*/
	                        if(!is_dir($dir_path.'/'.$resize['width'].'_'.$resize['height'])){
	                            mkdir($dir_path.'/'.$resize['width'].'_'.$resize['height'], 0777, true);
	                        }
	                        
	                        
	                        $config['new_image'] = $dir_path.'/'.$resize['width'].'_'.$resize['height'].'/'.$filename;
	                     
	                        $this->image_lib->initialize($config);
	                        $this->image_lib->resize();
	                         
	                        $this->image_lib->clear();
	                    }
	                }else{
	                    $result = array("status"=>false, "type"=>"verror", "message"=>$this->upload->display_errors());
	                }
	                 
            }
           else
            {
            	 $datanew=array(
                   	  'username'=>$username);
               
            }
 
          $getprofile=$this->api_model->updateprofileinfo($datanew,$user_id);
           
            if(!empty($getprofile) && isset($getprofile))
				$this->response([
				    'profiledetails'=>$getprofile,
		            'success'=>1,
		            'error'=>0,
		            'status'=>200 
		        ], REST_Controller::HTTP_OK);
            else       
             	$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);
          }
        else 
        
			$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'Unauthorized User!'
            ], REST_Controller::HTTP_OK);
	
 }
 else
 	$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'Unauthorized User!'
            ], REST_Controller::HTTP_OK);
}









public function updateprofile1_post() {
		$headers = $this->input->request_headers();
		if(isset($headers["Jwt"])) {
        $jwt = $headers['Jwt'];

        $secretKey = base64_decode(SECRET_KEY);
		$data = Api::decode($jwt,$secretKey);
	
        $msisdn = $data->data[0]->msisdn;
        $user_id = $data->data[0]->id;
        $is_msisdn = $this->api_model->check_msisdn($msisdn);

        if($is_msisdn==TRUE || !empty($is_msisdn)) {
            $username=$this->input->post('username');

            if(isset($username) && !empty($username)) {
            	$datanew=array();
                $datanew=array('username' => $username);

                if($this->input->post('image')!='') {
                	$dir_path=$_SERVER['DOCUMENT_ROOT'].'/assets/uploads/profiles/';

            		$data=$this->input->post('image');
	            	$image_array_1 = explode(";", $data);
	            	$image_array_2 = explode(",", $image_array_1[1]);
	            	$data = base64_decode($image_array_2[1]);
	             	$imageName =time().'.png';
	             	$path =$dir_path.$imageName;
	             	file_put_contents($path, $data);
	             	$datanew['image'] = $imageName;

	             	$getuserdetails=$this->api_model->userdetails($user_id);
	                $getuserimage=$getuserdetails->image;
	                
	                if($getuserimage != '') {
                    	unlink($dir_path.$getuserimage);
	                }
            	}
                $getprofile=$this->api_model->updateprofileinfo($datanew,$user_id);
                if(!empty($getprofile) && isset($getprofile))
					$this->response([
					    'profiledetails'=>$getprofile,
			            'success'=>1,
			            'error'=>0,
			            'status'=>200 
			        ], REST_Controller::HTTP_OK);
            	else       
	             	$this->response([
						'success'=>0,
			         	'error'=>1,
	                	'status' => 400,
	                	'message' => 'No data found.'
	            	], REST_Controller::HTTP_OK);
            }
        }
        else 
        
			$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'Unauthorized User!'
            ], REST_Controller::HTTP_OK);
	}
		else 
        
			$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'Unauthorized User!'
            ], REST_Controller::HTTP_OK);
	}


	public function getquizhistory_post()
	{
		$headers = $this->input->request_headers();
        $jwt = $headers['Jwt'];
        $secretKey = base64_decode(SECRET_KEY);
		$data = Api::decode($jwt,$secretKey);
        $msisdn = $data->data[0]->msisdn;
        $user_id = $data->data[0]->id;
        $is_msisdn = $this->api_model->check_msisdn($msisdn);

        if($is_msisdn==TRUE || !empty($is_msisdn)){
			$page = $this->post('page');
			$getquizhistory=$this->api_model->getuserquizhistory($user_id, $page);
			if($getquizhistory)
				$this->response([
				    'quiz_history'=>$getquizhistory,
		            'success'=>1,
		            'error'=>0,
		            'status'=>200 
		        ], REST_Controller::HTTP_OK);
            else       
             	$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'No data found.'
            ], REST_Controller::HTTP_OK);
		} else 
			$this->response([
					'success'=>0,
		         	'error'=>1,
                	'status' => 400,
                	'message' => 'Unauthorized User!'
            ], REST_Controller::HTTP_OK);
	}

	public function getscorebycategory_post() {
		$category_id=$this->post('category_id');
		$page = $this->post('page'); 	
        $type = $this->post('type');;
        $start_date = '';
		$end_date = '';
        switch ($type) {
        	case 'this_day':
        		$start_date = date('Y-m-d');
				$end_date = date('Y-m-d');
             	break;
            case 'this_week':
             	$sub_day=date('w');
				$add_day= 6 - $sub_day;
				$Date = date('Y-m-d');
             	$start_date = date('Y-m-d', strtotime($Date. ' - '.$sub_day.' days'));
				$end_date = date('Y-m-d', strtotime($Date. ' + '.$add_day.' days'));
             	break;
            case 'this_month':
             	$sub_day=date('d')-1;
				$add_day= date('t') - date('d');
				$Date = date('Y-m-d');
             	$start_date = date('Y-m-d', strtotime($Date. ' - '.$sub_day.' days'));
				$end_date = date('Y-m-d', strtotime($Date. ' + '.$add_day.' days'));
             	break;
            case 'all_time':
             	$start_date = '';
				$end_date = '';
             	break;
            default:
             	$start_date = '';
				$end_date = '';
             	break;
        }
		$getscorebyid=$this->api_model->getuserscore($category_id, $start_date, $end_date, $page);
		if($getscorebyid) {
			$this->response([
				'score_details'=>$getscorebyid,
				'category_title'=> $this->api_model->getCategoryTitle($category_id),
		        'success'=>1,
		        'error'=>0,
		        'status'=>200 
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
		        'success'=>0,
				'error'=>1,
				'msg' => 'No Data Found',
		        'status'=>200 
			], REST_Controller::HTTP_OK);
		}
		  /*   }
             else       
             {
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

             }*/
	}

	public function getscorenew_post() {
	$page = $this->input->post('page');           	
		$getscore=$this->api_model->getscoregroupbyquizcategory1($page);
	
		if($getscore){

			$this->response([
				             'score_details'=>$getscore[0],
				             'hasmore'=>$getscore[1],
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}
             else       
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
	}
	public function getscorenew1_post(){   //28-01-2019
			

			//$page = $this->input->post('page');           	
		$getscore=$this->api_model->getscoregroupbyquizcategorycopy();
		
	
		$getuser=$this->api_model->getuserinfocopy();
		$getcat=$this->api_model->getcategorycopy();

		$userdetails=array(); 
		$usercatdetails=array();
		foreach($getuser as $gtuser){
			$userdetails[$gtuser['id_user']]=array($gtuser['first_name'],$gtuser['image']);
		}
	
		
		foreach ($getcat as $getcatlist) {
			$usercatdetails[$getcatlist['id']]=$getcatlist['title'];
		}
		
		foreach ($getscore as $key => $value) {
			$getscore[$key]['name']=($userdetails[$value['user_id']])[0];
			$getscore[$key]['image']=($userdetails[$value['user_id']])[1];
			$getscore[$key]['cat_title']=$usercatdetails[$value['category_id']];
			$getscore[$key]['total_score']=1000;
		}
		
		if($getscore) {
			$this->response([
				'score_details'=>$getscore,
		        'success'=>1,
		        'error'=>0,
		        'status'=>200 
		    ], REST_Controller::HTTP_OK);
		}
         else       
         	$this->response([
			'success'=>0,
	         'error'=>1,
            'status' => 400,
            'message' => 'No data found.'
        ], REST_Controller::HTTP_NOT_FOUND);

	}
	//Leaderboard Score
	public function getleaderboard_post(){
		$toplist=$this->api_model->getleaderboardscore();
		if($toplist){
			$this->response([
				'score_list'=>$toplist,
		        'success'=>1,
		        'error'=>0,
		        'status'=>200 
		    ], REST_Controller::HTTP_OK);
		}
		else       
         	$this->response([
			'success'=>0,
	         'error'=>1,
            'status' => 400,
            'message' => 'No data found.'
        ], REST_Controller::HTTP_NOT_FOUND);
	}


	public function getscore_post() {           	
		$getscore=$this->api_model->getscoregroupbyquizcategory();
		
		if($getscore){
		/* $key='category_id';
    	$return = array();
	   foreach($getscore as $val) {
	        $return[$val[$key]][] = $val;
	    }
	   */

			$this->response([
				             'score_details'=>$getscore,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		}
             else       
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
	}


	function login_post(){
		    $msisdn=trim($this->post('msisdn'));
		    $pswd=trim($this->post('password'));
		    if($msisdn!='' && $pswd!='')
		    {
		    	  $getloginid=$this->api_model->getlogindetails($msisdn,$pswd);
		    	  // print_r($getloginid);die('hhh');
		    	  $flag_key=$getloginid->login_count;
		    	  $uid	= $getloginid->id_user;
			 if($getloginid==TRUE || !empty($is_msisdn) || $flag_key==0)
             {
             	$data=array(
             		'user_id'=>$uid,
             		'login_time'=>date('Y-m-d h:i:s')
             	);
                $this->api_model->userLoginInfo($data);
			$tokenId    = base64_encode(32);
            $issuedAt   = time();
            $notBefore  = $issuedAt + 10;  //Adding 10 seconds
            $expire     = $notBefore + 7200; // Adding 60 seconds
            $serverName = 'http://demo.quizy.mobi/'; /// set your domain name
            $data = array(
                'iat'  => $issuedAt,         // Issued at: time when the token was generated
                'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
                'iss'  => $serverName,       // Issuer
                'nbf'  => $notBefore,        // Not before
                'exp'  => $expire,           // Expire
                'data' => array(
					array(
						'id'=>$getloginid->id_user,
						'msisdn'=>$getloginid->msisdn
					),
					
				)
            ); 

            $secretKey = base64_decode(SECRET_KEY);
                  /// Here we will transform this array into JWT:
          $jwt = Api::encode(
                    $data, //Data to be encoded in the JWT
                    $secretKey, // The signing key
                     ALGORITHM 
                   ); 
          //update login time
          $logintime=$this->api_model->updatelogintime($uid,$flag_key);
          // print_r($logintime);die('kkkk');
          //end
         $this->response(array('data'=>array('JWT'=> $jwt, 'user_details'=>$getloginid),
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ), REST_Controller::HTTP_OK);
		}
		else
		{
               $this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'Invalid Msisdn or Password!.'
            ], REST_Controller::HTTP_OK);
		}
		    }
		    else
		{
               $this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 404,
                'message' => 'No Data Found.'
            ], REST_Controller::HTTP_OK);
		}
		   
	}
		/*public function getquestion_post()
		{
			$headers=$this->input->request_headers();
             $jwt=$headers['Jwt'];
             $secretKey = base64_decode(SECRET_KEY);
			 $data = Api::decode($jwt,$secretKey);
             $msisdn=$data->data[0]->msisdn;
             $is_msisdn=$this->api_model->check_msisdn($msisdn);

             if($is_msisdn==TRUE || !empty($is_msisdn))
             {

             	$category_id=$this->post('category_id');
			$questiondetails=$this->api_model->getallquestion($category_id);

			 print_r($questiondetails);
			 die;
         
			$this->response(['questionlist'=>$questiondetails,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		     }
             else       
             {
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

             }
			}*/




			public function getquestion_post()
		{
			$headers=$this->input->request_headers();
             $jwt=$headers['Jwt'];
             $secretKey = base64_decode(SECRET_KEY);
			 $data = Api::decode($jwt,$secretKey);
             $msisdn=$data->data[0]->msisdn;
             $is_msisdn=$this->api_model->check_msisdn($msisdn);
             //print_r($is_msisdn);die('fff');
             if($is_msisdn==TRUE || !empty($is_msisdn))
             {

             	$category_id=$this->post('category_id');
				$questiondetails=$this->api_model->getallquestion($category_id);

				$question_ids = array_column($questiondetails, 'quiz_id');
				//print_r($question_ids);die();
            	$getanswerRes=$this->api_model->getanswerlist_all($question_ids);

				// print_r($getanswerRes);
			 // 	die;

     //        	$getanswer = [];
 				// foreach ($getanswerRes as $key => $value) {
 				// 	$getanswer[$value["quiz_id"]]=(object) array(
 				// 		"option_number" => $value["option_number"],
 				// 		"option_name" => $value["option_name"]
 				// 	);
 				// }
         
			$this->response(['questionlist'=>$questiondetails,
							'answerlist'=>$getanswerRes,//06.10.2020
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
		     }
             else       
             {
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

             }
			}
          
          

        /*  echo '<pre>';
          $data = Api::decode($jwt,$secretKey);

			echo json_encode($data);*/

	   public function getanswer_post()
	   {
	   	$headers=$this->input->request_headers();
             $jwt=$headers['Jwt'];
             $secretKey = base64_decode(SECRET_KEY);
			 $data = Api::decode($jwt,$secretKey);
             $msisdn=$data->data[0]->msisdn;
             $is_msisdn=$this->api_model->check_msisdn($msisdn);

             if($is_msisdn==TRUE || !empty($is_msisdn))
             {
             	$category_id=$this->post('category_id');
			    $answerdetails=$this->api_model->getallanswer($category_id);
             	$this->response(['answerlist'=>$answerdetails,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
             }
              else       
             {
             	$this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

             }

	   }
		/*Old Code*/
	// public function submitquiz_post() {
	//    	$headers=$this->input->request_headers();
 //        $jwt=$headers['Jwt'];
 //        $secretKey = base64_decode(SECRET_KEY);
	//  	$data = Api::decode($jwt,$secretKey);
 //        $msisdn=$data->data[0]->msisdn;
	// 	$is_msisdn=$this->api_model->check_msisdn($msisdn);
	
 //        if($is_msisdn==TRUE || !empty($is_msisdn)) {
	// 		$playedQuiz = json_decode($this->input->post('playedquiz'));
	// 		$answersId = array_column($playedQuiz, 'answer_id');
	// 		$answerdetails = $this->api_model->answersById($answersId);

			
	// 		$data = array(
	// 			'user_id'=>$data->data[0]->id,
	// 			'category_id'=>$this->input->post('category_id'),
	// 			'score'=> 0,
	// 			'accurate'=>0,
	// 			'not_answer' => 0,
	// 			'right'	=> 0,
	// 			'wrong'	=> 0,
	// 			'total_time'=>0,
	// 			'date_created'=>date('Y-m-d H:i:s')
	// 		);
	// 		foreach ($playedQuiz as $value) {
	// 			foreach ($answerdetails as $value_answer) {
	// 				if($value->answer_id==$value_answer->id){
	// 					$data['total_time'] += $value->option_choose_time;
	// 					if ($value->option_choose == '') {
						
	// 						$data['not_answer']++;
	// 					} else if ($value->option_choose == $value_answer->option_number) {
							
	// 						$data['right']++;
	// 						$data['score'] += $value->points;
	// 					} else {
						
	// 						$data['wrong']++;
	// 					}
	// 				}
	// 			}
				
	// 		}
	// 		$total_question = count($playedQuiz);
	// 		$data['accurate'] = ($data['right']*100)/$total_question;
		
	// 	    $quizhistory=$this->api_model->insertuserquizhistory($data);
 //            if($quizhistory)
	// 		$this->response([
	// 			            'last_id'=>$quizhistory,
	// 	                    'success'=>1,
	// 	                    'error'=>0,
	// 	                    'status'=>200 
	// 	                ], REST_Controller::HTTP_OK);
 //        } else {
 //            $this->response([
	// 			'success'=>0,
	// 	         'error'=>1,
 //                'status' => 400,
 //                'message' => 'No data found.'
 //            ], REST_Controller::HTTP_NOT_FOUND);

 //        }
	// }
	
  

	public static function decode($jwt, $key = null, $verify = true){
        	$tks = explode('.', $jwt);
	        if (count($tks) != 3) {
	            throw new UnexpectedValueException('Wrong number of segments');
	        }
        	list($headb64, $payloadb64, $cryptob64) = $tks;
        if (null === ($header = Api::jsonDecode(Api::urlsafeB64Decode($headb64)))) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        if (null === $payload = Api::jsonDecode(Api::urlsafeB64Decode($payloadb64))
        ) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        $sig = Api::urlsafeB64Decode($cryptob64);
        if ($verify) {
            if (empty($header->alg)) {
                throw new DomainException('Empty algorithm');
            }
            if ($sig != Api::sign("$headb64.$payloadb64", $key, $header->alg)) {
                throw new UnexpectedValueException('Signature verification failed');
            }
        }
        return $payload;
    }

    /**
     * @param object|array $payload PHP object or array
     * @param string       $key     The secret key
     * @param string       $algo    The signing algorithm
     *
     * @return string A JWT
     */
    public static function encode($payload, $key, $algo = 'HS256')
    {
        $header = array('typ' => 'JWT', 'alg' => $algo);

        $segments = array();
        $segments[] = Api::urlsafeB64Encode(Api::jsonEncode($header));
        $segments[] = Api::urlsafeB64Encode(Api::jsonEncode($payload));
        $signing_input = implode('.', $segments);

        $signature = Api::sign($signing_input, $key, $algo);
        $segments[] = Api::urlsafeB64Encode($signature);

        return implode('.', $segments);
    }

    /**
     * @param string $msg    The message to sign
     * @param string $key    The secret key
     * @param string $method The signing algorithm
     *
     * @return string An encrypted message
     */
    public static function sign($msg, $key, $method = 'HS256')
    {
        $methods = array(
            'HS256' => 'sha256',
            'HS384' => 'sha384',
            'HS512' => 'sha512',
        );
        if (empty($methods[$method])) {
            throw new DomainException('Algorithm not supported');
        }
        return hash_hmac($methods[$method], $msg, $key, true);
    }

    /**
     * @param string $input JSON string
     *
     * @return object Object representation of JSON string
     */
    public static function jsonDecode($input)
    {
        $obj = json_decode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            Api::handleJsonError($errno);
        }
        else if ($obj === null && $input !== 'null') {
            throw new DomainException('Null result with non-null input');
        }
        return $obj;
    }

    /**
     * @param object|array $input A PHP object or array
     *
     * @return string JSON representation of the PHP object or array
     */
    public static function jsonEncode($input)
    {
        $json = json_encode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            JWT::handleJsonError($errno);
        }
        else if ($json === 'null' && $input !== null) {
            throw new DomainException('Null result with non-null input');
        }
        return $json;
    }

    /**
     * @param string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public static function urlsafeB64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public static function urlsafeB64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * @param int $errno An error number from json_last_error()
     *
     * @return void
     */
    private static function handleJsonError($errno)
    {
        $messages = array(
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
            JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON'
        );
        throw new DomainException(isset($messages[$errno])
            ? $messages[$errno]
            : 'Unknown JSON error: ' . $errno
        );
    }

//For submitting quiz and increasing coin by 1
//Updated on: 01 Feb '19
// public function submitquiz_post() {
// 	   	$headers=$this->input->request_headers();
//         $jwt=$headers['Jwt'];
//         $secretKey = base64_decode(SECRET_KEY);
// 	 	$data = Api::decode($jwt,$secretKey);
//         $msisdn=$data->data[0]->msisdn;
//         $uid=$data->data[0]->id;
// 		$is_msisdn=$this->api_model->check_msisdn($msisdn);
	
//         if($is_msisdn==TRUE || !empty($is_msisdn)) {
// 			$playedQuiz = json_decode($this->input->post('playedquiz'));
// 			$answersId = array_column($playedQuiz, 'answer_id');
// 			$answerdetails = $this->api_model->answersById($answersId);
// 			//print_r($playedQuiz);
// 			//print_r($answerdetails);
			
// 			$data = array(
// 				'user_id'=>$data->data[0]->id,
// 				'category_id'=>$this->input->post('category_id'),
// 				'score'=> 0,
// 				'accurate'=>0,
// 				'not_answer' => 0,
// 				'right'	=> 0,
// 				'wrong'	=> 0,
// 				'total_time'=>0,
// 				'date_created'=>date('Y-m-d H:i:s')
// 			);
// 			foreach ($playedQuiz as $value) {
// 				foreach ($answerdetails as $value_answer) {
// 					if($value->answer_id==$value_answer->id){
// 						$data['total_time'] += $value->option_choose_time;
// 						if ($value->option_choose == '') {
// 							// These Question are not choosen.
// 							$data['not_answer']++;
// 						} else if ($value->option_choose == $value_answer->option_number) {
// 							// These Questions answered right.
// 							$data['right']++;
// 							$data['score'] += $value->points;
// 						} else {
// 							// These Questions are answered wrong.
// 							$data['wrong']++;
// 						}
// 					}
// 				}
// 				// echo json_encode($value);
// 			}
// 			$total_question = count($playedQuiz);
// 			$data['accurate'] = ($data['right']*100)/$total_question;
// 			// print_r($data);
// 		    $quizhistory=$this->api_model->insertuserquizhistory($data);
// 		    $coinupdate=$this->api_model->giftcoinupdate($uid);
//             if($quizhistory && $coinupdate)
// 			$this->response([
// 				            'last_id'=>$quizhistory,
// 		                    'success'=>1,
// 		                    'error'=>0,
// 		                    'status'=>200 
// 		                ], REST_Controller::HTTP_OK);
//         } else {
//             $this->response([
// 				'success'=>0,
// 		         'error'=>1,
//                 'status' => 400,
//                 'message' => 'No data found.'
//             ], REST_Controller::HTTP_NOT_FOUND);

//         }
// 	}


    //For input type question calculation (13.10.2020)
	public function submitquiz_post() 
	{
	   	$headers=$this->input->request_headers();
        $jwt=$headers['Jwt'];
        $secretKey = base64_decode(SECRET_KEY);
	 	$data = Api::decode($jwt,$secretKey);
        $msisdn=$data->data[0]->msisdn;
        $uid=$data->data[0]->id;
		$is_msisdn=$this->api_model->check_msisdn($msisdn);
	
        if($is_msisdn==TRUE || !empty($is_msisdn)) 
        {
			$playedQuiz = json_decode($this->input->post('playedquiz'));
			$answersId = array_column($playedQuiz, 'answer_id');
			$answerdetails = $this->api_model->answersById($answersId);
			//print_r($playedQuiz);
			//print_r($answerdetails);
			
			$data = array(
				'user_id'=>$data->data[0]->id,
				'category_id'=>$this->input->post('category_id'),
				'score'=> 0,
				'accurate'=>0,
				'not_answer' => 0,
				'right'	=> 0,
				'wrong'	=> 0,
				'total_time'=>0,
				'date_created'=>date('Y-m-d H:i:s')
			);
			foreach ($playedQuiz as $value) 
			{
				foreach ($answerdetails as $value_answer) 
				{
					if($value_answer->questioninput=="yes")
					{
						if($value->answer_id==$value_answer->id)
						{
							$data['total_time'] += $value->option_choose_time;
							if($value->userAnseredMatched=="yes")
							{
								// These Questions answered right.
								$data['right']++;
								$data['score'] += $value->points;
							}
							elseif ($value->userAnseredMatched=="no") 
							{
								// These Questions are answered wrong.
								$data['wrong']++;
							}
							elseif ($value->option_choose=="") 
							{
								// These Question are not choosen.
								$data['not_answer']++;
							}
						}	
					}
					elseif ($value_answer->questioninput=="no") 
					{
						if($value->answer_id==$value_answer->id)
						{
							$data['total_time'] += $value->option_choose_time;
							if ($value->option_choose == '') 
							{
								// These Question are not choosen.
								$data['not_answer']++;
							} 
							else if ($value->option_choose == $value_answer->option_number)
							{
								// These Questions answered right.
								$data['right']++;
								$data['score'] += $value->points;
							} 
							else 
							{
								// These Questions are answered wrong.
								$data['wrong']++;
							}
						}
					}
					elseif ($value_answer->questioninput=="") 
					{
						if($value->answer_id==$value_answer->id)
						{
							$data['total_time'] += $value->option_choose_time;
							if ($value->option_choose == '') 
							{
								// These Question are not choosen.
								$data['not_answer']++;
							} 
							else if ($value->option_choose == $value_answer->option_number)
							{
								// These Questions answered right.
								$data['right']++;
								$data['score'] += $value->points;
							} 
							else 
							{
								// These Questions are answered wrong.
								$data['wrong']++;
							}
						}
					}
					
				}
				// echo json_encode($value);
			}
			$total_question = count($playedQuiz);
			$data['accurate'] = ($data['right']*100)/$total_question;
			// print_r($data);
		    $quizhistory=$this->api_model->insertuserquizhistory($data);
		    $coinupdate=$this->api_model->giftcoinupdate($uid);
            if($quizhistory && $coinupdate)
			$this->response([
				            'last_id'=>$quizhistory,
		                    'success'=>1,
		                    'error'=>0,
		                    'status'=>200 
		                ], REST_Controller::HTTP_OK);
        } 
        else 
        {
            $this->response([
				'success'=>0,
		         'error'=>1,
                'status' => 400,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);

        }
	}


	
	

}
