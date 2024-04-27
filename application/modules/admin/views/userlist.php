		<style>
		.btn-error {
			background-color: #FF3F3F;
			border-color: #FF3F3F;
			color: #fff;
		}
		</style>
           <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER--> 
                          
                    <?php //print_r($user_details); ?>
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Userlist</span>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                               
                                <div class="portlet-body">
                                 <div class="row flashmsg"></div>   
                                
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                            </div>
                                          
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                        <thead>
                                            <tr>
                                                <th> No </th>
                                                <th> Username </th>
                                                <th> First Name </th>
                                                <th> Last Name </th>
                                                <th> email </th>
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                         <?php 
										 if(!empty($user_details)){
                                            $counter = 1;
										 foreach($user_details as $data){ ?>
                                            <tr>
                                                <td><?php echo $counter ?> </td>
                                                <td><?php echo $data['username'] ?> </td>
                                                <td><?php echo $data['first_name'] ?> </td>
                                                <td><?php echo $data['last_name'] ?> </td>
                                                <td><?php echo $data['email'] ?> </td>                
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
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
      
        </div>
        <!-- END CONTAINER -->
       