<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Verifikasi Data Pendaftar Wisuda</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
        <form target="" action="<?php echo base_url()?>biro/wisuda_ver/" method="post">
          <table width="20%">
            <tr>
              <td>
                <label class="control-label"><strong>Pilih Tahun</strong></label>
                <select name="thn" id="thn" class="form-control" onchange="(window.location = this.options[this.selectedIndex].value);">
                  <option value="">----- Pilih -----</option>
                  <?php
                    $tahun1=mysqli_query($db, "SELECT jadwal_tahun FROM tbl_jadwalwisuda GROUP BY jadwal_tahun");
                    while($t1=mysqli_fetch_array($tahun1)) { ?>
                      <option <?php if($thn == $t1[0]){ echo "selected";} ?> value='<?php echo $t1[0]; ?>'><?php echo $t1[0]; ?></option>
                  <?php } ?>
                  </select>
              </td>
            </tr>
          </table>
        </form>
        <br>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable" style="font-size: 12px;">
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Kode</th>
                <th>Nama Jurusan</th>
                <th>Fakultas</th>
                <th>Jumlah Peserta</th>
                <th>Belum Registrasi</th>
                <th>Sudah Verifikasi</th>
                <th>Belum Verifikasi</th>
                <th width="10px">Option</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach($jurusan as $d){
                  $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$d->prodi_fakultas'");
                  $f = mysqli_fetch_array ($fak);
                  $res1 = mysqli_query($db, "SELECT COUNT(peserta_kode) FROM tbl_peserta WHERE peserta_prodi = '$d->prodi_kode' AND YEAR(h_tanggal) = '$thn'");
                  $rs1 = mysqli_fetch_array ($res1);
                  $res2 = mysqli_query($db, "SELECT COUNT(peserta_kode) FROM tbl_peserta WHERE peserta_prodi = '$d->prodi_kode' AND YEAR(h_tanggal) = '$thn' AND peserta_no_kk = ''");
                  $rs2 = mysqli_fetch_array ($res2);
                  $res3 = mysqli_query($db, "SELECT COUNT(peserta_kode) FROM tbl_peserta WHERE peserta_prodi = '$d->prodi_kode' AND YEAR(h_tanggal) = '$thn' AND peserta_status_verifikasi != ''");
                  $rs3 = mysqli_fetch_array ($res3);
                  $belum = $rs1[0] - $rs2[0] - $rs3[0];
                  //$belum = $rs1[0] - $rs2[0];
                  $belum_ver = 0;
                  if($belum <= 0){ $belum_ver = 0;
                  }else{ $belum_ver = $belum; }
                  ?>
                  <tr>
                    <td><?php echo $no++;; ?></td>
                    <td><?php echo $d->prodi_kode; ?></td>
                    <td>
                      <a href="<?php echo base_url().'biro/wisuda_ver_tampil/'.$thn.$d->prodi_kode ?>" title="Lihat Data" style="text-decoration: none">
                        <?php echo $d->prodi_nama; ?>
                      </a>
                    </td>
                    <td><?php echo $f[0] ?></td>
                    <td align="center">
                      <?php //echo $rs1[0]; ?>
                      <a href="<?php echo base_url().'biro/wisuda_peserta/'.$d->prodi_kode.$thn ?>" title="Lihat Data" style="text-decoration: none">
                        <?php echo $rs1[0]; ?>
                      </a>
                    </td>
                    <td align="center">
                      <a href="<?php echo base_url().'biro/wisuda_peserta/'.$d->prodi_kode.$thn ?>" title="Lihat Data" style="text-decoration: none">
                        <?php echo $rs2[0]; ?>
                      </a>
                    </td>
                    <td align="center">
                      <a href="<?php echo base_url().'biro/wisuda_ver_selesai/'.$thn.$d->prodi_kode ?>" title="Lihat Data" style="text-decoration: none">
                        <?php echo $rs3[0]; ?>
                      </a>
                    </td>
                    <td align="center">

                      <a href="<?php echo base_url().'biro/wisuda_ver_tampil/'.$thn.$d->prodi_kode ?>" title="Lihat Data" style="text-decoration: none">
                        <b><p style='color:red;'><?php echo $belum_ver; ?></p></b>
                      </a>

                    </td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-sm btn-outline-success" href="<?php echo base_url().'biro/wisuda_ver_tampil/'.$thn.$d->prodi_kode ?>" title="Lihat Data" style="text-decoration: none"><span class="glyphicon glyphicon-search"></span> Lihat</a>
                        </a>
                      </div>
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