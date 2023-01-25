<main class="app-content">
  
<?php show_alert();?>

<div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Jurusan</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Form Tambah Jurusan</h3>
            <div class="tile-body">
		<?php foreach($jurusan as $d){ ?>
              <form method="post" action="<?php echo base_url() ?>biro/jurusan_update" enctype="multipart/form-data">
				<div class="form-group">
				  <label class="pull-left">Kode Jurusan/Prodi</label>
      				<input type="hidden" class="form-control" name="prodi_id" value="<?php echo $d->prodi_id; ?>">
      				<input type="text" name="prodi_kode" class="form-control" value="<?php echo $d->prodi_kode; ?>">
				</div>
				<div class="form-group">
				  <label class="pull-left">Nama Jurusan/Prodi</label>
				  <input type="text" name="jurusan" class="form-control" value="<?php echo $d->prodi_nama; ?>">
				  <?php echo form_error('jurusan'); ?>
				</div>
				<div class="form-group">
				  <label class="pull-left">Kode Fakultas</label>
				  <select name="fakultas" class="form-control">
					<?php foreach ($fakultas as $a){?>
					<option <?php if($a->fakultas_id==$d->prodi_fakultas){echo "selected='selected'";} ?> value="<?php echo $a->fakultas_id; ?>"><?php echo $a->fakultas_nama ?></option>
					<?php } ?>
				  </select>
				</div>
				<div class="form-group">
				  <label class="pull-left">Jenjang Jurusan/Prodi</label>
				  <select name="tingkat" class="form-control">
					<option value="<?php echo $d->prodi_tingkat; ?>"><?php echo $d->prodi_tingkat; ?></option>
					<option value="<?php echo $d->prodi_tingkat; ?>"></option>
					<option value="D3">D3</option>
					<option value="S1">S1</option>
					<option value="S2">S2</option>
				  </select>
				</div>
				<div class="form-group">
				  <label class="pull-left">Kode Internal</label>
				  <input type="number" name="internal" class="form-control" value="<?php echo $d->prodi_kode_internal; ?>">
				  <?php echo form_error('internal'); ?>
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