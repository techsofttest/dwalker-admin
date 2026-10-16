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
					  <h2 class="box-title">Edit Shippingcost</h2>
					</div>
					<div class="box-body">
						 
                          <?php $parent = $this->uri->segment(4); ?>
                          
                        
                       
                         
                    
                     <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Main Category </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <select class="form-control" name="country" onchange="getsubcat(this.value);"  required>
                              
      <?php /*?>  <option value="<?php  echo $product['catId']; $sid=$product['catId']; ?>" selected >
		<?php  foreach($all_categories1 as $item=>$val): if($sid==$val->catID){ echo $val->catName; } endforeach; ?>
		</option><?php */?>
        <?php 
		foreach($allcountry as $item=>$val):
		 ?>
                       
       <option value="<?php echo $val->country_id;?>" <?php if($shippingcost['country_name']==$val->country_id){ echo 'selected'; }?>><?php echo $val->country_name;?></option>
       
        <?php 
           endforeach
           ?>
       </select>
               </div>
               </div>          
                  
                     
                     
                     
                          
                         
                    
                       
                       
                     
                          
                         <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Maximum Amount <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="shipPriceGreater" type="text" value="<?php echo $shippingcost['shipPriceGreater']; ?>" required autocomplete="off">	
							</div>
                          </div> 
                          
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Maximum Amount Below Shipping Price <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="shipPrice" type="text" value="<?php echo $shippingcost['shipPrice']; ?>" required autocomplete="off">	
							</div>
                          </div>
                       

                <input type="hidden" name="shipPriceLess" value="<?php echo $shippingcost['shipPriceLess']; ?>" />

                <input type="hidden" name="express_shipping" value="0" />

                <?php /*
                 <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Maximum Amount Over Shipping Price <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="shipPriceLess" type="text" value="<?php echo $shippingcost['shipPriceLess']; ?>" required autocomplete="off">	
							</div>
                          </div>
                       
                     <div class="row">
                     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Maximum Amount Over Shipping Price <strong style="color:#F00;">*</strong></label>
                             </div>
                    <div class="col-sm-1">
                    <?php $B=$shippingcost['express_shipping']; ?>
                   
                    Yes <input type="radio" name="express_shipping" <?php if($B=="1"){?> checked<?php } ?> value="1" required id="yesCheck" onClick="javascript:yesnoCheck();" >
                    </div> 
                    <div class="col-sm-1">
                    No <input type="radio" name="express_shipping" <?php if($B=="0"){?> checked <?php } ?> value="0" required id="noCheck" onClick="javascript:yesnoCheck();" >

                    
                    </div></div>
                    */
                    ?>


                          
                       
                          
                        <div class="row"  id="otherAnswer" style="display:<?php if($shippingcost['express_shipping']=='1') echo 'block'; else echo 'none';?>;">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Express shipping Amount <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="expressamount" type="text" value="<?php echo $shippingcost['expressamount']; ?>" required autocomplete="off">	
							</div>
                          </div>  
                      <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Description<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="shippingcost"  placeholder="Shipping cost" type="text" rows="5" required><?php echo $shippingcost['description']; ?></textarea>	
							</div>
                          </div>      
                     
                     
                     
              
                     
                     
                     
                
                     
                       
                  <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Delivery time<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="deliverytime"  placeholder="Delivery time" type="text" rows="5" required><?php echo $shippingcost['deliverytime']; ?></textarea>	
							</div>
                          </div>  
                          
           
                   
                                  
                          
                                  				
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
 
   
 <script>
  function getsubcat(val) {
//alert(val)
	$.ajax({
		
	type: "POST",
   url:'<?php echo base_url('admin/Product/GetSubcat_edit'); ?>',
	data:'getsubcat='+val,
	success: function(data){
		
		$("#subcat").html(data);
		$('#subcat').css('display', 'block');
		
	}
	});
}
  </script>
  
   <script>
  function getsubcatsub(val) {
//alert(val)
	$.ajax({
		
	type: "POST",
   url:'<?php echo base_url('admin/Product/GetSubcatsub_edit'); ?>',
	data:'getsubcatsub='+val,
	success: function(data){
		
		$("#subcatsub").html(data);
		$('#subcatsub').css('display', 'block');
		
	}
	});
}
  </script>
 
 <script>
    $(document).ready(function(){
		var maxField = 10;
		var addButton = $('.add_button'); 
		var wrapper = $('.field_wrapper');
		var fieldHTML = '<div> <input class="form-control" name="document_more[]" multiple type="file" required style="width:40%;display:inline-block">&nbsp&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;<img src="<?php echo base_url();?>assets/admin/img/remove-icon.png"/></a></div><br>'; //New input field html 
		var x = 1; 
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){ 
			e.preventDefault();
			$(this).parent('div').remove();
			x--; 
		});
	});
 </script>
  
    
 
 <script>
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('otherAnswer').style.display = 'block';
    }
    else document.getElementById('otherAnswer').style.display = 'none';
	
	if (document.getElementById('noCheck').checked) {
        document.getElementById('otherAnswer').style.display = 'none';
    }
    
	

	
	

}
</script>
 