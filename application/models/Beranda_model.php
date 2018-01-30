<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    /**
     * model ambil data semua gedung
     * @return array ambil data dan koordinat gedung
     */
    function getListGedung($mode)
    {
    	if ($mode=='sarpras') {
    		$this->db->select('gedung.idGedung, kodeGedung, namaGedung, luasGedung, x, y');
    		$this->db->from('gedung');
    		$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
    		$this->db->join('proposal', 'proposal.idGedung = gedung.idGedung', 'right');
    		$this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'right');
    		$this->db->where('pekerjaan.status', '0');
    		$this->db->order_by('namaGedung', 'asc');
    		$this->db->group_by('idGedung');
    		$this->db->limit(8);
    	} else {
    		$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, x, y');
    		$this->db->from('gedung');
    		$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
    		$this->db->order_by('namaGedung', 'asc');
    		$this->db->limit(8);
    	}

    	$query=$this->db->get();
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return null;
    	}
    }

    function totalLuas()
    {
    	$sql = "SELECT SUM(luasGedung) AS luas FROM gedung";
    	$result = $this->db->query($sql);
    	return $result->result();
    }

    public function searchListGedungByName(string $ged)
    {
    	$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, jumlahLantai, x, y, label');
    	$this->db->from('gedung');
    	$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
    	$this->db->where("MATCH(namaGedung) AGAINST ('$ged*' IN BOOLEAN MODE)", null, false);
    	$this->db->order_by('namaGedung', 'asc');
        // $this->db->like('namaGedung', $ged);

    	$query=$this->db->get();
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return null;
    	}
    }

    function getDataGedung(int $ged)
    {
        // $sql = "SELECT * FROM siplah WHERE idGedung='$ged' ORDER BY idRuang";
    	$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, tinggiGedung, jumlahLantai, kategoriGedung');
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

    function getListRenovasi(int $ged, $mode)
    {
    	if ($mode==1) {
    		$this->db->select('proposal.idProposal, gedung.idGedung, namaGedung, judulProposal, deskripsiProposal, proposal.status, alokasiDana, dateCreated, dateDeleted');
            $this->db->select('(SELECT COUNT(*) FROM pekerjaan WHERE pekerjaan.idProposal = proposal.idProposal AND pekerjaan.status=1) as done', false);
            $this->db->select('(SELECT COUNT(*) FROM pekerjaan WHERE pekerjaan.idProposal = proposal.idProposal) as kerja', false);
    		$this->db->from('proposal');
    		$this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'left');
        $this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'left');
    		if ($ged!='ALL') {
                // $this->db->where(array('dateDeleted' => NULL));
    			$this->db->where('gedung.idGedung', $ged);
    		}
				// $this->db->where('dateDeleted', NULL);
    		$this->db->order_by('namaGedung', 'asc');
			$this->db->order_by('dateCreated', 'asc');
            $this->db->group_by('idProposal');
            // count(pekerjaan.*)
    	} elseif ($mode==2) {
    		$this->db->select('idProposal, judulProposal, deskripsiProposal, status');
    		$this->db->from('proposal');
    		$this->db->where('idProposal', $ged);
    		$this->db->order_by('idProposal', 'asc');
    	} elseif ($mode==3) {
    		$this->db->select('idProposal, gedung.idGedung, namaGedung, judulProposal, deskripsiProposal, status, alokasiDana, dateCreated');
    		$this->db->from('proposal');
    		$this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'right');
    		$this->db->where('status', 0);
    		$this->db->order_by('idProposal', 'asc');
    	} elseif ($mode==4) {
    		$this->db->select('idProposal, gedung.idGedung, namaGedung, judulProposal, deskripsiProposal, status, alokasiDana, dateCreated');
    		$this->db->from('proposal');
    		$this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'right');
    		$this->db->where('status', 2);
    		$this->db->order_by('idProposal', 'asc');
    	}

    	$query = $this->db->get();
    	if ($query->num_rows()>0) {
    		return $query->result_array();
    	} else {
    		return null;
    	}
    }

    public function createRenovasi($data)
    {
    	$sql = "INSERT INTO `proposal` (`idGedung`, `judulProposal`, `deskripsiProposal`, `dateCreated`) VALUES ('".$data['idGedung']."', '".$data['judulProposal']."', '".$data['deskripsiProposal']."', CURDATE())";
    	return $this->db->query($sql);
        // return $this->db->affected_rows();
    }

    public function updateRenovasi($renovasi, $data)
    {
    	$this->db->where('idProposal', $renovasi);
    	$this->db->update('proposal', $data);
    	return $this->db->affected_rows();
    }

    function updateStatusRenovasi($renovasi, $mode)
    {
    	if ($mode==1) {
    		$data = array(
    			'status'=>2
    		);
    		$this->db->where('idProposal', $renovasi);
    		$this->db->update('proposal', $data);
    	} elseif ($mode==0) {
    		$data = array(
    			'status'=>3
    		);
    		$this->db->where('idProposal', $renovasi);
    		$this->db->update('proposal', $data);
    	} elseif ($mode==2) {
    		$sql = "UPDATE `proposal` SET `status` = '6', `dateDeleted` = CURDATE() WHERE `proposal`.`idProposal` = ".(int)$renovasi;
    		$this->db->query($sql);
    	}
    	return $this->db->affected_rows();
    }

    // function doneRenovasi($renovasi)
    // {
    	// $sql = "UPDATE `proposal` SET `status` = '6', `dateDeleted` = CURDATE() WHERE `proposal`.`idProposal` = ".(int)$renovasi;
    // 	$this->db_query($sql);
    // 	return $this->db->affected_rows();
    // }

    function deleteRenovasi($renovasi)
    {
    	$this->db->delete('proposal', array('idProposal' => $renovasi));
    	return $this->db->affected_rows();
    }

    function getPekerjaan($kerja, $mode)
    {
    	$this->db->select('idPekerjaan, detailPekerjaan, pekerjaan.status, pekerjaan.idProposal, judulProposal, deskripsiProposal, dateCreated, dateDeleted');
    	$this->db->from('pekerjaan');
    	$this->db->join('proposal', 'pekerjaan.idProposal = proposal.idProposal', 'left');
    	if ($mode==1) {
    		$this->db->where('pekerjaan.idProposal', $kerja);
    	} elseif ($mode==2) {
    		$this->db->where('pekerjaan.idPekerjaan', $kerja);
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

    function donePekerjaan($id, $data)
    {
    	$this->db->where('idPekerjaan', $id);
    	$this->db->update('pekerjaan', $data);
    }

    public function updatePekerjaan($kerja, $data)
    {
    	$this->db->where('idPekerjaan', $kerja);
    	$this->db->update('pekerjaan', $data);
    	return $this->db->affected_rows();
    }

    function cekPekerjaan($kerja)
    {
    	$this->db->where('idPekerjaan', $kerja);
    	$this->db->update('pekerjaan', $object);
    }

    public function createPekerjaan($data)
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
