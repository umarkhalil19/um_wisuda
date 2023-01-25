<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Jurusan</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Form Tambah Jurusan</h3>
            <div class="tile-body">
              <form>
                <div class="form-group">
                  <label class="control-label">Nama Jurusan</label>
                  <input class="form-control" type="text" name="jurusan" placeholder="Nama Jurusan">
                </div>
                <div class="form-group">
                  <label class="control-label">Nama Fakultas</label>
                  <select class="form-control" name="fakultas">
                    <option value="">----- Pilih -----</option>
                  </select>
                </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/jurusan') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </div>
        </div>
  </div>
</main>