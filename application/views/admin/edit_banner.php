<?php $this->load->view('admin/includes/header');?>
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Hero Banner Slide</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
      <li><a href="<?php echo base_url();?>admin/Banners">Banners</a></li>
      <li class="active">Edit Banner</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        
        <?php if($this->session->flashdata('error')) {?>
          <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->flashdata('error');?>
          </div>
        <?php }?>

        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Banner Slide #<?php echo $banner['banner_id']; ?></h3>
          </div>

          <form action="<?php echo base_url();?>admin/Banners/EditBanner/<?php echo $banner['banner_id']; ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
              
              <!-- Current Media Preview -->
              <div class="form-group">
                <label>Current Media Preview</label>
                <div>
                  <?php 
                    $media_url = base_url('uploads/Banners/' . $banner['media_file']);
                    if($banner['media_type'] === 'video') { 
                  ?>
                    <video width="260" height="150" controls muted style="border-radius: 4px; border: 1px solid #ccc; object-fit: cover;">
                      <source src="<?php echo $media_url; ?>">
                    </video>
                  <?php } else { ?>
                    <img src="<?php echo $media_url; ?>" style="max-width: 260px; max-height: 150px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;" />
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label for="media_file">Replace Media File (Optional)</label>
                <input type="file" name="media_file" id="media_file" class="form-control" accept="image/*,.webp,.avif,video/*" />
                <p class="help-block"><small>Leave empty to keep the current media file. Upload new JPG, PNG, WEBP, AVIF, or MP4 to replace.</small></p>
              </div>

              <div class="form-group">
                <label for="small_text">Small Eyebrow Text / Subtitle</label>
                <input type="text" name="small_text" id="small_text" class="form-control" value="<?php echo htmlspecialchars($banner['small_text']); ?>" />
              </div>

              <div class="form-group">
                <label for="title">Main Banner Title / Heading</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($banner['title']); ?>" />
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="button_text">Button Text</label>
                    <input type="text" name="button_text" id="button_text" class="form-control" value="<?php echo htmlspecialchars($banner['button_text']); ?>" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="button_link">Button Link URL</label>
                    <input type="text" name="button_link" id="button_link" class="form-control" value="<?php echo htmlspecialchars($banner['button_link']); ?>" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="<?php echo $banner['sort_order']; ?>" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="1" <?php if($banner['status'] == 1) echo 'selected'; ?>>Active</option>
                      <option value="0" <?php if($banner['status'] == 0) echo 'selected'; ?>>Inactive</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Update Banner Slide</button>
              <a href="<?php echo base_url();?>admin/Banners" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/includes/footer');?>
