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
            <span>Promocodes List</span>
          </li>
        </ul>
        <br><br>
        <!-- <div class="pull-right">
          <div class="col-xs-2"> 
            <a href="<?php echo base_url(); ?>/admin/promocode/download_excel">
              <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                Download Material Promocode Template
              </button>
            </a> 
          </div>
        </div>
        <div class="form-group pull-right">
          <div class="col-xs-2">
            <button type="submit" class="btn btn-primary btn_customer" id="btn_matpromo" name="btn_mulquiz">Upload Material Promocode </button>
          </div>
        </div> -->
      </div>
      <div class="content">
        <div class="row" style="margin-bottom:20px; ">
          <div class="col-xs-12">
            <div class="form-group pull-right">
              <div class="col-xs-2">
                <a href="#" class="nav-link "> <button type="submit" class="btn btn-primary addbtnsub btn_show addModal" id="btn_click" name="btn_save">Create Discount Promocode</button></a>
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
                <div class="caption"><i class="fa fa-globe"></i>Promocodes List</div>
                <div class="tools1"> </div>
              </div>
              <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr>
                      <th> Sl. No. </th>
                      <th> Discount Type </th>
                      <th> Discount Value </th>
                      <th> Min Amount </th>
                      <th> Promocode </th>
                      <th> Description </th>
                      <th> From Date </th>
                      <th> To Date &nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th> Discount To </th>
                      <th> Discount On &nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th> Status </th>
                      <th> Created At </th>
                      <th> Updated At </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($globalpromocode)){
                      $counter = 1; 
                      foreach( $globalpromocode as $globalpromocodes){
                        $material_all = (isset($globalpromocodes['all_select']) && $globalpromocodes['all_select'] == 1) ? ' - (ALL)' : ' - (SELECTIVE)';
                    ?>
                      <tr>
                      <td><span><?php echo $counter ;?></span></td>
                      <td><span id="dist-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['discount_type']) ? $globalpromocodes['discount_type'] : ''; ?></span></td>
                      <td><span id="disv-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['discount_value']) ? $globalpromocodes['discount_value'] : ''; ?></span></td>
                      <td><span id="disa-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['min_ammount']) ? $globalpromocodes['min_ammount'] : ''; ?></span></td>
                      <td><span id="disp-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['promocode']) ? $globalpromocodes['promocode'] : ''; ?></span></td>
                      <td><span id="disd-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['description']) ? $globalpromocodes['description'] : ''; ?></span></td>
                      <td><span id="disf-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['from_date']) ? date('d-m-Y', strtotime($globalpromocodes['from_date'])) : ''; ?></span></td>
                      <td><span id="disto-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['to_date']) ? date('d-m-Y', strtotime($globalpromocodes['to_date'])) : ''; ?></span></td>
                      <td><span id="disa-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['discount_on_user_grp']) ? $globalpromocodes['discount_on_user_grp'] : ''; ?></span></td>
                      <td><span id="diso-<?php echo $globalpromocodes['id']; ?>">
                        <?php echo ($globalpromocodes['discount_on'] == 'ALL') ? 'ALL MATERIALS' : $globalpromocodes['group_description'] . ' (' . $globalpromocodes['group_code'] . ')' . $material_all; ?>
                      </span></td>
                      <td>
                        <span id="diss-<?php echo $globalpromocodes['id']; ?>">
                          <?php if($globalpromocodes['status']=='A'){ ?>
                          <label class="switch" data-id="<?php echo $globalpromocodes['id'] ?>">
                            <input type="checkbox" <?php echo ($globalpromocodes['status']=='A') ? 'checked' :'disabled' ?> name="change_status_<?php echo $globalpromocodes['id'] ?>">
                            <span class="slider round"></span>
                          </label>
                          <?php }else{ echo 'Inactive'; } ?>
                        </span>
                      </td>
                      <td><span id="disc-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['created_at']) ? date('d-m-Y', strtotime($globalpromocodes['created_at'])) : ''; ?></span></td>
                      <td><span id="disu-<?php echo $globalpromocodes['id']; ?>"><?php echo isset($globalpromocodes['updated_at']) ? date('d-m-Y', strtotime($globalpromocodes['updated_at'])) : ''; ?></span></td>
                      <td>
                        <?php if($globalpromocodes['status']!='A'){ ?>
                        <a data-id="<?php echo $globalpromocodes['id']; ?>" data-disid="<?php echo $globalpromocodes['id'] ;?>" data-distype="<?php echo $globalpromocodes['discount_type'] ;?>" data-disval="<?php echo $globalpromocodes['discount_value']; ?>" data-dismina="<?php echo $globalpromocodes['min_ammount']; ?>" data-disp="<?php echo $globalpromocodes['promocode']; ?>" data-disd="<?php echo $globalpromocodes['description']; ?>" data-disfrom="<?php echo $globalpromocodes['from_date']; ?>" data-disto="<?php echo $globalpromocodes['to_date']; ?>" data-disonusrgrp="<?php echo $globalpromocodes['discount_on_user_grp']; ?>" data-dison="<?php echo $globalpromocodes['discount_on']; ?>" data-matgrp="<?php echo $globalpromocodes['material_group_code']; ?>" data-allselect="<?php echo $globalpromocodes['all_select']; ?>" data-disstatus="<?php echo $globalpromocodes['status']; ?>" href="#" class="popupDynamic" ><i class="fa fa-clone"></i></a>
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
          <h4 class="modal-title">Create Discount Promocode</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="add_distype"> Discount Type </label>
            <select class="form-control" name="discount_type" required class="form-control" id="add_distype">
                <option value="">Select</option>
                <option value="PERCENT">PERCENT</option>
                <option value="AMOUNT">AMOUNT</option>
            </select>
            <div class="invalid-feedback-distype" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="add_disval"> Discount Value </label>
            <input type="number" min="0" required class="form-control" id="add_disval" name="dis_val">
            <div class="invalid-feedback-disval" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="add_dismina"> Minimum Amount </label>
            <input type="number" min="0" required class="form-control" id="add_dismina" name="min_amt">
            <div class="invalid-feedback-dismina" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="add_dispromo"> Promocode </label>
            <input type="text" maxlength="50" required class="form-control" id="add_dispromo" name="dis_promo">
            <div class="invalid-feedback-dispromo" style="color:red;"></div>
          </div>
          <div class="form-group">
            <label for="add_dispdes"> Description </label>
            <input type="text" maxlength="255" required class="form-control" id="add_dispdes" name="promo_des">
            <div class="invalid-feedback-dispdes" style="color:red;"></div>
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
            <label for="add_disonusrgrp"> Discount On User Group </label>
            <select class="form-control" name="discount_on_user_grp" onChange="showSelectOptionsusrgrp(this.value);" required class="form-control" id="add_disonusrgrp">
                <option value="">Select</option>
                <option id="all_usrgrp" value="ALL">ALL</option>
                <option id="zone" value="ZONE">ZONE</option>
                <option id="reg" value="REGION">REGION</option>
                <option id="cust" value="CUSTOMER">CUSTOMER</option>
            </select>
            <div class="invalid-feedback-disonusrgrp" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_checkbox_for_cust" style="display:none;">
            <input type="radio" id="select_cust" style="margin-right:5px;" name="chose_radio_cust" value="Choose Customer" />
            <label style="margin-bottom:auto;" for="select_cust">Choose Customer</label>
            <input type="radio" id="bulk_cust" style="margin-right:5px; margin-left: 13px;" name="chose_radio_cust" value="Bulk upload from Excel" />
            <label style="margin-bottom:auto;" for="bulk_cust">Bulk upload from Excel</label>

            <div class="invalid-feedback-radiogrp-cust" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_zone_sec">
            <label for="add_zone"> Zone </label>
            <select class="form-control" name="zone_no" id="add_zone">
              <option value="">Select</option>
              <?php
              if (!empty($allzones)) {
                foreach ($allzones as $key => $val) { ?>
                  <option value="<?php echo $val['Zone'];?>"><?php echo $val['Zone'];?></option>
              <?php }} ?>
            </select>
            <div class="invalid-feedback-diszone" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_reg_sec">
            <label for="add_reg"> Region </label>
            <select class="form-control" name="reg_no" id="add_reg">
              <option value="">Select</option>
              <?php
              if (!empty($allregions)) {
                foreach ($allregions as $key => $val) { ?>
                  <option value="<?php echo $val['region_code'];?>"><?php echo $val['region_description'];?></option>
              <?php }} ?>
            </select>
            <div class="invalid-feedback-disreg" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_cust_sec">
            <label for="add_cust"> Customer </label>
            <select class="form-control" name="cust_no" id="add_cust" multiple>
              <option value="">Select</option>
              <?php
              if (!empty($allcustomers)) {
                foreach ($allcustomers as $key => $val) { ?>
                  <option value="<?php echo $val['customer_code'];?>"><?php echo $val["name1"].' ('.$val["customer_code"].')';?></option>
              <?php }} ?>
            </select>
            <div class="invalid-feedback-discust" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_excel_file_cust" style="display:none;">
            <input type="file" name="file_cust" class="form-control" id="file_cust" required accept=".xls, .xlsx">
            <input type="hidden" class="form-control" id="add_bulk_cust">
            <div class="invalid-feedback-excelfile-cust" style="color:red;" style="display:none;"></div>
          </div>
          <div class="form-group" id="download_sample_cust" style="display:none;">
            <!-- <a href="<?php echo base_url(); ?>/admin/promocode/download_excel"> -->
            <a href="<?php echo base_url('assets/csv/select_bulk_customers.xlsx'); ?>">
              <!-- <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                Sample Customer Template
              </button> -->
              Sample Customer Template
            </a>
          </div>
          <div class="form-group">
            <label for="add_dison"> Discount On </label>
            <select class="form-control" name="discount_on" onChange="showSelectOptions(this.value);" required class="form-control" id="add_dison">
                <option value="">Select</option>
                <option id="def_all" value="ALL">ALL</option>
                <option id="matgrp" value="MATERIAL-GROUP">MATERIAL-GROUP</option>
            </select>
            <div class="invalid-feedback-dison" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_mat_grp_sec" style="display:none;">
            <label for="add_mat_grp"> Material Group </label>
            <select class="form-control" name="material_grp" id="add_mat_grp" onChange="getMaterials(this.value);">
              <option value="">Select</option>
              <?php
              if (!empty($allmaterialgrps)) {
                foreach ($allmaterialgrps as $key => $val) { ?>
                  <option value="<?php echo $val['group_code'];?>"><?php echo $val['group_description'].' ('.$val['group_code'].')';?></option>
              <?php }} ?>
            </select>
            <div class="invalid-feedback-dismatgrp" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_checkbox_for_mat" style="display:none;">
            <input type="radio" id="all_mat" style="margin-right:5px;" name="chose_radio" value="All" />
            <label style="margin-bottom:auto;" for="all_mat">All</label>
            <input type="radio" id="select_mat" style="margin-right:5px; margin-left: 13px;" name="chose_radio" value="Choose Material" />
            <label style="margin-bottom:auto;" for="select_mat">Choose Material</label>
            <input type="radio" id="bulk_mat" style="margin-right:5px; margin-left: 13px;" name="chose_radio" value="Bulk upload from Excel" />
            <label style="margin-bottom:auto;" for="bulk_mat">Bulk upload from Excel</label>

            <div class="invalid-feedback-radiogrp" style="color:red;"></div>
          </div>
          <div class="form-group" id="add_mat_sec">
            
          </div>
          <div class="form-group" id="add_excel_file" style="display:none;">
            <input type="file" name="file" class="form-control" id="file" required accept=".xls, .xlsx">
            <input type="hidden" class="form-control" id="add_bulk_mats">
            <div class="invalid-feedback-excelfile" style="color:red;" style="display:none;"></div>
          </div>
          <div class="form-group" id="download_sample_mat" style="display:none;">
            <!-- <a href="<?php echo base_url(); ?>admin/discount/download_excel"> -->
            <a href="<?php echo base_url('assets/csv/select_bulk_materials.xlsx'); ?>">
              <!-- <button type="button" class="btn btn-primary downloadquiz" id="btn_downloadquiz" name="btn_downloadquiz"> 
                Sample Material Template
              </button> -->
              Sample Material Template
            </a> 
          </div>
          <!-- <div class="form-group">
            <label for="add_disstatus"> Status </label>
            <select class="form-control" name="discount_status" required class="form-control" id="add_disstatus">
                <option value="">Select</option>
                <option value="A">ACTIVE</option>
                <option value="I">INACTIVE</option>
            </select>
            <div class="invalid-feedback-disstatus" style="color:red;"></div>
          </div> -->
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
          <h4 class="modal-title">Clone Promocode</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="distype"> Discount Type </label>
            <input type="text" maxlength="30" required class="form-control" id="distype" disabled>
          </div>
          <div class="form-group">
            <label for="disval"> Discount Value </label>
            <input type="number" min="0" required class="form-control" id="disval">
            <div class="invalid-feedback-edisval" style="color:red;display:none;"></div>
          </div>
          <div class="form-group">
            <label for="dismina"> Minimum Amount </label>
            <input type="number" min="0" required class="form-control" id="dismina">
            <div class="invalid-feedback-edismina" style="color:red;display:none;"></div>
          </div>
          <div class="form-group">
            <label for="dispromo"> Promocode </label>
            <input type="text" maxlength="50" required class="form-control" id="dispromo">
            <div class="invalid-feedback-edispromo" style="color:red;display:none;"></div>
          </div>
          <div class="form-group">
            <label for="dispdes"> Description </label>
            <input type="text" maxlength="50" required class="form-control" id="dispdes">
            <div class="invalid-feedback-edispdes" style="color:red;display:none;"></div>
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
          <!-- <div class="form-group">
            <label for="disstatus"> Status </label>
            <select class="form-control" name="discount_status" required class="form-control" id="disstatus">
              <option value="">Select</option>
              <option value="A">ACTIVE</option>
              <option value="I">INACTIVE</option>
            </select>
            <div class="invalid-feedback-edisstatus" style="color:red;display:none;"></div>
          </div> -->
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

  <div class="modal left fade" id="material_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Material Promocodes</h5>
          <div style="margin-top:6px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div id="dvLoading" style="display: none;"></div>
          <form action="<?php echo base_url('admin/promocode/bulk_matpromocode'); ?>" enctype="multipart/form-data" method="post" role="form">
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

  <div class="modal left fade" id="customer_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Customer Promocodes</h5>
          <div style="margin-top:6px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div id="dvLoading" style="display: none;"></div>
          <form action="<?php echo base_url('admin/promocode/bulk_custpromocode'); ?>" enctype="multipart/form-data" method="post" role="form">
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

  <div class="modal left fade" id="region_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Region Promocodes</h5>
          <div style="margin-top:6px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div id="dvLoading" style="display: none;"></div>
          <form action="<?php echo base_url('admin/promocode/bulk_regpromocode'); ?>" enctype="multipart/form-data" method="post" role="form">
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

  <div class="modal left fade" id="zone_promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title popup_heading_text" id="exampleModalLabel">Add Zone Promocodes</h5>
          <div style="margin-top:6px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div id="dvLoading" style="display: none;"></div>
          <form action="<?php echo base_url('admin/promocode/bulk_zonepromocode'); ?>" enctype="multipart/form-data" method="post" role="form">
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
      $('#add_cust_sec').hide();
      $('#add_reg_sec').hide();
      $('#add_zone_sec').hide();
      $('#add_mat_grp_sec').hide();
      $('#add_mat_sec').hide();
      $('#add_checkbox_for_mat').hide();
      $('#add_checkbox_for_cust').hide();
      $('#add_excel_file').hide();
      $('#add_excel_file_cust').hide();
      $('#download_sample_mat').hide();
      $('#download_sample_cust').hide();

      $('.invalid-feedback-distype').text('');
      $('.invalid-feedback-disval').text('');
      $('.invalid-feedback-dismina').text('');
      $('.invalid-feedback-disfrom').text('');
      $('.invalid-feedback-disto').text('');
      $('.invalid-feedback-disonusrgrp').text('');
      $('.invalid-feedback-dison').text('');
      $('.invalid-feedback-disstatus').text('');
      $('.invalid-feedback-dispromo').text('');
      $('.invalid-feedback-dispdes').text('');
      $('.invalid-feedback-dismatgrp').text('');
      $('.invalid-feedback-radiogrp').text('');
      $('.invalid-feedback-excelfile').text('');
      $('.invalid-feedback-excelfile-cust').text('');

      $('#add_distype').val('');
      $('#add_disval').val('');
      $('#add_dismina').val('');
      $('#add_disfrom').val('');
      $('#add_disto').val('');
      $('#add_disonusrgrp').val('');
      $('#add_dison').val('');
      $('#add_disstatus').val('');
      $('#add_dispromo').val('');
      $('#add_dispdes').val('');
      $('#add_mat_grp').val('');
      $('#add_checkbox_for_mat').val('');
      $('#add_checkbox_for_cust').val('');
      $('input[name="chose_radio"]:checked').removeAttr('checked');
      $('input[name="chose_radio_cust"]:checked').removeAttr('checked');
      
      $("#add_dispromo").on("blur", function() {
        var dispromo = $('#add_dispromo').val();
        $.ajax({
          url: '<?php echo base_url(); ?>admin/promocode/check_promocode', // Replace with your API endpoint
          type: 'POST',
          data: {dispromo:dispromo},
          success: function(response) {
            // Request successful, do something with the response
            if (response == 1) {
              $('.invalid-feedback-dispromo').fadeIn();
              $('#add_dispromo').focus();
              $('.invalid-feedback-dispromo').text('Promocode already exists. Please try another!');
              $('#submit_addform').attr('disabled','disabled');
            } else {
              $('.invalid-feedback-dispromo').empty();
              $('.invalid-feedback-dispromo').hide();
              $('#submit_addform').removeAttr('disabled');
            }
          },
          error: function(xhr, status, error) {
            // Request failed, handle the error
            toastr["error"]("", "Failure : Something went wrong.")
            console.error(error);
          }
        });
      });

      $('input[name="chose_radio"]').on('change', function(e){
        $('#add_bulk_mats').val('');
        var mattypeid = $('input[name="chose_radio"]:checked').attr('id');
        var file = $('#file').val();
        if(mattypeid == 'bulk_mat' && file == '' ){
          $('.invalid-feedback-excelfile').text('Please upload an excel file')
          $('#submit_addform').attr('disabled','disabled');
        }
        if(mattypeid != 'bulk_mat'){
          $('#submit_addform').removeAttr('disabled');
        }
      });

      $('input[name="chose_radio_cust"]').on('change', function(e){
        $('#add_bulk_cust').val('');
        var custtypeid = $('input[name="chose_radio_cust"]:checked').attr('id');
        var file = $('#file_cust').val();
        if(custtypeid == 'bulk_cust' && file == ''){
          $('.invalid-feedback-excelfile-cust').text('Please upload an excel file')
          $('#submit_addform').attr('disabled','disabled');
        }
        if(custtypeid != 'bulk_cust'){
          $('#submit_addform').removeAttr('disabled');
        }
      });
    });

    $(".popupDynamic").click(function(){
      $("#myModal").validate().resetForm();
      var id_x        = $(this).data('id');
      var distype     = $(this).data('distype');
      var disval      = $(this).data('disval');
      var dismina     = $(this).data('dismina');
      var disp        = $(this).data('disp');
      var disd        = $(this).data('disd');
      var disfrom     = $(this).data('disfrom');
      var disto       = $(this).data('disto');
      var disonusrgrp = $(this).data('dison');
      var dison       = $(this).data('dison');
      var disstatus   = $(this).data('disstatus');
      var disid       = $(this).data('disid');
      var matgrp      = $(this).data('matgrp');
      var allselect   = $(this).data('allselect');
      
      if(disstatus != ''){
        $('.invalid-feedback-edisstatus').hide();
      }else{
        $('.invalid-feedback-edisstatus').show();
      }

      if(disp != ''){
        $('.invalid-feedback-edispromo').hide();
      }else{
        $('.invalid-feedback-edispromo').show();
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

      if(dison == 'MATERIAL-GROUP'){
        $("#display_list").show();

        $.ajax({
          type: "POST",
          url: '<?php echo base_url(); ?>admin/promocode/get_discounton_typerecords',
          data:'dis_id='+id_x+'&dison='+dison+'&group_code='+matgrp+'&allselect='+allselect,
          dataType: "json",
          success: function(response){
            var html ='', html1='', html2='';
            if(dison == 'MATERIAL-GROUP'){
              html1 +='<label for="dismatgrp"> Material Group </label><select class="form-control" id="dismatgrp" name="material_grp" disabled>';
              html1+='<option value="'+response[0].group_code+'">'+response[0].group_description+' ('+response[0].group_code+')</option>';
              html1+='</select>';
              $("#grp_display_list").show();
              $("#grp_display_list").html(html1);

              if(response.length > 0 && allselect != 1){
                html +='<label for="dismat"> Materials </label><select class="form-control" id="dismat" name="material_no" multiple disabled>';
                $.each(response,function (index, val) {
                  html+='<option value="'+val.material_no+'" selected>'+val.material_description+' ('+val.material_no+')'+'</option>';
                });
              }
            }

            if(dison == 'CUSTOMER' && allselect != 1){
              html +='<label for="discust"> Customers </label><select class="form-control" id="discust" name="cust_no" multiple disabled>';
              $.each(response,function (index, val) {
                html+='<option value="'+val.customer_code+'" selected>'+val.name1+' ('+val.customer_code+')</option>';
              });

              $("#grp_display_list").hide();
            }

            if(dison == 'REGION'){
              html +='<label for="disreg"> Regions </label><select class="form-control" id="disreg" name="reg_name" multiple disabled>';
              $.each(response,function (index, val) {
                html+='<option value="'+val.region_code+'" selected>'+val.region_description+'</option>';
              });

              $("#grp_display_list").hide();
            }

            if(dison == 'ZONE'){
              html +='<label for="diszone"> Zones </label><select class="form-control" id="diszone" name="zone_name" multiple disabled>';
              $.each(response,function (index, val) {
                html+='<option value="'+val.zone+'" selected>'+val.zone+'</option>';
              });

              $("#grp_display_list").hide();
            }

            html+='</select>';
            $("#display_list").html(html);

            if (allselect == 1) {
              $("#all_select_radio").show();

              html2 +='<input type="radio" id="disallmat" style="margin-right:5px;" name="chose_radio" value="All" checked disabled /><label style="margin-bottom:auto;" for="all_mat">All</label>'
              $("#all_select_radio").html(html2);
            }else{
              $("#all_select_radio").hide();
              $("#all_select_radio").html(html2);
            }
          }
        });
      }else{
        $("#display_list").hide();
      }

      $(".date").on("click", function() {
        var dispromo = $('#dispromo').val();
        $.ajax({
          url: '<?php echo base_url(); ?>admin/promocode/check_promocode', // Replace with your API endpoint
          type: 'POST',
          data: {dispromo:dispromo},
          success: function(response) {
            // Request successful, do something with the response
            if (response == 1) {
              $('.invalid-feedback-edispromo').fadeIn();
              $('#dispromo').focus();
              $('.invalid-feedback-edispromo').text('Promocode already exists. Please try another!');
              $('#submit_form').attr('disabled','disabled');
              //$('.date').parent().find('input:first').attr('disabled','disabled');
              //$('.fa-calendar').parent().attr('disabled','disabled');
            } else {
              $('.invalid-feedback-edispromo').empty();
              $('.invalid-feedback-edispromo').hide();
              $('#submit_form').removeAttr('disabled');
              //$('.fa-calendar').parent().removeAttr('disabled');
              //$('.date').parent().find('input:first').removeAttr('disabled');
            }
          },
          error: function(xhr, status, error) {
            // Request failed, handle the error
            toastr["error"]("", "Failure : Something went wrong.")
            console.error(error);
          }
        });
      });

      $('#id_x').val(id_x);

      $('#disid').val(id_x);
      $('#distype').val($('#dist-'+id_x).text());
      $('#disval').val($('#disv-'+id_x).text());
      $('#dismina').val($('#disa-'+id_x).text());
      $('#dispromo').val($('#disp-'+id_x).text());
      $('#dispdes').val($('#disd-'+id_x).text());
      $('#dison').val($('#diso-'+id_x).text());
      $('#disstatus').val($('#diss-'+id_x).text());
      $("#myModal").modal('show');
    }); 

    function showSelectOptionsusrgrp(val) {
      if(val == 'CUSTOMER'){
        // $('#add_cust_sec').show();
        $('#add_checkbox_for_cust').show();
        $('input[name="chose_radio_cust"]:checked').removeAttr('checked');
        $('#add_reg').val('');
        $('#add_zone').val('');
      }else{
        $('#add_checkbox_for_cust').hide();
        $('#add_cust_sec').hide();
        $('#add_excel_file_cust').hide();
        $('#download_sample_cust').hide();
      }

      if(val == 'REGION'){
        $('#add_reg_sec').show();
        $('#add_zone').val('');
      }else{
        $('#add_reg_sec').hide();
      }

      if(val == 'ZONE'){
        $('#add_zone_sec').show();
        $('#add_reg').val('');
      }else{
        $('#add_zone_sec').hide();
      }
    }
    
    function showSelectOptions(val) {
      if(val == 'MATERIAL-GROUP'){
        $('#add_mat_grp_sec').show();
      }else{
        $('#add_checkbox_for_mat').hide();
        $('#add_mat_grp_sec').hide();
        $('#add_mat_grp').val('');
        $('#add_mat_sec').hide();
        $('#add_excel_file').hide();
        $('#download_sample_mat').hide();
      }
    }

    function getMaterials(val) {
      $("#add_mat_sec").hide();
      if(val != ''){
        var html='';
        $.ajax({
          type: "POST",
          url: '<?php echo base_url(); ?>admin/promocode/get_materials',
          data:'material_group='+val,
          dataType: "json",
          success: function(response){
            html +='<label for="add_mat"> Materials </label><select class="form-control" id="add_mat" name="material_no" multiple>';
            $.each(response,function (index, val) {
              html+='<option value="'+val.material_no+'">'+val.material_description+' ('+val.material_no+')</option>';
            });
            html+='</select><div class="invalid-feedback-dismat" style="color:red;"></div>';

            $('#add_checkbox_for_mat').show();
            $('input[name="chose_radio"]:checked').removeAttr('checked');
            $('#invalid-feedback-radiogrp').show();
            $("#add_mat_sec").html(html); 
          }
        });
      }else{
        //$('#add_checkbox_for_mat').hide();
        $('#invalid-feedback-radiogrp').hide();
        $('#invalid-feedback-radiogrp').val('');
      }
    }
    
    $(document).ready(function(){
      $('.switch input[type="checkbox"]').change(function(event) {
        var isChecked = $(this).prop('checked');
        var promocodeId = $(this).closest('.switch').data("id");
  
        if (!isChecked) {
          if (confirm('Are you sure you want to disable the promocode?')) {
            $.ajax({
              method: "POST",
              url: "<?php echo site_url('/admin/promocode/changestatus'); ?>",
              data: {
                promocodeId: promocodeId
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

      $('#all_mat').on('click', function(e){
        $('#add_excel_file').hide();
        $('#download_sample_mat').hide();
        $('.invalid-feedback-excelfile').hide();
        $('#add_mat_sec').hide();
      });

      $('#select_mat').on('click', function(e){
        $('#add_excel_file').hide();
        $('#download_sample_mat').hide();
        $('.invalid-feedback-excelfile').hide();
        $('#add_mat_sec').show();
      });

      $('#bulk_mat').on('click', function(e){
        $('#add_excel_file').show();
        $('#download_sample_mat').show();
        $('.invalid-feedback-excelfile').show();
        $('#add_mat_sec').hide();
      });

      $('#select_cust').on('click', function(e){
        $('#add_excel_file_cust').hide();
        $('#download_sample_cust').hide();
        $('.invalid-feedback-excelfile-cust').hide();
        $('#add_cust_sec').show();
      });

      $('#bulk_cust').on('click', function(e){
        $('#add_excel_file_cust').show();
        $('#download_sample_cust').show();
        $('.invalid-feedback-excelfile-cust').show();
        $('#add_cust_sec').hide();
      });

      $('#add_distype').on('change', function(e){
        if($('#add_distype').val() == 'AMOUNT'){
          //$('#def_all').attr('selected', true);
          $('#matgrp').hide();
          $('#add_checkbox_for_mat').hide();
          $('#add_dison').val('ALL').trigger('change');
        }else{
          $('#def_all').attr('selected', false);
          $('#matgrp').show();
        }
      });

      $("#file").change(function() {
        $('#add_bulk_mats').val('');

        var fd = new FormData();
        fd.append('file', this.files[0]); // since this is your file input
        var filename = this.files[0].name;
        var file_extension = filename.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(file_extension, ['xls','xlsx']) == -1){
          $('.invalid-feedback-excelfile').text('Invalid excel file extension');
        }else{
          $('.invalid-feedback-excelfile').text('');
        }

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

              var mattypeid = $('input[name="chose_radio"]:checked').attr('id');
              var file      = $('#file').val();
              var promoerr = $('.invalid-feedback-dispromo').val();
              if(promoerr == '' && (mattypeid == 'bulk_mat' && file != '' && ($('#add_bulk_mats').val()) != '')){
                $('#submit_addform').removeAttr('disabled');
              }
            }
            var uploaded_mats = $('#add_bulk_mats').val();
            var mattypeid     = $('input[name="chose_radio"]:checked').attr('id');
            var file          = $('#file').val();
            if(mattypeid == 'bulk_mat' && file != '' && uploaded_mats == ''){
              $('.invalid-feedback-excelfile').text('Please upload correct excel file');
            }
          },
          error: function() {
            alert("An error occured, please try again.");         
          }
        });
      });

      $("#submit_addform").click(function(){
        var distype     = $('#add_distype').val();
        var disval      = $('#add_disval').val();
        var dismina     = $('#add_dismina').val();
        var dispromo    = $('#add_dispromo').val();
        var dispdes     = $('#add_dispdes').val();
        var disfrom     = $('#add_disfrom').val();
        var disto       = $('#add_disto').val();
        var disonusrgrp = $('#add_disonusrgrp').val();
        var diszone     = $('#add_zone').val();
        var disreg      = $('#add_reg').val();
        var custtype    = $('input[name="chose_radio_cust"]:checked').val();
        var custtypeid  = $('input[name="chose_radio_cust"]:checked').attr('id');
        var discust     = $('#add_cust').val();
        var file_cust   = $('#file_cust').val();
        var dison       = $('#add_dison').val();
        var dismatgrp   = $('#add_mat_grp').val();
        var mattype     = $('input[name="chose_radio"]:checked').val();
        var mattypeid   = $('input[name="chose_radio"]:checked').attr('id');
        var dismat      = $('#add_mat').val();
        var file        = $('#file').val();
        //var disstatus = $('#add_disstatus').val();

        if(custtype == 'Bulk upload from Excel' && disonusrgrp == 'CUSTOMER'){
          var discust = $('#add_bulk_cust').val();
        }
        var uploaded_cust = $('#add_bulk_cust').val();
        
        if(mattype == 'Bulk upload from Excel' && dison == 'MATERIAL-GROUP'){
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

        if (dispromo == '') {
          $('.invalid-feedback-dispromo').fadeIn();
          $('#add_dismina').focus();
          $('.invalid-feedback-dispromo').text('Please enter promocode');
        }
        else{
          $('.invalid-feedback-dispromo').hide();
        }

        if (dispdes == '') {
          $('.invalid-feedback-dispdes').fadeIn();
          $('#add_dispdes').focus();
          $('.invalid-feedback-dispdes').text('Please enter promocode description');
        }
        else{
          $('.invalid-feedback-dispdes').hide();
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

        if (disfrom != '' && disto != '') {
          if(disfrom >= disto){
            $('.invalid-feedback-disto').fadeIn();
            $('#add_disto').focus();
            $('.invalid-feedback-disto').text('To Date should be greater than From Date');
          }else{
            $('.invalid-feedback-disto').hide();
          }
        }

        if (disonusrgrp == '') {
          $('.invalid-feedback-disonusrgrp').fadeIn();
          $('#add_disonusrgrp').focus();
          $('.invalid-feedback-disonusrgrp').text('Please select a "discount on user group" option');
        }
        else{
          $('.invalid-feedback-disonusrgrp').hide();
        }

        if(disonusrgrp == 'ZONE' && diszone == null){
          $('.invalid-feedback-diszone').fadeIn();
          $('#add_diszone').focus();
          $('.invalid-feedback-diszone').text('Please select atleast one zone');
        }
        else{
          $('.invalid-feedback-diszone').hide();
        }

        if(disonusrgrp == 'REGION' && disreg == null){
          $('.invalid-feedback-disreg').fadeIn();
          $('#add_disreg').focus();
          $('.invalid-feedback-disreg').text('Please select atleast one region');
        }
        else{
          $('.invalid-feedback-disreg').hide();
        }

        if(disonusrgrp == 'CUSTOMER' && custtype == 'Choose Customer' && discust == null){
          $('.invalid-feedback-discust').fadeIn();
          $('#add_discust').focus();
          $('.invalid-feedback-discust').text('Please select atleast one customer');
        }
        else{
          $('.invalid-feedback-discust').hide();
        }

        if(disonusrgrp == 'CUSTOMER' && custtype == 'Bulk upload from Excel' && uploaded_cust == ''){
          $('.invalid-feedback-excelfile-cust').fadeIn();
          $('#file_cust').focus();
          $('.invalid-feedback-excelfile-cust').text('Please upload an excel file').show();
        }
        else{
          $('.invalid-feedback-excelfile-cust').hide();
        }

        if (dison == '') {
          $('.invalid-feedback-dison').fadeIn();
          $('#add_dison').focus();
          $('.invalid-feedback-dison').text('Please select a discount on option');
        }
        else{
          $('.invalid-feedback-dison').hide();
        }

        if(dison == 'MATERIAL-GROUP' && dismatgrp == ''){
          $('.invalid-feedback-dismatgrp').fadeIn();
          $('#add_mat_grp').focus();
          $('.invalid-feedback-dismatgrp').text('Please select one material group');
        }
        else{
          $('.invalid-feedback-dismatgrp').hide();
        }

        if((dison == 'MATERIAL-GROUP' && dismatgrp != null && mattype == null)){
          $('.invalid-feedback-radiogrp').fadeIn();
          $('#allmat').focus();
          $('.invalid-feedback-radiogrp').text('Please select atleast one option');
        }
        else{
          $('.invalid-feedback-radiogrp').hide();
        }

        if(dison == 'MATERIAL-GROUP' && mattype == 'Choose Material' && dismat == null){
          $('.invalid-feedback-dismat').fadeIn();
          $('#add_dismat').focus();
          $('.invalid-feedback-dismat').text('Please select atleast one material');
        }
        else{
          $('.invalid-feedback-dismat').hide();
        }

        if(dison == 'MATERIAL-GROUP' && mattype == 'Bulk upload from Excel' && uploaded_mats == ''){
          $('.invalid-feedback-excelfile').fadeIn();
          $('#file').focus();
          $('.invalid-feedback-excelfile').text('Please upload an excel file').show();
        }
        else{
          $('.invalid-feedback-excelfile').hide();
        }
        
        // if((distype != '') && (dispromo != '') && (disfrom < disto) && (dispdes != '') && (disval != '') && (dismina != '') && (disfrom != '') && (disto != '') && ((disonusrgrp == 'ALL') || (disonusrgrp == 'CUSTOMER' && (discust != null || file_cust != '' || uploaded_cust != '')) || (disonusrgrp == 'REGION' && disreg != null) || (disonusrgrp == 'ZONE' && diszone != null) || (custtypeid == 'bulk_cust' && file_cust != null)) && ((dison == 'ALL') || (dison == 'MATERIAL-GROUP' && (dismat != null || file != '' || uploaded_mats != '')) || (mattypeid == 'bulk_mat' && file != null))){
        if((distype != '') && (dispromo != '') && (disfrom < disto) && (dispdes != '') && (disval != '') && (dismina != '') && (disfrom != '') && (disto != '') && (disonusrgrp != '') && (dison != '')){
          var data = {
            distype: distype,
            disval: disval,
            dismina: dismina,
            dispromo: dispromo,
            dispdes: dispdes,
            disfrom: disfrom,
            disto: disto,
            disonusrgrp: disonusrgrp,
            diszone: diszone,
            disreg: disreg,
            discust: discust,
            custtype: custtype,
            dison: dison,
            dismatgrp: dismatgrp,
            mattype: mattype,
            dismat: dismat,
            disstatus: ''
          };
          //console.log(data);
          $.ajax({
            url: '<?php echo base_url(); ?>admin/promocode/edit_globalpromocode', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#addModal').modal('toggle');
            toastr["info"]("", "success : One Global Promocode Data is Added Successfully.")
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
        //var disid     = $('#disid').val();console.log(disid);
        var distype     = $('#distype').val();
        var disval      = $('#disval').val();
        var dismina     = $('#dismina').val();
        var dispromo    = $('#dispromo').val();
        var dispdes     = $('#dispdes').val();
        var disfrom     = $('#disfrom').val();
        var disto       = $('#disto').val();
        var disonusrgrp = $('#dison').val();
        var diszone     = $('#diszone').val();
        var disreg      = $('#disreg').val();
        var discust     = $('#discust').val();
        var dison       = $('#dison').val();
        var dismatgrp   = $('#dismatgrp').val();
        var mattype     = $('#disallmat').val();
        var dismat      = $('#dismat').val();
        var id_x        = $('#id_x').val();
        //var disstatus = $('#disstatus').val();

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

        if (dispromo == '') {
          $('.invalid-feedback-edispromo').fadeIn();
          $('#dispromo').focus();
          $('.invalid-feedback-edispromo').text('Please enter promocode');
        }
        else{
          $('.invalid-feedback-edispromo').hide();
        }

        /* if (dispromo != '') {
          $.ajax({
            url: '<?php echo base_url(); ?>admin/promocode/check_promocode', // Replace with your API endpoint
            type: 'POST',
            data: {dispromo:dispromo},
            success: function(response) {
              // Request successful, do something with the response
              console.log(response);
              if (response == 1) {
                $('.invalid-feedback-edispromo').fadeIn();
                $('#dispromo').focus();
                $('.invalid-feedback-edispromo').text('Promocode already exists. Please try another!');
              } else {
                $('.invalid-feedback-edispromo').hide();
              }
            },
            error: function(xhr, status, error) {
              // Request failed, handle the error
              toastr["error"]("", "Failure : Something went wrong.")
              console.error(error);
            }
          });
        } */

        if (dispdes == '') {
          $('.invalid-feedback-edispdes').fadeIn();
          $('#dispdes').focus();
          $('.invalid-feedback-edispdes').text('Please enter promocode description');
        }
        else{
          $('.invalid-feedback-edispdes').hide();
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

        if (disfrom != '' && disto != '') {
          if(disfrom >= disto){
            $('.invalid-feedback-edisto').fadeIn();
            $('#disto').focus();
            $('.invalid-feedback-edisto').text('To Date should be greater than From Date');
          }else{
            $('.invalid-feedback-edisto').hide();
          }
        }
        
        if((distype != '') && (disval != '') && (disfrom < disto) && (dismina != '') && (dispromo != '') && (dispdes != '') && (disfrom != '') && (disto != '') && (dison != '')){
          var data = {
            distype: distype,
            disval: disval,
            id_x: id_x,
            dismina: dismina,
            dispromo: dispromo,
            dispdes: dispdes,
            disfrom: disfrom,
            disto: disto,
            disonusrgrp: disonusrgrp,
            diszone: diszone,
            disreg: disreg,
            discust: discust,
            custtype: custtype,
            dison: dison,
            dismatgrp: dismatgrp,
            mattype: mattype,
            dismat: dismat,
            disstatus: ''
          };

          $.ajax({
            url: '<?php echo base_url(); ?>admin/promocode/edit_globalpromocode', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
              // Request successful, do something with the response
              $('#myModal').modal('toggle');
              
              toastr["info"]("", "success : One Promocode Data is cloned Successfully.")
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
          var promocode = $('#distype').val();
          var distype   = $('#distype').val();
          var disval    = $('#disval').val();
          var dismina   = $('#dismina').val();
          var disfrom   = $('#disfrom').val();
          var disto     = $('#disto').val();
          var dison     = $('#dison').val();
          var disstatus = $('#disstatus').val();

          var data = {disid: disid, promocode: promocode, distype: distype, disval: disval, dismina: dismina, disfrom: disfrom, disto: disto, dison: dison, disstatus: disstatus};

          $.ajax({
            url: '<?php echo base_url(); ?>admin/promocode/delete_globalpromocode', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType:'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#myModal').modal('toggle');
            
            toastr["info"]("", "success : One Promocode Data is Deleted.")
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
        else{
          return false;
        }
      });

      $(document).on('click','#btn_matpromo',function(){
      $('#material_promo').modal('show');
      });

      $(document).on('click','#btn_custpromo',function(){
      $('#customer_promo').modal('show');
      });

      $(document).on('click','#btn_regpromo',function(){
      $('#region_promo').modal('show');
      });

      $(document).on('click','#btn_zonepromo',function(){
      $('#zone_promo').modal('show');
      });
    });
</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/group.js"></script>
<script src="<?php echo base_url(); ?>assets/js/toastr.min.js" type="text/javascript"></script>