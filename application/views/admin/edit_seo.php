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
           Manage Seo Page
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
            
            
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
            
            
            
            
            
            
            
            
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data" >
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit Seo Page</h2>
					</div>
					<div class="box-body">
						  
                         
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							<label> Title<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	  <input class="form-control" name="Title"  placeholder="Title" type="text" readonly value="<?php echo $seo_data['seotitle']; ?>" required>	
							</div>
                          </div>
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Title <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="m_title" type="text" required><?php echo $seo_data['meta_title']; ?></textarea>	
							</div>
                          </div>
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Description <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="m_dis" type="text" ><?php echo $seo_data['meta_description']; ?></textarea>	
							</div>
                          </div>
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Meta Keyword <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="m_key" type="text" ><?php echo $seo_data['meta_keyword']; ?></textarea>	
							</div>
                          </div>

                          
                        
                         
                     
                     
                  
                          
                    
                          
                         
                        
                        
        
                          
                      
                      
                       </div>
                          </div>
                          
                          
                      
                                       				
					</div><!-- /.box-body -->
				  </div><!-- /.box -->			  

             
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Submit</button>
					 <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                  </div>
             
			  </form>
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
     </div>
 <?php $this->load->view('admin/includes/footer');?>
