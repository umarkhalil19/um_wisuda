<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Mahasiswa</h1>
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
                <b>Data Mahasiswa </b>
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
                <th width="100px">Option</th>
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
                  
                  $kode_p = str_replace('/', '-', $u->peserta_kode);
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
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-sm btn-default btn-outline-success" href="<?php echo base_url('biro/peserta_edit/'.$u->peserta_kode) ?>" title="Edit Data"><span class="glyphicon glyphicon-wrench">Edit</span>
                      </a> 
                      <a class="btn btn-sm btn-default btn-delete btn-outline-danger" id="<?php echo base_url().'biro/peserta_delete/'.$u->peserta_kode ?>" title="Hapus Data"><span class="glyphicon glyphicon-trash">Hapus</span>
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


