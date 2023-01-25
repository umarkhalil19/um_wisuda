<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Sesi Pendaftran</h1>
    </div>
  </div>
  <div class="row" style="margin-left: 23%">
    <div class="col-md-8">
      <div class="tile">
        <h3 class="tile-title">Form Sesi Pendaftaran</h3>
        <div class="tile-body">
          <form>
            <div class="form-group">
              <label class="control-label">Tanggal Buka Pendaftaran</label>
              <input class="form-control" type="text" id="demoDate1" name="tgl_buka" placeholder="yyyy-mm-dd" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Tanggal Tutup Pendaftaran</label>
              <input class="form-control" type="text" id="demoDate2" name="tgl_tutup" placeholder="yyyy-mm-dd" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Status</label>
              <select class="form-control" id="exampleSelect1" name="status">
                <option value="">------ Pilih ------</option>
                <option value="aktif">Aktif</option>
                <option value="tidak">Tidak Aktif</option>
              </select>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
            </div>
          </div>
        </div>
      </div>
    </main>