<?php $this->load->view('admin/includes/header');?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <?php $this->load->view('admin/includes/sidebar');?>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Showcase Collection Section</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
      <li><a href="<?php echo base_url();?>admin/SignatureCollection">Showcase Collections</a></li>
      <li class="active">Add Section</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">

        <?php if($this->session->flashdata('error')) {?>
          <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->flashdata('error');?>
          </div>
        <?php }?>

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Section Record</h3>
          </div>

          <form action="<?php echo base_url();?>admin/SignatureCollection/AddCollection" method="post" enctype="multipart/form-data">
            <div class="box-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="section_name">Admin Section Display Name *</label>
                    <input type="text" name="section_name" id="section_name" class="form-control" required placeholder="e.g. Everyday Icons, Raw Minerals, etc." />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="section_key">Section Key / Identifier (Unique slug)</label>
                    <input type="text" name="section_key" id="section_key" class="form-control" placeholder="e.g. everyday_icons, raw_minerals (Auto-generated if empty)" />
                  </div>
                </div>
              </div>

              <hr />

              <div class="form-group">
                <label for="eyebrow">Eyebrow / Category Label</label>
                <input type="text" name="eyebrow" id="eyebrow" class="form-control" required placeholder="e.g. Everyday Icons, Raw Minerals to Fine Jewellery" />
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Main Title (Standard Serif Font)</label>
                    <input type="text" name="title" id="title" class="form-control" required placeholder="e.g. Natural, Quiet, Born from" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="script_text">Script Sub-title (Cursive Script Font)</label>
                    <input type="text" name="script_text" id="script_text" class="form-control" placeholder="e.g. beauty., luxury., the earth." />
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="description">Section Description Text</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter paragraph description..."></textarea>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="button_text">Button Text</label>
                    <input type="text" name="button_text" id="button_text" class="form-control" placeholder="e.g. Explore the Collection, Shop Icons" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="button_link">Button Link (URL / Anchor)</label>
                    <input type="text" name="button_link" id="button_link" class="form-control" placeholder="e.g. #collections, /category/everyday" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="0" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>

              <hr />

              <div class="well well-sm" style="background: #f9f9f9;">
                <div class="form-group" style="margin-bottom: 0;">
                  <label for="new_images"><i class="fa fa-upload"></i> Upload Showcase Images (Select multiple files):</label>
                  <input type="file" name="new_images[]" id="new_images" class="form-control" multiple accept="image/*,.webp,.avif" />
                  <p class="help-block" style="margin-bottom:0;"><small>Supported formats: JPG, PNG, WEBP, AVIF. Hold Ctrl/Cmd to select multiple images.</small></p>
                </div>
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Section Record</button>
              <a href="<?php echo base_url();?>admin/SignatureCollection" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/includes/footer');?>
