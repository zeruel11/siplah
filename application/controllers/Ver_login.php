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

/**
 * validate login
 * @method index
 * @return mixed user data
 */
	function index()
	{
		// TODO: change to use CI form validator
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

/**
 * user change password after reset
 * @method changepwd
 * @param  int       $id uid
 * @return string        status
 */
	function changepwd(int $id)
	{
		$send = array(
						'password'=>$this->input->post(md5('sandiLewat'))
						);
		$result = $this->Login_model->chPwd((int)$id, $send);
		if ($result==1) {
			$this->session->set_flashdata('message', 'Password anda berhasil diubah');
		}
		redirect('beranda','refresh');
	}

}

/* End of file ver_login.php */
/* Location: ./application/controllers/ver_login.php */
