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
          <span>Discount
          <i class="fa fa-angle-right"></i>
          </span>
          </li>
          <li>
          <span>Setup Zone Wise discount</span>
          </li>
          </ul>
          
          </div>
          <div class="content">
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
            <div class="form-group pull-right">
             
      		</div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Setup Discount For Zones</div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Zone </th>
                                                <th> Title </th>
                                                <th> Promocode </th>
                                                <th> Discount Value </th>
                                                <th> Min Amount </th>
                                                <th> Start Date </th>
                                                <th> End Date </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 

                                          if(!empty($zonecoupon)){
                                            $counter = 1;
                                            $today = new DateTime();
                                            $compare = $today->format('Y-m-d');
                                            foreach ($zonecoupon as $zone) {
                                                
                                                if($zone['promocode'] !=''){?>
                                                        <tr>
                                                            <td> <?php echo   $counter ;?> </td>
                                                            <td> <?php echo   $zone['zone_name'] ;?> </td>

                                                            <?php if($zone['to_date'] >= $compare && $zone['is_delete'] != 1){?>
                                                                <td> <?php echo   $zone['title'] ;?> </td>
                                                                <td> <?php echo  $zone['promocode'] ;?> </td>
                                                                <td> 
                                                                    <?php 
                                                                        if($zone['type'] =='VALUE'){
                                                                        echo  'RS '.$zone['discount_value'] ;
                                                                        }else{
                                                                        echo  $zone['discount_value'].' '.$zone['type'] ;
                                                                        }
                                                                    ?> 
                                                                </td>
                                                                <td> <?php echo  $zone['min_ammount'] ;?> </td>
                                                                <td> 
                                                                    <?php 
                                                                        $date=date_create($zone['from_date']); 
                                                                        echo ($zone['from_date'] !='') ? date_format($date,"jS F, Y") : '';
                                                                    ?> 
                                                                </td> 
                                                                <td>
                                                                    <?php 
                                                                        $valid_to=date_create($zone['to_date']); 
                                                                        echo ($zone['to_date'] !='') ? date_format($valid_to,"jS F, Y") : '';
                                                                    ?> 
                                                                </td>
                                                            <?php }else{?>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                            <?php } ?> 

                                                            <td> <a href="<?php echo base_url('admin/location/zone/'.str_replace(' ', '_', $zone['zone_name'])); ?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                                        </tr>
                                                <?php } else{?> 
                                                    <tr>
                                                            <td> <?php echo   $counter ;?> </td>
                                                            <td> <?php echo   $zone['zone_name'] ;?> </td>
                                                            <td> <?php echo   $zone['title'] ;?> </td>
                                                            <td>  </td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td> <a href="<?php echo base_url('admin/location/zone/'.str_replace(' ', '_', $zone['zone_name'])); ?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                                        </tr>       

                                                <?php }  $counter ++;} }?>
                                            
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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



<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


