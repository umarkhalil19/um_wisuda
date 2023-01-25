<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 31 Dec 2018 05:00:00 GMT");
	header("content-disposition: attachment;filename=rekapdatawisuda.xls");
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

		p{
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
		echo "<h1>WISUDA KE  ".$s->jadwal_nama."<br>";  
		echo "UNIVERSITAS MALIKUSSALEH <br>";  
		echo "TAHUN ".$s->jadwal_tahun."<br></h1>"; 
	?>
</center>
<table>
	<?php
		$no=1;
		$tot1 = 0; $tot2 = 0;
		foreach ($fakultas as $f) {
		$idfak = $f->fakultas_id;
		$jurusan_1 = mysqli_query($db, "SELECT prodi_nama, (SELECT COUNT(mhs_nim) FROM tbl_alumni WHERE mhs_prodi = prodi_kode AND mhs_jenis_kelamin = 'Laki-Laki' AND mhs_sesi_wisuda = '$sesi') AS laki, (SELECT COUNT(mhs_nim) FROM tbl_alumni WHERE mhs_prodi = prodi_kode AND mhs_jenis_kelamin = 'Perempuan' AND mhs_sesi_wisuda = '$sesi') AS perempuan FROM tbl_prodi WHERE prodi_fakultas = '$idfak' ORDER BY prodi_kode ASC;");
		//$j1 = mysqli_fetch_array($jurusan_1);
		$peserta_1 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Laki-Laki' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
		$p1 = mysqli_num_rows($peserta_1);
		$peserta_2 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Perempuan' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
		$p2 = mysqli_num_rows($peserta_2);
		$tot1 = $tot1+$p1;
		$tot2 = $tot2+$p2;
		echo '<tr><td>&nbsp;</b></td></tr>';
		echo '<tr><td><b>'.$f->fakultas_nama.'</b></td></tr>';
		echo '<tr><td>
				<table border="1">
				<tr>
					<th>Program Studi</th>
					<th>Laki-Laki</th>
					<th>Perempuan</th>
				</tr>';
				$tot_j1 = 0;
				$tot_j2 = 0;
				$tot_j3 = 0;
				while($j1 = mysqli_fetch_array($jurusan_1)){
					$tot_j1 = $tot_j1 + $j1['laki'];
					$tot_j2 = $tot_j2 + $j1['perempuan'];
				echo '<tr>';
				echo '<td>'.$j1['prodi_nama'].'<br>'.'</td>';
				echo '<td align="center">'.$j1['laki'].'<br>'.'</td>';
				echo '<td align="center">'.$j1['perempuan'].'<br>'.'</td>';
				echo '</tr>';
				}
				$tot_j3 = $tot_j1 + $tot_j2;
			echo '<tr>
					<td><b>SUB TOTAL</b></td>
					<td align="center"><b>'.$tot_j1.'</b></td>
					<td align="center"><b>'.$tot_j2.'</b></td>
				</tr>
				<tr>
					<td><b>SUB TOTAL SELURUH</b></td>
					<td align="center" colspan="2"><b>'.$tot_j3.'</b></td>
				</tr>
				</table>
				</td></tr>';
			
		
		?>
		<?php } ?>
	<tr>
		<td align="left">
		<?php 
		$tot3 = $tot1 + $tot2;
			echo '<br>
			<table border="1">
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td><b>TOTAL</b></td>
				<td align="center"><b>'.$tot1.' Orang</b></td>
				<td align="center"><b>'.$tot2.' Orang</b></td>
			</tr>
			<tr>
				<td><b>TOTAL SELURUH</b></td>
				<td align="center" colspan="2"><b>'.$tot3.' Orang</b></td>
			</tr>
			</table>';
		?>
		</td>
	</tr>
</table>
</body>
</html>