<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Peserta Wisuda per Predikat Kelulusan</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php show_alert(); ?>
        <form target="" action="" method="post">
          <table width="100%">
            <tr>
              <td width="20%">
                <label class="control-label"><strong>Sesi Wisuda</strong></label>
                <select class="form-control col-md-12" name="sesi" id="sesi" onchange="(window.location = this.options[this.selectedIndex].value);">
                  <option value="">----- Pilih -----</option>
                  <?php foreach ($sesi_wisuda as $s) { ?>
                  <option <?php if($sesi == $s->jadwal_id){ echo "selected";} ?> value='<?php echo $s->jadwal_id; ?>'><?php echo $s->jadwal_nama.' ('.date("d-m-Y", strtotime($s->jadwal_tanggal)).')' ?></option>
                  <?php } ?>
                </select>
              </td>
              <td width="80%" valign="bottom" align="right">
                <?php /*<a class="btn btn-outline-primary" href="<?php echo base_url().'biro/laporan_wisuda_1_cetak/'.$sesi; ?>" title="Cetak Data"><span class="fa fa-file-pdf-o"></span>Cetak Buku Wisuda</a>*/ ?>
              </td>
            </tr>
          </table>
          <br>
        </form>
        <div class="tile-body" style="font-size:12px;">
          <table class="table table-hover table-bordered">
            <thead>
              <tr style="background-color:lightgreen;">
                <th width="80%">Jumlah Calon Peserta <?php if($thn > 0){echo 'Tahun '.$thn;} ?></th>
                <td width="02%">:</td>
                <td width="18%">
                  <?php 
                    $peserta1=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE YEAR(h_tanggal) = '$thn' ");
                    $p1=mysqli_num_rows($peserta1);
                    echo $p1; 
                  ?>
                </td>
              </tr>
              <tr>
                <th>Jumlah Peserta Sudah Lengkapi Biodata</th>
                <td>:</td>
                <td>
                  <?php 
                    $peserta2=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE YEAR(h_tanggal) = '$thn' AND peserta_no_ktp != '' ");
                    $p2=mysqli_num_rows($peserta2);
                    echo $p2;
                  ?>
                </td>
              </tr>
              <tr style="background-color:pink;">
                <th>Jumlah Peserta Belum Lengkapi Biodata</th>
                <td>:</td>
                <td>
                  <?php 
                   echo $p1 - $p2;
                  ?>
                </td>
              </tr>
              <tr>
                <th>Jumlah Peserta Sudah Upload Lampiran</th>
                <td>:</td>
                <td>
                  <?php 
                    $peserta3=mysqli_query($db, "SELECT * FROM tbl_peserta a, tbl_peserta_lampiran b WHERE YEAR(a.h_tanggal) = '$thn' AND a.peserta_no_ktp != '' AND a.peserta_kode = b.peserta_kode GROUP BY a.peserta_kode ");
                    $p3=mysqli_num_rows($peserta3);
                    echo $p3;
                  ?>
                </td>
              </tr>
              <tr style="background-color:pink;">
                <th>Jumlah Peserta Belum Upload Lampiran</th>
                <td>:</td>
                <td>
                  <?php 
                   echo $p2 - $p3;
                  ?>
                </td>
              </tr>
              <tr>
                <th>Jumlah Peserta Sudah Diverifikasi</th>
                <td>:</td>
                <td>
                  <?php 
                    $peserta4=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE YEAR(h_tanggal) = '$thn' AND peserta_status_verifikasi = 'oke' ");
                    $p4=mysqli_num_rows($peserta4);
                    echo $p4;
                  ?>
                </td>
              </tr>
              <tr style="background-color:lightgreen;">
                <th>Jumlah Peserta Daftar Wisuda</th>
                <td>:</td>
                <td>
                  <?php 
                    $peserta5=mysqli_query($db, "SELECT * FROM tbl_alumni WHERE YEAR(h_tanggal) = '$thn' ");
                    $p5=mysqli_num_rows($peserta5);
                    echo $p5;
                  ?>
                </td>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>