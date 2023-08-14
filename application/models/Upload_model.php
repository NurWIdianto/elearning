<?php
/**
 * 
 */
class Upload_model extends CI_Model{
	
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