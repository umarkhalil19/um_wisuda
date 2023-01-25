<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil"></i> Edit Mahasiswa</h1>
    </div>
    <a href="javascript:history.back()" class=" btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
 <!-- <div class="row" style="margin-left: 23%">
    <div class="col-md-8"> -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Form Edit Mahasiswa</h3>
        <div class="tile-body">
          <form method="post" action="<?php echo base_url('biro/peserta_update') ?>" enctype="multipart/form-data">
            <?php 
              foreach ($peserta as $p) {
                $db = $this->M_vic->panggil_db();
                $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$p->peserta_fakultas'");
                $f = mysqli_fetch_array ($fak);

                $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p->peserta_prodi'");
                $j = mysqli_fetch_array ($jur);
            ?>
            <table width="100%" border="0">
              <tr>
                <td align="top"><label class="control-label">*NIM</label></td>
                <td align="top">
                  <input class="form-control" type="hidden" name="nim" placeholder="NIM Mahasiswa" value="<?php echo $p->peserta_kode ?>" required="">
                  <input class="form-control" type="text" name="nim" placeholder="NIM Mahasiswa" disabled value="<?php echo $p->peserta_kode ?>">
                </td>
              </tr>
              <tr>
                <td align="top" width="15%"><label class="control-label">*Nama Mahasiswa</label></td>
                <td align="top" width="34%"><input class="form-control" type="text" name="nama" placeholder="Nama Mahasiswa" value="<?php echo $p->peserta_nama ?>" required=""></td>
                <td width="2%">&nbsp;</td>
                <td align="top" width="15%"><label class="control-label">Jenis Kelamin</label></td>
                <td align="top" width="34%">
                  <select name="jenis_kelamin" class="form-control">
                    <option value="<?php echo $p->peserta_jenis_kelamin ?>"><?php echo $p->peserta_jenis_kelamin ?></option>
                    <option value="<?php echo $p->peserta_jenis_kelamin ?>"></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">*Fakultas</label></td>
                <td align="top">
                  <input type="hidden" name="fakultas" value="<?php echo $p->peserta_fakultas ?>">
                  <select class="form-control" name="fakultas1" id="fakultas1" disabled>
                      <option value="<?php echo $p->peserta_fakultas ?>"><?php echo $f[0] ?></option>
                  </select>
                </td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">*Prodi/Jurusan</label></td>
                <td align="top">
                  <?php /*<input type="hidden" name="prodi" value="<?php echo $p->peserta_prodi ?>">
                  <select class="form-control" name="prodi1" disabled>
                    <option value="<?php echo $p->peserta_prodi ?>"><?php echo $j[0] ?></option>
                  </select>*/ ?>
                  <select class="form-control" name="prodi" id="fakultas" required="">
                    <option value="">------- Pilih Prodi/Jurusan -------</option>
                    <?php foreach ($jurusan as $j) { ?>
                      <option <?php if($j->prodi_kode == $p->peserta_prodi){ echo 'Selected'; } ?> value="<?php echo $j->prodi_kode ?>" ><?php echo $j->prodi_nama; ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Tempat Lahir</label></td>
                <td align="top"><input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $p->peserta_tempat_lahir ?>"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Tanggal Lahir</label></td>
                <td align="top"><input class="form-control" id="demoDate1" type="text" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $p->peserta_tanggal_lahir ?>"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Tanggal Masuk</label></td>
                <td align="top"><input class="form-control" id="demoDate2" type="text" name="tanggal_masuk" placeholder="Tanggal Masuk" value="<?php echo $p->peserta_tanggal_masuk ?>"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Tanggal Sidang</label></td>
                <td align="top"><input class="form-control" id="demoDate3" type="text" name="tanggal_keluar" placeholder="Tanggal Sidang" value="<?php echo $p->peserta_tanggal_keluar ?>"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Nomor SK Yudisium</label></td>
                <td align="top"><input class="form-control" type="text" name="nosk_yudisium" placeholder="Nomor SK Yudisium" value="<?php echo $p->peserta_nosk_yudisium ?>"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Tanggal SK Yudisium</label></td>
                <td align="top"><input class="form-control" id="demoDate4" type="text" name="tanggal_yudisium" placeholder="Tanggal SK Yudisium" value="<?php echo $p->peserta_tanggal_yudisium ?>"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">*Index Prestasi Kumulatif</label></td>
                <td align="top"><input class="form-control" type="text" name="ipk" placeholder="0.00" value="<?php echo $p->peserta_ipk ?>" required=""></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Predikat</label></td>
                <td align="top">
                  <select name="predikat" class="form-control">
                    <option value="<?php echo $p->peserta_predikat ?>"><?php echo $p->peserta_predikat ?></option>
                    <option value="<?php echo $p->peserta_predikat ?>"></option>
                    <option value="Dengan Pujian">Dengan Pujian</option>
                    <option value="Sangat Memuaskan">Sangat Memuaskan</option>
                    <option value="Memuaskan">Memuaskan</option>
                    <option value="Cukup">Cukup</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Jumlah SKS Dicapai</label></td>
                <td align="top"><input class="form-control" type="number" name="jumlah_sks" placeholder="Jumlah SKS Dicapai" value="<?php echo $p->peserta_jumlah_sks ?>"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Semester Lulus</label></td>
                <td align="top"><input class="form-control" type="number" name="semester_lulus" placeholder="1 s.d 14" value="<?php echo $p->peserta_semester_lulus ?>"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Bulan Awal Bimbingan</label></td>
                <td align="top"><input class="form-control" type="text" name="awal_bimbingan" placeholder="mm yyyy" value="<?php echo $p->peserta_awal_bimbingan ?>"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Bulan Akhir Bimbingan</label></td>
                <td align="top"><input class="form-control" type="text" name="akhir_bimbingan" placeholder="mm yyyy" value="<?php echo $p->peserta_akhir_bimbingan ?>"></td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Judul Skripsi</label></td>
                <td align="top"><textarea class="form-control" name="judul_skripsi"><?php echo $p->peserta_judul_skripsi ?></textarea></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Keterangan Wisuda</label></td>
                <td align="top">
                  <select name="keterangan_wisuda" class="form-control">
                    <option value="<?php echo $p->peserta_keterangan_wisuda ?>"><?php echo $p->peserta_keterangan_wisuda ?></option>
                    <option value="<?php echo $p->peserta_keterangan_wisuda ?>"></option>
                    <option value="Sudah">Sudah</option>
                    <option value="Belum">Belum</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Nomor Telepon</label></td>
                <td align="top"><input class="form-control" type="text" name="nomor_telepon" placeholder="Nomor Telepon" value="<?php echo $p->peserta_telepon ?>"></td>
                <td>&nbsp;</td>
                <td align="top">&nbsp;</td>
                <td align="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="top"><label class="control-label">Nomor Ijazah</label></td>
                <td align="top"><input class="form-control" type="text" name="nomor_ijazah" placeholder="Nomor Ijazah" value="<?php echo $p->peserta_nomor_ijazah ?>"></td>
                <td>&nbsp;</td>
                <td align="top"><label class="control-label">Nomor Blanko (NC)</label></td>
                <td align="top"><input class="form-control" type="text" name="nomor_blanko" placeholder="Nomor Blanko" value="<?php echo $p->peserta_nomor_blanko ?>"></td>
              </tr>
            </table>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" value="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" href="<?php echo base_url('biro/peserta/'.$p->peserta_prodi) ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
</main>