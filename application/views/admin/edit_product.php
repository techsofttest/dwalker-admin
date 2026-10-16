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
					  <h2 class="box-title">Edit Products</h2>
					</div>
					<div class="box-body">
						 
                          <?php $parent = $this->uri->segment(4); ?>
                          
                        
                         <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Main Category </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <select class="form-control" name="category" onchange="getsubcat(this.value);"  required>
                              
      <?php /*?>  <option value="<?php  echo $product['catId']; $sid=$product['catId']; ?>" selected >
		<?php  foreach($all_categories1 as $item=>$val): if($sid==$val->catID){ echo $val->catName; } endforeach; ?>
		</option><?php */?>
        <?php 
		foreach($all_categories as $item=>$val):
		 ?>
                       
       <option value="<?php echo $val->cat_id;?>" <?php if($product['cat_id']==$val->cat_id){ echo 'selected'; }?>><?php echo $val->cat_name;?></option>
       
        <?php 
           endforeach
           ?>
       </select>
               </div>
               </div>          
                         
                         <div class="row" >
                         <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>  Select Category<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
			<select class="form-control" name="subcat" id="subcat" onchange="getsubcatsub(this.value);"  required>
            <option value="<?php $sid=$product['subcat_id']; echo $product['subcat_id']; ?>"><?php  foreach($all_categories1 as $item=>$val): if($sid==$val->subcat_id){ echo $val->subcat_name; } endforeach; ?></option>
            
            </select>
                          </div></div> 
                         
                     
                      <div class="row" >
                         <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>  Select SubCategory<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
			<select class="form-control" name="subcatsub" id="subcatsub" >
            <option value="<?php $sid=$product['subcatsub_id']; echo $product['subcatsub_id']; ?>"><?php  foreach($all_categories2 as $item=>$val): if($sid==$val->subcatsub_id){ echo $val->subcatsub_name; } endforeach; ?></option>
            
            </select>
                          </div></div> 
                     
                     
                     
                          
                         
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product name<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <input class="form-control" name="name"  placeholder="title" type="text" value="<?php echo $product['product_name']; ?>" required>	
							</div>
                          </div>
                          
                      <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Code<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	                          <input class="form-control" name="code"  placeholder="Product Code" type="text" value="<?php echo $product['productCode']; ?>" required>	
							</div>
                          </div>
                       
                       
                        <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Price (INR) <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="product_price"  id="typ_name" type="text" value="<?php echo $product['productPrice']; ?>" required placeholder="Product Price" pattern="^\d{0,8}(\.\d{1,4})?$" autocomplete="off">	
							</div>
                          </div>
                          
                          
                                <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Varities</label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <table class="table tariff register">
							   <thead>
								<tr>
                                  <?php /*?><th width="16%">Quantity</th>
                                  <th width="11%">Unit</th><?php */?>
                                  <th width="18%">Strike Price</th>
                                  <th width="18%">VAT/Tax</th>
                                 <!-- <th width="19%">Stock Count</th>-->
							  </tr>
								
								<tr>
                               
									<?php /*?><td><input class="form-control" type="text"  name="quantity" required id="quantity" style=" width: 130px;margin-right:10px" value="<?php  echo $product['productQuantity']; ?>" /></td>
									<td>
                                    <select class="form-control" name="unit" id="unit" required style=" width: 90px;margin-right:10px" />
                                    <option selected="selected" value="<?php  echo $product['productUnit']; ?>"><?php  echo $product['productUnit']; ?></option>
                                    <option   value="Kg">Kg</option>
                                    <option   value="g">g</option>
                                    <option   value="L">L</option>
                                    <option   value="mL">mL </option>
                                    <option   value="Number">Number</option>
                                    <option   value="Bunch">Bunch</option>
                                    </select>
                                    </td><?php */?>
                                    <td><input type="text" class="form-control" value="<?php  echo $product['productStrikePrice']; ?>" name="strike_price" id="strike_price" style=" width: 150px;margin-right:10px" onKeyPress="return isNumeric(event)" required/></td>
                                    <td><input class="form-control" type="text"  name="tax" id="tax" style=" width: 150px;margin-right:10px" value="<?php  echo $product['productTax']; ?>" onKeyPress="return isNumeric(event)" required/></td>
                                   <!-- <td><input class="form-control" type="number" min="0"  name="stock" id="stock" style=" width: 110px;margin-right:10px" value="<?php  //echo $product['productStock']; ?>" onKeyPress="return isNumeric(event)" required/></td>-->
                                    
   
                                    
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
                              <?php  $productType = explode(',',$product['productType']); 	
							 				  
							   ?>
                <div class="multiselect">
                  <?php foreach($all_type as $val=>$type):?>
    <label><input type="checkbox" name="type[]" value="<?php echo $type->type_name?>"  <?php if((in_array($type->type_name,$productType))) echo 'checked';?>/><?php echo $type->type_name?></label>
    <?php endforeach;?>
</div>			
                            
                            </div>
                          </div>-->
                       
                       
                     <!--   <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Gemstone<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <?php  $productGemstone = explode(',',$product['productGemstone']); 	
							 				  
							   ?>
                <div class="multiselect">
                  <?php foreach($all_gemstone as $val=>$item):?>
    <label><input type="checkbox" name="gemstone[]" value="<?php echo $item->gemstone?>"  <?php if((in_array($item->gemstone,$productGemstone))) echo 'checked';?>/><?php echo $item->gemstone?></label>
    <?php endforeach;?>
</div>			
                            
                            </div>
                          </div>-->
                          
                          
                          <!--<div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Gemstone Color<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <?php  $productGemcolor = explode(',',$product['productGemcolor']); 	
							 				  
							   ?>
                <div class="multiselect">
                  <?php foreach($all_color as $val=>$color):?>
    <label><input type="checkbox" name="color[]" value="<?php echo $color->colorName?>"  <?php if((in_array($color->colorName,$productGemcolor))) echo 'checked';?>/><?php echo $color->colorName?></label>
    <?php endforeach;?>
</div>			
                            
                            </div>
                          </div>-->
                          
                          
                    
                     
                     
                     
                   <!--  <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Metal<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <input style="margin-left:1em" name="metal" type="radio" value="bitone" <?php if('bitone' == $product['ProductMetal']) { echo 'checked';} ?>> Bi Tone
							  <input style="margin-left:1em" name="metal" type="radio" value="platinum" <?php if('platinum' == $product['ProductMetal']) { echo 'checked';} ?>> Platinum
                              <input style="margin-left:1em" name="metal" type="radio" value="rosegold" <?php if('rosegold' == $product['ProductMetal']) { echo 'checked';} ?>> Rose gold
                              <input style="margin-left:1em" name="metal" type="radio" value="strlingsilver" <?php if('strlingsilver' == $product['ProductMetal']) { echo 'checked';} ?>> Strling silver
                              <input style="margin-left:1em" name="metal" type="radio" value="whitegold" <?php if('whitegold' == $product['ProductMetal']) { echo 'checked';} ?>>                               White Gold	
                              <input style="margin-left:1em" name="metal" type="radio" value="yellowgold" <?php if('yellowgold' == $product['ProductMetal']) { echo 'checked';} ?>>                               yellow Gold
                              <input style="margin-left:1em" name="metal" type="radio" value="None" <?php if('None' == $product['ProductMetal']) { echo 'checked';} ?>>                               None	
							</div>
                          </div>-->
                     
                     
                        <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Product Type<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             <?php 
                               $is_featured = (isset($product['productType']) && ($product['productType'] == '1' || $product['productType'] === 1)) || (isset($product['type']) && ($product['type'] == '1' || $product['type'] === 1));
                             ?>
	     <input style="margin-left:1em" name="productType" type="radio" value="0" <?php if(!$is_featured){ echo "checked"; } ?>> None
	     <input style="margin-left:1em" name="productType" type="radio" value="1" <?php if($is_featured){ echo "checked"; } ?>> Featured
                            
							</div>
                          </div> 
                          
                        <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Upcoming Product<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                            
	     <input style="margin-left:1em" name="upcoming" type="radio" value="0" <?php if('0' == $product['upcoming']){ echo "checked"; } ?>> No
	 <input style="margin-left:1em" name="upcoming" type="radio" value="1" <?php if('1' == $product['upcoming']){ echo "checked"; } ?>> Yes
                           
							</div>
                          </div> 
                     
                       <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Stock<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                            
	     <input style="margin-left:1em" name="stock" type="radio" value="Out Of Stock" <?php if('Out Of Stock' == $product['productStock']){ echo "checked"; } ?>> Out Of Stock
	 <input style="margin-left:1em" name="stock" type="radio" value="In Stock" <?php if('In Stock' == $product['productStock']){ echo "checked"; } ?>> In Stock
                           
							</div>
                          </div>  
                     
                       
                   <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Description <strong style="color:#F00;">*</strong> </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="desc_i"  id="editor1" rows="5" cols="40" type="text"><?php echo $product['ProductDesc']; ?></textarea>	
							</div>
                          </div>   
                          
                      <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Title<strong style="color:#F00;">*</strong> </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							   <input class="form-control" name="metatitle"  placeholder="meta title" type="text" value="<?php echo $product['meta_title']; ?>" required>
							</div>
                          </div>
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Description<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="metadescription"  placeholder="meta Description" type="text" rows="3" required><?php echo $product['meta_description']; ?></textarea>	
							</div>
                          </div>      
                          
                        
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Meta Keyword<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="metakeyword"  placeholder="meta keyword" type="text" rows="3" required><?php echo $product['meta_keyword']; ?></textarea>	
							</div>
                          </div>    
                        
                        
                          
                          
                          
                           
                          
                          
                         
                                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Image </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             <a href="<?php echo base_url();?>uploads/Products/<?php echo $product['ProductImage']?>" class="fancybox-media">
                              <img src="<?php echo base_url();?>uploads/Products/<?php echo $product['ProductImage']?>" style="width:150px;height:170px"></a> 
							  <input class="form-control" name="Image[]"  id="typ_name" type="file" accept="image/*,.webp,.avif">
							</div>
                          </div>
                          
                          
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Default Image </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             
                             <?php if($product['ProductdefaultImage'] !='')
							 {
							 ?>
                              <a href="<?php echo base_url();?>uploads/Products/<?php echo $product['ProductdefaultImage']?>" class="fancybox-media">
                              <img src="<?php echo base_url();?>uploads/Products/<?php echo $product['ProductdefaultImage']?>" style="width:150px;height:170px"></a> 
                             
                             <?php }
							
							 ?>
                            
                            
							  <input class="form-control" name="Imaged[]"  id="typ_name" type="file" accept="image/*,.webp,.avif">
							</div>
                          </div>
                          
                          
                          
                          
                          
                          <div class="row">
                        
                            
						    <div class="col-xs-12 col-sm-3 row-seperate">
                             
                            <?php
						/*	foreach($img_data_all as $image)
							{ 
							    $img = $image->ProductImage;
                              if($img!="")
							  { ?>
                               <label>  More Images<br /><br />
                             
                             </label>
                              <?php
								  }
								}*/
                            
							?>
                                
                                
							
                         </div>
                               
                  <div class="col-xs-12 col-sm-9 row-seperate">
                 
                   
	   <?php
		foreach($img_data_all as $item=>$val):
		?>
          <a href="<?php echo base_url();?>uploads/Products/<?php echo $val->ProductImage;?>" class="fancybox-media">
          <img src="<?php echo base_url();?>uploads/Products/<?php echo $val->ProductImage;?>" style="width:150px;height:170px;border: 1px solid #ccc;"></a> 
           <a style="color: red;font-weight: 600;font-size: 15px;" href="<?php echo base_url();?>admin/Product/DeleteProductmore/<?php echo $val->imageId;?>" onclick="return confirm('Are you absolutely sure you want to delete?');"><img src="<?php echo base_url();?>assets/admin/img/remove-icon.png"/ ></a>
                             
           <?php
           endforeach
          ?>
		</div>
            
              
                          </div>
                          
                 
                          
                       <div class="row">
						 <div class="col-xs-12 col-sm-3 row-seperate">
                          
                      
                               
							<label>  Add More<br /><br />
                             
                             </label>
                       
                            
                             </div>
                               
						
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
                 
                
	    <input class="form-control" name="document_more[]"  type="file" multiple accept="image/*,.webp,.avif" style="width:40%;display:inline-block;margin-top: 24px;">
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
  
    
 