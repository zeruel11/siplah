<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function importPekerjaan(array $data)
	{
		$result = $this->db->insert_batch('pekerjaan', $data);
		return $result;
	}

}

/* End of file Excel_model */
/* Location: ./application/models/Excel_model */
