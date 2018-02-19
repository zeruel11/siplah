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
		public function getListGedung($mode = 'full')
		{
			if ($mode=='sarpras') {
				$this->db->select('gedung.idGedung, kodeGedung, namaGedung, luasGedung, x, y');
				$this->db->from('gedung');
				$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
				$this->db->join('proposal', 'proposal.idGedung = gedung.idGedung', 'right');
				$this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'right');
				$this->db->where(array(
					'proposal.status' => '2',
					'pekerjaan.status' => '0'
				));
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
			// $sql = "SELECT SUM(luasGedung) AS luas FROM gedung";
			$this->db->select_sum('luasGedung', 'luas');
			$result = $this->db->get('gedung');
			return $result->result();
		}

		function jumlahRenovasi($status)
		{
			if (is_int($status)) {
				$this->db->where('idGedung', $status);
			} elseif ($status=='spr') {
				$this->db->select('idGedung');
				$this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'right');
				$this->db->where(array(
					'proposal.status' => '2',
					'pekerjaan.status' => '0'
				));
				$this->db->group_by('idGedung');
			} elseif ($status!='ALL') {
				$orStatus = explode("|", $status);
				// $this->db->where('status', $orStatus[0]);
				foreach ($orStatus as $whereClause) {
					$this->db->or_where('status', $whereClause);
				}
			}
			$result = $this->db->get('proposal');
			return $result->num_rows();
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
		public function getDataGedung(int $ged, $mode = NULL)
		{
			if ($mode!=NULL) {
				$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, tinggiGedung, jumlahLantai, kategoriGedung, x, y, koordGedung');
				$this->db->join('koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left');
			} else {
				$this->db->select('idGedung, kodeGedung, namaGedung, luasGedung, tinggiGedung, jumlahLantai, kategoriGedung');
			}
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

		function deleteGedung(int $ged)
		{
			$this->db->delete('gedung', array('idGedung' => $ged));
			return $this->db->affected_rows();
		}

		function createGedung(array $data, string $mode = 'ged')
		{
			if ($mode=='koor') {
				$this->db->insert('koordinat', $data);
				return $this->db->insert_id();
			} else {
				$this->db->insert('gedung', $data);
				return $this->db->affected_rows();
			}
		}

		function updateGedung(int $ged, array $data, string $mode = 'ged')
		{
			if ($mode=='koor') {
				$this->db->where('idKoord', $ged);
				$this->db->update('koordinat', $data);
			} else {
				$this->db->where('idGedung', $ged);
				$this->db->update('gedung', $data);
			}
			return $this->db->affected_rows();
		}

		// function createCoordinate()
		// {
		// 	# code...
		// }

		// function updateCoordinate($coord)
		// {
		// 	# code...
		// }

		// function deleteCoordinate($coord)
		// {
		// 	# code...
		// }

/**
 * database read list renovasi/proposal
 * @method getListRenovasi
 * @param  string           $ged  idGedung, 'ALL'
 * @param  string             $mode which proposal to get
 * @return array                data renovasi/proposal
 */
		function getListRenovasi(string $ged, $mode = NULL)
		{
			if (!is_numeric($mode)) {
				switch ($mode) {
					case 'last':
						$this->db->select('idProposal, judulProposal, dateDeleted');
						$this->db->where(array('idGedung' => $ged, 'dateDeleted !=' => NULL));
						$this->db->order_by('dateDeleted', 'desc');
						$this->db->limit(1);
						break;
					case 'now':
						$this->db->select('idProposal, judulProposal, dateCreated');
						$this->db->where(array('dateDeleted' => NULL, 'idGedung' => $ged));
						$this->db->order_by('dateCreated', 'desc');
						$this->db->limit(1);
						break;
					default:
						$this->db->select('idProposal, judulProposal, deskripsiProposal, status');
						$this->db->where('idProposal', $ged);
						$this->db->order_by('dateCreated', 'asc');
						break;
				}
			} else {
				$this->db->select('proposal.idProposal, gedung.idGedung, namaGedung, judulProposal, deskripsiProposal, proposal.status, alokasiDana, dateCreated, dateDeleted');
				$this->db->select('(SELECT COUNT(*) FROM pekerjaan WHERE pekerjaan.idProposal = proposal.idProposal AND pekerjaan.status=1) as done', false);
				$this->db->select('(SELECT COUNT(*) FROM pekerjaan WHERE pekerjaan.idProposal = proposal.idProposal) as kerja', false);
				$this->db->join('gedung', 'gedung.idGedung = proposal.idGedung', 'right');
				$this->db->join('pekerjaan', 'pekerjaan.idProposal = proposal.idProposal', 'left');
				switch ($mode) {
					case 1:
						if ($ged!='ALL') {
							$this->db->where('gedung.idGedung', $ged);
						} else {
							$this->db->where('proposal.idProposal is NOT NULL', NULL, FALSE);
						}
						break;
					case 2:
						$this->db->where(array(
							'proposal.status' => 0,
							'dateDeleted' => NULL
						));
						break;
					case 3:
						$this->db->where('proposal.status', 2);
						$this->db->or_where('proposal.status', 6);
						break;
					case 4:
						$this->db->where('proposal.status', 2);
						break;
				}
				$this->db->group_by('idProposal');
				$this->db->order_by('namaGedung', 'asc');
				$this->db->order_by('dateCreated', 'asc');
			}
			$this->db->from('proposal');

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

		function updatePekerjaan($data, $kerja = NULL)
		{
			if ($kerja!=NULL) {
				$this->db->where('idPekerjaan', $kerja);
				$this->db->update('pekerjaan', $data);
				return $this->db->affected_rows();
			} else {
				return $this->db->update_batch('pekerjaan', $data, 'idPekerjaan');
			}
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
