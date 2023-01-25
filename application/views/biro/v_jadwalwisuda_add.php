<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Jadwal Wisuda</h1>
    </div>
  </div>
  
<?php 
  show_alert();
  $thn = date('Y');
  $auto="01";
  $db = $this->M_vic->panggil_db();
  $read=mysqli_query($db, "SELECT SUBSTR(jadwal_id, 5) FROM tbl_jadwalwisuda WHERE jadwal_tahun = '$thn' ORDER BY jadwal_id DESC");
  if ($rec=mysqli_fetch_array($read)) {
    $auto=$rec[0]+1;
    if ($auto<10) $auto="0".$auto;
  }
?>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Form Tambah Jadwal</h3>
            <div class="tile-body">
              <form method="post" action="<?php echo base_url() ?>biro/jadwalwisuda_add_act" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">Angkatan</label>
                  <input type="hidden" name="jadwal_id" class="form-control" value="<?php echo $auto; ?>">
                  <input class="form-control" type="text" name="angkatan" placeholder="Angkatan" autocomplete="off" autofocus required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Tahun</label>
                  <input class="form-control" type="text" name="tahun" value="<?php echo $thn; ?>" placeholder="Tahun" maxlength="4" autocomplete="off" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Kuota</label>
                  <input class="form-control" type="number" name="kuota" placeholder="Kuota" autocomplete="off" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Tanggal Pelaksanaan</label>
                  <input class="form-control" type="text" id="demoDate1" name="tanggal" placeholder="yyyy-mm-dd" autocomplete="off" required="">
                </div>
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
                  <a class="btn btn-danger" href="<?php echo base_url('biro/jadwalwisuda') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
          </div>
        </div>
  </div>
</main>