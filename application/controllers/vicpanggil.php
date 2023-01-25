<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vicpanggil extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper('url');
		$this->load->helper('Vic_helper');
		$this->load->helper("Vic_convert");
		$this->load->library(array('session','form_validation'));
		$this->load->model('M_vic');
	}

	/*public function index(){
		$this->load->database();
		$this->load->view($this->m_dah->get_namafolder().'/v_header');
		$this->load->view($this->m_dah->get_namafolder().'/v_index');
		$this->load->view($this->m_dah->get_namafolder().'/v_footer');
	}*/

	function panggil_nama_mhs(){
		$this->load->database();
		$db = $this->M_vic->panggil_db();
		$kode = $_GET['kode'];
		$rs = mysqli_query ($db, "SELECT * FROM tbl_peserta WHERE peserta_kode='$kode'");
		if($r = mysqli_fetch_array($rs)){
			echo "<div class='alert alert-success'>Nama: ".$r['peserta_nama']."</div>";
			echo "<input type='hidden' name='namapeserta' value='".$r['peserta_nama']."''>";
		}else{
			echo "<div class='alert alert-danger'>Nomor Peserta Tidak Diketahui</div>";
		}

	}




}
