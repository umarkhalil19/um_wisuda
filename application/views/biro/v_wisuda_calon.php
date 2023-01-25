<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Calon Peserta Wisuda</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
          <form target="" action="<?php echo base_url()?>admin/biro/wisuda_calon/" method="post">
          <table width="100%">
            <tr>
              <td width="20%">
                <label class="control-label"><strong>Pilih Tahun</strong></label>
                <?php /*<select name="thn" id="thn" class="form-control" onchange="(window.location = jurusan.value+this.options[this.selectedIndex].value);"> */ ?>
                <select name="thn" id="thn" class="form-control">
                  <option value="">----- Pilih -----</option>
                  <?php
                    $tahun1=mysqli_query($db, "SELECT YEAR(h_tanggal) FROM tbl_peserta GROUP BY YEAR(h_tanggal)");
                    while($t1=mysqli_fetch_array($tahun1)) { ?>
                      <option <?php if($thn == $t1[0]){ echo "selected";} ?> value='<?php echo $t1[0]; ?>'><?php echo $t1[0]; ?></option>
                  <?php } ?>
                  </select>
              </td>
              <td width="70%">
                <label class="control-label"><strong>Pilih Jurusan</strong></label>
                <select class="form-control col-md-4" name="jurusan" id="jurusan" onchange="(window.location = this.options[this.selectedIndex].value+thn.value);">
                  <option value="">----- Pilih -----</option>
                  <?php foreach ($jurusan as $j) { ?>
                  <option <?php if($prodi == $j->prodi_kode){ echo "selected";} ?> value='<?php echo $j->prodi_kode; ?>'><?php echo $j->prodi_nama ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </table>
          </form>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Fakultas</th>
                <th>Prodi</th>
                <th>IPK</th>
                <th>Predikat</th>
                <th>Lama Studi</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; 
              foreach ($peserta as $p) {
                $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$p->peserta_fakultas'");
                $f = mysqli_fetch_array ($fak);
                $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p->peserta_prodi'");
                $j = mysqli_fetch_array ($jur);
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $p->peserta_kode; ?></td>
                <td><?php echo $p->peserta_nama; ?></td>
                <td><?php echo $f[0]; ?></td>
                <td><?php echo $j[0]; ?></td>
                <td><?php echo $p->peserta_ipk; ?></td>
                <td><?php echo $p->peserta_predikat; ?></td>
                <td><?php echo $p->peserta_lama_studi; ?></td>
                <td>
                  <?php 
                    if($p->peserta_status_verifikasi != ''){
                      echo '<font style="color:blue">Sudah Verifikasi</font>';
                    }elseif($p->peserta_status_verifikasi == '' && $p->peserta_no_kk != ''){
                      echo '<font style="color:green">Belum Verifikasi</font>';
                    }elseif($p->peserta_no_kk == ''){
                      echo '<font style="color:red">Belum Registrasi</font>';
                    }
                  ?>
                </td>
                <td>
                  <div class="btn-group">
                     <a class="btn btn-sm btn-default btn-outline-success" href="<?php echo base_url('biro/peserta_edit/'.$p->peserta_kode) ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                    </a>
                    <a class="btn btn-sm btn-default btn-outline-info" href="<?php echo base_url().'biro/peserta_reset_pass/'.$p->peserta_kode ?>" title="Reset Password"><span class="glyphicon glyphicon-trash">Reset Password</span>
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