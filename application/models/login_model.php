<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	function Login_model()
	{
		parent::__construct();
	}
	
	function login($username, $password)
	{
		$this->db->select('uid, username, password, user_level, namaLengkap');
		$this->db->from('user');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query -> num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */