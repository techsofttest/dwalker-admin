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
           Manage Testimonials
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
					  <h2 class="box-title">Edit Testimonials</h2>
					</div>
					<div class="box-body">
						 
                          <?php $parent = $this->uri->segment(4); ?>
                          
                        
                       
                         
                      <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Author Name <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="name" type="text" value="<?php echo $testimonial['testi_name']; ?>"  required autocomplete="off">	
							</div>
                          </div>
                         <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Location <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <input class="form-control" name="location" value="<?php echo $testimonial['testi_location']; ?>" type="text"  required autocomplete="off">	
							</div>
                          </div>
                        
                        
                        
                         
                          
                          
                        
                        
                          
                         <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Description<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <textarea class="form-control" name="desc"  id="editor1" rows="5" cols="40" ><?php echo $testimonial['testi_description']; ?></textarea>	
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
 