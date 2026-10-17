<?php $this->load->view('admin/includes/header');?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      List Blogs
      <small><a href="<?php echo base_url();?>admin/Blogs/AddBlog" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Blog</a></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Admin Home</a></li>
      <li class="active">Blogs</li>
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

            <table id="datatable" class="table table-bordered table-striped delTable">
              <thead>
                <tr>
                  <th style="width: 50px;">Sl no</th>
                  <th style="width: 100px;">Image</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Date</th>
                  <th style="width: 150px; text-align: center;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php if(!empty($blogs)): ?>
                  <?php foreach($blogs as $b): ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td>
                        <?php if(!empty($b->image) && file_exists('uploads/Blogs/'.$b->image)): ?>
                          <img src="<?php echo base_url(); ?>uploads/Blogs/<?php echo $b->image; ?>" style="width: 70px; height: 50px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                          <span class="label label-default">No image</span>
                        <?php endif; ?>
                      </td>
                      <td><strong><?php echo htmlspecialchars($b->title); ?></strong></td>
                      <td><code>/blogs/<?php echo htmlspecialchars($b->slug); ?></code></td>
                      <td><?php echo !empty($b->blog_date) ? date('d M Y', strtotime($b->blog_date)) : '-'; ?></td>
                      <td style="text-align: center;">
                        <a href="<?php echo base_url(); ?>admin/Blogs/EditBlog/<?php echo $b->id; ?>" class="btn btn-xs btn-warning" title="Edit">
                          <i class="fa fa-pencil"></i> Edit
                        </a>
                        &nbsp;
                        <a href="<?php echo base_url(); ?>admin/Blogs/DeleteBlog/<?php echo $b->id; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this blog?');" title="Delete">
                          <i class="fa fa-trash"></i> Delete
                        </a>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>

          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section>
  <!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/includes/footer');?>
