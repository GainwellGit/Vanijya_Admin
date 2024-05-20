<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Scheduler_model extends CI_Model {

	public function __construct() {
		parent::__construct();  
		 
	}

    public function insert_cust_master($data,$custId){

        $this->db->select('cust_id');
        $this->db->from('ruep_cust_master');
        $this->db->where('cust_number',$custId);
        $res = $this->db->get();
        if($res->num_rows()>0){
      
           $data['updated_at']=date("Y-m-d h:i:s");
           
           $this->db->where('cust_number', $custId);
           $this->db->update('ruep_cust_master', $data);
           return true;

        }else{

            $data['created_at']=date("Y-m-d h:i:s");
            return $this->db->insert('ruep_cust_master', $data);
        }
    }


    public function insert_equi_master($data,$equip_sl_no){

        $this->db->select('equip_id');
        $this->db->from('ruep_equipment_master');
        $this->db->where('equip_sl_no',$equip_sl_no);
        $res = $this->db->get();
        if($res->num_rows()>0){
      
           $data['updated_at']=date("Y-m-d");
           
           $this->db->where('equip_sl_no', $equip_sl_no);
           $this->db->update('ruep_equipment_master', $data);
           return true;

        }else{

            $data['created_at']=date("Y-m-d");
            return $this->db->insert('ruep_equipment_master', $data);
        }
    }

    public function insert_induc_master($data,$asset_code){

        $this->db->select('induc_id');
        $this->db->from('ruep_induction_master');
        $this->db->where('induc_asset_code',$asset_code);
        $res = $this->db->get();
        if($res->num_rows()>0){
      
           $data['updated_at']=date("Y-m-d");
           
           $this->db->where('induc_asset_code', $asset_code);
           $this->db->update('ruep_induction_master', $data);
           return true;

        }else{

            $data['created_at']=date("Y-m-d");
            return $this->db->insert('ruep_induction_master', $data);
        }
    }





}

?>
