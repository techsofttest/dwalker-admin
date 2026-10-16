<?php $this->load->view('admin/includes/header');?>
<style>
    .loader {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 6px solid #f3f3f3;
    border-radius: 50%;
    border-top: 6px solid #3498db;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>
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

          <form method="post" style="margin-top: 20px;margin-bottom: 5%;">     
            <div class="col-lg-1"> </div>                  	
            <div class="col-lg-3">                          
                          
            <?php if(!empty($this->input->post('subject')))              
              {            
              $subject =  $this->input->post('subject');                
              }              
              else              
              {              
              $subject="";                
              }   
          ?>
            <label style="display: flex;justify-content: center;">Select Subject</label>            
            <select class="form-control" id="subject" name="subject">
              
            <option value="">Select Subject</option>
              
            <?php foreach($subject_list as $sub){ ?>
            
            <option value="<?php echo $sub->tem_id;?>" <?php if($subject == $sub->tem_id) { echo "selected"; } ?> ><?php echo $sub->title?></option>
            
            <?php } ?>
              
            </select>                           
       </div>

       <div class="col-lg-3">                          
                          
                          <?php if(!empty($this->input->post('team')))              
                            {            
                            $team =  $this->input->post('team');                
                            }              
                            else              
                            {              
                            $team="";                
                            }   
                        ?>
                           <label style="display: flex;justify-content: center;">Select Team</label>               
                          <select class="form-control" id="team" name="team">
                            
                          <option value="" >Select Team</option>
                            
                          <?php foreach ($grouped as $index => $group){ 
                              $email = array();

                             foreach($group as $usd){

                               $email[] = $usd->EMAIL_ID;                              
                            } ?>                                                           
                          <option value="<?php echo implode(",",$email);?>"> Team <?php echo $index + 1;?></option>
                          
                          <?php } ?>
                            
                          </select>                           
                     </div>

        <div class="col-lg-2"> 
        <label></label><br>                       
          <button class="form-control btn-success" id="Sendmail">Send Mail</button>                
                          
       </div>                      
       

    </form>
			
                  			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        <th>Name</th>   
                                        <th>Email</th>     
                                        <th>Mobile</th>                                                                
                                        <th>Address</th> 
                                       
                                       
                                    </tr>
                    			</thead>
                    			
                                <tbody>
                    				<?php $i=1;?>
                    				<?php 
									
									
									foreach($users as $us){?>
                       			   
					
                          			<td>&nbsp;&nbsp;<input type="checkbox" name="check[]" class="checkbox" value="<?php echo $us->USER_ID; ?>"></td>
                                    <td><?php echo $us->FULLNAME; ?></td>
                                    <td><?php echo $us->EMAIL_ID; ?></td>
                                    <td><?php echo $us->MOBILE_NO; ?></td>  
                                    <td><?php echo $us->SADDRESS; ?></td>  
                      				</tr>
					  				<?php }?> 
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

 <script>
$(document).on("click", "#Sendmail", function(event) {
    event.preventDefault(); 
    var numberOfChecked = $('input[type="checkbox"]:checked').length;

    // Show loader while processing
    var loader = $('<div class="loader"></div>');
    $('body').append(loader);

    if (numberOfChecked === 0 && $('#team').val() === "") {
        alert("Select any Team or Individual");
        return false;
    }

    if (numberOfChecked != 0) {
        $("input:checkbox[name='check[]']:checked").each(function(){
            var selectedItems = [];             
            selectedItems.push($(this).val()); 
            if ($('#subject').val() == "") {
                alert("Select any Subject"); 
              
                return false; 
            }            
            var subject = $('#subject').val();  
            var team = $('#team').val();                                       
            $.ajax({
                url: "<?php echo base_url('admin/Users/Sendmail'); ?>",
                method: "POST",           
                dataType: "json",			
                data: {
                    subject: subject,
                    item: selectedItems,
                    team: team
                },                            
                success: function(data) {  
                    if (data.status == 0) {
                        alertify.set('notifier', 'position', 'top-center');  
                        alertify.success('Mail not sent').delay(5).dismissOthers();
                    } else {
                        alertify.set('notifier', 'position', 'top-center');  
                        alertify.success('Mail Sent Successfully').delay(5).dismissOthers();
                        window.location.reload(); 
                    }
                
                   
                },
                error: function() {
                    alert('Error occurred while sending mail.');
                    loader.remove(); // Remove loader on error
                }
            }); 
        });

    } else {
        var team = $('#team').val(); 
        var subject = $('#subject').val();  

        $.ajax({
            url: "<?php echo base_url('admin/Users/Sendmail'); ?>",
            method: "POST",           
            dataType: "json",			
            data: {
                subject: subject,                   
                team: team
            },                            
            success: function(data) {  
                if (data.status == 0) {
                    alertify.set('notifier', 'position', 'top-center');  
                    alertify.success('Mail not sent').delay(5).dismissOthers();
                } else {
                    alertify.set('notifier', 'position', 'top-center');  
                    alertify.success('Mail Sent Successfully').delay(5).dismissOthers();
                    window.location.reload(); 
                }
               
                
            },
            error: function() {
                alert('Error occurred while sending mail.');
                loader.remove(); // Remove loader on error
            }
        });

    }
});
</script>
 
   
 
 
 
  
    
 