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
            <a href="<?php echo base_url(); ?>admin">Quick Link</a>
            <i class="fa fa-angle-right"></i>
            </li>
            <li>
          <span>Order History</span>
          </li>
          </ul>
          

          </div>
        <div class="content">
            <div class="row" style="margin-bottom:20px; ">
                <div class="col-xs-12">
                    <div class="form-group pull-right"></div>

                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>Select Filter Data</div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">

                                    <form class="form-horizontal" action="<?php echo base_url('/admin/history/orderSearch'); ?>" method="post" role="form">

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Sap Order No</label>
                                                <input type="text" class="form-control" name="orderNo" value="<?php echo isset($orderNo) ? $orderNo : ''; ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Portal Order No</label>
                                                <input type="text" class="form-control" name="orderNumber" value="<?php echo isset($orderNumber) ? $orderNumber : ''; ?>">
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
                                                    <input type="text"  autocomplete="off" autofocus="off" class="date-picker form-control startinput"  name="from_date" value="<?php echo isset($from_date) ? $from_date : ''; ?>"  required="required" id="start_date">
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
                                                    <input type="text" autocomplete="off" class="date-picker form-control endinput"  name="to_date" value="<?php echo isset($to_date) ? $to_date : ''; ?>"  id="end_date">
                                                        <span class="input-group-btn">
                                                            <button class="btn default endbutton" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                </div>
                                            </div>

                                           
                                            

                                            <div class="col-md-2">
                                                <label for="bootstrap-input-sm" class="control-label" style="margin-top: 14px;">  </label> <br>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>

                                    </form>        
                                </div>
                            </div>

                            
                        </div>

                        <?php if(!empty($searchResult)){?>

                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Search Result</div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Sl No. </th>
                                                <th> Order Number </th>
												<th> Order Date </th>
                                                <th> Sap Order No. </th>
                                                <th> Payment reference </th>
                                                <th> Customer Code </th>
                                                <th> Customer Name </th>
                                                <th> Plant Code </th>
                                                <th> Plant Name </th>
                                                

                                                <th> Status </th>
                                                <th> Part No </th>
                                                <th> Part Description </th>
                                                <th> Quantity</th>

                                                <th> Item Value </th>
                                                <th> GST Rate </th>
                                                <th> GST Value </th>
                                                <th> Total Item Value</th>
                                                <th> Total Invoice Value</th>
                                                <th> Discount </th>
                                                <th> Discount Value</th>
												<th> Discount Type</th>


                                                <!-- <th> IP </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            if(!empty($searchResult)){
                                                $counter = 1;
                                                foreach ($searchResult as $user) {
                                                $discount_type = ($user['discount_type'] == 1) ? '%' : '';
                                                if ($user['discount_type'] == 1) {
                                                    // code...
                                                    $discount_val = round( ( ( $user['discount_value']/100 ) * $user['unit_price'] ) ,2);
                                                }else{ 
                                                    $discount_val = $user['discount_value'];
                                                }
                                                
                                            ?>
                                                    <tr>
                                                        <td><?php echo   $counter;  ?> </td>
                                                        <td><?php echo   $user['order_number'] ;?></td>
														<td><?php echo   $user['datetime'] ;?></td>
                                                        <td><?php echo   $user['sap_order_no'] ;?> </td>
                                                        <td><?php  if( $user['payment_status'] =='S'){echo 'Succssful';}else{echo 'Failed';}?>  </td>
                                                        <td><?php echo   $user['customer_number'] ;?></td>
                                                        <td><?php echo   $user['name1'] ;?></td>
                                                        <td><?php echo   $user['plant_code'] ;?> </td>
                                                        <td><?php echo   $user['plant_name'] ;?></td>
                                                        
                                                        <td><?php echo   $user['order_status'] ;?> </td>
                                                        <td><?php echo   $user['pmkit_number'] ;?> </td>
                                                        <td><?php echo   $user['pmkit_desc'] ;?></td>
                                                        <td><?php echo   $user['quantity'] ;?> </td>
                                                        <td><?php echo   round($user['unit_price'],2) ;?></td>
                                                        <td><?php echo   round($user['tax_rate'],2);?></td>
                                                        <td><?php echo   round(($user['tax_rate']*$user['unit_price'])/100,2) ;?></td>
                                                        <td><?php echo   round((($user['tax_rate']*$user['unit_price'])/100) + $user['unit_price'],2) ;?></td>
														
														<td><?php echo   round($user['total_payment'],2)  ;?>  </td>
                                                        <td><?php echo   $user['discount_value'].$discount_type ; ?> </td>
                                                        <td><?php echo $discount_val; ?></td>
                                                        <td><?php echo   $user['description']; ?> </td>


                                                        
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
});
</script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


