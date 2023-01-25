<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Peserta Wisuda</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
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
                <a class="btn btn-outline-primary" href="<?php echo base_url().'biro/laporan_wisuda_1_excelbiodata/'.$sesi; ?>" title="Export Form Biodata"><span class="fa fa-file-excel-o"></span>Export Form Biodata</a>
                <a class="btn btn-outline-primary" href="<?php echo base_url().'biro/laporan_wisuda_1_excel/'.$sesi; ?>" title="CeExporttak Data"><span class="fa fa-file-excel-o"></span>Export Laporan</a>
                <a class="btn btn-outline-primary" href="<?php echo base_url().'biro/laporan_wisuda_1_cetak/'.$sesi; ?>" title="Cetak Data"><span class="fa fa-file-pdf-o"></span>Cetak Buku Wisuda</a>
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