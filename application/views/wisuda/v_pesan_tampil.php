<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-envelope"></i> Pesan</h1>
    </div>
    <a href="<?php echo base_url('wisuda/pesan') ?>" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>

<?php
show_alert();
$db = $this->M_vic->panggil_db();
$kodepeserta = $this->session->userdata('uid');
?>
<div class="row">
  <div class="tile col-md-4">
	<br>
    <div class="tile-inner">
		<?php foreach($pesan as $d){ ?>
        <div class="tile-body">
          	<div class="form-group">
              <label class="pull-left">Nomor Invoice</label>
      				<input type="text" name="kode1" class="form-control" value="<?php echo $d->tp_kode; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="pull-left">Subjek</label>
              <input type="text" name="judul1" class="form-control" value="<?php echo $d->tp_judul; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="pull-left">Pesan</label>
              <br>
              <?php
                $res1 = mysqli_query($db, "SELECT * FROM tbl_pesan WHERE tp_kode = '".$d->tp_kode."' ORDER BY tp_id ASC");
                while($rs1 = mysqli_fetch_array ($res1)){
                  if($rs1['h_pengguna'] == $rs1['tp_mahasiswa']){
                    echo '<div class="alert alert-success">'.$rs1['tp_pesan'].'</div>';
                  }else{
                    echo '<div class="alert alert-danger">'.$rs1['tp_pesan'].'</div>';
                  }
                }
              ?>

            </div>
        </div>
      </div>
      <br>
    </div>
    <div class="tile col-md-8">
    <br>
      <div class="tile-inner">
        <div class="tile-body">
          <form method="post" action="<?php echo base_url().'wisuda/pesan_balas_act' ?>" enctype="multipart/form-data">
            <div class="form-group">
              <input type="hidden" name="uid" value="<?php echo $d->tp_id; ?>">
              <input type="hidden" name="kode" value="<?php echo $d->tp_kode; ?>">
              <input type="hidden" name="tujuan" value="<?php echo $d->tp_admin; ?>">
              <input type="hidden" name="judul" value="<?php echo $d->tp_judul; ?>">

              <label class="pull-left">BALAS PESAN</label> <br><br>
              <textarea name="pesan" class="ckeditor form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-save"> KIRIM</i></button>
            
          </form>
        </div>

      </div>
      <br>
    </div>
        <?php } ?>
</div>
</main>
