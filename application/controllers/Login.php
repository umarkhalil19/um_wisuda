<?php
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_data');
		$this->load->model('M_vic');
		$this->load->helper('Vic_helper');
		$this->load->library(array('session', 'form_validation'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index()
	{
		//$this->load->view('v_login');
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->library('session');
		$random_number = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
		$vals = array(
			'word' => $random_number,
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'img_width' => 160,
			'img_height' => 32,
			//'expiration' => 7200
			'expiration' => 25
		);
		$data['captcha'] = create_captcha($vals);
		$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		//$this->session->set_flashdata('msgoke','Pendaftaran Sukses. <br> Username = 130510109; Password = 1995-03-08');
		$this->load->view('v_login', $data);
	}

	function cek_login($uname, $aktif, $s1, $data_mhs, $cekdata2)
	{
		//$nim = [150170049,191100410020];
		$nim = [191100410020];
		if (in_array($uname, $nim)) {
			if (mysqli_num_rows($cekdata2) > 0) {
				if ($data_mhs > 0) {
					redirect('wisuda');
				} else {
					$this->session->set_flashdata('msg', 'Tidak dapat login, anda belum memiliki Nomor SK Yudisium');
					redirect(base_url() . 'login');
				}
			} else {
				$this->session->set_flashdata('msgsesi', strtoupper(' Data Ijazah Anda Belum Di Verifikasi '));
				redirect(base_url() . 'login');
			}
		} else {
			if ($aktif <= 0) {
				$this->session->set_flashdata('msgsesi', strtoupper($s1['set_keterangan']));
				redirect(base_url() . 'login');
			} else {
				if (mysqli_num_rows($cekdata2) > 0) {
					if ($data_mhs > 0) {
						redirect('wisuda');
					} else {
						$this->session->set_flashdata('msg', 'Tidak dapat login, anda belum memiliki Nomor SK Yudisium');
						redirect(base_url() . 'login');
					}
				} else {
					$this->session->set_flashdata('msgsesi', strtoupper(' Data Ijazah Anda Belum Di Verifikasi '));
					redirect(base_url() . 'login');
				}
			}
		}
	}

	function cek()
	{
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		$username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha');
		$userCaptcha = $this->input->post('userCaptcha');

		$tgl_sekarang = date('Y-m-d');
		$wkt_sekarang = date("H:i:s");
		$set0 = mysqli_query($db, "SELECT * FROM tbl_jadwalbuka WHERE ('$tgl_sekarang' BETWEEN set_tanggal_buka AND set_tanggal_tutup) AND set_status = 'Aktif' AND set_id = '1'");
		$aktif = mysqli_num_rows($set0);
		$set1 = mysqli_query($db, "SELECT * FROM tbl_jadwalbuka WHERE set_id = '1'");
		$s1 = mysqli_fetch_array($set1);

		if ($this->form_validation->run() != true) {
			redirect('login');
		} else {
			$uname = $this->input->post('username');
			$pass = md5($this->input->post('password'));
			$where = array(
				'peg_user' => $uname,
				'peg_pass' => $pass,
				'peg_status' => 'Aktif'
			);
			$data = $this->M_vic->edit_data($where, 'tbl_pegawai');
			if ($data->num_rows() > 0) {
				$mydata = $data->row();
				$session = array(
					'uid' => $mydata->peg_id,
					'unip' => $mydata->peg_nip,
					'unama' => $mydata->peg_nama,
					'uuser' => $mydata->peg_user,
					'ulvl' => $mydata->peg_level,
					'ubag' => $mydata->peg_bagian,
					'usub' => $mydata->peg_subbagian,
					'ujab' => $mydata->peg_jabatan,
					'peg_status' => 'biro'
				);
				$this->session->set_userdata($session);
				redirect('biro');
			} else {
				//redirect(base_url().'login');
				$where = array(
					'peserta_kode' => $uname,
					'peserta_pass' => $pass,
					'peserta_status' => 'Nonaktif'
				);
				$data = $this->M_vic->edit_data($where, 'tbl_peserta');
				if ($data->num_rows() > 0) {

					$status_sk = $this->db->select('mhs_nosk_yudisium')->from('tbl_mahasiswa')->where('mhs_nim', $uname)->get()->row();

					if ($aktif <= 0) {
						$this->session->set_flashdata('msgsesi', strtoupper($s1['set_keterangan']));
						redirect(base_url() . 'login');
					}

					if ($status_sk->mhs_nosk_yudisium == '') {
						$this->session->set_flashdata('msg', 'Tidak dapat login, anda belum memiliki Nomor SK Yudisium');
						redirect(base_url() . 'login');
					}

					$mydata = $data->row();
					$session = array(
						'uid' => $mydata->peserta_kode,
						'unama' => $mydata->peserta_nama,
						'ulahir' => $mydata->peserta_tanggal_lahir,
						'ufak' => $mydata->peserta_fakultas,
						'ujur' => $mydata->peserta_prodi,
						'uver' => $mydata->peserta_status_verifikasi,
						'status' => 'mhs'
					);
					$this->session->set_userdata($session);
					redirect('wisuda');
				} else {
					$this->session->set_flashdata('msg', 'Username atau Password salah!!!');
					redirect(base_url() . 'login');
				}
			}
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		$url = base_url('');
		redirect($url);
	}

	function check_captcha($str)
	{
		$word = $this->session->userdata('captchaWord');
		if (strcmp(strtoupper($str), strtoupper($word)) == 0) {
			return true;
		} else {
			$this->form_validation->set_message('check_captcha', 'Please enter correct words!');
			return false;
		}
	}
}
