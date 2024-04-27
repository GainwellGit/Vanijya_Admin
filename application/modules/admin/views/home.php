
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
            
             <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-success"> <?= $this->session->flashdata('msg') ?> </div>
              <?php } ?>
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <!-- <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                        
                    </div> -->
                    <!-- END PAGE BAR -->
                    <!-- END PAGE HEADER-->
                    <div class="row widget-row">
                    
                       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details">
                                    <div class="number"> 
                                        <span data-counter="counterup" data-value="89"><?php echo $customer;?></span></div>
                                    <div class="desc"> Customer </div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/customer"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    
                       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-bar-chart-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="12,5"><?php echo $totalLocation;?></span></div>
                                    <div class="desc"> Region </div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/location"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349"><?php echo $totalgroup;?></span>
                                    </div>
                                    <div class="desc">Material Group</div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/material_group"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349"><?php echo $totalzone;?></span>
                                    </div>
                                    <div class="desc">Zone</div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/zone"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349"><?php echo $totalmapping;?></span>
                                    </div>
                                    <div class="desc">Machine Model and PM KIT Mapping</div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/pmkit"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349"><?php echo $totalpromotion;?></span>
                                    </div>
                                    <div class="desc">Promotion</div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/promotion/list"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="12,5"><?php echo $orderReconciliation;?></span></div>
                                    <div class="desc"> Orders For Reconciliation </div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/history/reconciliation"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
						
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="12,5"><?php echo $shared_cart;?></span></div>
                                    <div class="desc"> Carts Shared </div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/home/cart_shared"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
						
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="12,5"><?php echo $used_shared_cart;?></span></div>
                                    <div class="desc"> Shared Carts Used </div>
                                </div>
                                <a class="more" href="<?php echo base_url()?>admin/home/shared_cart_used"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>




                    </div>
                    
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            
            
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        
       
      
   