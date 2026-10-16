<?php $this->load->view('admin/includes/header');?>
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Add New Hero Banner Slide</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
      <li><a href="<?php echo base_url();?>admin/Banners">Banners</a></li>
      <li class="active">Add Banner</li>
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

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Banner Details & Media Upload</h3>
          </div>

          <form action="<?php echo base_url();?>admin/Banners/AddBanner" method="post" enctype="multipart/form-data">
            <div class="box-body">
              
              <div class="form-group">
                <label for="media_file">Upload Image or Video File *</label>
                <input type="file" name="media_file" id="media_file" class="form-control" required accept="image/*,.webp,.avif,video/*" />
                <p class="help-block"><small>Supported formats: Images (JPG, PNG, WEBP, AVIF) or Videos (MP4, WEBM, MOV). Max size: 50MB.</small></p>
              </div>

              <div class="form-group">
                <label for="small_text">Small Eyebrow Text / Subtitle</label>
                <input type="text" name="small_text" id="small_text" class="form-control" placeholder="e.g. Handcrafted Fine Jewelry" />
              </div>

              <div class="form-group">
                <label for="title">Main Banner Title / Heading</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Timeless Elegance Defined" />
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="button_text">Button Text</label>
                    <input type="text" name="button_text" id="button_text" class="form-control" placeholder="e.g. Explore Collection" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="button_link">Button Link URL</label>
                    <input type="text" name="button_link" id="button_link" class="form-control" placeholder="e.g. /collections or #new-arrivals" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="0" />
                    <p class="help-block"><small>Lower numbers display first in the carousel.</small></p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Banner Slide</button>
              <a href="<?php echo base_url();?>admin/Banners" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/includes/footer');?>
