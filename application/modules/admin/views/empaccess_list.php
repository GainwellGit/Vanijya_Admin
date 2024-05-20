<html>

<style type="text/css">
  
  /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  margin: 0;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px !important;
}

.slider.round:before {
  border-radius: 50%;
}
.content2 {
    /* min-height: 250px; */
    padding: 3px;
    margin-right: auto;
    margin-left: auto;
    padding-left: 0;
    padding-right: 0;
}
.box2 {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border: 3px solid #d2d6de;
    margin-top: 15px;
    margin-bottom: -11px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    padding: 10px
}
.exception .dt-buttons {
    display: none;
}
div#sample_1_length {
    float: left;
}
.buttons-excel {
        background-color: #8dc73f;
        border: none;
        color: white;
        padding: 5px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        position: absolute;
    }
</style>

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
            <span>Employee App Access List</span>
          </li>
        </ul>
      </div>
      <div class="content">
        <div class="row" style="margin-bottom:20px; ">
          <div class="col-xs-12">
            <div class="form-group pull-right">
              <div class="col-xs-2">
                <a href="#" class="nav-link "> <button type="submit" class="btn btn-primary addbtnsub btn_show addModal" id="btn_click" name="btn_save">Create Employee Access</button></a>
              </div>
            </div>
          </div>
        </div>
            
        <div class="row" style="margin-bottom:20px; ">
          <div class="col-xs-12">
            <div class="form-group pull-right">
            
            </div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box red">
              <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i>Employee App Access List</div>
                <div class="tools1"> </div>
              </div>
              <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr>
                      <th> ID </th>
                      <th> Employee ID </th>
                      <th> Name</th>
                      <th> Mobile No. </th>
                      <th> Email </th>
                      <th> Grade </th>
                      <th> Location </th>
                      <th> Broad Function </th>
                      <th> Job Function </th>
                      <th> Created By </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($empaccess)){
                      $counter = 1; 
                      foreach( $empaccess as $empaccesses){ ?>
                      <tr>
                      <td><span><?php echo $counter ;?></span></td>
                      <td><span id="empid-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_id']) ? $empaccesses['emp_id'] : ''; ?></span></td>
                      <td><span id="empn-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_name']) ? $empaccesses['emp_name'] : ''; ?></span></td>
                      <td><span id="empm-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_mobile']) ? $empaccesses['emp_mobile'] : ''; ?></span></td>
                      <td><span id="empe-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_email']) ? $empaccesses['emp_email'] : ''; ?></span></td>
                      <td><span id="empg-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_grade']) ? $empaccesses['emp_grade'] : ''; ?></span></td>
                      <td><span id="empl-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_location']) ? $empaccesses['emp_location'] : ''; ?></span></td>
                      <td><span id="empb-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_broad_function']) ? $empaccesses['emp_broad_function'] : ''; ?></span></td>
                      <td><span id="empj-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['emp_job_function']) ? $empaccesses['emp_job_function'] : ''; ?></span></td>
                      <td><span id="empc-<?php echo $empaccesses['id']; ?>"><?php echo isset($empaccesses['created_by']) ? $empaccesses['created_by'] : ''; ?></span></td>
                      <td><a data-id="<?php echo $empaccesses['id'] ;?>" data-empid="<?php echo $empaccesses['emp_id'] ;?>" data-empname="<?php echo $empaccesses['emp_name'] ;?>" data-empmobile="<?php echo $empaccesses['emp_mobile']; ?>" data-empemail="<?php echo $empaccesses['emp_email']; ?>" data-empgrade="<?php echo $empaccesses['emp_grade']; ?>" data-emplocation="<?php echo $empaccesses['emp_location']; ?>" data-empbroad="<?php echo $empaccesses['emp_broad_function']; ?>" data-empjob="<?php echo $empaccesses['emp_job_function']; ?>" href="#" class="popupDynamic" ><i class="fa fa-pencil-square-o"></i></a></td>
                      </tr>

                    <?php $counter ++;} } ?>
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

  <div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Employee App Access</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr"> Employee Id </label>
            <input type="text" maxlength="30" required class="form-control" id="add_empid">
            <div class="invalid-feedback-empid" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Name </label>
            <input type="text" maxlength="30" required class="form-control" id="add_empname">
            <div class="invalid-feedback-empname" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Mobile No. </label>
            <input type="text" minlength="10" maxlength="10" required class="form-control" id="add_empmobile">
            <div class="invalid-feedback-empmobile" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Email </label>
            <input type="text" maxlength="250" required class="form-control" id="add_empemail">
            <div class="invalid-feedback-empemail" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Grade </label>
            <input type="text" maxlength="250" required class="form-control" id="add_empgrade">
            <div class="invalid-feedback-empgrade" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Location </label>
            <input type="text" maxlength="250" required class="form-control" id="add_emplocation">
            <div class="invalid-feedback-emplocation" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Broad Function </label>
            <input type="text" maxlength="250" required class="form-control" id="add_empbroad">
            <div class="invalid-feedback-empbroad" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Job Function </label>
            <input type="text" maxlength="250" required class="form-control" id="add_empjob">
            <div class="invalid-feedback-empjob" style="color:red;"></div>
          </div>
          <div class="form-group">
            <input type="hidden" maxlength="10" required class="form-control" id="add_id_x">
            <div class="invalid-feedback" style="color:red;"></div>
          </div>
          <div class="form-group">
            <button type="button" id="submit_addform" class="btn btn-primary">Save</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Employee App Access</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr"> Employee Id </label>
            <input type="text" maxlength="30" disabled required class="form-control" id="empid">
          </div>
          <div class="form-group">
            <label for="usr"> Employee Name </label>
            <input type="text" maxlength="30" required class="form-control" id="empname">
            <div class="invalid-feedback-empname" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Mobile No. </label>
            <input type="text" minlength="10" maxlength="10" required class="form-control" id="empmobile">
            <div class="invalid-feedback-empmobile" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Email </label>
            <input type="text" maxlength="50" required class="form-control" id="empemail">
            <div class="invalid-feedback-empemail" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Grade </label>
            <input type="text" maxlength="50" required class="form-control" id="empgrade">
            <div class="invalid-feedback-empgrade" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Location </label>
            <input type="text" maxlength="50" required class="form-control" id="emplocation">
            <div class="invalid-feedback-emplocation" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Broad Function </label>
            <input type="text" maxlength="50" required class="form-control" id="empbroad">
            <div class="invalid-feedback-empbroad" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Employee Job Function </label>
            <input type="text" maxlength="50" required class="form-control" id="empjob">
            <div class="invalid-feedback-empjob" style="color:red;"></div>
          </div>
          <div class="form-group">
            <input type="hidden" maxlength="10" required class="form-control" id="id_x">
            <div class="invalid-feedback" style="color:red;"></div>
          </div>
          <div class="form-group">
            <button type="button" id="submit_form" class="btn btn-primary">Save</button>
            <button type="button" id="delete_form" class="btn btn-primary">Delete</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <style type="text/css">
    .dt-buttons {
      display: none;
    }
  </style>

  <script type="text/javascript">
    $(".addModal").click(function(){
      $("#addModal").modal('show');
    });
    $(".popupDynamic").click(function(){
      //var plant_code = $(this).data('val');
      var id_x   = $(this).data('id');
      var empname = $(this).data('empname');
      var empmobile = $(this).data('empmobile');
      var empemail = $(this).data('empemail');
      var empgrade = $(this).data('empgrade');
      var emplocation = $(this).data('emplocation');
      var empbroad = $(this).data('empbroad');
      var empjob = $(this).data('empjob');
      var empid = $(this).data('empid');
      if(empmobile == ''){
        $('#delete_form').hide();
      }else{
        $('#delete_form').show();
      }

      $('#id_x').val(id_x);

      $('#empid').val($('#empid-'+id_x).text());
      $('#empname').val($('#empn-'+id_x).text());
      $('#empmobile').val($('#empm-'+id_x).text());
      $('#empemail').val($('#empe-'+id_x).text());
      $('#empgrade').val($('#empg-'+id_x).text());
      $('#emplocation').val($('#empl-'+id_x).text());
      $('#empbroad').val($('#empb-'+id_x).text());
      $('#empjob').val($('#empj-'+id_x).text());
      $("#myModal").modal('show');
    });     
    
    $(document).ready(function(){
      $("#submit_addform").click(function(){
        var empid = $('#add_empid').val();
        var empname = $('#add_empname').val();
        var empmobile = $('#add_empmobile').val();
        var empemail = $('#add_empemail').val();
        var empgrade = $('#add_empgrade').val();
        var emplocation = $('#add_emplocation').val();
        var empbroad = $('#add_empbroad').val();
        var empjob = $('#add_empjob').val();
        if (empid == '') {
          $('.invalid-feedback-empid').fadeIn();
          $('#add_empid').focus();
          $('.invalid-feedback-empid').text('Please enter employee id');
        }
        else{
          $('.invalid-feedback-empid').hide();
        }

        if (empname == '') {
          $('.invalid-feedback-empname').fadeIn();
          $('#add_empname').focus();
          $('.invalid-feedback-empname').text('Please enter employee name');
        }
        else if(!(empname.match(/^[a-zA-Z ]*$/)) && empname !=''){
          $('.invalid-feedback-empname').fadeIn();
          $('#add_empname').focus();
          $('.invalid-feedback-empname').text('Only alphabets and space is allowed.');
          return false;
        }
        else{
          $('.invalid-feedback-empname').hide();
        }

        if (empmobile == '') {
          $('.invalid-feedback-empmobile').fadeIn();
          $('#add_empmobile').focus();
          $('.invalid-feedback-empmobile').text('Please enter employee mobile no.');
        }
        else if(empmobile.length < 10){
          $('.invalid-feedback-empmobile').fadeIn();
          $('#add_empmobile').focus();
          $('.invalid-feedback-empmobile').text('Please enter 10-digit mobile no.');
        }
        else{
          $('.invalid-feedback-empmobile').hide();
        }

        if (empemail == '') {
          $('.invalid-feedback-empemail').fadeIn();
          $('#add_empemail').focus();
          $('.invalid-feedback-empemail').text('Please enter employee emailid');
        }
        else{
          $('.invalid-feedback-empemail').hide();
        }

        if (empgrade == '') {
          $('.invalid-feedback-empgrade').fadeIn();
          $('#add_empgrade').focus();
          $('.invalid-feedback-empgrade').text('Please enter employee grade');
        }
        else{
          $('.invalid-feedback-empgrade').hide();
        }

        if (emplocation == '') {
          $('.invalid-feedback-emplocation').fadeIn();
          $('#add_emplocation').focus();
          $('.invalid-feedback-emplocation').text('Please enter employee location');
        }
        else{
          $('.invalid-feedback-emplocation').hide();
        }

        if (empbroad == '') {
          $('.invalid-feedback-empbroad').fadeIn();
          $('#add_empbroad').focus();
          $('.invalid-feedback-empbroad').text('Please enter employee broad function');
        }
        else{
          $('.invalid-feedback-empbroad').hide();
        }

        if (empjob == '') {
          $('.invalid-feedback-empjob').fadeIn();
          $('#add_empjob').focus();
          $('.invalid-feedback-empjob').text('Please enter employee job function');
        }
        else{
          $('.invalid-feedback-empjob').hide();
        }

        if((empid != '') && (empname != '') && (empmobile != '') && (empemail != '') && (empgrade != '') && (emplocation != '') && (empbroad != '') && (empjob != '')){
          var data = {
            empid: empid,
            empname: empname,
            empmobile: empmobile,
            empemail: empemail,
            empgrade: empgrade,
            emplocation: emplocation,
            empbroad: empbroad,
            empjob: empjob
          };

          $.ajax({
            url: '<?php echo base_url(); ?>/admin/empaccess/edit_empaccess', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#addModal').modal('toggle');
            toastr["info"]("", "success : Employee App Access Data is Added Successfully.")
            console.log(response);
            },
            error: function(xhr, status, error) {
            // Request failed, handle the error
            toastr["error"]("", "Failure : Something went wrong.")
            console.error(error);
            }
          });
          $(document).ajaxStop(function(){
            setTimeout(function(){// wait for 1 secs(2)
                window.location.reload(); // then reload the page.(3)
            }, 1000); 
          });
        }  
      });

      $("#submit_form").click(function(){
        $('.invalid-feedback').hide();
        var empid = $('#empid').val();
        var empname = $('#empname').val();
        var empmobile = $('#empmobile').val();
        var empemail = $('#empemail').val();
        var empgrade = $('#empgrade').val();
        var emplocation = $('#emplocation').val();
        var empbroad = $('#empbroad').val();
        var empjob = $('#empjob').val();
        var id_x = $('#id_x').val();

        if (empname == '') {
          $('.invalid-feedback-empname').fadeIn();
          $('#empname').focus();
          $('.invalid-feedback-empname').text('Please enter employee name');
        }
        else if(!(empname.match(/^[a-zA-Z ]*$/)) && empname !=''){
          $('.invalid-feedback-empname').fadeIn();
          $('#empname').focus();
          $('.invalid-feedback-empname').text('Only alphabets and space is allowed.');
          return false;
        }
        else{
          $('.invalid-feedback-empname').hide();
        }

        if (empmobile == '') {
          $('.invalid-feedback-empmobile').fadeIn();
          $('#empmobile').focus();
          $('.invalid-feedback-empmobile').text('Please enter employee mobile no.');
        }
        else if(empmobile !='' && empmobile.length < 10){
          $('.invalid-feedback-empmobile').fadeIn();
          $('#empmobile').focus();
          $('.invalid-feedback-empmobile').text('Please enter 10-digit mobile no.');
        }
        else{
          $('.invalid-feedback-empmobile').hide();
        }

        if (empemail == '') {
          $('.invalid-feedback-empemail').fadeIn();
          $('#empemail').focus();
          $('.invalid-feedback-empemail').text('Please enter employee emailid');
        }
        else{
          $('.invalid-feedback-empemail').hide();
        }

        if (empgrade == '') {
          $('.invalid-feedback-empgrade').fadeIn();
          $('#empgrade').focus();
          $('.invalid-feedback-empgrade').text('Please enter employee grade');
        }
        else{
          $('.invalid-feedback-empgrade').hide();
        }

        if (emplocation == '') {
          $('.invalid-feedback-emplocation').fadeIn();
          $('#emplocation').focus();
          $('.invalid-feedback-emplocation').text('Please enter employee location');
        }
        else{
          $('.invalid-feedback-emplocation').hide();
        }

        if (empbroad == '') {
          $('.invalid-feedback-empbroad').fadeIn();
          $('#empbroad').focus();
          $('.invalid-feedback-empbroad').text('Please enter employee broad function');
        }
        else{
          $('.invalid-feedback-empbroad').hide();
        }

        if (empjob == '') {
          $('.invalid-feedback-empjob').fadeIn();
          $('#empjob').focus();
          $('.invalid-feedback-empjob').text('Please enter employee job function');
        }
        else{
          $('.invalid-feedback-empjob').hide();
        }

        if((empname != '') && (empmobile != '') && (empemail != '') && (empgrade != '') && (emplocation != '') && (empbroad != '') && (empjob != '')){
          var data = {
            empid: empid,
            empname: empname,
            empmobile: empmobile,
            id_x: id_x,
            empemail: empemail,
            empgrade: empgrade,
            emplocation: emplocation,
            empbroad: empbroad,
            empjob: empjob
          };

          $.ajax({
            url: '<?php echo base_url(); ?>/admin/empaccess/edit_empaccess', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#empn-'+id_x).text(empname);
            $('#empm-'+id_x).text(empmobile);
            $('#empe-'+id_x).text(empemail);
            $('#empg-'+id_x).text(empgrade);
            $('#empl-'+id_x).text(emplocation);
            $('#empb-'+id_x).text(empbroad);
            $('#empj-'+id_x).text(empjob);
            $('#empc-'+id_x).text(response['data']);
            $('#myModal').modal('toggle');
            
            toastr["info"]("", "success : Employee App Access Data Updated.")
            console.log(response);
            },
            error: function(xhr, status, error) {
            // Request failed, handle the error
            toastr["error"]("", "Failure : Something went wrong.")
            console.error(error);
            }
          });
          $(document).ajaxStop(function(){
            setTimeout(function(){// wait for 1 secs(2)
                window.location.reload(); // then reload the page.(3)
            }, 1000); 
          });
        }
      });
      
      $("#delete_form").click(function(){
        $('.invalid-feedback').hide();
        var empid = $('#empid').val();
        var empname = $('#empname').val();
        var empmobile = $('#empmobile').val();
        var id_x = $('#id_x').val();
        var data = {empid: empid,empname: empname,id_x: id_x,empmobile: empmobile};

        $.ajax({
          url: '<?php echo base_url(); ?>/admin/empaccess/delete_empaccess', // Replace with your API endpoint
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function(response) {
          // Request successful, do something with the response
          $('#myModal').modal('toggle');
          
          toastr["info"]("", "success : 1 Employee Access Data is Deleted.")
          console.log(response);
          },
          error: function(xhr, status, error) {
          // Request failed, handle the error
          toastr["error"]("", "Failure : Something went wrong.")
          console.error(error);
          }
        });
        $(document).ajaxStop(function(){
          setTimeout(function(){// wait for 1 secs(2)
              window.location.reload(); // then reload the page.(3)
          }, 1000);
        });
      });
    })
  </script>

  <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/toastr.min.js" type="text/javascript"></script>