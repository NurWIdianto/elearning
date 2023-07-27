<?php
class Register extends CI_Controller{
	public $model;
	public $status;
	public function __construct(){
		parent::__construct();
		$this->load->helper(['url','html']);
		$this->load->database();
		$this->load->model('Insert_model');
		$this->model=$this->Insert_model;
	}

	public function index(){
		if(isset($_POST['btnsubmit'])){
			// $this->status = $_POST['status'];
			// $this->model->nama = $_POST['nama'];
			// $this->model->pass = $_POST['pass'];
			$nomor = $_POST['nomor'];
			$nama = $_POST['nama'];
			$pass = $_POST['pass'];
			$pesan = 'Registrasi Berhasil\\nNomor : '.$nomor.'\\nPassword : '.$pass.'\\nMohon diingat untuk keperluan login';
			if($this->status == "dosen"){
				// $nama=$this->model->nama;
				// $config = "./upload/$nama/";
				// mkdir($config, 0777, TRUE);
				// $this->model->insert_dosen();
				echo "<script>alert('$pesan')</script>";
				$this->load->view('percobaan_view',['nomor'=>$nomor,'nama'=>$nama,'pass'=>$pass]);
			}else{
				// $this->model->insert_mahasiswa();
				echo "<script>alert('$pesan')</script>";
				$this->load->view('percobaan_view',['nomor'=>$nomor,'nama'=>$nama,'pass'=>$pass]);
			}
		}else{
			$npm = $this->model->npm();
			$this->load->view('register_view',['npm'=>$npm]);	
		}
		
	}

	public function nomor_dosen(){
		$nomor= $this->model->idp();
		echo ($nomor);
	}
	public function nomor_mahasiswa(){
		$nomor= $this->model->npm();
		echo ($nomor);
	}
}