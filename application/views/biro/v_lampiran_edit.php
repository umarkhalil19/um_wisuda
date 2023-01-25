<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Edit Lampiran</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Form Edit Lampiran</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url() ?>biro/lampiran_update" enctype="multipart/form-data">
            <?php foreach($edit as $u){  ?>
            <div class="form-group">
              <label class="pull-left">Kode Lampiran</label>
              <input type="hidden" name="lampiran_id" class="form-control" value="<?php echo $u->lampiran_id; ?>">
              <input type="text" name="lampiran_id1" class="form-control" value="<?php echo $u->lampiran_id; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="pull-left">Nama Lampiran</label>
              <input type="text" name="lampiran" class="form-control" value="<?php echo $u->lampiran_nama ?>" autocomplete="off" autofocus>
              <?php echo form_error('lampiran'); ?>
            </div>
            <div class="form-group">
              <label class="pull-left">Keperluan Lampiran</label>
              <select name="keperluan" class="form-control">
                <option value="<?php echo $u->lampiran_keperluan; ?>"><?php echo $u->lampiran_keperluan; ?></option>
                <option value="<?php echo $u->lampiran_keperluan; ?>"></option>
                <option value="Ijazah">Ijazah</option>
                <option value="Wisuda">Wisuda</option>
              </select>
            </div>
            <div class="form-group">
              <label class="pull-left">Format Lampiran</label>
              <select name="format" class="form-control">
                <option value="<?php echo $u->lampiran_format; ?>">*.<?php echo $u->lampiran_format; ?></option>
                <option value="<?php echo $u->lampiran_format; ?>"></option>
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
                  <th width="100px">Option</th>
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
                         <?php
                            $sumber = $u->lampiran_prodi;
                            $cari = $d->prodi_kode;
                            $posisi=stristr($sumber,$cari);
                            if($posisi > 0){
                              $cek = "checked";
                            }else{
                              $cek = "";
                            }
                          ?>
                        <input type="hidden" id="id" name="id[<?php echo $i; ?>]" value="<?php echo $d->prodi_kode; ?>">
                        <input type="checkbox"class='form-control' name="prodi[<?php echo $i;?>]" id="prodi" value="<?php echo $d->prodi_kode;?>" <?php echo $cek; ?> />

                      </td>
                    </tr>
                    <?php $i++; } ?>
              </table>
            </div>
            <div class="tile-footer">
              <input type="hidden" id="nomor" name="nomor" value="<?php echo $no; ?>">

              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/lampiran') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
</main>