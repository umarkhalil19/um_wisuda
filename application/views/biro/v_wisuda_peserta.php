<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Data Peserta Wisuda</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
        show_alert();
        $db = $this->M_vic->panggil_db();
        ?>
        <form target="" action="<?php echo base_url() ?>admin/biro/wisuda_peserta/" method="post">
          <table width="100%">
            <tr>
              <td width="30%">
                <label class="control-label"><strong>Pilih Jurusan</strong></label>
                <?php /* <select class="form-control col-md-12" name="jurusan" id="jurusan" onchange="(window.location = this.options[this.selectedIndex].value+thn.value);"> */ ?>
                <select class="form-control col-md-12" name="jurusan" id="jurusan">
                  <option value="">----- Pilih -----</option>
                  <?php foreach ($jurusan as $j) { ?>
                    <option <?php if ($prodi == $j->prodi_kode) {
                              echo "selected";
                            } ?> value='<?php echo $j->prodi_kode; ?>'><?php echo $j->prodi_nama ?></option>
                  <?php } ?>
                </select>
              </td>
              <td width="20%">
                <label class="control-label"><strong>Sesi Wisuda</strong></label>
                <?php /* <select class="form-control col-md-12" name="sesi" id="sesi" onchange="(window.location = jurusan.value+thn.value+this.options[this.selectedIndex].value);"> */ ?>
                <select class="form-control col-md-12" name="sesi" id="sesi">
                  <option value="">----- Pilih -----</option>
                  <?php foreach ($sesi_wisuda as $s) { ?>
                    <option <?php if ($sesi == $s->jadwal_id) {
                              echo "selected";
                            } ?> value='<?php echo $s->jadwal_id; ?>'><?php echo $s->jadwal_nama . ' (' . date("d-m-Y", strtotime($s->jadwal_tanggal)) . ')' ?></option>
                  <?php } ?>
                </select>
              </td>
              <td width="30%" valign="bottom">
                <a class="btn btn-outline-success" onclick="javascript:onclick=window.location = jurusan.value+sesi.value;" title="Tampil Data"><span class="fa fa-search"></span>Tampil</a>
              </td>
              <?php /*
              <td width="20%" valign="bottom">
              <a class="btn btn-primary" onclick="#" title="Tampil Data"><span class="fa fa-print"></span>Cetak Buku Wisuda</a>
              */ ?>
              </td>
            </tr>
          </table>
          <br>
        </form>
        <div class="tile-body" style="font-size:12px;">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Urut</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>IPK</th>
                <th>Cetak</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($peserta as $p) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $p->mhs_no_wisuda; ?></td>
                  <td><?php echo $p->mhs_nim; ?></td>
                  <td><?php echo $p->mhs_nama; ?></td>
                  <td><?php echo $p->mhs_jenis_kelamin; ?></td>
                  <td><?php echo '<b>' . $p->peserta_ipk . '</b><br>' . $p->peserta_lama_studi . '<br>' . $p->peserta_predikat; ?></td>
                  <td><a class="btn btn-success pull-right" href="<?php echo base_url() . 'biro/daftarwisuda_cetak/' . $p->mhs_nim; ?>"><i class="fa fa-print"></i> Cetak </a></td>
                  <td><a class="btn btn-danger pull-right" href="<?php echo base_url() . 'biro/wisuda_cancel/' . $p->mhs_nim; ?>"><i class="fa fa-times-circle"></i> Batalkan </a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>