<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * model ambil data semua gedung
     * @return array ambil data dan koordinat gedung
     */
    public function getListGedung()
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

    public function searchListGedungByName($ged)
    {
        $this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, jumlahLantai, x, y, label');
        $this->db->from('gedung');
        $this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
        $this->db->where("MATCH(namaGedung) AGAINST ('$ged*' IN BOOLEAN MODE)", null, false);
        $this->db->order_by('idGedung', 'desc');
        // $this->db->like('namaGedung', $ged);

        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    /**
     * model ambil data gedung tertentu
     * @param  int $ged idGedung
     * @return array      data gedung by id
     */
    public function getDataGedung($ged)
    {
        // $sql = "SELECT * FROM siplah WHERE idGedung='$ged' ORDER BY idRuang";
        $this->db->select('idGedung, namaGedung, luasGedung, jumlahLantai');
        $this->db->from('gedung');
        $this->db->where('idGedung', $ged);
        // $this->db->order_by('title', 'desc');
        // $query = $this->db->query($sql);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function getListRenovasi($ged, $mode)
    {
    	if ($mode==1) {
    		$this->db->select('idProposal, proposal.idGedung, namaGedung, judulProposal, deskripsiProposal, status, alokasiDana, dateCreated');
        	$this->db->from('proposal');
        	$this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'right');
        	// $this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'left');
        	if ($ged!='ALL') {
        	    // $this->db->where(array('dateDeleted' => NULL));
        	    $this->db->where('gedung.idGedung', $ged);
        	}
    	} else {
    		$this->db->select('idProposal, judulProposal, deskripsiProposal, status');
    		$this->db->from('proposal');
    		$this->db->where('idProposal', $ged);
    	}
        

        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function createRenovasi($send)
    {
    	$sql = "INSERT INTO `proposal` (`idGedung`, `judulProposal`, `deskripsiProposal`, `dateCreated`) VALUES ('".$send['idGedung']."', '".$send['judulProposal']."', '".$send['deskripsiProposal']."', CURDATE())";
    	return $this->db->query($sql);
    	// return $this->db->affected_rows();
    }

    function updateRenovasi($renovasi, $data)
    {
    	$this->db->where('idProposal', $renovasi);
    	$this->db->update('proposal', $data);
    	return $this->db->affected_rows();
    }

    function deleteRenovasi($renovasi)
    {
    	$this->db->delete('proposal', array('idProposal' => $renovasi));
    	return $this->db->affected_rows();
    }

    function getPekerjaan($kerja, $mode)
    {
    	$this->db->select('idPekerjaan, detailPekerjaan, pekerjaan.status, pekerjaan.idProposal, judulProposal');
    	$this->db->from('pekerjaan');
        $this->db->join('proposal', 'pekerjaan.idProposal = proposal.idProposal', 'left');
        if ($mode==1) {
        	$this->db->where('pekerjaan.idProposal', $kerja);
        } else {
        	$this->db->where('pekerjaan.idPekerjaan', $kerja);
        }

        $query = $this->db->get();
        if ($query->num_rows()>0) {
        	return $query->result_array();
        } else {
        	return null;
        }
    }

    function deletePekerjaan($kerja)
    {
    	$this->db->delete('pekerjaan', array('idPekerjaan' => $kerja));
    	return $this->db->affected_rows();
    }

    // function editPekerjaan($kerja)
    // {
    //   $this->db->select('idPekerjaan, detailPekerjaan');
    //   $this->db->from('pekerjaan');
    //   $this->db->where('idPekerjaan', $kerja);

    //   $query = $this->db->get();
    //   return $query->row(0);
    // }

    function updatePekerjaan($kerja, $data)
    {
      $this->db->where('idPekerjaan', $kerja);
      $this->db->update('pekerjaan', $data);
      return $this->db->affected_rows();
    }

    function createPekerjaan($data)
    {
    	$this->db->insert('pekerjaan', $data);
    	return $this->db->affected_rows();
    }

    /*function getListRuang()
    {
        # code...
    }*/
}

/* End of file beranda_model.php */
/* Location: ./application/models/beranda_model.php */
