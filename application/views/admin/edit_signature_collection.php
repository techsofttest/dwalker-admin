<?php $this->load->view('admin/includes/header');?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Collection Section: <?php echo htmlspecialchars($record['section_name'] ?: $record['eyebrow']); ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
      <li><a href="<?php echo base_url();?>admin/SignatureCollection">Showcase Collections</a></li>
      <li class="active">Edit Section</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">

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

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Section Record & Gallery</h3>
          </div>

          <form action="<?php echo base_url();?>admin/SignatureCollection/EditCollection/<?php echo $record['id'];?>" method="post" enctype="multipart/form-data">
            <div class="box-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="section_name">Admin Section Display Name *</label>
                    <input type="text" name="section_name" id="section_name" class="form-control" required value="<?php echo htmlspecialchars($record['section_name'] ?: $record['eyebrow']); ?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="section_key">Section Key / Identifier (Unique slug)</label>
                    <input type="text" name="section_key" id="section_key" class="form-control" value="<?php echo htmlspecialchars($record['section_key']); ?>" />
                  </div>
                </div>
              </div>

              <hr />

              <!-- Text Content Group -->
              <div class="form-group">
                <label for="eyebrow">Eyebrow / Subtitle</label>
                <input type="text" name="eyebrow" id="eyebrow" class="form-control" required value="<?php echo htmlspecialchars($record['eyebrow']); ?>" />
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Main Title (Standard Serif Font)</label>
                    <input type="text" name="title" id="title" class="form-control" required value="<?php echo htmlspecialchars($record['title']); ?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="script_text">Script Sub-title (Cursive Script Font)</label>
                    <input type="text" name="script_text" id="script_text" class="form-control" value="<?php echo htmlspecialchars($record['script_text']); ?>" />
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="description">Paragraph Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"><?php echo htmlspecialchars($record['description']); ?></textarea>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="button_text">Button Text</label>
                    <input type="text" name="button_text" id="button_text" class="form-control" value="<?php echo htmlspecialchars($record['button_text']); ?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="button_link">Button Link (URL / Anchor)</label>
                    <input type="text" name="button_link" id="button_link" class="form-control" value="<?php echo htmlspecialchars($record['button_link']); ?>" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="<?php echo (int)$record['sort_order']; ?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="1" <?php echo ($record['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                      <option value="0" <?php echo ($record['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                  </div>
                </div>
              </div>

              <hr />

              <!-- Images Settings Group -->
              <h4 class="text-primary" style="margin-top: 15px; border-bottom: 1px solid #eee; padding-bottom: 8px;"><i class="fa fa-picture-o"></i> Unlimited Slideshow Gallery Images</h4>
              <p class="text-muted"><small>Upload any number of images for this section. They will automatically cycle as a smooth slideshow in the frontend.</small></p>

              <!-- Upload New Images -->
              <div class="well well-sm" style="background: #f9f9f9;">
                <div class="form-group" style="margin-bottom: 0;">
                  <label for="new_images"><i class="fa fa-upload"></i> Upload Additional Images (Select multiple files):</label>
                  <input type="file" name="new_images[]" id="new_images" class="form-control" multiple accept="image/*,.webp,.avif" />
                  <p class="help-block" style="margin-bottom:0;"><small>Supported formats: JPG, PNG, WEBP, AVIF. Hold Ctrl/Cmd to select multiple images.</small></p>
                </div>
              </div>

              <!-- Current Gallery Grid -->
              <h5 style="margin-top: 20px; font-weight: bold;">Current Showcase Images (<?php echo count($images); ?>)</h5>
              
              <?php if(!empty($images)) { ?>
                <div class="row">
                  <?php foreach($images as $img) { 
                    $img_file = base_url('uploads/Signature/' . $img['image_file']);
                  ?>
                    <div class="col-sm-3 col-xs-6" style="margin-bottom: 15px;">
                      <div class="panel panel-default text-center" style="box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        <div class="panel-body" style="padding: 10px;">
                          <div style="height: 120px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 4px; margin-bottom: 8px;">
                            <img src="<?php echo $img_file; ?>" alt="Showcase" style="max-height: 100%; max-width: 100%; object-fit: cover;" />
                          </div>
                          <div class="form-group" style="margin-bottom: 8px;">
                            <label style="font-size: 11px; margin-bottom: 2px;">Sort Order:</label>
                            <input type="number" name="sort_orders[<?php echo $img['id']; ?>]" value="<?php echo $img['sort_order']; ?>" class="form-control input-sm text-center" style="width: 70px; margin: 0 auto;" />
                          </div>
                          <a href="<?php echo base_url('admin/SignatureCollection/DeleteImage/' . $img['id'] . '/' . $record['id']); ?>" class="btn btn-xs btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this image?');">
                            <i class="fa fa-trash"></i> Delete
                          </a>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              <?php } else { ?>
                <p class="text-muted"><em>No images uploaded for this section yet. Use the upload box above to add images.</em></p>
              <?php } ?>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
              <a href="<?php echo base_url();?>admin/SignatureCollection" class="btn btn-default">Back to List</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/includes/footer');?>
