<?php $this->load->view('admin/includes/header');?>
<style>

 .file-browser {	 
	 color: white;
	 padding: 20px 10px;
  color: #15191a;  
  font-size: 20px;
}
 .file {
	 color: #222d32;
	 display: flex;
	 list-style: none;
  font-size: 18px;
  margin-bottom: 8px;
}

 .folder {
	 list-style: none;
	 cursor: pointer;
	 margin: 4px 0;
}
 .folder > ul {
	 display: none;
}
 .folder:before {
	 padding: 5px;
	 height: 25px;
  width: 25px;
  font-size: 25px;
	 text-align: center;
	 line-height: 10px;
	 background: #5f6f72;
	 border-radius: 1px;
	 display: inline-block;
	 content: '+';
  color: white;
}
 .folder.folder-open > ul {
	 display: block;
	 padding-left: 15px;
	 margin-left: 15px;
	 border-left: 2px solid #5f6f72;
  margin-bottom:10px;
}
 .folder.folder-open:before {
	 content: '-';
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
           List Teams        
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
 
<div class="wrapper1"> 
    <div class="file-browser">
    <?php foreach ($grouped as $index => $group){ ?>
        <ul>
            <li class="folder">               
                Team <?php echo $index + 1; ?>               
                <ul>            
                <?php $n=1;foreach ($group as $user){ ?>
                 <li class="file"><p style="width:5%"><?php echo $n?></p><p style="width:15%"><?php echo $user->FULLNAME; ?></p><p style="width:15%"><?php echo $user->EMAIL_ID; ?></p></li>
                    <?php $n++;} ?>                 
                </ul>
            </li>           
        </ul>
       <?php } ?>      
    </div>                    			   
   
   
        </section>
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

 <script>
 $(function() {
    $('.folder').on('click', function(e) {
        $(this).toggleClass('folder-open');
        e.stopPropagation();
    });
    
    $('.file').on('click', function(e) {
       e.stopPropagation(); 
    });
})
</script>