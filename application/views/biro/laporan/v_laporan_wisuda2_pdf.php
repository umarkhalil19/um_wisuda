<?php 
	require_once APPPATH.'libraries/tcpdf-master/tcpdf.php';

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetMargins(10, 10, PDF_MARGIN_RIGHT);
	$pdf->SetAuthor('Muhammad Fikry');
	$pdf->SetTitle("Rekap Calon Mahasiswa Universitas Malikussaleh");
	$pdf->SetSubject('http://fikry.unimal.ac.id');
	$pdf->SetKeywords('UNIMAL, PDF, Fikry');

	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	$pdf->AddPage('P', 'A4');
	$pdf->SetFont('Times', '', 12);

	$db = $this->M_vic->panggil_db();
	$sesi_wisuda=mysqli_query($db, "SELECT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$sesi'");
	$s11=mysqli_fetch_array($sesi_wisuda);

	$html = '
	<table width="100%" border="0">
		<tr>
			<td valign="top" width="20%"><img src="'.base_url().'vic_image/system/logo_unimal_2.png" width="75" height="75"></td>
			<td width="80%">
				<p>
				<b>KEMENTRIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</b> <br>
				<b>UNIVERSITAS MALIKUSSALEH</b> <br>
				Cot Teungku Nie - Reulet Kecamatan Muara Batu - Aceh Utara <br>
				Telepon 0645-41373-40915 Faks. 0645-44450 <br>
				Laman : Https://www.unimal.ac.id </p>
			</td>
		</tr>
		<hr>
	</table>';
	$pdf->writeHTML($html, false, false, true, false, '');
	$html = '
	<center></center><br><br><br>
	<table align="left">
		<tr>
			<td>
				<b>ANGKATAN '.$s11['jadwal_nama'].' TAHUN '.$s11['jadwal_tahun'].'</b><br>
			</td>
		</tr>
	</table>
	<br>
	';
	$pdf->writeHTML($html, false, false, true, false, '');
	$html = '<br>
		<table border="1" align="center">
		<tr>
			<th width="10%" bgcolor="#c0c0c0">NO</th>
			<th width="30%" bgcolor="#c0c0c0">FAKULTAS</th>
			<th width="30%" bgcolor="#c0c0c0">WISUDAWAN</th>
			<th width="15%" bgcolor="#c0c0c0">WISUDAWATI</th>
			<th width="15%" bgcolor="#c0c0c0">TOTAL</th>
		</tr>';
		$no = 1;
		$tot1 = 0; $tot2 = 0; $tot3 = 0;
		foreach ($fakultas as $f) {
			$idfak = $f->fakultas_id;
			$peserta_1 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Laki-Laki' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
			$p1 = mysqli_num_rows($peserta_1);
			$peserta_2 = mysqli_query($db, "SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND a.mhs_fakultas = '$idfak' AND a.mhs_jenis_kelamin = 'Perempuan' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC");
			$p2 = mysqli_num_rows($peserta_2);
			$p3 = $p1 + $p2;
			$tot1 = $tot1+$p1;
			$tot2 = $tot2+$p2;
			$tot3 = $tot3 + $p3;
		$html .= '
			<tr>
				<td style="text-align: center;">'.$no++.'</td>
				<td style="text-align: left;"> <b>'.$f->fakultas_nama.'</b></td>
				<td style="text-align: center;"> '.$p1.' Orang</td>
				<td style="text-align: center;">'.$p2.' Orang</td>
				<td style="text-align: center;">'.$p3.'</td>
			</tr>
		';
	}
	$html .= '
        <tr>
					<td style="text-align: left;" colspan="2"> <b> TOTAL </b></td>
					<td style="text-align: center;"><b>'.$tot1.' Orang</b></td>
					<td style="text-align: center;"><b>'.$tot2.' Orang</b></td>
					<td style="text-align: center;"><b>'.$tot3.' Orang</b></td>
        </tr>
      </table>
	';
	$pdf->writeHTML($html, false, false, true, false, '');
	$html = '
	<br><br>
	<table border="0px">
		<tr>
			<td width="65%"></td>
			<td align="center">
				<br><b>Aceh Utara, </b>'.TanggalIndo(date('Y-m-d')).'<br>
				<br><br><br><br>
				('.$this->session->userdata('unama').')
			</td>
		</tr>
	</table>';
	$pdf->writeHTML($html, false, false, true, false, '');
	$pdf->lastPage();
	$pdf->Output('Laporan Rekap');
 ?>