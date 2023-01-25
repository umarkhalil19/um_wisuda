<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Detail Mahasiswa</h1>
    </div>
  </div>
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <form target="" action="<?php echo base_url()?>admin/biro/peserta_cek_list/" method="post">
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
                  <th>Check List</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($peserta as $p) { 
                 ?>
                 <tr>
                   <td><?php echo $no++ ?></td>
                   <td><?php echo $p->peserta_kode ?></td>
                   <td><?php echo $p->peserta_nama ?></td>
                   <td>
                     <?php
                     echo '<table>';
                     foreach ($cek as $c) {
                        $cekubah1 = $c->cek_list_id;
                        $cekubah2 = $c->cek_list_id - 1;
                        if(($c->cek_list_id - 1) <= 1){
                          $cekubah3 = '01';
                        }elseif(($c->cek_list_id - 1) <= 9){
                          $cekubah3 = '0'.$cekubah2;
                        }else{
                          $cekubah3 = $cekubah2;
                        }
                        $ceklis = '<a class="btn btn-sm" href="'.base_url().'biro/peserta_checklist_update/'.$cekubah1.$p->peserta_kode.$p->peserta_prodi.'" title="Ubah" style="padding: 0;background-color: pink;width: 75px;color: black;">Menunggu</a>';
                        $cekhitung = $p->peserta_checklist - $c->cek_list_id;
                        if($cekhitung >= 0){
                          $ceklis = '<a class="btn btn-sm" href="'.base_url().'biro/peserta_checklist_update/'.$cekubah3.$p->peserta_kode.$p->peserta_prodi.'" title="Ubah" style="padding: 0;background-color: lightgreen;width: 75px;color: black;">Selesai</a>';
                        }else{
                          $ceklis = '<a class="btn btn-sm" href="'.base_url().'biro/peserta_checklist_update/'.$cekubah1.$p->peserta_kode.$p->peserta_prodi.'" title="Ubah" style="padding: 0;background-color: pink;width: 75px;color: black;">Menunggu</a>';
                        }
                      echo '<tr>
                            <td style="padding: 0 0 0 0;">'.$c->cek_list_nama.'</td>
                            <td style="padding: 0 0 0 0;">'.$ceklis.'</td>
                            </tr>';
                      }
                      echo '</table>';
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