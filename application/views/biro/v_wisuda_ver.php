<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Verifikasi Data Pendaftar Wisuda</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
        show_alert();
        $db = $this->M_vic->panggil_db();
        ?>
        <form target="" action="<?php echo base_url() ?>biro/wisuda_ver/" method="post">
          <table width="20%">
            <tr>
              <td>
                <label class="control-label"><strong>Pilih Tahun</strong></label>
                <select name="thn" id="thn" class="form-control" onchange="(window.location = this.options[this.selectedIndex].value);">
                  <option value="">----- Pilih -----</option>
                  <?php
                  foreach ($sesiWisuda->result() as $s) :
                  ?>
                    <option <?= $thn == $s->jadwal_id ? "selected" : "" ?> value="<?= $s->jadwal_id ?>"><?= $s->jadwal_nama . ' ' . TanggalIndo($s->jadwal_tanggal) ?></option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>
          </table>
        </form>
        <br>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable" style="font-size: 12px;">
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Kode</th>
                <th>Nama Jurusan</th>
                <th>Fakultas</th>
                <th>Belum Verifikasi</th>
                <th width="10px">Option</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($jurusan as $d) {
              ?>
                <tr>
                  <td><?php echo $no++;; ?></td>
                  <td><?php echo $d->prodi_kode; ?></td>
                  <td>
                    <a href="<?php echo base_url() . 'biro/wisuda_ver_tampil/' . $thn . $d->prodi_kode ?>" title="Lihat Data" style="text-decoration: none">
                      <?php echo $d->prodi_nama; ?>
                    </a>
                  </td>
                  <td><?= $d->fakultas ?></td>
                  <td align="center">
                    <a href="<?php echo base_url() . 'biro/wisuda_ver_tampil/' . $thn . $d->prodi_kode ?>" title="Lihat Data" style="text-decoration: none">
                      <b>
                        <p style='color:red;'><?= $d->belum ?></p>
                      </b>
                    </a>

                  </td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-sm btn-outline-success" href="<?php echo base_url() . 'biro/wisuda_ver_tampil/' . $thn . $d->prodi_kode ?>" title="Lihat Data" style="text-decoration: none"><span class="glyphicon glyphicon-search"></span> Lihat</a>
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