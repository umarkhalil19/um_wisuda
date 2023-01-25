<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Upload Lampiran</h1>
    </div>
  </div>
  <?php show_alert(); ?>

  <div class="row">
    <div class="col-md-12">
      <div class="bs-component" style="margin-bottom: 15px;">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-md btn-primary">
            <a id="option1" type="radio" name="options" autocomplete="off" checked="true"><i class="fa fa-user"></i>Biodata</a>
          </label>
          <label class="btn btn-primary active" aria-pressed="true">
            <a id="option1" type="radio" name="options" autocomplete="off" checked="true"><i class="fa fa-file"></i>Lampiran</a>
          </label>
        </div>
      </div>

      <div class="tile">
        <h3 class="tile-title">Form Tambah Lampiran</h3>
        <div class="tile-body">
          <?php
          foreach($edit As $a){
              $db = $this->M_vic->panggil_db();
              $carinmr = mysqli_query($db, "SELECT peserta_no_ijazah FROM tbl_peserta WHERE peserta_kode = '$a->peserta_kode'");
              $ketemu=mysqli_fetch_array($carinmr);

              $res1=mysqli_query($db, "SELECT * FROM tbl_lampiran WHERE lampiran_prodi LIKE '%".$a->peserta_prodi."%' ORDER BY lampiran_id ASC");
              while($rs1=mysqli_fetch_array($res1)){
                $res2=mysqli_query($db, "SELECT * FROM tbl_peserta_lampiran WHERE peserta_kode = '$a->peserta_kode' AND peserta_lampiran != '' AND peserta_lamp_kode = '".$rs1['lampiran_id']."' ");
                //$rs2=mysql_fetch_array($res2);
                $rs2=mysqli_num_rows($res2);
                $rs3=mysqli_fetch_array($res2);

          ?>
          <form method="post" action="<?php echo base_url('mahasiswa/lampiran_add_act') ?>" enctype="multipart/form-data">
            <table width="100%" border="0">
              <tr>
                <td width="50%" align="left" valign="top">
                  <?php
                  echo "<label>Upload ".$rs1['lampiran_nama']." <small>(Format: *.".$rs1['lampiran_format'].")</small></label><br>";
                    //if($a->peserta_lampiran1 != ""){
                    if($rs2 > 0){
                      echo "<small style='color: green'>(* Abaikan jika tidak ada perubahan)</small>";
                    }else{
                      echo "<small style='color: red'>(* File belum diupload)</small>";
                    }
                  ?>
                </td>
                <?php if ($ketemu[0] != ''){
                  echo "<td colspan='2' <div class='alert alert-danger'>Nomor Ijazah Sudah Tersedia, Data Tidak Bisa Di Ubah </div></td>";?>
                <?php }else{
                  echo '<td align="center" valign="top">';
                  if ($rs1['lampiran_format'] == 'jpg') {
                    echo '
                      <input type="file" name="filedata" id="filedata" class="form-control" accept="image/*">
                      <input type="hidden" name="lamp_kode" value="'.$rs1['lampiran_id'].'">
                      <input type="hidden" name="lamp_nama" value="'.$rs1['lampiran_nama'].'">
                      <input type="hidden" name="lamp_format" value="'.$rs1['lampiran_format'].'">';
                  }else{
                    echo '
                      <input type="file" name="filedata" id="filedata" class="form-control" accept="application/pdf">
                      <input type="hidden" name="lamp_kode" value="'.$rs1['lampiran_id'].'">
                      <input type="hidden" name="lamp_nama" value="'.$rs1['lampiran_nama'].'">
                      <input type="hidden" name="lamp_format" value="'.$rs1['lampiran_format'].'">';
                  }

                  echo '</td>
                  <td align="center" valign="top">
                    <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-save"> UPLOAD</i></button>
                  </td>';

                  if($rs2 > 0){
                      echo '<td width="15%" align="right" valign="top"> <a href="'.base_url().'dokumen/lampiran/'.$rs3[3].'" class="btn btn-default" target="_blank">Lihat Data</a></td>';
                    }else{
                      echo '<td width="15%" align="right" valign="top"> <small>(max size: 500kb)</small></td>';
                    }
                  
                } ?>
                
              </tr>
            </table>
            <input type="hidden" name="peserta_prodi" value="<?php echo $a->peserta_prodi; ?>">
            <br>
          </form>
          <?php } ?>
          <?php } ?>
            <div class="tile-footer">
              <a href="<?php echo base_url('mahasiswa/biodata') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
      </div>
    </div>
</main>