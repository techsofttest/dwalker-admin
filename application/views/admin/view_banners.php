<?php $this->load->view('admin/includes/header');?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Hero Banners / Carousel</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
      <li class="active">Banners</li>
    </ol>
  </section>

  <!-- Main content -->
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
          <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->flashdata('error');?>
          </div>
        <?php }?>

        <div class="box">
          <div class="box-header with-border" style="display:flex; justify-content:space-between; align-items:center;">
            <h3 class="box-title">Banner Slides List</h3>
            <a href="<?php echo base_url();?>admin/Banners/AddBanner" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Banner Slide</a>
          </div>

          <div class="box-body table-responsive">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 50px;">Sl No</th>
                  <th style="width: 160px;">Media Preview</th>
                  <th>Small Text</th>
                  <th>Title / Heading</th>
                  <th>Button Text & Link</th>
                  <th style="width: 80px;">Sort Order</th>
                  <th style="width: 80px;">Status</th>
                  <th style="width: 120px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($banners)) { 
                  $i = 1;
                  foreach($banners as $b) { 
                    $media_url = base_url('uploads/Banners/' . $b['media_file']);
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td text-align="center">
                      <?php if($b['media_type'] === 'video') { ?>
                        <video width="140" height="80" controls muted style="border-radius: 4px; border: 1px solid #ddd; object-fit: cover;">
                          <source src="<?php echo $media_url; ?>">
                          Your browser does not support video.
                        </video>
                        <div><span class="label label-info"><i class="fa fa-video-camera"></i> Video</span></div>
                      <?php } else { ?>
                        <img src="<?php echo $media_url; ?>" alt="Banner" style="width: 140px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;" />
                        <div><span class="label label-default"><i class="fa fa-picture-o"></i> Image</span></div>
                      <?php } ?>
                    </td>
                    <td><small><?php echo htmlspecialchars($b['small_text']); ?></small></td>
                    <td><strong><?php echo htmlspecialchars($b['title']); ?></strong></td>
                    <td>
                      <?php if(!empty($b['button_text'])) { ?>
                        <div><span class="label label-primary"><?php echo htmlspecialchars($b['button_text']); ?></span></div>
                        <small class="text-muted"><?php echo htmlspecialchars($b['button_link']); ?></small>
                      <?php } else { echo '<em class="text-muted">None</em>'; } ?>
                    </td>
                    <td><?php echo $b['sort_order']; ?></td>
                    <td>
                      <?php if($b['status'] == 1) { ?>
                        <span class="label label-success">Active</span>
                      <?php } else { ?>
                        <span class="label label-danger">Inactive</span>
                      <?php } ?>
                    </td>
                    <td>
                      <a href="<?php echo base_url();?>admin/Banners/EditBanner/<?php echo $b['banner_id'];?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                      <a href="<?php echo base_url();?>admin/Banners/DeleteBanner/<?php echo $b['banner_id'];?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this banner?');"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>
                <?php } } else { ?>
                  <tr>
                    <td colspan="8" class="text-center text-muted">No banner slides found. Click "Add New Banner Slide" to create one.</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/includes/footer');?>
