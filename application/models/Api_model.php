<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_quizset_list()
	{
		$q = $this->db->get("quiz_set");
		if($q->num_rows() > 0)
		{
			return $q->result();
		}
	}

	public function get_latestquiz_list()
	{
		//$this->save_queries=TRUE;
		$this->db->select('id,title,title_image,no_of_question as total');
		$this->db->from('quiz_set');
		//$this->db->join('quizset_question','quizset_question.quiz_set_id=quiz_set.id','left');
		//$this->db->join('ussd_quiz','ussd_quiz.id=quizset_question.quiz_id');
        //$this->db->where('ussd_quiz.is_active',1);
		$this->db->where('quiz_set.is_active',1);

		//$this->db->group_by('quizset_question.quiz_set_id');
		$this->db->order_by('quiz_set.click_catagory','desc');
		$this->db->limit(5);

		$q =$this->db->get();
		/*echo $this->db->last_query();die; */
		 if($q->num_rows() > 0)
		{
			return $q->result();
		}
	}
	public function get_popularquiz_list()
	{
		$this->db->select('id,title,title_image,no_of_question as total');
		$this->db->from('quiz_set');
		//$this->db->join('quizset_question','quizset_question.quiz_set_id=quiz_set.id','left');
		//$this->db->join('ussd_quiz','ussd_quiz.id=quizset_question.quiz_id');
        //$this->db->where('ussd_quiz.is_active',1);
		$this->db->where('quiz_set.is_active',1);
		//$this->db->group_by('quizset_question.quiz_set_id');
		$this->db->order_by('click_catagory','desc');
		$this->db->order_by('date_created','desc');
		$this->db->limit(10);

		$q =$this->db->get();
		/*echo $this->db->last_query();die; */
		 if($q->num_rows() > 0)
		{
			return $q->result();
		}
	}
	public function getfaq()
	{
		$this->db->select('*');
		$this->db->from('faq_settings');
		$q=$this->db->get();
		if($q->num_rows() >0)
		{
			return $q->result();
		}
	}
	public function getpagecontent($page)
	{
		$this->db->select('*');
		$this->db->from('settings');
		$this->db->where('type',$page);
		$q=$this->db->get();
		if($q->num_rows() >0)
		{
			return $q->result();
		}
	} 
	public function getcategorybyid($id)
	{
		$this->db->select('id,title,description,banner_image title_image,no_of_question as total');
		$this->db->where('quiz_set.id',$id);
		$this->db->where('quiz_set.is_active',1);
		$this->db->from('quiz_set');
		//$this->db->join('quizset_question','quiz_set.id=quizset_question.quiz_set_id','left');
		//$this->db->join('ussd_quiz','ussd_quiz.id=quizset_question.quiz_id');
        /*$this->db->where('ussd_quiz.is_active',1);*/
		//$this->db->group_by('quizset_question.quiz_set_id');
		$q=$this->db->get();

		if($q->num_rows() >0)
		{
			return $q->row();
		}
	}

	//************************   pvp models   *********************************
	
	//16.10.2020
	public function getpvpquestionid($id)
	{
		$this->db->select('id,title,description,banner_image title_image,no_of_question as total');
		$this->db->where('quiz_set.id',$id);
		$this->db->where('quiz_set.is_admin',1);
		//$this->db->where('quiz_set.is_active',1);
		$this->db->from('quiz_set');
		//$this->db->join('quizset_question','quiz_set.id=quizset_question.quiz_set_id','left');
		//$this->db->join('ussd_quiz','ussd_quiz.id=quizset_question.quiz_id');
        /*$this->db->where('ussd_quiz.is_active',1);*/
		//$this->db->group_by('quizset_question.quiz_set_id');
		$q=$this->db->get();

		if($q->num_rows() >0)
		{
			return $q->row();
		}
	}

	//16.10.2020
	public function getpvpquestionall($id)
	{
		$this->db->select('quizset_question.quiz_id,ussd_quiz.title,ussd_quiz.quiz_image,ussd_quiz.video_url,ussd_quiz.audio_url,ussd_quiz.answer_id,ussd_quiz.options,ussd_quiz.points,level,ussd_quiz.questioninput');
        $this->db->from('quizset_question');
        $this->db->where('quiz_set_id', $id);
        $this->db->join('ussd_quiz','quizset_question.quiz_id=ussd_quiz.id');
        $this->db->where('ussd_quiz.is_active',1);
        $this->db->order_by('rand()');
        $this->db->limit(5);
        $q=$this->db->get();
        $questions = $q->result_array();
        return  $questions;
	}

	//19.10.2020
	public function insertpvpuser($data)
	{
	   $this->db->insert('pvp_user',$data);
		if($this->db->affected_rows()>0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	//19.10.2020
	public function check_user_id($id)
	{

        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where('id_user',$id);
        $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return true;
        }
        else
        {
           return false;	
        }
	}

	// //19.10.2020
	// public function check_total_user($start_time = '',$end_time = '',$category)
	// {
 //        $this->db->select('user_id,DATE(play_button_click) as date,COUNT(user_id) as count_user,id');
 //        $this->db->from('pvp_user');
 //        $this->db->where(array(
 //        						'(play_button_click)>='=>$start_time,
 //        						'(play_button_click)<='=>$end_time,
 //        						'category_id'=>$category
 //        					  )
 //    					);       
 //        $this->db->group_by('date(play_button_click)');
 //        $q=$this->db->get();
 //        if($q->num_rows() >0)
 //        {  
 //        	return $q->result_array();
 //        }
 //        else
 //        {
 //           return false;	
 //        }
	// }


	//20.10.2020
	public function check_total_user($start_time = '',$end_time = '',$category ,$user_id)
	{
        $this->db->select('user_id,id,play_button_click');
        $this->db->from('pvp_user');
        $this->db->where(array(
        						'(play_button_click)>='=>$start_time,
        						'(play_button_click)<='=>$end_time,
        						'category_id'=>$category,
        						'user_id!='=>$user_id
        					  )
    					);       
        $this->db->group_by('user_id');
        $this->db->order_by('play_button_click','asc');
        $this->db->limit(5);
        $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->result_array();
        }
        else
        {
           return false;	
        }
	}

	//20.10.2020
	public function check_total_user_test($start_time = '',$end_time = '',$category)
	{
        $this->db->select('user_id,id,play_button_click');
        $this->db->from('pvp_user');
        $this->db->where(array(
        						'(play_button_click)>='=>$start_time,
        						'(play_button_click)<='=>$end_time,
        						'category_id'=>$category
        					  )
    					);       
        $this->db->group_by('user_id');
        $this->db->order_by('play_button_click','asc');
        $this->db->limit(2);
        $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->result_array();
        }
        else
        {
           return false;	
        }
	}

	//21.10.2020
	public function insert_pvpuserquizhistory($data)
	{
	   $this->db->insert('pvp_user_quiz_history',$data);
		if($this->db->affected_rows()>0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	//21.10.2020
	public function pvp_getuserquizhistorybyid($id) {
    	$this->db->select('*');
      	$this->db->from('pvp_user_quiz_history');
      	$this->db->join('user_login','pvp_user_quiz_history.user_id=user_login.id_user');
      	$this->db->where('pvp_user_quiz_history.id',$id);
		$q=$this->db->get();
        if($q->num_rows() >0) {  
        	return $q->row_array();
        } else {
           return false;	
        }
	}

	//21.10.2020
	public function pvp_resultid_test() {
    	$this->db->select('*');
      	$this->db->from('pvp_user_quiz_history');
      	//$this->db->join('user_login','pvp_user_quiz_history.user_id=user_login.id_user');
      	//$this->db->where('pvp_user_quiz_history.id',$id);
		$q=$this->db->get();
        if($q->num_rows() >0) {  
        	//return $q->row_array();
        	return $q->result_array();
        } else {
           return false;	
        }
	}

	//************************   pvp models   *********************************

     public function getNoOfAttempt($id)
      {
      	$this->db->select('no_of_attempt');
		return $this->db->get_where('quiz_set',array('id'=>$id))->row_array();
      }

      public function quizplayuser($id,$cat_id)
      {
      	$this->db->select('*');
      	$q=$this->db->get_where('user_quiz_history',array('user_id'=>$id,'category_id'=>$cat_id));
      	return $q->num_rows();
      }



	public function getlogindetails($msisdn_no,$pass_word)
	{
      $this->db->select('id_user,first_name,last_name,username,msisdn,email,image,coin,login_count');
      $this->db->from('user_login');
      $this->db->where(
      	                 array('msisdn'=>$msisdn_no,
                           'password'=>$pass_word 
                            )
      	               );
      $q=$this->db->get();
      if($q->num_rows() >0)
      {
      	return $q->row();
      }
      else
      {
      	return false;
      }
	}
	public function updatelogintime($uid,$flag_key)
	{		$curr_time=date("Y-m-d H:i:s");
      		$data	= array(
               				'last_logged' => $curr_time,
               				'login_count' =>$flag_key + 1
            				);
      	// $this->db->set('first_login', '`first_login`+ 1', FALSE);
		$this->db->where('id_user', $uid);
		$this->db->update('user_login', $data); 
      	
      	if($this->db->affected_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}
	/*public function getallquestion($id)
	{
		$this->db->select('quizset_question.quiz_id,ussd_quiz.title,ussd_quiz.quiz_image,ussd_quiz.answer_id,ussd_quiz.options,ussd_quiz.points,ussd_quiz.level');
		$this->db->where('quiz_set_id',$id);
		$this->db->from('quizset_question');
        $this->db->join('ussd_quiz','quizset_question.quiz_id=ussd_quiz.id');
        $this->db->where('ussd_quiz.is_active',1);
      $q=$this->db->get();

		if($q->num_rows() >0)
		{
			// call count cat
			$this->categoryclick($id);
			return $q->result();
		}

	}*/


	public function getNoOfQuestion($id) {
		$this->db->select('no_of_question');
		return $this->db->get_where('quiz_set',array('id'=>$id))->row_array();
	}

     public function getallquestion($id) {
		$in_easy=array(1,2);
		$in_medium=array(3,4);
		$in_hard=array(5);
        
        $total_question=$this->getNoOfQuestion($id);
        $total_question=$total_question["no_of_question"];
        
        // 40% Question on level 0 - 1
        $limit_easy = $total_question * 0.4;
        // 40% Question on level 2 - 3
        $limit_medium = $total_question * 0.4;
        // 40% Question on level 5
        $limit_hard = $total_question * 0.2;
        
        // Easy Question
        $this->db->select('quizset_question.quiz_id,ussd_quiz.title,ussd_quiz.quiz_image,ussd_quiz.video_url,ussd_quiz.audio_url,ussd_quiz.answer_id,ussd_quiz.options,ussd_quiz.points,level,ussd_quiz.questioninput');
        $this->db->from('quizset_question');
        $this->db->where('quiz_set_id', $id);
        $this->db->join('ussd_quiz','quizset_question.quiz_id=ussd_quiz.id');
        $this->db->where('ussd_quiz.is_active',1);
        $this->db->where_in('level', $in_easy); 
        $this->db->order_by('rand()');
        $this->db->limit($limit_easy);
        $q=$this->db->get();
        $easy_questions = $q->result_array();

        //Medium Question
        $this->db->select('quizset_question.quiz_id,ussd_quiz.title,ussd_quiz.quiz_image,ussd_quiz.video_url,ussd_quiz.audio_url,ussd_quiz.answer_id,ussd_quiz.options,ussd_quiz.points,level,ussd_quiz.questioninput');
        $this->db->from('quizset_question');
        $this->db->where('quiz_set_id', $id);
        $this->db->join('ussd_quiz','quizset_question.quiz_id=ussd_quiz.id');
        $this->db->where('ussd_quiz.is_active',1);
        $this->db->where_in('level', $in_medium); 
        $this->db->order_by('rand()');
        $this->db->limit($limit_medium);
        $q=$this->db->get();
        $medium_questions = $q->result_array();

        //Hard Question
        $this->db->select('quizset_question.quiz_id,ussd_quiz.title,ussd_quiz.quiz_image,ussd_quiz.video_url,ussd_quiz.audio_url,ussd_quiz.answer_id,ussd_quiz.options,ussd_quiz.points,level,ussd_quiz.questioninput');
        $this->db->from('quizset_question');
        $this->db->where('quiz_set_id', $id);
        $this->db->join('ussd_quiz','quizset_question.quiz_id=ussd_quiz.id');
        $this->db->where('ussd_quiz.is_active',1);
        $this->db->where_in('level', $in_hard); 
        $this->db->order_by('rand()');
        $this->db->limit($limit_hard);
        $q=$this->db->get();
        $hard_question = $q->result_array();
        $questions = array_merge($easy_questions, $medium_questions, $hard_question);
		if(count($questions)>0)
		{
			// call count cat
			$this->categoryclick($id);
			return $questions;
		}

	}

	// public function getanswerlist_all($category_id) {
	// 		$this->db->select('ussd_quiz_options.quiz_id, ussd_quiz_options.option_number ,ussd_quiz_options.option_name');
	// 		$this->db->from('quizset_question');
	// 		$this->db->join('ussd_quiz_options','quizset_question.quiz_id=ussd_quiz_options.quiz_id');
	// 		$this->db->where('quizset_question.quiz_set_id', $category_id);
	// 		$this->db->order_by('quizset_question.quiz_set_id','desc');
	//       	$q = $this->db->get();
	//    //    	print_r($this->db->last_query());
	//    //    	if($q->num_rows() >0)
	// 	 	// {
	// 	 	// 	return $q->result();
	// 	 	// }

	// 	 	$answer = $q->result_array();
 //        	return  $answer;
	// 	}


	//06.10.2020
	public function getanswerlist_all($question_ids = array()) {
			$this->db->select('quiz_id, option_number ,is_answer,upper(option_name) as option_name');
			$this->db->from('ussd_quiz_options');
			$this->db->where_in('quiz_id', $question_ids);
	      	$q = $this->db->get();
	   //    	print_r($this->db->last_query());
	   //    	if($q->num_rows() >0)
		 	// {
		 	// 	return $q->result();
		 	// }

		 	$answer = $q->result_array();
        	return  $answer;
		}


     
     public function categoryclick($rew_id)
	{
		$this->db->set('click_catagory','click_catagory+1',false);
		$this->db->where('id',$rew_id);
		$this->db->update('quiz_set'); 
	}

	// public function answersById($ids=array()) {
	// 	$this->db->select('*');
	// 	$this->db->from('ussd_quiz_options');
	// 	$this->db->where_in('id', $ids);
 //      	$q=$this->db->get();
	// 	if($q->num_rows() >0)
	// 	{
	// 		return $q->result();
	// 	}

	// }


	//13.10.2020
	public function answersById($ids=array()) {
		$this->db->select('ussd_quiz_options.id,ussd_quiz_options.quiz_id,ussd_quiz_options.option_number,ussd_quiz_options.option_name,ussd_quiz_options.is_answer,ussd_quiz.questioninput');
		$this->db->from('ussd_quiz_options');
		$this->db->join('ussd_quiz','ussd_quiz.id=ussd_quiz_options.quiz_id');
		$this->db->where_in('ussd_quiz_options.id', $ids);
      	$q=$this->db->get();
		if($q->num_rows() >0)
		{
			return $q->result();
		}

	}

		public function getallanswer($id)
	{
		$this->db->select('quizset_question.quiz_id,ussd_quiz.answer_id,ussd_quiz_options.option_number,ussd_quiz_options.option_name');
		$this->db->where('quiz_set_id',$id);
		$this->db->from('quizset_question');
        $this->db->join('ussd_quiz','quizset_question.quiz_id=ussd_quiz.id');
        $this->db->join('ussd_quiz_options','ussd_quiz.id=ussd_quiz_options.quiz_id');
        $this->db->where('ussd_quiz_options.is_answer',1);
        $this->db->where('ussd_quiz.is_active',1);
      $q=$this->db->get();

		if($q->num_rows() >0)
		{
			return $q->result();
		}

	}

	public function check_msisdn($id)
	{

        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where('msisdn',$id);
        $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return true;
        }
        else
        {
           return false;	
        }
	}

	public function getbanner()
	{
		/*$this->save_queries=TRUE;*/

		$this->db->select('id,banner_description,category_id,banner_image');
		$this->db->from('ussd_banner');
		//$this->db->where('ussd_banner.is_active',1);
       //$this->db->join('quizset_question','quizset_question.quiz_set_id=ussd_banner.category_id');
		//$this->db->join('quiz_set','quizset_question.quiz_set_id=quiz_set.id','left');
		//$this->db->join('ussd_quiz','ussd_quiz.id=quizset_question.quiz_id');
        //$this->db->where('ussd_quiz.is_active',1);
		//$this->db->where('quiz_set.is_active',1);
		$this->db->where('is_active',1);
		$this->db->where('banner_type','category');
        //$this->db->group_by(array('quizset_question.quiz_set_id','ussd_banner.category_id'));
          
        /*$this->db->get();
        echo $this->db->last_query();
        die;*/
		 $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->result();
        }
        else
        {
           return false;	
        }
	}

	public function getbannernew()  //15-01-19
	{
		$this->db->select('id,banner_title,banner_image');
		$this->db->from('quiz_set');
		$this->db->where('is_active',1);
		 $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->result();
        }
        else
        {
           return false;	
        }
	}
	// public function getrwdbanner()
	// {
	// 	$this->db->select('id,banner_description,banner_image,category_id as reward_id');
	// 	$this->db->from('ussd_banner');
	// 	//$this->db->join('ussd_reward','ussd_banner.category_id=ussd_reward.id');
	// $this->db->where('ussd_banner.banner_type','category');
	// $this->db->where('ussd_banner.is_active',1);
	// $q=$this->db->get();
 //        if($q->num_rows() >0)
 //        {  
 //        	return $q->result();
 //        }
 //        else
 //        {
 //           return false;	
 //        }
	// }




public function getrwdbanner()
	{
		$this->db->select('id,title,description,reward_image,banner_image,coin');
		$this->db->from('ussd_reward');
		//$this->db->join('ussd_reward','ussd_banner.category_id=ussd_reward.id');
	// $this->db->where('ussd_reward.banner_image','banner_image');
	$this->db->where('ussd_reward.is_active',1);
	// $this->db->limit(3);
	$q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->result();
        }
        else
        {
           return false;	
        }
	}






	public function getreward()
	{
		$this->db->select('id,title,reward_image,coin');
		$this->db->from('ussd_reward');
		$this->db->where('ussd_reward.is_active',1);
		 $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->result();
        }
        else
        {
           return false;	
        }
	}
	public function gettopreward()
	{
		$this->db->select('id,title,reward_image,coin');
		$this->db->from('ussd_reward');
		$this->db->where('ussd_reward.is_active',1);
		$this->db->order_by('click_reward','desc');
		$this->db->order_by('date_created','desc');
		$this->db->limit(10);
		 $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->result();
        }
        else
        {
           return false;	
        }
	}

	public function getmyrewardlist($id, $page = 0) {
		$limit = 5;
	   	$offset = $page == 0 ? 0 : $page * $limit;
		
		$this->db->select('*');
		$this->db->from('ussd_user_reward');
		$this->db->join('ussd_reward','ussd_user_reward.reward_id=ussd_reward.id');
		$this->db->where('ussd_user_reward.user_id',$id);
		$this->db->order_by('ussd_user_reward.created_at','desc');
		$this->db->limit($limit,$offset);

		$q=$this->db->get();
        if($q->num_rows() >0) {  
        	return $q->result_array();
        } else {
           return false;	
        }
	}

	public function getrewardbyid($rew_id)
	{
		$this->db->select('*');
		$this->db->from('ussd_reward');
		$this->db->where('id',$rew_id);
		$this->db->where('is_active',1);
		 $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->row();
        }
        else
        {
           return false;	
        }
	}
	public function userdetails($userid)
	{
		$this->db->select('*');
		$this->db->from('user_login');
		$this->db->where('id_user',$userid);
		 $q=$this->db->get();
        if($q->num_rows() >0)
        {  
        	return $q->row();
        }
        else
        {
           return false;	
        }
	}
	public function userLoginInfo($data=array()){
		$this->db->insert('user_login_info',$data);
		if($this->db->affected_rows()>0)
		{
			return true;
		}else{
			return false;
		}


	}
	
	public function userreward($data)
	{
     	$this->db->insert('ussd_user_reward',$data);
		if($this->db->affected_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}
	public function insertuserquizhistory($data)
	{
	   $this->db->insert('user_quiz_history',$data);
		if($this->db->affected_rows()>0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	

	public function getuserquizhistorybyid($id) {
    	$this->db->select('*');
      	$this->db->from('user_quiz_history');
      	$this->db->join('user_login','user_quiz_history.user_id=user_login.id_user');
      	$this->db->where('user_quiz_history.id',$id);
		$q=$this->db->get();
        if($q->num_rows() >0) {  
        	return $q->row_array();
        } else {
           return false;	
        }
	}
	public function getcattile($id=array())
	{
		$this->db->select('title');
		$this->db->from('quiz_set');
		$this->db->where(array('id'=>$id));
		$q=$this->db->get();
        if($q->num_rows() >0) {  
        	$data = $q->row_array();
        	return $data['title'];
        } else {
           return false;	
        }

	}


	public function getuserquizhistory($id, $page = 0) {
		$limit = 5;
	   	$offset = $page == 0 ? 0 : $page * $limit;
	    
    	$this->db->select('user_quiz_history.id as qhid, user_quiz_history.category_id, accurate, title, title_image, score, not_answer, right, wrong, total_time');
      	$this->db->from('user_quiz_history');
      	$this->db->where('user_quiz_history.user_id',$id);
	  	$this->db->join('quiz_set','user_quiz_history.category_id=quiz_set.id');
	  	$this->db->limit($limit,$offset);
	   
		$q=$this->db->get();
        if($q->num_rows() >0) {  
        	return $q->result_array();
        } else {
           return false;	
        }
	}
     
     public function getuserscore($catid, $start_date, $end_date, $page = 0) {
		$limit = 3;
		$offset = $page == 0 ? 0 : $page * $limit;
		   
	  //	$this->db->select('id as score_id,max(user_quiz_history.score) as score, CONCAT((first_name),(" "),(last_name)) AS name, image, right, wrong, total_time');
	  //$this->db->select('*');
		// $this->db->select('MAX(score) as score, id, user_id, right, wrong, total_time, date_created');  
		// $this->db->from('user_quiz_history');
		// $this->db->where(array('category_id'=>$catid));
		// $this->db->group_by('user_id');
		// $this->db->having('score=MAX(score)');
      	// If START DATE & END DATE is set then find between two date
      	// if($start_date!='' && $end_date!=''){
       	// 	$this->db->where("DATE_FORMAT(user_quiz_history.date_created,'%Y-%m-%d') >= '".$start_date."'",NULL,FALSE);
       	// 	$this->db->where("DATE_FORMAT(user_quiz_history.date_created,'%Y-%m-%d') <= '".$end_date."'",NULL,FALSE);
   		// }
   		// ELSE find all
	    //
		// $this->db->order_by('date_created', 'DESC');
		
		// $this->db->order_by('score', 'DESC');
		// $this->db->order_by('total_time', 'ASC');
		// $this->db->group_by('user_id');
		//$this->db->join('user_login','user_quiz_history.user_id=user_login.id_user');
		//$this->db->having('score=MAX(score)');
       // $this->db->order_by('first_name', 'ASC');
		//$this->db->group_by('user_login.id_user');
		// $this->db->having(array('user_quiz_history.score'=>max(user_quiz_history.score)),false);
		//$this->db->limit($limit,$offset);
		$this->db->select('virtual_score_by_category.score,virtual_score_by_category.right,virtual_score_by_category.wrong,virtual_score_by_category.total_time,CONCAT((user_login.first_name),(" "),(user_login.last_name)) AS name, user_login.image');
		$this->db->where(array('category_id' => $catid));
		if($start_date!='' && $end_date!=''){
       		$this->db->where("DATE_FORMAT(virtual_score_by_category.date_created,'%Y-%m-%d') >= '".$start_date."'",NULL,FALSE);
       		$this->db->where("DATE_FORMAT(virtual_score_by_category.date_created,'%Y-%m-%d') <= '".$end_date."'",NULL,FALSE);
   		}
		$this->db->from('virtual_score_by_category');
		$this->db->join('user_login','virtual_score_by_category.user_id=user_login.id_user');
		$this->db->order_by('virtual_score_by_category.score', 'DESC');
		$this->db->order_by('virtual_score_by_category.total_time', 'ASC');
		$this->db->group_by('user_id');
		//$this->db->limit($limit,$offset);
		$q=$this->db->get();
		$q->result_array();
	    if($q->num_rows() >0)
        {  
			return $q->result_array();
        }
        else
        {
           return false;	
        }
       

	}


	public function getscoregroupbyquizcategory() {
      	// $this->db->select('*');
     /*	echo $q=$this->db->query('CREATE VIEW virtual_score_history as select max(user_quiz_history.score) as score,accurate, user_quiz_history.date_created, user_id, category_id from user_quiz_history group by category_id,user_id order by score desc');
     	die;
*/
        /*$q=$this->db->query('select * from virtual_score_history where (select count(*) from virtual_score_history as f
            where f.category_id = virtual_score_history.category_id and f.score >= virtual_score_history.score
            ) <= 3;');*/

           $this->db->select('score,user_id,virtual_score_history.category_id,title,CONCAT((first_name),(" "),(last_name)) AS name, image');
           $this->db->from('virtual_score_history');
            $this->db->where('(select count(*) from virtual_score_history as f
            where f.category_id = virtual_score_history.category_id and f.score >= virtual_score_history.score
            ) <= 3');
          $this->db->join('user_login','virtual_score_history.user_id=user_login.id_user');
          $this->db->join('quiz_set','virtual_score_history.category_id=quiz_set.id');
          $this->db->order_by('score','DESC');
          $this->db->order_by('category_id','DESC');
           $this->db->order_by('accurate','DESC');

         $q=$this->db->get();
       

          //  $this->db->select('*');
          //  $this->db->from('virtual_score_history');
      
/*      	$this->db->select('max(user_quiz_history.score) as score, user_quiz_history.date_created, user_id, category_id, title, CONCAT((first_name),(" "),(last_name)) AS name, image');
      	$this->db->from('user_quiz_history');
      	$this->db->group_by(array('category_id','user_id'));
      	$this->db->order_by('score', 'DESC');
  
	    $this->db->join('user_login','user_quiz_history.user_id=user_login.id_user');
	    $this->db->join('quiz_set','user_quiz_history.category_id=quiz_set.id');*/
       
        /*$q=$this->db->get();*/
        
        if($q->num_rows() >0)
        {  
        	return $q->result_array();
        
        }
        else
        {
           return false;	
        }
       

	}

  public function getscoregroupbyquizcategorycopy()  //28-01-2019
  {
  	$data=array(1=>'goutam');
  	$this->db->select('user_id,category_id,accurate,total_time,right,score,(`right` + `wrong` + `not_answer`) AS total_question');
  	$this->db->from('user_quiz_history');
  	$this->db->order_by('score','desc');
  	$this->db->order_by('total_time','asc');
  	$this->db->order_by('accurate','desc');
  	$this->db->limit(10);
  	$q=$this->db->get();
   if($q->num_rows() >0) {  
        	return $q->result_array();
        	

        } else {
           	return false;	
        }

  }
  /*GET Leader Board data*/
public function getleaderboardscore(){

	$this->db->select('user_login.first_name,user_login.last_name,user_quiz_history.user_id,SUM(user_quiz_history.score) as score,user_login.coin,SUM(user_quiz_history.total_time) as total_time,user_login.image');
	$this->db->from('user_quiz_history');
	$this->db->join('user_login', 'user_quiz_history.user_id=user_login.id_user','inner');
	$this->db->group_by('user_quiz_history.user_id');
	$this->db->order_by('score','desc');
	$this->db->order_by('total_time','asc');
	$this->db->limit(3);

	$q=$this->db->get();

	if($q->num_rows() >0){  
        					return $q->result_array();
        		 		 }
        		 	else {
           					return false;	
        				 }
}


  public function getuserinfocopy(){
  	$this->db->select('id_user,first_name,image');
    $this->db->from('user_login');
    $userinfo=$this->db->get();
    if($userinfo->num_rows()>0)
     {
      return $userinfo->result_array();
     }
     else
     {
     return false;
     }
   }
    public function getcategorycopy(){
  	$this->db->select('id,title');
    $this->db->from('quiz_set');
    $catinfo=$this->db->get();
    if($catinfo->num_rows()>0)
     {
      return $catinfo->result_array();
     }
     else
     {
     return false;
     }
   }


	public function getscoregroupbyquizcategory1($page=0) {
      	
         	$limit = 3;
   	   $offset = $page == 0 ? 0 : $page*$limit;
           $this->db->select('score,user_id,virtual_score_history.category_id,CONCAT((first_name),(" "),(last_name)) AS name, image');
           $this->db->from('virtual_score_history');
            $this->db->where('(select count(*) from virtual_score_history as f
            where f.category_id = virtual_score_history.category_id and f.score >= virtual_score_history.score
            ) <= 3');
          $this->db->join('user_login','virtual_score_history.user_id=user_login.id_user');
          //$this->db->join('quiz_set','virtual_score_history.category_id=quiz_set.id');
          $this->db->order_by('score','DESC');
          $this->db->order_by('category_id','DESC');

           $this->db->order_by('accurate','DESC');

         $q=$this->db->get();
        
        if($q->num_rows() >0)
        {  
        	$data = array();
   		$scorelist=$q->result_array();
   		  $this->db->select('id,title');
   		  $this->db->from('quiz_set');
   		   $this->db->order_by('click_catagory','DESC');
          $quizset=$this->db->get()->result_array();
         /* $i=0;*/
        /* print_r($scorelist);
         die;*/
         	$datascr=array();
           foreach($quizset as $qzlst)
           {
			   $match = false;
             	$dataqz=array();
             foreach($scorelist as $scrlst)
             {
             	if($scrlst['category_id']==$qzlst['id']) {
					$match = true;
             	  	unset($scrlst['category_id']);
                  	$dataqz[]=$scrlst;
             	} 
			 }
			 if ($match)
             $datascr[]=array(
              'category_id'=>$qzlst['id'],
              'title'=>$qzlst['title'],
              'scores'=>$dataqz

             );
           }

           $has_more=count($datascr)>($offset+$limit)? true : false;
   		$data = array_slice($datascr,$offset,$limit);
   		if(count($data))
   		   return array($data, $has_more);
   		else
   			return false;
           
       //  print_r($datascr); die;
        
        }
        else
        {
           return false;	
        }
       

	}


	public function updatecoin($usercoin,$userid)
	{
		$this->db->set('coin',$usercoin);
		$this->db->where('id_user',$userid);
		$this->db->update('user_login');
		
		if($this->db->affected_rows() >= 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function rewardclick($rew_id)
	{
		$this->db->set('click_reward','click_reward+1',false);
		$this->db->where('id',$rew_id);
		$this->db->update('ussd_reward'); 
	}
	
	public function getsearchlist($cat_title) { 
       	$this->db->select('id, title, title_image, no_of_question as total_question');
		$this->db->from('quiz_set');
		// $this->db->join('quizset_question','quizset_question.quiz_set_id=quiz_set.id','left');
		// $this->db->join('ussd_quiz','ussd_quiz.id=quizset_question.quiz_id');
        // $this->db->where('ussd_quiz.is_active',1);
		$this->db->where('is_active',1);
		$this->db->like('title',$cat_title,'both'); 
		// $this->db->group_by('quizset_question.quiz_set_id');
		// $this->db->limit(10);
		$q=$this->db->get();
        if($q->num_rows() >0) {  
        	return $q->result_array();
        } else {
           	return false;	
        }
	}

   public function get_group_list($page = 0) {
   	$limit = 3;
   	$offset = $page == 0 ? 0 : $page*$limit;
   	$this->db->select('*');
   	$this->db->from('ussd_group');
   	$q=$this->db->get();
   	if($q->num_rows() >0) {
   		$data = array();
   		$groups=$q->result_array();
   		foreach($groups as $group) {
   			$categories = $this->get_catgoriesbygroupid($group['id']);
   		   	if($categories)
	   		   	$data[] = array(
	   		   		'group_id' => $group['id'],
	   		   		'group_name' => $group['group_name'],
	   		   		'categories' => $categories
	   		   	);
   		} 
   		$has_more=count($data)>($offset+$limit)? true : false;
   		$data = array_slice($data,$offset,$limit);
   		if(count($data))
   		   return array($data, $has_more);
   		else
   			return false;
   	} else {
   		return false;
   	}
   }

   public function get_catgoriesbygroupid($group_id)
   {
     $this->db->select('quiz_set.id,quiz_set.title,quiz_set.description,title_image,count(quizset_question.quiz_set_id) as total_question');
     $this->db->from('ussd_group_category');
     $this->db->where('group_id',$group_id);
     $this->db->join('quiz_set','ussd_group_category.category_id=quiz_set.id');
     $this->db->join('quizset_question','quizset_question.quiz_set_id=quiz_set.id','left');
	$this->db->join('ussd_quiz','ussd_quiz.id=quizset_question.quiz_id');
    $this->db->where('ussd_quiz.is_active',1);
	$this->db->where('quiz_set.is_active',1);
	$this->db->group_by('quizset_question.quiz_set_id');
	$this->db->limit(10);
     $q=$this->db->get();
     if($q->num_rows() > 0)
     	return $q->result();
     else
     	return false;
   }
      public function updateprofileinfo($data=array(),$id)
	{
       //print_r($data);die;
      /*  $this->save_queries=true;*/
		$this->db->set($data);
		$this->db->where('id_user',$id);
		$this->db->update('user_login');
	/* echo $this->db->last_query();
	 	die; */
		   
		if($this->db->affected_rows()>=0)
         {
            
         	$this->db->select('username,msisdn,image,id_user,first_name,email,coin');
           $q=$this->db->get_where('user_login', array('id_user'=>$id))->row_array();
           return $q;

         }
	}

	public function getCategoryTitle($id) {
		$this->db->select('title');
		$result = $this->db->get_where('quiz_set', array('id' => $id));
		$row = $result->row();
		return $row->title;
	}
	public function bestScore($userId, $categoryId) {
		$this->db->select('MAX(score) as best_score');
		$result = $this->db->get_where('user_quiz_history', array('user_id'=>$userId, 'category_id'=>$categoryId));
		$result = $result->row();
		return $result->best_score;
	}
	public function userinfo($id)
	{
		$this->db->select('first_name,last_name,username,msisdn,coin,image,is_active');
		$result = $this->db->get_where('user_login', array('id_user' => $id));
		$row = $result->row();
		return $row;
	}
	/*Coin Update*/
	public function giftcoinupdate($uid)
	{
		$this->db->select('coin');
		$this->db->from('user_login');
		$this->db->where('id_user', $uid);
		$result 	= $this->db->get();
		$curr_coin	= $result->row()->coin;
		$coin 		= $curr_coin + 1;
	   	$data 		= array(
               				'coin' => $coin
            				);
		$this->db->where('id_user', $uid);
		$this->db->update('user_login', $data); 

		if($this->db->affected_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}


	


}
