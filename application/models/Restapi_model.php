<?php
class Restapi_model extends CI_Model
{
public function __construct() {
    parent::__construct();
    $this->sec_db = $this->load->database('secondary', true);
}
 function fetch_all()
 {
  $this->sec_db->order_by('id', 'DESC');
  return $this->sec_db->get('tbl_sample');
 }

 function insert_api($event, $data)
 {
    $table = "";
    $arr_data = [];
    if($event){
        if($event === "list_page_view"){
            $table = "list_page_views";
        }else if($event === "search_part"){
            $table = "search_parts";
        }else if($event === "cart_page_view"){
            $table = "cart_page_views";
        }else if($event === "checkout_click"){
            $table = "checkout_clicks";
        }else if($event === "checkout_page_view"){
            $table = "checkout_page_views";
        }else if($event === "payment_clicks"){
            $table = "payment_clicks";
        }else if($event === "chatbot_clicks"){
            $table = "chatbot_clicks";
        }
        try {
            $this->sec_db->insert($table, $data);
            if($this->sec_db->affected_rows()>0)
            {
                return json_encode(["status_code"=> 200,"status" => "success", "msg" => "Data Stored Successfully!"], true);
            }else{
                return json_encode(["status_code"=> 200,"status" => "failed", "msg" => "Something Went Wrong, Please Try Again!"], true);
            }
        } catch (\Throwable $th) {
            return json_encode(["status_code"=> 400,"status" => "failed", "msg" => $th->getMessage()], true);
        }
        
    }
 }

 function fetch_single_user($user_id)
 {
  $this->sec_db->where("id", $user_id);
  $query = $this->sec_db->get('tbl_sample');
  return $query->result_array();
 }
 function update_api($user_id, $data)
 {
  $this->sec_db->where("id", $user_id);
  $this->sec_db->update("tbl_sample", $data);
 }
 
 function delete_single_user($user_id)
 {
  $this->sec_db->where("id", $user_id);
  $this->sec_db->delete("tbl_sample");
  if($this->sec_db->affected_rows() > 0)
  {
   return true;
  }
  else
  {
   return false;
  }
 }
}
