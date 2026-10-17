<?php $this->load->view('admin/includes/header');?>
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Edit Blog
      <small><a href="<?php echo base_url();?>admin/Blogs" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to Blogs</a></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Admin Home</a></li>
      <li><a href="<?php echo base_url();?>admin/Blogs">Blogs</a></li>
      <li class="active">Edit Blog</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <form method="post" action="<?php echo base_url();?>admin/Blogs/EditBlog/<?php echo $blog['id'];?>" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label>Blog Title <span class="text-danger">*</span></label>
                <input class="form-control" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" type="text" required>
              </div>

              <div class="form-group">
                <label>Custom URL Slug</label>
                <input class="form-control" name="slug" value="<?php echo htmlspecialchars($blog['slug']); ?>" type="text">
                <p class="help-block">Public URL: <code>/blogs/<?php echo htmlspecialchars($blog['slug']); ?></code></p>
              </div>

              <div class="form-group">
                <label>Publish Date</label>
                <input class="form-control" name="blog_date" type="date" value="<?php echo $blog['blog_date'] ? date('Y-m-d', strtotime($blog['blog_date'])) : date('Y-m-d'); ?>">
              </div>

              <div class="form-group">
                <label>Featured Image</label>
                <?php if(!empty($blog['image']) && file_exists('uploads/Blogs/'.$blog['image'])): ?>
                  <div style="margin-bottom: 10px;">
                    <img src="<?php echo base_url(); ?>uploads/Blogs/<?php echo $blog['image']; ?>" style="max-width: 200px; height: auto; border: 1px solid #ddd; border-radius: 4px; padding: 4px;">
                  </div>
                <?php endif; ?>
                <input class="form-control" name="image" type="file" accept="image/*,.webp,.avif">
                <p class="help-block">Select a new image only if you wish to replace the current one.</p>
              </div>

              <div class="form-group">
                <label>Short Summary / Snippet <span class="text-danger">*</span></label>
                <textarea class="form-control" name="short_desc" rows="3" required><?php echo htmlspecialchars($blog['short_desc']); ?></textarea>
              </div>

              <div class="form-group">
                <label>Blog Full Content (Rich Text) <span class="text-danger">*</span></label>
                <textarea class="form-control" name="content" id="editor1" rows="10"><?php echo htmlspecialchars($blog['content']); ?></textarea>
              </div>

              <hr>
              <h4 style="font-weight: 600; color: #1a365d;"><i class="fa fa-search"></i> SEO Optimization Meta Fields</h4>

              <div class="form-group">
                <label>Meta Title</label>
                <input class="form-control" name="meta_title" value="<?php echo htmlspecialchars($blog['meta_title']); ?>" type="text">
              </div>

              <div class="form-group">
                <label>Meta Description</label>
                <textarea class="form-control" name="meta_description" rows="3"><?php echo htmlspecialchars($blog['meta_description']); ?></textarea>
              </div>

              <div class="form-group">
                <label>Meta Keywords</label>
                <input class="form-control" name="meta_keywords" value="<?php echo htmlspecialchars($blog['meta_keywords']); ?>" type="text">
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update Blog</button>
              <a href="<?php echo base_url();?>admin/Blogs" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/includes/footer');?>
