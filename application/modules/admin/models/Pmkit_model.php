<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Pmkit_model extends CI_Model {
	public function __construct() {
		parent::__construct();  
		
	}

    public function getUniqueModel()
	{       
            $this->db->select('pmkit_mapping.machinemodel_material_no,pmkit_mapping.source_ip,material_master.*');
            $this->db->from('pmkit_mapping');
            $this->db->join('material_master', 'material_master.material_no = pmkit_mapping.machinemodel_material_no', 'left');   
            $this->db->where('mapping_status !=','0');
            $this->db->distinct('machinemodel_material_no');
            
            $query = $this->db->get();
            if($query->num_rows() >0)
            {
                return $query->result();
            }
            else{
                return array(); 
            }
    }
    
    
	public function getPmkitByModel($modelno)
	{       
            $this->db->select('pmkit_mapping.*,material_master.*');
            $this->db->from('pmkit_mapping'); 
            $this->db->join('material_master', 'material_master.material_no = pmkit_mapping.pmkit_material_no', 'left');  
            $this->db->where("machinemodel_material_no", $modelno);
            $query = $this->db->get();
            if($query->num_rows() >0)
            {
                return $query->result();
            }
            else{
                return array(); 
            }
    }
    public function getPmkitByModelID($modelno)
    {       
            $this->db->select('pmkit_mapping.*,material_master.*,material_thumbnail.*');
            $this->db->from('pmkit_mapping'); 
            $this->db->join('material_master', 'material_master.material_no = pmkit_mapping.pmkit_material_no', 'left'); 
            $this->db->join('material_thumbnail', 'material_thumbnail.material_number = material_master.material_no', 'left'); 
            $this->db->where("machinemodel_material_no", $modelno);
            $query = $this->db->get();
            if($query->num_rows() >0)
            {
                return $query->result();
            }
            else{
                return array(); 
            }
    }
	public function getModel()
	{       
            $this->db->select('*');
            $this->db->from('machine_model_master');  
            $this->db->where("status !=", '0');
            $query = $this->db->get();
            if($query->num_rows() >0)
            {
                return $query->result();
            }
            else{
                return array(); 
            }
    }


    public function getModelByID($modelno)
    {       
            $this->db->select('*');
            $this->db->from('machine_model_master');  
            $this->db->where("status !=", '0');
            $this->db->where("machine_id", $modelno);
            $query = $this->db->get();
            if($query->num_rows() >0)
            {
                return $query->result();
            }
            else{
                return array(); 
            }
    }


    public function getpmkitList()
	{       
            // $this->db->select('material_bom_master.pmkit_material_no,material_master.*');
            // $this->db->from('material_bom_master'); 
            // $this->db->join('material_master', 'material_master.material_no = material_bom_master.pmkit_material_no'); 
            // $this->db->distinct('pmkit_material_no'); 

            $this->db->select('*');
            $this->db->from('material_master'); 

            $query = $this->db->get();
            if($query->num_rows() >0)
            {
                return $query->result();
            }
            else{
                return array(); 
            }
    }
	
	public function getAllPmkit()
    {       
            $this->db->select('pmkit_mapping.*,material_master.*');
            $this->db->from('pmkit_mapping'); 
            $this->db->join('material_master', 'material_master.material_no = pmkit_mapping.pmkit_material_no', 'left'); 
            $this->db->order_by('machinemodel_material_no'); 
            $query = $this->db->get();
            if($query->num_rows() >0)
            {
                return $query->result();
            }
            else{
                return array(); 
            }
    }

    public function insert_mapping($data,$models) 
	{       

        $this->db->select('*');
		$this->db->from('pmkit_mapping');
		$this->db->where("machinemodel_material_no", "$models"); 
        $fetch_data = $this->db->get();
        if($fetch_data->num_rows() > 0 ){

			$this -> db -> where('machinemodel_material_no', "$models");
            $this -> db -> delete('pmkit_mapping');
        }
        
        $this->db->insert_batch('pmkit_mapping', $data); 

        return TRUE ;
        
    }

    public function Delete_mapping($models)
	{       

        $this->db->select('*');
		$this->db->from('pmkit_mapping');
		$this->db->where("machinemodel_material_no", "$models"); 
        $fetch_data = $this->db->get();
        if($fetch_data->num_rows() > 0 ){
            $data = [
                'status' => '0',
            ];
            $mapping_data = [
                'mapping_status' => '0',
            ];
            $this->db->where('machinemodel_material_no', "$models");
            $this->db->update('pmkit_mapping', $mapping_data);

            $this->db->where('machine_id', "$models");
            $this->db->update('machine_model_master', $data);
        }else{

            $data = [
                'status' => '0',
            ];
            $this->db->where('machine_id', "$models");
            $this->db->update('machine_model_master', $data);

        }
        
        return TRUE ;
        
    }


    public function bulk_mapping($data,$models,$pmkit,$row)
	{    
        if($data['machinemodel_material_no'] !=''){
			
			$this->db->select('*');
			$this->db->from('material_master');
			$this->db->where("material_no", "$pmkit");
            $fetch_data = $this->db->get();	
            if($fetch_data->num_rows() > 0 ){

                $this->db->select('*');
				$this->db->from('machine_model_master');
				$this->db->where("machine_id", "$models");
				$fetch_data = $this->db->get();	
                if($fetch_data->num_rows() > 0 ){				
			
						$this->db->select('*');
						$this->db->from('pmkit_mapping');
						$this->db->where("machinemodel_material_no", "$models"); 
						$this->db->where("pmkit_material_no", "$pmkit");
						$fetch_data = $this->db->get();
						if($fetch_data->num_rows() > 0 ){
							return TRUE ;
						}else{
							$this->db->insert('pmkit_mapping', $data); 
							return TRUE ;  

						}
						
				}else{
					
					$data=array(

					'message'=>'Model No  '. $models .'  Not in Machine Model Master Table -- excel row--> '.$row,
					'date'=>date('Y-m-d'),
					'type'=>'Mapping'
					);

					$this->db->insert('pmkit_mapping_exception_list',$data);
					return TRUE ;
					
				}
			}else{
				
				$data=array(

					'message'=>'Material No  '. $pmkit .'  Not in Material Master Table -- excel row--> '.$row,
					'date'=>date('Y-m-d'),
					'type'=>'Mapping'
				);

				$this->db->insert('pmkit_mapping_exception_list',$data);
				return TRUE ;  
				
			}
        } 
    }

    public function bulk_upload_model($data,$models)
	{    
        if($data['machine_id'] !=''){
            $this->db->select('*');
            $this->db->from('machine_model_master');
            $this->db->where("machine_id", "$models"); 
            $fetch_data = $this->db->get();
            if($fetch_data->num_rows() > 0 ){
                $this->db->where('machine_id', "$models");
                $this->db->update('machine_model_master', $data);
				return TRUE ;
            }else{
                $this->db->insert('machine_model_master', $data); 
                return TRUE ;  

            }
        } 
    }

    public function addimaghedata($data,$modelsno)
	{
        $this->db->select('*');
		$this->db->from('material_thumbnail');
		$this->db->where("material_number", "$modelsno"); 
        $fetch_data = $this->db->get();
        if($fetch_data->num_rows() > 0 ){

			$this ->db-> where('material_number', "$modelsno");
                        $this ->db-> delete('material_thumbnail');
        }
        
        $this->db->insert('material_thumbnail', $data); 

        return TRUE ;

    }

}

?>
