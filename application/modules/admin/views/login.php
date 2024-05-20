<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Login to PMKIT dashboard</title>
    <!-- Favicon -->

    <!-- Fonts -->
    

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
     <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  
    <!-- Argon CSS -->
    <link href="<?php echo base_url(); ?>assets/css/nucleo" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/main-style.css?v=1.1.0" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" /></head>

    
</head>

<body class="bg-default">
<!-- Main content -->
<div class="main-content">


    <!-- Header -->
    <div class="header bg-gradient-primary py-5">
        <span><img src="https://qapps.gainwellindia.com/gcpl/ruep/assets/logo/logo.gif" alt="logo" class="logo-default" style="margin-top: -58px;"></span>
        <div class="container">
        
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <!-- <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white font-weight-500">Welcome!</h1>
                        <p class="text-lead text-white">Use this for login to <strong>PMKIT</strong> portal. Put your credentials below</p> 
                    </div> -->
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-2"><img src="<?php echo base_url();?>assets/pages/img/Gainwell-logo.png" style="width: 316px"></div>
                        <div class="btn-wrapper text-center">
                           <!--  <a href="#" class="btn btn-neutral btn-icon login-btc">
                                <span class="btn-inner--text">PMKIT</span>
                            </a> -->
                        </div>
                    </div>

                
                    <?php if ($this->session->flashdata('msg')) { ?>
                        <div class="alert alert-success"> <?= $this->session->flashdata('msg') ?> </div>
                    <?php } ?>

                    <div class="card-body px-lg-5 pt-lg-5 pb-lg-4">
                        <form class="login-form" name="login_form" id="login_form" action='<?php echo base_url('admin/Authentication/loginprocess');?>' method="post" role="form">
                            
                            
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></i></span>
                                    </div>
                                    
                                    <input type="text" name="username" class="form-control" placeholder="User name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></i></span>
                                    </div>

                                    <input type="password" name="password" class="form-control" placeholder="Your password" required>
                                </div>
                            </div>
                            <!-- <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">Remember me</span>
                                </label>
                            </div> -->
                            <div class="text-center">
                                
                                <input class="btn btn-primary my-4" type="submit" value="Login">
                                <!--<button type="button" class="btn btn-primary my-4">Sign in</button>-->
                            </div>
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-12">
                <div class="copyright text-center text-muted">
                    &copy; 2021 <b class="font-weight-bold ml-1" target="_blank">Gainwellindia pvt. ltd.</b>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?php echo base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
</body>

</html>
