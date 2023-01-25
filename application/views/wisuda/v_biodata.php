<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-pencil"></i> Biodata</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="bs-component" style="margin-bottom: 15px;">
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-md btn-primary active" aria-pressed="true">
                  <a id="option1" type="radio" name="options" autocomplete="off" checked="true"><i class="fa fa-user"></i>Biodata</a>
                </label>
              </div>
            </div>

            <?php foreach ($peserta as $p) {
            	$db = $this->M_vic->panggil_db();
                $fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$p->peserta_fakultas'");
                $f = mysqli_fetch_array ($fak);
                $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p->peserta_prodi'");
                $j = mysqli_fetch_array ($jur);
            ?>
            <form method="post" action="<?php echo base_url() ?>wisuda/biodata_update" enctype="multipart/form-data">
            <div class="tile">
            	<h3 class="tile-title">Form Biodata</h3>
            <div class="row">
                
              <div class="col-lg-6">
              	<div class="form-group">
		              <label class="control-label">Nomor Induk Mahasiswa</label>
		              <input type="hidden" name="peserta_kode" class="form-control" value="<?php echo $p->peserta_kode ?>">
		              <input type="hidden" name="peserta_checklist" class="form-control" value="<?php echo $p->peserta_checklist ?>">
		              <input type="text" name="peserta_kode1" class="form-control" value="<?php echo $p->peserta_kode ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nama Mahasiswa <small>(Sesuai Ijazah SMA)</small></label>
		              <?php /*<input type="text" name="nama" class="form-control" value="<?php echo $p->peserta_nama ?>" required autofocus>*/ ?>
		              <input type="text" name="nama1" class="form-control" value="<?php echo $p->peserta_nama ?>" disabled> 
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor KTP</label>
		              <input type="text" name="ktp" class="form-control" value="<?php echo $p->peserta_no_ktp ?>" required oninvalid="this.setCustomValidity('Nomor KTP Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor KK</label>
		              <input type="text" name="kk" class="form-control" value="<?php echo $p->peserta_no_kk ?>" required oninvalid="this.setCustomValidity('No. Nomor KK Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		            </div>
              		<div class="form-group">
		              <label class="control-label">Agama</label>
		              <select class="form-control" name="agama" required oninvalid="this.setCustomValidity('Agama Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		              	<option value="<?php echo $p->peserta_agama ?>"><?php echo $p->peserta_agama ?></option>
		              	<option value="<?php echo $p->peserta_agama ?>"></option>
		              	<option value="Islam">Islam</option>
		              	<option value="Kristen Katolik">Kristen Katolik</option>
		              	<option value="Kristen Protestan">Kristen Protestan</option>
		              	<option value="Hindu">Hindu</option>
		              	<option value="Budha">Budha</option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor Telepon</label>
		              <input type="text" name="telepon" class="form-control" value="<?php echo $p->peserta_telepon ?>" required oninvalid="this.setCustomValidity('Nomor Telepon Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Email</label>
		              <input type="text" name="email" class="form-control" pattern="[^ @]*@[^ @]*" value="<?php echo $p->peserta_email ?>" required oninvalid="this.setCustomValidity('Email Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		          	</div>
		            <div class="form-group">
		              <label class="control-label">Provinsi</label>
		              <select class="form-control" name="provinsi" id="provinsi" required oninvalid="this.setCustomValidity('Provinsi Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		              	<option value="<?php echo $p->peserta_provinsi ?>"><?php echo $p->peserta_provinsi ?></option>
		              	<option value=""></option>
		              	<?php 
			            	$db = $this->M_vic->panggil_db();
			                $prov = mysqli_query($db, "SELECT DISTINCT kota_provinsi FROM tbl_daerah");
			                while ($pr = mysqli_fetch_array ($prov)) {
		                ?>
		              	<option value="<?php echo $pr[0] ?>"><?php echo $pr[0] ?></option>
		              	<?php } ?>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Kabupaten</label>
		              <select class="kabupaten form-control" name="kabupaten" id="kabupaten" disabled>
		              	<option value="<?php echo $p->peserta_kabupaten ?>"><?php echo $p->peserta_kabupaten ?></option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Kecamatan</label>
		              <select class="kecamatan form-control" name="kecamatan" disabled>
		              	<option value="<?php echo $p->peserta_kecamatan ?>"><?php echo $p->peserta_kecamatan ?></option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Alamat</label>
		              <input type="text" name="alamat" class="form-control" value="<?php echo $p->peserta_alamat ?>" required oninvalid="this.setCustomValidity('Alamat Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nama Ayah</label>
		              <input type="text" name="ayah" class="form-control" value="<?php echo $p->peserta_ayah ?>" required oninvalid="this.setCustomValidity('Nama Ayah Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nama Ibu</label>
		              <input type="text" name="ibu" class="form-control" value="<?php echo $p->peserta_ibu ?>" required oninvalid="this.setCustomValidity('Nama Ibu Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Bin / Binti (Nama Ayah Kandung)</label>
		              <input type="text" name="bin" class="form-control" value="<?php echo $p->peserta_bin ?>" required oninvalid="this.setCustomValidity('Nama Ayah Kandung Tidak Boleh Kosong')" oninput="setCustomValidity('')"  disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Sekolah Asal <small>(Data SMA untuk Sarjana / Data S1 untuk Magister)</small></label>
		              <input type="text" name="sekolah asal" class="form-control" value="<?php echo $p->peserta_sekolah_asal ?>" required oninvalid="this.setCustomValidity('Sekolah Asal Tidak Boleh Kosong')" oninput="setCustomValidity('')"  disabled>
		            </div>
              </div>
              <div class="col-lg-6">
              		<div class="form-group">
		              <label class="control-label">Jenis Kelamin</label>
		              <input type="hidden" name="jenis_kelamin" class="form-control" value="<?php echo $p->peserta_jenis_kelamin ?>" autofocus>
		              <input type="text" name="jenis_kelamin1" class="form-control" value="<?php echo $p->peserta_jenis_kelamin ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Tempat Lahir</label>
		              <input type="text" name="tempat_lahir1" class="form-control" value="<?php echo $p->peserta_tempat_lahir ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">* Tanggal Lahir</label>
		              <?php 
		              if ($p->peserta_tanggal_lahir != "0000-00-00") {
		              	$lahir = TanggalIndo($p->peserta_tanggal_lahir);
		              }else{
		              	$lahir = "";
		              }
		               ?>
		              <input class="form-control" type="text" name="tgl_lahir1" value="<?php echo $lahir ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Fakultas</label>
		              <input type="text" name="fakultas" class="form-control" disabled="" value="<?php echo $f[0] ?>" required autofocus>
		              <input type="hidden" name="fakultas" class="form-control" value="<?php echo $f[0] ?>" required autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Jurusan/Prodi</label>
		              <input type="text" name="prodi" class="form-control" disabled="" value="<?php echo $j[0] ?>" required autofocus>
		              <input type="hidden" name="prodi" class="form-control" value="<?php echo $j[0] ?>" required autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Index Prestasi Kumulatif (IPK) <small>Gunakan titik (.) untuk koma (contoh: 3.56)</small></label>
		              <input type="text" name="ipk" class="form-control" pattern="[0-9.]*" value="<?php echo number_format($p->peserta_ipk, 2) ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Awal Bimbingan <small>(contoh: Januari 2019)</small></label>
		              <input class="form-control" type="text" name="awal_bimbingan" placeholder="mm yyyy" value="<?php echo $p->peserta_awal_bimbingan ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Akhir Bimbingan <small>(contoh: Januari 2019)</small></label>
		              <input class="form-control" type="text" name="akhir_bimbingan" placeholder="mm yyyy" value="<?php echo $p->peserta_akhir_bimbingan ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Judul Skripsi</label>
		              <input type="hidden" name="skripsi" class="form-control" value="<?php echo $p->peserta_judul_skripsi ?>" autofocus>
		              <textarea class="form-control" name="skripsi1" disabled><?php echo $p->peserta_judul_skripsi ?></textarea>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Tanggal Sidang</label>
		              <input type="text" name="tanggal_keluar_" id="demoDate1" class="form-control" value="<?php echo $p->peserta_tanggal_sidang ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Lama Studi <small>(contoh: 4 Tahun 0 Bulan)</small></label>
		              <input type="text" disabled name="lama_" class="form-control" value="<?php echo $p->peserta_lama_studi ?>" disabled>
		              <input type="hidden" name="lama_studi" class="form-control" value="<?php echo $p->peserta_lama_studi ?>" required autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Predikat</label>
		              <input type="text" disabled name="predikat1" class="form-control" value="<?php echo $p->peserta_predikat ?>">
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor Ijazah<small> (Kosongkan jika belum mendapatkan ijazah)</small></label>
		              <input type="text" name="ijazah" class="form-control" value="<?php if($p->peserta_no_ijazah == ''){ echo '-';}else{ echo $p->peserta_no_ijazah; } ?>" disabled>
		              <input type="hidden" name="tahun_masuk" class="form-control" value="<?php echo '20'.substr($p->peserta_kode , 0, 2)?>">
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor Blanko Ijazah<small> (Kosongkan jika belum mendapatkan ijazah)</small></label>
		              <input type="text" name="blanko" class="form-control" value="<?php echo $p->peserta_nomor_blanko; ?>" disabled>
		            </div>
              </div>
		            
              </div>
            </div>
            
            
          </div>
          </form>
          <?php } ?>
        </div>
	        </div>
	      </div>
		</div>
	</div>
</main>