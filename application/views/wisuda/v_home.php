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
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<h3 class="tile-title" align="center">SELAMAT DATANG DI SISTEM INFORMASI WISUDA UNIVERSITAS MALIKUSSALEH</h3>
				<div align="center">
					<img style="align-items: center" width="10%" src="assets/Logo_Unimal.png">
				</div>
				<?php
				if ($psw == 'ganti') {
					echo
					'<div align="center">
							 <label class="alert alert-danger"><strong>Sistem Mendeteksi Anda Login Dengan Menggunakan Password Default, Harap Diubah Terlebih Dahulu.<br>Silahkan Klik Tombol Ganti Password Untuk Merubah Password Default Anda</strong></label><br>
							 <a href="' . base_url('wisuda/password') . '" class="btn btn-primary"><strong>Ganti Password</strong></a>
						 </div>';
				} else {
					echo
					'<div align="center">
							 <br>
							 <a href="' . base_url('wisuda/daftarwisuda') . '" class="btn btn-primary"><strong>DAFTAR WISUDA</strong></a>
						 </div>';
				}
				?>
			</div>
		</div>
	</div>
</main>