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
          <span>Setup Material Group Wise Discount</span>
          </li>
          </ul>
          <div class="pull-right">
              <div class="col-xs-2"> <a href="<?php echo base_url(); ?>/admin/group/download_promoexcel">
              <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                Download Group Template
              </button></a>   
              </div>
          </div>
          <div class="form-group pull-right">
              <div class="col-xs-2">
              <button type="submit" class="btn btn-primary btn_customer" id="btn_group" name="btn_mulquiz">Upload Group Promocode </button>
              </div>
             </div>
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
                                        <i class="fa fa-globe"></i>Setup Discount For Material Group</div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> code </th>
                                                <th> Name </th>
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

                                          if(!empty($userlist)){
                                            $counter = 1;
                                            $today = new DateTime();
                                            $compare = $today->format('Y-m-d');
                                            foreach ($userlist as $user) {?>

                                              <tr>
                                                <td> <?php echo   $counter ;?> </td>
                                                <td> <?php echo   $user['code'] ;?> </td>
                                                <td> <?php echo  ucfirst($user['name']) ;?> </td>

                                                <?php if($user['valid_to'] >= $compare && $user['is_delete'] != '1'){?>
                                                  <td> <?php echo  $user['coupon_code'] ;?> </td>
                                                  <td> 
                                                      <?php 
                                                          if($user['coupon_type'] =='VALUE'){
                                                            echo  'RS '.$user['coupon_ammount'] ;
                                                          }else{
                                                            echo  $user['coupon_ammount'].' '.$user['coupon_type'] ;
                                                          }
                                                      ?> 
                                                  </td>
                                                  <td> <?php echo  $user['min_ammount'] ;?> </td>
                                                  <td> 
                                                      <?php 
                                                          $date=date_create($user['valid_from']); 
                                                          echo ($user['valid_from'] !='') ? date_format($date,"jS F, Y") : '';
                                                      ?> 
                                                  </td> 
                                                  <td>
                                                      <?php 
                                                          $valid_to=date_create($user['valid_to']); 
                                                          echo ($user['valid_to'] !='') ? date_format($valid_to,"jS F, Y") : '';
                                                      ?> 
                                                  </td>
                                                <?php }else{?>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                <?php } ?>   


                                                <td> <a href="<?php echo base_url('admin/group/view/'.$user['group_id']); ?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                            </tr>

                                        <?php  $counter ++;} }?>
                                            
                                           
                                            
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

<div class="modal left fade" id="group_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Group Promocode</h5>
                        <div style="margin-top:6px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                      <div id="dvLoading" style="display: none;"></div>
                      <form action="<?php echo base_url('/admin/group/bulk_promocode'); ?>" enctype="multipart/form-data" method="post" role="form">
                        <div class="form-group  row">
                          <label for="uploadfile" class="col-md-2 control-label fileUpload">Bulk Upload</label>
                          <input type="file" id="uploadfile" class="col-md-6 uploadfile btn btn-primary" name="uploadfile" required="" accept=".xls, .xlsx, .csv"><div class="col-md-1"></div>
                          <button type="submit" class="col-md-2 btn btn-default" name="submit" value="submit">Upload</button>
                        </div>
                      </form>
                    </div>
              </div>
          </div>
        </div>

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 
<style type="text/css">
   .dt-buttons{display: none;}
 </style>

