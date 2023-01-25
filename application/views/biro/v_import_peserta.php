<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Import Mahasiswa</h1>
    </div>
  </div>
  <?php show_alert(); ?>
  <div class="row">
    <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Form Import Mahasiswa</h3>
            <div class="tile-body">
              <form method="post" action="<?php echo base_url('biro/import_peserta_add') ?>" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">File Import Data</label>
                  <input class="form-control col-md-4" type="file" name="userfile">
                </div>
            <div class="tile-footer">
              <a title="Download Format" class="btn btn-info" href="<?php echo base_url().'excel/format_import_file.xlsx' ?>"><i class="fa fa-fw fa-lg fa-download"></i>Template</a>&nbsp;&nbsp;&nbsp;
              <button title="Import Data Mahasiswa" class="btn btn-primary" type="submit" name="import" value="Import"><i class="fa fa-fw fa-lg fa-check-circle"></i>Import</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/peserta') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </div>
        </div>
  </div>
</main>