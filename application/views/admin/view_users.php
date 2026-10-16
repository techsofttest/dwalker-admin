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
           List Users
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
                		<div class="box-body">

       
			
                  			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        <th>Name</th>   
                                        <th>Email</th>     
                                        <th>Mobile</th>  
                                        <th>Address</th>                                                               
                                        <th>Action</th>
                                       
                                       
                                    </tr>
                    			</thead>
                    			
                                <tbody>
                    				<?php $i=1;?>
                    				<?php 
									
									
									foreach($users as $us){?>
                       			   
					
                          			<td><?php echo $i; ?></td>
                                    <td><?php echo $us->FULLNAME; ?></td>
                                    <td><?php echo $us->EMAIL_ID; ?></td>
                                    <td><?php echo $us->MOBILE_NO; ?></td>    
                                    <td><?php echo $us->SADDRESS; ?></td>                                      
                                   <td>                                 
                         				<a style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/Users/EditUsers/<?php echo $us->USER_ID;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i style="color:rgb(255, 204, 102);" class="fa fa-pencil-square-o"></i>  Edit</a><br>                        
										<a style="color:rgb(102, 102, 102);" href="<?php echo base_url();?>admin/Users/DeleteUsers/<?php echo $us->USER_ID;?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete?');"><i style="color:red" class="fa fa-times"></i>  Delete</a>
									</td>
                      				</tr>
					  				<?php $i++;}?> 
                    			</tbody> 
                   				
                                <input type="hidden" id="alert-notification" value="Are you sure you want to delete this banner record?">
                  			</table>
                
                		</div><!-- /.box-body -->
                  </div>
                  </div>
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        <!-- /.content -->

 <?php $this->load->view('admin/includes/footer');?>

 <script>
$(document).on("click", "#Sendmail", function(event) {
    event.preventDefault(); 
    var numberOfChecked = $('input:checkbox:checked').length;
    if(numberOfChecked == 0){
            alert("Select at least one for send");  
            return false; 
        } 

        $("input:checkbox[name='check[]']:checked").each(function(){
            var selectedItems = [];             
            selectedItems.push($(this).val());          
        if($('#subject').val()==""){
            alert("Select any Subject"); 
            return false; 
        }      
                        
            var subject = $('#subject').val();                   
            $.ajax({
                url: "<?php echo base_url("admin/Users/Sendmail");?>",
                method: "POST",           
                dataType: "json",			
                data:{
                    subject : subject,
                    item : selectedItems
                },                            
                success: function(data){  
                    if(data.status == 0) {
                        alertify.set('notifier','position', 'top-center');  
                        alertify.success('Mail not send').delay(5).dismissOthers();
                    } else {
                        alertify.set('notifier','position', 'top-center');  
                        alertify.success('Mail Send Succesfully').delay(5).dismissOthers();
                    }                      
                             
                }
            });                 
        
    });
    });
</script>
 
   
 
 
 
  
    
 