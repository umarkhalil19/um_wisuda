<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Verifikasi Data Wisuda Mahasiswa</h1>
    </div>
    <a href="<?php echo base_url('biro/wisuda_ver/'.$thn) ?>" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
        <form target="" action="<?php echo base_url()?>biro/cetak_wisuda_ver" method="post">
          <table border="0" width="100%">
            <tr>
              <td colspan="10">
                <b>Verifikasi Data Wisuda Mahasiswa </b>
              </td>
            </tr>
            <tr>
              <td>
                <b><?php echo "Tahun : ".$thn ?></b>
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
                <th>Jurusan/Prodi</th>
                <th>Dokumen </th>
                <th width="100px">Verifikasi</th>
                <th>Pesan</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                foreach($peserta as $u){ 
                  $id = $u->peserta_kode;
                  $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$u->peserta_fakultas'");
                  $f = mysqli_fetch_array ($fak);
                  $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$u->peserta_prodi'");
                  $j = mysqli_fetch_array ($jur);
                  $kode_p = str_replace('/', '-', $u->peserta_kode);

                  $tgl_lahir = '0000-00-00';
                  if($u->peserta_tanggal_lahir == '0000-00-00'){
                    $tgl_lahir = $u->peserta_tanggal_lahir;
                  }else{
                    $tgl_lahir = TanggalIndo($u->peserta_tanggal_lahir);
                  }
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $u->peserta_kode ?></td>
                  <td><?php echo $u->peserta_nama.'<br><small>'.$u->peserta_jenis_kelamin.'<br>'.$tgl_lahir.'</small>' ?></td>
                  <td><?php echo $j[0] ?></td>
                  <td align="left">
                    <?php
                      $res1=mysqli_query($db, "SELECT * FROM tbl_lampiran WHERE lampiran_keperluan='Wisuda' AND lampiran_prodi LIKE '%".$u->peserta_prodi."%' ORDER BY lampiran_id ASC");
                        $rs3=mysqli_num_rows($res1);
                        $no4 = 0;
                        while($rs1=mysqli_fetch_array($res1)){
                          $res2=mysqli_query($db, "SELECT * FROM tbl_peserta_lampiran WHERE peserta_kode = '$u->peserta_kode' AND peserta_lampiran != '' AND peserta_lamp_kode = '".$rs1['lampiran_id']."' ");
                          $rs2=mysqli_fetch_array($res2);
                          $rs4=mysqli_num_rows($res2);
                          $no4 = $no4+$rs4;
                          if($rs1['lampiran_id'] == $rs2['peserta_lamp_kode']){
                            echo "<a href='".base_url()."dokumen/lampiran/".$rs2['peserta_lampiran']."' target='_blank' title='".$rs1['lampiran_nama']."'><span class='glyphicon glyphicon-search'></span> Lampiran ".$rs1['lampiran_nama']."</a><br>";
                          }else{
                            echo "<a href='#' style='color:red;text-decoration: none;' title='".$rs1['lampiran_nama']."'>Lampiran ".$rs1['lampiran_id']."</a><br>";
                          }
                        }
                    ?>
                    <br>
                  </td>
                  <td>
                      <?php
                      $lamp = mysqli_query($db, "SELECT peserta_lamp_nama FROM tbl_peserta_lampiran, tbl_lampiran WHERE peserta_lamp_kode = lampiran_id AND lampiran_keperluan = 'Wisuda' AND peserta_kode = '$id'");
                      $jml = mysqli_num_rows($lamp);
                      $lamp1 = mysqli_query($db, "SELECT * FROM tbl_lampiran WHERE lampiran_keperluan='Wisuda'");
                      $jml1 = mysqli_num_rows($lamp1);
                      $sesi1 = mysqli_query($db, "SELECT * FROM tbl_jadwalwisuda WHERE jadwal_tahun = '$thn' ORDER BY jadwal_tanggal DESC");
                      //$s1 = mysqli_fetch_array($sesi1);
                        /*if ($jml != $jml1) {
                          echo '<a class="btn btn-sm btn-outline-success" style="background-color: #959090" disabled><span class="fa fa-check"></span>Verifikasi</a>';
                        }else{*/
                          if($u->peserta_status_verifikasi == 'oke'){
                            echo '<a class="btn btn-sm btn-outline-success" style="background-color: lightgreen;" disabled>Selesai</a>';
                          }else{
                            echo '<form target="" action="'.base_url().'biro/wisuda_ver_oke" method="post">';
                            echo '<input type="hidden" name="kode_p" value="'.$kode_p.'">
                                  <input type="hidden" name="thn" value="'.$thn.'">
                                  <input type="hidden" name="kodeprodi" value="'.$kodeprodi.'">';
                            /*echo '<small>Sesi Wisuda</small>';
                            echo '<select style="font-size:12px;" class="form-control" name="sesi_wisuda">';
                                    while($s1 = mysqli_fetch_array($sesi1)){
                                      echo '<option value="'.$s1['jadwal_id'].'">'.date("d-m-Y", strtotime($s1['jadwal_tanggal'])).'</option>';
                                    }
                            echo '</select> <br><br>';*/
                            //echo '<a class="btn btn-sm btn-outline-success" href="'.base_url().'biro/wisuda_ver_oke/'.$kode_p.$thn.$kodeprodi.'" title="Verifikasi Berkas"><span class="fa fa-check"></span>Verifikasi</a>';
							echo '<a class="btn btn-sm btn-outline-success" href="'.base_url().'biro/wisuda_ver_oke/'.$kodeprodi.$thn.$kode_p.'" title="Verifikasi Berkas"><span class="fa fa-check"></span>Verifikasi</a>';
                            //echo '<button type="submit" class="btn btn-sm btn-outline-success" title="Verifikasi Berkas"><span class="fa fa-check"></span>Verifikasi</button>';
                            echo '</form>';
                          }
                          
                        //} ?>
                      <!-- <br><br>
                      <a class="btn btn-sm btn-outline-success" href="<?php echo base_url().'biro/peserta_detail/'.$u->peserta_kode ?>" title="Lihat Data"><span class="fa fa-search"></span> Lihat </a>-->
                  </td>
                  <td>
                    <form method="post" action="<?php echo base_url().'biro/peserta_pesan_ver/' ?>">
                      <?php
                        $auto="001";
                        $thn = date('Y');
                        $read=mysqli_query($db, "SELECT SUBSTR(tp_kode, 7, 3) FROM tbl_pesan WHERE tp_mahasiswa = '".$u->peserta_kode."' ORDER BY SUBSTR(tp_kode, 7, 3) DESC");
                        if ($rec=mysqli_fetch_array($read)) {
                          $auto=$rec[0]+1;
                          if ($auto<10) $auto="0".$auto;
                          if ($auto<100) $auto="0".$auto;
                        }
                        //echo $auto;
                      ?>
                      <input name="kodepeserta" type="hidden" value="<?php echo $u->peserta_kode ?>">
                      <input name="namapeserta" type="hidden" value="<?php echo $u->peserta_nama ?>">
                      <input name="nomorpesan" type="hidden" value="<?php echo $auto ?>">
                      <input name="thn" type="hidden" value="<?php echo $thn ?>">
                      <input name="prodi_kode" type="hidden" value="<?php echo $u->peserta_prodi ?>">
                      <textarea name="pesan" class="form-control"></textarea>
                      <input class="btn btn-sm btn-primary" type="submit" value="Kirim">
                      <br><br>
                      <div class="form-control" style="overflow:scroll; height: 150px">
                        <?php 
                          $read2=mysqli_query($db, "SELECT * FROM tbl_pesan WHERE tp_mahasiswa = '".$u->peserta_kode."' ORDER BY tp_id ASC");
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


