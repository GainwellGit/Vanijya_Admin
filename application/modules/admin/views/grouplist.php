<html>
<head>
     <style>
        .btn-error {
            background-color: #FF3F3F;
            border-color: #FF3F3F;
            color: #fff;
        }
.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}
.btnsub {
    padding: 3px 5px 10px;
    display: inline-block;
    margin: 5px 5px 0 0 !important;
    width: 35%;
    border-radius: 4px;
} 
.addbtnsub {
/*    padding: 3px 5px 10px;*/
    display: inline-block;
    margin: 5px 5px 0 0 !important;
   /* width: 100%;*/
    border-radius: 4px;
} 
.box_new{border: 1px solid #eee;padding: 15px 0 25px;}
.box_new1{margin-bottom:10px;}
.box_new2{border: 1px solid #eee;padding:10px;margin-bottom:5px;}
.box_new3{border: 1px solid #eee;padding:10px;}
.chk_option{ width: 10%; padding:20px;}
.point-box{border-right: 1px solid #eee}
.checkbox, .radio{margin-top: 0;}
input[type='checkbox'] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border-radius: 1%;
  width: 20px;
  height: 20px;
  border: 1px solid #00717f;
  transition: 0.2s all linear;
  outline: none;
  margin-right: 15px;
 
  position: relative !important;
  top: 0px;
  vertical-align: bottom;
  
}

input[type='checkbox']:checked {
  border: 1px solid #00717f;
  outline: none;
}
input[type='checkbox']:checked::after{display: block;}
input[type='checkbox']::after
{   left: 6px;
    top: 1px;
    width: 6px; 
    height: 14px;
    border: solid #f00;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);display: none;
    content: "";position: relative;
  }
.modal.left .addmodal.modal-dialog{
    position: fixed;
    margin: auto;
    width: 28%;
    -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
         -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
            
             
  }

  
  .modal.left .modal-body
  {
    padding: 15px 15px 30px;
  }

/*Left*/
  .modal.left.fade .modal-dialog{
    left: -320px;
    -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
         -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
  }
  
  .modal.left.fade.in .modal-dialog{
    left: 0;
    right:25px;
  }
   div#exampleModal1 {
    margin-top: 5%;
}    
.help-error{
  color:#e73d4a;
} 
.label-success {
    background-color: #5cb85c;
}
.btn-circle {
    width: 23px;
    height: 23px;
    padding: 0px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}

.file-upload {
    position: absolute;
    display: inline-block;
    top: 20px;
    width: 115px;
    height: 115px;
    margin: 20px auto;
    left: 0;
    right: 0;
    border-radius: 50%;
    overflow: hidden;
    opacity: 0;
}

.file-upload__label {
    display: block;
    padding: 0;
    color: #fff;
    background: #222;
    transition: background .3s;
    width: 100%;
    height: 100%;
}
.file-upload__label:hover {
  cursor: pointer;
}
.edit_profle {
    position: absolute;
    top: 33px;
    color: #fff;
    right: 84px;
    font-size: 21px;
}
.file-upload__input {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  font-size: 1;
  width: 0;
  height: 100%;
  opacity: 0;
}
.edit_form > form > .form-group > label {
    font-size: 17px;
    font-weight: normal;
    color: #003367;
    line-height: 35px;
}
.edit_form {
    margin: 20px;
}
.form-control.form_modify {
    border-radius: 0;
    box-shadow: none;
    border-color: #787878;
}
.profile-icon {
  width: 115px;
  height: 115px;
  border-radius: 50%;
  overflow: hidden;
  margin: 20px auto;
}
.profile_name > p {
  color: #fff;
  text-align: center;
  font-size: 16px;
}
#image_upload_preview {
    width: 100%;
    height: 100%;
}

#btn_subm {
    width: 26%;
    margin-left: 18px;
    margin-top: 25px;
    padding: 10px;
    border-radius: 3px !important;
    border: 0;
}

.popup_heading_text{font-weight:600; float:left;}
.title_text{ text-align:right; margin-top:5px;}
.bootbox .modal-content {
    margin-left: 160px;
    width: 55%;
}
</style>
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
          <ul class="page-breadcrumb" style="width:100%">
          <li>
          <a href="<?php echo base_url(); ?>admin">Quick Link</a>
          <i class="fa fa-angle-right"></i>
          </li>
          <li>
          <span>Group List</span>
          </li>
          <div class="pull-right">
              <div class="col-xs-2"> <a href="<?php echo base_url(); ?>/admin/group/download_excel">
              <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                Download Sample CSV
              </button></a>   
              </div>
          </div>
          </ul>
          </div>
          <div class="content">
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
              <div class="form-group pull-right">
              <div class="col-xs-2">
              <button type="submit" class="btn btn-primary btn_mulquiz" id="btn_group" name="btn_mulquiz">Add Multiple Group</button>
              </div>
             </div>
            <div class="form-group pull-right">
              <div class="col-xs-2">
              <button type="submit" class="btn btn-primary addbtnsub btn_show" id="btn_click" name="btn_save">Add New</button>
              </div>
              
      		</div>
          </div>
          </div>
       
         <div class="box" style="border:1px solid #eee; padding:15px">

            <div class="box-header">
            </div>
            <div class="box-content">          
     <!--<div class="table-responsive">-->
      <div>
     <table id="UsrTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Code</th>
                    <th>Group Name</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                    <th>Serial No</th>
                    <th>code</th>
                    <th>Group Name</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
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

        <!--Add Quizset Modal show  -->
        <div class="modal left fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="addmodal modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Group</h5>
                        <div style="margin-top:6px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                      <div id="dvLoading" style="display: none;"></div>
                      <form name="group_add" id="group_add" action="<?php echo base_url('/admin/Group/addgroup'); ?>" method="post">
                            <div class="box">
                            </div>
                            <div class="">
                            <div class="row" style="margin-top:20px;">
                                  <div class="form-group">
                                    <div class="col-xs-12 text-left">
                                      <label for="groupcode" class="title_text">Group Code:</label>
                                    </div>
                                    <div class="col-xs-12 title-error-div">
                                      <input type="text" name="groupcode" class="form-control" id="groupcode">
                                      <span id="title-error" class="help-error" style="text-align:center;"></span>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="col-xs-12 text-left">
                                      <label for="groupname" class="title_text">Group Name:</label>
                                    </div>
                                    <div class="col-xs-12 title-error-div">
                                      <input type="text" name="groupname" class="form-control" id="groupname">
                                      <span id="title-error" class="help-error" style="text-align:center;"></span>
                                    </div>
                                  </div>
                            </div>
                          </div>
                          <div class="">
                              <div class="row">
                                  <div class="col-xs-12">
                                    <div class="text-right">
                                    <button id="btn_subm" type="submit" class="btn btn-primary" name="btn_sub">SAVE</button>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                              </div>
                          </div>
                      </form>
                    </div>
              </div>
          </div>
        </div>

        <div class="modal left fade" id="bulkupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Group</h5>
                        <div style="margin-top:6px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                      <div id="dvLoading" style="display: none;"></div>
                      <form action="<?php echo base_url('/admin/group/muliplequiz'); ?>" enctype="multipart/form-data" method="post" role="form">
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
            "url": "<?php echo site_url('admin/group/group_list')?>",
            "type": "POST"
        },

		"columnDefs": [{
            "targets": -1,
            "data": "5", 
            "render": function(data,type,full,meta)
			 { return "<button class='btn btn-primary btn-xs btn1_edit1' data-title='Edit' name='btn_edit1' group_id='"+data+"'><span class='glyphicon glyphicon-pencil'></span></button><button class='btn btn-danger btn-xs group_delete' data-title='Delete' data-toggle='modal' data-target='#delete' delete_group='"+data+"' style='margin-left:5px;'><span class='glyphicon glyphicon-trash'></span></button>";
			},
			"orderable":false,
        },
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
	/*	{
            "targets": [ 3 ],
            "data": "3",
            "render": function(data,type,full,meta)
			 { return "<img src='"+data+"' width='75' height='75'>"; },
			"orderable":false,
        },*/
		{ 
            "targets": [3], //first column / numbering column
			"data": "3",
            "render": function(data,type,full,meta)
			 { 
			 	if(data == 0){
					return '<label class="statusLbl"><div data-toggle="toggle" class="toggle btn btn-default off" style="width: 0px; height: 0px;"><input type="checkbox" value="'+data+'" class="toggle group_status_chk" groupid="'+full[4]+'" data-toggle="toggle"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div></label>';
				}else{
					return '<label class="statusLbl"><div data-toggle="toggle" class="toggle btn btn-primary" style="width: 0px; height: 0px;"><input type="checkbox" checked="checked" value="'+data+'" class="toggle group_status_chk" groupid="'+full[4]+'" data-toggle="toggle"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div></label>';	 
				} 
			},
            "orderable": false, //set not orderable
        },
        ],
    });
});

</script> 
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


