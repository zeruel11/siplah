<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	/*function Login_model()
	{
		parent::__construct();
	}*/

/**
 * login db
 * @method login
 * @param  int $username uid
 * @param  string $password password md5
 */
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

/**
 * db reset password
 * @method chPwd
 * @param  int    $id   uid
 * @param  array  $data default password
 * @return int       affected rows
 */
	function chPwd(int $id, array $data)
	{
		$this->db->where('uid', $id);
		$this->db->update('user', $data);
		return $this->db->affected_rows();;
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */
