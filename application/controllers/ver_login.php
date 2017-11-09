<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ver_login extends CI_Controller {
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

	function index()
	{
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
					'username' => $row->username,
					'user_level' => $row->user_level,
					'namaLengkap' => $row->namaLengkap
				);
				
				$this->session->set_userdata( 'logged_in', $sess_array );
			}
			// return true;
			redirect('beranda', 'refresh');
		} else {
			// return false;
			redirect('beranda', 'refresh');
		}
		
	}

}

/* End of file ver_login.php */
/* Location: ./application/controllers/ver_login.php */