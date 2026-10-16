<!DOCTYPE html>
<html>
      <head>
      <style>
.ck-editor__editable_inline {
    min-height: 150px;
}
	.editimg img{
		max-height:250px;
		max-width:250px;
		}
	

</style>
      
     <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">
      
      
      <meta charset="UTF-8">
      <title>
      <?php if(@$seo_title){echo $seo_title;} else{ echo "Dashboard -  Admin"; }?>
      </title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.4 -->
      <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/css/timepicker.css" rel="stylesheet" type="text/css" />
      <!-- Font Awesome Icons -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <!-- Ionicons -->
      <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
      <!-- jvectormap -->
      <link href="<?php echo base_url();?>assets/admin/js/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/js/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- Theme style -->
      <link href="<?php echo base_url();?>assets/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/css/styles1.css" rel="stylesheet" type="text/css" />
      <!-- AdminLTE Skins. Choose a skin from the css/skins	
	<!-- alertfy css -->

      <link href="<?php echo base_url();?>assets/admin/js/alertify/alertify.core.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/js/alertify/alertify.default.css" rel="stylesheet" type="text/css" />
      <!--    folder instead of downloading all of them to reduce the load. -->
      <?php /*?><link href="<?php echo base_url();?>assets/admin/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" /><?php */?>
      <link href="<?PHP echo base_url();?>assets/admin/js/fancybox/jquery.fancybox.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/admin/css/validationEngine.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/css/_all-skins.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet" type="text/css" />

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      </head>
      <body class="skin-green sidebar-mini">
<div class="wrapper">
<header class="main-header"> 
        
        <!-- Logo --> 
        <a href="<?php echo base_url();?>admin" class="logo"> 
  <!-- mini logo for sidebar mini 50x50 pixels --> 
<!--  <span class="logo-mini"><img src="<?php //echo base_url(); ?>/assets/img/adminicon.png"></span> -->
  <!-- logo for regular state and mobile devices --> 
  <span class="logo-lg">&nbsp;ADMIN PANEL</span>
 </a> 
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation"> 
    <!-- Sidebar toggle button--> 
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a> 
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
        <li> <a href="<?php echo base_url();?>admin/login/logout" ><i class="fa fa-sign-out"></i>&nbsp; Sign Out</a> </li>
      </ul>
            </li>
            </ul>
          </div>
  </nav>
      </header>
<script type="text/javascript">
	  var base_url  ="<?php echo base_url();?>";
	  </script>