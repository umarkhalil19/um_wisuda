<main class="app-content">
  
  <?php 
  show_alert();
  $auto="01";
  $db = $this->M_vic->panggil_db();
  $read=mysqli_query($db, "select fakultas_id from tbl_fakultas order by fakultas_id desc");
  if ($rec=mysqli_fetch_array($read)) {
    $auto=$rec[0]+1;
    if ($auto<10) $auto="0".$auto;
  }
  ?>

  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Fakultas</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
      <div class="tile">
        <h3 class="tile-title">Form Tambah Fakultas</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url() ?>biro/fakultas_add_act" enctype="multipart/form-data">
            <div class="form-group">
              <label class="pull-left">Kode Fakultas</label>
              <input type="hidden" name="fakultas_id" class="form-control" value="<?php echo $auto; ?>">
              <input type="text" name="fakultas_id1" class="form-control" value="<?php echo $auto; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="control-label">Nama Fakultas</label>
              <input class="form-control" type="text" name="fakultas" placeholder="Nama Fakultas">
              <?php echo form_error('fakultas'); ?>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/fakultas') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>