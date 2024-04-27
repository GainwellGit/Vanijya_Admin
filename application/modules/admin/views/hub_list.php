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
            <span>Hub List</span>
          </li>
        </ul>
      </div>
      <div class="content">
        <div class="row" style="margin-bottom:20px; ">
          <div class="col-xs-12">
            <div class="form-group pull-right">
              <div class="col-xs-2">
                <a href="#" class="nav-link "> <button type="submit" class="btn btn-primary addbtnsub btn_show addModal" id="btn_click" name="btn_save">Create Hub</button></a>
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
                <div class="caption"><i class="fa fa-globe"></i>Hub Master List</div>
                <div class="tools1"> </div>
              </div>
              <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr>
                      <th> ID </th>
                      <th> Hub Code </th>
                      <th> Hub Name </th>
                      <th> Hub Address </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($hubs)){
                      $counter = 1; 
                      foreach( $hubs as $hub){ ?>
                      <tr>
                      <td><span><?php echo $counter ;?></span></td>
                      <td><span id="hubc-<?php echo $hub['id']; ?>"><?php echo isset($hub['hub_code']) ? $hub['hub_code'] : ''; ?></span></td>
                      <td><span id="hubn-<?php echo $hub['id']; ?>"><?php echo isset($hub['hub_name']) ? $hub['hub_name'] : ''; ?></span></td>
                      <td><span id="huba-<?php echo $hub['id']; ?>"><?php echo isset($hub['hub_address']) ? $hub['hub_address'] : ''; ?></span></td>
                      <td><a data-id="<?php echo $hub['id'] ;?>" data-hubcode="<?php echo $hub['hub_code'] ;?>" data-hubname="<?php echo $hub['hub_name'] ;?>" data-hubadd="<?php echo $hub['hub_address']; ?>" href="#" class="popupDynamic" ><i class="fa fa-pencil-square-o"></i></a></td>
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
          <h4 class="modal-title">Create Hub</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr"> Hub Code </label>
            <input type="text" maxlength="11" required class="form-control" id="add_hubcode">
            <div class="invalid-feedback-hubcode" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Hub Name </label>
            <input type="text" maxlength="250" required class="form-control" id="add_hubname">
            <div class="invalid-feedback-hubname" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Hub Address </label>
            <input type="text" maxlength="250" required class="form-control" id="add_hubaddress">
            <div class="invalid-feedback-hubaddress" style="color:red;"></div>
          </div>
          <div class="form-group">
            <input type="hidden" maxlength="11" required class="form-control" id="add_id_x">
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
          <h4 class="modal-title">Update Hub</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr"> Hub Code </label>
            <input type="text" maxlength="11" disabled required class="form-control" id="hubcode">
          </div>
          <div class="form-group">
            <label for="usr"> Hub Name </label>
            <input type="text" maxlength="250" disabled required class="form-control" id="hubname">
          </div>
          <div class="form-group">
            <label for="usr"> Hub Address </label>
            <input type="text" maxlength="250" required class="form-control" id="hubaddress">
          </div>
          <div class="form-group">
            <input type="hidden" maxlength="11" required class="form-control" id="id_x">
            <div class="invalid-feedback" style="color:red;"></div>
          </div>
          <div class="form-group">
            <button type="button" id="submit_form" class="btn btn-primary">Save</button>
            <!--<button type="button" id="delete_form" class="btn btn-primary">Delete</button>-->
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
      var id_x   = $(this).data('id');
      var hubname = $(this).data('hubname');
      var hubadd = $(this).data('hubadd');
      var hubcode = $(this).data('hubcode');
      /* if(empmobile == ''){
        $('#delete_form').hide();
      }else{
        $('#delete_form').show();
      } */

      $('#id_x').val(id_x);

      $('#hubcode').val($('#hubc-'+id_x).text());
      $('#hubname').val($('#hubn-'+id_x).text());
      $('#hubaddress').val($('#huba-'+id_x).text());
      $("#myModal").modal('show');
    });     
    
    $(document).ready(function(){
      $("#submit_addform").click(function(){
        var hubcode = $('#add_hubcode').val();
        var hubname = $('#add_hubname').val();
        var hubaddress = $('#add_hubaddress').val();
        if (hubcode == '') {
          $('.invalid-feedback-hubcode').fadeIn();
          $('#add_hubcode').focus();
          $('.invalid-feedback-hubcode').text('Please enter hub code');
        }
        else{
          $('.invalid-feedback-hubcode').hide();
        }

        if (hubname == '') {
          $('.invalid-feedback-hubname').fadeIn();
          $('#add_hubname').focus();
          $('.invalid-feedback-hubname').text('Please enter hub name');
        }
        else if(!(hubname.match(/^[a-zA-Z ]*$/)) && hubname !=''){
          $('.invalid-feedback-hubname').fadeIn();
          $('#add_hubname').focus();
          $('.invalid-feedback-hubname').text('Only alphabets and space is allowed.');
          return false;
        }
        else{
          $('.invalid-feedback-hubname').hide();
        }

        if (hubaddress == '') {
          $('.invalid-feedback-hubaddress').fadeIn();
          $('#add_hubaddress').focus();
          $('.invalid-feedback-hubaddress').text('Please enter hub address');
        }
        else{
          $('.invalid-feedback-hubaddress').hide();
        }

        if((hubcode != '') && (hubname != '') && (hubaddress != '')){
          var data = {
            hubcode: hubcode,
            hubname: hubname,
            hubaddress: hubaddress
          };

          $.ajax({
            url: '<?php echo base_url(); ?>/admin/hub/edit_hub', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#addModal').modal('toggle');
            toastr["info"]("", "success : Hub Data is Added Successfully.")
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
        var hubcode = $('#hubcode').val();
        var hubname = $('#hubname').val();
        var hubaddress = $('#hubaddress').val();
        var id_x = $('#id_x').val();

        if (hubaddress == '') {
          $('.invalid-feedback').fadeIn();
          $('#hubaddress').focus();
          $('.invalid-feedback').text('Please enter address');
          return false;
        }
        else{
          $('.invalid-feedback').hide();

          var data = {
            hubcode: hubcode,
            hubname: hubname,
            hubaddress: hubaddress,
            id_x: id_x
          };

          $.ajax({
            url: '<?php echo base_url(); ?>/admin/hub/edit_hub', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#huba-'+id_x).text(hubaddress);
            $('#empc-'+id_x).text(response['data']);
            $('#myModal').modal('toggle');
            
            toastr["info"]("", "success : Hub Data Updated.")
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