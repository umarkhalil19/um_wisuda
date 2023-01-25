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
<?php 
  $jadwal_id = '';
  $jadwal_nama = '';
  $jadwal_tahun = '';
  foreach ($sesi_wisuda as $s1) {
    $jadwal_id = $s1->jadwal_id;
    $jadwal_nama = $s1->jadwal_nama;
    $jadwal_tahun = $s1->jadwal_tahun;
  }

  echo '
  <table align="center">
    <thead><tr>
      <td><b>DAFTAR LULUSAN DENGAN PUJIAN (CUM LAUDE)</b><br></td>
    </tr></thead>
  </table>
  <br>
  ';

  echo '
    <table border="1" align="center" cellpadding="1">
    <thead>
    <tr>
      <th width="5%"><b>NO</b></th>
      <th width="19%"><b>NAMA</b></th>
      <th width="19%"><b>NAMA AYAH</b></th>
      <th width="12%"><b>NIM</b></th>
      <th width="5%"><b>JK</b></th>
      <th width="15%"><b>PRODI</b></th>
      <th width="20%"><b>LAMA STUDI</b></th>
      <th width="5%"><b>IPK</b></th>
    </tr>
    </thead>
    <tbody>';
  $no1 = 1;
  $no2 = 20;
  foreach ($pujian as $p1) {
    if ($no1 % $no2 == 1) {
      echo '<br pagebreak="true" />';
    }
    echo '<tr>
        <td height="41px" width="5%">'.$no1++.'</td>
        <td height="41px" align="left" width="19%">'.ucwords(strtolower($p1->mhs_nama)).'</td>
        <td height="41px" align="left" width="19%">'.ucwords(strtolower($p1->peserta_ayah)).'</td>
        <td height="41px" width="12%">'.$p1->mhs_nim.'</td>
        <td height="41px" width="5%">'.substr(strtoupper($p1->peserta_jenis_kelamin), 0, 1).'</td>
        <td height="41px" width="15%">'.ucwords(strtolower($p1->prodi_nama)).'</td>
        <td height="41px" width="20%">'.ucwords(strtolower($p1->peserta_lama_studi)).'</td>
        <td height="41px" width="5%">'.$p1->peserta_ipk.'</td>
      </tr>
      ';
  }
  echo '</tbody></table>';
  echo '<br pagebreak="true" />';

  $no3 = 1;
  foreach ($fakultas as $f1) {
    /*echo '<table border="0" align="center">
          <tr><td width="100%" style="font-size:24px;"><b>WISUDA UNIVERSITAS MALIKUSSALEH</b></td></tr>
          <tr><td width="100%" style="font-size:24px;"><b>ANGKATAN '.$jadwal_nama.' TAHUN '.$jadwal_tahun.'</b><br><br><br><br></td></tr>
          <tr><td width="100%"><img src="'.base_url().'vic_image/system/logo_tengah_1.png"><br><br><br><br><br><br><br><br><br><br><br><br><br></td></tr>
          <tr><td width="100%" style="font-size:24px;"><b>'.strtoupper($f1->fakultas_nama).'</b></td></tr>
        </table>';*/
    echo '<center>
        <p align="center" style="font-size:24px;"><b>WISUDA UNIVERSITAS MALIKUSSALEH</b></p>
        <p align="center" style="font-size:24px;"><b>ANGKATAN '.$jadwal_nama.' TAHUN '.$jadwal_tahun.'</b><br><br><br><br></td></trp>
        <img align="center" src="'.base_url().'vic_image/system/logo_tengah_1.png"><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p align="center" style="font-size:24px;"><b>'.strtoupper($f1->fakultas_nama).'</b></p>
      </center>';
    echo '<br pagebreak="true" />';

    $no4 = 1;
    $no5 = 2;
    $bin_binti = '';
    //$peserta = $this->db->query("SELECT * FROM v_alumni_predikat WHERE mhs_sesi_wisuda = '$sesi' AND prodi_fakultas = '$f1->fakultas_id' ORDER BY mhs_nim ASC ")->result();
    //$peserta = $this->db->query("SELECT * FROM tbl_alumni, tbl_peserta WHERE mhs_nim = peserta_kode AND mhs_sesi_wisuda = '$sesi' AND mhs_fakultas = '$f1->fakultas_id' GROUP BY mhs_nim ORDER BY mhs_nim ASC")->result();
    $peserta = $this->db->query("SELECT * FROM v_alumni_wisuda WHERE mhs_sesi_wisuda = '$sesi' AND mhs_fakultas = '$f1->fakultas_id' GROUP BY mhs_nim ORDER BY mhs_nim ASC")->result();
    //echo '<table border="0" align="center" style="border: 1px solid black;">';
    foreach ($peserta as $p2) {
      if($p2->peserta_jenis_kelamin == 'Laki-Laki'){
        $bin_binti = 'Bin '.ucwords(strtolower($p2->peserta_bin));
      }elseif($p2->peserta_jenis_kelamin == 'Perempuan'){
        $bin_binti = 'Binti '.ucwords(strtolower($p2->peserta_bin));
      }else{
        $bin_binti = '';
      }

      // $photo = $this->db->query("SELECT b.peserta_lampiran FROM tbl_peserta a, tbl_peserta_lampiran b WHERE a.peserta_kode = b.peserta_kode AND a.peserta_kode = '$p2->mhs_nim' AND b.peserta_lamp_kode = '04' ORDER BY b.peserta_id DESC LIMIT 1")->result();
      // $gambar1 = '';
      // $gambar2 = '';
      // foreach ($photo as $p3) {
      //   $gambar1 = base_url().'dokumen/lampiran/'.$p3->peserta_lampiran;
      // }
      // if($gambar1 == ''){
      //   $gambar2 = $gambar2 = base_url().'vic_image/default/pengguna.png';
      // }else{
      //   $gambar2 = $gambar1;
      // }
      $gambar1 = '';
      $gambar2 = '';
      if($p2->peserta_lampiran == ''){
        $gambar2 = $gambar2 = base_url().'vic_image/default/pengguna.png';
      }else{
        $gambar2 = base_url().'dokumen/lampiran/'.$p2->peserta_lampiran;
      }

      // $prodi = $this->db->query("SELECT prodi_nama FROM tbl_prodi WHERE prodi_kode = '$p2->peserta_prodi' ORDER BY prodi_id DESC LIMIT 1")->result();
      // $prodi_nama = '';
      // foreach ($prodi as $p4) {
      //   $prodi_nama = $p4->prodi_nama;
      // }

      /*echo '<table border="0" align="center" style="border: 1px solid black;">
            <tr><td> Buku Alumni Wisuda Angkatan '.$jadwal_nama.' Tahun '.$jadwal_tahun.' </td></tr>
            <tr><td> Fakultas '.ucwords(strtolower($f1->fakultas_nama)).' Program Studi '.ucwords(strtolower($p2->prodi_nama)).' Universitas Malikussaleh</td></tr>
            <tr><td><img src="'.base_url().'vic_image/default/pengguna.png" width="200px" height="300px"></td></tr>
            <tr><td>'.$p2->mhs_nim.' '.ucwords(strtolower($p2->mhs_nama)).'</td></tr>
          </table>';*/
      echo '<table border="0" align="center" style="border: 2px solid lightgreen; border-spacing: 5px;">
      <tr>
        <td width="20%" valign="middle">
          <br>
          <img src="'.$gambar2.'" width="200" height="300">
        </td>
        <td width="80%">
          <table border="1" align="center" style="border: 1px solid black; border-spacing: 1px;">
            <tr>
              <td align="left" width="35%">No Urut</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.$no4.'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Nama</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.ucwords(strtolower($p2->mhs_nama)).' '.$bin_binti.'</td>
            </tr>
            <tr>
              <td align="left" width="35%">NIM</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.$p2->mhs_nim.'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Fakultas</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.ucwords(strtolower($f1->fakultas_nama)).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Program Studi</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.ucwords(strtolower($p2->prodi_nama)).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Institusi</td>
              <td width="5%">:</td>
              <td align="left" width="60%">Universitas Malikussaleh</td>
            </tr>
            <tr>
              <td align="left" width="35%">Tempat / Tanggal Lahir</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.ucwords(strtolower($p2->mhs_tempat_lahir)).' / '.TanggalIndo($p2->mhs_tanggal_lahir).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">No. Telp / HP</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.str_replace("+62", "0", $p2->mhs_telepon).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Alamat</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.$p2->mhs_alamat.'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Tanggal Lulus</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.TanggalIndo($p2->peserta_tanggal_keluar).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Indeks Prestasi</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.ROUND($p2->peserta_ipk, 2).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Predikat</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.$p2->peserta_predikat.'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Asal Sekolah</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.strtoupper($p2->peserta_sekolah_asal).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Nama Orang Tua / Wali</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.ucwords(strtolower($p2->peserta_ayah)).'</td>
            </tr>
            <tr>
              <td align="left" width="35%">Judul Tugas Akhir</td>
              <td width="5%">:</td>
              <td align="left" width="60%">'.ucwords(strtolower($p2->peserta_judul_skripsi)).'</td>
            </tr>
          </table>
        </td>
      </tr>
      </table>
      ';
      if ($no4 % $no5 == 0) {
        echo '<br pagebreak="true" />';
      }
      $no4++;
    }
    echo '<br pagebreak="true" />';
  }
?>

</body>
</html>