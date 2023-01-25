<main class="app-content" style="background-color: white">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-pencil"></i> Daftar Wisuda</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
		</ul>
	</div>
<?php show_alert(); ?>
	<div class="row">
		<?php
		$db = $this->M_vic->panggil_db();
		$id = $this->session->userdata('uid');
		$pegawai=mysqli_query($db, "SELECT peserta_checklist FROM tbl_peserta WHERE peserta_kode = '$id' AND peserta_checklist >= 5 ");
		$p=mysqli_fetch_array ($pegawai);
		$sesi_wisuda=mysqli_query($db, "SELECT * FROM tbl_jadwalwisuda  ORDER BY jadwal_id DESC LIMIT 1");
		$s1 = mysqli_num_rows($sesi_wisuda);
		$alumni_1=mysqli_query($db, "SELECT * FROM tbl_alumni WHERE mhs_nim = '$id' ");
		$a1 = mysqli_num_rows($alumni_1);
		$a2 = mysqli_fetch_array($alumni_1);
		$periksa_1 = 0;
		$periksa_2 = 0;
		foreach ($cek as $c) {
			$cekubah1 = $c->cek_list_id;
			$cekubah2 = $c->cek_list_id - 1;
			if(($c->cek_list_id - 1) <= 1){
			  $cekubah3 = '05';
			}elseif(($c->cek_list_id - 1) <= 9){
			  $cekubah3 = '0'.$cekubah2;
			}else{
			  $cekubah3 = $cekubah2;
			}
				$cekhitung = $p[0] - $c->cek_list_id;
				//if($cekhitung >= 0){
				if($c->cek_list_id <= $p[0]){
					$periksa_2 = 1;
					$ceklis_1 = ' '.$c->cek_list_nama.' ';
				}else{
					$periksa_2 = 0;
				}
				$periksa_1 = $periksa_1+$periksa_2;			
		}
		

			if($a1 > 0){
				echo '<div class="col-md-6 col-lg-12">
				<div class="widget-small success coloured-icon" style="background-color: darkblue;"><i class="icon fa fa-exclamation-circle fa-3x"></i>
				<div class="info">
					<H3>Selamat... <br>Anda Telah Terdaftar Sebagai Peserta Wisuda</H3>
					Nomor Peserta Anda: '.$a2[1].'
					<br>
					<a class="btn btn-success" href="'.base_url().'wisuda/daftarwisuda_cetak2"><i class="fa fa-print""></i> Cetak </a>
					<a class="btn btn-danger pull-right" href="'.base_url().'wisuda/daftarwisuda_cancel"><i class="fa fa-times-circle""></i> Batalkan </a>
					<br>&nbsp;
				</div></div></div>';
			}else{
				if($s1 == 0){
					echo '<div class="col-md-6 col-lg-12">
					<div class="widget-small success coloured-icon" style="background-color: lightgreen;"><i class="icon fa fa-exclamation-circle fa-3x"></i>
					<div class="info"><H3>Kuota Penuh</H3>
					</div></div></div>';
				}else{
					echo '<div class="col-md-6 col-lg-12">
					<div class="widget-small success coloured-icon" style="background-color: lightgreen;"><i class="icon fa fa-exclamation-circle fa-3x"></i>
					<div class="info"><H3>Daftar Sekarang ?</H3>';
					echo '<form target="" action="'.base_url().'wisuda/daftarwisuda_act/" method="post">
					<table><tr><td>
					<select class="form-control" name="sesi_wisuda">';
						while($s2 = mysqli_fetch_array ($sesi_wisuda)){
							echo '<option value="'.$s2[0].'">Angkatan: '.$s2[1].' ('.$s2[4].')</option>';
								}
						echo '</select>
								</td><td>';
					echo '<button class="btn btn-primary" type="submit"><i class="fa fa-check""></i> Ya </button>
								</td></tr></table> </from>
					</div></div></div>';
				}
			}
		

		

	
		?>	
    </div>
</main>