<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Edit Pegawai</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
      <div class="tile">
        <h3 class="tile-title">Form Edit Pegawai</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url('biro/pegawai_update') ?>" enctype="multipart/form-data">
            <?php
            foreach ($pegawai as $p) {
            ?>
            <div class="form-group">
              <label class="control-label">NIP Pegawai</label>
              <input class="form-control" type="hidden" name="id" value="<?php echo $p->peg_id ?>">
              <input class="form-control" type="text" name="nip" value="<?php echo $p->peg_nip ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Nama Pegawai</label>
              <input class="form-control" type="text" name="nama" value="<?php echo $p->peg_nama ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Alamat Pegawai</label>
              <input class="form-control" type="text" name="alamat" value="<?php echo $p->peg_alamat ?>">
            </div>
             <div class="form-group">
              <label class="control-label">No Hp</label>
              <input class="form-control" type="text" name="hp" value="<?php echo $p->peg_hp ?>">
            </div>
             <div class="form-group">
              <label class="control-label">Email Pegawai</label>
              <input class="form-control" type="text" name="email" value="<?php echo $p->peg_email ?>">
            </div>
             <div class="form-group">
              <label class="control-label">Status Pegawai</label>
              <select class="form-control" name="status">
                <option value="<?php echo $p->peg_status ?>"><?php echo $p->peg_status ?></option>
                <option></option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
            <?php } ?>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/pegawai') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>