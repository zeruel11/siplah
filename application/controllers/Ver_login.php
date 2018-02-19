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
		$this->load->model('Login_model');
	}

/**
 * validate login
 * @method index
 * @return mixed user data
 * @todo change to use CI form validator
 */
	function index()
	{
		// Validation variable
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// Query db
		$result = $this->Login_model->login($username, $password);

		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'uid' => $row->uid,
					'username' => $row->username,
					'userLevel' => $row->user_level,
					'namaLengkap' => $row->namaLengkap
				);

				$this->session->set_userdata( 'logged_in', $sess_array );
			}
			//check password default
			if ($password=='123qwe') {
				// $this->session->set_userdata('pwd', 'changed');
				$this->session->set_flashdata('pwd', 'changed');
			}
			// echo "true";
			redirect('beranda', 'refresh');
		} else {
			$this->session->set_flashdata('validUser', 'false');
			// echo "false";
			redirect('login', 'refresh');
		}

	}

/**
 * user change password after reset
 * @method changepwd
 * @param  int       $id uid
 * @return string        status
 */
	function changepwd($id)
	{
		$data['userLogin'] = $this->session->userdata('logged_in');
		$data['cancel'] = base_url();
		// $user = ;
		// $oldPwd = ;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sandiLewat', 'password lama', array(
			'callback__check_pass'
		));
		$this->form_validation->set_rules('sandiLewatBaru', 'password baru', array(
			'required', 'min_length[6]'
		), array(
			'required' => 'Harap masukkan {field}',
			'min_length' => 'Password minimal 6 karakter'
		));
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navigation', $data);
			$this->load->view('masuk/password_form', $data);
			$this->load->view('template/footer', $data);
		} else {
			$send = array(
			'password'=>md5($this->input->post('sandiLewatBaru'))
			);
			$result = $this->Login_model->chPwd((int)$id, $send);
			if ($result==1) {
				$this->session->set_flashdata('message', 'Password anda berhasil diubah');
				$this->session->unset_userdata('pwd');
			} else {
				$this->session->set_flashdata('message', 'Perubahan password gagal, mohon coba kembali');
			}
			redirect('beranda','refresh');
			// echo "false";
		}
	}

	function _check_pass(string $pass)
	{
		if ($pass==NULL) {
			$this->form_validation->set_message('_check_pass', 'Harap masukkan {field}');
			return false;
		} else {
			$test = $this->Login_model->login($this->session->userdata['logged_in']['username'], $pass);
			if ($test==false) {
				$this->form_validation->set_message('_check_pass', 'Password lama anda salah!');
				return false;
			} else {
				return true;
			}
		}
	}

}

/* End of file ver_login.php */
/* Location: ./application/controllers/ver_login.php */
