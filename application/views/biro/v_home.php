<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Dashboard</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
		</ul>
	</div>
	<?php 
  show_alert();
  $db = $this->M_vic->panggil_db();

  ?>
	<div class="row">
        <div class="col-md-6 col-lg-3">
        <a  href="<?php echo base_url('biro/pegawai') ?>" style="text-decoration: none">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>PEGAWAI</h4>
              <?php 
        				  $auto="01";
        				  $pegawai=mysqli_query($db, "SELECT * FROM tbl_pegawai");
        				  $pe=mysqli_num_rows($pegawai)
               ?>
              <p><b><?php echo $pe ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        <div class="col-md-6 col-lg-3">
        <a  href="<?php echo base_url('biro/peserta/0') ?>" style="text-decoration: none">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Pengusul Ijazah</h4>
              <?php 
      				  $auto="01";
      				  $peserta=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE peserta_nomor_ijazah = ''");
      				  $p=mysqli_num_rows($peserta)
               ?>
              <p><b><?php echo $p ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        <div class="col-md-6 col-lg-3">
        <a  href="<?php echo base_url('biro/pesan') ?>" style="text-decoration: none">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-envelope fa-3x"></i>
            <div class="info">
              <h4>Belum Dibaca</h4>
              <?php 
        				  $id = $this->session->userdata('uuser');
        				  $pesan=mysqli_query($db, "SELECT * FROM tbl_pesan WHERE tp_admin='$id' AND (tp_status_baca = '' OR tp_status_baca = 'Belum Dibaca') AND h_pengguna = tp_mahasiswa ");
        				  $ps=mysqli_num_rows($pesan);
               ?>
              <p><b><?php echo $ps ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        <div class="col-md-6 col-lg-3">
        <a href="<?php echo base_url('biro/peserta_pesan_ver') ?>" style="text-decoration: none">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-check fa-3x"></i>
            <div class="info">
              <h4>Verifikasi Ijazah</h4>
              <?php 
      				  $peserta1=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE peserta_no_kk != '' AND peserta_status_verifikasi = ''");
      				  $p1=mysqli_num_rows($peserta1);
               ?>
              <p><b><?php echo $p1 ?></b></p>
            </div>
          </div>
      	</a>
        </div>
<?php /* Info Wisuda */ ?>
        <div class="col-md-6 col-lg-3">
        <a  href="<?php echo base_url('biro/wisuda_calon') ?>" style="text-decoration: none">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <p style="font-size:14px;">Calon Peserta Wisuda</p>
              <?php 
        				  $auto="01";
        				  $pegawai=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE peserta_status_verifikasi = '' ");
        				  $pe=mysqli_num_rows($pegawai)
               ?>
              <p><b><?php echo $pe ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        <div class="col-md-6 col-lg-3">
        <a  href="<?php echo base_url('biro/wisuda_peserta') ?>" style="text-decoration: none">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-info fa-3x"></i>
            <div class="info">
              <p style="font-size:14px;">Belum Registrasi</p>
              <?php 
        				  $id = $this->session->userdata('uuser');
        				  $pesan=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE peserta_status_verifikasi = '' AND peserta_no_kk = '' ");
        				  $ps=mysqli_num_rows($pesan);
               ?>
              <p><b><?php echo $ps ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        <div class="col-md-6 col-lg-3">
        <a href="<?php echo base_url('biro/wisuda_ver') ?>" style="text-decoration: none">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-exclamation fa-3x"></i>
            <div class="info">
              <p style="font-size:14px;">Perlu Verifikasi</p>
              <?php 
      				  $peserta1=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE peserta_status_verifikasi = '' AND peserta_no_kk != ''");
      				  $p1=mysqli_num_rows($peserta1);
               ?>
              <p><b><?php echo $p1 ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        <div class="col-md-6 col-lg-3">
        <a  href="<?php echo base_url('biro/jadwalwisuda_set_edit') ?>" style="text-decoration: none">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
            <div class="info">
              <p style="font-size:14px;">Tanggal Pendaftaran</p>
              <?php 
      				  $auto="01";
      				  $peserta=mysqli_query($db, "SELECT * FROM tbl_jadwalbuka");
      				  $p=mysqli_fetch_array($peserta);
               ?>
              <p><b><?php echo date('d-m-Y', strtotime($p['set_tanggal_buka'])) ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        
  </div>
  
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<h3 class="tile-title" align="center"><?php echo $this->M_vic->get_option('blog_name').'<br>'.$this->M_vic->get_option('blog_description'); ?></h3>
				<div align="center">
					<img style="align-items: center" width="10%" src="<?php echo base_url(); ?>vic_image/system/logo_unimal_2.png">
				</div>
			</div>
		</div>
	</div>
</main>