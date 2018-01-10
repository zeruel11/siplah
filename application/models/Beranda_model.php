<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getListGedung()
	{
		$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, jumlahLantai, x, y, label');
		$this->db->from('gedung');
		$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');

		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return null;
		}

	}

	function getDataGedung($ged)
	{
		// $sql = "SELECT * FROM siplah WHERE idGedung='$ged' ORDER BY idRuang";
		$this->db->select('*');
		$this->db->from('gedung');
		$this->db->where('idGedung', $ged);
		// $this->db->order_by('title', 'desc');
		// $query = $this->db->query($sql);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
                return $query->result();
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