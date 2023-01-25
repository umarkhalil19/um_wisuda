<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Pegawai</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
      <div class="tile">
        <h3 class="tile-title">Form Tambah Pegawai</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url('biro/pegawai_add_act') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label">NIP Pegawai</label>
              <input class="form-control" type="text" name="nip" placeholder="NIP" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Nama Pegawai</label>
              <input class="form-control" type="text" name="nama" placeholder="Nama Pegawai" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Username</label>
              <input class="form-control" type="text" name="uname" placeholder="Username" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Alamat Pegawai</label>
              <input class="form-control" type="text" name="alamat" placeholder="Alamat Pegawai" required="">
            </div>
             <div class="form-group">
              <label class="control-label">No Hp</label>
              <input class="form-control" type="text" name="hp" placeholder="No Hp" required="">
            </div>
             <div class="form-group">
              <label class="control-label">Email Pegawai</label>
              <input class="form-control" type="text" name="email" placeholder="Email Pegawai" required="">
            </div>
             <div class="form-group">
              <label class="control-label">Status Pegawai</label>
              <select class="form-control" name="status" required="">
                <option value="">------- Pilih Status -------</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/pegawai') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>