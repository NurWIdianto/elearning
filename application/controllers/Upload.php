<?php
/**
 * 
 */
class Upload extends CI_Controller{
	public $model;
	public function __construct(){
		parent::__construct();
		$this->load->helper(['url','html']);
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Upload_model');
		$this->model = $this->Upload_model;
	}

	public function index(){
		$status = $this->session->userdata('status');
		$id_mt = $this->session->userdata('id_mt');
		$nomor = $this->session->userdata('nomor');
		$this->model->npd = $this->session->userdata('nomor');
		$nama_matakuliah = $this->model->lihat_matkul11($id_mt);
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}elseif ($status=='dosen') {
			if (isset($_POST['btnsubmit'])){
				$keterangan = $_POST['keterangan'];
				$config =$this->model->konfigurasi();
				$this->load->library('upload', $config);
				if($this->upload->do_upload()){
					$nama_file = $this->upload->data('file_name');
					$this->model->upload22($keterangan,$nama_file,$nomor,$id_mt);
					$mat_kul = $this->model->matkul22($id_mt);
					echo "<script>alert('Upload File Berhasil')</script>";
					$this->load->view('header');
					$this->load->view('komentar_dosen',['matkul'=>$mat_kul,'id_mt'=>$id_mt]);
					$this->load->view('footer');
				}else{
					echo '<script>alert("File GAGAL di upload")</script>';
					$this->load->view('header');
					$this->load->view('upload_view',['nama_matakuliah'=>$nama_matakuliah,'id_mt'=>$id_mt]);
					$this->load->view('footer');
				}
				
			}else{
				$this->load->view('header');
				$this->load->view('upload_view',['nama_matakuliah'=>$nama_matakuliah,'id_mt'=>$id_mt]);
				$this->load->view('footer');
			}
			
		}	
	}
}