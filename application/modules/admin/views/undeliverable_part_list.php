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
                        <span>Undeliverable Part List</span>
                    </li>
                </ul>
                <div class="pull-right">
                    <div class="col-xs-2"> <a href="<?php echo base_url(); ?>/admin/undeliverable/download_excel">
                        <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                            Download Undeliverable Parts Template
                        </button></a>   
                    </div>
                </div>
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
                                <span class="caption-subject font-green bold uppercase">Excel Upload</span>
                            </div>
                            
                        </div>
                        <!-- Display status message -->
                        <?php if($CI->session->flashdata('bulkimg_success')){?>
                         <p class="status-msg"><?php echo $CI->session->flashdata('bulkimg_success'); ?></p><?php }?>
                        <form method='POST' id="import_undeliverable_parts" enctype='multipart/form-data'>
                            <input type='file' name='file' id='file' required accept=".xls, .xlsx"> <br/><br/>
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
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box red">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-globe"></i>Undeliverable Part List</div>
                        <!--<div class="tools1"> </div>-->
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                            <tr>
                            <th> ID </th>
                            <th> Part No </th>
                            <th> Part Description</th>
                            <th> Remarks </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($partlists)){
                            $counter = 1; 
                            foreach( $partlists as $partlist){ ?>
                            <tr>
                            <td><span><?php echo $counter ;?></span></td>
                            <td><span id="partn-<?php echo $partlist['id']; ?>"><?php echo isset($partlist['part_no']) ? $partlist['part_no'] : ''; ?></span></td>
                            <td><span id="partd-<?php echo $partlist['id']; ?>"><?php echo isset($partlist['part_description']) ? $partlist['part_description'] : ''; ?></span></td>
                            <td><span id="partr-<?php echo $partlist['id']; ?>"><?php echo isset($partlist['reason']) ? $partlist['reason'] : ''; ?></span></td>
                            </tr>

                            <?php $counter ++;} } ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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

        $(document).ready(function(){
            $('#import_undeliverable_parts').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/undeliverable/excel_import',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data){console.log(data);
                        $('#file').val('');
                        toastr["info"]("", "success : Undeliverable part list is imported successsfully.")
                        //window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Request failed, handle the error
                        toastr["error"]("", "Failure : Something went wrong.")
                    }
                });
                $(document).ajaxStop(function(){
                    setTimeout(function(){// wait for 1 secs(2)
                        window.location.reload(); // then reload the page.(3)
                    }, 1000);
                });
            });
        });
    </script>   
    <style type="text/css">
        .alert-danger>p {
            padding: 13px;
        }
        .dt-buttons {
            display: none;
        }
    </style>  
    <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/toastr.min.js" type="text/javascript"></script>
           