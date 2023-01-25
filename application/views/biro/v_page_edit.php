<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa"></i> Ubah Data Halaman Cetak Buku Wisuda</h1>
    </div>
  </div>
  <?php show_alert(); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        <?php foreach ($pages as $page) { ?>
          <?php echo form_open('biro/page_update/'.$page->page_id); ?>
            <div class="box-body">
              <div class="form-group">
                <input type="text" name="page_tittle" class="form-control" value="<?php echo $page->page_tittle; ?>" required>
              </div>
              <div class="form-group">
                <textarea name="page_content" class="ckeditor form-control" id="editor1"><?php echo $page->page_content; ?></textarea>
              </div>
              <input type="hidden" name="id" value="<?php echo $page->page_id; ?>">
            </div>
            <p align="right">
            <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/page') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </p>
          <?php echo form_close(); ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</main>

