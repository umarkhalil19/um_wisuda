<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Ganti Password</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Form Ganti Password</h3>
            <div class="tile-body">
              <form method="post" action="<?php echo base_url() ?>mahasiswa/password_update" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">New Password</label>
                  <input class="form-control" type="hidden" name="id" value="<?php echo $this->session->userdata('uid'); ?>" placeholder="New Password">
                  <input class="form-control" type="password" name="pass" required="" placeholder="New Password">
                </div>
                <div class="form-group">
                  <label class="control-label">Comfirm New Password</label>
                  <input class="form-control" type="password" name="pass1" required="" placeholder="Comfirm New Password">
                </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-save"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
            </div>
          </div>
        </div>
  </div>
</main>