<?php
class Biro extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'Vic_helper'));
		$this->load->helper("Vic_convert");
		//$autoload['model'] = array('M_vic');
		$this->load->model('M_vic');
		$this->load->model('M_vic2');
		$this->load->model('M_data');
		// $this->load->model("phpexcel_model");
		// $this->load->library("PHPExcel");
		$this->load->library(array('session', 'form_validation', 'user_agent'));
		date_default_timezone_set('Asia/Jakarta');
		if ($this->session->userdata('peg_status') != "biro") {
			redirect('login');
		}
	}

	function index()
	{
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_home');
		$this->load->view('biro/v_footer');
	}

	//wisuda
	function jadwalwisuda()
	{
		$data['jadwal'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda ORDER BY jadwal_id DESC")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_jadwalwisuda', $data);
		$this->load->view('biro/v_footer');
	}

	function jadwalwisuda_add()
	{
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_jadwalwisuda_add');
		$this->load->view('biro/v_footer');
	}

	function jadwalwisuda_add_act()
	{
		$this->load->database();
		$jadwal_kode = $this->input->post('jadwal_id');
		$jadwal_nama = $this->input->post('angkatan');
		$jadwal_tahun = $this->input->post('tahun');
		$jadwal_kuota = $this->input->post('kuota');
		$jadwal_tanggal = $this->input->post('tanggal');
		$jadwal_id = $jadwal_tahun . $jadwal_kode;
		$data = array(
			'jadwal_id' => $jadwal_id,
			'jadwal_nama' => $jadwal_nama,
			'jadwal_tahun' => $jadwal_tahun,
			'jadwal_kuota' => $jadwal_kuota,
			'jadwal_tanggal' => $jadwal_tanggal,
			'h_pengguna' => $this->session->userdata('uuser'),
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:sa")
		);

		$this->M_vic->insert_data($data, 'tbl_jadwalwisuda');
		redirect(base_url() . 'biro/jadwalwisuda/?alert=add');
	}

	function jadwalwisuda_edit($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/jadwalwisuda');
		} else {
			$where = array(
				'jadwal_id' => $id
			);
			$data['edit'] = $this->M_vic->edit_data($where, 'tbl_jadwalwisuda')->result();
			$data['jadwal'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$id' ORDER BY jadwal_nama ASC")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_jadwalwisuda_edit', $data);
			$this->load->view('biro/v_footer');
		}
	}

	function jadwalwisuda_update()
	{
		$this->load->database();
		$jadwal_id = $this->input->post('jadwal_id');
		$jadwal_nama = $this->input->post('angkatan');
		$jadwal_tahun = $this->input->post('tahun');
		$jadwal_kuota = $this->input->post('kuota');
		$jadwal_tanggal = $this->input->post('tanggal');
		$data = array(
			'jadwal_nama' => $jadwal_nama,
			'jadwal_tahun' => $jadwal_tahun,
			'jadwal_kuota' => $jadwal_kuota,
			'jadwal_tanggal' => $jadwal_tanggal,
			'h_pengguna' => $this->session->userdata('uuser'),
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:sa")
		);

		$w = array(
			'jadwal_id' => $jadwal_id
		);
		$this->M_vic->update_data($w, $data, 'tbl_jadwalwisuda');
		redirect(base_url() . 'biro/jadwalwisuda/?alert=update');
	}

	function jadwalwisuda_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/jadwalwisuda');
		} else {
			$where = array(
				'jadwal_id' => $id
			);
			$this->M_vic->delete_data($where, 'tbl_jadwalwisuda');
			redirect('biro/jadwalwisuda/?alert=delete');
		}
	}

	function jadwalwisuda_pendaftaran()
	{
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_jadwalwisuda_pendaftaran');
		$this->load->view('biro/v_footer');
	}

	function jadwalwisuda_set_edit()
	{
		$this->load->database();
		$data['atur'] = $this->db->query("SELECT * FROM tbl_jadwalbuka")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_jadwalwisuda_setting', $data);
		$this->load->view('biro/v_footer');
	}

	function jadwalwisuda_set_update()
	{
		$this->load->database();
		$set_id2 = '1';
		$tanggal_buka2 = $this->input->post('tanggal_buka2');
		$jam_buka2 = $this->input->post('jam_buka2');
		$tanggal_tutup2 = $this->input->post('tanggal_tutup2');
		$jam_tutup2 = $this->input->post('jam_tutup2');
		$keterangan2 = $this->input->post('keterangan2');
		$status2 = $this->input->post('status3');
		//$jalur_lulus = $this->input->post('jalur_lulus');

		$where = array(
			'set_id' => $set_id2
		);
		$data = array(
			'set_tanggal_buka' => $tanggal_buka2,
			'set_tanggal_tutup' => $tanggal_tutup2,
			'set_jam_buka' => $jam_buka2,
			'set_jam_tutup' => $jam_tutup2,
			'set_keterangan' => $keterangan2,
			'set_status' => $status2,
			//'set_jalur_lulus' => $jalur_lulus,
			'h_pengguna' => $this->session->userdata('uuser'),
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:sa")
		);
		$this->M_vic->update_data($where, $data, 'tbl_jadwalbuka');

		$this->M_vic->update_data($where, $data, 'tbl_jadwalbuka');
		redirect(base_url() . 'biro/jadwalwisuda_set_edit/?alert=update');
	}

	function wisuda_calon($id)
	{
		$this->load->database();
		$prodi = substr($id, 0, -4);
		$thn = substr($id, 5);
		if ($id == '') {
			redirect('biro/wisuda_calon/0');
			//$thn = date('Y');
			$thn = '----- Pilih -----';
			$prodi = '----- Pilih -----';
		}
		$data['thn'] = $thn;
		$data['prodi'] = $prodi;
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();

		// $where = array('peserta_prodi' => $prodi, 'peserta_tahun_masuk' => $thn);
		// $data['peserta'] = $this->M_vic->edit_data($where,'tbl_peserta')->result();
		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_peserta p WHERE YEAR(p.h_tanggal) = '$thn' AND p.peserta_prodi = '$prodi' ")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_wisuda_calon', $data);
		$this->load->view('biro/v_footer');
	}

	function wisuda_peserta($id = 0)
	{
		$this->load->database();
		$prodi = substr($id, 0, 5);
		// $thn = substr($id, 5, -6);
		$sesi = substr($id, 5);
		if ($id == '') {
			redirect('biro/wisuda_peserta/0');
			//$thn = date('Y');
			// $thn = '----- Pilih -----';
			$prodi = '----- Pilih -----';
		}
		// $data['thn'] = $thn;
		$data['prodi'] = $prodi;
		$data['sesi'] = $sesi;
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();
		// $th = date('Y');
		// if ($thn == '') {
		// 	$th = date('Y');
		// } else {
		// 	$th = $thn;
		// }
		// $data['sesi_wisuda'] = $this->db->query("SELECT DISTINCT * FROM tbl_jadwalwisuda WHERE jadwal_tahun = '$th' ORDER BY jadwal_id ASC ")->result();
		$data['sesi_wisuda'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda ORDER BY jadwal_id DESC")->result();
		// $data['sesi_wisuda'] = $this->db->get('tbl_jadwalwisuda')->result();

		// $data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND YEAR(p.h_tanggal) = '$thn' AND a.mhs_prodi = '$prodi' AND a.mhs_sesi_wisuda = '$sesi' ")->result();
		$data['peserta'] = $this->db->query("SELECT ta.mhs_no_wisuda,ta.mhs_nim,ta.mhs_nama,ta.mhs_jenis_kelamin, tp.peserta_ipk, tp.peserta_lama_studi, tp.peserta_predikat  
		from tbl_alumni ta 
		left join tbl_peserta tp on tp.peserta_kode = ta.mhs_nim 
		where ta.mhs_no_wisuda != '' and ta.mhs_prodi ='$prodi' and ta.mhs_sesi_wisuda ='$sesi'")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_wisuda_peserta', $data);
		$this->load->view('biro/v_footer');
	}

	//wisuda verifikasi
	function wisuda_ver($id = 0)
	{
		$this->load->database();
		$thn = $id;
		if ($id == "") {
			redirect('biro/wisuda_ver/0');
			//$thn = date('Y');
			$thn = date('Y');
		}
		$data['thn'] = $thn;
		$data['sesiWisuda'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda ORDER BY jadwal_tanggal DESC");
		$data['jurusan'] = $this->db->query("SELECT tp.prodi_nama, tp.prodi_kode, tf.fakultas_nama as fakultas, 
		(SELECT count(ta.mhs_nim) from tbl_alumni ta where ta.mhs_no_wisuda='' and ta.mhs_sesi_wisuda='$thn' and ta.mhs_prodi=tp.prodi_kode) as belum
		from tbl_prodi tp 
		left join tbl_fakultas tf on tf.fakultas_id = tp.prodi_fakultas 
		order by tp.prodi_fakultas")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_wisuda_ver', $data);
		$this->load->view('biro/v_footer');
	}

	function wisuda_ver_tampil($id)
	{
		$this->load->database();
		$thn = substr($id, 0, 6);
		$kodeprodi = substr($id, 6);
		$data['thn'] = $thn;
		$data['kodeprodi'] = $kodeprodi;
		// $data['alumni'] = $this->db->get_where('tbl_alumni', ['mhs_sesi_wisuda' => $thn]);
		$data['alumni'] = $this->db->query("SELECT * FROM tbl_alumni WHERE mhs_no_wisuda = '' AND mhs_prodi=$kodeprodi AND mhs_sesi_wisuda=$thn");
		$data['sesi'] = $this->db->get_where('tbl_jadwalwisuda', ['jadwal_id' => $thn])->row();
		$data['prodi'] = $this->db->get_where('tbl_prodi', ['prodi_kode' => $kodeprodi])->row();
		$data['mhsLampiran'] = [];
		foreach ($data['alumni']->result() as $a) {
			$len[$a->mhs_nim] = [];
			$nimLength = strlen($a->mhs_nim);
			if ($nimLength == 9) {
				$query = "SELECT l.lampiran_nama, l.lampiran_format, l.lampiran_id,
				(SELECT peserta_lampiran FROM tbl_peserta_lampiran where peserta_lamp_kode=l.lampiran_id and peserta_kode='$a->mhs_nim' LIMIT 1) as lampiran 
				FROM tbl_lampiran l WHERE lampiran_keperluan='wisuda' AND lampiran_status='0'";
			} elseif ($nimLength > 9) {
				$query = "SELECT l.lampiran_nama, l.lampiran_format, l.lampiran_id,
				(SELECT peserta_lampiran FROM tbl_peserta_lampiran where peserta_lamp_kode=l.lampiran_id and peserta_kode='$a->mhs_nim' LIMIT 1) as lampiran 
				FROM tbl_lampiran l WHERE lampiran_keperluan='wisuda'";
			} else {
				$query = "SELECT l.lampiran_nama, l.lampiran_format, l.lampiran_id,
				(SELECT peserta_lampiran FROM tbl_peserta_lampiran where peserta_lamp_kode=l.lampiran_id and peserta_kode='$a->mhs_nim' LIMIT 1) as lampiran 
				FROM tbl_lampiran l WHERE lampiran_keperluan='wisuda' AND lampiran_status='0'";
			}
			$lampiran = $this->db->query($query);
			foreach ($lampiran->result() as $l) {
				array_push(
					$len[$a->mhs_nim],
					[
						'lampiran_nama' => $l->lampiran_nama,
						'lampiran' => $l->lampiran
					]
				);
			}
			array_push($data['mhsLampiran'], $len[$a->mhs_nim]);
		}
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_wisuda_ver_1', $data);
		$this->load->view('biro/v_footer');
	}

	// public function arrayTest()
	// {
	// 	$arrayNim = ['150170043', '227110201011'];
	// 	$lampiran = [
	// 		'150170043' => [
	// 			'lampiran_nama' => 'test'
	// 		],
	// 	];
	// 	foreach ($arrayNim as $a) {
	// 		echo "<pre>";
	// 		print_r($lampiran[$a]['lampiran_nama']);
	// 		echo "</pre>";
	// 	}
	// }

	public function verPesertaWisuda()
	{
		$nim = $this->input->post('nim');
		$jadwal = $this->input->post('jadwal');
		$prodi = $this->input->post('prodi');
		$update = [
			'mhs_no_wisuda' => nomorWisuda($jadwal, $prodi),
		];
		$where = [
			'mhs_nim' => $nim
		];
		$this->db->update('tbl_alumni', $update, $where);
		redirect("biro/wisuda_ver_tampil/$jadwal$prodi?alert=user-verifikasi");
	}

	public function batalkanPesertaWisuda($id = 0)
	{
		if ($id == 0) {
			redirect('biro');
		} else {
			$redirect = $this->db->select('mhs_prodi,mhs_sesi_wisuda')
				->from('tbl_alumni')
				->where(['mhs_nim' => $id])
				->get()
				->row();
			$prodi = $redirect->mhs_prodi;
			$jadwal = $redirect->mhs_sesi_wisuda;
			$this->db->delete('tbl_alumni', ['mhs_nim' => $id]);
			redirect("biro/wisuda_ver_tampil/$jadwal$prodi?alert=batal-peserta-wisuda");
		}
	}

	function wisuda_ver_selesai($id)
	{
		$this->load->database();
		$thn = substr($id, 0, 4);
		$kodeprodi = substr($id, 4);
		$data['thn'] = $thn;
		$data['kodeprodi'] = $kodeprodi;
		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_peserta p WHERE p.peserta_status_verifikasi = 'oke' AND p.peserta_no_kk != '' AND YEAR(p.h_tanggal) = '$thn' AND p.peserta_prodi = '$kodeprodi' ORDER BY p.h_tanggal, p.h_waktu DESC")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_wisuda_ver_2', $data);
		$this->load->view('biro/v_footer');
	}

	function wisuda_ver_oke($id)
	{
		$this->load->database();
		// $nim = substr($id, 0, 9);
		// $thn = substr($id, 9, 4);
		// $kodeprodi = substr($id, 13);
		$nim = substr($id, 9);
		$thn = substr($id, 5, 4);
		$kodeprodi = substr($id, 0, 5);
		if ($id == "") {
			redirect('biro/wisuda_ver');
		} else {
			//$nim = str_replace('-', '/', $id);
			$this->db->query("UPDATE tbl_peserta SET peserta_status_verifikasi = 'oke', peserta_status = 'Aktif', peserta_checklist = '07' WHERE peserta_kode = '$nim'");
			$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
			redirect('biro/wisuda_ver_tampil/' . $thn . $kodeprodi . '?alert=user-verifikasi');
		}
		//echo $nim.' '.$thn.' '.$kodeprodi.' '.$sesi_wisuda;
		//redirect('biro/wisuda_ver_tampil/'.$thn.$kodeprodi.'?alert=user-verifikasi');
	}

	function wisuda_ver_batal($id)
	{
		$this->load->database();
		$nim = substr($id, 0, 9);
		$thn = substr($id, 9, 4);
		$kodeprodi = substr($id, 13);
		$this->load->database();
		if ($id == "") {
			redirect('biro/wisuda_ver');
		} else {
			//$nim = str_replace('-', '/', $id);
			$this->db->query("UPDATE tbl_peserta SET peserta_status_verifikasi = '', peserta_checklist = '07' WHERE peserta_kode = '$nim'");
			$this->db->query("DELETE FROM tbl_alumni WHERE mhs_nim = '$nim'");
			$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
			redirect('biro/wisuda_ver_selesai/' . $thn . $kodeprodi . '?alert=update');
		}
	}

	function wisuda_cancel($id)
	{
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		if ($id == "") {
			redirect('biro/wisuda_peserta/0');
		} else {
			$this->db->query("DELETE FROM tbl_alumni WHERE mhs_nim = '$id'");
			redirect('biro/wisuda_peserta');
		}
	}

	function daftarwisuda_cetak($id)
	{
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		if ($id == "") {
			redirect('wisuda/index');
		} else {
			$data['nim'] = $id;
			$data['mahasiswa'] = $this->db->query("SELECT * FROM tbl_alumni WHERE mhs_nim = '$id'")->result();
			$this->load->view('wisuda/v_cetak_pendaftaran', $data);
		}
	}


	//fakultas
	function fakultas()
	{
		$this->load->database();
		$data['fakultas'] = $this->db->query("SELECT * FROM tbl_fakultas ORDER BY fakultas_id ASC")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_fakultas', $data);
		$this->load->view('biro/v_footer');
	}

	function fakultas_add()
	{
		$this->load->database();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_fakultas_add');
		$this->load->view('biro/v_footer');
	}

	function fakultas_add_act()
	{
		$this->load->database();
		$fakultas_kode = $this->input->post('fakultas_id');
		$fakultas_name = $this->input->post('fakultas');
		$this->form_validation->set_rules('fakultas', 'Nama fakultas', 'required');
		if ($this->form_validation->run() != true) {
			$data['fakultas'] = $this->db->query("SELECT * FROM tbl_fakultas ORDER BY fakultas_nama ASC")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_fakultas1', $data);
			$this->load->view('biro/v_footer');
		} else {
			$data = array(
				'fakultas_id' => $fakultas_kode,
				'fakultas_nama' => $fakultas_name,
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);
			$this->M_vic->insert_data($data, 'tbl_fakultas');

			$con = $this->M_vic->panggil_dbpumaba();
			mysqli_query($con, "INSERT INTO 
  				tbl_fakultas (fakultas_id,fakultas_nama,h_pengguna,h_tanggal,h_waktu) 
  				VALUES ('$fakultas_kode','$fakultas_name','" . $this->session->userdata('uuser') . "', '" . date('Y-m-d') . "', '" . date("h:i:sa") . "')");
			mysqli_close($con);

			redirect(base_url() . 'biro/fakultas/?alert=add');
		}
	}

	function fakultas_edit($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/fakultas');
		} else {
			$where = array(
				'fakultas_id' => $id
			);
			$data['edit'] = $this->M_vic->edit_data($where, 'tbl_fakultas')->result();
			$data['fakultas'] = $this->db->query("SELECT * FROM tbl_fakultas WHERE fakultas_id = '$id' ORDER BY fakultas_nama ASC")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_fakultas_edit', $data);
			$this->load->view('biro/v_footer');
		}
	}

	function fakultas_update()
	{
		$this->load->database();
		$id = $this->input->post('fakultas_id');
		$this->form_validation->set_rules('fakultas', 'Nama fakultas', 'required');
		if ($this->form_validation->run() != true) {
			$where = array(
				'fakultas_id' => $id
			);
			$data['edit'] = $this->M_vic->edit_data($where, 'tbl_fakultas')->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_fakultas_edit', $data);
			$this->load->view('biro/v_footer');
		} else {

			$fakultas_name = $this->input->post('fakultas');
			$data = array(
				'fakultas_nama' => $fakultas_name,
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);

			$w = array(
				'fakultas_id' => $id
			);
			$this->M_vic->update_data($w, $data, 'tbl_fakultas');
			redirect(base_url() . 'biro/fakultas/?alert=update');
		}
	}

	function fakultas_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/fakultas');
		} else {
			$where = array(
				'fakultas_id' => $id
			);
			$this->M_vic->delete_data($where, 'tbl_fakultas');

			$con = $this->M_vic->panggil_dbpumaba();
			mysqli_query($con, "DELETE FROM tbl_fakultas WHERE fakultas_id = '$id'");
			mysqli_close($con);

			redirect('biro/fakultas/?alert=delete');
		}
	}

	// jurusan
	function jurusan()
	{
		$this->load->database();
		$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_jurusan', $data);
		$this->load->view('biro/v_footer');
	}

	function jurusan_add()
	{
		$this->load->database();
		$data['fakultas'] = $this->db->query("SELECT * FROM tbl_fakultas")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_jurusan_add', $data);
		$this->load->view('biro/v_footer');
	}

	function jurusan_add_act()
	{
		$this->load->database();
		$peg_id = $this->session->userdata('peg_id');
		$idjur = $this->input->post('prodi_id');
		$jurusan = $this->input->post('jurusan');
		$fakultas = $this->input->post('fakultas');
		$tingkat = $this->input->post('tingkat');
		$internal = $this->input->post('internal');

		$this->form_validation->set_rules('jurusan', 'Nama', 'required');
		$this->form_validation->set_rules('internal', 'Kode Internal', 'required');

		if ($this->form_validation->run() != true) {
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_jurusan_add');
			$this->load->view('biro/v_footer');
		} else {
			$data = array(
				'prodi_kode' => $idjur,
				'prodi_nama' => $jurusan,
				'prodi_fakultas' => $fakultas,
				'prodi_tingkat' => $tingkat,
				'prodi_kode_internal' => $internal,
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => 	date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);
			$this->M_vic->insert_data($data, 'tbl_prodi');
			redirect(base_url() . 'biro/jurusan/?alert=add');
		}
	}

	function jurusan_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/jurusan');
		} else {
			$where = array(
				'prodi_id' => $id
			);
			$this->M_vic->delete_data($where, 'tbl_prodi');
			redirect('biro/jurusan/?alert=delete');
		}
	}

	function jurusan_edit($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/jurusan');
		} else {
			$where = array(
				'prodi_id' => $id
			);
			$data['jurusan'] = $this->M_vic->edit_data($where, 'tbl_prodi')->result();
			$data['fakultas'] = $this->db->query("SELECT * FROM tbl_fakultas")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_jurusan_edit', $data);
			$this->load->view('biro/v_footer');
		}
	}

	function jurusan_update()
	{
		$this->load->database();
		$peg_id = $this->session->userdata('peg_id');
		$id = $this->input->post('prodi_id');
		$idjur = $this->input->post('prodi_kode');
		$jurusan = $this->input->post('jurusan');
		$fakultas = $this->input->post('fakultas');
		$tingkat = $this->input->post('tingkat');
		$internal = $this->input->post('internal');

		$this->form_validation->set_rules('jurusan', 'Nama', 'required');
		$this->form_validation->set_rules('internal', 'Kode Internal', 'required');

		$where = array(
			'prodi_id' => $id
		);

		if ($this->form_validation->run() != true) {
			$data['jurusan'] = $this->M_vic->edit_data($where, 'tbl_prodi')->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_jurusan_edit', $data);
			$this->load->view('biro/v_footer');
		} else {
			$data = array(
				'prodi_kode' => $idjur,
				'prodi_nama' => $jurusan,
				'prodi_fakultas' => $fakultas,
				'prodi_tingkat' => $tingkat,
				'prodi_kode_internal' => $internal,
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => 	date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);

			$this->M_vic->update_data($where, $data, 'tbl_prodi');

			redirect(base_url() . 'biro/jurusan/?alert=update');
		}
	}

	//pegawai
	function pegawai()
	{
		$this->load->database();
		$data['pegawai'] = $this->M_vic->get_data('tbl_pegawai')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_pegawai', $data);
		$this->load->view('biro/v_footer');
	}

	function pegawai_add()
	{
		$this->load->database();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_tambah_pegawai');
		$this->load->view('biro/v_footer');
	}

	function pegawai_add_act()
	{
		$this->load->database();
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$uname = $this->input->post('uname');
		$alamat = $this->input->post('alamat');
		$hp = $this->input->post('hp');
		$email = $this->input->post('email');
		$status = $this->input->post('status');
		$id = $this->session->userdata('uuser');
		$tgl = date('Y-m-d');
		$jam = date('H:i:s');

		$data = array(
			'peg_nip' => $nip,
			'peg_nama' => $nama,
			'peg_user' => $uname,
			'peg_pass' => md5($nip),
			'peg_alamat' => $alamat,
			'peg_hp' => $hp,
			'peg_email' => $email,
			'peg_status' => $status,
			'h_pengguna' => $id,
			'h_tanggal' => $tgl,
			'h_waktu' => $jam
		);
		$this->M_vic->insert_data($data, 'tbl_pegawai');
		redirect('biro/pegawai/?alert=add');
	}

	function pegawai_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/pegawai');
		} else {
			$where = array(
				'peg_id' => $id
			);
			$this->M_vic->delete_data($where, 'tbl_pegawai');
			redirect('biro/pegawai/?alert=delete');
		}
	}

	function pegawai_edit($id)
	{
		$where = array(
			'peg_id' => $id
		);
		$data['pegawai'] = $this->M_vic->edit_data($where, 'tbl_pegawai')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_edit_pegawai', $data);
		$this->load->view('biro/v_footer');
	}

	function pegawai_update()
	{
		$this->load->database();
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$hp = $this->input->post('hp');
		$email = $this->input->post('email');
		$status = $this->input->post('status');
		$id = $this->session->userdata('uuser');
		$tgl = date('Y-m-d');
		$jam = date('H:i:s');

		$where = array('peg_id' => $this->input->post('id'));
		$data = array(
			'peg_nip' => $nip,
			'peg_nama' => $nama,
			'peg_alamat' => $alamat,
			'peg_hp' => $hp,
			'peg_email' => $email,
			'peg_status' => $status,
			'h_pengguna' => $id,
			'h_tanggal' => $tgl,
			'h_waktu' => $jam
		);
		$this->M_vic->update_data($where, $data, 'tbl_pegawai');
		redirect('biro/pegawai/?alert=update');
	}

	function pegawai_reset_pass($id)
	{
		if ($id == '') {
			redirect('biro/pegawai');
		}
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		$read = mysqli_query($db, "SELECT peg_nip FROM tbl_pegawai WHERE peg_id ='$id'");
		$r = mysqli_fetch_array($read);
		$pass = md5($r[0]);
		$where = array(
			'peg_id' => $id
		);
		$data = array(
			'peg_pass' => $pass
		);
		$this->M_vic->update_data($where, $data, 'tbl_pegawai');
		redirect('biro/pegawai/?alert=reset-pass');
	}

	//peserta
	function peserta($id)
	{
		$this->load->database();
		$prodi = substr($id, 0, -4);
		$thn = substr($id, 5);
		if ($id == '') {
			redirect('biro/peserta/0');
			//$thn = date('Y');
			$thn = '----- Pilih -----';
			$prodi = '----- Pilih -----';
		}
		$data['thn'] = $thn;
		$data['prodi'] = $prodi;
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();

		$where = array('peserta_prodi' => $prodi, 'peserta_tahun_masuk' => $thn);
		$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta', $data);
		$this->load->view('biro/v_footer');
	}

	function peserta_add()
	{
		$this->load->database();
		$data['fakultas'] = $this->M_vic->get_data('tbl_fakultas')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_tambah_peserta', $data);
		$this->load->view('biro/v_footer');
	}

	function prodi()
	{
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM tbl_prodi WHERE prodi_fakultas = '$id'")->result();
		echo json_encode($data);
	}

	function peserta_add_act()
	{
		$nim = $this->input->post('nim');
		$nama = $this->input->post('nama');
		$kelas = $this->input->post('kelas');
		$fakultas = $this->input->post('fakultas');
		$prodi = $this->input->post('prodi');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tanggal_masuk = $this->input->post('tanggal_masuk');
		$tanggal_keluar = $this->input->post('tanggal_keluar');
		//$lama_studi = $this->input->post('lama_studi');
		$lama_studi = '';
		//if(G4="";"";if(H4="";"";date_diff(G4;H4;"y")&" Tahun "&date_diff(G4;H4;"ym")&" Bulan"))
		$tanggal_awal = date_create($tanggal_masuk);
		$tanggal_akhir = date_create($tanggal_keluar);
		//$diff  = date_diff($tanggal_masuk, $tanggal_keluar);
		$diff  = date_diff($tanggal_awal, $tanggal_akhir);
		if ($tanggal_masuk == "" || $tanggal_keluar == "") {
			$lama_studi = '';
		} else {
			$lama_studi = $diff->y . ' Tahun ' . $diff->m . ' Bulan';
		}
		//echo $lama_studi;
		$jenis_keluar = 'Lulus';
		$nosk_yudisium = $this->input->post('nosk_yudisium');
		$tanggal_yudisium = $this->input->post('tanggal_yudisium');
		$ipk = $this->input->post('ipk');
		$nomor_ijazah = $this->input->post('nomor_ijazah');
		$nomor_blanko = $this->input->post('nomor_blanko');
		$judul_skripsi = $this->input->post('judul_skripsi');
		$jumlah_sks = $this->input->post('jumlah_sks');
		$predikat = $this->input->post('predikat');
		$awal_bimbingan = $this->input->post('awal_bimbingan');
		$akhir_bimbingan = $this->input->post('akhir_bimbingan');
		$semester_lulus = $this->input->post('semester_lulus');
		$keterangan_wisuda = $this->input->post('keterangan_wisuda');

		$db = $this->M_vic->panggil_db();
		$read = mysqli_query($db, "SELECT COUNT(peserta_kode) FROM tbl_peserta WHERE peserta_kode ='$nim'");
		$r = mysqli_fetch_array($read);

		$data = array(
			'peserta_kode' => $nim,
			'peserta_nama' => $nama,
			'peserta_fakultas' => $fakultas,
			'peserta_prodi' => $prodi,
			'peserta_jenis_kelamin' => $jenis_kelamin,
			'peserta_pass' => md5($tanggal_lahir),
			'peserta_status' => 'Nonaktif',
			'peserta_kelas' => '',
			'peserta_tahun_masuk' => '20' . substr($nim, 0, 2),
			'peserta_tempat_lahir' => $tempat_lahir,
			'peserta_tanggal_lahir' => $tanggal_lahir,
			'peserta_tanggal_masuk' => date('Y-m-d', strtotime($this->input->post('tanggal_masuk'))),
			'peserta_tanggal_keluar' => date('Y-m-d', strtotime($this->input->post('tanggal_keluar'))),
			'peserta_tanggal_sidang' => date('Y-m-d', strtotime($this->input->post('tanggal_keluar'))),
			'peserta_lama_studi' => $lama_studi,
			'peserta_jenis_keluar' => $jenis_keluar,
			'peserta_nosk_yudisium' => $nosk_yudisium,
			'peserta_tanggal_yudisium' => date('Y-m-d', strtotime($this->input->post('tanggal_yudisium'))),
			'peserta_ipk' => $ipk,
			'peserta_nomor_ijazah' => $nomor_ijazah,
			'peserta_nomor_blanko' => $nomor_blanko,
			'peserta_judul_skripsi' => $judul_skripsi,
			'peserta_jumlah_sks' => $jumlah_sks,
			'peserta_predikat' => $predikat,
			'peserta_awal_bimbingan' => $awal_bimbingan,
			'peserta_akhir_bimbingan' => $akhir_bimbingan,
			'peserta_semester_lulus' => $semester_lulus,
			'peserta_keterangan_wisuda' => $keterangan_wisuda,
			'peserta_checklist' => '01',
			'h_pengguna' => $this->session->userdata('uuser'),
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:s")
		);
		$this->M_vic->insert_data($data, 'tbl_peserta');
		redirect('biro/peserta/' . $prodi . '/?alert=add');
		if ($r[0] > 0) {
			redirect('biro/peserta/' . $prodi . '/?alert=user-duplikat');
		} else {
			$this->M_vic->insert_data($data, 'tbl_peserta');

			$data3 = array(
				'acak_nilai' => $nik,
				'acak_kata' => vicencrypt($tanggal_lahir),
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);
			$this->M_vic->insert_data($data3, 'tbl_vicacak');

			redirect('biro/peserta/' . $prodi . '/?alert=add');
		}
	}

	function peserta_edit($id)
	{
		$this->load->database();
		$where = array('peserta_kode' => $id);
		$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
		$data['fakultas'] = $this->M_vic->get_data('tbl_fakultas')->result();
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_edit', $data);
		$this->load->view('biro/v_footer');
	}

	function peserta_update()
	{
		$nim = $this->input->post('nim');
		$nama = $this->input->post('nama');
		$kelas = $this->input->post('kelas');
		//$fakultas = $this->input->post('fakultas');
		$prodi = $this->input->post('prodi');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tanggal_masuk = $this->input->post('tanggal_masuk');
		$tanggal_keluar = $this->input->post('tanggal_keluar');
		//$lama_studi = $this->input->post('lama_studi');
		$lama_studi = '';
		//if(G4="";"";if(H4="";"";date_diff(G4;H4;"y")&" Tahun "&date_diff(G4;H4;"ym")&" Bulan"))
		$tanggal_awal = date_create($tanggal_masuk);
		$tanggal_akhir = date_create($tanggal_keluar);
		//$diff  = date_diff($tanggal_masuk, $tanggal_keluar);
		$diff  = date_diff($tanggal_awal, $tanggal_akhir);
		if ($tanggal_masuk == "" || $tanggal_keluar == "") {
			$lama_studi = '';
		} else {
			$lama_studi = $diff->y . ' Tahun ' . $diff->m . ' Bulan';
		}
		//echo $lama_studi;
		$jenis_keluar = 'Lulus';
		$nosk_yudisium = $this->input->post('nosk_yudisium');
		$tanggal_yudisium = $this->input->post('tanggal_yudisium');
		$ipk = $this->input->post('ipk');
		$nomor_ijazah = $this->input->post('nomor_ijazah');
		$nomor_blanko = $this->input->post('nomor_blanko');
		$nomor_telepon = $this->input->post('nomor_telepon');
		$judul_skripsi = $this->input->post('judul_skripsi');
		$jumlah_sks = $this->input->post('jumlah_sks');
		$predikat = $this->input->post('predikat');
		$awal_bimbingan = $this->input->post('awal_bimbingan');
		$akhir_bimbingan = $this->input->post('akhir_bimbingan');
		$semester_lulus = $this->input->post('semester_lulus');
		$keterangan_wisuda = $this->input->post('keterangan_wisuda');

		$db = $this->M_vic->panggil_db();
		$read = mysqli_query($db, "SELECT COUNT(peserta_kode) FROM tbl_peserta WHERE peserta_kode ='$nim'");
		$r = mysqli_fetch_array($read);
		$read1 = mysqli_query($db, "SELECT * FROM tbl_prodi WHERE prodi_kode ='$prodi'");
		$r1 = mysqli_fetch_array($read1);
		$fakultas = $r1['prodi_fakultas'];

		$where = array('peserta_kode' => $nim);
		$data = array(
			'peserta_kode' => $nim,
			'peserta_nama' => $nama,
			'peserta_fakultas' => $fakultas,
			'peserta_prodi' => $prodi,
			'peserta_jenis_kelamin' => $jenis_kelamin,
			//'peserta_pass' => md5($tanggal_lahir),
			'peserta_status' => 'Nonaktif',
			'peserta_kelas' => '',
			'peserta_tahun_masuk' => '20' . substr($nim, 0, 2),
			'peserta_tempat_lahir' => $tempat_lahir,
			'peserta_tanggal_lahir' => $tanggal_lahir,
			'peserta_telepon' => $nomor_telepon,
			'peserta_tanggal_masuk' => date('Y-m-d', strtotime($this->input->post('tanggal_masuk'))),
			'peserta_tanggal_keluar' => date('Y-m-d', strtotime($this->input->post('tanggal_keluar'))),
			'peserta_tanggal_sidang' => date('Y-m-d', strtotime($this->input->post('tanggal_keluar'))),
			'peserta_lama_studi' => $lama_studi,
			'peserta_jenis_keluar' => $jenis_keluar,
			'peserta_nosk_yudisium' => $nosk_yudisium,
			'peserta_tanggal_yudisium' => date('Y-m-d', strtotime($this->input->post('tanggal_yudisium'))),
			'peserta_ipk' => $ipk,
			'peserta_nomor_ijazah' => $nomor_ijazah,
			'peserta_nomor_blanko' => $nomor_blanko,
			'peserta_judul_skripsi' => $judul_skripsi,
			'peserta_jumlah_sks' => $jumlah_sks,
			'peserta_predikat' => $predikat,
			'peserta_awal_bimbingan' => $awal_bimbingan,
			'peserta_akhir_bimbingan' => $akhir_bimbingan,
			'peserta_semester_lulus' => $semester_lulus,
			'peserta_keterangan_wisuda' => $keterangan_wisuda,
			'h_pengguna' => $this->session->userdata('uuser'),
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:s")
		);
		$this->M_vic->update_data($where, $data, 'tbl_peserta');
		redirect('biro/peserta/' . $prodi);
	}

	function import_peserta()
	{
		$this->load->database();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_import_peserta');
		$this->load->view('biro/v_footer');
	}

	function import_peserta_add()
	{
		$this->load->database();
		//$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'xlsx|xls|XLSX|XLS';
		$config['upload_path'] = './assets/uploads/';
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
		//$this->upload->do_upload('userfile');
		if (!$this->upload->do_upload()) {
			redirect(base_url() . 'biro/peserta/?alert=upload-gagal', 'refresh');
		} else {
			$data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data();
			$filename = $upload_data['file_name'];
			//$this->phpexcel_model->upload_data($filename);
			$this->M_vic2->upload_data($filename);
			unlink('./assets/uploads/' . $filename);
			//redirect('php_excel/import/success','refresh');
			//redirect(base_url().'biro/peserta','refresh');
			redirect('biro/peserta/0/?alert=upload-sukses');
		}
	}

	function peserta_delete($id)
	{
		$db = $this->M_vic->panggil_db();
		$idinternal = substr($id, 3, -4);
		$prodi = mysqli_query($db, "SELECT prodi_kode FROM tbl_prodi WHERE prodi_kode_internal = '$idinternal'");
		$p = mysqli_fetch_array($prodi);

		if ($id == "") {
			redirect('biro/peserta');
		} else {
			$where = array('peserta_kode' => $id);
			$this->M_vic->delete_data($where, 'tbl_peserta');
			//redirect('biro/peserta/?alert=delete');
			redirect('biro/peserta/' . $p[0] . '/?alert=delete');
		}
	}

	function peserta_reset_pass($id)
	{
		$db = $this->M_vic->panggil_db();
		//$mhs = mysqli_query($db, "SELECT mhs_tanggal_lahir, mhs_prodi, mhs_tahun_masuk FROM tbl_mahasiswa WHERE mhs_kode = '$id'");
		//$m = mysqli_fetch_array($mhs);

		$where = array('mhs_kode' => $id);
		$data = array('mhs_pass' => md5($id));
		//var_dump($id);
		//die;
		$this->db->update('tbl_mahasiswa', $data, $where);
		//$this->M_vic->update_data($where,$data,'tbl_mahasiswa');
		redirect('biro/peserta/0?alert=reset-pass');
		//redirect('biro/peserta/'.$m[1].$m[2].'/?alert=reset-pass')
	}

	function peserta_cek_list($id)
	{
		$this->load->database();
		$prodi = substr($id, 0, -4);
		$thn = substr($id, 5);
		if ($id == "") {
			redirect('biro/peserta_cek_list/0');
			//$thn = date('Y');
			$thn = '----- Pilih -----';
			$prodi = '----- Pilih -----';
		}
		$data['thn'] = $thn;
		$data['prodi'] = $prodi;
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();
		$data['cek'] = $this->M_vic->get_data('tbl_cek_list')->result();
		$where = array(
			'peserta_nomor_ijazah' => "",
			'peserta_keterangan_wisuda' => "Belum",
			'YEAR(h_tanggal)' => $thn,
			'peserta_prodi' => $prodi
		);
		$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_cek_list', $data);
		$this->load->view('biro/v_footer');
	}

	function peserta_checklist_update($id)
	{
		$idcek = $id;
		$kodecek = substr($idcek, 0, 2);
		$nim = substr($idcek, 2, 9);
		$prodi = substr($idcek, 11);
		$this->load->database();
		if ($id == "") {
			redirect('biro/peserta_cek_list/0');
		} else {
			//redirect('biro/peserta_cek_list/'.$kodecek);
			//echo $kodecek.'<br>'.$nim.'<br>'.$prodi;
			$this->db->query("UPDATE tbl_peserta SET peserta_checklist = '$kodecek' WHERE peserta_kode = '$nim'");
			$this->db->query("UPDATE tbl_peserta SET peserta_status = 'Aktif' WHERE peserta_kode = '$nim' AND peserta_checklist = '04'");
			$this->db->query("UPDATE tbl_peserta SET peserta_status = 'Nonaktif' WHERE peserta_kode = '$nim' AND peserta_checklist != '04'");

			redirect('biro/peserta_cek_list/' . $prodi);
		}
	}

	function peserta_ver($id = 0)
	{
		$this->load->database();
		$thn = $id;
		if ($id == "") {
			redirect('biro/peserta_ver/0');
			//$thn = date('Y');
			$thn = date('Y');
		}
		$data['thn'] = $thn;
		$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_ver', $data);
		$this->load->view('biro/v_footer');
	}

	function peserta_tampil($id)
	{
		$this->load->database();
		$thn = substr($id, 0, 4);
		$kodeprodi = substr($id, 4);
		$data['thn'] = $thn;
		$data['kodeprodi'] = $kodeprodi;
		if ($id == "") {
			redirect('biro/peserta');
		} else {
			$data['peserta'] = $this->db->query("SELECT * FROM tbl_peserta WHERE peserta_prodi = '$kodeprodi' AND YEAR(h_tanggal) = '$thn' ORDER BY peserta_kode ASC")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_peserta_1', $data);
			$this->load->view('biro/v_footer');
		}
	}

	function peserta_ver_tampil($id)
	{
		$this->load->database();
		$thn = substr($id, 0, 4);
		$kodeprodi = substr($id, 4);
		$data['thn'] = $thn;
		$data['kodeprodi'] = $kodeprodi;
		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_peserta p WHERE p.peserta_no_kk != '' AND YEAR(p.h_tanggal) = '$thn' AND p.peserta_prodi = '$kodeprodi' ORDER BY p.h_tanggal, p.h_waktu ASC")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_ver_1', $data);
		$this->load->view('biro/v_footer');
	}

	function peserta_ver_selesai($id)
	{
		$this->load->database();
		$thn = substr($id, 0, 4);
		$kodeprodi = substr($id, 4);
		$data['thn'] = $thn;
		$data['kodeprodi'] = $kodeprodi;
		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_peserta p WHERE p.peserta_status_verifikasi = 'oke' AND p.peserta_no_kk != '' AND YEAR(p.h_tanggal) = '$thn' AND p.peserta_prodi = '$kodeprodi' ORDER BY p.h_tanggal, p.h_waktu DESC")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_ver_2', $data);
		$this->load->view('biro/v_footer');
	}

	function peserta_ver_oke($id)
	{
		$this->load->database();
		$nim = substr($id, 0, 9);
		$thn = substr($id, 9, 4);
		$kodeprodi = substr($id, 13);
		$this->load->database();
		if ($id == "") {
			redirect('biro/peserta_ver');
		} else {
			//$nim = str_replace('-', '/', $id);
			$this->db->query("UPDATE tbl_peserta SET peserta_status_verifikasi = 'oke', peserta_status = 'Aktif', peserta_checklist = '04', peserta_nomor_ijazah = '01' WHERE peserta_kode = '$nim'");
			$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
			redirect('biro/peserta_ver_tampil/' . $thn . $kodeprodi . '?alert=user-verifikasi');
		}
	}

	function peserta_ver_batal($id)
	{
		$this->load->database();
		$nim = substr($id, 0, 9);
		$thn = substr($id, 9, 4);
		$kodeprodi = substr($id, 13);
		$this->load->database();
		if ($id == "") {
			redirect('biro/peserta_ver');
		} else {
			//$nim = str_replace('-', '/', $id);
			$this->db->query("UPDATE tbl_peserta SET peserta_status_verifikasi = '', peserta_status = 'Nonaktif', peserta_checklist = '04', peserta_nomor_ijazah = '01' WHERE peserta_kode = '$nim'");
			$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
			redirect('biro/peserta_ver_selesai/' . $thn . $kodeprodi . '?alert=update');
		}
	}

	function peserta_pesan_ver()
	{
		$this->load->database();
		$kodepeserta = $this->input->post('kodepeserta');
		//$namapeserta = $this->input->post('namapeserta');
		$namapeserta = strtoupper(str_replace(" ", "", $this->input->post('namapeserta')));
		$nomorpesan = $this->input->post('nomorpesan');
		$pesan = $this->input->post('pesan');
		$satu = "";
		$dua = "";
		$tiga = "";
		$satu = substr($namapeserta, 0, 3);
		$dua = substr($kodepeserta, -3);
		$tiga = $nomorpesan;
		$kodepesan = $satu . $dua . $tiga;
		$thn = $this->input->post('thn');
		$prodi_kode = $this->input->post('prodi_kode');
		$this->form_validation->set_rules('pesan', 'Pesan', 'required');
		if ($this->form_validation->run() != true) {
			redirect('biro/peserta_ver');
		} else {
			$data = array(
				'tp_kode' => $kodepesan,
				'tp_mahasiswa' => $kodepeserta,
				'tp_admin' => $this->session->userdata('uuser'),
				'tp_judul' => 'Pesan Konfirmasi Dari Admin',
				'tp_pesan' => $pesan,
				'tp_status_baca' => 'Belum Dibaca',
				'tp_lampiran' => '',
				'tp_tanggal' => date('Y-m-d'),
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);

			$this->M_vic->insert_data($data, 'tbl_pesan');
			//redirect('biro/peserta_ver/?alert=user-pesan');
			redirect('biro/peserta_ver_tampil/' . $thn . $prodi_kode . '?alert=user-pesan');
		}
	}

	//verifikasi
	function verifikasi($id)
	{
		$this->load->database();
		$prodi = substr($id, 0, -4);
		$thn = substr($id, 5);
		if ($id == '') {
			redirect('biro/verifikasi/0');
			//$thn = date('Y');
			$thn = '----- Pilih -----';
			$prodi = '----- Pilih -----';
		}
		$data['thn'] = $thn;
		$data['prodi'] = $prodi;
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();
		$where = array(
			'peserta_status' => "Nonaktif",
			'peserta_nomor_ijazah' => "",
			'peserta_keterangan_wisuda' => "Belum",
			'YEAR(h_tanggal)' => $thn,
			'peserta_prodi' => $prodi
		);
		$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
		//$data['peserta'] = $this->db->query("SELECT * FROM tbl_peserta WHERE peserta_prodi= '$prodi' AND peserta_status= 'Nonaktif' AND peserta_nomor_ijazah= '' AND peserta_keterangan_wisuda= 'Belum' AND YEAR(h_tanggal) = 2019")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_detail', $data);
		$this->load->view('biro/v_footer');
	}

	//aktivasi akun
	function aktivasi_akun($id)
	{
		$this->load->database();
		$prodi = substr($id, 0, -4);
		$thn = substr($id, 5);
		if ($id == '') {
			redirect('biro/aktivasi_akun/0');
			//$thn = date('Y');
			$thn = '----- Pilih -----';
			$prodi = '----- Pilih -----';
		}
		$data['thn'] = $thn;
		$data['prodi'] = $prodi;
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();
		$where = array(
			//'peserta_nomor_ijazah' => "",
			'peserta_keterangan_wisuda' => "Belum",
			'YEAR(h_tanggal)' => $thn,
			'peserta_prodi' => $prodi
		);
		$data['peserta'] = $this->M_vic->edit_data($where, 'tbl_peserta')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_aktivasi', $data);
		$this->load->view('biro/v_footer');
	}

	function peserta_aktif($id)
	{
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		$idinternal = substr($id, 3, -4);
		$prodi = mysqli_query($db, "SELECT prodi_kode FROM tbl_prodi WHERE prodi_kode_internal = '$idinternal'");
		$p = mysqli_fetch_array($prodi);
		//echo $p[0];
		//echo $idinternal;

		if ($id == '') {
			redirect('biro/aktivasi_akun/0');
		}
		$where = array('peserta_kode' => $id);
		$data = array('peserta_status' => 'Aktif');
		$this->M_vic->update_data($where, $data, 'tbl_peserta');
		//redirect('biro/aktivasi_akun/'.$p[0].'/?alert=aktif-add');
		redirect('biro/aktivasi_akun/' . $p[0] . '/?alert=aktif-add');
	}

	function peserta_nonaktif($id)
	{
		$db = $this->M_vic->panggil_db();
		$idinternal = substr($id, 3, -4);
		$prodi = mysqli_query($db, "SELECT prodi_kode FROM tbl_prodi WHERE prodi_kode_internal = '$idinternal'");
		$p = mysqli_fetch_array($prodi);
		//echo $p[0];
		//echo $idinternal;

		if ($id == '') {
			redirect('biro/aktivasi_akun/0');
		}
		$this->load->database();
		$where = array(
			'peserta_kode' => $id
		);
		$data = array(
			'peserta_status' => 'Nonaktif'
		);
		$this->M_vic->update_data($where, $data, 'tbl_peserta');
		redirect('biro/aktivasi_akun/' . $p[0] . '/?alert=aktif-add2');
	}

	function peserta_ijazah($id)
	{
		$this->load->database();
		$prodi = substr($id, 0, -4);
		$thn = substr($id, 5);
		if ($id == '') {
			redirect('biro/peserta_ijazah/0');
			//$thn = date('Y');
			$thn = '----- Pilih -----';
			$prodi = '----- Pilih -----';
		}
		$data['thn'] = $thn;
		$data['prodi'] = $prodi;
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();
		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_peserta p WHERE p.peserta_nomor_ijazah != '' AND YEAR(p.h_tanggal) = '$thn' AND p.peserta_prodi = '$prodi' ORDER BY p.h_tanggal, p.h_waktu DESC")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_peserta_ijazah', $data);
		$this->load->view('biro/v_footer');
	}

	//pesan
	function pesan()
	{
		$this->load->database();
		$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan GROUP BY tp_kode ORDER BY tp_id DESC")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_pesan', $data);
		$this->load->view('biro/v_footer');
	}

	function lihat_pesan($id)
	{
		$where = array('tp_kode' => $id);
		$data['pesan'] = $this->M_vic->edit_data($where, 'tbl_pesan')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_pesan_detail', $data);
		$this->load->view('biro/v_footer');
	}

	function pesan_add()
	{
		$this->load->database();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_pesan_add');
		$this->load->view('biro/v_footer');
	}

	function pesan_add_act()
	{
		$this->load->database();
		$kode = $this->input->post('kode');
		$kodepeserta = $this->input->post('kodepeserta');
		$namapeserta = strtoupper(str_replace(" ", "", $this->input->post('namapeserta')));
		//$nomorpesan = $this->input->post('nomorpesan');
		$auto = "001";
		$read = mysql_query("SELECT SUBSTR(tp_kode, 7, 3) FROM tbl_pesan WHERE tp_mahasiswa = '" . $kodepeserta . "' ORDER BY SUBSTR(tp_kode, 7, 3) DESC");
		if ($rec = mysql_fetch_array($read)) {
			$auto = $rec[0] + 1;
			if ($auto < 10) $auto = "0" . $auto;
			if ($auto < 100) $auto = "0" . $auto;
		}
		$nomorpesan = $auto;
		$satu = "";
		$dua = "";
		$tiga = "";
		$satu = substr($namapeserta, 0, 3);
		$dua = substr($kodepeserta, -3);
		$tiga = $nomorpesan;
		$kodepesan = $satu . $dua . $tiga;

		//$tujuan = $this->input->post('tujuan');
		$judul = $this->input->post('judul');
		$pesan_name = $this->input->post('pesan');
		$this->form_validation->set_rules('pesan', 'Nama pesan', 'required');
		$this->form_validation->set_rules('kodepeserta', 'Nomor Peserta', 'required');
		$this->form_validation->set_rules('namapeserta', 'Nama Peserta', 'required');
		if ($this->form_validation->run() != true) {
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan GROUP BY tp_kode ORDER BY tp_id DESC")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_pesan', $data);
			$this->load->view('biro/v_footer');
		} else {
			$data = array(
				'tp_kode' => $kodepesan,
				'tp_mahasiswa' => $kodepeserta,
				'tp_admin' => $this->session->userdata('uuser'),
				'tp_judul' => $judul,
				'tp_pesan' => $pesan_name,
				'tp_status_baca' => 'Belum Dibaca',
				'tp_tanggal' => date('Y-m-d'),
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);

			$this->M_vic->insert_data($data, 'tbl_pesan');
			redirect(base_url() . 'biro/pesan/?alert=user-pesan');
		}
	}

	function pesan_tampil($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/v_pesan');
		} else {
			$data = array(
				'tp_status_baca' => 'Dibaca'
			);
			$this->M_vic->update_data('tp_kode = "' . $id . '" AND h_pengguna = tp_mahasiswa', $data, 'tbl_pesan');

			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan WHERE tp_kode = '$id' GROUP BY tp_kode ORDER BY tp_id ASC")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_pesan_tampil', $data);
			$this->load->view('biro/v_footer');
		}
	}

	function pesan_balas_act()
	{
		$this->load->database();
		$kode = $this->input->post('kode');
		$tujuan = $this->input->post('tujuan');
		$judul = $this->input->post('judul');
		$pesan_name = $this->input->post('pesan');
		$this->form_validation->set_rules('pesan', 'Kirim Pesan', 'required');
		if ($this->form_validation->run() != true) {
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan WHERE tp_kode = '$kode' GROUP BY tp_kode ORDER BY tp_id ASC")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_pesan', $data);
			$this->load->view('biro/v_footer');
		} else {
			$data = array(
				'tp_kode' => $kode,
				'tp_mahasiswa' => $tujuan,
				'tp_admin' => $this->session->userdata('uuser'),
				'tp_judul' => $judul,
				'tp_pesan' => $pesan_name,
				'tp_status_baca' => 'Belum Dibaca',
				'tp_tanggal' => date('Y-m-d'),
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);

			$this->M_vic->insert_data($data, 'tbl_pesan');
			redirect(base_url() . 'biro/pesan/?alert=user-pesan');
		}
	}

	function pesan_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/pesan');
		} else {
			$where = array(
				'tp_kode' => $id
			);
			$this->M_vic->delete_data($where, 'tbl_pesan');
			redirect('biro/pesan/?alert=delete');
		}
	}

	//change password
	function ganti_password()
	{
		$this->load->database();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_ganti_password');
		$this->load->view('biro/v_footer');
	}

	function password_update()
	{
		$id = $this->input->post('id');
		$pass = $this->input->post('pass');
		$pass1 = $this->input->post('pass1');

		if ($pass == $pass1) {
			$where = array('peg_id' => $id);
			$data = array('peg_pass' => md5($pass));
			$this->M_vic->update_data($where, $data, 'tbl_pegawai');
			redirect('biro/ganti_password/?alert=ganti-pass');
		} else {
			redirect('biro/ganti_password?alert=gagal-pass');
		}
	}

	//cek_list
	function cek_list()
	{
		$this->load->database();
		$data['cek_list'] = $this->M_vic->get_data('tbl_cek_list')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_cek_list', $data);
		$this->load->view('biro/v_footer');
	}

	function cek_list_add()
	{
		$this->load->database();
		$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_cek_list_add', $data);
		$this->load->view('biro/v_footer');
	}

	function cek_list_add_act()
	{
		$this->load->database();
		$cek_list_kode = $this->input->post('cek_list_id');
		$cek_list_name = $this->input->post('cek_list');
		$cek_list_tittle = create_slug($cek_list_name);
		$count = $this->input->post('nomor');
		$cek_list_prodi = $this->input->post('prodi');
		$lamp1 = implode(",", $cek_list_prodi);
		$this->form_validation->set_rules('cek_list', 'Nama cek_list', 'required');
		if ($this->form_validation->run() != true) {
			$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_cek_list_add', $data);
			$this->load->view('biro/v_footer');
		} else {

			$data = array(
				'cek_list_id' => $cek_list_kode,
				'cek_list_nama' => $cek_list_name,
				'cek_list_tittle' => $cek_list_tittle,
				'cek_list_prodi' => $lamp1,
				'cek_list_status' => '0',
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);
			$this->M_vic->insert_data($data, 'tbl_cek_list');
			redirect('biro/cek_list/?alert=add');
			redirect(base_url() . 'biro/cek_list/?alert=add');
		}
	}

	function cek_list_edit($id)
	{
		$this->load->database();
		$where = array('cek_list_id' => $id);
		$data['edit'] = $this->M_vic->edit_data($where, 'tbl_cek_list')->result();
		$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_cek_list_edit', $data);
		$this->load->view('biro/v_footer');
	}

	function cek_list_update()
	{
		$this->load->database();
		$id = $this->input->post('cek_list_id');
		$cek_list_name = $this->input->post('cek_list');
		$cek_list_tittle = create_slug($cek_list_name);
		$count = $this->input->post('nomor');
		$cek_list_prodi = $this->input->post('prodi');
		$lamp1 = implode(",", $cek_list_prodi);
		$this->form_validation->set_rules('cek_list', 'Nama cek_list', 'required');
		if ($this->form_validation->run() != true) {
			$where = array(
				'cek_list_id' => $id
			);
			$data['edit'] = $this->m_dah->edit_data($where, 'tbl_cek_list')->result();
			$data['cek_list'] = $this->db->query("SELECT * FROM tbl_cek_list WHERE cek_list_id = '$id' ORDER BY cek_list_nama ASC")->result();
			$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_cek_list_edit', $data);
			$this->load->view('biro/v_footer');
		} else {
			$data = array(
				'cek_list_nama' => $cek_list_name,
				'cek_list_tittle' => $cek_list_tittle,
				'cek_list_prodi' => $lamp1,
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);

			$w = array(
				'cek_list_id' => $id
			);
			$this->M_vic->update_data($w, $data, 'tbl_cek_list');
			redirect(base_url() . 'biro/cek_list/?alert=update');
		}
	}

	function cek_list_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/cek_list');
		} else {
			$where = array(
				'cek_list_id' => $id
			);
			$this->M_vic->delete_data($where, 'tbl_cek_list');
			redirect('biro/cek_list/?alert=delete');
		}
	}

	//lampiran
	function lampiran()
	{
		$this->load->database();
		$data['lampiran'] = $this->M_vic->get_data('tbl_lampiran')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_lampiran', $data);
		$this->load->view('biro/v_footer');
	}

	function lampiran_add()
	{
		$this->load->database();
		$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_lampiran_add', $data);
		$this->load->view('biro/v_footer');
	}

	function lampiran_add_act()
	{
		$this->load->database();
		$lampiran_kode = $this->input->post('lampiran_id');
		$lampiran_name = $this->input->post('lampiran');
		$lampiran_format = $this->input->post('format');
		$lampiran_keperluan = $this->input->post('keperluan');
		$lampiran_tittle = create_slug($lampiran_name);
		$count = $this->input->post('nomor');
		$lampiran_prodi = $this->input->post('prodi');
		$lamp1 = implode(",", $lampiran_prodi);
		$this->form_validation->set_rules('lampiran', 'Nama lampiran', 'required');
		if ($this->form_validation->run() != true) {
			$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_lampiran_add', $data);
			$this->load->view('biro/v_footer');
		} else {

			$data = array(
				'lampiran_id' => $lampiran_kode,
				'lampiran_nama' => $lampiran_name,
				'lampiran_format' => $lampiran_format,
				'lampiran_keperluan' => $lampiran_keperluan,
				'lampiran_tittle' => $lampiran_tittle,
				'lampiran_prodi' => $lamp1,
				'lampiran_status' => '0',
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);
			$this->M_vic->insert_data($data, 'tbl_lampiran');
			redirect('biro/lampiran/?alert=add');
			redirect(base_url() . 'biro/lampiran/?alert=add');
		}
	}

	function lampiran_edit($id)
	{
		$this->load->database();
		$where = array('lampiran_id' => $id);
		$data['edit'] = $this->M_vic->edit_data($where, 'tbl_lampiran')->result();
		$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_lampiran_edit', $data);
		$this->load->view('biro/v_footer');
	}

	function lampiran_update()
	{
		$this->load->database();
		$id = $this->input->post('lampiran_id');
		$lampiran_name = $this->input->post('lampiran');
		$lampiran_format = $this->input->post('format');
		$lampiran_keperluan = $this->input->post('keperluan');
		$lampiran_tittle = create_slug($lampiran_name);
		$count = $this->input->post('nomor');
		$lampiran_prodi = $this->input->post('prodi');
		$lamp1 = implode(",", $lampiran_prodi);
		$this->form_validation->set_rules('lampiran', 'Nama lampiran', 'required');
		if ($this->form_validation->run() != true) {
			$where = array(
				'lampiran_id' => $id
			);
			$data['edit'] = $this->m_dah->edit_data($where, 'tbl_lampiran')->result();
			$data['lampiran'] = $this->db->query("SELECT * FROM tbl_lampiran WHERE lampiran_id = '$id' ORDER BY lampiran_nama ASC")->result();
			$data['jurusan'] = $this->db->query("SELECT * FROM tbl_prodi ORDER BY prodi_kode_internal")->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_lampiran_edit', $data);
			$this->load->view('biro/v_footer');
		} else {
			$data = array(
				'lampiran_nama' => $lampiran_name,
				'lampiran_format' => $lampiran_format,
				'lampiran_keperluan' => $lampiran_keperluan,
				'lampiran_tittle' => $lampiran_tittle,
				'lampiran_prodi' => $lamp1,
				'h_pengguna' => $this->session->userdata('uuser'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);

			$w = array(
				'lampiran_id' => $id
			);
			$this->M_vic->update_data($w, $data, 'tbl_lampiran');
			redirect(base_url() . 'biro/lampiran/?alert=update');
		}
	}

	function lampiran_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/lampiran');
		} else {
			$where = array(
				'lampiran_id' => $id
			);
			$this->M_vic->delete_data($where, 'tbl_lampiran');
			redirect('biro/lampiran/?alert=delete');
		}
	}

	// laporan
	function laporan()
	{
		$this->load->database();
		$this->load->view('biro/v_header');
		$this->load->view('biro/laporan/v_laporan');
		$this->load->view('biro/v_footer');
	}

	function laporan_wisuda_1($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_1/0');
			$sesi = '----- Pilih -----';
		}
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT DISTINCT * FROM tbl_jadwalwisuda ORDER BY jadwal_id DESC ")->result();

		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC ")->result();
		$data['fakultas'] = $this->M_vic->get_data('tbl_fakultas')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/laporan/v_laporan_wisuda1', $data);
		$this->load->view('biro/v_footer');
	}

	function laporan_wisuda_1_cetak($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_1/0');
			$sesi = '----- Pilih -----';
		}
		$data['db'] = $this->M_vic->panggil_db();
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$sesi' ")->result();

		$data['pages'] = $this->M_vic->get_data('tbl_cetak')->result();
		$data['pujian'] = $this->db->query("SELECT * FROM v_alumni_predikat WHERE mhs_sesi_wisuda = '$sesi' AND peserta_predikat = 'Dengan Pujian' ")->result();
		$data['fakultas'] = $this->db->query("SELECT fakultas_id, fakultas_nama, mhs_sesi_wisuda FROM tbl_alumni, tbl_fakultas WHERE mhs_fakultas = fakultas_id AND mhs_sesi_wisuda = '$sesi' GROUP BY mhs_fakultas ORDER BY fakultas_id ASC")->result();
		$this->load->view('biro/laporan/v_laporan_wisuda1_pdf', $data);
	}

	function laporan_wisuda_1_cetakdata($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_1/0');
			$sesi = '----- Pilih -----';
		}
		$data['db'] = $this->M_vic->panggil_db();
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$sesi' ")->result();

		$data['pujian'] = $this->db->query("SELECT * FROM v_alumni_predikat WHERE mhs_sesi_wisuda = '$sesi' AND peserta_predikat = 'Dengan Pujian' ")->result();
		$data['fakultas'] = $this->db->query("SELECT fakultas_id, fakultas_nama, mhs_sesi_wisuda FROM tbl_alumni, tbl_fakultas WHERE mhs_fakultas = fakultas_id AND mhs_sesi_wisuda = '$sesi' GROUP BY mhs_fakultas ORDER BY fakultas_id ASC")->result();
		$this->load->view('biro/laporan/v_laporan_wisuda1_datapdf', $data);

		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Data Wisuda" . $sesi . ".pdf", array('Attachment' => 0));
	}

	function laporan_wisuda_1_excel($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_1/0');
			$sesi = '----- Pilih -----';
		}
		$data['db'] = $this->M_vic->panggil_db();
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$sesi' ")->result();

		$data['fakultas'] = $this->M_vic->get_data('tbl_fakultas')->result();
		$this->load->view('biro/laporan/v_laporan_wisuda1_excel', $data);
	}

	function laporan_wisuda_2($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_2/0');
			$sesi = '----- Pilih -----';
		}
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT DISTINCT * FROM tbl_jadwalwisuda ORDER BY jadwal_id DESC ")->result();

		//$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC ")->result();
		$data['fakultas'] = $this->db->query("SELECT DISTINCT * FROM tbl_fakultas ORDER BY fakultas_id ASC ")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/laporan/v_laporan_wisuda2', $data);
		$this->load->view('biro/v_footer');
	}

	function laporan_wisuda_1_excelbiodata($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_1/0');
			$sesi = '----- Pilih -----';
		}
		$data['db'] = $this->M_vic->panggil_db();
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$sesi' ")->result();

		$data['fakultas'] = $this->M_vic->get_data('tbl_fakultas')->result();
		$this->load->view('biro/laporan/v_laporan_wisuda1_excelbiodata', $data);
	}

	function laporan_wisuda_2_pdf($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_2/0');
			$sesi = '----- Pilih -----';
		}
		$data['sesi'] = $sesi;
		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC ")->result();
		$data['fakultas'] = $this->db->query("SELECT DISTINCT * FROM tbl_fakultas ORDER BY fakultas_id ASC ")->result();
		$this->load->view('biro/laporan/v_laporan_wisuda2_pdf', $data);
	}

	function laporan_wisuda_2_excel($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_2/0');
			$sesi = '----- Pilih -----';
		}
		$data['db'] = $this->M_vic->panggil_db();
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT DISTINCT * FROM tbl_jadwalwisuda WHERE jadwal_id = '$sesi' ")->result();
		$data['fakultas'] = $this->db->query("SELECT DISTINCT * FROM tbl_fakultas ORDER BY fakultas_id ASC ")->result();
		$this->load->view('biro/laporan/v_laporan_wisuda2_excel', $data);
	}

	function laporan_wisuda_3($id)
	{
		$this->load->database();
		$sesi = substr($id, 0, 6);
		$predikat = substr($id, 6);
		if ($id == '') {
			redirect('biro/laporan_wisuda_3/0');
			$sesi = '----- Pilih -----';
			$predikat = '----- Pilih -----';
		}
		$data['db'] = $this->M_vic->panggil_db();
		$data['sesi'] = $sesi;
		$data['predikat'] = $predikat;
		//echo $sesi.' '.$predikat;
		$pred = str_replace('_', ' ', $predikat);
		$data['sesi_wisuda'] = $this->db->query("SELECT DISTINCT * FROM tbl_jadwalwisuda ORDER BY jadwal_id DESC ")->result();

		$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND p.peserta_predikat = '$pred' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC ")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/laporan/v_laporan_wisuda3', $data);
		$this->load->view('biro/v_footer');
	}

	function laporan_wisuda_4($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_wisuda_4/0');
			$sesi = '----- Pilih -----';
		}
		$data['db'] = $this->M_vic->panggil_db();
		$data['sesi'] = $sesi;
		$data['thn'] = substr($sesi, 0, 4);
		$data['sesi_wisuda'] = $this->db->query("SELECT DISTINCT * FROM tbl_jadwalwisuda ORDER BY jadwal_id DESC ")->result();

		//$data['peserta'] = $this->db->query("SELECT DISTINCT * FROM tbl_alumni a, tbl_peserta p WHERE a.mhs_nim = p.peserta_kode AND a.mhs_sesi_wisuda = '$sesi' AND p.peserta_predikat = '$pred' ORDER BY mhs_prodi ASC, mhs_jenis_kelamin ASC, mhs_no_wisuda ASC ")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/laporan/v_laporan_wisuda4', $data);
		$this->load->view('biro/v_footer');
	}




	function laporan_ekportfoto($id)
	{
		$this->load->database();
		$sesi = $id;
		if ($id == '') {
			redirect('biro/laporan_ekportfoto/0');
			$sesi = '----- Pilih -----';
		}
		$data['sesi'] = $sesi;
		$data['sesi_wisuda'] = $this->db->query("SELECT DISTINCT * FROM tbl_jadwalwisuda ORDER BY jadwal_id DESC ")->result();
		$data['fakultas'] = $this->db->query("SELECT DISTINCT * FROM tbl_fakultas ORDER BY fakultas_id ASC ")->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/laporan/v_laporan_wisuda99', $data);
		$this->load->view('biro/v_footer');
	}


	//page cetak
	public function page()
	{
		$this->load->database();
		$data['pages'] = $this->M_vic->get_data('tbl_cetak')->result();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_page', $data);
		$this->load->view('biro/v_footer');
	}

	public function page_cetak()
	{
		$this->load->database();
		$data['pages'] = $this->M_vic->get_data('tbl_cetak')->result();
		$this->load->view('biro/laporan/v_cetak', $data);
	}

	function page_add()
	{
		$this->load->database();
		$this->load->view('biro/v_header');
		$this->load->view('biro/v_page_add');
		$this->load->view('biro/v_footer');
	}

	function page_add_act()
	{
		$this->load->database();
		$page_tittle = $this->input->post('page_tittle');
		$page_content = $this->input->post('page_content');
		$url = create_slug($page_tittle);
		$data = array(
			'page_tittle' => $page_tittle,
			'page_url' => $url,
			'page_content' => $page_content,
			'page_status' => 'Publish',
			'h_pengguna' => 'test_user',
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:sa"),
			'h_ip' => $_SERVER['REMOTE_ADDR']
		);
		$this->M_vic->insert_data($data, 'tbl_cetak');
		redirect(base_url() . 'biro/page/?alert=add');
	}

	function page_delete($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/page');
		} else {
			$where = array('page_id' => $id);
			$this->M_vic->delete_data($where, 'tbl_cetak');
			redirect('biro/page/?alert=delete');
		}
	}

	function page_edit($id)
	{
		$this->load->database();
		if ($id == "") {
			redirect('biro/page');
		} else {
			$where = array(
				'page_id' => $id
			);
			$data['pages'] = $this->M_vic->edit_data($where, 'tbl_cetak')->result();
			$this->load->view('biro/v_header');
			$this->load->view('biro/v_page_edit', $data);
			$this->load->view('biro/v_footer');
		}
	}

	function page_update()
	{
		$this->load->database();
		$page_id = $this->input->post('id');
		$page_tittle = $this->input->post('page_tittle');
		$page_content = $this->input->post('page_content');
		$page_status = 'Publish';
		$where = array('page_id' => $page_id);
		$url = create_slug($page_tittle);
		$data = array(
			'page_tittle' => $page_tittle,
			'page_url' => $url,
			'page_content' => $page_content,
			'page_status' => $page_status,
			'h_pengguna' => 'test_user',
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:sa"),
			'h_ip' => $_SERVER['REMOTE_ADDR']
		);
		$this->M_vic->update_data($where, $data, 'tbl_cetak');
		redirect(base_url() . 'biro/page/?alert=update');
	}
}
