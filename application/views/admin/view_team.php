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
    z-index: 99999;
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
           Newsletter Subscribed Users
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
            <li class="active">Newsletter Subscribers</li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
             <div class="box">
                		<div class="box-body">

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php endif; ?>

          <form method="post" style="margin-top: 20px;margin-bottom: 30px;">     
            <div class="col-lg-1"> </div>                  	
            <div class="col-lg-6">                          
              <label style="display: flex;">Select Subject / Template</label>            
              <select class="form-control" id="subject" name="subject">
                <option value="">-- Select Subject / Template --</option>
                <?php foreach($subject_list as $sub){ ?>
                  <option value="<?php echo $sub->tem_id;?>"><?php echo $sub->title; ?></option>
                <?php } ?>
              </select>                           
            </div>

            <div class="col-lg-3"> 
              <label>&nbsp;</label><br>                       
              <button type="button" class="btn btn-success btn-block" id="Sendmail"><i class="fa fa-paper-plane"></i> Send Mail</button>                
            </div>                      
          </form>
          <div class="clearfix"></div>
          <hr>
			
          <table id="datatable" class="table table-bordered table-striped delTable">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 40px; text-align: center;">
                      <input type="checkbox" id="checkAll" title="Select All">
                    </th>
                    <th style="width: 60px;">Sl no</th>
                    <th>Email Address</th>     
                    <th>Subscribed Date</th>                                                                
                    <th style="width: 120px; text-align: center;">Action</th>
                </tr>
            </thead>
            
            <tbody>
              <?php $i=1;?>
              <?php if (!empty($subscribers)) {
                foreach($subscribers as $sub){ ?>
                  <tr>
                    <td style="text-align: center;">
                      <input type="checkbox" name="check[]" class="checkbox-subscriber" value="<?php echo $sub->id; ?>">
                    </td>
                    <td><?php echo $i; ?></td>
                    <td><strong><?php echo htmlspecialchars($sub->email); ?></strong></td>
                    <td><?php echo !empty($sub->created_at) ? date('d M Y, h:i A', strtotime($sub->created_at)) : '-'; ?></td>  
                    <td style="text-align: center;">                                 
                      <a href="<?php echo base_url();?>admin/Template/DeleteSubscriber/<?php echo $sub->id;?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to remove this subscriber?');">
                        <i class="fa fa-trash"></i> Remove
                      </a>
                    </td>
                  </tr>
                <?php $i++; }
              } ?> 
            </tbody> 
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
// Toggle select all
$(document).on("change", "#checkAll", function() {
    $(".checkbox-subscriber").prop("checked", $(this).prop("checked"));
});

$(document).on("change", ".checkbox-subscriber", function() {
    if (!$(this).prop("checked")) {
        $("#checkAll").prop("checked", false);
    } else {
        if ($(".checkbox-subscriber:checked").length === $(".checkbox-subscriber").length) {
            $("#checkAll").prop("checked", true);
        }
    }
});

$(document).on("click", "#Sendmail", function(event) {
    event.preventDefault(); 
    var checkedBoxes = $('input.checkbox-subscriber:checked');
    if (checkedBoxes.length === 0) {
        alert("Please select at least one subscriber to send email.");  
        return false; 
    }

    var subject = $('#subject').val();
    if (!subject) {
        alert("Please select a Subject / Template."); 
        $('#subject').focus();
        return false; 
    }      

    var selectedItems = [];             
    checkedBoxes.each(function(){
        selectedItems.push($(this).val());
    });

    var loader = $('<div class="loader"></div>');
    $('body').append(loader);

    $.ajax({
        url: "<?php echo base_url('admin/Users/Sendmail'); ?>",
        method: "POST",           
        dataType: "json",			
        data: {
            subject: subject,
            item: selectedItems
        },                            
        success: function(data) {  
            loader.remove();
            if (data.msg == 1 || data.status == 1) {
                if (typeof alertify !== 'undefined') {
                    alertify.set('notifier', 'position', 'top-center');  
                    alertify.success('Mail Sent Successfully').delay(5).dismissOthers();
                } else {
                    alert('Mail Sent Successfully');
                }
            } else {
                if (typeof alertify !== 'undefined') {
                    alertify.set('notifier', 'position', 'top-center');  
                    alertify.error('Mail could not be sent').delay(5).dismissOthers();
                } else {
                    alert('Mail could not be sent');
                }
            }
        },
        error: function() {
            loader.remove();
            alert('Error occurred while sending mail.');
        }
    });                 
});
</script>