<?php $this->load->view('admin/includes/header');?>
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add Blog
      <small><a href="<?php echo base_url();?>admin/Blogs" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to Blogs</a></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Admin Home</a></li>
      <li><a href="<?php echo base_url();?>admin/Blogs">Blogs</a></li>
      <li class="active">Add Blog</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <form method="post" action="<?php echo base_url();?>admin/Blogs/AddBlog" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label>Blog Title <span class="text-danger">*</span></label>
                <input class="form-control" name="title" placeholder="Enter Blog Title" type="text" required>
              </div>

              <div class="form-group">
                <label>Custom URL Slug (Leave blank to auto-generate from title)</label>
                <input class="form-control" name="slug" placeholder="e.g. the-d-walker-story" type="text">
              </div>

              <div class="form-group">
                <label>Publish Date</label>
                <input class="form-control" name="blog_date" type="date" value="<?php echo date('Y-m-d'); ?>">
              </div>

              <div class="form-group">
                <label>Featured Image</label>
                <input class="form-control" name="image" type="file" accept="image/*,.webp,.avif">
                <p class="help-block">Recommended aspect ratio: 16:9 or 1:1.</p>
              </div>

              <div class="form-group">
                <label>Short Summary / Snippet <span class="text-danger">*</span></label>
                <textarea class="form-control" name="short_desc" rows="3" placeholder="Brief summary displayed on listings and home page cards" required></textarea>
              </div>

              <div class="form-group">
                <label>Blog Full Content (Rich Text) <span class="text-danger">*</span></label>
                <textarea class="form-control" name="content" id="editor1" rows="10" placeholder="Write full article here"></textarea>
              </div>

              <hr>
              <h4 style="font-weight: 600; color: #1a365d;"><i class="fa fa-search"></i> SEO Optimization Meta Fields</h4>

              <div class="form-group">
                <label>Meta Title</label>
                <input class="form-control" name="meta_title" placeholder="e.g. The D Walker Story | Handcrafted New Zealand Jewellery" type="text">
              </div>

              <div class="form-group">
                <label>Meta Description</label>
                <textarea class="form-control" name="meta_description" rows="3" placeholder="SEO meta description snippet for Google search"></textarea>
              </div>

              <div class="form-group">
                <label>Meta Keywords</label>
                <input class="form-control" name="meta_keywords" placeholder="e.g. jewellery, silver, new zealand, handcrafted" type="text">
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save Blog</button>
              <a href="<?php echo base_url();?>admin/Blogs" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/includes/footer');?>
