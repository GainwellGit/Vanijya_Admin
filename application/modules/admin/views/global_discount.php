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
            <span>Global Discounts List</span>
          </li>
        </ul>
      </div>
      <div class="content">
        <div class="row" style="margin-bottom:20px; ">
          <div class="col-xs-12">
            <div class="form-group pull-right">
              <div class="col-xs-2">
                <a href="#" class="nav-link "> <button type="submit" class="btn btn-primary addbtnsub btn_show addModal" id="btn_click" name="btn_save">Create Global Discount</button></a>
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
                <div class="caption"><i class="fa fa-globe"></i>Global Discounts List</div>
                <div class="tools1"> </div>
              </div>
              <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr>
                      <th> Sl. No. </th>
                      <th> Discount Type </th>
                      <th> Discount Value </th>
                      <th> Minimum Amount </th>
                      <th> From Date </th>
                      <th> To Date </th>
                      <th> Discount On </th>
                      <th> Status </th>
                      <th> Created At </th>
                      <th> Updated At </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($globaldiscount)){
                      $counter = 1; 
                      foreach( $globaldiscount as $globaldiscounts){ ?>
                      <tr>
                      <td><span><?php echo $counter ;?></span></td>
                      <td><span id="dist-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['discount_type']) ? $globaldiscounts['discount_type'] : ''; ?></span></td>
                      <td><span id="disv-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['discount_value']) ? $globaldiscounts['discount_value'] : ''; ?></span></td>
                      <td><span id="disa-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['min_ammount']) ? $globaldiscounts['min_ammount'] : ''; ?></span></td>
                      <td><span id="disf-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['from_date']) ? $globaldiscounts['from_date'] : ''; ?></span></td>
                      <td><span id="disto-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['to_date']) ? $globaldiscounts['to_date'] : ''; ?></span></td>
                      <td><span id="diso-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['discount_on']) ? $globaldiscounts['discount_on'] : ''; ?></span></td>
                      <td><span id="diss-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['status']) ? $globaldiscounts['status'] : ''; ?></span></td>
                      <td><span id="disc-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['created_at']) ? $globaldiscounts['created_at'] : ''; ?></span></td>
                      <td><span id="disu-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['updated_at']) ? $globaldiscounts['updated_at'] : ''; ?></span></td>
                      <td><a data-id="<?php echo $globaldiscounts['id']; ?>" data-disid="<?php echo $globaldiscounts['id'] ;?>" data-distype="<?php echo $globaldiscounts['discount_type'] ;?>" data-disval="<?php echo $globaldiscounts['discount_value']; ?>" data-dismina="<?php echo $globaldiscounts['min_ammount']; ?>" data-disfrom="<?php echo $globaldiscounts['from_date']; ?>" data-disto="<?php echo $globaldiscounts['to_date']; ?>" data-dison="<?php echo $globaldiscounts['discount_on']; ?>" data-disstatus="<?php echo $globaldiscounts['status']; ?>" href="#" class="popupDynamic" ><i class="fa fa-pencil-square-o"></i></a></td>
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
          <h4 class="modal-title">Create Global Discount</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr"> Discount Type </label>
            <select class="form-control" name="discount_type" required class="form-control" id="add_distype">
                <option value="">Select</option>
                <option value="PERCENT">PERCENT</option>
                <option value="AMOUNT">AMOUNT</option>
            </select>
            <div class="invalid-feedback-distype" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Discount Value </label>
            <input type="text" maxlength="30" required class="form-control" id="add_disval" name="dis_val">
            <div class="invalid-feedback-disval" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Minimum Amount </label>
            <input type="text" minlength="10" maxlength="10" required class="form-control" id="add_dismina" name="min_amt">
            <div class="invalid-feedback-dismina" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> From date </label>
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
                <input type="text" class="form-control" name="valid_from" required onkeypress="return false;" id="add_disfrom">
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
            <div class="invalid-feedback-disfrom" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> To Date </label>
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
                <input type="text" class="form-control" name="valid_to" required onkeypress="return false;" id="add_disto">
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
            <div class="invalid-feedback-disto" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Discount On </label>
            <select class="form-control" name="discount_on" onChange="getMaterials(this.value);" required class="form-control" id="add_dison">
                <option value="">Select</option>
                <option value="ALL">ALL</option>
                <option value="MATERIAL">MATERIAL</option>
            </select>
            <div class="invalid-feedback-dison" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_mat_sec">
            <label for="usr"> Materials </label>
            <select class="form-control" name="material_no" id="add_mat" multiple>
              <option value="">Select</option>
              <?php
              if (!empty($allmaterials)) {
                foreach ($allmaterials as $key => $val) { ?>
                  <option value="<?php echo $val['material_no'];?>"><?php echo $val['material_description'];?></option>
              <?php }} ?>
            </select>
            <div class="invalid-feedback-dismat" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Status </label>
            <select class="form-control" name="discount_status" required class="form-control" id="add_disstatus">
                <option value="">Select</option>
                <option value="A">ACTIVE</option>
                <option value="I">INACTIVE</option>
            </select>
            <div class="invalid-feedback-disstatus" style="color:red;"></div>
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
          <h4 class="modal-title">Update Global Discount</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr"> Discount Type </label>
            <input type="text" maxlength="30" required class="form-control" id="distype" disabled>
          </div>
          <div class="form-group">
            <label for="usr"> Discount Value </label>
            <input type="text" minlength="10" maxlength="10" required class="form-control" id="disval" disabled>
          </div>
          <div class="form-group">
            <label for="usr"> Minimum Amount </label>
            <input type="text" maxlength="50" required class="form-control" id="dismina" disabled>
          </div>
          <div class="form-group">
            <label for="usr"> From Date </label>
            <input type="text" maxlength="50" required class="form-control" id="disfrom" disabled>
          </div>
          <div class="form-group">
            <label for="usr"> To Date </label>
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
              <input type="text" class="form-control" name="valid_to" required onkeypress="return false;" id="disto">
              <span class="input-group-btn">
                <button class="btn default" type="button">
                  <i class="fa fa-calendar"></i>
                </button>
              </span>
            </div>
            <div class="invalid-feedback-edisto" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="usr"> Discount On </label>
            <input type="text" maxlength="50" required class="form-control" id="dison" disabled>
          </div>
          <div class="form-group" id="display_list">
            
          </div>
          <div class="form-group">
            <label for="usr"> Status </label>
            <select class="form-control" name="discount_status" required class="form-control" id="disstatus">
              <option value="">Select</option>
              <option value="A">ACTIVE</option>
              <option value="I">INACTIVE</option>
            </select>
            <div class="invalid-feedback-edisstatus" style="color:red;"></div>
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
      $('#add_mat_sec').hide();
    });

    $(".popupDynamic").click(function(){
      var id_x      = $(this).data('id');
      var distype   = $(this).data('distype');
      var disval    = $(this).data('disval');
      var dismina   = $(this).data('dismina');
      var disfrom   = $(this).data('disfrom');
      var disto     = $(this).data('disto');
      var dison     = $(this).data('dison');
      var disstatus = $(this).data('disstatus');
      var disid     = $(this).data('disid');
      if(disval == ''){
        $('#delete_form').hide();
      }else{
        $('#delete_form').show();
      }

      if(dison == 'MATERIAL'){
        $('#add_mat_sec').show();

        $.ajax({
          type: "POST",
          url: '<?php echo base_url(); ?>/admin/discount/get_materials',
          data:'dis_id='+id_x,
          success: function(response){//console.log(response);
            /* var html ='<label for="usr"> Materials </label><select class="form-control" name="material_no" id="add_mat" multiple diabled>';
            $.each(response,function (index, room) {
              html+='<option value="'+room.material_no+'">'+room.material_description+'</option>';
            });
            html+='</select>';console.log(html);
            $("#display_list").html(html); */
          }
        });
      }else{
        $('#add_mat_sec').hide();
      }

      $('#id_x').val(id_x);

      $('#disid').val(id_x);
      $('#distype').val($('#dist-'+id_x).text());
      $('#disval').val($('#disv-'+id_x).text());
      $('#dismina').val($('#disa-'+id_x).text());
      $('#disfrom').val($('#disf-'+id_x).text());
      $('#disto').val($('#disto-'+id_x).text());
      $('#dison').val($('#diso-'+id_x).text());
      $('#disstatus').val($('#diss-'+id_x).text());
      $("#myModal").modal('show');
    }); 
    
    function getMaterials(val) {
      if(val == 'MATERIAL'){
        $('#add_mat_sec').show();
      }else{
        $('#add_mat_sec').hide();
      }
    }
    
    $(document).ready(function(){
      $("#submit_addform").click(function(){
        var distype = $('#add_distype').val();
        var disval = $('#add_disval').val();
        var dismina = $('#add_dismina').val();
        var disfrom = $('#add_disfrom').val();
        var disto = $('#add_disto').val();
        var dison = $('#add_dison').val();
        var dismat = $('#add_mat').val();
        var disstatus = $('#add_disstatus').val();

        if (distype == '') {
          $('.invalid-feedback-distype').fadeIn();
          $('#add_distype').focus();
          $('.invalid-feedback-distype').text('Please select discount type');
        }
        else{
          $('.invalid-feedback-distype').hide();
        }

        if (disval == '') {
          $('.invalid-feedback-disval').fadeIn();
          $('#add_disval').focus();
          $('.invalid-feedback-disval').text('Please enter discount value');
        }
        else{
          $('.invalid-feedback-disval').hide();
        }

        if (dismina == '') {
          $('.invalid-feedback-dismina').fadeIn();
          $('#add_dismina').focus();
          $('.invalid-feedback-dismina').text('Please enter minimum amount');
        }
        else{
          $('.invalid-feedback-dismina').hide();
        }

        if (disfrom == '') {
          $('.invalid-feedback-disfrom').fadeIn();
          $('#add_disfrom').focus();
          $('.invalid-feedback-disfrom').text('Please select from date');
        }
        else{
          $('.invalid-feedback-disfrom').hide();
        }

        if (disto == '') {
          $('.invalid-feedback-disto').fadeIn();
          $('#add_disto').focus();
          $('.invalid-feedback-disto').text('Please select to date');
        }
        else{
          $('.invalid-feedback-disto').hide();
        }

        if (dison == '') {
          $('.invalid-feedback-dison').fadeIn();
          $('#add_dison').focus();
          $('.invalid-feedback-dison').text('Please select discount on option');
        }
        else{
          $('.invalid-feedback-dison').hide();
        }

        if(dison == 'MATERIAL' && dismat==null){
          $('.invalid-feedback-dismat').fadeIn();
          $('#add_dismat').focus();
          $('.invalid-feedback-dismat').text('Please select atleast one material');
        }
        else{
          $('.invalid-feedback-dismat').hide();
        }

        if (disstatus == '') {
          $('.invalid-feedback-disstatus').fadeIn();
          $('#add_disstatus').focus();
          $('.invalid-feedback-disstatus').text('Please select status');
        }
        else{
          $('.invalid-feedback-disstatus').hide();
        }

        if((distype != '') && (disval != '') && (dismina != '') && (disfrom != '') && (disto != '') && (dison != '') && (disstatus != '')){
          var data = {
            distype: distype,
            disval: disval,
            dismina: dismina,
            disfrom: disfrom,
            disto: disto,
            dison: dison,
            dismat: dismat,
            disstatus: disstatus
          };

          $.ajax({
            url: '<?php echo base_url(); ?>/admin/discount/edit_globaldiscount', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#addModal').modal('toggle');
            toastr["info"]("", "success : One Global Discount Data is Added Successfully.")
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
        var disid = $('#disid').val();
        var distype = $('#distype').val();
        var disval = $('#disval').val();
        var dismina = $('#dismina').val();
        var disfrom = $('#disfrom').val();
        var disto = $('#disto').val();
        var dison = $('#dison').val();
        var disstatus = $('#disstatus').val();
        var id_x = $('#id_x').val();

        if (distype == '') {
          $('.invalid-feedback-distype').fadeIn();
          $('#distype').focus();
          $('.invalid-feedback-distype').text('Please select discount type');
        }
        else{
          $('.invalid-feedback-distype').hide();
        }

        if (disval == '') {
          $('.invalid-feedback-disval').fadeIn();
          $('#disval').focus();
          $('.invalid-feedback-disval').text('Please enter discount value');
        }
        else{
          $('.invalid-feedback-disval').hide();
        }

        if (dismina == '') {
          $('.invalid-feedback-dismina').fadeIn();
          $('#dismina').focus();
          $('.invalid-feedback-dismina').text('Please enter minimum amount');
        }
        else{
          $('.invalid-feedback-dismina').hide();
        }

        if (disfrom == '') {
          $('.invalid-feedback-disfrom').fadeIn();
          $('#disfrom').focus();
          $('.invalid-feedback-disfrom').text('Please select from date');
        }
        else{
          $('.invalid-feedback-disfrom').hide();
        }

        if (disto == '') {
          $('.invalid-feedback-edisto').fadeIn();
          $('#disto').focus();
          $('.invalid-feedback-edisto').text('Please select to date');
        }
        else{
          $('.invalid-feedback-edisto').hide();
        }

        if (dison == '') {
          $('.invalid-feedback-dison').fadeIn();
          $('#dison').focus();
          $('.invalid-feedback-dison').text('Please select discount on option');
        }
        else{
          $('.invalid-feedback-dison').hide();
        }

        if (disstatus == '') {
          $('.invalid-feedback-edisstatus').fadeIn();
          $('#disstatus').focus();
          $('.invalid-feedback-edisstatus').text('Please select status');
        }
        else{
          $('.invalid-feedback-edisstatus').hide();
        }

        if((distype != '') && (disval != '') && (dismina != '') && (disfrom != '') && (disto != '') && (dison != '') && (disstatus != '')){
          var data = {
            distype: distype,
            disval: disval,
            id_x: id_x,
            dismina: dismina,
            disfrom: disfrom,
            disto: disto,
            dison: dison,
            disstatus: disstatus
          };

          $.ajax({
            url: '<?php echo base_url(); ?>/admin/discount/edit_globaldiscount', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#disv-'+id_x).text(distype);
            $('#disa-'+id_x).text(disval);
            $('#disf-'+id_x).text(dismina);
            $('#disto-'+id_x).text(disfrom);
            $('#diso-'+id_x).text(disto);
            $('#diss-'+id_x).text(dison);
            $('#disc-'+id_x).text(disstatus);
            $('#disu-'+id_x).text(response['data']);
            $('#myModal').modal('toggle');
            
            toastr["info"]("", "success : One Global Discount Data is Updated Successfully.")
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
        var disid     = $('#id_x').val();
        var distype   = $('#distype').val();
        var disval    = $('#disval').val();
        var dismina   = $('#dismina').val();
        var disfrom   = $('#disfrom').val();
        var disto     = $('#disto').val();
        var dison     = $('#dison').val();
        var disstatus = $('#disstatus').val();

        var data = {disid: disid, distype: distype, disval: disval, dismina: dismina, disfrom: disfrom, disto: disto, dison: dison, disstatus: disstatus};

        $.ajax({
          url: '<?php echo base_url(); ?>/admin/discount/delete_globaldiscount', // Replace with your API endpoint
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function(response) {
          // Request successful, do something with the response
          $('#myModal').modal('toggle');
          
          toastr["info"]("", "success : One Global Discount Data is Deleted.")
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
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/group.js"></script>
<script src="<?php echo base_url(); ?>assets/js/toastr.min.js" type="text/javascript"></script>