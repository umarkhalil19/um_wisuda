<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Ijazah Mahasiswa</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
          <form target="" action="<?php echo base_url()?>admin/biro/peserta/" method="post">
          <table width="100%">
            <tr>
              <td width="20%">
                <label class="control-label"><strong>Pilih Tahun</strong></label>
                <select name="thn" id="thn" class="form-control">
                  <option value="">----- Pilih -----</option>
                  <?php
                    $tahun1=mysqli_query($db, "SELECT jadwal_tahun FROM tbl_jadwalwisuda GROUP BY jadwal_tahun");
                    while($t1=mysqli_fetch_array($tahun1)) { ?>
                      <option <?php if($thn == $t1[0]){ echo "selected";} ?> value='<?php echo $t1[0]; ?>'><?php echo $t1[0]; ?></option>
                  <?php } ?>
                  </select>
              </td>
              <td width="70%">
                <label class="control-label"><strong>Pilih Jurusan</strong></label>
                <select class="form-control col-md-4" name="jurusan" onchange="(window.location = this.options[this.selectedIndex].value+thn.value);">
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
          <table class="table table-hover table-bordered" id="sampleTable" style="font-size: 12px;">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>IPK</th>
                <th>Nomor Ijazah</th>
                <th>Nomor Blanko</th>
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
                <td><?php echo $j[0].'<br><i>'.$f[0].'</i>'; ?></td>
                <td><?php echo $p->peserta_ipk.'<br><i>'.$p->peserta_predikat.'<br>'; ?></td>
                <td><b><?php echo $p->peserta_nomor_ijazah; ?></b></td>
                <td><b><?php echo $p->peserta_nomor_blanko; ?></b></td>
                <td>
                  <div class="btn-group">
                     <a class="btn btn-sm btn-default btn-outline-success" href="<?php echo base_url('biro/peserta_edit/'.$p->peserta_kode) ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                    </a>
                    </a>
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