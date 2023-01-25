<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 31 Dec 2018 05:00:00 GMT");
	header("content-disposition: attachment;filename=detaildatawisuda.xls");
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
		foreach ($fakultas as $f1) {
		$peserta = $this->db->query("SELECT * FROM v_alumni_predikat WHERE prodi_fakultas = '$f1->fakultas_id' AND mhs_sesi_wisuda = '$sesi' ORDER BY peserta_jenis_kelamin ASC, prodi_kode ASC, mhs_nim ASC ")->result();
		echo '<tr><td>&nbsp;</td></tr>';
		echo '<tr><td align="left"><b>'.$f1->fakultas_nama.'</b></td></tr>';
		echo '<tr><td width="100%">
				<table border="1" width="100%">';
				echo '<tr>
				<td width="20%" align="center" bgcolor="BEC3C7"><b>PROGRAM STUDI</b></td>
				<td width="05%" align="center" bgcolor="BEC3C7"><b>JK</b></td>
				<td width="10%" align="center" bgcolor="BEC3C7"><b>NO WISUDA</b></td>
				<td width="10%" align="center" bgcolor="BEC3C7"><b>NIM</b></td>
				<td width="20%" align="center" bgcolor="BEC3C7"><b>NAMA</b></td>
				<td width="07%" align="center" bgcolor="BEC3C7"><b>IPK</b></td>
				<td width="13%" align="center" bgcolor="BEC3C7"><b>LAMA STUDI</b></td>
				<td width="15%" align="center" bgcolor="BEC3C7"><b>PREDIKAT</b></td>
					</tr>';
				foreach ($peserta as $p) {
				echo '<tr>
				<td align="left">'.strtoupper($p->prodi_nama).'</td>
				<td align="center">'.substr($p->peserta_jenis_kelamin, 0, 1).'</td>
				<td align="right">'.$p->mhs_no_wisuda.'</td>
				<td align="center">&nbsp;'.$p->mhs_nim.'</td>
				<td align="left">'.ucwords(strtolower($p->mhs_nama)).'</td>
				<td align="center">'.number_format($p->peserta_ipk, 2).'</td>
				<td align="right">'.ucwords(strtolower($p->peserta_lama_studi)).'</td>
				<td align="left">'.$p->peserta_predikat.'</td>
					</tr>';
				}
		echo '</table>
			</td></tr>';
		}
	?>
</table>
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