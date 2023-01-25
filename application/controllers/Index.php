<?php
class index extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_data');
		$this->load->model('M_vic');
		$this->load->helper("Vic_convert");
		$this->load->helper('Vic_helper');
		$this->load->library(array('session','form_validation'));
        //$this->load->library(array('form_validation', 'Recaptcha'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index()
	{
		redirect(base_url().'login');
	}

	function registrasi()
	{
		$this->load->database();
		$data['fakultas'] = $this->M_vic->get_data('tbl_fakultas')->result();
		$data['jurusan'] = $this->M_vic->get_data('tbl_prodi')->result();
		$this->load->view('v_registrasi',$data);
	}

	function registrasi_act()
	{
		$nim = $this->input->post('nim');
		$nama = $this->input->post('nama');
		// $kelas = $this->input->post('kelas');
		//$fakultas = $this->input->post('fakultas');
		$prodi = $this->input->post('prodi');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		// $tanggal_masuk = $this->input->post('tanggal_masuk');
		// $tanggal_keluar = $this->input->post('tanggal_keluar');
		// $lama_studi = $this->input->post('lama_studi');
		//$lama_studi = '';
		//if(G4="";"";if(H4="";"";date_diff(G4;H4;"y")&" Tahun "&date_diff(G4;H4;"ym")&" Bulan"))
		// $tanggal_awal = date_create($tanggal_masuk);
		// $tanggal_akhir = date_create($tanggal_keluar);
		//$diff  = date_diff($tanggal_masuk, $tanggal_keluar);
		// $diff  = date_diff($tanggal_awal, $tanggal_akhir);
		// if($tanggal_masuk == "" || $tanggal_keluar == ""){
		// 	$lama_studi = '';
		// }else{
		// 	$lama_studi = $diff->y.' Tahun '.$diff->m.' Bulan';
		// }
		//echo $lama_studi;
		$jenis_keluar = 'Lulus';
		// $nosk_yudisium = $this->input->post('nosk_yudisium');
		// $tanggal_yudisium = $this->input->post('tanggal_yudisium');
		// $ipk = $this->input->post('ipk');
		// $nomor_ijazah = $this->input->post('nomor_ijazah');
		// $nomor_blanko = $this->input->post('nomor_blanko');
		// $judul_skripsi = $this->input->post('judul_skripsi');
		// $jumlah_sks = $this->input->post('jumlah_sks');
		// $predikat = $this->input->post('predikat');
		// $awal_bimbingan = $this->input->post('awal_bimbingan');
		// $akhir_bimbingan = $this->input->post('akhir_bimbingan');
		// $semester_lulus = $this->input->post('semester_lulus');
		//$keterangan_wisuda = $this->input->post('keterangan_wisuda');
		$keterangan_wisuda = 'Belum';
		
		$db = $this->M_vic->panggil_db();
		$read=mysqli_query($db, "SELECT COUNT(peserta_kode) FROM tbl_peserta WHERE peserta_kode ='$nim'");
		  $r = mysqli_fetch_array($read);
  	$read1=mysqli_query($db, "SELECT * FROM tbl_prodi WHERE prodi_kode ='$prodi'");
		  $r1 = mysqli_fetch_array($read1);
		  $fakultas = $r1['prodi_fakultas'];

		$data = array(
			'peserta_kode'=>$nim, 
			'peserta_nama'=>$nama,
			'peserta_fakultas' => $fakultas,
			'peserta_prodi' => $prodi,
			'peserta_jenis_kelamin' => $jenis_kelamin,
			'peserta_pass' => md5($tanggal_lahir),
			'peserta_status' =>'Nonaktif',
			'peserta_kelas' => '',
			'peserta_tahun_masuk' => '20'.substr($nim, 0, 2),
			'peserta_tempat_lahir' => $tempat_lahir,
			'peserta_tanggal_lahir' => $tanggal_lahir,
			// 'peserta_tanggal_masuk' => date('Y-m-d', strtotime($this->input->post('tanggal_masuk'))),
			// 'peserta_tanggal_keluar' => date('Y-m-d', strtotime($this->input->post('tanggal_keluar'))),
			// 'peserta_tanggal_sidang' => date('Y-m-d', strtotime($this->input->post('tanggal_keluar'))),
			// 'peserta_lama_studi' => $lama_studi,
			'peserta_jenis_keluar' => $jenis_keluar,
			// 'peserta_nosk_yudisium' => $nosk_yudisium,
			// 'peserta_tanggal_yudisium' =>date('Y-m-d',strtotime($this->input->post('tanggal_yudisium'))),
			// 'peserta_ipk' => $ipk,
			// 'peserta_nomor_ijazah' => $nomor_ijazah,
			// 'peserta_nomor_blanko' => $nomor_blanko,
			// 'peserta_judul_skripsi' => $judul_skripsi,
			// 'peserta_jumlah_sks' => $jumlah_sks,
			// 'peserta_predikat' => $predikat,
			// 'peserta_awal_bimbingan' => $awal_bimbingan,
			// 'peserta_akhir_bimbingan' => $akhir_bimbingan,
			// 'peserta_semester_lulus' => $semester_lulus,
			'peserta_keterangan_wisuda' => $keterangan_wisuda,
			'peserta_checklist' => '01',
			'h_pengguna' => $nim,
			'h_tanggal' => date('Y-m-d'),
			'h_waktu' => date("h:i:s")
		);
		if($r[0] > 0){
			redirect('index/registrasi/?alert=user-duplikat');
		}else{
			$data3 = array(
				'acak_nilai' => $nim,
				'acak_kata' => vicencrypt($tanggal_lahir),
				'h_pengguna' => $nim,
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);
			$this->M_vic->insert_data($data,'tbl_peserta');
			$this->M_vic->insert_data($data3,'tbl_vicacak');
			$this->session->set_flashdata('msgoke','Pendaftaran Sukses. <br> Username = '.$nim.'; Password = '.$tanggal_lahir);
			redirect(base_url().'login');
		}

	}



}