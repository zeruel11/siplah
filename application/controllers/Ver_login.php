<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ver_login extends CI_Controller {

	/**
	 * load required models
	 * @method __construct
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	/*function index()
	{
		if ($this->check_database() == FALSE) {
			redirect('beranda', 'refresh');
		} else {
			redirect('beranda', 'refresh');
		}

	}*/

/**
 * validate login
 * @method index
 * @return mixed user data
 */
	function index()
	{
		// Check flashdata
		// $validLogin=$this->session->flashdata('validUser');
		// var_dump($validLogin);

		// Validation variable
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// Query db
		$result = $this->login_model->login($username, $password);

		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'uid' => $row->uid,
					// 'username' => $row->username,
					'userLevel' => $row->user_level,
					'namaLengkap' => $row->namaLengkap
				);

				$this->session->set_userdata( 'logged_in', $sess_array );
			}
			// return true;
			redirect('beranda', 'refresh');
		} else {
			// return false;
			$this->session->set_flashdata('validUser', 'false');
			redirect('beranda/masuk', 'refresh');
		}

	}

}

/* End of file ver_login.php */
/* Location: ./application/controllers/ver_login.php */
