<?php $this->load->view('admin/includes/header');?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Manage Users
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data">
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit User</h2>
					</div>
					<div class="box-body">
     <?php if($this->session->flashdata('success')) {?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('success');?>
				</div>
            	<?php }?>
                <?php if($this->session->flashdata('error')) {?>
				<div class="alert alert-error">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('error');?>
				</div>
            	<?php }?>
						  
    
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Name<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="name"  type="text" step="any" value="<?php echo $user['FULLNAME']; ?>" required>	
							</div>
                          </div>
                       
                     
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Email <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="email"  type="email" value="<?php echo $user['EMAIL_ID']; ?>" required>	
							</div>
                          </div>

                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Phone <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="phone"  type="text" value="<?php echo $user['MOBILE_NO']; ?>" required>	
							</div>
                          </div>

                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Country <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             <select class=" form-control" name="country" id="country"  required="">                     
                                                <option value="New Zealand" <?php if($user['COUNTRY']=="New Zealand"){ echo "selected";}?>>New Zealand</option>
                                                <option value="Australia" <?php if($user['COUNTRY']=="Australia"){ echo "selected";}?>>Australia</option>
                                                <option value="USA" <?php if($user['COUNTRY']=="USA"){ echo "selected";}?>>USA</option>
                                                <option value="Singapore" <?php if($user['COUNTRY']=="Singapore"){ echo "selected";}?>>Singapore</option>
                                                <option value="United Kingdom" <?php if($user['COUNTRY']=="United Kingdom"){ echo "selected";}?>>United Kingdom</option>
                                                <option value="Rest of the world" <?php if($user['COUNTRY']=="Rest of the world"){ echo "selected";}?>>Rest of the world</option>
                                              </select>
							</div>
                          </div>
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Address <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="address"><?php echo $user['SADDRESS']; ?></textarea>							</div>
                          </div>
                   
                   
                          				
					</div><!-- /.box-body -->
				  </div><!-- /.box -->			  

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Submit</button>
					 <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                  </div>
              </div><!-- /.box -->
			  </form>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

