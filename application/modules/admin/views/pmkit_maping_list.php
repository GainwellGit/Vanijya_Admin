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
          <span>PMKIT Mapping</span>
          </li>
          </ul>
          <br><br>
          <div class="pull-right">
              <div class="col-xs-2"> <a href="<?php echo base_url(); ?>/admin/pmkit/download_excel">
              <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                Download Model-PMKIT Mapping Template
              </button></a>   
              </div>
          </div>
            <div class="form-group pull-right">
              <div class="col-xs-2">
              <button type="submit" class="btn btn-primary btn_customer" id="btn_location" name="btn_mulquiz">Upload Model-PMKIT Mapping </button>
              </div>
            </div>

            <div class="form-group pull-right">
              <div class="col-xs-2"><a href="<?php echo base_url(); ?>/admin/pmkit/download_model">
              <button type="submit" class="btn btn-primary btn_customer" id="btn_downloadquiz" name="btn_downloadquiz">Download Model Template </button></a>
              </div>
            </div>


             <div class="form-group pull-right">
              <div class="col-xs-2">
              <button type="submit" class="btn btn-primary btn_insert_model" id="btn_insert_model" name="btn_mulquiz">Upload Machine Model</button>
              </div>
             </div>
          </div>
          <div class="content">
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
            <div class="form-group pull-right">
              <div class="col-xs-2">
              <a href="<?php echo base_url('admin/pmkit/create_mapping'); ?>" class="nav-link "> <button  class="btn btn-primary addbtnsub btn_show" id="btn_click" name="btn_save">Create Model-PMKit Mapping</button></a>
              </div>
      		</div>
          </div>
          </div>
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
            <div class="form-group pull-right">
             
      		</div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Machine Models - PMKIT</div>
                                    <div class="tools1"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Model No. </th>
                                                <th> Description </th>
                                                <th> Industry Division </th>
                                                <th> Business Group </th>


                                                <th> PMKIT List </th>
                                                <!-- <th> IP </th> -->
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 

                                          if(!empty($finalArray)){
                                            $counter = 1;
                                            
                                            foreach ($finalArray as $key=>$value) {?>

                                              <tr>
                                                <td> <?php echo   $counter ;?> </td>
                                                <td> 
                                                <?php
                                                $sql ="SELECT * FROM `machine_model_master` WHERE `machine_id` ='$key'";
                                                $query = $this->db->query($sql);
                                                $result = $query->row();
                                                $display_name = isset($result->display_name) ? $result->display_name : $key;
                                                $machine_id = isset($result->machine_id) ? $result->machine_id : '';
                                                $industry_div = isset($result->industry_div) ? $result->industry_div : '';
                                                $business_grp = isset($result->business_grp) ? $result->business_grp : '';


                                                ?>
                                                <?php echo  $machine_id ?> 
                                                
                                                </td>
                                                <td><?php echo  $display_name;?> </td>
                                                <td><?php echo  $industry_div;?></td>
                                                <td><?php echo  $business_grp;?></td>
                                                <td> 
                                                   <?php 
                                                   $count = 1;
                                                   foreach($value as $values ){ 
                                                       
                                                       if(count($value) != $count)
                                                        echo  $values .' , ' ;
                                                        else
                                                        echo  $values;

                                                        $count++; } ?>

                                                </td>
                                                <!-- <td>
                                                  <?php 

                                                    $sql ="SELECT source_ip FROM `pmkit_mapping` WHERE `machinemodel_material_no` ='$key'";
                                                    $query = $this->db->query($sql);
                                                    $result1 = $query->row();
                                                    $ip = isset($result1->source_ip) ? $result1->source_ip : '';
                                                  ?>
                                                    <?php echo   $ip;?>                                              
                                                </td> -->
                                                <td> <a href="<?php echo base_url('admin/pmkit/edit_mapping/'.$key); ?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                            </tr>

                                        <?php  $counter ++; } }?>
                                            
                                           
                                            
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

<div class="modal left fade" id="location_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Create mapping</h5>
                        <div style="margin-top:6px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                      <div id="dvLoading" style="display: none;"></div>
                      <form action="<?php echo base_url('/admin/pmkit/bulk_mapping'); ?>" enctype="multipart/form-data" method="post" role="form">
                        <div class="form-group  row">
                          <label for="uploadfile" class="col-md-2 control-label fileUpload">Bulk Mapping</label>
                          <input type="file" id="uploadfile" class="col-md-6 uploadfile btn btn-primary" name="uploadfile" required="" accept=".xls, .xlsx, .csv"><div class="col-md-1"></div>
                          <button type="submit" class="col-md-2 btn btn-default" name="submit" value="submit">Upload</button>
                        </div>
                      </form>
                    </div>
              </div>
         </div>
  </div>

  <div class="modal left fade" id="upload_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Upload Model Number</h5>
                        <div style="margin-top:6px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                      <div id="dvLoading" style="display: none;"></div>
                      <form action="<?php echo base_url('/admin/pmkit/bulk_upload_model'); ?>" enctype="multipart/form-data" method="post" role="form">
                        <div class="form-group  row">
                          <label for="uploadfile" class="col-md-2 control-label fileUpload">Bulk Model</label>
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
 


