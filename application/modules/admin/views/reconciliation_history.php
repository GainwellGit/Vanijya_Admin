<html>
<head>

</head>
 <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
          <!-- BEGIN PAGE HEADER--> 
          <!-- BEGIN PAGE BAR -->
          <?php $CI = & get_instance();
          if($CI->session->flashdata('success')){ ?>
          <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $CI->session->flashdata('success') ?> </div>
          <?php }

           if($CI->session->flashdata('message')){ ?>
          <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $CI->session->flashdata('message') ?> </div>
          <?php }
            
          else if($CI->session->flashdata('error')){?>
          <div class="alert alert-danger fade in alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $CI->session->flashdata('error') ?> </div>
          <?php }?>
          <div class="alert alert-success alert-dismissable error_msg" style="display: none;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a></div>
          <div class="page-bar">
          <ul class="page-breadcrumb">
            <li>
            <a href="<?php echo base_url(); ?>admin">Orders</a>
            <i class="fa fa-angle-right"></i>
            </li>
            <li>
          <span>Reconciliation</span>
          </li>
          </ul>
          

          </div>
        <div class="content">
            <div class="row" style="margin-bottom:20px; ">
                <div class="col-xs-12">
                    <div class="form-group pull-right"></div>

                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box red" style="display:none;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>Select Filter Data</div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">

                                    <form class="form-horizontal" action="<?php echo base_url('/admin/history/paymentSearch'); ?>" method="post" role="form">
											<input type="hidden" name="formType" value="paymenthistory">
                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Sap Order No</label>
                                                <input type="text" class="form-control" name="orderNo" value="<?php echo isset($orderNo) ? $orderNo : ''; ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Customer Code</label>
                                                <input type="text" class="form-control" name="customer" value="<?php echo isset($customer) ? $customer : ''; ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Plant Code</label>
                                                <input type="text" class="form-control" name="plant" value="<?php echo isset($plant) ? $plant : ''; ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Status</label>
                                                <select class="page-header-top-dropdown-style-option form-control input-sm"  name="status" style="height: 34px;">
                                                <option value="">Select Status</option>
                                                <option value="Order Placed" <?php echo (isset($status)
                                                 && $status=='Order Placed') ? 'selected' : ''; ?>>Order Placed</option>
                                                <option value="Execution In Progress" <?php echo (isset($status)
                                                 && $status=='Execution In Progress') ? 'selected' : ''; ?>>Execution In Progress</option>
                                                <option value="Ready for Shipment" <?php echo (isset($status)
                                                 && $status=='Ready for Shipment') ? 'selected' : ''; ?>>Ready for Shipment</option>
                                                <option value="Billed" <?php echo (isset($status)
                                                 && $status=='Billed') ? 'selected' : ''; ?>>Billed</option>
												  <option value="Cancel" <?php echo (isset($status)
                                                 && $status=='Cancel') ? 'selected' : ''; ?>>Cancel</option>
                                              
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Part No</label>
                                                <input type="text" class="form-control" name="part" value="<?php echo isset($part) ? $part : ''; ?>">
                                            </div>
											
                                            <div class="col-md-3">
                                                <label for="bootstrap-input-sm" class="control-label">Start Date</label>
                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="date-picker form-control startinput"  name="from_date" value="<?php echo isset($from_date) ? $from_date : ''; ?>"  required="required" id="start_date">
                                                        <span class="input-group-btn">
                                                            <button class="btn default startbutton" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="bootstrap-input-sm" class="control-label">End Date</label>  
                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="date-picker form-control endinput"  name="to_date" value="<?php echo isset($to_date) ? $to_date : ''; ?>"  required="required" id="end_date">
                                                        <span class="input-group-btn">
                                                            <button class="btn default endbutton" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                </div>
                                            </div>

											<div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Payment Reference</label>
                                                <select class="page-header-top-dropdown-style-option form-control input-sm"  name="reference" style="height: 34px;">
                                                <option value="">Select Status</option>
                                                <option value="S" <?php echo (isset($reference)
                                                 && $reference=='N') ? 'selected' : ''; ?>>Failed</option>
                                                <option value="N" <?php echo (isset($reference)
                                                 && $reference=='S') ? 'selected' : ''; ?>>Successful</option>           
                                                </select>
                                            </div>
                                            

                                            <div class="col-md-2">
                                                <label for="bootstrap-input-sm" class="control-label" style="margin-top: 14px;">  </label> <br>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>

                                    </form>        
                                </div>
                            </div>

                            
                        </div>

                        <?php if(!empty($searchResult)){
							 
                            ?>

                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Failed payment history</div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Sl No. </th>
												<!--<th> Order No. </th> -->
                                                <th> Order  </th> 
                                                <th> Order Date  </th>                                        
                                                <th> Customer </th>
                                               <!-- <th> Customer Name </th> -->
                                                <th> Plant  </th>
                                               <!-- <th> Plant Name </th> -->
                                                

                                               <!-- <th> Status </th>-->
                                                <th> Part  </th>
                                              <!--   <th> Part  </th>-->
                                                <th> Quantity</th>

                                                <!-- <th> Item Value </th>
                                                <th> GST Rate </th>
                                                <th> GST Value </th> 
                                                <th> Total Item Value</th> -->
												<th> Total Invoice Value</th>
												<th> Action</th>

                                                <!-- <th> IP </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
										
                                            <?php 
                                            if(!empty($searchResult)){
                                                $counter = 1;
                                                foreach ($searchResult as $user) {?>							
                                                    <tr id="hide-<?php echo $counter ;?>">
                                                        <td><?php echo $counter ;?></td>
														<td><?php echo $user['order_number'] ;?> </td>
                                                        <td><?php echo $user['datetime'] ;?></td>
                                                       <!--  <td><?php echo $user['datetime'] ;?></td>    -->       
                                                        <td> <?php echo $user['name1'] ;?> </br> <?php echo $user['customer_number'] ;?></td>
                                                        <!--<td><?php echo $user['name1'] ;?></td> -->
                                                        <td><?php echo $user['plant_name'] ;?> </br> <?php echo $user['plant_code'] ;?> </td>
                                                      <!--  <td><?php echo $user['plant_name'] ;?></td> -->
                                                        
                                                       <!--  <td><?php echo $user['order_status'] ;?> </td> -->
                                                        <td><?php echo $user['pmkit_desc'] ;?> </br> <?php echo $user['pmkit_number'] ;?> </td>
                                                       <!--  <td><?php echo $user['pmkit_desc'] ;?></td> -->
                                                        <td><?php echo $user['quantity'] ;?> </td>
                                                       <!--  <td><?php echo round($user['unit_price'],2) ;?></td>
                                                        <td><?php echo round($user['tax_rate'],2);?></td>
                                                        <td><?php echo round(($user['tax_rate']*$user['unit_price'])/100,2) ;?></td>
                                                        <td><?php echo round((($user['tax_rate']*$user['unit_price'])/100) + $user['unit_price'],2) ;?></td> -->
														
														<td><?php echo round($user['total_payment'],2)  ;?>  </td>
														<td>
														
<input id="cust_no-<?php echo $counter ;?>" type="hidden" name="cust_no" value="<?php echo $user['customer_number'] ;?>">
<input id="quant-<?php echo $counter ;?>" type="hidden" name="quant" value="<?php echo $user['quantity'] ;?>">
<input id="part_no-<?php echo $counter ;?>" type="hidden" name="part_no" value="<?php echo $user['quantity'] ;?>">
<input id="cond_type-<?php echo $counter ;?>" type="hidden" name="cond_type" value="<?php echo $user['quantity'] ;?>">
<input id="percent-<?php echo $counter ;?>" type="hidden" name="percent" value="<?php echo $user['quantity'] ;?>">
<input id="po_no-<?php echo $counter ;?>" type="hidden" name="po_no" value="<?php echo $user['order_number'] ;?>">
<input id="serial_no-<?php echo $counter ;?>" type="hidden" name="serial_no" value="<?php echo $user['quantity'] ;?>">
<input id="plant_code-<?php echo $counter ;?>"  type="hidden" name="plant_code" value="<?php echo $user['plant_code'] ;?>">														
 <input id="order_no-<?php echo $counter ;?>" type="hidden" name="order_no" value="<?php echo $user['order_number'] ;?>">	
 <!-- <input type="text" autocomplete="off" data-id="<?php echo $counter;?>"  id="input_sap_order_id-<?php echo $counter ;?>" class="form-control input_sap_cnt" maxlength="50" placeholder="Sap Order id" name="input_sap_order_id"> -->
															<select data-id="<?php echo $counter;?>" name="pay_status" id="pay_status<?= $counter?>" class="form-control select_sap_cnt" >
															  <option value="S" <?php if($user['payment_status']=="S"){echo 'selected';}?>>Paid</option>
															  <option value="N" <?php if($user['payment_status']=="N"){echo 'selected';}?>>Unpaid</option>			  
															</select>											
														</td>                                                        
                                                    </tr>
												
                                            <?php  $counter ++;} }?>
                                            
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
							
							
                              

                        <?php } ?>
                    
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    
            
           <!-- END PAGE BAR -->
                    <!-- END PAGE HEADER-->
                  
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
   
    
        <!-- END CONTAINER -->

         
  </div>
</div>
<style type="text/css">
.buttons-print {
    display: none;
}
.buttons-pdf {
    display: none;
}
</style>
<script src="<?php echo base_url()?>assets/js/toastr.min.js" type="text/javascript"></script>

 <script>
$(document).ready(function(){ 

    var s_date = $('#start_date').val();
    var e_date = $('#end_date').val();

    if(s_date !=''){

        $(".startbutton").prop('disabled', false);
         $(".startinput").prop('disabled', false);
    };

    if(e_date !=''){

        $(".endbutton").prop('disabled', false);
         $(".endinput").prop('disabled', false);
    };



    $('#category').change(function(){

        var id = $(this).val();
        $('#start_date').val('');
        $('#end_date').val('');
        $("#single").select2("val", "");

        if(id !=''){
            
            $(".startbutton").prop('disabled', false); 
            $(".startinput").prop('disabled', false);
            

        }else{

            
            $(".startbutton").prop('disabled', true);
            $(".startinput").prop('disabled', true);
        }
    });

    $(document).on("change", "#start_date", function(e){

          var start_date = $(this).val();
          $('#end_date').val('');

          if(start_date !=''){
             
            $(".endbutton").prop('disabled', false);
            $(".endinput").prop('disabled', false);

          }else{

            $(".endbutton").prop('disabled', true);
            $(".endinput").prop('disabled', true);
          }

    });
       
    $(document).on("change", "#end_date", function(e){

        var end_date = $(this).val();
        var start_date = $('#start_date').val();
        var id = $('#category').val();

        $("#single").select2("val", "");
        $(".wait").html('Please wait.....');
               
        $.ajax({
            method: "POST",
            url: "<?php echo site_url('/admin/history/getDataByCatId'); ?>", //here we are calling our user controller and get_cities method with the country_id
            data:{id: id,end_date:end_date,start_date:start_date},
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            datatype : "json",
            success: function(response) //we're calling the response json array 'states'
            {
                $("#single").empty();
                //$(".wait").html('');
                $('#single').append('<option value="">Select</option>');
                if(id ==2 ||id ==3 )
                $('#single').append('<option value="all">ALL</option>');
                $.each(JSON.parse(response),function(index,data){
                    $('#single').append('<option value="'+data['code']+'">'+data['name']+'</option>');
                });
                setTimeout(function() {
                        $(".wait").html('');
                    }, 1000);
                
            },
            error: function( error )
            {   
                
                $('#type').find('option').not(':first').remove();

                //alert( error );
            }

        });



     });


    $('#category22').change(function(){
        $("#single").select2("val", "");
        $(".wait").html('Please wait.....');
               
        var id = $(this).val();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url('/admin/history/getDataByCatId'); ?>", //here we are calling our user controller and get_cities method with the country_id
            data:{id: id},
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            datatype : "json",
            success: function(response) //we're calling the response json array 'states'
            {
                $("#single").empty();
                //$(".wait").html('');
                $('#single').append('<option value="">Select</option>');
                if(id ==2 ||id ==3 )
                $('#single').append('<option value="all">ALL</option>');
                $.each(JSON.parse(response),function(index,data){
                    $('#single').append('<option value="'+data['code']+'">'+data['name']+'</option>');
                });
                setTimeout(function() {
                        $(".wait").html('');
                    }, 1000);
                
            },
            error: function( error )
            {   
                
                $('#type').find('option').not(':first').remove();

                //alert( error );
            }

        });

    });
	//$('.select_sap_cnt').prop('disabled', true);
    $(".input_sap_cnt").keyup(function(){
        var idx = $(this).data('id')
        var input_sap_order_id =  $('#input_sap_order_id-'+idx).val();
        if (input_sap_order_id == '') {
            $('.select_sap_cnt').prop('disabled', true);
        }else{
            $('#pay_status'+idx).prop('disabled', false);
        }
        
    });
	$('select[name="pay_status"]').change(function(){              
        var idx = $(this).data('id');
        //console.log(idx);
        var status = $(this).val();
		var orderID = $('#po_no-'+idx).val(); //$(this).prev().val();
		var cust_no = $('#cust_no-'+idx).val();
		var quant =   $('#quant-'+idx).val();
		var part_no = $('#part_no-'+idx).val(); 
		var cond_type = $('#cond_type-'+idx).val();
		var percent =     $('#percent-'+idx).val();
		var po_no =       $('#po_no-'+idx).val();
		var serial_no =   $('#serial_no-'+idx).val();
		var plant_code =  $('#plant_code-'+idx).val();
        var input_sap_order_id =  $('#input_sap_order_id-'+idx).val();
        if (input_sap_order_id == '') {
            $('#input_sap_order_id-'+idx).focus();
            return false;
        }

		if (confirm('Are you sure you want to update status?')) {
			$.ajax({
				method: "POST",
				url: "<?php echo site_url('/admin/history/updatePaymentStatus'); ?>", //here we are calling our user controller and get_cities method with the country_id
				data:{
                        orderID: orderID, 
                        status: status,
                        cust_no: cust_no,
                        quant: quant,
                        part_no: part_no,
                        cond_type: cond_type,
                        percent: percent,
                        po_no: po_no,
                        serial_no: serial_no,
                        plant_code: plant_code,
                        input_sap_order_id:input_sap_order_id
					},
				contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
				datatype : "json",
				success: function(response) //we're calling the response json array 'states'
				{
                    if (response.status == 'Failure') {
                        //console.log(response);
                        console.log('Failure');
                        toastr["error"]("", "Failure : Payment not done.") 
                    }else if(response.status == 'Success') {
                        
                        console.log(response);                       
                        $.ajax({
                            method: "GET",
                            url: response.url,
                            success: function(response) //we're calling the response json array 'states'
				            {
                                toastr["error"]("", response) 
                                $('#hide-'+idx).hide();
                            }
                        });
                        
                        
                    }  
				},
				error: function( error )
				{              
					console.log('Failed');
				}

			});
		}

    });
});
</script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


