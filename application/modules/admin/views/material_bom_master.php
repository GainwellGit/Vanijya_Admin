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
          <span>Master Data</span>
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
                                        <i class="fa fa-globe"></i>Material Bom Master Data</div>
                                    <div class="tools1"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Pmkit Material No </th>
                                                <th> Plant Code </th>
                                                <th> Bom Material No </th>
                                                <th> Material Description </th>
                                                <th> Material Quantity</th>
                                                <th> Last updated </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 

                                          if(!empty($material_bom)){
                                            $counter = 1;
                                            
                                            foreach ($material_bom as $key=>$value) {?>

                                              <tr>

                                                <?php
                                                  $source2 = $this->db->query('select * from material_bom_master where pmkit_material_no = "' . $value['pmkit_material_no'].'"');
                                                    $total_source2 = $source2->num_rows();
                                                  $source3 = $source2->result_array();
                                                  $rowspan = true;
                                                ?>
                                                <td rowspan="<?php echo $total_source2 ?>"><?php echo $counter;  ?></td>
                                                <td rowspan="<?php echo $total_source2 ?>"> <?php echo   $value['pmkit_material_no'] ;?> </td>
                                                <?php foreach ($source3 as $source3) { 
                                                  $splitTimeStamp = explode(" ",$source3['updated_at']);
                                                  $updateDate = $splitTimeStamp[0];
                                                  $updateTime = $splitTimeStamp[1];
                                                  ?>
                                                  
                                                  <td><?php echo   $source3['plant_code'] ;?> </td>
                                                  <td><?php echo   $source3['bom_material_no'] ;?></td>
                                                  <td><?php echo   $source3['material_description'] ;?></td>
                                                  <td><?php echo   $source3['material_quantity'] ;?></td>
                                                  <td><?php echo   $updateDate.'<br>'.$updateTime ;?></td>
                                               </tr>
                                                <?php } ?>
                                                
                                            

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


<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


