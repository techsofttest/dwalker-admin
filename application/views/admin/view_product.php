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
           Manage Products
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
            
            
            
            
               
             <div class="box">
             
             <div class="box-header with-border">
					  <h2 class="box-title">View Products</h2>
                     
                      
                      
					</div>
                    
                    
                   
                		<div class="box-body">
			
                  			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        <th>Name</th>
                                         <th>Product Code</th>
                                        <th>Price</th>
                                      <!--   <th>Category</th>-->
                                        
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                       
                                       
                                    </tr>
                    			</thead>
                    			
                                <tbody>
                    				<?php $i=1;?>
                    				<?php 
									
									
									foreach($product as $prod):
									$prsubcatsub=$prod->subcatsub_id;
									$prsubcat=$prod->subcat_id;
			                        $prcat=$prod->cat_id;
									?>
                       			   
					
                          			<td><?php echo $i++; ?></td>
                                    <td><?php echo $prod->product_name; ?>
                                     <br /><br />
                                      <strong> Stock : <?php echo $prod->productStock; ?> </strong> 
                                    </td>
                                    <?php
                                   //  $prots = $prod->description;
									?>
                                   <!-- <td><?php //echo substr($prots,0,200); ?></td>-->
                                   <!-- <td><?php //echo $prod->pro_price; ?></td>-->
                                   <td><?php echo $prod->productCode; ?></td>
                                   <td><?php echo $prod->productPrice; ?></td>
                                    <td>
                                     <a href="<?php echo base_url();?>uploads/Products/<?php echo $prod->ProductImage; ?>" class="fancybox-media">
                                       <img src="<?php echo base_url(); ?>uploads/Products/<?php echo $prod->ProductImage;?>" height="150px" width="150px"  />
                                      </a>
                                    </td>
                                 
									<td>
                <!--  Main Category : <?php //echo $val->MainCat; ?>-
                     <br />
                    <br />-->
               Main Category :
                    <?php  foreach($all_categories as $item=>$vall): if($prcat==$vall->cat_id){ echo $vall->cat_name; } endforeach; ?>
                    <br />
                    <br />
                  Category :
                    <?php  foreach($all_categories1 as $item=>$vall): if($prsubcat==$vall->subcat_id){ echo $vall->subcat_name; }endforeach; ?>
                    <br />
                    <br />
                   Sub Category :
                    <?php  foreach($all_categories2 as $item=>$vall): if($prsubcatsub==$vall->subcatsub_id){ echo $vall->subcatsub_name; }endforeach; ?>
                    <br />
                    <br />
                  
                   
                  
                   
                    
                    </td>
                                    
                                    
            
                                   <td>
                                   
                         				<a style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/Product/EditProduct/<?php echo $prod->product_id;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i style="color:rgb(255, 204, 102);" class="fa fa-pencil-square-o"></i>  Edit</a><br>
                        
										<a style="color:rgb(102, 102, 102);" href="<?php echo base_url();?>admin/Product/DeleteProduct/<?php echo $prod->product_id;?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete?');"><i style="color:red" class="fa fa-times"></i>  Delete</a>
									</td>
                      				</tr>
					  				<?php endforeach;?> 
                    			</tbody> 
                   				
                                <input type="hidden" id="alert-notification" value="Are you sure you want to delete this banner record?">
                  			</table>
                
                		</div><!-- /.box-body -->
              		</div> 
              
              
              
              
              
              
              
              
              
              
              
              
              
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 