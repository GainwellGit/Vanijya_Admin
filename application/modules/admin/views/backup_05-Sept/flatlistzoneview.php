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
          <span><a href="<?php echo base_url('admin/zone'); ?>" >Discount List</a>
          <i class="fa fa-angle-right"></i>
          </span>
          </li>
          <li>
          <span>Create Zone Wise Discount</span>
          </li>
          </ul>
          </div>
          <div class="content">
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
              <div class="col-md-2 "></div>
              <div class="col-md-8 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase">Create Promo Code  for  -- <?php echo isset($zonecoupon->zone_name) ? $zonecoupon->zone_name : $zone_name?> </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="<?php echo base_url('/admin/location/updatezonecoupon'); ?>" method="post" role="form">
                                      <input type="hidden" name="zone_id" value="<?php echo isset($zonecoupon->id) ? $zonecoupon->id : $z_id?>">
                                        <div class="form-body">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Zone name</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> <?php echo isset($zonecoupon->zone_name) ? $zonecoupon->zone_name : $zone_name?> </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Title</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="title" placeholder="Value" value="<?php echo isset($zonecoupon->title) ? $zonecoupon->title : ''?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Coupon code</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <div class="">
                                                            <input  class="form-control couponcode" type="text" name="code" 
                                                            placeholder="coupon code" value="<?php echo isset($zonecoupon->promocode) ? $zonecoupon->promocode : ''?>" required/> </div>
                                                        <span class="input-group-btn">
                                                            <button id="genzonecoupon" data-id="<?php echo isset($zonecoupon->id) ? $zonecoupon->id : ''?>" class="btn btn-success" type="button">
                                                                <i class="fa fa-arrow-left fa-fw" /></i><span class="generate"> Generate</span></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Coupon type</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="type" required>
                                                        <option select="value">Select</option>
                                                        <?php
                                                        $d_type = isset($zonecoupon->discount_type) ? $zonecoupon->discount_type : '';
                                                        if (!empty($type)) {
                                                          foreach ($type as $types) {?>

                                                            
                                                            <option value="<?php echo $types['id'];?>" <?php echo ($types['id'] == $d_type) ? 'selected' : ''?> ><?php echo $types['description'];?></option>

                                                        <?php }} ?>

                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Coupon value</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="ammount" placeholder="Value" value="<?php echo isset($zonecoupon->discount_value) ? $zonecoupon->discount_value : ''?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Min amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="min_ammount" placeholder="Value" value="<?php echo isset($zonecoupon->min_ammount) ? $zonecoupon->min_ammount : ''?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Valid from</label>
                                                <div class="col-md-9">
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
                                                        <input type="text" class="form-control"  name="valid_from" 
                                                value="<?php echo isset($zonecoupon->from_date) ? $zonecoupon->from_date : ''?>" required onkeypress="return false;">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                  
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Valid to</label>
                                                <div class="col-md-9">
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
                                                        <input type="text" class="form-control"  name="valid_to" 
                                                value="<?php echo isset($zonecoupon->to_date) ? $zonecoupon->to_date : ''?>" required onkeypress="return false;">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Check all zone</label>
                                                <div class="col-md-9">
                                                <input type="checkbox" id="ckbCheckAll" />
                                                </div>
                                            </div>
                                             
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                            <div class="col-md-6">
                                            
                                                <p id="checkBoxes">
                                                <?php if(!empty($get_location_by_zone))
                                                   foreach($get_location_by_zone as $zones){{
                                                    $sql ="SELECT * FROM `discount_detail` WHERE `discount_detail`.`discount_on` = '".$zones['region_code']."' AND `discount_detail`.`discount_category` = '4' ORDER BY `discount_detail`.`id` DESC LIMIT 1";
                                                    $query = $this->db->query($sql);
                                                    $result = $query->row();
                                                    $to_date = isset($result->to_date) ? $result->to_date : '';
                                                    ?>

                                                      <input type="checkbox"  class="checkBoxClass" Value="<?php echo $zones['region_code'] ?>" name="zone[]"  <?php echo ( $to_date == $zone_to_date) ? 'checked':'' ?> > 
                                                      <?php echo $zones['region_description'] ?>  </br>

                                                <?php }} ?>
                                                </p>
                                            </div>
                                                
                                               
                                            </div>
                                        </div>
                                        
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-5 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                           
                            
               </div>
               <div class="col-md-2 "></div>
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
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


