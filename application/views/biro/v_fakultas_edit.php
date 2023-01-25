<main class="app-content">
<?php show_alert(); ?>
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Edit Fakultas</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Form Edit Fakultas</h3>
            <div class="tile-body">
          <?php foreach($edit as $u){  ?>
              <form method="post" action="<?php echo base_url() ?>biro/fakultas_update" enctype="multipart/form-data">
				<div class="form-group">
				  <label class="pull-left">Kode Fakultas</label>
					<input type="hidden" name="fakultas_id" class="form-control" value="<?php echo $u->fakultas_id; ?>">
					<input type="text" name="fakultas_id1" class="form-control" value="<?php echo $u->fakultas_id; ?>" disabled>
				</div>
                <div class="form-group">
                  <label class="control-label">Nama Fakultas</label>
					<input type="text" name="fakultas" class="form-control" value="<?php echo $u->fakultas_nama ?>" autofocus>
					<?php echo form_error('fakultas'); ?>
                </div>
				<div class="tile-footer">
				  <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
				  <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
				  <a class="btn btn-danger" href="<?php echo base_url('biro/fakultas') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
				</div>
				</form>
          <?php } ?>
          </div>
        </div>
  </div>
</main>