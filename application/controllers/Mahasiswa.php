<?php
class Mahasiswa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','Vic_helper'));
		$this->load->helper("Vic_convert");
		$this->load->model('M_vic');
		$this->load->model('M_data');
        $this->load->library("PHPExcel");
        $this->load->model("phpexcel_model");
		$this->load->library(array('session','form_validation','user_agent'));
		
		//$this->session->set_flashdata('msg','Kuota sudah penuh, pendaftan wisuda angkatan XXIX sudah ditutup');
		//redirect(base_url().'login');
		
		date_default_timezone_set('Asia/Jakarta');
		if ($this->session->userdata('status') != "mhs") {
			redirect('login');
		}
	}

	function index()
	{
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		  $id = $this->session->userdata('uid');
		  $ulahir = $this->session->userdata('ulahir');
		  $pes = mysqli_query($db, "SELECT peserta_pass FROM tbl_peserta WHERE peserta_kode = '$id'");
		  $p = mysqli_fetch_array ($pes);
		  $data['psw'] = 'ganti';
		  if ($p[0] == md5($ulahir)) {
		    $data['psw'] = 'ganti';
		  }else{
		  	$data['psw'] = 'oke';
		  }
		$this->load->view('mahasiswa/v_header', $data);
		$this->load->view('mahasiswa/v_home', $data);
		$this->load->view('mahasiswa/v_footer');
	}

	//biodata
	function biodata()
	{
		$data['psw'] = 'oke';
		$where = array('peserta_kode' => $this->session->userdata('uid'));
		$data['peserta'] = $this->M_vic->edit_data($where,'tbl_peserta')->result();
		$this->load->view('mahasiswa/v_header',$data);
		$this->load->view('mahasiswa/v_biodata',$data);
		$this->load->view('mahasiswa/v_footer');
	}

	function biodata_update()
	{
		$id = $this->session->userdata('uid');
		$nama = $this->input->post('nama');
		$kk = $this->input->post('kk');
		$ktp = $this->input->post('ktp');		
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$telepon = $this->input->post('telepon');
		$email = $this->input->post('email');
		$agama = $this->input->post('agama');
		$alamat = $this->input->post('alamat');
		$provinsi = $this->input->post('provinsi');
		$kabupaten = $this->input->post('kabupaten');
		$kecamatan = $this->input->post('kecamatan');
		$tahun_masuk = $this->input->post('tahun_masuk');
		$ayah = $this->input->post('ayah');
		$ibu = $this->input->post('ibu');
		$sekolah = $this->input->post('sekolah_asal');
		$kelas = '';
		$ipk = $this->input->post('ipk');
		$tanggal_keluar = $this->input->post('tanggal_keluar');
		$skripsi = $this->input->post('skripsi');
		//$tanggal_masuk = $this->input->post('tanggal_masuk');
		$awal_bimbingan = $this->input->post('awal_bimbingan');
		$akhir_bimbingan = $this->input->post('akhir_bimbingan');
		//$ijazah = '$this->input->post('ijazah')';

		$where = array('peserta_kode'=> $id);
		$data = array(
			'peserta_nama' => $nama,
			'peserta_jenis_kelamin' => $jenis_kelamin,
			'peserta_tempat_lahir' => $tempat_lahir,
			'peserta_tanggal_lahir' => $tgl_lahir,
			'peserta_provinsi' => $provinsi,
			'peserta_kabupaten' => $kabupaten,
			'peserta_kecamatan' => $kecamatan,
			'peserta_alamat' => $alamat,
			'peserta_sekolah_asal' => $sekolah,
			'peserta_telepon' => $telepon,
			'peserta_email' => $email,
			'peserta_agama' => $agama,
			'peserta_tahun_masuk' => $tahun_masuk,
			'peserta_ayah' => $ayah,
			'peserta_ibu' => $ibu,
			'peserta_no_kk' => $kk,
			'peserta_no_ktp' => $ktp,
			'peserta_kelas' => $kelas,
			'peserta_ipk' => $ipk,
			'peserta_tanggal_sidang' => $tanggal_keluar,
			'peserta_judul_skripsi' => $skripsi,
			'peserta_checklist' => "02"
		);
		$this->M_vic->update_data($where,$data,'tbl_peserta');

		redirect('mahasiswa/lampiran_add');

	}

	//ganti_password
	function password()
	{
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		  $id = $this->session->userdata('uid');
		  $ulahir = $this->session->userdata('ulahir');
		  $pes = mysqli_query($db, "SELECT peserta_pass FROM tbl_peserta WHERE peserta_kode = '$id'");
		  $p = mysqli_fetch_array ($pes);
		  $data['psw'] = 'ganti';
		  if ($p[0] == md5($ulahir)) {
		    $data['psw'] = 'ganti';
		  }else{
		  	$data['psw'] = 'oke';
		  }
		$this->load->view('mahasiswa/v_header', $data);
		$this->load->view('mahasiswa/v_ganti_password');
		$this->load->view('mahasiswa/v_footer');
	}

	function password_update()
	{
		$id = $this->input->post('id');
		$pass = $this->input->post('pass');
		$pass1 = $this->input->post('pass1');

		if ($pass == $pass1) {
			$where = array('peserta_kode'=>$id);
			$data = array('peserta_pass'=> md5($pass));
			$this->M_vic->update_data($where,$data,'tbl_peserta');
			
			$data3 = array(
				'acak_nilai' => $id,
				'acak_kata' => vicencrypt($pass),
				'h_pengguna' => $this->session->userdata('uid'),
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
			);
			$this->M_vic->insert_data($data3,'tbl_vicacak');

			redirect('mahasiswa');
		}else{
			redirect('mahasiswa/password');
		}
	}

	//selcet ajax
	function kabupaten()
	{
		$id=$this->input->post('id');
		// $where = array('kota_provinsi'=>$id);
		// $data=$this->M_vic->edit_data($where,'tbl_daerah')->result();
		$data = $this->db->query("SELECT DISTINCT kota_kabupaten FROM tbl_daerah WHERE kota_provinsi = '$id'")->result();
		echo json_encode($data);
	}

	function kecamatan()
	{
		$id=$this->input->post('id');
		$data = $this->db->query("SELECT DISTINCT kota_kecamatan FROM tbl_daerah WHERE kota_kabupaten = '$id'")->result();
		echo json_encode($data);
	}

	//lampiran
	function lampiran()
	{
		$this->load->database();
		$where = array('peserta_kode' => $this->session->userdata('uid'));
		$data['lampiran'] = $this->M_vic->edit_data($where,'tbl_peserta_lampiran')->result();
		$data['psw'] = 'oke';
		$this->load->view('mahasiswa/v_header',$data);
		$this->load->view('mahasiswa/v_lampiran',$data);
		$this->load->view('mahasiswa/v_footer');
	}

	function lampiran_add()
	{
		// $data['psw'] = 'oke';
		// $this->load->view('mahasiswa/v_header',$data);
		// $this->load->view('mahasiswa/v_lampiran_tambah');
		// $this->load->view('mahasiswa/v_footer');
		$this->load->database();
		$id = $this->session->userdata('uid');
		if($id==""){
			redirect('mahasiswa/logout');
		}else{
			$where = array(
				'peserta_kode' => $id,
			);
			$data['edit'] = $this->M_vic->edit_data($where,'tbl_peserta')->result();
			$data['peserta'] = $this->M_vic->get_data_order('ASC', 'peserta_nama, peserta_kode', 'tbl_peserta')->result();
			$data['psw'] = 'oke';
			$this->load->view('mahasiswa/v_header', $data);
			$this->load->view('mahasiswa/v_lampiran_tambah',$data);
			$this->load->view('mahasiswa/v_footer');
		}
	}

	function lampiran_add_act()
	{
		$this->load->database();
		$id = $this->session->userdata('uid');
		$peserta_prodi = $this->input->post('peserta_prodi');
		$peserta_lampiran = $this->input->post('filedata');
		$peserta_lamp_kode = $this->input->post('lamp_kode');
		$peserta_lamp_nama = $this->input->post('lamp_nama');
		$peserta_lamp_format = $this->input->post('lamp_format');

        $db = $this->M_vic->panggil_db();
		$res2=mysqli_query($db, "SELECT COUNT(*) FROM tbl_peserta_lampiran WHERE peserta_kode = '$id' AND peserta_lamp_kode = '$peserta_lamp_kode' ");
		$rs2=mysqli_fetch_array($res2);
		if($rs2[0] > 0){
			$where = array(
				'peserta_kode' =>  $id,
				'peserta_lamp_kode' =>  $peserta_lamp_kode
			);
			$data = $this->M_vic->edit_data($where,'tbl_peserta_lampiran')->row();
			@chmod("./dokumen/lampiran/" . $data->peserta_lampiran, 0777);
			@unlink('./dokumen/lampiran/' . $data->peserta_lampiran);
			$this->M_vic->delete_data($where,'tbl_peserta_lampiran');
		}
		//$maxsize1 = 1024 * 301; // maksimal 300 KB (1KB = 1024 Byte)
		$maxsize1 = 507200;
		$format_lamp1 = substr($_FILES['filedata']['name'], -3);
		$format_lamp2 = '';
		if($format_lamp1 == 'jpg' || $format_lamp1 == 'JPG' || $format_lamp1 == 'peg' || $format_lamp1 == 'PEG' || $format_lamp1 == 'png' || $format_lamp1 == 'PNG' || $format_lamp1 == 'gif' || $format_lamp1 == 'GIF'){
			$format_lamp2 = 'jpg';
		}elseif($format_lamp1 == 'pdf' || $format_lamp1 == 'PDF'){
			$format_lamp2 = 'pdf';
		}else{
			$format_lamp2 = '';
		}
		//if($format_lampiran == $peserta_lamp_format){
		if($format_lamp2 == $peserta_lamp_format){
			if($_FILES['filedata']['name'] == ""){
				redirect(base_url().'mahasiswa/lampiran_add');
			}elseif($_FILES['filedata']['size'] > $maxsize1){
				redirect(base_url().'mahasiswa/lampiran_add');
			}elseif($_FILES['filedata']['type'] == ""){
				redirect(base_url().'mahasiswa/lampiran_add');
			}else{
				$config['upload_path'] = './dokumen/lampiran/';
				$config['file_name'] = $id.'-'.rand();
				if($peserta_lamp_format == 'jpg'){
					$config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF';
				}elseif($peserta_lamp_format == 'pdf'){
					$config['allowed_types'] = 'pdf|PDF';
				}
				$config['max_size'] = 307200;
				$this->load->library('upload', $config);
				$this->upload->do_upload('filedata');
				$data = array('upload_data' => $this->upload->data());
				$file_name = $data['upload_data']['file_name'];

				$data = array(
					'peserta_kode' => $id,
					'peserta_prodi' => $peserta_prodi,
					'peserta_lampiran' => $file_name,
					'peserta_lamp_kode' => $peserta_lamp_kode,
					'peserta_lamp_nama' => $peserta_lamp_nama,
					'peserta_lamp_format' => $peserta_lamp_format,
					'h_pengguna' => $this->session->userdata('uid'),
					'h_tanggal' => date('Y-m-d'),
					'h_waktu' => date("h:i:sa")
					);
				$this->M_vic->insert_data($data,'tbl_peserta_lampiran');
				redirect(base_url().'mahasiswa/lampiran_add/?alert=upload-sukses');
			}
		}else{
			redirect(base_url().'mahasiswa/lampiran_add');
		}


	}

	//pesan
	function pesan(){
		$this->load->database();
		$id = $this->session->userdata('uid');
		if($id == ""){
			redirect('mahasiswa/v_pesan');
		}else{
			$where = array(
				'tp_mahasiswa' => $id
				);
			//$data['pesan'] = $this->M_vic->edit_data($where,'tbl_pesan')->result();
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan WHERE tp_mahasiswa = '$id' GROUP BY tp_kode ORDER BY tp_id DESC")->result();
			$data['psw'] = 'oke';
			$this->load->view('mahasiswa/v_header', $data);
			$this->load->view('mahasiswa/v_pesan',$data);
			$this->load->view('mahasiswa/v_footer');
		}
	}

	function pesan_add(){
		$this->load->database();
		$id = $this->session->userdata('uid');
		if($id == ""){
			redirect('mahasiswa/v_pesan');
		}else{
			$data['psw'] = 'oke';
			$this->load->view('mahasiswa/v_header', $data);
			$this->load->view('mahasiswa/v_pesan_add');
			$this->load->view('mahasiswa/v_footer');
		}
	}

	function pesan_add_act(){
		$this->load->database();
		$id = $this->session->userdata('uid');
		//$kode = $this->input->post('kode');
		$kodepeserta = $this->input->post('kodepeserta');
		$namapeserta = strtoupper(str_replace(" ", "", $this->input->post('namapeserta')));
		$nomorpesan = $this->input->post('nomorpesan');
		$satu = ""; $dua = ""; $tiga = "";
		$satu = substr($namapeserta, 0, 3);
		$dua = substr($kodepeserta, -3);
		$tiga = $nomorpesan;
		$kodepesan = $satu.$dua.$tiga;

		$tujuan = $this->input->post('tujuan');
		$judul = $this->input->post('judul');
		$pesan_name = $this->input->post('pesan');
		$this->form_validation->set_rules('pesan','Kirim Pesan','required');
		if($this->form_validation->run() != true){
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan WHERE tp_mahasiswa = '$id' GROUP BY tp_kode ORDER BY tp_id DESC")->result();
			$this->load->view('mahasiswa/v_header');
			$this->load->view('mahasiswa/v_pesan',$data);
			$this->load->view('mahasiswa/v_footer');
		}else{
			$data = array(
				'tp_kode' => $kodepesan,
				'tp_mahasiswa' => $id,
				'tp_admin' => $tujuan,
				'tp_judul' => $judul,
				'tp_pesan' => $pesan_name,
				'tp_status_baca' => 'Belum Dibaca',
				'tp_tanggal' => date('Y-m-d'),
				'h_pengguna' => $id,
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
				);

			$this->M_vic->insert_data($data,'tbl_pesan');
			redirect(base_url().'mahasiswa/pesan/?alert=user-pesan');
		}
	}

	function pesan_tampil($id){
		$this->load->database();
		if($id == ""){
			redirect('mahasiswa/v_pesan');
		}else{
			$data = array(
				'tp_status_baca' => 'Dibaca'
				);
			$this->M_vic->update_data('tp_kode = "'.$id.'" AND h_pengguna != tp_mahasiswa', $data, 'tbl_pesan');

			//$data['pesan'] = $this->M_vic->edit_data($where,'tbl_pesan')->result();
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan WHERE tp_kode = '$id'  GROUP BY tp_kode ORDER BY tp_id DESC")->result();
			$data['psw'] = 'oke';
			$this->load->view('mahasiswa/v_header', $data);
			$this->load->view('mahasiswa/v_pesan_tampil',$data);
			$this->load->view('mahasiswa/v_footer');
		}
	}

	function pesan_balas_act(){
		$this->load->database();
		$id = $this->session->userdata('uid');
		$kode = $this->input->post('kode');
		$tujuan = $this->input->post('tujuan');
		$judul = $this->input->post('judul');
		$pesan_name = $this->input->post('pesan');
		$this->form_validation->set_rules('pesan','Kirim Pesan','required');
		if($this->form_validation->run() != true){
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan WHERE tp_mahasiswa = '$id' GROUP BY tp_kode ORDER BY tp_id DESC")->result();
			$data['psw'] = 'oke';
			$this->load->view('mahasiswa/v_header', $data);
			$this->load->view('mahasiswa/v_pesan',$data);
			$this->load->view('mahasiswa/v_footer');
		}else{
			$data = array(
				'tp_kode' => $kode,
				'tp_mahasiswa' => $id,
				'tp_admin' => $tujuan,
				'tp_judul' => $judul,
				'tp_pesan' => $pesan_name,
				'tp_status_baca' => 'Belum Dibaca',
				'tp_tanggal' => date('Y-m-d'),
				'h_pengguna' => $id,
				'h_tanggal' => date('Y-m-d'),
				'h_waktu' => date("h:i:sa")
				);

			$this->M_vic->insert_data($data,'tbl_pesan');
			redirect(base_url().'mahasiswa/pesan/?alert=user-pesan');
		}
	}

	//alur
	function alur(){
		$this->load->database();
		$id = $this->session->userdata('uid');
		$prodi = $this->session->userdata('ujur');
		if($id == ""){
			redirect('mahasiswa/index');
		}else{
			$data['cek'] = $this->db->query("SELECT * FROM tbl_cek_list a WHERE a.cek_list_prodi LIKE '%$prodi%'")->result();
			$data['psw'] = 'oke';
			$this->load->view('mahasiswa/v_header', $data);
			$this->load->view('mahasiswa/v_alur', $data);
			$this->load->view('mahasiswa/v_footer');
		}
	}

}