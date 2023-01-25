<main class="app-content" style="background-color: white">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Alur Pengurusan</h1>
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
		<table border="0">
			<tr>
				<td>					
				  <div class="widget-small info coloured-icon"><i class="icon fa fa-check fa-3x">
					<div class="info">
					  <?php 
								  $auto="01";
								  $pegawai=mysqli_query($db, "SELECT * FROM tbl_pegawai");
								  $pe=mysqli_num_rows($pegawai)
					   ?>
					  <p><b><?php echo $pe ?> Input Data Peserta</b></p>
					</div></i>
				  </div>
				</td>
				<td>
					<div class="widget-small">
						<i class="icon fa fa-arrow-right fa-3x" style="background-color: white;color: lightgreen;"></i>
					</div>
				</td>
			</tr>
		</table>
		<br><br><br><br>
		
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
		<!--
		<img src="<?php echo base_url();?>vic_image/system/box-head.jpg">
		<div style="width: 200px; height: 1px; border: 1px #000 solid;"></div>
		<div style="width: 0px; height: 200px; border: 1px #000 solid;"></div>
		-->

        <div class="col-md-6 col-lg-3">
        <a  href="<?php echo base_url('biro/peserta/0') ?>" style="text-decoration: none">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Peserta</h4>
              <?php 
      				  $auto="01";
      				  $peserta=mysqli_query($db, "SELECT * FROM tbl_peserta");
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
        				  $pesan=mysqli_query($db, "SELECT * FROM tbl_pesan WHERE tp_admin='$id' AND tp_status_baca = '' AND h_pengguna = tp_mahasiswa ");
        				  $ps=mysqli_num_rows($pesan);
               ?>
              <p><b><?php echo $ps ?></b></p>
            </div>
          </div>
      	</a>
        </div>
        <div class="col-md-6 col-lg-3">
        <a href="<?php echo base_url('biro/aktivasi_akun') ?>" style="text-decoration: none">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-times-circle fa-3x"></i>
            <div class="info">
              <h4>Verifikasi</h4>
              <?php 
      				  $peserta1=mysqli_query($db, "SELECT * FROM tbl_peserta WHERE peserta_verifikasi=''");
      				  $p1=mysqli_num_rows($peserta1);
               ?>
              <p><b><?php echo $p1 ?></b></p>
            </div>
          </div>
      	</a>
        </div>
		
		
      </div>
</main>