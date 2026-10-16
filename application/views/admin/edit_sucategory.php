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
           Manage categories
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
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
					  <h2 class="box-title">Edit categories</h2>
					</div>
					<div class="box-body">
						 
                          <?php $parent = $this->uri->segment(4); ?>
                          
                        
                         <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Main Category<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	   				 		<select name="category" required>
                            <?php foreach($drop as $d){ ?>
                            <option value="<?php echo $d->cat_id ?>" hidden selected><?php echo $d->cat_name; ?> </option>
                            <?php } ?>
							<?php foreach ($category as $prac) {
								
								?>
                            <option value="<?php echo $prac->cat_id;?>"><?php echo $prac->cat_name; ?></option>
                            <?php } ?>
                            
                            </select>

							</div>
                          </div>   
                         
                         
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Category<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <input class="form-control" name="title"  placeholder="title" type="text" value="<?php echo $subcategory['subcat_name']; ?>" required>	
							</div>
                          </div>
                          
                     
                       
                       
                     
                  <!--     <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Title<strong style="color:#F00;">*</strong> </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							   <input class="form-control" name="metatitle"  placeholder="meta title" type="text" value="<?php echo $subcategory['meta_title']; ?>" required>
							</div>
                          </div>
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Description<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="metadescription"  placeholder="meta Description" type="text" rows="3" required><?php echo $subcategory['meta_description']; ?></textarea>	
							</div>
                          </div>      
                          
                        
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Keyword<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="metakeyword"  placeholder="meta keyword" type="text" rows="3" required><?php echo $subcategory['meta_keyword']; ?></textarea>	
							</div>
                          </div>    
               
                          
                  
                        
                        
                          
                          
                          
                           
                          
                          
                         
                                          
                    
                                               <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Image<strong style="color:#F00;"></strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	   				 <img class="img-responsive" src="<?php echo base_url();?>uploads/subcategory/<?php echo $subcategory['subcat_image'];?>" height="170px" width="150px"/>	

							</div>
                          </div>   
                          
                          
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Update Image<strong style="color:#F00;"></strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    <input  class="form-control" name="Image[]"  type="file" accept="image/*,.webp,.avif" style="width:40%;display:inline-block">
        <br /><br />
		</div>
                          </div>-->
                          
                          
                                  				
					</div><!-- /.box-body -->
				  </div><!-- /.box -->			  

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Update</button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                    	
                  </div>
              </div><!-- /.box -->
			  </form>
              
              
                 
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        <!-- Main content -->
        
        
    
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 