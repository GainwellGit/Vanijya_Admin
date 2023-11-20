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
          <span>Log files</span>
          </li>
          </ul>
          
          </div>
          <div class="content">
         
             
          <div class="row" style="margin-bottom:20px; ">
            <div class="col-xs-12">
           
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Log List</div>
                                    <div class="tools1"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                
                                                <th> Name</th>
                                                <th> Date</th>
                                                <th> status </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                          <?php if (!empty($log)){ 
                                                foreach( $log as $logs){ ?>
                                            <tr>
                                            
                                            
                                            <td><?php echo isset($logs['file']) ? $logs['file'] : ''; ?></td>
                                            <td><?php echo isset($logs['date']) ? $logs['date'] : ''; ?></td>
                                            <td>
                                              <a href="<?php echo base_url(); ?>admin/home/download_log/<?php echo $logs['file'] ?>">
                                                <button style="padding: 4px 9px; border: none; border-radius: 7px !important; background: #3ea949; color: white;">Download</button>
                                              </a>
                                            </td>
                                           
                                            </tr>

                                          <?php } } ?>
                                        
                                            
                                           
                                            
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



 <style type="text/css">
   .dt-buttons {
    display: none;
  }
 </style>

 <script type="text/javascript">
   
  $(document).ready(function(){

    $('.switch').change(function (event) {
      var email = $(this).data("id");
        var r = confirm("Are you confirm ?");
        if (r == true) {
          $.ajax({
            method: "POST",
            url: "<?php echo site_url('/admin/home/changestatus'); ?>", 
            data:{email: email},
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            datatype : "json",
            success: function(response)
            {
              //alert('11111');
              console.log(response);
            },
            error: function( error )
            {   
                $('#type').find('option').not(':first').remove();
            }

          });
        } else {
          txt = "You pressed Cancel!";
        }
    
    });

  })

 </script>







<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/group.js"></script>
 


