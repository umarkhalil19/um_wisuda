<main class="app-content" style="background-color: white">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Proses Pendaftaran Wisuda <?php echo '<b>'.ucfirst(strtolower($this->session->userdata('unama'))).'</b>'; ?></h1>
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
			$ceklis_1 = '<div class="col-md-6 col-lg-12">
						  <div class="widget-small info coloured-icon" style="background-color: lightblue;"><i class="icon fa fa-check fa-3x"></i>
							<div class="info">';
			$ceklis_2 = $c->cek_list_nama;
			$ceklis_3 = '</div></div></div>';
			$cekhitung = $p[0] - $c->cek_list_id;
			//if($cekhitung >= 0){
			if($c->cek_list_id <= $p[0]){
			  $ceklis_1 = '<div class="col-md-6 col-lg-12">
				  <div class="widget-small info coloured-icon" style="background-color: lightblue;"><i class="icon fa fa-check fa-3x"></i>
					<div class="info">';
			}else{
			  $ceklis_1 = '<div class="col-md-6 col-lg-12">
				  <div class="widget-small danger coloured-icon" style="background-color: pink;"><i class="icon fa fa-times-circle fa-3x"></i>
					<div class="info">';
			}
			echo $ceklis_1.$ceklis_2.$ceklis_3;
			//echo $p[0].' '.$c->cek_list_id;
		}
	
		?>	
    </div>
</main>