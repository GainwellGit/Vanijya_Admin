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
                        <a href="<?php echo base_url("admin/pmkit") ?>">
                            <span>Master Data
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <span>Bulk Image Upload</span>
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
                                <span class="caption-subject font-green bold uppercase">Bulk Image Upload</span>
                            </div>
                            
                        </div>
                        <!-- Display status message -->
                        <?php if($CI->session->flashdata('bulkimg_success')){?>
                         <p class="status-msg"><?php echo $CI->session->flashdata('bulkimg_success'); ?></p><?php }?>
                        <form method='POST' action="<?php echo base_url('admin/home/bulk_image_submit'); ?>" enctype='multipart/form-data'>
                            <input type='file' name='files[]' multiple=""> <br/><br/>
                            <input type='hidden' name='modelno' value='<?php echo $modelno; ?>'>
                            <input type='submit' class='btn btn-primary' value='Upload' name='upload' />
                        </form>
                    </div>
                    
                </div>
            </div>

            <?php //if(!empty($pmkitimage)){?>
            <div class="row">
                <?php if($CI->session->flashdata('imgerror')){ ?>
                <div class="alert-danger fade in alert-dismissable" style="margin-top:18px;"> <?php echo $CI->session->flashdata('imgerror') ?> </div>
                <?php }?>

                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light form-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Pmkit Image </span>
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
                                    <?php foreach($pmkitimage as $images){ ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?php echo $images->material_description . ' (Model - '. $images->pmkit_material_no .')';?>
                                                </br>
                                                </br>
                                                    ( Allowed Filetype jpg | jpeg | png )
                                            </label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <?php if($images->thumbnail !=''){?>

                                                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($images->thumbnail ).'" />' ?>

                                                
                                                        <?php }else{?>
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                                        <?php } ?>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                
                                </div>  
                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
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
    <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
           