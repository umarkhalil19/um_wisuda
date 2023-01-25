<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Buat Pesan Baru</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
      <div class="tile">
        <h3 class="tile-title">Form Buat Pesan Baru</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url('mahasiswa/pesan_add_act') ?>" enctype="multipart/form-data">
            <?php 
                $auto="MUH001001";
                $db = $this->M_vic->panggil_db();
                $read=mysqli_query($db, "SELECT max(tp_kode) as terakhir from tbl_pesan");
                if ($rec=mysqli_fetch_array($read)) {
                  $lastID = $rec['terakhir']; 
                  $lastNoUrut = substr($lastID,5, 6); 
                  $nextNoUrut = $lastNoUrut + 1;
                  $nextID = "MUH00".sprintf("%03s",$nextNoUrut);
                }
             ?>
            <div class="form-group">
              <label class="control-label">Kode Pesan</label>
              <input type="text" disabled name="kode" class="form-control" value="<?php echo $nextID ?>">
              <input type="hidden" name="kode" class="form-control" value="<?php echo $nextID ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Penerima</label>
              <input class="form-control" type="penerima" name="penerima" placeholder="Penerima" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Subject</label>
              <input type="text" name="judul" class="form-control" placeholder="Subject" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Isi Pesan</label>
              <textarea class="form-control" name="isi"></textarea>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('mahasiswa/pesan') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>