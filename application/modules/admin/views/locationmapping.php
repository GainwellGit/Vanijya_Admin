<html>
<head>

</head>

<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <?php $CI = & get_instance(); if($CI->session->flashdata('message')){ ?>
                  <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $CI->session->flashdata('message') ?> 
                 </div>
                  <?php } ?>
                  <div class="alert alert-success alert-dismissable error_msg" style="display: none;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a></div>
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                            <a href="<?php echo base_url(); ?>admin">Quick Link</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                            <span>Location
                            <i class="fa fa-angle-right"></i>
                            </span>
                            </li>
                            
                            <li>
                                <span>Mapping</span>
                            </li>
                        </ul>

                    </div>
                    <!-- END PAGE BAR -->

                    <div class="row">
                        <div class="col-md-12">
                           
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered form-fit">
                                <div class="portlet-title">
                                    <div class="caption font-green-sharp">
                                        <i class="icon-speech font-green-sharp"></i>
                                        <span class="caption-subject bold uppercase"> <?php echo $getRegionData->region_description; ?></span>
                                        <span class="caption-helper"></span>
                                    </div>
                                    <div class="actions" style="width: 162px; border: 1px solid; border-radius: 10px !important; padding: 2px 3px;">
                                        
                                        <a href="javascript:;" class="btn orderingPlant" data-id="<?php echo $getRegionData->region_code; ?>">
                                            <i class="fa fa-plus"></i> Add Ordering Plant </a>
                                        
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="<?php echo base_url('/admin/location/mappingordering'); ?>" method="post" id="form-username" class="form-horizontal form-bordered">

                                        <input type="hidden" name="orderingId" value="<?php echo $getRegionData->region_code; ?>">

                                        <?php if(!empty($getOrderingDetails)){ 
                                               foreach($getOrderingDetails as $ordering){  ?>


                                                <input type="hidden" name="plantId[<?php echo $ordering['id']; ?>][id]" value="<?php echo $ordering['id']; ?>">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Ordering Plant Name</label>
                                                    <div class="col-md-9" style="border-right: 1px solid #efefef;">
                                                        <input type="text" class="form-control" placeholder="Ordering Plant Name"id="object_tagsinput_value" name="plant[<?php echo $ordering['id']; ?>][name]" value="<?php echo $ordering['ordering_plant_name']; ?>" readonly>

                                                        <?php  $sql ="SELECT * FROM state_delivery_centre WHERE plant_id=".$ordering['id'];
                                                              $query = $this->db->query($sql); 
                                                              if ($query->num_rows() > 0) {
                                                              foreach ($query->result() as $row) { ?>

                                                                <div class="form-group">
                                                                    <label class="col-md-1 control-label" style="padding: 9px;">Delivery Center</label>
                                                                    <div class="col-md-4">
                                                                        <input type="hidden" name="ord[<?php echo $ordering['id']; ?>][id][]" value="<?php echo $row->delivery_id; ?>">

                                                                        <input type="text" class="form-control" placeholder="Delivery Center Name"id="object_tagsinput_value" name="ord[<?php echo $ordering['id']; ?>][name][]" value="<?php echo $row->delivery_centre_name; ?>" >    
                                                                    </div>
                                                                    <div class="col-md-6">

                                                                        <input type="text" class="form-control" placeholder="Delivery Center Address"id="object_tagsinput_value" name="ord[<?php echo $ordering['id']; ?>][address][]" value="<?php echo $row->delivery_centre_address; ?>" >

                                                                    </div>


                                                                    <div class="col-md-1"><i class="fa fa-close deliveryDelete" data-id="<?php echo $row->delivery_id; ?>" style="border: 1px solid; padding: 5px;  border-radius: 15px; background: red; color: white; cursor: pointer;"></i></div>
                                                                </div>

                                                        <?php } } ?>        

                                                        <span class="deliveryBox<?php echo $ordering['id']; ?>"></span>
                                                    </div>
                                                    <div class="col-md-1 delivery" data-id="<?php echo $ordering['id']; ?>" style="padding: 4px 1px;"> 
                                                        <button type="button" class="red " style="border-radius: 9px !important; background-color: #3ea949;color: white;font-size: 12px;" >Add Delivery Center</button> </div>


                                                       <button type="button" class="red deletemapping" data-id="<?php echo $ordering['id']; ?>" style="border-radius: 9px !important; background-color: #ea3636;color: white;padding: 6px 21px;float: right;"></i> Delete</button>


                                                </div>

                                            

                                        <?php } } else{ ?>

                                               <div class="form-group">
                                                <label class="col-md-2 control-label">Ordering Plant Name</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="orderingCode[]">
                                                        <option value=""><strong>Select Plant Name</strong></option>
                                                        <?php if(!empty($getAllPlant)){
                                                            foreach ($getAllPlant as $key => $value) { ?>

                                                                <option value="<?php echo $value['plant_code'] ?>"><?php echo $value['plant_name'].' - '.$value['plant_code'] ?></option>
                                                                
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                                </div>    

                                       <?php  } ?>    

                                        <span class="ordering"></span>
                                        
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-check"></i> Submit</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                   
                   

                </div>
                <!-- END CONTENT BODY -->

                
            </div>
            <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
             <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
            <script>

            $(document).on('click', '.orderingPlant', function() {

                var regionId = $(this).data("id");

                $.ajax({
                        type : 'post', 
                        data : {'regionId' : regionId},
                        url : 'https://apps.gainwellindia.com/gcpl/PMKit/admin/location/getPlantById', 
                        dataType : 'json',
                        enctype: 'mutipart/form-data',
                        success : function (response) {

                        var options =  '<div class="form-group"><label class="col-md-2 control-label">Ordering Plant Name</label><div class="col-md-9"><select class="form-control" name="orderingCode[]"><option value=""><strong>Select Plant Name</strong></option>'; //create your "title" option
                        $.each(response.plant,function(index, value){ //loop through your elements
                       
                        options += '<option value="'+value.plant_code+'">'+value.plant_name+' - '+value.plant_code+'</option>'; 

                        });

                        var option = '</select></div></div>';

                        $('.ordering').append(options);
                        
                       

                            
                        },
                        error : function(response){
                            
                        }
                });

                 
                  // var new_input='<div class="form-group"><label class="col-md-2 control-label">Ordering Plant Name</label><div class="col-md-9"><input type="text" class="form-control" placeholder="Ordering Plant Name"id="object_tagsinput_value" name="orderingName[]"></div></div>';
                  // $('.ordering').append(new_input);
                  
            });

                $(".delivery").click(function () {
                     var id = $(this).data("id");

                     var new_input='<input type="hidden" name="ord['+id+'][id][]" value=""><div class="form-group"><label class="col-md-1 control-label" style="padding: 9px;">Delivery Center</label><div class="col-md-4"><input type="text" class="form-control" placeholder="Delivery Center Name"id="object_tagsinput_value" name="ord['+id+'][name][]"></div><div class="col-md-6"><input type="text" class="form-control" placeholder="Delivery Center Address"id="object_tagsinput_value" name="ord['+id+'][address][]"></div></div>';
                  $('.deliveryBox'+id).append(new_input);


                });
            </script>

            <style type="text/css">
                .alert-danger p {
                    padding: 11px;
                }
            </style>                 