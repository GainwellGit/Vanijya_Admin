<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler extends CI_Controller {

	function __construct(){

        	parent::__construct();
				
			$this->load->model('Scheduler_model');
				
	}

	

    public function custmaster(){


        $sxe = new SimpleXMLElement('https://qapps.gainwellindia.com/gcpl/pmkit/xml/GCPL_X_RUECustMast.xml', NULL, TRUE);
        $array = json_decode(json_encode((array)$sxe), TRUE);

        if(!empty($array['ZRUE_INT1'])){

        	foreach ($array['ZRUE_INT1'] as $key => $value) {

        		$custId = !empty($value['KUNNR']) ? $value['KUNNR'] :'';

        		$data=array(
	 						'cust_name'         =>!empty($value['NAME1']) ? $value['NAME1'] : '',
	                    	'cust_number'       =>!empty($value['KUNNR']) ? $value['KUNNR'] :'',
						    'cust_region'       =>!empty($value['REGIO']) ? $value['REGIO'] : '',
							'cust_address'      =>!empty($value['STRAS']) ? $value['STRAS'] : '',
							'cust_contact_no'   =>!empty($value['TEL_NUMBER']) ? $value['TEL_NUMBER'] : '',
						    'cust_classification'=>!empty($value['KUKLA']) ? $value['KUKLA'] : '',
						    'cust_key'          =>!empty($value['BRSCH']) ? $value['BRSCH'] : '',
							'cust_code'         =>!empty($value['BRAN1']) ? $value['BRAN1'] : '',
							'cust_legal_status' =>!empty($value['GFORM']) ? $value['GFORM'] : '',
							'cust_gstin_no'     =>!empty($value['STCD3']) ? $value['STCD3'] : '',
							'cust_pan_no'       =>!empty($value['PANNO']) ? $value['PANNO'] : '',
	            );

				$insert_cust= $this->Scheduler_model->insert_cust_master($data,$custId);
	
        	}
        }
    }

    

    public function equipmaster(){


        $sxe = new SimpleXMLElement('https://qapps.gainwellindia.com/gcpl/pmkit/xml/GCPL_X_RUEEquiMast.xml', NULL, TRUE);
        $array = json_decode(json_encode((array)$sxe), TRUE);

        if(!empty($array['ZRUE_INT2'])){

        	foreach ($array['ZRUE_INT2'] as $key => $value) {

        		$equip_sl_no = !empty($value['EQUNR']) ? $value['EQUNR'] : '';

        		$data=array(
	 						'equip_sl_no'         		 =>!empty($value['EQUNR']) ? $value['EQUNR'] : '',
	                    	'equip_asset_code'      	 =>!empty($value['ANLN1']) ? $value['ANLN1'] :'',
						    'equip_model'                =>!empty($value['ZMODEL']) ? $value['ZMODEL'] : '',
							'equip_sr_no_desc'           =>!empty($value['EQKTU']) ? $value['EQKTU'] : '',
							'equip_id_no'                =>!empty($value['INVNR']) ? $value['INVNR'] : '',
						    'equip_mfg_year'             =>!empty($value['BAUJJ']) ? $value['BAUJJ'] : '',
						    'equip_material'             =>!empty($value['MATNR']) ? $value['MATNR'] : '',
							'equip_category'             =>!empty($value['EQTYP']) ? $value['EQTYP'] : '',
							'equip_manufacturer'         =>!empty($value['ZMAKE']) ? $value['ZMAKE'] : '',
							'equip_industry_division'    =>!empty($value['ZINDV']) ? $value['ZINDV'] : '',
							'equip_sbu'                  =>!empty($value['ZSBU']) ? $value['ZSBU'] : '',
							'equip_business_division'    =>!empty($value['ZBUS_DIV']) ? $value['ZBUS_DIV'] : '',
	                    	'equip_product_type'         =>!empty($value['ZPRODUC']) ? $value['ZPRODUC'] :'',
						    'equip_product_status'       =>!empty($value['ZPRODST']) ? $value['ZPRODST'] : '',
							'equip_sale_indicator'       =>!empty($value['ZSALIND']) ? $value['ZSALIND'] : '',
							'equip_territory_indicator'  =>!empty($value['ZTERRI']) ? $value['ZTERRI'] : '',
						    'equip_territory'            =>!empty($value['BZIRK']) ? $value['BZIRK'] : '',
						    'equip_latest_smu'           =>!empty($value['ZANNUAL']) ? $value['ZANNUAL'] : '',
							'equip_location'             =>!empty($value['ZLOCDS']) ? $value['ZLOCDS'] : '',
							'equip_planning_plant'       =>!empty($value['WERKS']) ? $value['WERKS'] : '',
							'equip_chassis_no'           =>!empty($value['ZZCHASNO']) ? $value['ZZCHASNO'] : '',
							'equip_engine_sr_no'         =>!empty($value['ZENGSR']) ? $value['ZENGSR'] : '',
							'equip_fitness_validity_date'=>!empty($value['ZZFITVAL']) ? $value['ZZFITVAL'] : '',
	                    	'equip_registration_no'      =>!empty($value['ZZREGNO']) ? $value['ZZREGNO'] :'',
						    'equip_insurance_no'         =>!empty($value['ZZINSNO']) ? $value['ZZINSNO'] : '',
							'equip_insurance_validity_date'=>!empty($value['ZZINSVALDAT']) ? $value['ZZINSVALDAT'] : '',
							'equip_registered_location'  =>!empty($value['ZZREGLOC']) ? $value['ZZREGLOC'] : '',
	            );

				$insert_cust= $this->Scheduler_model->insert_equi_master($data,$equip_sl_no);
	
        	}
        }
    }



    public function inductionmaster(){


        $sxe = new SimpleXMLElement('https://qapps.gainwellindia.com/gcpl/pmkit/xml/GCPL_X_RUEInducMast.xml', NULL, TRUE);
        $array = json_decode(json_encode((array)$sxe), TRUE);

        if(!empty($array['ZRUE_INT3'])){

        	foreach ($array['ZRUE_INT3'] as $key => $value) {

        		$asset_code = !empty($value['ANLN1']) ? $value['ANLN1'] : '';

        		$data=array(
	 						'induc_asset_code'         =>!empty($value['ANLN1']) ? $value['ANLN1'] : '',
	                    	'induc_sl_no'       	   =>!empty($value['CHARG']) ? $value['CHARG'] :'',
						    'induc_material_no'        =>!empty($value['MATNR']) ? $value['MATNR'] : '',
							'induc_material_desc'      =>!empty($value['MAKTX']) ? $value['MAKTX'] : '',
							'induc_quantity'           =>!empty($value['MENGE']) ? $value['MENGE'] : '',
						    'induc_amount'             =>!empty($value['DMBTR']) ? $value['DMBTR'] : '',
						    'induc_currency'           =>!empty($value['WAERS']) ? $value['WAERS'] : '',
							'induc_created_by'         =>!empty($value['USNAM_MKPF']) ? $value['USNAM_MKPF'] : '',
							'induc_date'               =>!empty($value['BUDAT_MKPF']) ? $value['BUDAT_MKPF'] : '',
							'induc_document_no'        =>!empty($value['MBLNR']) ? $value['MBLNR'] : '',
							'induc_posting_year'       =>!empty($value['MJAHR']) ? $value['MJAHR'] : '',
							'induc_movement_type'      =>!empty($value['BWART']) ? $value['BWART'] : '',
							'induc_plant'              =>!empty($value['WERKS']) ? $value['WERKS'] : '',
							'induc_storage_location'   =>!empty($value['LGORT']) ? $value['LGORT'] : '',
	            );

				$insert_induction= $this->Scheduler_model->insert_induc_master($data,$asset_code);
	
        	}
        }
    }	



		

}
