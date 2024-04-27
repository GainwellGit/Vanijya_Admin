<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
          <span>Server Log</span>
          </li>
          </ul>
          <br><br>
          
             
          </div>
          
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
            <div class="form-group pull-right">
             
      		</div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                  <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>Select Filter Data</div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">

                                    <form class="form-horizontal" action="<?php echo base_url('/admin/serverlog'); ?>" method="post" role="form">
 
                                            <div class="col-md-3">
                                               <!--  <input type="text" name="datetimes"> -->
                                                <label for="bootstrap-input-sm" class="control-label">Select Date Range</label>
                                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <span></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                                <input type="hidden" id="start_date_h" name="start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>" >
                                                <input type="hidden" id="end_date_h" name="end_date" value="<?php echo isset($end_date) ? $end_date : ''; ?>">
                                                 
                                            </div>
 

                                            <div class="col-md-2">
                                                <label for="bootstrap-input-sm" class="control-label" style="margin-top: 14px;">  </label> <br>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>

                                    </form>        
                                </div>
                            </div>
                <?php if(!empty($server_log) && isset($start_date) && isset($end_date) ){ ?>
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Server Log</div>
                                    <div class="tools1"> </div>
                                </div>

                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Sr. No. </th>
                                                <th> Log Date Time </th>
                                                <th> Log Type </th>
                                                <th> Log Text </th>
                                                  
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 

                                          if(!empty($server_log)){
                                            $counter = 1;
                                            
                                            foreach ($server_log as $key=>$value) {
                                            $type_name = strtolower($value['logtype']);
                                            $type = ($type_name == 'info' ) ? 'btn-info' : 'btn-danger';
                                            ?>

                                              <tr>
                                                <td><?php echo   $counter ;?> </td>
                                                <td><?php echo  date("F j, Y, g:i a" ,strtotime($value['logtime'])); ?> </td>
                                                <td><button type="button" class="btn <?php echo $type; ?>"><?php echo $type_name ;?></button></td>
                                                <td><?php echo   $value['logtext'] ;?></td>                                                
                                                
                                            </tr>

                                        <?php  $counter ++; } }?>
                                            
                                           
                                            
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
 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>

$(function() {

     <?php if( isset($start_date) && isset($end_date) ){ ?>
      var start = moment('<?php echo isset($start_date) ? $start_date : ''; ?>'); //.subtract(1, 'days');
      var end   = moment('<?php echo isset($end_date) ? $end_date : ''; ?>');
    <?php }else{ ?>
      var start = moment().subtract(1, 'days');
      var end   = moment();
    <?php } ?>

  function cb(start, end) {
     
        $('#start_date_h').val(start.format('YYYY-MM-DD HH:mm:ss'));
        $('#end_date_h').val(end.format('YYYY-MM-DD HH:mm:ss'));
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  }
  $('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    timePicker: true,
   // startDate: moment().startOf('hour'),
    //endDate: moment().startOf('hour').add(48, 'hour'),
    locale: {
      format: 'M/DD hh:mm A'
    }
  }, cb);
 cb(start, end);
});

</script>

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


