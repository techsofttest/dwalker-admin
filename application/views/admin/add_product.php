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
           Manage Product
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
					  <h2 class="box-title">Add Product</h2>
					</div>
					<div class="box-body">
						 
                          <?php $parent = $this->uri->segment(4); ?>
                          
                        
                          
                          
                          
                          
                          
                          
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Main Categories<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <select class="form-control" name="category" onchange="getsubcat(this.value);"  required>
        <option value="" selected disabled>Select Category</option>
        <?php 
		foreach($category as $item=>$val):
		 ?>
                       
       <option value="<?php echo $val->cat_id;?>"><?php echo $val->cat_name;?></option>
       
        <?php 
           endforeach
           ?>
       </select>
                             
							 	
							</div>
                          </div>
                          
                          
                          
                          
                          <div class="row" id="subcat">
                          </div> 
                          
                          <div class="row" id="subcatsub">
                          </div> 
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                        
                       <!-- <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>SubCategories<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	   				 		<select name="category" required>
                            <option value="" disabled selected>Select SubCategories</option>
                            <?php //foreach ($subcategory as $cat) {
								
								?>
                            <option value="<?php //echo $cat->subcat_id;?>"><?php //echo $cat->subcat_name; ?></option>
                            <?php //} ?>
                            
                            </select>

							</div>
                          </div>    --> 
                        
                       
                         
                         
                          
                          
                             
                        
                          
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product name<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	                          <input class="form-control" name="name"  placeholder="Product name" type="text" required>	
							</div>
                          </div>
                          
                        <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Code<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	                          <input class="form-control" name="code"  placeholder="Product Code" type="text" required>	
							</div>
                          </div>
                          
                        
                        
                         <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Price (INR) <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="product_price"  id="typ_name" type="text" required placeholder="Product Price" pattern="^\d{0,8}(\.\d{1,4})?$" autocomplete="off">	
							</div>
                          </div>
                          
                          
                             <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Varities<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <table class="table tariff register">
							   <thead>
								<tr>
                                <?php /*?>  <th width="16%">Quantity</th>
                                  <th width="11%">Unit</th><?php */?>
                                  <th width="18%">Strike Price</th>
                                  <th width="18%">VAT/Tax</th>
                                 <!-- <th width="19%">Stock Count</th>-->
							  </tr>
								
								<tr>
                               
									<?php /*?><td><input class="form-control" type="text"  name="quantity" required id="quantity" style=" width: 130px;margin-right:10px" placeholder="Quantity" /></td>
									<td>
                                    <select class="form-control" name="unit" id="unit" required style=" width: 90px;margin-right:10px" />
                                    <option selected="selected" disabled="disabled" value="">Select Unit</option>
                                    <option   value="Kg">Kg</option>
                                    <option   value="g">g</option>
                                    <option   value="L">L</option>
                                    <option   value="mL">mL </option>
                                    <option   value="Number">Number</option>
                                    <option   value="Bunch">Bunch</option>
                                    </select>
                                    </td><?php */?>
                                    <td><input type="text" class="form-control"  name="strike_price" id="strike_price" style=" width: 150px;margin-right:10px" onKeyPress="return isNumeric(event)" placeholder="Strike Price " required/></td>
                                    <td><input class="form-control" type="text"  name="tax" id="tax" style=" width: 150px;margin-right:10px"  onKeyPress="return isNumeric(event)" placeholder="VAT/Tax" required/></td>
                                   <!-- <td><input class="form-control" type="number" min="0"  name="stock" id="stock" style=" width: 150px;margin-right:10px"  onKeyPress="return isNumeric(event)" placeholder="Stock Count"required/></td>-->
                                    
   
                                    
								</tr>
						
						  </thead>	
							<tfoot>
							</tfoot>
							</table>	
							</div>
                          </div>
                          
                          
                           
                            
                          <!--  <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Type<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                <div class="multiselect">
                  <?php //foreach($all_type as $val=>$item):?>
    <label><input type="checkbox" name="type" value="<?php //echo $item->type_name?>" /><?php //echo $item->type_name?></label>
    <?php //endforeach;?>
</div>			
                            
                            </div>
                          </div>-->
                            
                         
                        <!-- <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Gemstone<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                <div class="multiselect">
                  <?php //foreach($all_gemstone as $val=>$item):?>
    <label><input type="checkbox" name="Gemstone" value="<?php //echo $item->gemstone?>" /><?php //echo $item->gemstone?></label>
    <?php //endforeach;?>
</div>			
                            
                            </div>
                          </div>-->
                         
                          
                      <!-- <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Gemstone Color<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                <div class="multiselect">
                  <?php //foreach($all_color as $val=>$item):?>
    <label><input type="checkbox" name="color" value="<?php //echo $item->colorName?>" /><?php //echo $item->colorName?></label>
    <?php //endforeach;?>
</div>			
                            
                            </div>
                          </div>-->
                      
                          
                          
                   
                          
                         
                        
                        
                        
                          <!-- <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Metal<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <input style="margin-left:1em" name="metal" type="radio" value="None"checked>None
                              <input style="margin-left:1em" name="metal" type="radio" value="bitone" > Bi Tone
							  <input style="margin-left:1em" name="metal" type="radio" value="platinum">Platinum
                              <input style="margin-left:1em" name="metal" type="radio" value="rosegold"> Rose gold
                              <input style="margin-left:1em" name="metal" type="radio" value="strlingsilver">Strling silver
                              <input style="margin-left:1em" name="metal" type="radio" value="whitegold">White Gold	
                              <input style="margin-left:1em" name="metal" type="radio" value="yellowgold">yellow Gold
                             
							</div>
                          </div>-->
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Type<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	   				 		  <input style="margin-left:1em" name="productType" type="radio" value="0" checked> None
							  <input style="margin-left:1em" name="productType" type="radio" value="1"> Featured
                            
							</div>
                          </div> 
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Umcoming Products<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	   				 		  <input style="margin-left:1em" name="upcoming" type="radio" value="0" checked> No
							  <input style="margin-left:1em" name="upcoming" type="radio" value="1"> Yes
                            
							</div>
                          </div> 
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Stock<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                            
	                         <input style="margin-left:1em" name="stock" type="radio" value="Out Of Stock"> Out Of Stock
	                         <input style="margin-left:1em" name="stock" type="radio" value="In Stock" checked> In Stock
                           
							</div>
                          </div> 
                          
                            <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Description <strong style="color:#F00;">*</strong> </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="desc_i"  id="editor1" rows="5" cols="40" type="text"></textarea>	
							</div>
                          </div>   
                        
                                                    
                         
                        <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Title<strong style="color:#F00;">*</strong> </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							   <input class="form-control" name="metatitle"  placeholder="meta title" type="text" required>
							</div>
                          </div>
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Description<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="metadescription"  placeholder="meta Description" type="text" rows="3" required></textarea>	
							</div>
                          </div>      
                          
                        
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Keyword<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="metakeyword"  placeholder="meta keyword" type="text" rows="3" required></textarea>	
							</div>
                          </div>      
                       
                          
                          
                          
                          
                          
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Image  <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="Image[]"  id="typ_name" type="file" required accept="image/*,.webp,.avif">
							</div>
                          </div>  
                          
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Default Image  <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="Imaged[]"  id="typ_name" type="file" required accept="image/*,.webp,.avif">
							</div>
                          </div>  
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>  More Images<br /><br />
                             
                             </label>
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    <input class="form-control" name="document_more[]"  type="file" multiple accept="image/*,.webp,.avif" style="width:40%;display:inline-block">
        Add More: &nbsp&nbsp;
                               <a href="javascript:void(0);" class="add_button" title="Add field">
        <img src="<?php echo base_url();?>assets/admin/img/add-icon.png"/></a>
        <br /><br />
		</div>
                          </div>
                          
                          
                                  				
					</div><!-- /.box-body -->
				  </div><!-- /.box -->			  

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Add</button>
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
	
  // alert(val)
  
	$.ajax({
		
	type: "POST",
   url:'<?php echo base_url('admin/Product/GetSubcat'); ?>',
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
   url:'<?php echo base_url('admin/Product/GetSubcatsub'); ?>',
	data:'getsubcatsub='+val,
	success: function(data){
		
     	$("#subcatsub").html(data);
		$('#subcatsub').css('display', 'block');
		
	}
	});
}
  </script>
 


 
 <script type="text/javascript">   
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
  
    
 