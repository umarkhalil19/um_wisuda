<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Zip extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper('url');
		$this->load->helper(array('url', 'file'));
		$this->load->library(array('session', 'form_validation','zip'));
	}

	public function index()
	{
		$this->load->view('v_zip');
    }
    
    public function zip_file2($id)
    {
		$this->load->database();
		$sesi = substr($id, 0, 6);
       	$prodi = substr($id, 6);
		//$mahasiswa = $this->db->query("SELECT * FROM tbl_alumni, tbl_peserta_lampiran WHERE mhs_nim = peserta_kode AND mhs_prodi = '$prodi' AND mhs_sesi_wisuda = '$sesi' AND peserta_lamp_kode = '01'");
		$mahasiswa = $this->db->query("SELECT * FROM tbl_alumni a, tbl_mahasiswa_lampiran b WHERE a.mhs_nim = b.mhs_kode AND a.mhs_prodi = '$prodi' AND a.mhs_sesi_wisuda = '$sesi' AND b.mhs_lamp_kode = '01'");
		$prodi = $this->db->query("SELECT * FROM tbl_prodi WHERE prodi_kode = '$prodi'");
		$fototersedia = $mahasiswa->num_rows();
		if($fototersedia <= 0 || $id == ''){
			redirect('biro/laporan_ekportfoto');
		}else{
			foreach($mahasiswa->result() as $a){
				$file1 = 'dokumen/lampiran/'.$a->mhs_lampiran;
				$this->zip->read_file($file1);
			}
			//$this->zip->download('fotowisuda.zip');

			foreach($prodi->result() as $b){
				$nama_file1 = strtolower(str_replace(' ', '-', $b->prodi_nama));
			}
			$this->zip->download($nama_file1.'.zip');
		}
		
    }
	
	public function zip_file3($id)
    {
		$this->load->database();
		$sesi = substr($id, 0, 6);
       	$prodi = substr($id, 6);
       	//$mahasiswa = $this->db->query("SELECT * FROM tbl_alumni a, tbl_mahasiswa_lampiran b WHERE a.mhs_nim = b.mhs_kode AND a.mhs_prodi = '$prodi' AND a.mhs_sesi_wisuda = '$sesi' AND b.mhs_lamp_kode = '07'");
		//$mahasiswa = $this->db->query("SELECT * FROM tbl_mahasiswa a, tbl_mahasiswa_lampiran b WHERE a.mhs_nim = b.mhs_kode");
		$mahasiswa = $this->db->query("SELECT * FROM tbl_alumni a, tbl_mahasiswa_lampiran b WHERE a.mhs_nim = b.mhs_kode AND a.mhs_sesi_wisuda = '$sesi' AND b.mhs_lamp_kode = '07'");
		$prodi = $this->db->query("SELECT * FROM tbl_prodi WHERE prodi_kode = '$prodi'");
		$fototersedia = $mahasiswa->num_rows();
		if($fototersedia <= 0 || $id == ''){
			redirect('biro/laporan_ekportfoto');
		}else{
			foreach($mahasiswa->result() as $a){
				$file1 = 'dokumen/lampiran/'.$a->mhs_lampiran;
				$this->zip->read_file($file1);
			}
			$this->zip->download($sesi.'dokumenijazah.zip');
		}
		
    }
		
}
