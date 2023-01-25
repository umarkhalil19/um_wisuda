<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Buat Pesan Baru</h1>
    </div>
    <a href="<?php echo base_url('mahasiswa/pesan') ?>" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>

<?php
show_alert();
$kodepeserta = $this->session->userdata('uid');
$namapeserta = $this->session->userdata('unama');
?>
<div class="row">
    <div class="tile col-md-12">
    <br>
      <div class="tile-inner">
        <div class="tile-body">
          <form method="post" action="<?php echo base_url().'mahasiswa/pesan_add_act' ?>" enctype="multipart/form-data">
            <?php
				$db = $this->M_vic->panggil_db();
                $auto="001";
                $read=mysqli_query($db, "SELECT SUBSTR(tp_kode, 7, 3) FROM tbl_pesan WHERE tp_mahasiswa = '".$kodepeserta."' ORDER BY SUBSTR(tp_kode, 7, 3) DESC");
                if ($rec=mysqli_fetch_array($read)) {
                  $auto=$rec[0]+1;
                  if ($auto<10) $auto="0".$auto;
                  if ($auto<100) $auto="0".$auto;
                }
                //echo $auto;
            ?>
            <div class="form-group">
              <input type="hidden" name="uid" value="">
              <input type="hidden" name="tujuan" value="admin">
              <input type="hidden" name="kodepeserta" value="<?php echo $kodepeserta; ?>">
              <input type="hidden" name="namapeserta" value="<?php echo $namapeserta; ?>">
              <input type="hidden" name="nomorpesan" value="<?php echo $auto; ?>">

              <label class="pull-left">KIRIM PESAN</label> <br><br>
              Subjeck:
              <input type="text" name="judul" class="form-control" value="">
              Pesan:
              <textarea name="pesan" class="ckeditor form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-save"> KIRIM</i></button>
            
          </form>
        </div>

      </div>
      <br>
    </div>
</main>
