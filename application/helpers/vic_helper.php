<?php

function show_alert()
{
	if (isset($_GET['alert'])) {
		$alert = $_GET['alert'];
		if ($alert == "add") {
			echo "<div class='alert alert-success alert-dah'>Data Berhasil Di Tambah. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "delete") {
			echo "<div class='alert alert-danger alert-dah'>Data Berhasil Di Hapus. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "update") {
			echo "<div class='alert alert-success alert-dah'>Data Berhasil Di Update. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "login-failed") {
			echo "<div class='alert alert-danger alert-dah'>Login Gagal !</div>";
		} else if ($alert == "setting-update") {
			echo "<div class='alert alert-success alert-dah'>Pengaturan Berhasil Di Ubah.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "page-saved") {
			echo "<div class='alert alert-success alert-dah'>Halaman Berhasil Di Simpan.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "page-delete") {
			echo "<div class='alert alert-danger alert-dah'>Halaman Berhasil Di Hapus.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "post-saved") {
			echo "<div class='alert alert-success alert-dah'>Post Berhasil Di Simpan.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "post-delete") {
			echo "<div class='alert alert-danger alert-dah'>Post Berhasil Di Hapus Permanen.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "post-trash") {
			echo "<div class='alert alert-success alert-dah'>Post Berhasil Di Pindahkan Ke Tong Sampah.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "menu-saved") {
			echo "<div class='alert alert-success alert-dah'>Menu Berhasil Di Simpan.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "menu-delete") {
			echo "<div class='alert alert-danger alert-dah'>Menu Berhasil Di Hapus.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "widget-delete") {
			echo "<div class='alert alert-danger alert-dah'>Widget Berhasil Di Hapus.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "user-add") {
			echo "<div class='alert alert-success alert-dah'>User Berhasil Di Tambah.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "user-update") {
			echo "<div class='alert alert-success alert-dah'>Data User Berhasil Di Update.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "user-duplikat") {
			echo "<div class='alert alert-danger alert-dah'>Anda Telah Registrasi.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "user-daftar") {
			echo "<div class='alert alert-success alert-dah'>Pendaftaran Sukses. Silakan login dengan:<br> Username = NIM <br> Password = tahun-bulan-tanggal Lahir<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "user-kirim") {
			echo "<div class='alert alert-success alert-dah'>Data Berhasil Di Kirim.<br> Pengajuan Anda Akan Segera Ditindaklanjuti. <br> Terima Kasih <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "upload-gagal") {
			echo "<div class='alert alert-danger alert-dah'>Upload Data Gagal. Pastikan file yang anda upload sudah sesuai dengan ketentuan<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "upload-sukses") {
			echo "<div class='alert alert-success alert-dah'>Upload Data Berhasil. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "reset-pass") {
			echo "<div class='alert alert-success alert-dah'>Reset Password Berhasil. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "ganti-pass") {
			echo "<div class='alert alert-success alert-dah'>Password Berhasil Diubah. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "gagal-pass") {
			echo "<div class='alert alert-danger alert-dah'>Password Gagal Diubah. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "aktif-add") {
			echo "<div class='alert alert-success alert-dah'>Akun Berhasi DiAktifkan. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "aktif-add2") {
			echo "<div class='alert alert-success alert-dah'>Akun Berhasi DiNonaktifkan. <span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "user-pesan") {
			echo "<div class='alert alert-success alert-dah'>Pesan Telah Dikirim.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "user-verifikasi") {
			echo "<div class='alert alert-success alert-dah'>Verifikasi Berhasil.<span class='glyphicon glyphicon-remove pull-right btn-hide-alert'></span></div>";
		} else if ($alert == "no_sk_yudisium") {
			echo "<div class='alert alert-danger' role='alert'>Tidak dapat mendaftar, anda belum memiliki SK Yudisium</div>";
		} else if ($alert == "batal-peserta-wisuda") {
			echo "<div class='alert alert-success' role='alert'>Pendaftaran berhasil di batalkan</div>";
		}
	}
}

function create_slug($string)
{
	// $a = trim($string);
	// $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $a);
	return strtolower(url_title($string));
}

function display_sub($parent, $mother)
{
	$query = mysql_query("SELECT * FROM vic_menu WHERE menu_parent='$parent' and menu_mother='$mother'");
	echo "<ul parent='" . $parent . "' id='" . $mother . "'>";
	// echo "<li class='list-menu-kosong'></li>";
	while ($row = mysql_fetch_assoc($query)) {
		if (count($query) > 0) {
			echo "<li id='menu_" . $row['menu_id'] . "' ini='" . $row['menu_id'] . "'><div>" . $row['menu_name'] . "<small>  " . $row['menu_url'] . "  </small> <a class='pull-right' href=" . base_url() . 'admin/menu_item_delete/' . $row['menu_id'] . "> Delete </a><a class='pull-right' href=" . base_url() . 'admin/menu_item_edit/' . $row['menu_id'] . "> Edit </a></div>";
			display_sub($row['menu_id'], $row['menu_mother']);
			echo "</li>";
		} else {
			echo "<li id='menu_" . $row['menu_id'] . "' ini='" . $row['menu_id'] . "'>" . $row['menu_name'] . "<small>  " . $row['menu_url'] . "  </small> <a class='pull-right' href=" . base_url() . 'admin/menu_item_delete/' . $row['menu_id'] . "> Delete</a> <a class='pull-right' href=" . base_url() . 'admin/menu_item_edit/' . $row['menu_id'] . "> Edit </a></li>";
		}
	}
	echo "</ul>";
}

function display_sub_navigation($parent, $mother)
{
	$query = mysql_query("SELECT * FROM vic_menu WHERE menu_parent='$parent' and menu_mother='$mother'");
	$cek = mysql_num_rows($query);
	if ($cek > 0) {
		echo "<ul>";
		while ($row = mysql_fetch_assoc($query)) {

			if ($row['menu_tab'] == "1") {
				$tab = "target='_blank'";
			} else {
				$tab = "";
			}


			if (count($query) > 0) {
				echo '<li><a ' . $tab . ' href=' . $row['menu_url'] . '>' . $row['menu_name'] . '</a>';
				display_sub_navigation($row['menu_id'], $row['menu_mother']);
				echo "</li>";
			} else if (count($query) == 0) {
				echo '<li><a ' . $tab . ' href=' . $row['menu_url'] . '>' . $row['menu_name'] . '</a></li>';
			}
		}
		echo "</ul>";
	}
}


function menu_navigation($menu_name)
{
	echo '<div class="menu-responsif"><span class="glyphicon glyphicon-list"></span> MENU</div>';
	echo '<div class=' . $menu_name . '>';
	echo '<ul classs=main-' . $menu_name . '>';

	$CI = &get_instance();
	$data = $CI->M_vic->get_menu_item($menu_name);
	$item = $data->result();
	$jumlah = $data->num_rows();
	foreach ($item as $i) {
		$query = mysql_query("SELECT * FROM vic_menu WHERE menu_parent='$i->menu_id' and menu_mother='$i->menu_mother'");
		$q = mysql_num_rows($query);
		if ($i->menu_tab == "1") {
			$tab = "target='_blank'";
		} else {
			$tab = "";
		}
		if ($q > 0) {
			echo '<li><a ' . $tab . ' href=' . $i->menu_url . '>' . $i->menu_name . ' <span class="caret"></span> </a>';
			display_sub_navigation($i->menu_id, $i->menu_mother);
			echo "</li>";
		} else if ($q == 0) {
			echo '<li><a ' . $tab . ' href=' . $i->menu_url . '>' . $i->menu_name . '</a></li>';
		}
	}

	echo '</ul>';
	echo '</div>';
}

// DAHCODE WIDGET

function post_content($text, $numb)
{
	if (strlen($text) > $numb) {
		$text = str_replace("  ", "", $text);
		$text = substr($text, 0, $numb);
		$text = substr($text, 0, strrpos($text, " "));
		$etc = " ...";
		$text = $text . $etc;
	}
	return $text;
}


function get_option($option_name)
{
	$CI = $CI = &get_instance();
	return $CI->M_vic->get_option($option_name);
}

// function save_visitor_data(){
// 	$CI=&get_instance();
// 	if ($CI->agent->is_mobile()){
// 		$device = $CI->agent->mobile();
// 	}else{
// 		$device = 'Unidentified';
// 	}

// 	// referrer
// 	if ($CI->agent->is_referral()){
// 		$referrer = $CI->agent->referrer();
// 	}else{
// 		$referrer = "";
// 	}

// 	$data = array(
// 		'time_visit' => date('Y-m-d H:i:s'),
// 		'user_ip' => $_SERVER['REMOTE_ADDR'],
// 		'user_browser' => $CI->agent->browser(),
// 		'user_os' => $CI->agent->platform(),
// 		'user_device' => $device,
// 		'page' => base_url(),
// 		'user_referrer' => $referrer
// 		);

// 	$CI->M_vic->insert_data($data,'vic_visitor');

// }


function TanggalIndo($date)
{
	$HariIndo = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);

	$result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
	//$result = $HariIndo[(int)$tgl-1] . ", ". $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;  //pakai hari
	return ($result);
}

function hariIndo($date)
{
	$tanggal = $date;
	$day = date('D', strtotime($tanggal));
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
	//echo "Tanggal {$tanggal} adalah hari : " . $dayList[$day];
	$result = $dayList[$day];
	return ($result);
}

function nomorWisuda($jadwal, $prodi)
{
	$ci = &get_instance();
	$ci->load->database();
	// $nimMhs = $nim;
	$jadwalWisuda = $jadwal;
	$tahun = substr($jadwal, 0, 4);
	$prodiMhs = $prodi;
	$noUrut = '0001';
	$query = "SELECT SUBSTR(mhs_no_wisuda, 1, 4) as noUrut FROM tbl_alumni WHERE mhs_prodi = '" . $prodiMhs . "' AND mhs_sesi_wisuda = '" . $jadwalWisuda . "' ORDER BY SUBSTR(mhs_no_wisuda, 1, 4) DESC LIMIT 1";
	$cek = $ci->db->query($query)->row();
	if (empty($cek->noUrut)) {
		$noUrut = $noUrut . '/' . $tahun;
	} else {
		$noUrut = ((int)$cek->noUrut) + 1;
		$noUrut = str_pad($noUrut, 4, '0', STR_PAD_LEFT);
		$noUrut = $noUrut . '/' . $tahun;
	}
	return $noUrut;
}
