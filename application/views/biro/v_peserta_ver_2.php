<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Verifikasi Data Mahasiswa</h1>
    </div>
    <a href="<?php echo base_url('biro/peserta_ver/'.$thn) ?>" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();
?>
        <form target="" action="<?php echo base_url()?>biro/cetak_peserta_ver" method="post">
          <table border="0" width="100%">
            <tr>
              <td colspan="10">
                <b>Verifikasi Data Mahasiswa </b>
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
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Kode Peserta</th>
                <th>Nama Peserta</th>
                <th>Tanggal Lahir</th>
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
                  $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$u->peserta_fakultas'");
                  $f = mysqli_fetch_array ($fak);
                  $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$u->peserta_prodi'");
                  $j = mysqli_fetch_array ($jur);
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $u->peserta_kode ?></td>
                  <td><?php echo $u->peserta_nama.'<br><br> Telp: '.$u->peserta_telepon.'<br> Email: '.$u->peserta_email ?></td>
                  <td>
                    <?php
                      if($u->peserta_tanggal_lahir == '0000-00-00'){
                        echo $u->peserta_tanggal_lahir;
                      }else{
                        echo TanggalIndo($u->peserta_tanggal_lahir);
                      }
                    ?>
                  </td>
                  <td><?php echo $j[0] ?></td>
                  <td align="left">
                    <?php
                      $res1=mysqli_query($db, "SELECT * FROM tbl_lampiran WHERE lampiran_keperluan='Ijazah' AND lampiran_prodi LIKE '%".$u->peserta_prodi."%' ORDER BY lampiran_id ASC");
                      $rs3=mysqli_num_rows($res1);
                      $no4 = 0;
                      while($rs1=mysqli_fetch_array($res1)){
                        $res2=mysqli_query($db, "SELECT * FROM tbl_peserta_lampiran WHERE peserta_kode = '$u->peserta_kode' AND peserta_lampiran != '' AND peserta_lamp_kode = '".$rs1['lampiran_id']."' ");
                        $rs2=mysqli_fetch_array($res2);
                        $rs4=mysqli_num_rows($res2);
                        $no4 = $no4+$rs4;
                        if($rs1['lampiran_id'] == $rs2['peserta_lamp_kode']){
                          echo "<a href='".base_url()."dokumen/lampiran/".$rs2['peserta_lampiran']."' target='_blank' title='".$rs1['lampiran_nama']."'><span class='glyphicon glyphicon-search'></span> Lampiran ".$rs1['lampiran_id']."</a><br>";
                        }else{
                          echo "<p style='color:red;'>".$rs1['lampiran_nama']."</p>";
                        }
                      }
                    ?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <?php
                        echo '<a class="btn btn-sm btn-outline-success" href="'.base_url().'biro/peserta_ver_batal/'.$u->peserta_kode.$thn.$kodeprodi.'" title="Batalkan Verifikasi"><span class="fa fa-check"></span>Batalkan</a>';
                      ?>
                    </div>
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


