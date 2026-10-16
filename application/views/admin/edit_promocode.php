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
           Manage Promocode
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data" >
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit Promocode</h2>
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
							 <label>Duration <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-3 row-seperate">
							  <input class="form-control" name="from"  type="date" value="<?php echo $promo['from']; ?>" required>	
         </div>
         <div class="col-xs-12 col-sm-3 row-seperate">
         <input class="form-control" name="to"  type="date" value="<?php echo $promo['to']; ?>" required>	
							</div>
                          </div>
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Discount <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="discount"  type="number" step="any" value="<?php echo $promo['discount']; ?>" required>	
							</div>
                          </div>
                       
                     
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Code <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="code"  type="text" value="<?php echo $promo['code']; ?>" required>	
							</div>
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

