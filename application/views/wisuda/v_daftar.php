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
		<div class="col-md-12">
			<div class="tile">
				<h3 class="tile-title">Form Tambah Lampiran</h3>
				<div class="tile-body">
					<?php
					$upload = $lampiran->num_rows();
					$hasUpload = 0;
					foreach ($lampiran->result() as $l) :
						if ($l->lampiran != '') {
							$hasUpload++;
						}
					?>
						<form method="post" action="<?php echo base_url('wisuda/daftar_lampiran_act') ?>" enctype="multipart/form-data">
							<table width="100%" border="0">
								<tr>
									<td width="50%" align="left" valign="top">
										<?php
										echo "<label>Upload " . $l->lampiran_nama . " <small>(Format: *." . $l->lampiran_format . ")</small></label><br>";
										//if($a->peserta_lampiran1 != ""){
										if ($l->lampiran != '') {
											echo "<small style='color: green'>(* Abaikan jika tidak ada perubahan)</small>";
										} else {
											echo "<small style='color: red'>(* File belum diupload)</small>";
										}
										?>
									</td>
									<?php if (!empty($alumni) && $alumni->mhs_no_wisuda != '') {
										echo "<td colspan='2' <div class='alert alert-danger'>Data sudah di verifikasi</div></td>"; ?>
									<?php } else {
										echo '<td align="center" valign="top">';
										if ($l->lampiran_format == 'jpg') {
											echo '
												<input type="file" name="filedata" id="filedata" class="form-control" accept="image/*">
												<input type="hidden" name="lamp_file" value="' . $l->lampiran . '">
												<input type="hidden" name="lamp_kode" value="' . $l->lampiran_id . '">
												<input type="hidden" name="lamp_nama" value="' . $l->lampiran_nama . '">
												<input type="hidden" name="lamp_format" value="' . $l->lampiran_format . '">';
										} else {
											echo '
												<input type="file" name="filedata" id="filedata" class="form-control" accept="application/pdf">
												<input type="hidden" name="lamp_file" value="' . $l->lampiran . '">
												<input type="hidden" name="lamp_kode" value="' . $l->lampiran_id . '">
												<input type="hidden" name="lamp_nama" value="' . $l->lampiran_nama . '">
												<input type="hidden" name="lamp_format" value="' . $l->lampiran_format . '">';
										}
										if (empty($alumni)) {
											echo '</td>
											<td align="center" valign="top">
												<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-save"> UPLOAD</i></button>
											</td>';
										}
										if ($l->lampiran != '') {
											echo '<td width="15%" align="right" valign="top"> <a href="' . base_url() . 'dokumen/lampiran/syarat_wisuda/' . $l->lampiran . '" class="btn btn-default" target="_blank">Lihat Data</a></td>';
										} else {
											echo '<td width="15%" align="right" valign="top"> <small>(max size: 500kb)</small></td>';
										}
									} ?>

								</tr>
							</table>
							<input type="hidden" name="peserta_prodi" value="<?php echo $prodi; ?>">
							<br>
						</form>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<?php
		if (!empty($alumni)) {
			if ($alumni->mhs_no_wisuda != '') {
				echo '<div class="col-md-6 col-lg-12">
				<div class="widget-small success coloured-icon" style="background-color: darkblue;"><i class="icon fa fa-exclamation-circle fa-3x"></i>
				<div class="info">
					<H3>Selamat... <br>Anda Telah Terdaftar Sebagai Peserta Wisuda</H3>
					Nomor Peserta Anda: ' . $alumni->mhs_no_wisuda . '
					<br>
					<a class="btn btn-success" href="' . base_url() . 'wisuda/daftarwisuda_cetak2"><i class="fa fa-print""></i> Cetak </a>
					<br>&nbsp;
				</div></div></div>';
			} else {
				echo '<div class="col-md-6 col-lg-12">
				<div class="widget-small success coloured-icon" style="background-color: #ff6347;"><i class="icon fa fa-exclamation-circle fa-3x"></i>
				<div class="info">
					<br>
					<H3>Anda Telah Berhasil Mendaftar. Admin akan melakukan verifikasi berkas anda.</H3>
					Nomor Peserta Anda: Akan muncul setelah verifikasi berkas oleh admin
					<br>
					<br>
				</div></div></div>';
			}
		} else {
			if (empty($sesi)) {
				echo '<div class="col-md-6 col-lg-12">
					<div class="widget-small success coloured-icon" style="background-color: lightgreen;"><i class="icon fa fa-exclamation-circle fa-3x"></i>
					<div class="info"><H3>Kuota Penuh</H3>
					</div></div></div>';
			} else {
				echo '<div class="col-md-6 col-lg-12">
					<div class="widget-small success coloured-icon" style="background-color: lightgreen;"><i class="icon fa fa-exclamation-circle fa-3x"></i>
					<div class="info"><H3>Daftar Sekarang ?</H3>';
				echo '<form target="" action="' . base_url() . 'wisuda/daftarwisuda_act/" method="post">
					<table><tr><td>
					<select class="form-control" name="sesi_wisuda">';
				// while ($s2 = mysqli_fetch_array($sesi_wisuda)) {
				echo '<option value="' . $sesi->jadwal_id . '">Angkatan: ' . $sesi->jadwal_nama . ' (' . TanggalIndo($sesi->jadwal_tanggal) . ')</option>';
				// }
				echo '</select>
								</td><td>';
				if ($hasUpload == $upload) {
					echo '<button class="btn btn-primary" type="submit"><i class="fa fa-check""></i> Ya </button>
								</td></tr></table> </from>
					</div></div></div>';
				} else {
					echo '<button class="btn btn-warning" disabled><i class="fa fa-exclamation-triangle""></i> Belum upload berkas </button>
								</td></tr></table> </from>
					</div></div></div>';
				}
			}
		}





		?>
	</div>
</main>