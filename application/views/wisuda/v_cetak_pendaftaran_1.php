<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
  <title>UNIMAL</title>
  <link rel="shortcut icon" href="<?php echo base_url().'vic_image/system/logo_unimal_2.png'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vic_assets/css/font-awesome.css" media="all">
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
    }
    table {
      border-spacing: 0;
      border-collapse: collapse;
      width: 100%;
    }
    div.page_break{
      page-break-before: always;
    }
    @page { margin: 100px 25px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
  </style>
</head>
<body>

<?php

  $db = $this->M_vic->panggil_db();
	$alumni_1=mysqli_query($db, "SELECT * FROM tbl_alumni a, tbl_peserta p, tbl_jadwalwisuda j WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = j.jadwal_id AND a.mhs_nim = '$nim' ");
	$a1 = mysqli_fetch_array($alumni_1);
	$idfak = $a1['mhs_fakultas'];
	$idprodi = $a1['mhs_prodi'];
	$fak=mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$idfak'");
	$f1=mysqli_fetch_array($fak);
	$prod=mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$idprodi'");
	$p1=mysqli_fetch_array($prod);
	$foto=mysqli_query($db, "SELECT mhs_lampiran FROM tbl_mahasiswa_lampiran WHERE mhs_kode = '$nim' AND mhs_lamp_kode = '07'");
	$pp1=mysqli_fetch_array($foto);
	//$urlfoto = 'http://localhost/unimal/ijazah1.1/';
	$urlfoto = 'http://localhost/unimal/ijazah1.1/';
	//$urlfoto2 = 'http://ijazah.unimal.ac.id/vic_image/system/logo_unimal_2.png';
	//$urlfoto2 = "{{ url('http://ijazah.unimal.ac.id/vic_image/system/logo_unimal_2.png') }}";
	$urlfoto2 = "";
	//$urlfoto2 = './vic_image/system/logo_unimal_2.png';

  echo '

  <center><br><br><br>
	<table align="center" style="background-color:white;width: 50%; text-align: center;">
		<tr>
			<td>
				<b>WISUDA UNIVERSITAS MALIKUSSALEH</b><br>
				<b>ANGKATAN '.$a1['jadwal_nama'].' TAHUN '.$a1['jadwal_tahun'].'</b><br>
				<img src="./vic_image/system/logo_unimal_2.png" width="100px" height="120px"><br>
			</td>
		</tr>
	</table>
	</center>
	<br>
  ';

  echo '
    <br><center>
		<table border="1" align="center" width="100%" style="background-color:white;">
		<tr>
			<td rowspan="13" width="15%">&nbsp;<br>&nbsp;<img src="'.$urlfoto2.'" style="width:75px;height:100px;"></td>
			<td align="left" width="25%">&nbsp;No</td>
			<td align="center" width="2%">:</td>
			<td align="left" width="58%">&nbsp;'.$a1['mhs_no_wisuda'].'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Nama</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($a1['mhs_nama']).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;NIM</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.$a1['mhs_nim'].'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Program Studi</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($p1[0]).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Tempat / Tanggal Lahir</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($a1['mhs_tempat_lahir']).' / '.date("d-m-Y", strtotime($a1['mhs_tanggal_lahir'])).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;No. Telp / HP</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.$a1['mhs_telepon'].'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Alamat</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($a1['mhs_alamat']).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Tanggal Lulus</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.date("d-m-Y", strtotime($a1['peserta_tanggal_sidang'])).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Indeks Prestasi</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.number_format($a1['peserta_ipk'], 2).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Predikat</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($a1['peserta_predikat']).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Asal Sekolah</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($a1['peserta_sekolah_asal']).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Nama Orang Tua / Wali</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($a1['mhs_ayah']).'</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Judul Tugas Akhir</td>
			<td align="center">:</td>
			<td align="left">&nbsp;'.strtoupper($a1['peserta_judul_skripsi']).'</td>
		</tr>
	</table>
      ';

    
    echo '<br><br>
	<table style="background-color:white;text-align: center;">
		<tr>
			<td width="65%"></td>
			<td align="center">
				<br><b>ACEH UTARA, </b>'.date("d-m-Y").'<br>
				<br><br><br><br>
				('.strtoupper($this->session->userdata('unama')).')
			</td>
		</tr>
	</table>';
  

?>

</body>
</html>