<?php
/**
 * 
 */
class Upload_model extends CI_Model{
	public $npd;	
	
	//insert table upload
	public function insert_upload(){
		$sql = sprintf("INSERT INTO upload(keterangan,nama_file) values ('%s','%s')",
			$this->keterangan,
			$this->nama_file
		);
		$this->db->query($sql);
	}

	//insert link_upload_dosen
	public function insert_upload2($id_up,$npd){
		$sql = sprintf("INSERT INTO link_upload_dosen(id_up,npd) values ('%s','%s')",
			$id_up,
			$npd
		);
		$this->db->query($sql);
	}

	public function insert_upload3($id_up,$id_mt){
		$sql = sprintf("INSERT INTO link_upload_matkul(id_up,id_mt) values ('%s','%s')",
			$id_up,
			$id_mt
		);
		$this->db->query($sql);
	}

	//lihat matakuliah
	public function lihat_matkul11($id_mt){
		$sql = sprintf("select matkul.nama from matkul where id_mt ='%s'",$id_mt);
		$query = $this->db->query($sql);
		return $query->result();
	}

	//untuk upload ke folder yang dituju
	public function konfigurasi(){
		$config =['upload_path' => "./upload/$this->npd/",
		'allowed_types' => "doc|ppt|avi|3gp",
		'max_size' => "200000000000000000"];
		return $config;
	}

	//lihat id terakhir
	public function lihat_id_terakhir(){
		$sql = sprintf("select last_insert_id() as terakhir");
		$query = $this->db->query($sql);
		return $query->result();
	}

	// untuk menampilkan table upload
	public function matkul22($id_mt){
		$sql = sprintf("SELECT matkul.id_mt,matkul.nama,upload22.nama_file,upload22.keterangan 
						from upload22 join matkul on(matkul.id_mt=upload22.id_mt)
						where upload22.id_mt='%s'",
			$id_mt);
			$query = $this->db->query($sql);
			return $query->result();
	}
	// akhir fungsi

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

	// insert ke table komentar
	public function komentar22($npd,$id_mt,$id_kom,$nama,$komentar,$status){
		$sql = sprintf("INSERT INTO komentar values ('%s','%s','%s','%s')",
						$id_kom,
						$nama,
						$komentar,$status);
		$this->db->query($sql);
		$this->link_komat($id_kom,$id_mt);
		$this->link_komdos($id_kom,$npd);
	}
	//akhir insert ke table komentar
}