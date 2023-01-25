<main class="app-content">

  <?php 
    show_alert();
    $auto="01";
    $db = $this->M_vic->panggil_db();
    $read=mysqli_query($db, "SELECT lampiran_id FROM tbl_lampiran ORDER BY lampiran_id DESC");
    if ($rec=mysqli_fetch_array($read)) {
      $auto=$rec[0]+1;
      if ($auto<10) $auto="0".$auto;
    }
  ?>

  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Lampiran</h1>
    </div>
  </div>
  <div class="row" style="">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Form Tambah Lampiran</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url() ?>biro/lampiran_add_act" enctype="multipart/form-data">
            <div class="form-group">
              <label class="pull-left">Kode Lampiran</label>
              <input type="hidden" name="lampiran_id" class="form-control" value="<?php echo $auto; ?>">
              <input type="text" name="lamp_kode" class="form-control" value="<?php echo $auto; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="control-label">Nama Lampiran</label>
              <input class="form-control" type="text" name="lampiran" placeholder="Nama Lampiran" autocomplete="off" autofocus>
            </div>
            <div class="form-group">
              <label class="pull-left">Keperluan Lampiran</label>
              <select name="keperluan" class="form-control">
                <option value="Ijazah">Ijazah</option>
                <option value="Wisuda">Wisuda</option>
              </select>
            </div>
            <div class="form-group">
              <label class="pull-left">Format Lampiran</label>
              <select name="format" class="form-control">
                <option value="pdf">*.pdf</option>
                <option value="jpg">*.jpg</option>
              </select>
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary pull-right" onclick="cek(this.form.prodi)" value="Select All" />
              &nbsp;&nbsp;&nbsp;
              <input type="button" class="btn btn-primary pull-right" onclick="uncek(this.form.prodi)" value="Clear All" />
              <br><br>
              <table class="table table-bordered table-hover" id="table-datatable">
                <tr>
                  <th>Kode Jurusan</th>
                  <th>Nama Jurusan</th>
                  <th width="100px">
                    Option
                    <br>

                  </th>
                </tr>
                <?php
                  $no = 1;
                  $i = 1;
                  foreach($jurusan as $d){
                    $no++;
                    ?>
                    <tr>
                      <td><?php echo $d->prodi_kode; ?></td>
                      <td align="left"><?php echo $d->prodi_nama; ?></td>
                      <td>
                        <input type="hidden" id="id" name="id[<?php echo $i; ?>]" value="<?php echo $d->prodi_kode; ?>">
                        <input type="checkbox"class='form-control' name="prodi[<?php echo $i;?>]" id="prodi" value="<?php echo $d->prodi_kode;?>" />
                      </td>
                    </tr>
                    <?php $i++; } ?>
              </table>
            </div>
            <div class="tile-footer">
              <input type="hidden" id="nomor" name="nomor" value="<?php echo $no; ?>">

              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/lampiran') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>