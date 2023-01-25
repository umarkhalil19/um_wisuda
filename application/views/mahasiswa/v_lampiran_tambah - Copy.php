<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Lampiran</h1>
    </div>
  </div>
  <?php 
  show_alert();
  $auto="01";
  $db = $this->M_vic->panggil_db();
  $id = $this->session->userdata('uid');
  $read=mysqli_query($db, "SELECT peserta_lamp_kode from tbl_peserta_lampiran WHERE peserta_kode ='$id' order by peserta_lamp_kode desc");
  if ($rec=mysqli_fetch_array($read)) {
    $auto=$rec[0]+1;
    if ($auto<10) $auto="0".$auto;
  }
  ?>

  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
      <div class="tile">
        <h3 class="tile-title">Form Tambah Lampiran</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url('mahasiswa/lampiran_add_act') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label class="pull-left">Kode Lampiran</label>
              <input type="hidden" name="lamp_kode" class="form-control" value="<?php echo $auto; ?>">
              <input type="text" name="lamp_kode" class="form-control" value="<?php echo $auto; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="control-label">File Lampiran</label>
              <input class="form-control" type="file" name="file" placeholder="Nama Lampiran" required="">
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('mahasiswa/lampiran') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>