<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 31 Dec 2018 05:00:00 GMT");
	header("content-disposition: attachment;filename=formbiodatawisuda.xls");
?>
<!DOCTYPE html>
<html>
<head>
	<title>UNIMAL</title>
	<link rel="shortcut icon" href="<?php echo base_url().'vic_image/system/logo_unimal_2.png'?>">
	<style type="text/css">
		h1{
			font-family:  "Times New Roman";
			font-size: 14pt;
		}

		body{
			font-family:  "Times New Roman";
			font-size: 12pt;
		}

		tr>th,tr>td{
			padding: 0px;
			font-size: 12pt;
			font-family:  "Times New Roman";
			/*text-align: left;
			border: 1px solid black;*/
		}
		table {
			border-spacing: 0;
			border-collapse: collapse;
			width: 100%;
		}
	</style>
</head>
<body>
<?php foreach($sesi_wisuda as $s){} ?>
	<center>
	<?php
		echo "<h1>FORM BIODATA WISUDAWAN/I KE  ".$s->jadwal_nama."<br>";  
		echo "UNIVERSITAS MALIKUSSALEH <br>";  
		echo "TAHUN ".$s->jadwal_tahun."<br></h1>"; 
	?>
	</center>
	<?php 
		$no = 1;
		//$peserta = $this->db->query("SELECT * FROM v_alumni_wisuda WHERE mhs_sesi_wisuda = '$sesi' ORDER BY mhs_fakultas ASC, mhs_prodi ASC, mhs_nim ASC ")->result();
		$peserta = $this->db->query("SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC ")->result();
		/*$peserta = $this->db->query("SELECT a.mhs_nim, a.mhs_nama, b.peserta_jenis_kelamin, b.peserta_bin, a.mhs_fakultas, a.mhs_prodi, a.mhs_tempat_lahir, a.mhs_tanggal_lahir, a.mhs_telepon, a.mhs_alamat, b.peserta_tanggal_masuk, b.peserta_tanggal_keluar, b.peserta_lama_studi, b.peserta_ipk, b.peserta_predikat, b.peserta_sekolah_asal, b.peserta_ayah, b.peserta_judul_skripsi, c.prodi_nama, a.mhs_sesi_wisuda
		FROM tbl_alumni a, tbl_peserta b, tbl_prodi c
		WHERE a.mhs_nim = b.peserta_kode  AND c.prodi_kode = a.mhs_prodi AND a.mhs_sesi_wisuda = '$sesi'
		GROUP BY a.mhs_nim 
		ORDER BY c.prodi_fakultas ASC, c.prodi_kode_internal ASC, a.mhs_nim ASC")->result();*/
		echo '<table border="1" width="100%">';
				echo '<tr>
						<td align="center" bgcolor="BEC3C7"><b>NO</b></td>
						<td align="center" bgcolor="BEC3C7"><b>NAMA</b></td>
						<td align="center" bgcolor="BEC3C7"><b>NAMA AYAH</b></td>
						<td align="center" bgcolor="BEC3C7"><b>NIM</b></td>
						<td align="center" bgcolor="BEC3C7"><b>JK</b></td>
						<td align="center" bgcolor="BEC3C7"><b>AGAMA</b></td>
						<td align="center" bgcolor="BEC3C7"><b>NO. HP</b></td>
						<td align="center" bgcolor="BEC3C7"><b>TEMPAT LAHIR</b></td>
						<td align="center" bgcolor="BEC3C7"><b>TANGGAL LAHIR</b></td>
						<td align="center" bgcolor="BEC3C7"><b>TANGGAL MASUK</b></td>
						<td align="center" bgcolor="BEC3C7"><b>TANGGAL LULUS</b></td>
						<td align="center" bgcolor="BEC3C7"><b>LAMA STUDI</b></td>
						<td align="center" bgcolor="BEC3C7"><b>IPK</b></td>
						<td align="center" bgcolor="BEC3C7"><b>PREDIKAT</b></td>
						<td align="center" bgcolor="BEC3C7"><b>JUDUL SKRIPSI</b></td>
						<td align="center" bgcolor="BEC3C7"><b>PROGRAM STUDI</b></td>
						<td align="center" bgcolor="BEC3C7"><b>ASAL SMA</b></td>
					</tr>';
				foreach ($peserta as $p) {
	                $jur = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p->mhs_prodi'");
	                $j = mysqli_fetch_array ($jur);
				echo '<tr>
				<td align="center" valign="top">'.$no++.'</td>
				<td align="left" valign="top">'.ucwords(strtolower($p->mhs_nama)).'</td>
				<td align="left" valign="top">'.ucwords(strtolower($p->peserta_ayah)).'</td>
				<td align="center" valign="top">&nbsp;'.$p->mhs_nim.'</td>
				<td align="center" valign="top">'.substr($p->peserta_jenis_kelamin, 0, 1).'</td>
				<td align="center" valign="top">'.$p->mhs_agama.'</td>
				<td align="left" valign="top">&nbsp;'.$p->mhs_telepon.'</td>
				<td align="left" valign="top">'.ucwords(strtolower($p->mhs_tempat_lahir)).'</td>
				<td align="left" valign="top">'.($p->mhs_tanggal_lahir).'</td>
				<td align="left" valign="top">'.($p->peserta_tanggal_masuk).'</td>
				<td align="left" valign="top">'.($p->peserta_tanggal_keluar).'</td>
				<td align="right" valign="top">'.ucwords(strtolower($p->peserta_lama_studi)).'</td>
				<td align="center" valign="top">'.number_format($p->peserta_ipk, 2).'</td>
				<td align="center" valign="top">'.$p->peserta_predikat.'</td>
				<td align="left" valign="top">'.ucwords(strtolower($p->peserta_judul_skripsi)).'</td>
				<td align="left" valign="top">'.strtoupper($j[0]).'</td>
				<td align="left" valign="top">'.strtoupper($p->peserta_sekolah_asal).'</td>
					</tr>';
				}
		echo '</table>';
	?>
<?php /*
<table border="0">
	<tr>
		<td colspan="3"></td>
		<td colspan="2" align="center">
			<?php
			echo "<br><b>Aceh Utara, </b> ", TanggalIndo(date('Y-m-d'));
			echo "<br><br><br><br>";
			echo "( ".$this->session->userdata('unama')." )";
			?>
		</td>
	</tr>
</table>
*/ ?>
</body>
</html>