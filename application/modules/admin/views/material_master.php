<html>
<head>
 <link href="<?php echo base_url(); ?>assets/css/toastr.min.css" rel="stylesheet">

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
          <span>Master Data</span>
          </li>
          </ul>
          <br><br>
          
             
          </div>
          
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
            <div class="form-group pull-right">
             
      		</div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Material Master Data</div>
                                    <div class="tools1"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Material No </th>
                                                <th> Description </th>
                                                <th>Colloquial Name</th>

                                                <th> Type </th>
                                                <th> Group </th>
                                                <th> UOM</th>
                                                <th> HSN Code </th>
                                                <th> Source </th>
                                                <th> Last update </th>
                                                <th> Price </th>
                                                <th> Price update date </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 

                                          if(!empty($material)){
                                            $counter = 1;
                                            
                                            foreach ($material as $key=>$value) {

                                           

                                                $this->db->select('*');
                                               // $this->db->from('material_display_name');
                                                $this->db->where('material_number',$value['material_no']);
                                                $query = $this->db->get('material_display_name');
                                                $cnt = $query->row_array();
                                                $display_name = $cnt['display_name'];
                                                $display_name = (!empty($display_name)) ? $display_name : '';

                                                $this->db->select('price, last_update_dt');
                                                $this->db->where('material_code',$value['material_no']);
                                                $query = $this->db->get('price_master');
                                                $cnt1 = $query->row_array();
                                                $splitTimeStamp = explode(" ",$cnt1['last_update_dt']);
                                                $priceUpdateDate = $splitTimeStamp[0];
                                                $priceUpdatetime = $splitTimeStamp[1];

                                                $this->db->select('updated_date');
                                                $this->db->where('material_no',$value['material_no']);
                                                $query = $this->db->get('material_master');
                                                $cnt2 = $query->row_array();
                                                $splitTimeStamp = explode(" ",$cnt2['updated_date']);
                                                $materialUpdateDate = $splitTimeStamp[0];
                                                $materialUpdatetime = $splitTimeStamp[1];
                                            ?>

                            <tr>
                                <td><span><?php echo  $counter ;?></span></td>
                                <td><span id="mtn-<?php echo  $counter; ?>"><?php echo  $value['material_no'] ;?></span></td>
                                <td><span id="md-<?php echo  $counter; ?>"><?php echo  $value['material_description'] ;?></span></td>
                                <td><span id="dsp-<?php echo  $counter; ?>"><?php echo  $display_name ;?></span></td>
                                <td><span id="mt-<?php echo  $counter; ?>"><?php echo  $value['material_type'] ;?></span></td>
                                <td><span id="mg-<?php echo  $counter; ?>"><?php echo  $value['material_group'] ;?></span></td>
                                <td><span id="mu-<?php echo  $counter; ?>"><?php echo  $value['material_UOM'] ;?> </span></td>
                                <td><span id="hc-<?php echo  $counter; ?>"><?php echo  $value['hsn_code'] ;?></span></td>
                                <td><span id="source-<?php echo  $counter; ?>"><?php echo  $value['source'] ;?></span></td>
                                <td><span id="lmup-<?php echo  $counter; ?>"><?php echo  $materialUpdateDate.'<br>'.$materialUpdatetime ;?></span></td>
                                <td><span id="price-<?php echo  $counter; ?>"><?php echo  $cnt1['price'] ;?></span></td>
                                <td><span id="lprup-<?php echo  $counter; ?>"><?php echo  $priceUpdateDate.'<br>'.$priceUpdatetime ;?></span></td>                                
                                <td><a data-id="<?php echo  $counter ;?>" data-dip="<?php echo $display_name; ?>" data-val="<?php echo $value['material_no']; ?>" href="#" class="popupDynamic" ><i class="fa fa-pencil-square-o"></i></a></td>
                                                
                                            </tr>

                                        <?php  $counter ++; } }?>
                                            
                                           
                                            
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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Display Name</h4>
        </div>
        <div class="modal-body">
         <div class="form-group">
            <label for="usr"> Material No </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_no">
         </div>
         <div class="form-group">
            <label for="usr">  Description </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="description">
         </div>

         <div class="form-group">
          <label for="usr">Colloquial Name</label>
          <input type="text" maxlength="150" required class="form-control" id="display_name">
          <input type="hidden" maxlength="150" required class="form-control" id="material_number">
          <input type="hidden" maxlength="150" required class="form-control" id="id_x">

          <div class="invalid-feedback" style="color:red;"></div>
         </div>

         <div class="form-group">
            <label for="usr"> Type </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_type">
         </div>
         <div class="form-group">
            <label for="usr"> Group </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_group">
         </div>
         <div class="form-group">
            <label for="usr"> UOM</label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_uom">
         </div>
         <div class="form-group">
            <label for="usr"> HSN Code </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_hsn_code">
         </div>
         <div class="form-group">
            <label for="usr"> Source </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_source">
         </div>
         <div class="form-group">
            <label for="usr"> Last update </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_lmup">
         </div>
         <div class="form-group">
            <label for="usr"> Price </label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_price">
         </div>                                    
         <div class="form-group">
            <label for="usr"> Price update Date</label>
            <input type="text" maxlength="150" disabled required class="form-control" id="material_lprup">
         </div>
        <div class="form-group">
            <button type="button" id="submit_form" class="btn btn-primary">Save</button>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
 

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/toastr.min.js" type="text/javascript"></script>

 <script type="text/javascript">
     
     $(document).ready(function(){


        $(".popupDynamic").click(function(){
            var material_number = $(this).data('val');
            var display_name    = $(this).data('dip');
            var id_x            = $(this).data('id');

            $('#material_number').val(material_number);
            $('#display_name').val($('#dsp-'+id_x).text());
            $('#id_x').val(id_x);

            $('#material_no').val($('#mtn-'+id_x).text());
            $('#description').val($('#md-'+id_x).text());
            $('#material_type').val($('#mt-'+id_x).text());
            $('#material_group').val($('#mg-'+id_x).text());
            $('#material_uom').val($('#mu-'+id_x).text());
            $('#material_hsn_code').val($('#hc-'+id_x).text());
            $('#material_source').val($('#source-'+id_x).text());
            $('#material_price').val($('#price-'+id_x).text());
            $('#material_lprup').val($('#lprup-'+id_x).text());
            $('#material_lmup').val($('#lmup-'+id_x).text());
            $("#myModal").modal('show');
        });
        $("#display_name").keyup(function(){
            var display_name = $(this).val();
            if (display_name == '') {
                $('.invalid-feedback').fadeIn();                
            }
            $('.invalid-feedback').hide();
        });
        $("#submit_form").click(function(){
            $('.invalid-feedback').hide();
            var display_name = $('#display_name').val();
            var material_number = $('#material_number').val();
            var id_x = $('#id_x').val();


            if (display_name == '') {
                $('.invalid-feedback').fadeIn();
                $('#display_name').focus();
                $('.invalid-feedback').text('Please enter display name');
                return false;
            }else{
            $('.invalid-feedback').hide();

            var data = {
              display_name: display_name,
              material_number: material_number
            };

            $.ajax({
              url: '<?php echo base_url(); ?>/admin/home/material_display_name', // Replace with your API endpoint
              type: 'POST',
              data: data,
              dataType: 'json',
              success: function(response) {
                // Request successful, do something with the response
                $('#dsp-'+id_x).text(display_name);
                $('#myModal').modal('toggle');
               

                toastr["info"]("", "success : Material Data Updated.")
                console.log(response);
              },
              error: function(xhr, status, error) {
                // Request failed, handle the error
                toastr["error"]("", "Failure : Something went wrong.")
                console.error(error);
              }
            });



            }


        });

    });

 </script>
 


