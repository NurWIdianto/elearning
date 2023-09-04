<?php
class Login_model extends CI_Model{
	public $nomor;
	public $pass;
	public $status;
	public $npd;		
	//untuk otentifikasi dosen 
	public function otentikasi_dosen(){
		$sql = sprintf("SELECT COUNT(*) AS cnt FROM dosen WHERE npd = '%s' AND pass = '%s'",$this->nomor,$this->pass);
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['cnt'] == 1;
	}

	public function cek_dosen($username,$status){
		$hasil = $username==NULL and status !="dosen";
		return $hasil;
	}

	// untuk otentifikasi mahasiswa
	public function otentikasi_mahasiswa(){
		$sql = sprintf("SELECT COUNT(*) AS cnt FROM mahasiswa WHERE npm = '%s' AND pass = '%s'",$this->nomor,$this->pass);
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['cnt'] == 1;
	}

	// melihat nama dosen 
	public function lihat_dosen(){
		$sql = sprintf("SELECT * from `dosen` where npd = '%s'",$this->nomor);
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result->nama;

	}

	// melihat nama mahasiswa
	public function lihat_mahasiswa(){
		$sql = sprintf("SELECT nama from `mahasiswa` where npm = '%s'",$this->nomor);
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result->nama;
	}

	//fungsi untuk melihat nama dosen
	public function nama_dosen(){
		$sql = sprintf("SELECT * from `dosen` ORDER by nama");
		$query = $this->db->query($sql);
		return $query->result();
	}
	//akhir fungsi


	// fungsi untuk menampilkan matakuliah
	public function upload_dosen($npd){
		$sql = sprintf("select matkul.id_mt,matkul.nama from matkul join link_matkul_dosen on ( matkul.id_mt=link_matkul_dosen.id_mt and link_matkul_dosen.npd='%s')",
		$npd);
		$query = $this->db->query($sql);
		return $query->result();
	}
	// akhir fungsi

	// untuk menampilkan list mata kuliah 
	public function matkul_lama($npd){
		$sql= sprintf("select * from matkul where id_mt not in(select matkul.id_mt
	from dosen join link_matkul_dosen on (link_matkul_dosen.npd=dosen.npd)
			   join matkul on (link_matkul_dosen.id_mt=matkul.id_mt)
			   where dosen.npd='%s')",$npd);
		$query = $this->db->query($sql);
		return $query->result();
	}
	//akhir fungsi

	public function proses_tambah_matkul_baru($nama_matkul,$nomor){
		$sql = sprintf("insert into matkul(nama) values('%s')",$nama_matkul);
		$query = $this->db->query($sql);
		$sql2 = sprintf("select last_insert_id() as id_mt");
		$query2 = $this->db->query($sql2);
		$data = $query2->result();
		foreach ($data as $row) {
				$nomor2=$row->id_mt;
		};
		$sql3 = sprintf("insert into link_matkul_dosen(id_mt,npd) values('%s','%s')",$nomor2,$nomor);
		$query3 = $this->db->query($sql3);
	}

	// untuk menampilkan list mata kuliah 
	// yang belum didaftarkan
	public function matkul_lama_mahsiswa($npm){
		$sql = sprintf("select id_mt,nama from matkul
						where id_mt not in (select matkul.id_mt from matkul
						left join link_mahasiswa_matkul_dosen on (link_mahasiswa_matkul_dosen.id_mt=matkul.id_mt)
							where link_mahasiswa_matkul_dosen.npm = %s)",
		$npm);
		$query = $this->db->query($sql);
		return $query->result();
	}
	// akhir fungsi

	// fungsi untuk menambah matkul
	// yang lama
	public function tambah_lama($id_mt,$nomor){
		$sql = sprintf("INSERT INTO link_matkul_dosen values('%s','%s')",$id_mt,$nomor);
		$query = $this->db->query($sql);
	}
	// akhir fungsi


	// untuk menampilkan table upload
	public function matkul($id_mt,$npd){
		$sql = sprintf("SELECT nama_file,keterangan 
						from upload22 where id_mt='%s' and npd='%s'",
			$id_mt,
			$npd);
			$query = $this->db->query($sql);
			return $query->result();
	}
	// akhir fungsi

	// untuk menampilkan nama mata kuliah
	public function lihat_matkul($id_mt){
		$sql = sprintf("SELECT nama from matkul where id_mt='%s'",
			$id_mt);
			$query = $this->db->query($sql);
			return $query->result();
	}
	// akhir fungsi

	//untuk upload ke folder yang dituju
	public function konfigurasi(){
		$config =['upload_path' => "./upload/$this->npd/",
		'allowed_types' => "doc|ppt|avi|3gp",
		'max_size' => "200000000000000000"];
		return $config;
	}

	//insert ke table upload
	public function upload22($komentar,$nama_file,$npd,$id_mt){
		$sql = sprintf("INSERT INTO upload22(keterangan,nama_file,npd,id_mt) values ('%s','%s','%s','%s')",
						$komentar,
						$nama_file,
						$npd,
						$id_mt);
		$this->db->query($sql);
	}
	// akhir fungsi

	// untuk menampilkan table upload
	public function matkul22($id_mt,$npd){
		$sql = sprintf("SELECT nama_file,keterangan from upload22
				where id_mt='%s' and npd='%s'",
					$id_mt,
					$npd);
		$query = $this->db->query($sql);
		return $query->result();
	}
	// akhir fungsi

	//registrasi
	//fungsi untuk insert table dosen
	public function insert_dosen(){
		$sql = sprintf("INSERT INTO dosen VALUES ('%s','%s')",
			$this->nama,
			$this->pass
		);
		$this->db->query($sql);
	}
	//akhir fungsi

	//fungsi insert table mahasiswa
	public function insert_mahasiswa($nama,$pass){
		$sql = sprintf("INSERT INTO mahasiswa (nama,pass) VALUES ('%s','%s')",
			$nama,
			$pass
		);
		$this->db->query($sql);
		$sql2 = sprintf("select last_insert_id() as mahasiswa");
		$query = $this->db->query($sql2);
		return $query->result();
	}
	//akhir fungsi

	//fungsi insert table mahasiswa
	public function lihat_matkul_mahasiswa($npm){
		$sql = sprintf("select matkul.nama as nama_matakuliah,dosen.nama from matkul
						join link_mahasiswa_matkul_dosen on (matkul.id_mt=link_mahasiswa_matkul_dosen.id_mt)
    					join dosen on (dosen.npd=link_mahasiswa_matkul_dosen.npd)
    					join mahasiswa on (mahasiswa.npm=link_mahasiswa_matkul_dosen.npm)
						where mahasiswa.npm='%s'",
				$npm);
		$query = $this->db->query($sql);
		return $query->result();
	}
	//akhir fungsi

	public function lihat_pengajar($id_mt){
		$sql = sprintf("select dosen.npd,dosen.nama from dosen
						join link_matkul_dosen on (link_matkul_dosen.npd=dosen.npd)
						where link_matkul_dosen.id_mt='%s'",
				$id_mt);
		$query = $this->db->query($sql);
		return $query->result();
	}


	// insert ke table komentar
	public function komentar($id_mt, $npd, $status, $nama, $komentar){
		$sql = sprintf("INSERT INTO komentar(id_mt, npd, status_komentar, nama, komentar)
						 values ('%s','%s','%s','%s','%s')",
						 	$id_mt, $npd, $status, $nama, $komentar);
		$this->db->query($sql);
	}
	//akhir insert ke table komentar



	// untuk menampilkan komentar
	public function tampil_komentar($npd,$id_mt){
		$sql = sprintf("select * from komentar where npd='%s' and id_mt='%s'",$npd, $id_mt);
		$query = $this->db->query($sql);
		return	$query->result();
	}
	// akhir fungsi

}