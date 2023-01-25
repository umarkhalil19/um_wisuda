<?php 
	require_once APPPATH.'libraries/tcpdf-master/tcpdf.php';

	$db = $this->M_vic->panggil_db();
	$sesi_wisuda=mysqli_query($db, "SELECT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$sesi'");
	$s11=mysqli_fetch_array($sesi_wisuda);


	class MYPDF extends TCPDF {

		//Page header
		public function Header() {
			// Logo
			// $image_file = base_url().'vic_image/system/logo_unimal_2.png';
			// //$this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			// $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			// Set font
			$this->SetFont('helvetica', 'B', 16);
			// Title
			// //$this->Cell(0, 15, 'Buku Alumni Wisuda Angkatan XVI Tahun 2015', 0, false, 'L', 0, '', 0, false, 'M', 'M');
			// //$this->Cell(5, 20, 'Fakultas Ekonomi Program Pascasarjana Ilmu Manajemen Universitas Malikussaleh ', 0, false, 'L', 0, '', 0, false, 'M', 'M');
			// //$this->Ln(5);
			// $this->Cell(45, 0, 'Buku Alumni Wisuda Angkatan XVI Tahun 2015', 0, 0, 'C', 0, '', 1);
			//$this->Cell(45, 0, 'TEST CELL STRETCH: scaling', 1, 1, 'C', 0, '', 1);
			//$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			//$this->MultiCell(0, 5, '[DEFAULT] '.$txt, 1, 'R', 0, 1, '', '', true);
			$html = '
			<table border="0">
				<tr>
					<td style="width:80%;">
						<b>Buku Alumni Wisuda Angkatan XXII Tahun 2019</b><br>
						<b>Fakultas Teknik Program Studi Teknik Informatika Universitas Malikussaleh </b>
					</td>
					<td style="width:20%;text-align:right;">
						<img src="'.base_url().'vic_image/system/logo_unimal_2.png" style="width:50px;height:60px;">
					</td>
				</tr>
			</table>
			';
			$this->SetFont('helvetica', 'B', 14);
			$this->writeHTML($html, true, true, true, true, '');

			// $image_file = '<img src="'.base_url().'vic_image/system/logo_unimal_2.png" width="50" height="70">';
			// $this->SetY(10);
			// $isi_header='<table align="right">
			// 			<tr><td>'.$image_file.'</td></tr>
			// 			</table>';
			// $this->writeHTML($isi_header, true, false, false, false, '');
		}
	
		// Page footer
		public function Footer() {
			$this->SetY(-15);
			$this->SetFont('helvetica', 'I', 8);
			$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
	}

	//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetMargins(10, 10, PDF_MARGIN_RIGHT);
	$pdf->SetAuthor('Muhammad Fikry');
	$pdf->SetTitle("Pendaftaran Wisuda Mahasiswa Universitas Malikussaleh");
	$pdf->SetSubject('http://fikry.unimal.ac.id');
	$pdf->SetKeywords('UNIMAL, PDF, Fikry');

	// $pdf->setPrintHeader(false);
	// $pdf->setPrintFooter(false);

	// $image_file = base_url().'vic_image/system/logo_unimal_2.png';
	// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Buku Alumni Wisuda Angkatan XVI Tahun 2015', PDF_HEADER_STRING);

	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	$pdf->AddPage('P', 'LEGAL');
	$pdf->SetFont('Times', '', 12);
	
	$html = '
	<center><br><br><br>
	<table border="1" align="center" style="background-color:lightgreen;">
		<tr>
			<td>
				<b>WISUDA UNIVERSITAS MALIKUSSALEH</b><br>
				<b>ANGKATAN '.$s11['jadwal_nama'].' TAHUN '.$s11['jadwal_tahun'].'</b><br>
				<img src="'.base_url().'vic_image/system/logo_unimal_2.png" width="100px" height="120px"><br>
			</td>
		</tr>
	</table>
	</center>
	<br>
	';
	$pdf->writeHTML($html, false, false, true, false, '');
	$alumni_1=mysqli_query($db, "SELECT * FROM tbl_alumni a, tbl_peserta p, tbl_jadwalwisuda j WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = j.jadwal_id AND a.mhs_sesi_wisuda = '$sesi' ");
	while($a1 = mysqli_fetch_array($alumni_1)){
		$nim = $a1['mhs_nim'];
		$idfak = $a1['mhs_fakultas'];
		$idprodi = $a1['mhs_prodi'];
		$fak=mysqli_query($db, "SELECT fakultas_nama FROM tbl_fakultas WHERE fakultas_id = '$idfak'");
		$f1=mysqli_fetch_array($fak);
		$prod=mysqli_query($db, "SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$idprodi'");
		$p1=mysqli_fetch_array($prod);
		$foto=mysqli_query($db, "SELECT peserta_lampiran FROM tbl_peserta_lampiran WHERE peserta_kode = '$nim' AND peserta_lamp_kode = '04'");
		$pp1=mysqli_fetch_array($foto);
		$html = '<br><center>
			<table border="1" align="center" width="100%" style="background-color:lightgreen;">
			<tr>
				<td rowspan="12" width="15%">&nbsp;<br><img src="'.base_url().'dokumen/lampiran/'.$pp1[0].'" style="width:75px;height:100px;"></td>
				<td align="left" width="25%">&nbsp;No</td>
				<td align="center" width="2%">:</td>
				<td align="left" width="58%">&nbsp;'.$a1['mhs_no_wisuda'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Nama</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['mhs_nama'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;NIM</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['mhs_nim'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Tempat / Tanggal Lahir</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['mhs_tempat_lahir'].' / '.date("d-m-Y", strtotime($a1['mhs_tanggal_lahir'])).'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;No. Telp / HP</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['mhs_telepon'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Alamat</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['mhs_alamat'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Tanggal Lulus</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.date("d-m-Y", strtotime($a1['peserta_tanggal_sidang'])).'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Indeks Prestasi</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['peserta_ipk'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Predikat</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['peserta_predikat'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Asal Sekolah</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['peserta_sekolah_asal'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Nama Orang Tua / Wali</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['mhs_ayah'].'</td>
			</tr>
			<tr>
				<td align="left">&nbsp;Judul Tugas Akhir</td>
				<td align="center">:</td>
				<td align="left">&nbsp;'.$a1['peserta_judul_skripsi'].'</td>
			</tr>
			';
		$html .= '</table> </center>';
		$pdf->writeHTML($html, false, false, true, false, '');
	}
	$html = '
	<br><br>
	<table border="0px">
		<tr>
			<td width="65%"></td>
			<td align="center">
				<br><b>Aceh Utara, </b>'.date("d-m-Y").'<br>
				<br><br><br><br>
				(Panitia Wisuda)
			</td>
		</tr>
	</table>';
	$pdf->writeHTML($html, false, false, true, false, '');
	$pdf->lastPage();
	$pdf->Output('Laporan '.$sesi);
 ?>