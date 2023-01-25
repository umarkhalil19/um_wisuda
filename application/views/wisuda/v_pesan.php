<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Pesan</h1>
    </div>
    <a href="<?php echo base_url('wisuda/pesan_add') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Kirim Pesan</a>
  </div>
<?php show_alert(); ?>
<div class="row">
  <div class="tile col-md-12">
    <br>
    <div class="tile-inner">
        <div class="tile-body">
      <b>Semua Data Pesan </b>
          <hr>
          <table class="table table-bordered table-hover" id="table-datatable">
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Nomor Invoice</th>
                <th>Subjek</th>
                <th>Isi</th>
               <th width="100px">Option</th>
              </tr>
            </thead>
            <tbody>
              <?php
      $no = 1;
      foreach($pesan as $d){
        ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $d->tp_kode; ?></td>
          <td>
            <?php
			  $db = $this->M_vic->panggil_db();
              $balas = mysqli_query($db, "SELECT COUNT(tp_id) FROM tbl_pesan WHERE tp_status_baca = 'Belum Dibaca' AND h_pengguna != tp_mahasiswa AND tp_kode = '".$d->tp_kode."' ");
              $b1 = mysqli_fetch_array ($balas);
              //echo $b1[0];

			  $status = "";
			  //if($d->h_pengguna != $d->tp_mahasiswa){
			  if($d->h_pengguna != $d->tp_mahasiswa){
                $status = " <b> - masuk</b> <i>(".TanggalIndo($d->tp_tanggal).")</i>";
              }else{
                $status = " <b> - keluar</b> <i>(".TanggalIndo($d->tp_tanggal).")</i>";
              }
              //if($d->tp_status_baca == 'Belum Dibaca' && $d->h_pengguna != $d->tp_mahasiswa){
				if(($d->tp_status_baca == 'Belum Dibaca' && $d->h_pengguna != $d->tp_mahasiswa) || ($b1[0] > 0)){
                echo $d->tp_judul.$status.'
                <br>
                <a style="color: red;" href="'.base_url().'wisuda/pesan_tampil/'.$d->tp_kode.'" title="Lihat Pesan">
                  Belum Dibaca ('.$b1[0].')
                </a>';
              }else{
                echo $d->tp_judul.$status;
              }
            ?>
          </td>
          <td>
            <?php
              $isi1   = substr($d->tp_pesan,0,20);
              echo $isi1;
            ?>
          </td>
          <td>
            <div class="btn-group">
              <a class="btn btn-sm btn-info btn-outline-success" href="<?php echo base_url().'wisuda/pesan_tampil/'.$d->tp_kode ?>" title="Lihat Pesan"><i class="app-menu__icon fa fa-search"></i>Lihat</a>
            </div>
          </td>
        </tr>
        <?php
      }
      ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

</main>
