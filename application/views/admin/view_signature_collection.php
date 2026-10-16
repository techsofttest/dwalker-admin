<?php $this->load->view('admin/includes/header');?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Showcase Collection Sections</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
      <li class="active">Showcase Collections</li>
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
            <h3 class="box-title">Showcase Collections List</h3>
            <a href="<?php echo base_url();?>admin/SignatureCollection/AddCollection" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Section Record</a>
          </div>

          <div class="box-body table-responsive">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 50px;">Sl No</th>
                  <th>Section Name</th>
                  <th>Section Key</th>
                  <th>Eyebrow & Heading</th>
                  <th>Button Info</th>
                  <th style="width: 90px;">Images</th>
                  <th style="width: 80px;">Sort Order</th>
                  <th style="width: 80px;">Status</th>
                  <th style="width: 140px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($collections)) { 
                  $i = 1;
                  foreach($collections as $c) { 
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                      <strong><?php echo htmlspecialchars($c['section_name'] ?: $c['eyebrow']); ?></strong>
                    </td>
                    <td>
                      <code><?php echo htmlspecialchars($c['section_key']); ?></code>
                    </td>
                    <td>
                      <small class="text-uppercase text-muted" style="letter-spacing:1px; display:block;"><?php echo htmlspecialchars($c['eyebrow']); ?></small>
                      <strong style="font-size: 15px;"><?php echo htmlspecialchars($c['title']); ?> <em><?php echo htmlspecialchars($c['script_text']); ?></em></strong>
                    </td>
                    <td>
                      <?php if(!empty($c['button_text'])) { ?>
                        <div><span class="label label-primary"><?php echo htmlspecialchars($c['button_text']); ?></span></div>
                        <small class="text-muted"><?php echo htmlspecialchars($c['button_link']); ?></small>
                      <?php } else { echo '<em class="text-muted">None</em>'; } ?>
                    </td>
                    <td>
                      <span class="badge bg-purple"><i class="fa fa-picture-o"></i> <?php echo $c['image_count']; ?> files</span>
                    </td>
                    <td><?php echo $c['sort_order']; ?></td>
                    <td>
                      <?php if($c['status'] == 1) { ?>
                        <span class="label label-success">Active</span>
                      <?php } else { ?>
                        <span class="label label-danger">Inactive</span>
                      <?php } ?>
                    </td>
                    <td>
                      <a href="<?php echo base_url();?>admin/SignatureCollection/EditCollection/<?php echo $c['id'];?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                      <a href="<?php echo base_url();?>admin/SignatureCollection/DeleteCollection/<?php echo $c['id'];?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this collection section record?');"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>
                <?php } } else { ?>
                  <tr>
                    <td colspan="9" class="text-center text-muted">No showcase collection sections found. Click "Add New Section Record" to create one.</td>
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
