<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa"></i> Halaman Cetak Buku Wisuda</h1>
    </div>
  </div>
  <?php show_alert(); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        <?php echo form_open('biro/page_add_act'); ?>
          <div class="box-body">
            <div class="form-group">
              <input type="text" name="page_tittle" class="form-control" placeholder="Post Tittle" autofocus required>
            </div>
            <div class="form-group">
              <textarea name="page_content" class="ckeditor form-control" id="editor1"></textarea>
            </div>
          </div>
          <p align="right">
          <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
            <a class="btn btn-danger" href="<?php echo base_url('biro/page') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </p>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
</main>
