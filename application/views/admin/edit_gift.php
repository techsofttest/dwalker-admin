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
           Manage Gift
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
					  <h2 class="box-title">Edit Gift</h2>
					</div>
					<div class="box-body">
						  
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Title <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="title"  type="text" value="<?php echo $gift['code']; ?>" required>	
							</div>
                          </div>
                                               
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Image </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             <a href="<?php echo base_url();?>uploads/Gift/<?php echo $gift['Image']?>" class="fancybox-media">
                              <img src="<?php echo base_url();?>uploads/Gift/<?php echo $gift['Image']?>" style="width:150px;height:170px"></a> 
							  <input class="form-control" name="Image"  id="typ_name" type="file" accept="image/*,.webp,.avif">
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

