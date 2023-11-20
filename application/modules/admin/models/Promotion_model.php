<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Promotion_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		
	}


	public function add_promotion($data)
    {
       
           $this->db->insert('offer_storage', $data);
           return TRUE ;
       
    }

    public function get_promotion(){
          
            $this->db->select('*');
			$this->db->from('offer_storage');
			$this->db->order_by("id", "desc");
			$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$gettype = $fetch_data->result_array();	
			}
			else{
				$gettype = array();
			}
			return $gettype;
    }

    public function statusChange($id){

    	$this->db->select('*');
		$this->db->from('offer_storage');
		$this->db->where('id',$id);
		$fetch_data = $this->db->get();
		if($fetch_data->num_rows() > 0 ){

				$gettype = $fetch_data->row();	
				if($gettype->status == 1){

					$data = ['status' => '0',];
            
		            $this->db->where('id',$id);
		            $this->db->update('offer_storage', $data);

				}elseif($gettype->status == 0){

					$data = ['status' => '1',];
            
		            $this->db->where('id',$id);
		            $this->db->update('offer_storage', $data);
				}

            return TRUE;
		}else{

			return FALSE;
		}


    }


    public function get_promotion_by_id($id){
          
            $this->db->select('*');
			$this->db->from('offer_storage');
			$this->db->where('id',$id);
			$fetch_data = $this->db->get();
			if($fetch_data->num_rows() > 0 ){
				$gettype = $fetch_data->row();	
			}
			else{
				$gettype = array();
			}
			return $gettype;
    }

    public function edit_promotion($data,$id){

			$this->db->where("id", $id); 
		    $this->db->update('offer_storage',$data);
		    return TRUE;	

    }

	

}

?>
