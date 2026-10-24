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
			
                  			<table id="datatable" class="table table-bordered table-striped delTable reorderTable">
                    			<thead>
                                    <tr>
                                        <th style="width: 35px; text-align: center;" class="no-sort"><i class="fa fa-bars" title="Drag to reorder"></i></th>
                                        <th style="width: 55px; text-align: center;">Order</th>
                                        <th>Name</th>
                                         <th>Product Code</th>
                                        <th>Price</th>
                                      <!--   <th>Category</th>-->
                                        
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th class="no-sort">Action</th>
                                       
                                       
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
                       			   
									<tr id="row_<?php echo $prod->product_id; ?>" data-id="<?php echo $prod->product_id; ?>">
                           			<td class="reorder-handle" style="cursor: grab; text-align: center; vertical-align: middle;">
                           			    <i class="fa fa-arrows" style="color: #777; font-size: 15px;"></i>
                           			</td>
                           			<td class="order-cell" style="vertical-align: middle; text-align: center; font-weight: bold;">
                           			    <span class="badge bg-purple order-number"><?php echo (isset($prod->sort_order) && $prod->sort_order > 0) ? $prod->sort_order : $i; ?></span>
                           			</td>
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

  <style>
    .reorder-handle:hover {
      background-color: #f0f0f0;
    }
    .reorder-handle:active {
      cursor: grabbing !important;
    }
    .ui-sortable-helper {
      display: table !important;
      background: #ffffff !important;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
    }
    .ui-sortable-placeholder {
      visibility: visible !important;
      background-color: #fcf8e3 !important;
      height: 60px;
    }
    .order-saving-notice {
      position: fixed;
      top: 65px;
      right: 25px;
      z-index: 99999;
      display: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
  </style>

  <div id="orderSavingNotice" class="order-saving-notice alert alert-info">
    <i class="fa fa-refresh fa-spin"></i> Saving updated product order...
  </div>

  <?php $this->load->view('admin/includes/footer');?>

  <!-- jQuery UI for Sortable drag-and-drop reordering -->
  <script src="<?php echo base_url();?>assets/admin/js/jquery-ui.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function() {
      var prodTable = $('#datatable').DataTable({
          "ordering": false,
          "pageLength": 50,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
          "dom": "<'row'<'col-sm-4'l> <'col-sm-8'p>>" + 'Bfrtip',
          "buttons": [
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: 'thead th:not(.noExport)'
                  }
              }
          ]
      });

      // Enable drag and drop row sorting
      $("#datatable tbody").sortable({
          handle: ".reorder-handle",
          items: "tr",
          cursor: "grabbing",
          axis: "y",
          opacity: 0.85,
          placeholder: "ui-sortable-placeholder",
          helper: function(e, ui) {
              ui.children().each(function() {
                  $(this).width($(this).width());
              });
              return ui;
          },
          update: function(event, ui) {
              var newOrders = [];
              var startPos = 1;

              var info = prodTable.page.info();
              if (info) {
                  startPos = info.start + 1;
              }

              $("#datatable tbody tr").each(function(index) {
                  var pId = $(this).data("id");
                  var pos = startPos + index;
                  $(this).find(".order-number").text(pos);
                  if (pId) {
                      newOrders.push({
                          id: pId,
                          position: pos
                      });
                  }
              });

              if (newOrders.length > 0) {
                  $("#orderSavingNotice").stop(true, true).fadeIn(150);
                  $.ajax({
                      url: "<?php echo base_url('admin/Product/update_order'); ?>",
                      type: "POST",
                      dataType: "json",
                      data: { orders: newOrders },
                      success: function(response) {
                          $("#orderSavingNotice").fadeOut(200);
                          if (typeof alertify !== 'undefined' && alertify.success) {
                              alertify.success("Product order updated successfully!");
                          }
                      },
                      error: function() {
                          $("#orderSavingNotice").fadeOut(200);
                          if (typeof alertify !== 'undefined' && alertify.error) {
                              alertify.error("Failed to update product order.");
                          }
                      }
                  });
              }
          }
      });
  });
  </script>
 
   
 
 
 
  
    
 