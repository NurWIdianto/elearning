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

	
	//DOWNLOAD DOSEN
	// fungsi reaksi button download pada button download di tampilan dosen
	public function download_matkul($nama_file){
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$npd = $this->session->userdata('nomor');
			$data = file_get_contents("upload/$npd/".$nama_file);
			force_download($nama_file,$data);
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
	// akhir fungsi 

	//jika tombol upload di tekan
	public function proses_upload(){
		$id_mt = $this->session->userdata('id_mt');
		$nomor = $this->session->userdata('nomor');
		$this->model->npd = $this->session->userdata('nomor');
		$nama_matakuliah = $this->model->lihat_matkul($id_mt);//untuk melihat nama matakuliah
			if (isset($_POST['btnsubmit'])){
				$keterangan = $_POST['keterangan'];
				$config =$this->model->konfigurasi();
				$this->load->library('upload', $config);
				if($this->upload->do_upload()){
					$nama_file = $this->upload->data('file_name');
					$this->model->upload22($keterangan,$nama_file,$nomor,$id_mt);//insert table upload22
					$mat_kul = $this->model->matkul22($id_mt,$nomor);//menampilkan table uplod22
					echo "<script>alert('Upload File Berhasil')</script>";
					$this->komentar_dosen($id_mt);
				}else{
					echo '<script>alert("File GAGAL di upload")</script>';
					$this->load->view('header');
					$this->load->view('upload_view',['matkul'=>$nama_matakuliah,'id_mt'=>$id_mt]);
					$this->load->view('footer');
				}
				
			}
	}
	//proses upload

	//fungsi untuk menampilkan form tambah matkul
	public function tambah_matkul(){
		$nomor=$this->session->userdata('nomor');
		if($this->session->has_userdata('nomor')==NULL){
			echo "<script>alert('nomor = $nomor')</script>";
		}else{
			echo "<script>alert('nomor = $nomor')</script>";
			$this->load->view('header');
			$this->load->view('tambah_matkul_view');
			$this->load->view('footer');
		}	
	}

	// fungsi jika tombol tambah ditekan
	// pada tambah matkul lama
	public function tambah_matkul_baru(){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
		$nomor = $this->session->userdata('nomor');
			if(isset($_POST['btnsubmit'])){
				$nama_matkul = $_POST['nama'];
				$coba=$this->model->proses_tambah_matkul_baru($nama_matkul,$nomor);
				echo "<script>alert('Mata Kuliah telah ditambahkan')</script>";
				$this->dosen();
			}
		}
	}
	// akhir fungsi

	//fungsi untuk menampilkan form tambah matkul
	public function tambah_matkul_lama(){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
			$nomor = $this->session->userdata('nomor');
			$matkul = $this->model->matkul_lama($nomor);
			$this->load->view('header');
			$this->load->view('lama_view',['matkul'=>$matkul]);
			$this->load->view('footer');
		}	
	}
	// akhir fungsi

	public function tambah_lama_respon($id_mt){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
			$nomor = $this->session->userdata('nomor');
			$this->model->tambah_lama($id_mt,$nomor);
			echo "<script>alert('Mata Kuliah telah ditambahkan')</script>";
			$this->dosen();
		}
	}
	
	// fungsi untuk menampilkan tampilan komentar
	public function komentar_dosen($id_mt){
		$this->session->set_userdata('id_mt',$id_mt);
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$npd = $this->session->userdata('nomor');
			$mat_kul = $this->model->matkul($id_mt,$npd);
			$this->db->reconnect();
			$nama_matkul = $this->model->lihat_matkul($id_mt);
			$this->db->reconnect();
			$komentar = $this->model->tampil_komentar($npd,$id_mt);
			$this->load->view('header');
			$this->load->view('komentar_dosen',['komentar'=>$komentar,'nama_matkul'=>$nama_matkul,'matkul'=>$mat_kul,'id_mt'=>$id_mt]);
			$this->load->view('footer');
		}		
	}
	// akhir fungsi untuk menampilkan tampilan komentar

	// fungsi jika button kirim pada tampilan komentar ditekan
	public function komentar_dosen2(){
		$id_mt = $this->session->userdata('id_mt');
		$npd = $this->session->userdata('nomor');
		$status = $this->session->userdata('status');
		$nama = $this->session->userdata('username');
		if(isset($_POST['btnsubmit'])){
			$komentar = $_POST['komentar'];
			$this->model->komentar($id_mt, $npd, $status, $nama, $komentar);
			$this->komentar_dosen($id_mt);
		}else{
			$this->komentar_dosen($id_mt);
		}
	}
	// akhir fungsi jika button kirim pada tampilan komentar ditekan
	// Akhir fungsi untuk dosen
////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// fungsi untuk mahasiswa
	// fungsi untuk tampilan mahasiswa 
	public function mahasiswa(){
		$status = $this->session->userdata('status');
		$npm = $this->session->userdata('nomor');
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}elseif ($status == "mahasiswa") {
			$matkul_dipilih = $this->model->lihat_matkul_mahasiswa($npm);
			$this->load->view('header_mahasiswa');
			$this->load->view('mahasiswa_lihat_matkul',['matkul_dipilih'=>$matkul_dipilih,'npm'=>$npm]);
			$this->load->view('footer');		
		}			
	}
	// akhir fungsi untuk tampilan mahasiswa 

	//fungsi untuk menampilkan semua matakuliah yang belum diambil
	public function tambah_matkul_mahasiswa(){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
			$nomor = $this->session->userdata('nomor');
			$matkul = $this->model->matkul_mahasiswa22($nomor);
			$this->load->view('header');
			$this->load->view('lama_mahasiwa_view',['matkul'=>$matkul]);
			$this->load->view('footer');
		}	
	}

	public function pilih_dosen($id_mt){
		if($this->session->has_userdata('nomor')==NULL){
			redirect('index/index');
		}else{
			$dosen = $this->model->lihat_pengajar($id_mt);//untuk melihat pengajar
			$matkul = $this->model->lihat_matkul($id_mt);//untuk melihat nama matakuliah
			$this->load->view('header');
			$this->load->view('mahasiswa',['matkul'=>$matkul,'dosen'=>$dosen,'id_mt'=>$id_mt]);
			$this->load->view('footer');
		}	
	}

	//fungsi untuk tampilan mata kuliah yang di ajar oleh dosen yan dipilih
	public function proses_pilih_matkul($npd,$id_mt){
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{			
			$nomor = $this->session->userdata('nomor');
			$this->model->proses_tambah_matkul($nomor, $npd, $id_mt);
			echo "<script>alert('Mata Kuliah telah ditambahkan')</script>";
			$this->mahasiswa();			
		}	
	}
	//akhir fungsi untuk tampilan mata kuliah yang di ajar oleh dosen yan dipilih

	public function komentar_mahasiswa22($npd,$id_mt){
		$this->session->set_userdata('id_mt',$id_mt);
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$npm = $this->session->userdata('nomor');
			$mat_kul = $this->model->matkul($id_mt,$npd);
			$nama_matkul = $this->model->lihat_matkul($id_mt);
			$nama_dosen = $this->model->lihat_dosen22($npd);
			$komentar = $this->model->tampil_komentar($npd,$id_mt);
			$this->load->view('header');
			$this->load->view('komentar_mahasiswa_view',['komentar'=>$komentar,'nama_matkul'=>$nama_matkul,
				'nama_dosen'=>$nama_dosen,'matkul'=>$mat_kul,'id_mt'=>$id_mt,'npd'=>$npd]);
			$this->load->view('footer');
		}		
	}

	// fungsi jika button kirim pada tampilan komentar ditekan
	public function komentar_mahasiswa2($id_mt,$npd){
		$status = $this->session->userdata('status');
		$nama = $this->session->userdata('username');
		if(isset($_POST['btnsubmit'])){
			$komentar = $_POST['komentar'];
			$this->model->komentar($id_mt, $npd, $status, $nama, $komentar);
			$this->komentar_mahasiswa22($npd,$id_mt);
		}else{
			$this->komentar_mahasiswa22($npd,$id_mt);
		}
	}

	// fungsi reaksi untuk tombol download pada tampilan matkul
	public function download_matkul_mahasiswa($id_mt,$npd,$nama_file){
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}else{
			$data = file_get_contents("upload/$npd/".$nama_file);
			force_download($nama_file,$data);
			$this->komentar_mahasiswa2($id_mt,$npd);
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
	/*public function komentar_mahasiswa2(){
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
	
	} */


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

	//funsi registrasi
	public function proses_registrasi(){
		if(isset($_POST['btnsubmit'])){
			$nama = $_POST['nama'];
			$pass = $_POST['pass'];
			$nomor = $this->model->insert_mahasiswa($nama,$pass);
			foreach ($nomor as $row) {
				$nomor2=$row->mahasiswa;
			};
			$pesan = 'Registrasi Berhasil\\nNomor : '.$nomor2.'\\nPassword : '.$pass.'\\nMohon difoto atau screenshot untuk keperluan login';
				echo "<script>alert('$pesan')</script>";
				$this->load->view('register_view');
		}
		else
			$this->load->view('register_view');
	}
	//akhir funsi
}