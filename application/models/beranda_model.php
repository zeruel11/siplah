<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {
	function Beranda_model()
	{
		parent::__construct();
	}

	function getListGedung()
	{
		$this->db->get('gedung');
	}

	

}

/* End of file beranda_model.php */
/* Location: ./application/models/beranda_model.php */