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
                <label class="btn btn-primary">
                  <a id="option1" type="radio" name="options" autocomplete="off" checked="true"><i class="fa fa-file"></i>Lampiran</a>
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
            <form method="post" action="<?php echo base_url() ?>mahasiswa/biodata_update" enctype="multipart/form-data">
            <div class="tile">
            	<h3 class="tile-title">Form Biodata</h3>
            <div class="row">
              <div class="col-lg-6">
              	<div class="form-group">
		              <label class="control-label">Nomor Induk Mahasiswa</label>
		              <input type="hidden" name="peserta_kode" class="form-control" value="<?php echo $p->peserta_kode ?>">
		              <input type="text" name="peserta_kode1" class="form-control" value="<?php echo $p->peserta_kode ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nama Mahasiswa</label>
		              <input type="text" name="nama" class="form-control" value="<?php echo $p->peserta_nama ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor KTP</label>
		              <input type="text" name="ktp" class="form-control" value="<?php echo $p->peserta_no_ktp ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor KK</label>
		              <input type="text" name="kk" class="form-control" value="<?php echo $p->peserta_no_kk ?>" required="" autofocus>
		            </div>
              		<div class="form-group">
		              <label class="control-label">Jenis Kelamin</label>
		              <select class="form-control" name="jenis_kelamin" required="">
		              	<option value="<?php echo $p->peserta_jenis_kelamin ?>"><?php echo $p->peserta_jenis_kelamin ?></option>
		              	<option value="Laki-Laki">Laki-Laki</option>
		              	<option value="Perempuan">Perempuan</option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Tempat Lahir</label>
		              <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $p->peserta_tempat_lahir ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Tanggal Lahir</label>
		              <?php 
		              if ($p->peserta_tanggal_lahir!="0000-00-00") {
		              	$lahir = $p->peserta_tanggal_lahir;
		              }else{
		              	$lahir = "";
		              }
		               ?>
		              <input class="form-control" type="text" id="demoDate2" name="tgl_lahir" placeholder="yyyy-mm-dd" value="<?php echo $lahir ?>" required=""> 
		            </div>
              		<div class="form-group">
		              <label class="control-label">Agama</label>
		              <select class="form-control" name="agama" required="">
		              	<option value="<?php echo $p->peserta_agama ?>"><?php echo $p->peserta_agama ?></option>
		              	<option value="">Pilih Agama</option>
		              	<option value="Islam">Islam</option>
		              	<option value="Kristen Katolik">Kristen Katolik</option>
		              	<option value="Kristen Protestan">Kristen Protestan</option>
		              	<option value="Hindu">Hindu</option>
		              	<option value="Budha">Budha</option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor Telepon</label>
		              <input type="text" name="telepon" class="form-control" value="<?php echo $p->peserta_telepon ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Email</label>
		              <input type="text" name="email" class="form-control" value="<?php echo $p->peserta_email ?>" required="" autofocus>
		          	</div>
		            <div class="form-group">
		              <label class="control-label">Provinsi</label>
		              <select class="form-control" name="provinsi" id="provinsi" required="">
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
		              <select class="kabupaten form-control" name="kabupaten" id="kabupaten" required="">
		              	<option value="<?php echo $p->peserta_kabupaten ?>"><?php echo $p->peserta_kabupaten ?></option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Kecamatan</label>
		              <select class="kecamatan form-control" name="kecamatan" required="">
		              	<option value="<?php echo $p->peserta_kecamatan ?>"><?php echo $p->peserta_kecamatan ?></option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Alamat</label>
		              <input type="text" name="alamat" class="form-control" value="<?php echo $p->peserta_alamat ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nama Ayah</label>
		              <input type="text" name="ayah" class="form-control" value="<?php echo $p->peserta_ayah ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nama Ibu</label>
		              <input type="text" name="ibu" class="form-control" value="<?php echo $p->peserta_ibu ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Sekolah Asal</label>
		              <input type="text" name="sekolah asal" class="form-control" value="<?php echo $p->peserta_sekolah_asal ?>" required="" autofocus>
		            </div>
              </div>
              <div class="col-lg-6">
		            <div class="form-group">
		              <label class="control-label">Fakultas</label>
		              <input type="text" name="fakultas" class="form-control" disabled="" value="<?php echo $f[0] ?>" required="" autofocus>
		              <input type="hidden" name="fakultas" class="form-control" value="<?php echo $f[0] ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Jurusan/Prodi</label>
		              <input type="text" name="prodi" class="form-control" disabled="" value="<?php echo $j[0] ?>" required="" autofocus>
		              <input type="hidden" name="prodi" class="form-control" value="<?php echo $j[0] ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Index Prestasi Kumulatif (IPK)</label>
		              <input type="text" name="ipk1" class="form-control" disabled="" value="<?php echo $p->peserta_ipk ?>">
					  <input type="hidden" name="ipk" class="form-control" value="<?php echo $p->peserta_ipk ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Awal Bimbingan</label>
		              <input class="form-control" type="text" name="awal_bimbingan" placeholder="mm yyyy" value="<?php echo $p->peserta_awal_bimbingan ?>">
		            </div>
		            <div class="form-group">
		              <label class="control-label">Akhir Bimbingan</label>
		              <input class="form-control" type="text" name="akhir_bimbingan" placeholder="mm yyyy" value="<?php echo $p->peserta_akhir_bimbingan ?>">
		            </div>
		            <div class="form-group">
		              <label class="control-label">Judul Skripsi</label>
		              <textarea class="form-control" name="skripsi"><?php echo $p->peserta_judul_skripsi ?></textarea>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Tanggal Sidang</label>
		              <input type="hidden" name="tanggal_keluar" id="demoDate1" class="form-control" value="<?php echo $p->peserta_tanggal_sidang ?>">
		              <input type="text" name="sidang" id="demoDate1" class="form-control" value="<?php echo $p->peserta_tanggal_sidang ?>" disabled>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Lama Studi</label>
		              <input type="text" disabled name="lama" class="form-control" value="<?php echo $p->peserta_lama_studi ?>" required="" autofocus>
		              <input type="hidden" name="lama" class="form-control" value="<?php echo $p->peserta_lama_studi ?>" required="" autofocus>
		            </div>
		            <div class="form-group">
		              <label class="control-label">Predikat</label>
		              <input type="text" disabled name="predikat1" class="form-control" value="<?php echo $p->peserta_predikat ?>">
		              <input type="hidden" name="predikat" class="form-control" value="<?php echo $p->peserta_predikat ?>">
		            </div>
		            <div class="form-group">
		              <label class="control-label">Nomor Izajah</label>
		              <input type="text" name="ijazah" class="form-control" value="<?php echo $p->peserta_no_ijazah ?>" disabled>


		              <input type="hidden" name="tahun_masuk" class="form-control" value="<?php echo '20'.substr($p->peserta_kode , 0, 2)?>">
		            </div>
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" style="margin-left: 89%" type="submit">Selanjunya <i class="fa fa-arrow-right"></i></button>
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