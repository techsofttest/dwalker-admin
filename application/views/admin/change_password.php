 
<?php $this->load->view('admin/includes/header');?>

  <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>
  
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Settings
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>/admin"><i class="fa fa-dashboard"></i>Admin Home</a></li>
		<li class="active">Profile</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
     	<?php if($this->session->flashdata('success')) {?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
							<?php echo $this->session->flashdata('success');?>
					</div>
        <?php }?>
	  <div class="row">
		<div class="col-md-3">

		  <!-- Profile Image -->
		  <!-- /.box -->
		</div><!-- /.col -->
		<div class="col-md-12">
		  <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#change_passwors" data-toggle="tab">Change Password</a></li>
			 
			</ul>
			<div class="tab-content">
			  <div class="active tab-pane" id="change_passwors">
				<form method="post" action="<?php echo base_url() ?>admin/change_password" id="form-password" class="formValidation form-horizontal">
				 
				  <div class="form-group">
					<label for="new" class="col-sm-2 control-label">New Password <span class="required">*</span> </label>
					<div class="col-sm-10">
					  <input type="password" class="form-control validate[required]" name="pass-word" id="password-value" placeholder="New Password">	<span id="result"></span>
					</div>
				  </div>
				  <div class="form-group">
					<label for="confirm" class="col-sm-2 control-label">Confirm Password <span class="required">*</span></label>
					<div class="col-sm-10">
					  <input type="password" class="form-control validate[required,equals[password-value]]" name="password_check" id="password-check" placeholder="Confirm Password">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="button" class="btn btn-danger" id="passsubmit" >Submit</button>
                      <button type="button" onclick="window.location='<?php echo base_url();?>admin';" class="btn btn-primary">Cancel</button>
					</div>
                   
				  </div>
				</form>
			  </div><!-- /.tab-pane -->
			  
				<!-- second tab end here-->
			</div><!-- /.tab-content -->
		  </div><!-- /.nav-tabs-custom -->
		</div><!-- /.col -->
	  </div><!-- /.row -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php $this->load->view('admin/includes/footer');?>
 