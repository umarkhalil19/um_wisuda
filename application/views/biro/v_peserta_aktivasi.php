<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Aktivasi Akun Peserta Wisuda</h1>
    </div>
  </div>
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <form target="" action="<?php echo base_url()?>admin/biro/aktivasi_akun/" method="post">
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
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Status Akun</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no=1;
                foreach ($peserta as $p) {
                 ?>
                 <tr>
                   <td><?php echo $no++ ?></td>
                   <td><?php echo $p->peserta_kode; ?></td>
                   <td><?php echo $p->peserta_nama; ?></td>
                   <td>
                     <?php if ($p->peserta_status!='Aktif') {
                       echo '<a class="btn btn-outline-danger" style="background-color: pink;width: 100px;"><span class="glyphicon glyphicon-search"></span>'.$p->peserta_status.'</a>';
                     }else{
                       echo '<a class="btn btn-outline-success" style="background-color: lightgreen;width: 100px;"><span class="glyphicon glyphicon-search"></span>'.$p->peserta_status.'</a>';
                     } 
                     ?>
                   </td>
                   <td>
                     <?php if ($p->peserta_status!='Aktif') {
                       echo '<a href="'.base_url('biro/peserta_aktif/'.$p->peserta_kode).'" class="btn btn-outline-info">Aktifkan</a>';
                     }else{
                       echo '<a href="'.base_url('biro/peserta_nonaktif/'.$p->peserta_kode).'" class="btn btn-outline-danger">Nonaktifkan</a>';
                     } 
                     ?>
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