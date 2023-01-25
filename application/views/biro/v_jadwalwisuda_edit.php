<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Edit Jadwal Wisuda</h1>
    </div>
  </div>
  
<?php show_alert(); ?>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Form Edit Jadwal</h3>
            <div class="tile-body">
            <?php foreach($edit as $u){  ?>
              <form method="post" action="<?php echo base_url() ?>biro/jadwalwisuda_update" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">Angkatan</label>
                  <input type="hidden" name="jadwal_id" class="form-control" value="<?php echo $u->jadwal_id; ?>">
                  <input class="form-control" type="text" name="angkatan" placeholder="Angkatan" autocomplete="off" autofocus required="" value="<?php echo $u->jadwal_nama; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Tahun</label>
                  <input class="form-control" type="text" name="tahun" placeholder="Tahun" maxlength="4" autocomplete="off" required="" value="<?php echo $u->jadwal_tahun; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Kuota</label>
                  <input class="form-control" type="number" name="kuota" placeholder="Kuota" autocomplete="off" required="" value="<?php echo $u->jadwal_kuota; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Tanggal Pelaksanaan</label>
                  <input class="form-control" type="text" id="demoDate1" name="tanggal" placeholder="yyyy-mm-dd" autocomplete="off" required="" value="<?php echo $u->jadwal_tanggal; ?>">
                </div>
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
                  <a class="btn btn-danger" href="<?php echo base_url('biro/jadwalwisuda') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
          </form>
          <?php } ?>
          </div>
        </div>
  </div>
</main>