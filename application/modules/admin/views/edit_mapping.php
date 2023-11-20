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
                            <a href="<?php echo base_url("admin/pmkit") ?>"><span>Machine Model and PM KIT Mapping
                            <i class="fa fa-angle-right"></i>
                            </span></a>
                            </li>
                            <li>
                                <span>Edit Mapping</span>
                            </li>
                        </ul>

                    </div>
                    <!-- END PAGE BAR -->
                   
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-social-dribbble font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Mapping</span>
                                    </div>
                                    
                                </div>
                                <form class="" action="<?php echo base_url('/admin/pmkit/insert_mapping_data'); ?>" method="post" role="form">
                                    <input type="hidden" name="model_id" value="<?php echo isset($modelno) ? $modelno : ''; ?>" >
                                    <div class="portlet-body">
                                    
                                        <div class="form-group">
                                            <label for="single" class="control-label" style="margin-bottom: 10px;">Model List</label>
                                            <select id="single" class="form-control select2" name="models" required>
                                                <option></option>
                                                <?php
                                                if(!empty($getModelById)){
                                                    foreach($getModelById as $model){ ?>
                                                        <option  value="<?php echo $model->machine_id ?>" selected ><?php echo '  ('. $model->machine_id .') '.$model->display_name  ?></option>

                                                <?php  } }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="multiple" class="control-label" style="margin-bottom: 10px;">Pmkit list</label>
                                            <select id="multiple" class="form-control select2-multiple" name="pmkits[]" multiple required>
                                                
                                                <?php
                                                if(!empty($pmkit)){
                                                    
                                                    foreach($pmkit as $pmkits){ ?>
                                                        <option value="<?php echo $pmkits->material_no ?>" <?php echo (in_array($pmkits->material_no,$getPmkit)) ? 'selected' : ''?>><?php echo '('.$pmkits->material_no.') ' . $pmkits->material_description ?></option>

                                                <?php } } ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-9">
                                                <button type="submit" class="btn green" value="submit" name="submit">Submit</button>
                                                <button type="submit" class="btn green" value="delete" name="submit">Delete Model</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                           
                        </div>
                    </div>

                    <?php //if(!empty($pmkitimage)){?>
                        <!--<div class="row">
                            <?php //if($CI->session->flashdata('imgerror')){ ?>
                              <div class="alert-danger fade in alert-dismissable" style="margin-top:18px;"> <?php //echo $CI->session->flashdata('imgerror') ?> </div>
                              <?php //}?>

                            <div class="col-md-12">-->
                                <!-- BEGIN PORTLET-->
                                <!--<div class="portlet light form-fit bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings font-green"></i>
                                            <span class="caption-subject font-green sbold uppercase">Upload Pmkit Image </span>
                                        </div>
                                        <div class="actions">
                                            <div class="">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body form">-->
                                        <!-- BEGIN FORM-->
                                        <!--<div class="form-horizontal form-bordered">
                                            <div class="form-body">
                                                <?php //foreach($pmkitimage as $images){ ?>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3"><?php //echo $images->material_description . ' (Model - '. $images->pmkit_material_no .')';?>
                                                            </br>
                                                            </br>
                                                             ( Allowed Filetype jpg | jpeg | png )
                                                        </label>
                                                        <div class="col-md-9">-->
                                                            <!-- <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <span class="btn green btn-file">
                                                                    <span class="fileinput-new upload"> Select file </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" name="..."> </span>
                                                                <span class="fileinput-filename"> </span> &nbsp;
                                                                <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                            </div> -->
                                                            <!--<form class="" action="<?php //echo base_url('/admin/pmkit/insert_image/'.$images->pmkit_material_no); ?>" method="post" role="form" enctype="multipart/form-data">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <?php //if($images->thumbnail !=''){?>

                                                            <?php //echo '<img src="data:image/jpeg;base64,'.base64_encode($images->thumbnail ).'" />' ?>

                                                            
                                                        <?php //}else{?>
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                                        <?php //} ?>    
                                                            </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="hidden" value="" name="...">
                                                                <input type="file" name="imgInp" required="required"> </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            <input type="submit" value="submit" style="padding: 7px 13px;border: 0; background: #32c5d2;">
                                                        </div>
                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php //} ?>
                                            
                                            </div>  
                                        </div>-->
                                        <!-- END FORM-->
                                    <!--</div>
                                </div>-->
                                <!-- END PORTLET-->
                            <!--</div>
                        </div>-->
                    <?php //} ?>

                </div>
                <!-- END CONTENT BODY -->

                
            </div>
            <style type="text/css">
                .alert-success p {
                    padding: 11px;
                }
            </style>
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
            <style type="text/css">
                .alert-danger>p {
                    padding: 13px;
                }
            </style>              