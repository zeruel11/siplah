<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

/**
 * model ambil data semua gedung
 * @return array ambil data dan koordinat gedung
 */
	function getListGedung()
	{
		$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, jumlahLantai, x, y, label');
		$this->db->from('gedung');
		$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
		$this->db->order_by('idGedung', 'asc');
		$this->db->limit(10);

		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return null;
		}

	}

	function searchListGedungByName($ged)
	{
		$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, jumlahLantai, x, y, label');
		$this->db->from('gedung');
		$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
		$this->db->order_by('idGedung', 'desc');
		$this->db->where("MATCH(namaGedung) AGAINST ('$ged' IN NATURAL LANGUAGE MODE)", NULL, FALSE);

		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return null;
		}
	}

/**
 * model ambil data gedung tertentu
 * @param  int $ged idGedung
 * @return array      data gedung by id
 */
	function getDataGedung($ged)
	{
		// $sql = "SELECT * FROM siplah WHERE idGedung='$ged' ORDER BY idRuang";
		$this->db->select('idGedung, namaGedung, luasGedung, jumlahLantai');
		$this->db->from('gedung');
		$this->db->where('idGedung', $ged);
		// $this->db->order_by('title', 'desc');
		// $query = $this->db->query($sql);
		$query = $this->db->get();
		if($query->num_rows() == 1) {
                return $query->result_array();
            } else {
            return null;
       }
	}

	function getListRenovasi($ged)
	{
		$this->db->select('idProposal, namaGedung, judulProposal, deskripsiProposal, status, alokasiDana, dateCreated');
		$this->db->from('proposal');
		$this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'left');
		if ($ged!='ALL') {
			// $this->db->where(array('dateDeleted' => NULL));
			$this->db->where('proposal.idGedung', $ged);
		}

		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return null;
		}
		
	}

	/*function getListRuang()
	{
		# code...
	}*/

}

/* End of file beranda_model.php */
/* Location: ./application/models/beranda_model.php */
