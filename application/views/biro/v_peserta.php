<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Mahasiswa</h1>
    </div>
    <a href="<?php echo base_url('biro/peserta_add') ?>" style="margin-left: 57%" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span>Tambah Mahasiswa</a>
    &nbsp;
    <a href="<?php echo base_url('biro/import_peserta') ?>" class="btn btn-sm btn-primary pull-right"><span class="fa fa-upload"></span>Import Data Mahasiswa</a>
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
                    $tahun1=mysqli_query($db, "SELECT peserta_tahun_masuk FROM tbl_peserta GROUP BY peserta_tahun_masuk");
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
                  <div class="btn-group">
                     <a class="btn btn-sm btn-default btn-outline-success" href="<?php echo base_url('biro/peserta_edit/'.$p->peserta_kode) ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                    </a> 
                    <a class="btn btn-sm btn-default btn-delete btn-outline-danger" id="<?php echo base_url().'biro/peserta_delete/'.$p->peserta_kode ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
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