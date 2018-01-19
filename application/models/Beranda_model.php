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
        $this->db->order_by('idGedung', 'desc');
        $this->db->where("MATCH(namaGedung) AGAINST ('$ged' IN NATURAL LANGUAGE MODE)", null, false);

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

    public function getListRenovasi($ged)
    {
        $this->db->select('idProposal, namaGedung, judulProposal, deskripsiProposal, status, alokasiDana, dateCreated');
        $this->db->from('proposal');
        $this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'right');
        if ($ged!='ALL') {
            // $this->db->where(array('dateDeleted' => NULL));
            $this->db->where('gedung.idGedung', $ged);
        }

        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function getListPekerjaan($kerja)
    {
        $this->db->select('idPekerjaan, detailPekerjaan');
        $this->db->from('pekerjaan');
        $this->db->join('proposal', 'pekerjaan.idProposal = proposal.idProposal', 'left');
        $this->db->where('idPekerjaan', $kerja);

        $query = $this->db->get();
        return $query->result_array();
    }

    /*function getListRuang()
    {
        # code...
    }*/
}

/* End of file beranda_model.php */
/* Location: ./application/models/beranda_model.php */
