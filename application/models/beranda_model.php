<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getListGedung()
	{
		$this->db->get('gedung');
	}

	function getListRuang()
	{
		# code...
	}



}

/* End of file beranda_model.php */
/* Location: ./application/models/beranda_model.php */
