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
                      <th> Discount Percentage </th>
                      <th> Minimum Amount </th>
                      <th> From Date </th>
                      <th> To Date &nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th> Discount On </th>
                      <th> Material Group </th>
                      <th> Status </th>
                      <th> Created At </th>
                      <th> Updated At </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($globaldiscount)){
                      $counter = 1; 
                      foreach( $globaldiscount as $globaldiscounts){
                        $material_all = (isset($globaldiscounts['all_select']) && $globaldiscounts['all_select'] == 1) ? ' (ALL)' : '';
                    ?>
                      <tr>
                      <td><span><?php echo $counter ;?></span></td>
                      <td><span id="dist-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['discount_type']) ? $globaldiscounts['discount_type'] : ''; ?></span></td>
                      <td><span id="disv-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['discount_value']) ? $globaldiscounts['discount_value'] : ''; ?></span></td>
                      <td><span id="disa-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['min_ammount']) ? $globaldiscounts['min_ammount'] : ''; ?></span></td>
                      <td><span id="disf-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['from_date']) ? date('d-m-Y', strtotime($globaldiscounts['from_date'])) : ''; ?></span></td>
                      <td><span id="disto-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['to_date']) ? date('d-m-Y', strtotime($globaldiscounts['to_date'])) : ''; ?></span></td>
                      <td><span id="diso-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['discount_on']) ? $globaldiscounts['discount_on'] . $material_all : ''; ?></span></td>
                      <td><span id="dis-mat-grp-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['group_code']) ? $globaldiscounts['group_description'] . ' (' . $globaldiscounts['group_code'] . ')' : ''; ?></span></td>
                      <td>
                        <span id="diss-<?php echo $globaldiscounts['id']; ?>">
                        <?php if($globaldiscounts['status']=='A'){ ?>
                        <label class="switch" data-id="<?php echo $globaldiscounts['id'] ?>">
                          <input type="checkbox" <?php echo ($globaldiscounts['status']=='A') ? 'checked' :'disabled' ?> name="change_status_<?php echo $globaldiscounts['id'] ?>">
                          <span class="slider round"></span>
                        </label>
                        <?php }else{ echo 'Inactive'; } ?>
                        </span>
                      </td>
                      <td><span id="disc-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['created_at']) ? date('d-m-Y', strtotime($globaldiscounts['created_at'])) : ''; ?></span></td>
                      <td><span id="disu-<?php echo $globaldiscounts['id']; ?>"><?php echo isset($globaldiscounts['updated_at']) ? date('d-m-Y', strtotime($globaldiscounts['updated_at'])) : ''; ?></span></td>
                      <td><?php if($globaldiscounts['status']!='A'){ ?>
                        <a data-id="<?php echo $globaldiscounts['id']; ?>" data-disid="<?php echo $globaldiscounts['id'] ;?>" data-distype="<?php echo $globaldiscounts['discount_type'] ;?>" data-disval="<?php echo $globaldiscounts['discount_value']; ?>" data-dismina="<?php echo $globaldiscounts['min_ammount']; ?>" data-disfrom="<?php echo $globaldiscounts['from_date']; ?>" data-disto="<?php echo $globaldiscounts['to_date']; ?>" data-dison="<?php echo $globaldiscounts['discount_on']; ?>" data-matgrp="<?php echo $globaldiscounts['material_group_code']; ?>" data-allselect="<?php echo $globaldiscounts['all_select']; ?>" data-disstatus="<?php echo $globaldiscounts['status']; ?>" href="#" class="popupDynamic" ><i class="fa fa-clone"></i></a>
                        <?php } ?>
                      </td>
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
            <label for="add_distype"> Discount Type </label>
            <input type="text" class="form-control" id="add_distype" name="discount_type" value="PERCENT" disabled>
            <div class="invalid-feedback-distype" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="add_disval"> Discount Percentage </label>
            <input type="number" min="0" required class="form-control" id="add_disval" name="dis_val">
            <div class="invalid-feedback-disval" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="add_dismina"> Minimum Amount </label>
            <input type="number" min="0" required class="form-control" id="add_dismina" name="min_amt">
            <div class="invalid-feedback-dismina" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="add_disfrom"> From date </label>
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
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
            <label for="add_disto"> To Date </label>
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
            <label for="add_dison"> Discount On </label>
            <select class="form-control" name="discount_on" onChange="getMaterialGrps(this.value);" required class="form-control" id="add_dison">
                <option value="">Select</option>
                <option value="ALL">ALL</option>
                <option value="MATERIAL">MATERIAL-GROUP</option>
            </select>
            <div class="invalid-feedback-dison" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_mat_grp_sec">
            <label for="add_mat_grp"> Material Groups </label>
            <select class="form-control" name="material_no" id="add_mat_grp" onChange="getMaterials(this.value);">
              <option value="">Select</option>
              <?php
              if (!empty($allmaterialgrps)) {
                foreach ($allmaterialgrps as $key => $val) { ?>
                  <option value="<?php echo $val['group_code'];?>"><?php echo $val['group_description'].' ('.$val['group_code'].')';?></option>
              <?php }} ?>
            </select>
            <div class="invalid-feedback-dismatgrp" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_checkbox_forbulk" style="display:none;">
            <input type="radio" id="allmat" style="margin-right:5px;" name="chose_radio" value="All" />
            <label style="margin-bottom:auto;" for="allmat">All</label>
            <input type="radio" id="selectmat" style="margin-right:5px;margin-left: 13px;" name="chose_radio" value="Choose Material" />
            <label style="margin-bottom:auto;" for="selectmat">Choose Material</label>
            <input type="radio" id="bulkmat" style="margin-right:5px;margin-left: 13px;" name="chose_radio" value="Bulk upload from Excel" />
            <label style="margin-bottom:auto;" for="bulkmat">Bulk upload from Excel</label>

            <div class="invalid-feedback-radiogrp" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_mat_sec" style="display:none;">
          
          </div>
          <div class="form-group" id="add_excel_file" style="display:none;">
            <input type='file' name='file' id='file' required accept=".xls, .xlsx">
            <input type="hidden" class="form-control" id="add_bulk_mats">
            <a href="<?php echo base_url(); ?>admin/discount/download_excel">
              <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                Download Sample Template
              </button>
            </a>  
            <div class="invalid-feedback-excelfile" style="color:red;" style="display:none;"></div>
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
          <h4 class="modal-title">Clone Global Discount</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="distype"> Discount Type </label>
            <input type="text" maxlength="30" required class="form-control" id="distype" disabled>
          </div>
          <div class="form-group">
            <label for="disval"> Discount Percentage </label>
            <input type="number" min="0" required class="form-control" id="disval">
            <div class="invalid-feedback-edisval" style="color:red;display:none;"></div>
          </div>
          <div class="form-group">
            <label for="dismina"> Minimum Amount </label>
            <input type="number" min="0" required class="form-control" id="dismina">
            <div class="invalid-feedback-edismina" style="color:red;display:none;"></div>
          </div>
          <div class="form-group">
            <label for="disfrom"> From Date </label>
            <!--<input type="text" maxlength="50" required class="form-control" id="disfrom">-->
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
              <input type="text" class="form-control" name="valid_from" required onkeypress="return false;" id="disfrom">
              <span class="input-group-btn">
                <button class="btn default" type="button">
                  <i class="fa fa-calendar"></i>
                </button>
              </span>
            </div>
            <div class="invalid-feedback-edisfrom" style="color:red;display:none;"></div>
          </div>
          <div class="form-group">
            <label for="disto"> To Date </label>
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
              <input type="text" class="form-control" name="valid_to" required onkeypress="return false;" id="disto">
              <span class="input-group-btn">
                <button class="btn default" type="button">
                  <i class="fa fa-calendar"></i>
                </button>
              </span>
            </div>
            <div class="invalid-feedback-edisto" style="color:red;display:none;"></div>
          </div>
          <div class="form-group">
            <label for="dison"> Discount On </label>
            <input type="text" maxlength="50" required class="form-control" id="dison" disabled>
          </div>
          <div class="form-group" id="grp_display_list" style="display:none;">
            
          </div>
          <div class="form-group" id="all_select_radio" style="display:none;">
            
          </div>
          <div class="form-group" id="display_list" style="display:none;">
            
          </div>
          <div class="form-group">
            <input type="hidden" maxlength="10" required class="form-control" id="id_x">
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

  <div class="modal left fade" id="location_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Global Discounts</h5>
          <div style="margin-top:6px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div id="dvLoading" style="display: none;"></div>
          <form action="<?php echo base_url('admin/discount/bulk_upload_discount'); ?>" enctype="multipart/form-data" method="post" role="form">
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

  <style type="text/css">
    .dt-buttons {
      display: none;
    }
  </style>

  <script type="text/javascript">
    $(".addModal").click(function(){
      $("#addModal").modal('show');
      $('#add_mat_sec').hide();
      $('#add_mat_grp_sec').hide();
      $('#add_checkbox_forbulk').hide();
      $('#add_excel_file').hide();

      $('.invalid-feedback-distype').text('');
      $('.invalid-feedback-disval').text('');
      $('.invalid-feedback-dismina').text('');
      $('.invalid-feedback-disfrom').text('');
      $('.invalid-feedback-disto').text('');
      $('.invalid-feedback-dison').text('');
      $('.invalid-feedback-disstatus').text('');
      $('.invalid-feedback-dismatgrp').text('');
      $('.invalid-feedback-radiogrp').text('');
      $('.invalid-feedback-dismat').text('');
      $('.invalid-feedback-excelfile').text('');

      //$('#add_distype').val('');
      $('#add_disval').val('');
      $('#add_dismina').val('');
      $('#add_disfrom').val('');
      $('#add_disto').val('');
      $('#add_dison').val('');
      $('#add_disstatus').val('');
      $('#add_mat_grp').val('');
      $('#add_checkbox_forbulk').val('');
      //$('input:radio').not(':checked');
      $('input[name="chose_radio"]:checked').removeAttr('checked');
    });

    $(".popupDynamic").click(function(){
      var id_x      = $(this).data('id');
      var distype   = $(this).data('distype');
      var disval    = $(this).data('disval');
      var dismina   = $(this).data('dismina');
      var disfrom   = $(this).data('disfrom');
      var disto     = $(this).data('disto');
      var dison     = $(this).data('dison');
      var matgrp    = $(this).data('matgrp');
      var allselect = $(this).data('allselect');
      var disstatus = $(this).data('disstatus');
      var disid     = $(this).data('disid');
      if(disval != ''){
        $('.invalid-feedback-edisval').hide();
      }else{
        $('.invalid-feedback-edisval').show();
      }

      if(dismina != ''){
        $('.invalid-feedback-edismina').hide();
      }else{
        $('.invalid-feedback-edismina').show();
      }

      if(disfrom != ''){
        $('.invalid-feedback-edisfrom').hide();
      }else{
        $('.invalid-feedback-edisfrom').show();
      }

      if(disto != ''){
        $('.invalid-feedback-edisto').hide();
      }else{
        $('.invalid-feedback-edisto').show();
      }

      if(dison == 'MATERIAL'){
        var html='', html1='', html2='';
        $.ajax({
          type: "POST",
          url: '<?php echo base_url(); ?>admin/discount/get_materials_by_disid',
          data:'discount_id='+id_x+'&group_code='+matgrp+'&allselect='+allselect,
          dataType: "json",
          success: function(response){
            html1 +='<label for="add_matgrp"> Material Group </label><select class="form-control" id="dismatgrp" name="material_no" disabled>';
            html1+='<option value="'+response[0].group_code+'">'+response[0].group_description+' ('+response[0].group_code+')</option>';
            html1+='</select>';
            $("#grp_display_list").show();
            $("#grp_display_list").html(html1);

            if(response.length > 0 && allselect != 1){
              html +='<label for="add_mat"> Materials </label><select class="form-control" id="dismat" name="material_no" multiple disabled>';
              $.each(response,function (index, val) {
                html+='<option value="'+val.material_no+'" selected>'+val.material_description+' ('+val.material_no+')</option>';
              });
              html+='</select><div class="invalid-feedback-dismat" style="color:red;"></div>';
              $("#display_list").show();
              $("#display_list").html(html);
            } else{
              $("#display_list").hide();
            }

            if (allselect == 1) {
              $("#all_select_radio").show();

              html2 +='<input type="radio" id="disallmat" style="margin-right:5px;" name="chose_radio" value="All" checked disabled /><label style="margin-bottom:auto;" for="allmat">All</label>'
              $("#all_select_radio").html(html2);
            }
            else{
              $("#all_select_radio").hide();
              $("#all_select_radio").html(html2);
            }
          }
        });
      }else{
        $("#grp_display_list").hide();
        $("#display_list").hide();
        $("#all_select_radio").hide();
      }

      if(disstatus != ''){
        $('.invalid-feedback-edisstatus').hide();
      }else{
        $('.invalid-feedback-edisstatus').show();
      }


      $('#id_x').val(id_x);

      $('#disid').val(id_x);
      $('#distype').val($('#dist-'+id_x).text());
      $('#disval').val($('#disv-'+id_x).text());
      $('#dismina').val($('#disa-'+id_x).text());
      /* $('#disfrom').val($('#disf-'+id_x).text());
      $('#disto').val($('#disto-'+id_x).text()); */
      $('#dison').val($('#diso-'+id_x).text());
      $('#disstatus').val($('#diss-'+id_x).text());
      $("#myModal").modal('show');
    }); 
    
    function getMaterialGrps(val) {
      if(val == 'MATERIAL'){
        $('#add_mat_grp_sec').show();
      }else{
        $('#add_mat_grp_sec').hide();
        $('#add_checkbox_forbulk').hide();
        $('#add_mat_sec').hide();
        $('#add_excel_file').hide();
      }
    }

    function getMaterials(val) {
      if(val != ''){
        var html='';
        $.ajax({
          type: "POST",
          url: '<?php echo base_url(); ?>admin/discount/get_materials',
          data:'material_group='+val,
          dataType: "json",
          success: function(response){
            html +='<label for="add_mat"> Materials </label><select class="form-control" id="add_mat" name="material_no" multiple>';
            $.each(response,function (index, val) {
              html+='<option value="'+val.material_no+'">'+val.material_description+' ('+val.material_no+')</option>';
            });
            html+='</select><div class="invalid-feedback-dismat" style="color:red;"></div>';

            $('#add_checkbox_forbulk').show();
            $('#invalid-feedback-radiogrp').show();
            $("#add_mat_sec").html(html); 
          }
        });
      }else{
        $('#add_checkbox_forbulk').hide();
        $('#invalid-feedback-radiogrp').hide();
        $('#invalid-feedback-radiogrp').val('');
      }
    }

    function getDiscountonOptions(val){
      if(val == 'AMOUNT'){
        $('#add_dison').html('<option value="">Select</option><option value="ALL">ALL</option>');
      }else{
        $('#add_dison').html('<option value="">Select</option><option value="ALL">ALL</option><option value="MATERIAL">MATERIAL-GROUP</option>');
      }
    }
    
    $(document).ready(function(){
      /* $('.switch').change(function (event) {
        var discountId = $(this).data("id");
        if(confirm('Are you confirm ?')) {
          $.ajax({
            method: "POST",
            url: "<?php echo site_url('/admin/discount/changestatus'); ?>", 
            data:{discountId: discountId},
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            datatype : "json",
            success: function(response)
            {
              //var dataObject = jQuery.parseJSON(response);
              window.location.reload();
            },
            error: function( error )
            {   
              //$('#type').find('option').not(':first').remove();
            }
          });
        } else {
          window.location.reload();
          return false;
        }
      }); */

      $('.switch input[type="checkbox"]').change(function(event) {
        var isChecked = $(this).prop('checked');
        var discountId = $(this).closest('.switch').data("id");
  
        if (!isChecked) {
          if (confirm('Are you sure you want to uncheck the checkbox?')) {
            $.ajax({
              method: "POST",
              url: "<?php echo site_url('/admin/discount/changestatus'); ?>",
              data: {
                discountId: discountId
              },
              contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
              datatype: "json",
              success: function(response) {
                console.log(response);
                window.location.reload();
              },
              error: function(error) {
                console.error('Error:', error);
              }
            });
          } else {
            $(this).prop('checked', true);
          }
        }
      });

      $('#allmat').on('click', function(e){
        $('#add_excel_file').hide();
        $('.invalid-feedback-excelfile').hide();
        $('#add_mat_sec').hide();
      });

      $('#selectmat').on('click', function(e){
        $('#add_excel_file').hide();
        $('.invalid-feedback-excelfile').hide();
        $('#add_mat_sec').show();
      });

      $('#bulkmat').on('click', function(e){
        $('#add_excel_file').show().css('display', 'flex');
        $('.invalid-feedback-excelfile').show();
        $('#add_mat_sec').hide();
      });

      /* var uploadfiledet;
      $('#import_undeliverable_parts').on('submit', function(e){
        e.preventDefault();
        uploadfiledet = new FormData(this);alert(uploadfiledet);
      }); */

      $("#file").change(function() {
        var fd = new FormData();
        fd.append('file', this.files[0]); // since this is your file input
        var filename = this.files[0].name;
        var file_extension = filename.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(file_extension, ['xls','xlsx']) == -1){
          $('.invalid-feedback-excelfile').text('Invalid excel file extension');
        }else{
          $('.invalid-feedback-excelfile').text('');
        }

        /* var file_size = this.files[0].size;
        if(file_size > 5000){
          $('.invalid-feedback-excelfile').text('File size is very big');
        } */

        $.ajax({
          url: "<?php echo base_url(); ?>admin/discount/bulk_upload_discount",
          type: "post",
          dataType: 'json',
          processData: false, // important
          contentType: false, // important
          data: fd,
          success: function(response) {
            if(response.length > 0) {
              // alert("Your excel file was uploaded successfully");
              $('#add_bulk_mats').val(response);
            }
          },
          error: function() {
            alert("An error occured, please try again.");         
          }
        });
      });

      $("#submit_addform").click(function(){
        var distype   = $('#add_distype').val();
        var disval    = $('#add_disval').val();
        var dismina   = $('#add_dismina').val();
        var disfrom   = $('#add_disfrom').val();
        var disto     = $('#add_disto').val();
        var dison     = $('#add_dison').val();
        var dismatgrp = $('#add_mat_grp').val();
        //var filedet   = uploadfiledet;
        var dismat    = $('#add_mat').val();
        var mattype   = $('input[name="chose_radio"]:checked').val();
        //var disstatus = $('#add_disstatus').val();
        if(mattype=='Bulk upload from Excel'){
          var dismat = $('#add_bulk_mats').val();
        }
        var uploaded_mats = $('#add_bulk_mats').val();

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

        if(dison == 'MATERIAL' && dismatgrp==''){
          $('.invalid-feedback-dismatgrp').fadeIn();
          $('#add_mat_grp').focus();
          $('.invalid-feedback-dismatgrp').text('Please select atleast one material group');
        }
        else{
          $('.invalid-feedback-dismatgrp').hide();
        }

        if(dison == 'MATERIAL' && dismatgrp!=null && mattype == null){
          $('.invalid-feedback-radiogrp').fadeIn();
          $('#allmat').focus();
          $('.invalid-feedback-radiogrp').text('Please select atleast one option');
        }
        else{
          $('.invalid-feedback-radiogrp').hide();
        }

        if(dison == 'MATERIAL' && dismatgrp!=null && (mattype =='Choose Material' && dismat==null)){
          $('.invalid-feedback-dismat').fadeIn();
          $('#add_dismat').focus();
          $('.invalid-feedback-dismat').text('Please select atleast one material');
        }
        else{
          $('.invalid-feedback-dismat').hide();
        }

        if(dison == 'MATERIAL' && dismatgrp!=null && (mattype =='Bulk upload from Excel' && uploaded_mats=='')){
          $('.invalid-feedback-excelfile').fadeIn();
          $('#file').focus();
          $('.invalid-feedback-excelfile').text('Please upload an excel file');
        }
        else{
          $('.invalid-feedback-excelfile').hide();
        }


        if((distype != '') && (disval != '') && (dismina != '') && (disfrom != '') && (disto != '') && (dison != '')){
          var data = {
            distype: distype,
            disval: disval,
            dismina: dismina,
            disfrom: disfrom,
            disto: disto,
            dison: dison,
            dismatgrp: dismatgrp,
            mattype: mattype,
            dismat: dismat,
            disstatus: ''
          };
          
          $.ajax({
            url: '<?php echo base_url(); ?>admin/discount/edit_globaldiscount', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {console.log(response);
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
        var dismatgrp = $('#dismatgrp').val();
        var disallmat = $('#disallmat').val();
        var dismat = $('#dismat').val();
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
          $('.invalid-feedback-edisval').fadeIn();
          $('#disval').focus();
          $('.invalid-feedback-edisval').text('Please enter discount value');
        }
        else{
          $('.invalid-feedback-edisval').hide();
        }

        if (dismina == '') {
          $('.invalid-feedback-edismina').fadeIn();
          $('#dismina').focus();
          $('.invalid-feedback-edismina').text('Please enter minimum amount');
        }
        else{
          $('.invalid-feedback-edismina').hide();
        }

        if (disfrom == '') {
          $('.invalid-feedback-edisfrom').fadeIn();
          $('#disfrom').focus();
          $('.invalid-feedback-edisfrom').text('Please select from date');
        }
        else{
          $('.invalid-feedback-edisfrom').hide();
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
            dismatgrp: dismatgrp,
            mattype: disallmat,
            dismat: dismat,
            disstatus: ''
          };

          $.ajax({
            url: '<?php echo base_url(); ?>admin/discount/edit_globaldiscount', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#myModal').modal('toggle');
            
            toastr["info"]("", "success : One Global Discount Data is Cloned Successfully.")
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
        if(confirm('Do you really want to delete?')){
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
            url: '<?php echo base_url(); ?>admin/discount/delete_globaldiscount', // Replace with your API endpoint
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
        }else{
          return false;
        }
      });
    })
</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/group.js"></script>
<script src="<?php echo base_url(); ?>assets/js/toastr.min.js" type="text/javascript"></script>