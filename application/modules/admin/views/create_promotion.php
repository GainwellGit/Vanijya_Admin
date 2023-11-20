<html>
<head>

</head>

<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->

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
          
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                            <a href="<?php echo base_url(); ?>admin">Quick Link</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                            <span>Promotion
                            <i class="fa fa-angle-right"></i>
                            </span>
                            </li>
                            
                            <li>
                                <span>Create Promotion</span>
                            </li>
                        </ul>

                    </div>
                    <!-- END PAGE BAR -->
                   
                    <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PORTLET-->
                                <div class="portlet light form-fit bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings font-green"></i>
                                            <span class="caption-subject font-green sbold uppercase">Add Promotion</span>
                                        </div>
                                        <div class="actions">
                                            <div class="">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                                        <div class="form-horizontal form-bordered">
                                            <div class="form-body">

                                                <form class="" action="<?php echo base_url('/admin/promotion/add_promotion'); ?>" method="post" role="form" enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Start Date</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
                                                                <input type="text" class="form-control"  name="start_date" 
                                                                value="" required onkeypress="return false;">
                                                                <span class="input-group-btn">
                                                                    <button class="btn default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                          
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">End Date</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
                                                                <input type="text" class="form-control"  name="end_date" 
                                                                value="" required onkeypress="return false;">
                                                                <span class="input-group-btn">
                                                                    <button class="btn default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                          
                                                        </div>

                                                    </div>
                                               
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Promotion Image
                                                         </br>
                                                            </br>
                                                             ( Allowed Filetype jpg | jpeg | png )
                                                             
                                                        </label>
                                                        <div class="col-md-9">
                                                            
                                                            
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                   
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                                                    
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                                                                        
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="hidden" value="" name="...">
                                                                            <input type="file" name="imgInp" required="required"> 
                                                                        </span>
                                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>        


                                                    <div class="form-group">
                                                        <label class="control-label col-md-3"></label>
                                                        <div class="col-md-9">
                                                            
                                                           
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                               <input type="submit" value="submit" style="padding: 7px 13px;border: 0; background: #32c5d2;"> 

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                                
                                            
                                            
                                        <!-- END FORM-->
                                    </div>
                                </div>
                                <!-- END PORTLET-->
                            </div>
                        </div>


                </div>
                <!-- END CONTENT BODY -->

                
            </div>
            <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
             <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
            <script>
            function readURL(input,dataId) {
                alert(dataId);
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $(".blah"+dataId).attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $(".imgInp").change(function(){
                var dataId = $(this).data("id");
                readURL(this,dataId);
            });
            </script>                 