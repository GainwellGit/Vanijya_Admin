<html>
<head>

</head>

<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>admin">Quick Link</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            
                            <li>
                            <span><a href="<?php echo base_url('admin/pmkit'); ?>">Machine Model And PMKIT Mapping</a>
                            <i class="fa fa-angle-right"></i>
                            </span>
                            </li>
                            <li>
                                <span>Create Mapping</span>
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
                                <input type="hidden" name="model_id" value="" > 
                                    <div class="portlet-body">
                                    
                                        <div class="form-group">
                                            <label for="single" class="control-label" style="margin-bottom: 10px;">Model List</label>
                                            <select id="single" class="form-control select2" name="models" required >
                                                <option></option>
                                                <?php
                                                if(!empty($models)){
                                                    foreach($models as $model){ 
                                                        if ( !in_array($model->machine_id,$getPmkit)){ ?>
                                                        <option value="<?php echo $model->machine_id ?>"><?php echo $model->display_name .'  ('. $model->machine_id .')' ?></option>

                                                <?php } } } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="multiple" class="control-label" style="margin-bottom: 10px;">PMKIT List</label>
                                            <select id="multiple" class="form-control select2-multiple" name="pmkits[]" multiple required>
                                                
                                                <?php
                                                if(!empty($pmkit)){
                                                    foreach($pmkit as $pmkits){ ?>
                                                        <option value="<?php echo $pmkits->material_no ?>"><?php echo '('.$pmkits->material_no.') ' . $pmkits->material_description ?></option>

                                                <?php } } ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-11">
                                                <button type="submit" class="btn green" value="submit" name="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
                  