<?php
/**
 * 
 */
class Upload_model extends CI_Model{
	public $npd;	
	

	//lihat matakuliah
	public function lihat_matkul11($id_mt){
		$sql = sprintf("select nama from matkul where id_mt ='%s'",$id_mt);
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

	// untuk menampilkan nama mata kuliah
	public function lihat_matkul($id_mt){
		$sql = sprintf("SELECT nama from matkul where id_mt='%s'",
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