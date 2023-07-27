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
		//$this->model->nama_dosen = $this->session->userdata('username');
		$status = $this->session->userdata('status');
		$id_mt = $this->session->userdata('id_mt');
		$nomor = $this->session->userdata('nomor');
		$nama_matakuliah = $this->model->lihat_matkul11($id_mt);
		$id_terakhir22;
		if($this->session->has_userdata('username')==NULL){
			redirect('index/index');
		}elseif ($status=='dosen') {
			if (isset($_POST['btnsubmit'])){
				$this->model->mata_kuliah = $nama_matakuliah;
				$this->model->keterangan = $_POST['keterangan'];
				$this->model->npd=$nomor;
				$config =$this->model->konfigurasi();
				$this->load->library('upload', $config);
				if($this->upload->do_upload()){
					$this->model->nama_file = $this->upload->data('file_name');
					$this->model->insert_upload();
					$id_terakhir = $this->model->lihat_id_terakhir();//lihat id terakhir
					foreach ($id_terakhir as $key) {
						$id_terakhir=$key->terakhir;
					};
					$this->model->insert_upload2($id_terakhir,$nomor);//insert link_upload_dosen
					$this->model->insert_upload3($id_terakhir,$id_mt);// insert link_upload_matkul
					$mat_kul = $this->model->matkul22($nomor,$id_mt);
					//$komentar = $this->model->tampil_komentar22(($npd,$id_mt,$id_kom,$nama,$komentar,$status);
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