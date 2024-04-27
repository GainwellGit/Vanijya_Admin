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
                        <span>Plant Surcharge List</span>
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
                            <div class="portlet-title">
                                <div class="caption"><i class="fa fa-globe"></i>Plants List For Surcharge </div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Plant Code </th>
                                            <th> Plant Name </th>
                                            <th> City Name </th>
                                            <th> PO Code </th>
                                            <th> Region Code </th>
                                            <th> Surcharge (in %) </th>
                                            <th> Update Detail </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($locationlist)){
                                            $counter = 1;
                                            foreach ($locationlist as $location) {
                                                $this->db->select('*');
                                                $this->db->where('plant_code',$location['plant_code']);
                                                $this->db->where('region_code',$location['region_code']);
                                                $query = $this->db->get('plant_surcharge');
                                                $cnt = $query->row_array();
                                                $surcharge = $cnt['surcharge'];
                                                $surcharge = (!empty($surcharge)) ? $surcharge : "";

                                                $this->db->select('*');
                                                $this->db->from('plant_surcharge_audit');
                                                $this->db->where('plant_code',$location['plant_code']);
                                                $this->db->where('region_code',$location['region_code']);
                                                $this->db->order_by("id", "desc");
                                                $this->db->limit(1);
                                                $fetch_data = $this->db->get()->row();
                                                $old_surcharge = ($fetch_data->old_surcharge=='') ? '' : $fetch_data->old_surcharge ;
                                                $new_surcharge = ($fetch_data->new_surcharge=='') ? '' : $fetch_data->new_surcharge ;
                                                $changed_on = ($fetch_data->changed_on=='') ? '' : $fetch_data->changed_on ;
                                                $changed_by = ($fetch_data->changed_by=='') ? '' : $fetch_data->changed_by ;
                                                if($old_surcharge!='' or $new_surcharge!='')
                                                    $upd_detail = 'Surcharge changed by '.$changed_by.' on '.$changed_on.' from '.$old_surcharge.' to '.$new_surcharge;
                                                else
                                                    $upd_detail = '';
                                                ?> 
                                                <tr>
                                                <td><span><?php echo $counter ;?></span></td>
                                                <td><span id="pntc-<?php echo $counter; ?>"><?php echo $location['plant_code'] ;?></span></td>
                                                <td><span id="pntn-<?php echo $counter; ?>"><?php echo $location['plant_name'] ;?></span></td>
                                                <td><span id="ctyn-<?php echo $counter; ?>"><?php echo $location['city_name'] ;?></span></td>
                                                <td><span id="pocd-<?php echo $counter; ?>"><?php echo $location['po_code'] ;?></span></td>
                                                <td><span id="regc-<?php echo $counter; ?>"><?php echo $location['region_code'] ;?></span></td>
                                                <td><span id="pnts-<?php echo $counter; ?>"><?php echo $surcharge ;?></span></td>
                                                <td><span id="pupd-<?php echo $counter; ?>"><?php echo $upd_detail ;?></span></td>
                                                <td><a data-id="<?php echo $counter ;?>" data-sur="<?php echo $surcharge ;?>" data-val="<?php echo $location['plant_code']; ?>" href="#" class="popupDynamic" ><i class="fa fa-pencil-square-o"></i></a></td>
                                                <!--<td> <a href="<?php //echo base_url('admin/location/addsurcharge/'.$location['region_code']); ?>"><i class="fa fa-pencil-square-o"></i></a> </td>-->
                                            </tr>

                                        <?php  $counter ++;} }?>    
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
  </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Surcharge Value</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr"> Plant Code </label>
                    <input type="text" maxlength="4" disabled required class="form-control" id="plant_code">
                </div>
                <div class="form-group">
                    <label for="usr"> Plant Name </label>
                    <input type="text" maxlength="40" disabled required class="form-control" id="plant_name">
                </div>
                <div class="form-group">
                    <label for="usr"> City Name </label>
                    <input type="text" maxlength="40" disabled required class="form-control" id="city_name">
                </div>
                <div class="form-group">
                    <label for="usr"> PO Code </label>
                    <input type="text" maxlength="10" disabled required class="form-control" id="po_code">
                </div>
                <div class="form-group">
                    <label for="usr"> Region Code </label>
                    <input type="text" maxlength="3" disabled required class="form-control" id="region_code">
                </div>

                <div class="form-group">
                    <label for="usr"> Surcharge (in %)</label>
                    <input type="text" maxlength="11" required class="form-control" id="plant_surcharge">
                    <!--<input type="hidden" maxlength="4" required class="form-control" id="plant_code">-->
                    <input type="hidden" maxlength="3" required class="form-control" id="id_x">

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


<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/group.js"></script>
<script src="<?php echo base_url(); ?>assets/js/toastr.min.js" type="text/javascript"></script>
 
<style type="text/css">
   .dt-buttons{display: none;}
</style>

<script type="text/javascript">
$(".popupDynamic").click(function(){
        //var plant_code = $(this).data('val');
        var id_x   = $(this).data('id');
        var sur_ch = $(this).data('sur');
        if(sur_ch == ''){
            $('#delete_form').hide();
        }else{
            $('#delete_form').show();
        }

        //$('#plant_code').val(plant_code);
        //$('#display_name').val($('#dsp-'+id_x).text());
        $('#id_x').val(id_x);

        $('#plant_code').val($('#pntc-'+id_x).text());
        $('#plant_name').val($('#pntn-'+id_x).text());
        $('#city_name').val($('#ctyn-'+id_x).text());
        $('#po_code').val($('#pocd-'+id_x).text());
        $('#region_code').val($('#regc-'+id_x).text());
        $('#plant_surcharge').val($('#pnts-'+id_x).text());
        $("#myModal").modal('show');
    });     
$(document).ready(function(){
	/*
    $(".popupDynamic").click(function(){
        //var region_code = $(this).data('val');
        var id_x   = $(this).data('id');
        var sur_ch = $(this).data('sur');
        if(sur_ch == ''){
            $('#delete_form').hide();
        }else{
            $('#delete_form').show();
        }

        //$('#region_code').val(region_code);
        //$('#display_name').val($('#dsp-'+id_x).text());
        $('#id_x').val(id_x);

        $('#region_code').val($('#pntc-'+id_x).text());
        $('#region_name').val($('#pntn-'+id_x).text());
        $('#region_surcharge').val($('#pnts-'+id_x).text());
        $("#myModal").modal('show');
    });
	*/
    $("#plant_surcharge").keyup(function(){
        var plant_surcharge = $(this).val();
        if (plant_surcharge == '') {
            $('.invalid-feedback').fadeIn();                
        }
        $('.invalid-feedback').hide();
    });
    $("#submit_form").click(function(){
        $('.invalid-feedback').hide();
        var plant_surcharge = $('#plant_surcharge').val();
        var plant_code = $('#plant_code').val();
        var plant_name = $('#plant_name').val();
        var city_name = $('#city_name').val();
        var po_code = $('#po_code').val();
        var region_code = $('#region_code').val();
        var id_x = $('#id_x').val();

        if (plant_surcharge == '') {
            $('.invalid-feedback').fadeIn();
            $('#plant_surcharge').focus();
            $('.invalid-feedback').text('Please enter surcharge value');
            return false;
        }else{
            $('.invalid-feedback').hide();

            var data = {
                plant_surcharge: plant_surcharge,
                plant_code: plant_code,
                plant_name: plant_name,
                city_name: city_name,
                po_code: po_code,
                region_code: region_code
            };

            $.ajax({
                url: '<?php echo base_url(); ?>/admin/location/addsurcharge', // Replace with your API endpoint
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                // Request successful, do something with the response
                $('#pnts-'+id_x).text(plant_surcharge);
                $('#myModal').modal('toggle');
                
                toastr["info"]("", "success : Plant subcharge Data Updated.")
                console.log(response);
                },
                error: function(xhr, status, error) {
                // Request failed, handle the error
                toastr["error"]("", "Failure : Something went wrong.")
                console.error(error);
                }
            });
            $(document).ajaxStop(function(){
                setTimeout(function(){// wait for 5 secs(2)
                    window.location.reload(); // then reload the page.(3)
                }, 1000); 
            });
        }
    });
    $("#delete_form").click(function(){
        $('.invalid-feedback').hide();
        var plant_code = $('#plant_code').val();
        var region_code = $('#region_code').val();
        var id_x = $('#id_x').val();
        var plant_surcharge = '';
        var data = {plant_code: plant_code,plant_surcharge: plant_surcharge,region_code: region_code};

        $.ajax({
            url: '<?php echo base_url(); ?>/admin/location/deletesurcharge', // Replace with your API endpoint
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
            // Request successful, do something with the response
            $('#pnts-'+id_x).text(plant_surcharge);
            $('#myModal').modal('toggle');
            
            toastr["info"]("", "success : Plant subcharge Deleted.")
            console.log(response);
            },
            error: function(xhr, status, error) {
            // Request failed, handle the error
            toastr["error"]("", "Failure : Something went wrong.")
            console.error(error);
            }
        });
        $(document).ajaxStop(function(){
            setTimeout(function(){// wait for 5 secs(2)
                window.location.reload(); // then reload the page.(3)
            }, 1000); 
        });
    });
});

</script>

