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
        <form target="" action="<?php echo base_url()?>biro/verifikasi/" method="post">
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
                  <th>Berkas</th>
                  <th>Verifikasi</th>
                  <th>Pesan</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $no=1; 
                  foreach ($peserta as $p) {
                  ?>
                  <tr>
                    <td><?php echo $no++  ?></td>
                    <td><?php echo $p->peserta_kode ?></td> 
                    <td><?php echo $p->peserta_nama ?></td>
                    <td>
                        <?php 
                        // $db = $this->M_vic->panggil_db();
                        // $id = $p->peserta_kode;
                        // $lamp = mysqli_query($db, "SELECT tbl_lampiran.lampiran_kode,tbl_lampiran.lampiran_nama,tbl_peserta_lampiran.peserta_lamp_nama FROM tbl_lampiran,tbl_peserta_lampiran WHERE tbl_lampiran.lampiran_kode=tbl_peserta_lampiran.peserta_lamp_kode AND tbl_peserta_lampiran.peserta_kode='$id'");
                        // while ($l = mysqli_fetch_array($lamp)) {
                        //   if ($l[2]!="") {
                        //     echo '<a href="'.base_url('assets/upload_file/'.$l[2]).'" target="_blank"><i class="fa fa-search"></i>'.$l[1].'</a><br>';
                        //   }else{
                        //     echo '<p>'.$l[1].'</p><br>';
                        //   }
                        // }
                        $db = $this->M_vic->panggil_db();
                        $id = $p->peserta_kode;
                        $res1=mysqli_query($db, "SELECT * FROM tbl_lampiran WHERE lampiran_prodi LIKE '%".$p->peserta_prodi."%' ORDER BY lampiran_id ASC");
                        $rs3=mysqli_num_rows($res1);
                        $no4 = 0;
                        while($rs1=mysqli_fetch_array($res1)){
                          $res2=mysqli_query($db, "SELECT * FROM tbl_peserta_lampiran WHERE peserta_kode = '$p->peserta_kode' AND peserta_lampiran != '' AND peserta_lamp_kode = '".$rs1['lampiran_id']."' ");
                          $rs2=mysqli_fetch_array($res2);
                          $rs4=mysqli_num_rows($res2);
                          $no4 = $no4+$rs4;
                          if($rs1['lampiran_id'] == $rs2['peserta_lamp_kode']){
                            //echo "<a href='".base_url()."dokumen/lampiran/".$rs2['peserta_lampiran']."' target='_blank'><span class='glyphicon glyphicon-search'></span> ".$rs1['lampiran_nama']."</a><br>";
                            echo "<a href='".base_url()."dokumen/lampiran/".$rs2['peserta_lampiran']."' target='_blank' title='".$rs1['lampiran_nama']."'><span class='glyphicon glyphicon-search'></span> Lampiran ".$rs1['lampiran_id']."</a><br>";
                          }else{
                            //echo "<p style='color:red;'>".$rs1['lampiran_nama']."</p>";
                            echo "<a href='#' style='color:red;text-decoration: none;' title='".$rs1['lampiran_nama']."'>Lampiran ".$rs1['lampiran_id']."</a><br>";
                          }
                        }
                         ?>
                    </td>
                    <td> 
                        <?php 
                          $id = $p->peserta_kode;
                          $lamp = mysqli_query($db, "SELECT peserta_lamp_nama FROM tbl_peserta_lampiran WHERE peserta_kode = '$id'");
                          $jml = mysqli_num_rows($lamp);
                          $lamp1 = mysqli_query($db, "SELECT * FROM tbl_lampiran");
                          $jml1 = mysqli_num_rows($lamp1);
                          if ($jml != $jml1) {
                             echo '<a href="#" class=" disabled btn btn-sm btn-outline-success"><span class="fa fa-check"></span>Verifikasi</a>';
                           }else{
                             echo '<a href="#" class="btn btn-sm btn-outline-success"><span class="fa fa-check"></span>Verifikasi</a>';
                           }
                         ?>                   
                    </td>
                    <td width="40%">
                      <form method="post" action="<?php echo base_url().'biro/peserta_pesan_ver/' ?>">
                        <?php
                            $auto="001";
                            $thn = date('Y');
                            $read=mysqli_query($db, "SELECT SUBSTR(tp_kode, 7, 3) FROM tbl_pesan WHERE tp_mahasiswa = '".$p->peserta_kode."' ORDER BY SUBSTR(tp_kode, 7, 3) DESC");
                            if ($rec=mysqli_fetch_array($read)) {
                              $auto=$rec[0]+1;
                              if ($auto<10) $auto="0".$auto;
                              if ($auto<100) $auto="0".$auto;
                            }
                            //echo $auto;
                          ?>
                        <input name="kodepeserta" type="hidden" value="<?php echo $p->peserta_kode ?>">
                        <input name="namapeserta" type="hidden" value="<?php echo $p->peserta_nama ?>">
                        <input name="nomorpesan" type="hidden" value="<?php echo $auto ?>">
                        <input name="thn" type="hidden" value="<?php echo $thn ?>">
                        <input name="prodi_kode" type="hidden" value="<?php echo $p->peserta_prodi ?>">
                        <textarea name="pesan" class="form-control"></textarea>
                        <input class="btn btn-sm btn-primary" type="submit" value="Kirim">
                        <br><br>
                        <div class="form-control" style="overflow:scroll; height: 150px">
                          <?php 
                            $read2=mysqli_query($db, "SELECT * FROM tbl_pesan WHERE tp_mahasiswa = '".$p->peserta_kode."' ORDER BY tp_id ASC");
                            while($rec2=mysqli_fetch_array($read2)) {
                              if($rec2['h_pengguna'] == $rec2['tp_mahasiswa']){
                                echo '<div class="alert alert-success">'.$rec2['tp_pesan'].'</div>';
                              }else{
                                echo '<div class="alert alert-danger">'.$rec2['tp_pesan'].'</div>';
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