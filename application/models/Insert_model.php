<?php
class Insert_model extends CI_Model{
	public $nama;
	public $pass;

	public function idp(){
		$sql = sprintf("SELECT npd from `dosen`  ORDER BY npd DESC LIMIT 1");
		$query = $this->db->query($sql);
		// return $query->result();
		foreach ($query->result_array() as $key ) {
			$npd1 = $key['npd'];
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

	public function npm(){
		$sql = sprintf("SELECT npm from `mahasiswa`  ORDER BY npm DESC LIMIT 1");
		$query = $this->db->query($sql);
		// return $query->result();
		foreach ($query->result_array() as $key ) {
			$npd1 = $key['npm'];
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

	public function insert_dosen(){
		$sql = sprintf("INSERT INTO dosen VALUES ('%s','%s')",
			$this->nama,
			$this->pass
		);
		$this->db->query($sql);
	}

	public function insert_mahasiswa(){
		$sql = sprintf("INSERT INTO mahasiswa VALUES ('%s','%s')",
			$this->nama,
			$this->pass
		);
		$this->db->query($sql);
	}
	
}