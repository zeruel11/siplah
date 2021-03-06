<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function getUser()
	{
		$this->db->select('uid, username, user_level, namaLengkap');
		$this->db->from('user');

		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return null;
		}
	}

	function createUser($send)
	{
		$this->db->insert('user', $send);
		return $this->db->affected_rows();
	}

	function editUser($id)
	{
		$this->db->select('uid, username, password, user_level, namaLengkap');
		$this->db->from('user');
		$this->db->where('uid', $id);

		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return null;
		}
	}

	function updateUser($id, $send)
	{
		$this->db->where('uid', $id);
		$this->db->update('user', $send);
		return $this->db->affected_rows();
	}

	function resetPwd($id)
	{
		$this->db->where('uid', $id);
		$this->db->update('user', array(
				'password'=>md5('123qwe')
				));
		return $this->db->affected_rows();
	}

	function deleteUser($id)
	{
		$this->db->delete('user', array('uid' => $id));
		return $this->db->affected_rows();
	}

}

/* End of file Manage_model.php */
/* Location: ./application/models/Manage_model.php */
