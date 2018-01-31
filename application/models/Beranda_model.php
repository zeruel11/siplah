<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

/**
 * database read data gedung minimal
 * @method getListGedung
 * @param  mixed        $mode list gedung yang diambil
 * @return array              sql result
 */
		public function getListGedung($mode)
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

/**
 * luas seluruh bangunan
 * @method totalLuas
 * @return string    total luas gedung
 */
		public function totalLuas()
		{
			$sql = "SELECT SUM(luasGedung) AS luas FROM gedung";
			$result = $this->db->query($sql);
			return $result->result();
		}

/**
 * database search
 * @method searchListGedungByName
 * @param  string                 $ged nama gedung
 * @return array                      search result database
 */
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

/**
 * database read data gedung complete
 * @method getDataGedung
 * @param  int           $ged idGedung
 * @return array             data gedung
 */
		public function getDataGedung(int $ged)
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

/**
 * database read list renovasi/proposal
 * @method getListRenovasi
 * @param  string           $ged  idGedung, 'ALL'
 * @param  int             $mode which proposal to get
 * @return array                data renovasi/proposal
 */
		function getListRenovasi(string $ged, int $mode)
		{
			if ($mode==1) {
				$this->db->select('proposal.idProposal, gedung.idGedung, namaGedung, judulProposal, deskripsiProposal, proposal.status, alokasiDana, dateCreated, dateDeleted');
						$this->db->select('(SELECT COUNT(*) FROM pekerjaan WHERE pekerjaan.idProposal = proposal.idProposal AND pekerjaan.status=1) as done', false);
						$this->db->select('(SELECT COUNT(*) FROM pekerjaan WHERE pekerjaan.idProposal = proposal.idProposal) as kerja', false);
				$this->db->from('proposal');
				$this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'right');
						$this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'left');
				if ($ged!='ALL') {
								// $this->db->where(array('dateDeleted' => NULL));
					$this->db->where('gedung.idGedung', $ged);
				} else {
								$this->db->where('proposal.idProposal is NOT NULL', NULL, FALSE);
						}
						$this->db->group_by('idProposal');
				$this->db->order_by('namaGedung', 'asc');
			$this->db->order_by('dateCreated', 'asc');
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

/**
 * database create renovasi/proposal
 * @method createRenovasi
 * @param  array         $data data proposal
 * @return int               db rows
 */
		function createRenovasi($data)
		{
			$sql = "INSERT INTO `proposal` (`idGedung`, `judulProposal`, `deskripsiProposal`, `dateCreated`) VALUES ('".$data['idGedung']."', '".$data['judulProposal']."', '".$data['deskripsiProposal']."', CURDATE())";
			$this->db->query($sql);
				return $this->db->affected_rows();
		}

/**
 * database update renovasi/proposal
 * @method updateRenovasi
 * @param  int            $renovasi idProposal
 * @param  array          $data     data renovasi
 * @return int                   db rows affected
 */
		function updateRenovasi(int $renovasi, array $data)
		{
			$this->db->where('idProposal', $renovasi);
			$this->db->update('proposal', $data);
			return $this->db->affected_rows();
		}

/**
 * database update renovasi/proposal status
 * @method updateStatusRenovasi
 * @param  int                  $renovasi idProposal
 * @param  int                  $mode     status update to
 * @return int                         db row affected
 */
		function updateStatusRenovasi(int $renovasi, int $mode)
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

/**
 * database delete renovasi/proposal
 * @method deleteRenovasi
 * @param  int         $renovasi idProposal
 * @return int                   db rows
 */
		function deleteRenovasi(int $renovasi)
		{
			$this->db->delete('proposal', array('idProposal' => $renovasi));
			return $this->db->affected_rows();
		}

		function getPekerjaan($kerja, $mode)
		{
			$this->db->select('idPekerjaan, detailPekerjaan, pekerjaan.status, proposal.idProposal, judulProposal, deskripsiProposal, dateCreated, dateDeleted');
			$this->db->from('proposal');
			$this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'left');
			if ($mode==1) {
				$this->db->where('proposal.idProposal', $kerja);
			} elseif ($mode==2) {
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
				return $this->db->affected_rows();
		}

		function updatePekerjaan($kerja, $data)
		{
			$this->db->where('idPekerjaan', $kerja);
			$this->db->update('pekerjaan', $data);
			return $this->db->affected_rows();
		}

		function cekPekerjaan($kerja)
		{
			$this->db->where('idPekerjaan', $kerja);
			$this->db->update('pekerjaan', $object);
				return $this->db->affected_rows();
		}

		function createPekerjaan($data)
		{
			$this->db->insert('pekerjaan', $data);
			return $this->db->affected_rows();
		}

			}

/* End of file beranda_model.php */
/* Location: ./application/models/beranda_model.php */
