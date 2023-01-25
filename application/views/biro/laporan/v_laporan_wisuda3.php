<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Peserta Wisuda per Predikat Kelulusan</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php 
  show_alert();
?>
        <form target="" action="" method="post">
          <table width="100%">
            <tr>
              <td width="20%">
                <label class="control-label"><strong>Sesi Wisuda</strong></label>
                <select class="form-control col-md-12" name="sesi" id="sesi">
                  <option value="">----- Pilih -----</option>
                  <?php foreach ($sesi_wisuda as $s) { ?>
                  <option <?php if($sesi == $s->jadwal_id){ echo "selected";} ?> value='<?php echo $s->jadwal_id; ?>'><?php echo $s->jadwal_nama.' ('.date("d-m-Y", strtotime($s->jadwal_tanggal)).')' ?></option>
                  <?php } ?>
                </select>
              </td>
              <td width="20%">
                <label class="control-label"><strong>Predikat Kelulusan</strong></label>
                <select class="form-control col-md-12" name="predikat" id="predikat" onchange="(window.location = sesi.value+this.options[this.selectedIndex].value);">
                  <option <?php if($predikat == ''){ echo 'selected';} ?> value="">----- Pilih -----</option>
                  <option <?php if($predikat == 'Dengan_Pujian'){ echo 'selected';} ?> value="Dengan_Pujian">Dengan Pujian</option>
                  <option <?php if($predikat == 'Sangat_Memuaskan'){ echo 'selected';} ?> value="Sangat_Memuaskan">Sangat Memuaskan</option>
                  <option <?php if($predikat == 'Memuaskan'){ echo 'selected';} ?> value="Memuaskan">Memuaskan</option>
                </select>
              </td>
              <td width="60%" valign="bottom" align="right">
                <?php /*<a class="btn btn-outline-primary" onclick="#" title="Cetak Data"><span class="fa fa-print"></span>Cetak</a>*/ ?>
              </td>
            </tr>
          </table>
          <br>
        </form>
        <div class="tile-body" style="font-size:12px;">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Program Studi</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Urut</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>IPK</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; 
              foreach ($peserta as $p) {
                $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$p->mhs_fakultas'");
                $f = mysqli_fetch_array ($fak);
                $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p->mhs_prodi'");
                $j = mysqli_fetch_array ($jur);
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo '<b>'.$f[0].'</b><br>'.$j[0]; ?></td>
                <td><?php echo $p->mhs_jenis_kelamin; ?></td>
                <td><?php echo $p->mhs_no_wisuda; ?></td>
                <td><?php echo $p->mhs_nim; ?></td>
                <td><?php echo $p->mhs_nama; ?></td>
                <td><?php echo '<b>'.$p->peserta_ipk.'</b><br>'.$p->peserta_lama_studi.'<br>'.$p->peserta_predikat; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>