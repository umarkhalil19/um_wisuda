<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Tambah Mahasiswa</h1>
    </div>
  </div>
  <!-- <div class="row" style="margin-left: 23%">
    <div class="col-md-8"> -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Form Tambah Mahasiswa</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url('biro/peserta_add_act') ?>" enctype="multipart/form-data">
            <table width="100%" border="0">
              <tr>
                <td align="top"><label class="control-label">*NIM</label></td>
                <td align="top"><input class="form-control" type="text" name="nim" placeholder="NIM Mahasiswa" required=""></td>
              </tr>
              <tr>
                <td align="top" width="15%"><label class="control-label">*Nama Mahasiswa</label></td>
                <td align="top" width="34%"><input class="form-control" type="text" name="nama" placeholder="Nama Mahasiswa" required=""></td>
                <td width="2%">&nbsp;</td>
                <td align="top" width="15%"><label class="control-label">Jenis Kelamin</label></td>
                <td align="top" width="34%">
                  <select name="jenis_kelamin" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">*Fakultas</label></td>
                <td align="top">
                  <select class="form-control" name="fakultas" id="fakultas" required="">
                    <option value="">------- Pilih Fakultas -------</option>
                    <?php foreach ($fakultas as $f) {
                      echo '<option value="'.$f->fakultas_id.'" >'.$f->fakultas_nama.'</option>';
                    } ?>
                  </select>
                </td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">*Prodi/Jurusan</label></td>
                <td align="top">
                  <select class="prodi form-control" name="prodi" required="">
                    <option value="">------- Pilih Prodi/Jurusan -------</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Tempat Lahir</label></td>
                <td align="top"><input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Tanggal Lahir</label></td>
                <td align="top"><input class="form-control" id="demoDate1" type="text" name="tanggal_lahir" placeholder="Tanggal Lahir"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Tanggal Masuk</label></td>
                <td align="top"><input class="form-control" id="demoDate2" type="text" name="tanggal_masuk" placeholder="Tanggal Masuk"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Tanggal Sidang</label></td>
                <td align="top"><input class="form-control" id="demoDate3" type="text" name="tanggal_keluar" placeholder="Tanggal Sidang"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Nomor SK Yudisium</label></td>
                <td align="top"><input class="form-control" type="text" name="nosk_yudisium" placeholder="Nomor SK Yudisium"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Tanggal SK Yudisium</label></td>
                <td align="top"><input class="form-control" id="demoDate4" type="text" name="tanggal_yudisium" placeholder="Tanggal SK Yudisium"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">*Index Prestasi Kumulatif</label></td>
                <td align="top"><input class="form-control" type="text" name="ipk" placeholder="0.00" required=""></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Predikat</label></td>
                <td align="top">
                  <select name="predikat" class="form-control">
                    <option value="">Pilih Predikat</option>
                    <option value="Dengan Pujian">Dengan Pujian</option>
                    <option value="Sangat Memuaskan">Sangat Memuaskan</option>
                    <option value="Memuaskan">Memuaskan</option>
                    <option value="Cukup">Cukup</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Jumlah SKS Dicapai</label></td>
                <td align="top"><input class="form-control" type="number" name="jumlah_sks" placeholder="Jumlah SKS Dicapai"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Semester Lulus</label></td>
                <td align="top"><input class="form-control" type="number" name="semester_lulus" placeholder="1 s.d 14"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Bulan Awal Bimbingan</label></td>
                <td align="top"><input class="form-control" type="text" name="awal_bimbingan" placeholder="mm yyyy"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Bulan Akhir Bimbingan</label></td>
                <td align="top"><input class="form-control" type="text" name="akhir_bimbingan" placeholder="mm yyyy"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Judul Skripsi</label></td>
                <td align="top"><textarea class="form-control" name="judul_skripsi"></textarea></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Keterangan Wisuda</label></td>
                <td align="top">
                  <select name="keterangan_wisuda" class="form-control">
                    <option value="Belum">Pilih Keterangan</option>
                    <option value="Sudah">Sudah</option>
                    <option value="Belum">Belum</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Nomor Ijazah</label></td>
                <td align="top"><input class="form-control" type="text" name="nomor_ijazah" placeholder="Nomor Ijazah"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Nomor Blanko (NC)</label></td>
                <td align="top"><input class="form-control" type="text" name="nomor_blanko" placeholder="Nomor Blanko"></td>
              </tr>
            </table>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;
              <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/peserta') ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>