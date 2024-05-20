           <style>
		   .help-block {
				color: red;
			}
		   </style>

             <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                
              <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-success"> <?= $this->session->flashdata('msg') ?> </div>
              <?php } ?>
                
                 <h3 class="page-title">Reset Password
                    </h3>
                    
                <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Reset password</span>
                            </li>
                        </ul>
                        
                    </div>

                    <div class="row ">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                          <div class="portlet light bordered">
                                
                              <div class="portlet-body">
                                    <form class="form-horizontal" name="password_form" id="password_form" role="form" action='<?php echo base_url();?>admin/home/changepasswordprocess' method="post">
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-md-2 control-label">Old Password</label>
                                            <div class="col-md-4">
                                                <input type="password" class="form-control" id="old_password" placeholder="Old Password" name="old_password"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword12" class="col-md-2 control-label">New Password</label>
                                            <div class="col-md-4">
                                                <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password"> </div>
                                        </div> 
                                        
                                        
                                     <!--   <div class="form-group"> 
                                            <label for="inputPassword12" class="col-md-2 control-label">Confirm Password</label>
                                            <div class="col-md-4">
                                                <input type="password" class="form-control" id="con_password" placeholder="Confirm Password" name="con_password"> </div>
                                        </div>-->
                                       
                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-md-10">
                                                <button type="submit" class="btn blue">Sign in</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                          </div>
                            <!-- END SAMPLE FORM PORTLET-->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
        </div>
        <!-- END CONTAINER -->
 