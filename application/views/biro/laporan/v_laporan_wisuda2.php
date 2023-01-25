<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Rekap Data Peserta Wisuda</h1>
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
                <a class="btn btn-outline-primary" href="<?php echo base_url().'biro/laporan_wisuda_2_excel/'.$sesi; ?>" title="Cetak Data"><span class="fa fa-file-excel-o"></span>Export</a>
                <a class="btn btn-outline-primary" href="<?php echo base_url().'biro/laporan_wisuda_2_pdf/'.$sesi; ?>" title="Cetak Data"><span class="fa fa-file-pdf-o"></span>Cetak</a>
              </td>
            </tr>
          </table>
          <br>
        </form>
        <div class="tile-body" style="font-size:12px;">
          <?php /*
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Fakultas</th>
                <th>Wisudawan</th>
                <th>Wisudawati</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              $tot1 = 0; $tot2 = 0;
              foreach ($fakultas as $f) {
                // $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$p->mhs_fakultas'");
                // $f = mysqli_fetch_array ($fak);
                // $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p->mhs_prodi'");
                // $j = mysqli_fetch_array ($jur);
                $idfak = $f->fakultas_id;
                $peserta_1 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Laki-Laki' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
                $p1 = mysqli_num_rows($peserta_1);
                $peserta_2 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Perempuan' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
                $p2 = mysqli_num_rows($peserta_2);
                $tot1 = $tot1+$p1;
                $tot2 = $tot2+$p2;
              ?>
              <tr>
                <td><?php echo '<b>'.$f->fakultas_nama.'</b>' ?></td>
                <td align="right"><?php echo '<b>'.$p1.' Orang</b>'; ?></td>
                <td align="right"><?php echo '<b>'.$p2.' Orang</b>'; ?></td>
              </tr>
              <?php } ?>
              <tr>
                <td align="center"><?php echo '<b>TOTAL</b>' ?></td>
                <td align="center"><?php echo '<b>'.$tot1.' Orang</b>'; ?></td>
                <td align="center"><?php echo '<b>'.$tot2.' Orang</b>'; ?></td>
              </tr>
            </tbody>
          </table>*/ ?>
          <table width="100%" class="table table-hover table-bordered" id="">
            <tbody>
              <?php
              $no=1;
              $tot1 = 0; $tot2 = 0;
              foreach ($fakultas as $f) {
                // $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$p->mhs_fakultas'");
                // $f = mysqli_fetch_array ($fak);
                // $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p->mhs_prodi'");
                // $j = mysqli_fetch_array ($jur);
                $idfak = $f->fakultas_id;
                $jurusan_1 = mysqli_query($db, "SELECT prodi_nama, (SELECT COUNT(mhs_nim) FROM tbl_alumni WHERE mhs_prodi = prodi_kode AND mhs_jenis_kelamin = 'Laki-Laki' AND mhs_sesi_wisuda = '$sesi') AS laki, (SELECT COUNT(mhs_nim) FROM tbl_alumni WHERE mhs_prodi = prodi_kode AND mhs_jenis_kelamin = 'Perempuan' AND mhs_sesi_wisuda = '$sesi') AS perempuan FROM tbl_prodi WHERE prodi_fakultas = '$idfak' ORDER BY prodi_kode ASC;");
                //$j1 = mysqli_fetch_array($jurusan_1);
                $peserta_1 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Laki-Laki' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
                $p1 = mysqli_num_rows($peserta_1);
                $peserta_2 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Perempuan' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
                $p2 = mysqli_num_rows($peserta_2);
                $tot1 = $tot1+$p1;
                $tot2 = $tot2+$p2;
                echo '<tr><td><b>'.$f->fakultas_nama.'</b></td></tr>';
                echo '<tr><td>
                        <table width="100%">
                        <tr>
                          <th width="80%">Program Studi</th>
                          <th width="10%">Laki-Laki</th>
                          <th width="10%">Perempuan</th>
                        </tr>';
                        $tot_j1 = 0;
                        $tot_j2 = 0;
                        $tot_j3 = 0;
                        while($j1 = mysqli_fetch_array($jurusan_1)){
                          $tot_j1 = $tot_j1 + $j1['laki'];
                          $tot_j2 = $tot_j2 + $j1['perempuan'];
                        echo '<tr>';
                        echo '<td>'.$j1['prodi_nama'].'<br>'.'</td>';
                        echo '<td align="center">'.$j1['laki'].'<br>'.'</td>';
                        echo '<td align="center">'.$j1['perempuan'].'<br>'.'</td>';
                        echo '</tr>';
                        }
                        $tot_j3 = $tot_j1 + $tot_j2;
                  echo '<tr>
                          <td><b>SUB TOTAL</b></td>
                          <td align="center"><b>'.$tot_j1.'</b></td>
                          <td align="center"><b>'.$tot_j2.'</b></td>
                        </tr>
                        <tr>
                          <td><b>SUB TOTAL SELURUH</b></td>
                          <td align="center" colspan="2"><b>'.$tot_j3.'</b></td>
                        </tr>
                        </table>
                      </td></tr>';
                    
                
              ?>
              <?php } ?>
              <tr>
                <td align="left">
                <?php 
                $tot3 = $tot1 + $tot2;
                  echo '<table width="100%">';
              echo '<tr>
                    <td width="80%"><b>SUB TOTAL</b></td>
                    <td width="10%" align="center"><b>'.$tot1.' Orang</b></td>
                    <td width="10%" align="center"><b>'.$tot2.' Orang</b></td>
                  </tr>
                  <tr>
                    <td><b>SUB TOTAL SELURUH</b></td>
                    <td align="center" colspan="2"><b>'.$tot3.' Orang</b></td>
                  </tr>
                  </table>';
                ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>