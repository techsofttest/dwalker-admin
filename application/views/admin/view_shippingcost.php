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
           Manage Shippingcost
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
					  <h2 class="box-title">View Shippingcost</h2>
                     
                      
                      
					</div>
                    
                    
                   
                		<div class="box-body">
			
                   			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort" style="width: 50px;">Sl no</th>
                                        <th>Country</th>
                                        <th>Shipping Price Less Amount</th>
                                        <th>Shipping Price Over Amount</th>
                                        <!-- <th>Express Shipping Price</th> -->
                                       <!-- <th>Delivery Time</th>-->
                                        <th>Description</th>
                                        <th style="width: 120px; text-align: center;">Status (Active/Inactive)</th>
                                        <th style="width: 100px;">Action</th>
                                    </tr>
                    			</thead>
                    			
                                <tbody>
                    				<?php $i=1;?>
                    				<?php 
									foreach($shippingcost as $cost):
										$country_id = 0;
										$country_name = 'Unknown';
										$country_status = 1;
										if(!empty($cost->countryname)) {
											foreach($cost->countryname as $c) {
												$country_id = isset($c->country_id) ? $c->country_id : 0;
												$country_name = isset($c->country_name) ? $c->country_name : '';
												$country_status = isset($c->status) ? $c->status : 1;
											}
										}
									?>
									<tr>
                          			<td><?php echo $i++; ?></td>
                                    <td><strong><?php echo htmlspecialchars($country_name); ?></strong></td>
                                    <td><?php echo $cost->shipPrice; ?></td>
                                    <td><?php echo $cost->shipPriceLess; ?></td>
                                   <!-- <td><?php echo $cost->deliverytime; ?></td>-->
                                   <?php   if($cost->express_shipping==1){
								   ?>
                                   <!-- <td><?php echo $cost->expressamount; ?></td> -->
								  <?php }
								  else{
								  ?>
                                   <!-- <td>Null</td> -->
								<?php   } ?>
                                  
                                    <td><?php echo $cost->description; ?></td>
             
                                    <td style="text-align: center;">
                                        <?php if($country_id > 0): ?>
                                            <a href="<?php echo base_url(); ?>admin/Shippingcost/toggle_country_status/<?php echo $country_id; ?>" 
                                               class="btn btn-xs btn-country-toggle <?php echo ($country_status == 1) ? 'btn-success' : 'btn-danger'; ?>"
                                               data-countryid="<?php echo $country_id; ?>"
                                               title="Click to toggle Active/Inactive"
                                               style="min-width: 80px; border-radius: 12px; font-weight: bold; padding: 4px 10px;">
                                                <i class="fa <?php echo ($country_status == 1) ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                                                <span class="status-label"><?php echo ($country_status == 1) ? 'Active' : 'Inactive'; ?></span>
                                            </a>
                                        <?php else: ?>
                                            <span class="label label-default">N/A</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                          				<a style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/Shippingcost/EditShippingcost/<?php echo $cost->shipping_id;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i style="color:rgb(255, 204, 102);" class="fa fa-pencil-square-o"></i>  Edit</a><br>
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

      <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
      <script>
        $(document).on('click', '.btn-country-toggle', function(e) {
          e.preventDefault();
          var $btn = $(this);
          var url = $btn.attr('href') + '?ajax=1';
          $btn.prop('disabled', true).css('opacity', '0.6');

          $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
              $btn.prop('disabled', false).css('opacity', '1');
              if(res && res.status === 'success') {
                if(res.new_status == 1) {
                  $btn.removeClass('btn-danger').addClass('btn-success');
                  $btn.find('i').removeClass('fa-times-circle').addClass('fa-check-circle');
                  $btn.find('.status-label').text('Active');
                } else {
                  $btn.removeClass('btn-success').addClass('btn-danger');
                  $btn.find('i').removeClass('fa-check-circle').addClass('fa-times-circle');
                  $btn.find('.status-label').text('Inactive');
                }
              } else {
                window.location.reload();
              }
            },
            error: function() {
              $btn.prop('disabled', false).css('opacity', '1');
              window.location.href = $btn.attr('href');
            }
          });
        });
      </script>

 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 