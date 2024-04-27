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
          <span>Exception List
          <i class="fa fa-angle-right"></i>
          </span>
          </li>
            <li>
          <span>Region</span>
          </li>
          </ul>
          

          


          </div>
          <div class="content">
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
            <div class="form-group pull-right">
            
             
      		</div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

                              <div class="portlet box red">
                                <div class="portlet-title" style="background-color: #608259;">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Upload Customer Promocode Exception List</div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Message </th>
                                                <th> Date </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 

                                          if(!empty($exceptionList)){
                                            $counter = 1;
                                            $today = new DateTime();
                                            $compare = $today->format('Y-m-d');
                                            foreach ($exceptionList as $exception) {?> 

                                              <tr>
                                                    <td><?php echo $counter ?> </td>
                                                    <td> <?php echo $exception['message']; ?> </td>
                                                    <td> <?php echo $exception['created_date']; ?> </td>   
                                             </tr>

                                        <?php  $counter ++;} }?>
                                            
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           
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

<div class="modal left fade" id="customer_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Customer Promocode</h5>
                        <div style="margin-top:6px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                      <div id="dvLoading" style="display: none;"></div>
                      <form action="<?php echo base_url('/admin/usercoupon/bulk_promocode'); ?>" enctype="multipart/form-data" method="post" role="form">
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

        <script type="text/javascript">

var table;

$(document).ready(function() {
  var baseurl=window.location.origin+"/";
    //datatables
     table = $('#UsrTable').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/usercoupon/all_user_list')?>",
            "type": "POST"
        },

    "columnDefs": [{
            "targets": -1,
            "data": "8", 
            "render": function(data,type,full,meta)
              { return "<a href='https://apps.gainwellindia.com/gcpl/pmkit/admin/Usercoupon/view/"+data+"'><i class='fa fa-pencil-square-o'></i></a>";


              },
            "orderable":false,
            },
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
  /*  {
            "targets": [ 3 ],
            "data": "3",
            "render": function(data,type,full,meta)
       { return "<img src='"+data+"' width='75' height='75'>"; },
      "orderable":false,
        },*/
    // { 
    //         "targets": [3], //first column / numbering column
    //   "data": "3",
    //         "render": function(data,type,full,meta)
    //    { 
    //     if(data == 0){
    //       return '<label class="statusLbl"><div data-toggle="toggle" class="toggle btn btn-default off" style="width: 0px; height: 0px;"><input type="checkbox" value="'+data+'" class="toggle group_status_chk" groupid="'+full[4]+'" data-toggle="toggle"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div></label>';
    //     }else{
    //       return '<label class="statusLbl"><div data-toggle="toggle" class="toggle btn btn-primary" style="width: 0px; height: 0px;"><input type="checkbox" checked="checked" value="'+data+'" class="toggle group_status_chk" groupid="'+full[4]+'" data-toggle="toggle"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div></label>';   
    //     } 
    //   },
    //         "orderable": false, //set not orderable
    //     },
        ],
    });
});

</script> 

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 <style type="text/css">
   .dt-buttons{display: none;}
 </style>
 


