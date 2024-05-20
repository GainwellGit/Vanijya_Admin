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
          <span>Discount History</span>
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
                                    <i class="fa fa-globe"></i>Select Report Data</div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">

                                    <form class="form-horizontal" action="<?php echo base_url('/admin/history/getsearch'); ?>" method="post" role="form">

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Category</label>
                                                <select class="page-header-top-dropdown-style-option form-control input-sm" id="category" name="category" required="required">
                                                <option value="">Select category</option>
                                                <?php
                                                    $sql ="SELECT * FROM discount_category WHERE status=1";
                                                    $query = $this->db->query($sql);
                                                    if ($query->num_rows() > 0) {
                                                    foreach ($query->result() as $row) {
                                                ?>
                                                    <option value="<?php echo $row->id;?>" <?php echo(isset($category) && $row->id==$category) ? 'selected' : '';?> ><?php echo $row->description;?></option>
                                                
                                                <?php } } ?>
                                                </select>
                                            </div>


                                            <div class="col-md-2">
                                                <label for="bootstrap-input-sm" class="control-label">Start Date</label>
                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="date-picker form-control startinput"  name="from_date" value="<?php echo isset($from_date) ? $from_date : ''; ?>"  required="required" id="start_date" disabled>
                                                        <span class="input-group-btn">
                                                            <button class="btn default startbutton" type="button" disabled>
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="bootstrap-input-sm" class="control-label">End Date</label>  
                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="date-picker form-control endinput"  name="to_date" value="<?php echo isset($to_date) ? $to_date : ''; ?>"  required="required" id="end_date" disabled>
                                                        <span class="input-group-btn">
                                                            <button class="btn default endbutton" type="button" disabled>
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="select2-multiple-input-sm" class="control-label">Select option</label>
                                                <select id="single" class="form-control select2" name="type" required="required">
                                                    <!-- <select id="type" class="form-control" name="type"> -->
                                                        <?php  if(!empty($categorydata)){
                                                            if($type == 'all'){

                                                                echo '<option value="all" selected >ALL</option>';

                                                            }
                                                            foreach($categorydata as $data){?>

                                                                <option value="<?php echo $data['code'] ?>" <?php echo ($data['code'] == $type) ?'selected':''; ?>><?php echo $data['name'] ?></option>
                                                        <?php } }else{?> 
                                                        <option>-- Select value --</option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="wait"></span>
                                            </div>

                                            

                                            <div class="col-md-2">
                                                <label for="bootstrap-input-sm" class="control-label" style="margin-top: 14px;">  </label> <br>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>

                                    </form>        
                                </div>
                            </div>

                            
                        </div>

                        <?php if(isset($displayResult) && $displayResult == 1){?>

                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Search Result</div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Code </th>
                                                <th> Name </th>
                                                <th> Promo code </th>
                                                <th> Dicount value </th>
                                                <th> Min amount </th>
                                                <th> Start date </th>
                                                <th> End date </th>
                                                <th> Create date </th>
                                                <!-- <th> IP </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            if(!empty($searchResult)){
                                                $counter = 1;
                                                foreach ($searchResult as $user) {?>
                                                    <tr>
                                                        <td> <?php echo   $counter ;?> </td>
                                                        <td> <?php echo   $user['code'] ;?> </td>
                                                        <td> <?php echo  ucfirst($user['name']) ;?> </td>
                                                        <td> <?php echo  $user['promocode'] ;?> </td>
                                                        <td> 
                                                            <?php 
                                                                if($user['type'] =='VALUE'){
                                                                    echo  'RS '.$user['discount_value'] ;
                                                                }else{
                                                                    echo  $user['discount_value'].' '.$user['type'] ;
                                                                }
                                                            ?> 
                                                        </td>
                                                        <td> <?php echo  ($user['min_ammount'] !='') ? 'Rs ' .$user['min_ammount'] : '' ;?> </td>
                                                        <td> 
                                                            <?php 
                                                                $date=date_create($user['from_date']); 
                                                                echo ($user['from_date'] !='') ? date_format($date,"jS F, Y") : '';
                                                            ?> 
                                                        </td> 
                                                        <td>
                                                            <?php 
                                                                $valid_to=date_create($user['to_date']); 
                                                                echo ($user['to_date'] !='') ? date_format($valid_to,"jS F, Y") : '';
                                                            ?> 
                                                        </td>

                                                        <td>
                                                            <?php 
                                                                $created_at=date_create($user['created_date']); 
                                                                echo ($user['created_date'] !='') ? date_format($created_at,"jS F, Y") : '';
                                                            ?> 
                                                        </td>

                                                        <!-- <td>
                                                            <?php echo  $user['source_ip'] ;?> 
                                                        </td> -->
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
 


