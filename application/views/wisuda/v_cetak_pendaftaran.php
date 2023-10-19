<?php
require_once APPPATH . 'libraries/tcpdf-master/tcpdf.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetMargins(10, 10, PDF_MARGIN_RIGHT);
$pdf->SetAuthor('Muhammad Fikry');
$pdf->SetTitle("Pendaftaran Wisuda Mahasiswa Universitas Malikussaleh");
$pdf->SetSubject('http://fikry.unimal.ac.id');
$pdf->SetKeywords('UNIMAL, PDF, Fikry');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A4');
$pdf->SetFont('Times', '', 12);

$db = $this->M_vic->panggil_db();
//$alumni_1=mysqli_query($db, "SELECT * FROM tbl_alumni WHERE mhs_nim = '$nim' ");
$alumni_1 = mysqli_query($db, "SELECT * FROM tbl_alumni a, tbl_peserta p, tbl_jadwalwisuda j WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = j.jadwal_id AND a.mhs_nim = '$nim' ");
$a1 = mysqli_fetch_array($alumni_1);
$idfak = $a1['mhs_fakultas'];
$idprodi = $a1['mhs_prodi'];
$fak = mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$idfak'");
$f1 = mysqli_fetch_array($fak);
$prod = mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$idprodi'");
$p1 = mysqli_fetch_array($prod);
$foto = mysqli_query($db, "SELECT peserta_lampiran FROM tbl_peserta_lampiran WHERE peserta_kode = '$nim' AND peserta_lamp_kode = '04'");
$pp1 = mysqli_fetch_array($foto);

$html = '
	<center><br><br><br>
	<table border="1" align="center" style="background-color:white;">
		<tr>
			<td>
				<b>WISUDA UNIVERSITAS MALIKUSSALEH</b><br>
				<b>ANGKATAN ' . $a1['jadwal_nama'] . ' TAHUN ' . $a1['jadwal_tahun'] . '</b><br>
				<img src="' . base_url() . 'vic_image/system/logo_unimal_2.png" width="100px" height="120px"><br>
			</td>
		</tr>
	</table>
	</center>
	<br>
	';
$pdf->writeHTML($html, false, false, true, false, '');
$html = '<br><center>
		<table border="1" align="center" width="100%" style="background-color:white;">
		<tr>
			<td rowspan="13" width="15%">&nbsp;<br></td>
			<td align="left" width="25%">&nbsp;No</td>
			<td align="center" width="2%">:</td>
			<td align="left" width="58%">&nbsp;' . $a1['mhs_no_wisuda'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Nama</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['mhs_nama'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;NIM</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['mhs_nim'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Program Studi</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $p1[0] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Tempat / Tanggal Lahir</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['mhs_tempat_lahir'] . ' / ' . date("d-m-Y", strtotime($a1['mhs_tanggal_lahir'])) . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;No. Telp / HP</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['mhs_telepon'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Alamat</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['mhs_alamat'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Tanggal Lulus</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . date("d-m-Y", strtotime($a1['peserta_tanggal_sidang'])) . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Indeks Prestasi</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . number_format($a1['peserta_ipk'], 2) . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Predikat</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['peserta_predikat'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Asal Sekolah</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['peserta_sekolah_asal'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Nama Orang Tua / Wali</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['mhs_ayah'] . '</td>
		</tr>
		<tr>
			<td align="left">&nbsp;Judul Tugas Akhir</td>
			<td align="center">:</td>
			<td align="left">&nbsp;' . $a1['peserta_judul_skripsi'] . '</td>
		</tr>
		';
$html .= '</table> </center>';
$pdf->writeHTML($html, false, false, true, false, '');
$html = '
	<br><br>
	<table border="0px">
		<tr>
			<td width="65%"></td>
			<td align="center">
				<br><b>Aceh Utara, </b>' . date("d-m-Y") . '<br>
				<br><br><br><br>
				(' . $this->session->userdata('unama') . ')
			</td>
		</tr>
	</table>';
$pdf->writeHTML($html, false, false, true, false, '');
$pdf->lastPage();
$pdf->Output('Wisuda ' . $nim);
