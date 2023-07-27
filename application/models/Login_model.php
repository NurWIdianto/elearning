<?php
class Login_model extends CI_Model{
	public $nomor;
	public $pass;
	public $status;
		
	//untuk otentifikasi dosen 
	public function otentikasi_dosen(){
		$sql = sprintf("SELECT COUNT(*) AS cnt FROM dosen WHERE npd = '%s' AND pass = '%s'",$this->nomor,$this->pass);
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['cnt'] == 1;
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

	// public function nama_session(){
	// 	$data = [
 //        'name'  => $this->nama_login,
 //        'status'     => $this->status,
 //        ];
 //        return $data;
	// }

	public function nama_dosen(){
		$sql = sprintf("SELECT * from `dosen` ORDER by nama");
		$query = $this->db->query($sql);
		return $query->result();
	}

	//funsi untuk menampiklan mata muliah
	public function lihat_matkul($id_mt){
		$sql = sprintf("select matkul.nama from matkul where id_mt ='%s'",$id_mt);
		$query = $this->db->query($sql);
		return $query->result();
	}

	// fungsi untuk menampilkan matakuliah
	public function upload_dosen($npd){
		//$sql = sprintf("select a.id_mt,a.nama from matkul a,link_matkul_dosen b where a.id_mt=b.id_mt and b.npd='%s'",
		$sql = sprintf("select matkul.id_mt,matkul.nama from matkul join link_matkul_dosen on ( matkul.id_mt=link_matkul_dosen.id_mt and link_matkul_dosen.npd='%s')",
		$npd);
		$query = $this->db->query($sql);
		return $query->result();
	}
	// akhir fungsi

	// untuk menampilkan list mata kuliah 
	// yang sudah didaftarkan
	public function matkul_lama(){
		$sql = sprintf("select id_mt,nama from matkul");
		$query = $this->db->query($sql);
		return $query->result();
	}
	// akhir fungsi

	// fungsi untuk menambah matku
	// yang lama
	public function tambah_lama($id_mt,$nomor){
		$sql = sprintf("INSERT INTO link_matkul_dosen values('%s','%s')",$id_mt,$nomor);
		$query = $this->db->query($sql);
	}
	// akhir fungsi


	// untuk menampilkan table upload
	public function matkul($npd,$id_mt){
		$sql = sprintf("SELECT matkul.id_mt,matkul.nama,upload.nama_file,upload.keterangan,upload.nama_file 
							FROM matkul join link_upload_matkul on (link_upload_matkul.id_mt=matkul.id_mt) 
									join upload on (upload.id_up=link_upload_matkul.id_up) 
									join link_upload_dosen on (upload.id_up=link_upload_dosen.id_up) 
									join dosen on (link_upload_dosen.npd=dosen.npd) 
										WHERE dosen.npd='%s' and matkul.id_mt='%s'",
			$npd,
			$id_mt);
			$query = $this->db->query($sql);
			return $query->result();
	}
	// akhir fungsi

	// insert ke table komentar
	public function komentar($npd,$id_mt,$id_kom,$nama,$komentar,$status){
		$sql = sprintf("INSERT INTO komentar values ('%s','%s','%s','%s')",$id_kom,$nama,$komentar,$status);
		$this->db->query($sql);
		$this->link_komat($id_kom,$id_mt);
		$this->link_komdos($id_kom,$npd);
	}
	//akhir insert ke table komentar

	// fungsi untuk mengabil id_kom pada table komentar
	// lalu ditambah 1
	public function id_kom(){
		$sql = sprintf("SELECT id_kom from `komentar`  ORDER BY id_kom DESC LIMIT 1");
		$query = $this->db->query($sql);
		// return $query->result();
		foreach ($query->result_array() as $key ) {
			$npd1 = $key['id_kom'];
		}
		$kalimat1 = substr($npd1, 0,3);
		$kalimat2 = substr($npd1,3);
		$kalimat3 = intval($kalimat2);
		$kalimat4 = $kalimat2 + 1;
		$kalimat5 = strlen($kalimat4);
		if($kalimat5<2){
			return $kalimat1.'0'.$kalimat4;
		}else{
			return $kalimat1.$kalimat4;
		}
	}
	// akhir fungsi

	//insert ke table link_komentar_matkul
	public function link_komat($id_kom,$id_mt){
		$sql = sprintf("INSERT INTO link_komentar_matkul values ('%s','%s')",$id_kom,$id_mt);
		$this->db->query($sql);
	}
	// akhir fungsi

	// insert ke table link_komentar_dosen
	public function link_komdos($id_kom,$npd){
		$sql = sprintf("INSERT INTO link_komentar_dosen values ('%s','%s')",$id_kom,$npd);
		$this->db->query($sql);
	}
	// akhir fungsi

	// untuk menampilkan komentar
	public function tampil_komentar($npd,$id_mt){
		$sql = sprintf("SELECT a.nama,a.komentar,a.status from komentar a,dosen b,matkul c,link_komentar_dosen d,link_komentar_matkul e WHERE a.id_kom=d.id_kom AND d.npd=b.npd AND a.id_kom=e.id_kom AND e.id_mt=c.id_mt AND b.npd='%s' AND c.id_mt='%s'",$npd,$id_mt);
		$query = $this->db->query($sql);
		return	$query->result();
	}
	// akhir fungsi

}