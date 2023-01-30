<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Verifikasi Data Wisuda Mahasiswa</h1>
    </div>
    <a href="<?php echo base_url('biro/wisuda_ver/' . $thn) ?>" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
        show_alert();
        $db = $this->M_vic->panggil_db();
        ?>
        <form target="" action="<?php echo base_url() ?>biro/cetak_wisuda_ver" method="post">
          <table border="0" width="100%">
            <tr>
              <td colspan="10">
                <b>Verifikasi Data Wisuda Mahasiswa </b>
              </td>
            </tr>
            <tr>
              <td>
                <b><?php echo "Angkatan : " . $sesi->jadwal_nama . '/' . $sesi->jadwal_tahun ?></b><br>
                <b><?php echo "Tanggal : " . TanggalIndo($sesi->jadwal_tanggal) ?></b><br>
                <b><?php echo "Prodi : " . $prodi->prodi_nama ?></b><br>
                <input type="hidden" name="thn" value="<?php echo $thn; ?>">
                <input type="hidden" name="kodeprodi" value="<?php echo $kodeprodi; ?>">
              </td>
          </table>
        </form>
        <hr>
        <div class="tile-body" style="font-size:12px;">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <!-- <th>Jurusan/Prodi</th> -->
                <th width="50%">Dokumen </th>
                <th>Verifikasi</th>
                <th width="90%">Pesan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $array = 0;
              foreach ($alumni->result() as $u) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $u->mhs_nim ?></td>
                  <td><?= $u->mhs_nama ?></td>
                  <!-- <td><?php echo $u->mhs_prodi ?></td> -->
                  <td align="left">
                    <?php
                    $length = count($mhsLampiran[$array]);
                    for ($i = 0; $i < $length; $i++) {
                    ?>
                      <a href="<?= base_url('dokumen/lampiran/syarat_wisuda/' . $mhsLampiran[$array][$i]['lampiran']) ?>" target="_blank"><?= $mhsLampiran[$array][$i]['lampiran_nama'] ?></a><br>
                    <?php
                    }
                    $array++;
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<a class="btn btn-sm btn-outline-success" href="' . base_url() . 'biro/wisuda_ver_oke/' . $kodeprodi . $thn . '" title="Verifikasi Berkas"><span class="fa fa-check"></span>Verifikasi</a>';

                    // 
                    ?>
                    <!-- <br><br>
                      <a class="btn btn-sm btn-outline-success" href="<?php echo base_url() . 'biro/peserta_detail/' . $u->peserta_kode ?>" title="Lihat Data"><span class="fa fa-search"></span> Lihat </a>-->
                  </td>
                  <td>
                    <form method="post" action="<?php echo base_url() . 'biro/peserta_pesan_ver/' ?>">
                      <?php
                      $auto = "001";
                      $thn = date('Y');
                      $read = mysqli_query($db, "SELECT SUBSTR(tp_kode, 7, 3) FROM tbl_pesan WHERE tp_mahasiswa = '" . $u->mhs_nim . "' ORDER BY SUBSTR(tp_kode, 7, 3) DESC");
                      if ($rec = mysqli_fetch_array($read)) {
                        $auto = $rec[0] + 1;
                        if ($auto < 10) $auto = "0" . $auto;
                        if ($auto < 100) $auto = "0" . $auto;
                      }
                      //echo $auto;
                      ?>
                      <input name="kodepeserta" type="hidden" value="<?php echo $u->mhs_nim ?>">
                      <input name="namapeserta" type="hidden" value="<?php echo $u->mhs_nama ?>">
                      <input name="nomorpesan" type="hidden" value="<?php echo $auto ?>">
                      <input name="thn" type="hidden" value="<?php echo $thn ?>">
                      <input name="prodi_kode" type="hidden" value="<?php echo $u->mhs_prodi ?>">
                      <textarea name="pesan" class="form-control"></textarea>
                      <input class="btn btn-sm btn-primary" type="submit" value="Kirim">
                      <br><br>
                      <div class="form-control" style="overflow:scroll; height: 150px">
                        <?php
                        $read2 = mysqli_query($db, "SELECT * FROM tbl_pesan WHERE tp_mahasiswa = '" . $u->mhs_nim . "' ORDER BY tp_id ASC");
                        while ($rec2 = mysqli_fetch_array($read2)) {
                          if ($rec2['h_pengguna'] == $rec2['tp_mahasiswa']) {
                            echo '<div class="alert alert-success">' . $rec2['tp_pesan'] . '</div>';
                          } else {
                            echo '<div class="alert alert-danger">' . $rec2['tp_pesan'] . '</div>';
                          }
                        }
                        ?>
                      </div>
                    </form>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>