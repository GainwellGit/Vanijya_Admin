<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD --><head>
        <meta charset="utf-8" />
        <title>Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url()?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url()?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url()?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url()?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        <link href="<?php echo base_url(); ?>assets/layouts/layout/css/datatable.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/datepicker.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/css/croppie.css" rel="stylesheet" type="text/css" /> 

        <link href="<?php echo base_url()?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url()?>assets/css/summernote.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/picker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/toastr.min.css" rel="stylesheet">
        
   
   <!-- <link href="<?php //echo base_url()?>assets/css/bootstrap.css" rel="stylesheet">  -->
    
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/global/scripts/datatable.js" type="text/javascript"></script> 
	<script src="<?php echo base_url()?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script> 
	<script src="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script> 
    <script src="<?php echo base_url(); ?>assets/layouts/layout/boostrap/boostrap.min.js"></script>       
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-toggle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/scripts/ui-confirmations.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
    <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datepicker.js">" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/js/summernote.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>

  
         



<style type="text/css">
.page-logo > h3 {
    color: #fff;
    margin-top: 8px;
}

</style>

<?php
$link = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];;
$link_array = explode('/',$link);
$page = end($link_array);
$uervalue=array("customer","reconciliation","Usercoupon","location","material_group",'group','zone','history');
$errorvalue=array("customer_exception_list","region_exception_list","group_exception_list");
$planthubvalue=array("hublist","plantlist");
?> 
    </head>
    <!-- END HEAD -->
     <!-- <div class="dvLoading1" style="display: block;"></div>-->
        <body class="page-header-fixed page-sidebar-closed-hide-logo">

        <!-- BEGIN HEADER -->
      
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?php echo base_url('/admin/home')?>" style="margin-top: 9px; font-size: 20px; font-style: italic; font-weight: 700;text-decoration: none;">
                        <span class="logo-default">GAINWELL</span>
                        </a>

                    
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                <span class="dtime"><?php echo date('D , j M Y'); ?> </span> 
                    <ul class="nav navbar-nav pull-right">
 
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="<?php echo base_url()?>assets/layouts/layout/img/avatar3_small.png" />
                                <span class="username username-hide-on-mobile"> Admin</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo base_url()?>admin/authentication/logout">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                      
                    </ul>
                </div>

                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
          
          <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                   
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    <!--     <li class="sidebar-toggler-wrapper hide"> -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                           <!--  <div class="sidebar-toggler"> </div> -->
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        <!-- </li> -->
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                          
                           <!--  <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a> -->
                                <!--<div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                                </div>-->
                          <!--   </form> -->
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
                        
                        <li class="nav-item start <?php echo ($page=='admin')?'active':'';?>">
                           <a href="<?php echo base_url('admin'); ?>" class="nav-link ">
                                        <i class="fa fa-dashboard"></i>
                                        <span class="title">Quick Link</span>
                                        <span class="selected"></span>
                           </a>
                        </li> 
						
						<li class="nav-item <?php echo (!empty(array_intersect($uervalue,$link_array))  && !in_array('order', $link_array) && !in_array('mapping', $link_array) && !in_array('surcharge', $link_array) && !in_array('empaccess', $link_array) && !in_array('orderSearch', $link_array) && !in_array('createmapping', $link_array) )?'active':'';?> ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Order Managment </span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php $a5=array("reconciliation"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/history/reconciliation'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Reconciliation</span> 
                                     </a>   
                                </li>
							</ul>
                        </li>
						
						
                        

                        <!--<li class="nav-item <?php echo ($page=='Group' || $page=='group' )?'active':'';?>">
                           <a href="<?php echo base_url('admin/Group'); ?>" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title"> Group</span>
                           </a>
                        
                        </li>
                        <li class="nav-item <?php echo ($page=='users')?'active':'';?>">
                           <a href="<?php echo base_url('admin/users'); ?>" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title"> Users</span>
                           </a>
                        
                        </li> -->   
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Discount</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php $a5=array("customer","Usercoupon"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/customer'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Setup Customer Wise Discount</span> 
                                     </a>   
                                </li>
                                <?php $a4=array("location"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a4,$link_array)) && !in_array('zone',$link_array))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/location'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Setup Region Wise Discount</span> 
                                     </a>   
                                </li>
                                <?php $a3=array("material_group","group"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a3,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/material_group'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Setup Material Group Wise Discount</span> 
                                     </a>   
                                </li>
                                <?php $a2=array("flat","zone"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a2,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/zone'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Setup Zone Wise Discount</span> 
                                     </a>   
                                </li>
                                <li class="nav-item <?php echo ($page=='history' || $page=='getsearch')?'active':'';?>">
                                    <a href="<?php echo base_url('admin/history'); ?>" class="nav-link ">
                                                <i class="fa fa-bar-chart"></i>
                                                <span class="title"> Discount History</span>
                                                <span class="selected"></span>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li class="nav-item <?php echo (!empty(array_intersect($errorvalue,$link_array)))?'active':'';?> ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Exception List</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php $a5=array("customer_exception_list"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/customer_exception_list'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Customer Exception List</span> 
                                     </a>   
                                </li>
                                <?php $a4=array("region_exception_list"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a4,$link_array)) && !in_array('zone',$link_array))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/region_exception_list'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Region Exception List</span> 
                                     </a>   
                                </li>
                                <?php $a3=array("group_exception_list"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a3,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/group_exception_list'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Material Group Exception List</span> 
                                     </a>   
                                </li>
                                
                               


                            </ul>
                        </li>
                        
                        <li class="nav-item <?php echo (!empty(array_intersect($planthubvalue,$link_array)))?'active':'';?> ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Plant Hub Data</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php $a5=array("hublist"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/hub/hublist'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Hub Master List</span> 
                                     </a>   
                                </li>
                                <?php $a4=array("plantlist"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a4,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/hub/plantlist'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Plant Master List</span> 
                                     </a>   
                                </li>
                            </ul>
                        </li>
                        
                       <?php $a1=array("edit_mapping","add_mapping","create_mapping"); ?>
                        <li class="nav-item <?php echo (!empty(array_intersect($a1,$link_array)))?'active':'';?>">
                            <a href="<?php echo base_url('admin/pmkit'); ?>" class="nav-link ">
                                        <i class="fa fa-puzzle-piece"></i>
                                        <span class="title">Machine Model and PM KIT Mapping</span>
                                        <span class="selected"></span>

                            </a>
                        </li>

                        <?php $a1=array("promotion"); ?>
                        <li class="nav-item <?php echo (!empty(array_intersect($a1,$link_array)))?'active':'';?>">
                            <a href="<?php echo base_url('admin/promotion/list'); ?>" class="nav-link ">
                                        <i class="fa fa-puzzle-piece"></i>
                                        <span class="title">Promotion</span>
                                        <span class="selected"></span>

                            </a>
                        </li>

                        <?php $order=array("mapping","createmapping"); ?>
                        <li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                            <a href="<?php echo base_url('admin/location/mapping'); ?>" class="nav-link ">
                                        <i class="fa fa-puzzle-piece"></i>
                                        <span class="title">Region Maping</span>
                                        <span class="selected"></span>

                            </a>
                        </li>

                        <?php $order=array("surcharge"); ?>
                        <li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                            <a href="<?php echo base_url('admin/location/surcharge');?>" class="nav-link ">
                                <i class="fa fa-puzzle-piece"></i>
                                <span class="title">Plant Surcharge</span>
                                <span class="selected"></span>
                            </a>
                        </li>

                        <?php $order=array("empaccess"); ?>
                        <li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                            <a href="<?php echo base_url('admin/empaccess/list');?>" class="nav-link ">
                                <i class="fa fa-puzzle-piece"></i>
                                <span class="title">Employee App Access</span>
                                <span class="selected"></span>
                            </a>
                        </li>

                        <?php $a1=array("undeliverable"); ?>
                        <li class="nav-item <?php echo (!empty(array_intersect($a1,$link_array)))?'active':'';?>">
                            <a href="<?php echo base_url('admin/undeliverable/partlist'); ?>" class="nav-link ">
                                <i class="fa fa-puzzle-piece"></i>
                                <span class="title">Undeliverable Part List</span>
                                <span class="selected"></span>

                            </a>
                        </li>
                        
                        <?php $master=array("machine_model","material_bom","material","machine_model_list","machine_model_edit"); ?>
                         <li class="nav-item <?php echo (!empty(array_intersect($master,$link_array)))?'active':'';?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Master Data</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php $a5=array("machine_model"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/home/machine_model'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Machine Model</span> 
                                     </a>   
                                </li>

                                <?php $a5=array("material_bom"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/home/material_bom'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Material Bom</span> 
                                     </a>   
                                </li>

                                <?php $a5=array("material"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/home/material'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Material</span> 
                                     </a>   
                                </li>

                                <?php $a5=array("machine_model_list","machine_model_edit"); ?>
                                <li class="nav-item <?php echo (!empty(array_intersect($a5,$link_array)))?'active':'';?>  "> 
                                <a href="<?php echo base_url('admin/home/machine_model_list'); ?>" class="nav-link ">
                                        <i class="fa fa-circle-o"></i>
                                        <span class="title">Bulk Image Upload</span> 
                                     </a>   
                                </li>
								
                            </ul>
                        </li>
						
						<?php $order=array("email"); ?>
						<li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
							<a href="<?php echo base_url('admin/home/email'); ?>" class="nav-link ">
										<i class="fa fa-puzzle-piece"></i>
										<span class="title">Email Setting</span>
										<span class="selected"></span>

							</a>
						</li>
						
						<?php $order=array("log"); ?>
                            <li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                                <a href="<?php echo base_url('admin/home/log'); ?>" class="nav-link ">
                                            <i class="fa fa-puzzle-piece"></i>
                                            <span class="title">Log Files</span>
                                            <span class="selected"></span>

                                </a>
                            </li> 
                        <?php $order=array("serverlog"); ?>
                            <li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                                <a href="<?php echo base_url('admin/home/serverlog'); ?>" class="nav-link ">
                                            <i class="fa fa-puzzle-piece"></i>
                                            <span class="title">Server Log</span>
                                            <span class="selected"></span>

                                </a>
                            </li> 
					    <?php $master=array("order","report"); ?>
                            <li class="nav-item <?php echo (!empty(array_intersect($master,$link_array)))?'active':'';?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-settings"></i>
                                        <span class="title">Reports</span>
                                        <span class="selected"></span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">

                                       <?php $order=array("order","orderSearch"); ?>
                                        <li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                                            <a href="<?php echo base_url('admin/history/order'); ?>" class="nav-link ">
                                                        <i class="fa fa-puzzle-piece"></i>
                                                        <span class="title">Order Report</span>
                                                        <span class="selected"></span>

                                            </a>
                                        </li>

                                        <?php $order=array("report"); ?>
                                        <li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                                            <a href="<?php echo base_url('admin/pmkit/report'); ?>" class="nav-link ">
                                                        <i class="fa fa-puzzle-piece"></i>
                                                        <span class="title">PMKIT Mapping Report</span>
                                                        <span class="selected"></span>

                                            </a>
                                        </li>
										<li class="nav-item <?php echo (!empty(array_intersect($order,$link_array)))?'active':'';?>">
                                            <a href="<?php echo base_url('admin/history/payment'); ?>" class="nav-link ">
                                                        <i class="fa fa-puzzle-piece"></i>
                                                        <span class="title">Payment Report</span>
                                                        <span class="selected"></span>

                                            </a>
                                        </li>
                                       
                                    </ul> 
									


    
                    </ul>
                     

                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
          
     
         
    