<?php
/**
 * 
 */
class Index extends CI_Controller{
	public $model;
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(['url','form','html','download']);
		$this->load->model('Login_model');
		$this->model = $this->Login_model;
		$this->load->database();
	}

	public function index(){
		if($this->session->has_userdata('nomor')==NULL){
			if(isset($_POST['btnsubmit'])){
				$this->model->status = $_POST['status'];
				$this->model->nomor = $_POST['nomor'];
				$this->model->pass = $_POST['pass'];
				$this->session->set_userdata('status',$this->model->status);
				$this->session->set_userdata('pass',$this->model->pass);
				$this->session->set_userdata('nomor',$this->model->nomor);
				if($this->model->status == "dosen"){
					if($this->model->otentikasi_dosen() == TRUE){
							$this->session->set_userdata('username',$this->model->lihat_dosen());
							$this->dosen();
					}else{
							echo "<script>alert('Nama atau Password salah !!!')</script>";
							$this->session->sess_destroy();
							$this->load->view('header');
							$this->load->view('login');
							$this->load->view('footer');
					}
				}else{
					if($this->model->otentikasi_mahasiswa() == TRUE){
							$this->session->set_userdata('username',$this->model->lihat_mahasiswa());
							$this->mahasiswa();
					}else{
							echo "<script>alert('Nama atau Password salah !!!')</script>";
							$this->session->sess_destroy();
							$this->load->view('header');
							$this->load->view('login');
							$this->load->view('footer');
					}
				}
			}else{
			$this->session->sess_destroy();
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
			}
		}elseif ($this->session->userdata('status') == "dosen") {
			$this->model->nomor = $this->session->userdata('nomor');
			$this->model->pass = $this->session->userdata('pass');
			if($this->model->otentikasi_dosen() == TRUE){
					$this->dosen();
			}else{
					echo "<script>alert('Nama atau Password salah !!!')</script>";
					$this->session->sess_destroy();
					$this->load->view('header');
					$this->load->view('login');
					$this->load->view('footer');
			}
		}elseif($this->session->userdata('status') == "mahasiswa"){
			$this->model->nomor = $this->session->userdata('nomor');
			$this->model->pass = $this->session->userdata('pass');
			if($this->model->otentikasi_mahasiswa() == TRUE){
					$this->mahasiswa();
			}else{
					echo "<script>alert('Nama atau Password salah !!!')</script>";
					$this->session->sess_destroy();
					$this->load->view('header');
					$this->load->view('login');
					$this->load->view('footer');
			}
		}else{
			$this->session->sess_destroy();
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
		}		
	}

	// fungsi untuk dosen
	// fungsi untuk tampilan dosen
	public function dosen(){
		$status = $this->session->userdata('status');
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}elseif ($status == "dosen") {
			$nomor = $this->session->userdata('nomor');
			$upload_dosen = $this->model->upload_dosen($nomor);
			$this->load->view('header');
			$this->load->view('dosen',['upload_dosen'=>$upload_dosen]);
			$this->load->view('footer');
		}		
	}
	// akhir fungsi untuk tampilan dosen

	// fungsi untuk menampilkan tampilan komentar
	public function komentar_dosen($id_mt){
		$this->session->set_userdata('id_mt',$id_mt);
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$npd = $this->session->userdata('nomor');
			$mat_kul = $this->model->matkul($id_mt,$npd);
			$nama_matkul = $this->model->lihat_matkul($id_mt);
			$this->load->view('header');
			$this->load->view('komentar_dosen',['nama_matkul'=>$nama_matkul,'matkul'=>$mat_kul,'id_mt'=>$id_mt]);
			$this->load->view('footer');
		}		
	}
	// akhir fungsi untuk menampilkan tampilan komentar

	// fungsi jika button kirim pada tampilan komentar ditekan
	public function komentar_dosen2(){
		$id_mt = $this->session->userdata('id_mt');
		$npd = $this->session->userdata('nomor');
		$id_kom = $this->model->id_kom();
		$status = $this->session->userdata('status');
		$nama = $this->session->userdata('username');
		if(isset($_POST['btnsubmit'])){
			$komentar = $_POST['komentar'];
			$this->model->komentar($npd,$id_mt,$id_kom,$nama,$komentar,$status);
			$mat_kul = $this->model->matkul($npd,$id_mt);
			$komentar = $this->model->tampil_komentar($npd,$id_mt);
			$this->load->view('header');
			$this->load->view('komentar_dosen',['matkul'=>$mat_kul,'komentar'=>$komentar]);
			$this->load->view('footer');
		}else{
			$this->komentar_dosen($id_mt);
		}
	}
	// akhir fungsi jika button kirim pada tampilan komentar ditekan

	//DOWNLOAD DOSEN
	// fungsi reaksi button download pada button download di tampilan dosen
	public function download_matkul($nama_file){
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$npd = $this->session->userdata('nomor');
			//$upload_dosen = $this->model->upload_dosen($nama_dosen);
			$data = file_get_contents("upload/$npd/".$nama_file);
			force_download($nama_file,$data);
			// $this->load->view('dosen',['upload_dosen'=>$upload_dosen]);	
		}		
	}
	// akhir fungsi reaksi button download pada button download di tampilan dosen

	//fungsi untuk menampilkan form upload
	public function upload(){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
			$id_mt = $this->session->userdata('id_mt');
			$matkul = $this->model->lihat_matkul($id_mt);
			$this->load->view('header');
			$this->load->view('upload_view',['matkul'=>$matkul,'id_mt'=>$id_mt]);
			$this->load->view('footer');
		}	
	}
	// akhir fungsi reaksi button download pada button download di tampilan dosen

	//fungsi untuk menampilkan form tambah matkul
	public function tambah_matkul(){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
			$this->load->view('header');
			$this->load->view('tambah_matkul_view');
			$this->load->view('footer');
		}	
	}
	//fungsi untuk menampilkan form tambah matkul
	public function tambah_matkul_lama(){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
			$matkul = $this->model->matkul_lama();
			$this->load->view('header');
			$this->load->view('lama_view',['matkul'=>$matkul]);
			$this->load->view('footer');
		}	
	}
	// akhir fungsi
	// fungsi jika tombol tambah ditekan
	// pada tambah matkul lama
	public function tambah_lama_respon($id_mt){
		$nomor = $this->session->userdata('nomor');
		$this->model->tambah_lama($id_mt,$nomor);
		echo "<script>alert('Tambah Mata kuliah berhasil !!!')</script>";
		$this->tambah_matkul_lama();
	}
	// akhir fungsi
	// Akhir fungsi untuk dosen

	// fungsi untuk mahasiswa
	// fungsi untuk tampilan mahasiswa 
	public function mahasiswa(){
		$status = $this->session->userdata('status');
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}elseif ($status == "mahasiswa") {
			$rows = $this->model->nama_dosen();
			$this->load->view('mahasiswa',['rows'=>$rows]);		
		}			
	}
	// akhir fungsi untuk tampilan mahasiswa 

	//fungsi untuk tampilan mata kuliah yang di ajar oleh dosen yan dipilih
	public function matkul_mahasiswa($npd){
		$this->session->set_userdata('npd',$npd);
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{			
			$this->session->set_userdata('npd',$npd);
			$upload_dosen = $this->model->upload_dosen($npd);
			$this->load->view('matkul_mahasiswa_view',['upload_dosen'=>$upload_dosen]);			
		}	
	}
	//akhir fungsi untuk tampilan mata kuliah yang di ajar oleh dosen yan dipilih

	// fungsi reaksi untuk tombol download pada tampilan matkul
	public function download_matkul_mahasiswa($nama_file){
		$this->session->set_userdata('nama_file',$nama_file);
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$nama_dosen = $this->session->userdata('nama_dosen');
			$upload_dosen = $this->model->upload_dosen($nama_dosen);
			$data = file_get_contents("upload/$nama_dosen/".$nama_file);
			force_download($nama_file,$data);
			$this->load->view('matkul_mahasiswa_view',['upload_dosen'=>$upload_dosen]);	
		}		
	}
	// akhir fungsi reaksi untuk tombol download pada tampilan matkul

	// fungsi untuk menampilkan tampilan komentar
	public function komentar_mahasiswa($id_mt){
		// $this->session->set_userdata('nama_file2',$nama_file);
		// $nama_file3=$this->session->userdata('nama_file2');
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$npd = $this->session->userdata('npd');
			$mat_kul = $this->model->matkul($npd,$id_mt);
			$komentar = $this->model->tampil_komentar($npd,$nama_file);
			$this->load->view('komentar_mahasiswa_view',['upload_dosen'=>$mat_kul,'komentar'=>$komentar]);
		}	
	}
	// akhir fungsi untuk menampilkan tampilan komentar

	// fungsi jika button kirim pada tampilan komentar ditekan
	public function komentar_mahasiswa2(){
		$nama_file = $this->session->userdata('nama_file2');
		$nama = $this->session->userdata('username');
		$nama_dosen = $this->session->userdata('nama_dosen');
		$status=$this->session->userdata('status');
		if(isset($_POST['btnsubmit'])){
			$komentar = $_POST['komentar'];
			$this->model->komentar($nama,$komentar,$nama_dosen,$nama_file,$status);
			$mat_kul = $this->model->matkul($nama_dosen,$nama_file);
			$komentar = $this->model->tampil_komentar($nama_dosen,$nama_file);
			$this->load->view('komentar_mahasiswa_view',['upload_dosen'=>$mat_kul,'komentar'=>$komentar]);
		}else{
			$nama_file = $this->session->userdata('nama_file2');
			$this->komentar_mahasiswa($nama_file);
		}
	
	}


	// akhir fungsi jika button kirim pada tampilan komentar ditekan
	// akhir fungsi mahasiswa

	// fungsi jika button logout pada navbar ditekan
	public function logout(){
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$this->session->unset_userdata(['username','nama_dosen','nama_file','status','pass']);
			$this->session->sess_destroy();
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');				
		}	
	}
	// akhir fungsi jika button logout pada navbar ditekan

	// public function __remap($segmen_kedua){
	// 	if(isset($segmen_kedua)){
	// 		switch (strtolower($segmen_kedua)) {
	// 			case 'dosen':
	// 				$this->load->view('dosen');
	// 				break;
	// 			case 'mahasiswa':
	// 				$this->load->view('mahasiswa');
	// 				break;
	// 			case 'download_matkul':
	// 				$this->load->view('dosen');
	// 				break;
	// 			case 'komentar_dosen':
	// 				$this->load->view('komentar_dosen');
	// 				break;				
	// 			default:
	// 			 	$this->index();
	// 			 	break;
	// 		}
	// 	}
	// }
}