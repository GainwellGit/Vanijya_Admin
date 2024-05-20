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
          <span><a href="<?php echo base_url('admin/material_group'); ?>" >Discount List</a>
          <i class="fa fa-angle-right"></i>
          </span>
          </li>
          <li>
          <span>Create Material Group Wise Discount</span>
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
                                        <span class="caption-subject font-dark sbold uppercase">Create Promo Code  for  -- <?php echo isset($usercoupon->group_description) ? $usercoupon->group_description : $group_description?> (<?php echo isset($usercoupon->group_code) ? $usercoupon->group_code  : $group_code?>)</span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="<?php echo base_url('/admin/group/updatecoupon'); ?>" method="post" role="form">
                                      <input type="hidden" name="group_id" value="<?php echo isset($usercoupon->uid) ? $usercoupon->uid : $group_code?>">
                                      <input type="hidden" name="group_auto_id" value="<?php echo isset($usercoupon->aid) ? $usercoupon->aid : ''?>">
                                        <div class="form-body">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Group name</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> <?php echo isset($usercoupon->group_description) ? $usercoupon->group_description : $group_description?> </p>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Title</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo isset($usercoupon->title) ? $usercoupon->title : ''?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Coupon code</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <div class="">
                                                            <input  class="form-control couponcode" type="text" name="code" 
                                                            placeholder="coupon code" value="<?php echo isset($usercoupon->promocode) ? $usercoupon->promocode : ''?>" required/> </div>
                                                        <span class="input-group-btn">
                                                            <button id="gengroupcoupon" data-id="<?php echo isset($usercoupon->uid) ? $usercoupon->uid : ''?>" class="btn btn-success" type="button">
                                                                <i class="fa fa-arrow-left fa-fw" /></i><span class="generate"> Generate</span></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Coupon type</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="type" required>
                                                        <option value="">Select</option>
                                                        <?php
                                                        $d_type = isset($usercoupon->discount_type) ? $usercoupon->discount_type : '';
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
                                                    <input type="text" class="form-control" name="ammount" placeholder="Value" value="<?php echo isset($usercoupon->discount_value) ? $usercoupon->discount_value : ''?>" required>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Min amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="min_ammount" placeholder="Value" value="<?php echo isset($usercoupon->min_ammount) ? $usercoupon->min_ammount : ''?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Valid from</label>
                                                <div class="col-md-9">
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
                                                        <input type="text" class="form-control"  name="valid_from" 
                                                value="<?php echo isset($usercoupon->from_date) ? $usercoupon->from_date : ''?>" required onkeypress="return false;">
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
                                                value="<?php echo isset($usercoupon->to_date) ? $usercoupon->to_date : ''?>" required onkeypress="return false;">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                            
                                            
                                           
                                            
                                           
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-5 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <?php if(isset($usercoupon->promocode) && $usercoupon->promocode !=''){?>
                                                    <button type="submit" class="btn red" name="delete">Delete</button>
                                                    <?php } ?>
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
 


