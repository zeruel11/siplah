<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

/**
 * load required model
 * @method __construct
 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('Manage_model');
	}

/**
 * tampilkan list user
 * @method index
 * @return array list user
 */
	function index()
	{
		if ($this->session->userdata('logged_in')) {
			$data['all_user'] = $this->Manage_model->getUser();
			$u=0;
			foreach ($data['all_user'] as $row) {
				if ($data['all_user'][$u]['user_level']=='1'){
					$data['all_user'][$u]['userLevel']='Administrator';
				} elseif ($data['all_user'][$u]['user_level']=='2') {
					$data['all_user'][$u]['userLevel']='Pegawai SIMRI';
				} elseif ($data['all_user'][$u]['user_level']=='3') {
					$data['all_user'][$u]['userLevel']='Wakil Rektor II';
				} elseif ($data['all_user'][$u]['user_level']=='4') {
					$data['all_user'][$u]['userLevel']='SARPRAS';
				} elseif ($data['all_user'][$u]['user_level']=='5') {
					$data['all_user'][$u]['userLevel']='Unit Fakultas/Jurusan';
				} else {
					$data['all_user'][$u]['userLevel']='Pengguna Lain';
				}
				$data['idModal'] = $row['uid'];
				$data['modal'][$row['uid']] = $this->load->view('modal/modal_delete', $data, TRUE);
				$data['modalR'][$row['uid']] = $this->load->view('modal/modal_reset', $data, TRUE);
				$u++;
			}
			if ($this->session->flashdata('message')) {
				$data['message'] = $this->session->flashdata('message');
			}
			$this->load->view('masuk/admin_view', $data);
		} else {
			$this->session->set_flashdata('message', 'Anda belum login');
			redirect('beranda','refresh');
		}
	}

/**
 * create new user
 * @method createUser
 * @return string     message status
 */
	function createUser()
	{
		if ($this->session->userdata('logged_in')) {
			$data['userLogin'] = $this->session->userdata('logged_in');
		}
		// $idProposal = $this->session->flashdata('proposal');
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('usernameForm', 'Username', 'required');
		$this->form_validation->set_rules('passwordForm', 'Password', 'required');
		$this->form_validation->set_rules('namaLengkapForm', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('user_levelForm', 'User Level', 'required');

		if ($this->form_validation->run() == FALSE)
		{
				$data['mode']="insert";
				$data['encPass'] = md5('test');
				$this->load->view('template/header', $data);
				// $this->load->view('template/navigation', $data);
				$this->load->view('masuk/manage_form', $data);
				// $this->load->view('template/footer', $data);
				// $this->session->set_flashdata('proposal', $idProposal);
		} else {
				$send = array(
				'username'=>$this->input->post('usernameForm'),
				'password'=>md5($this->input->post('passwordForm')),
				'namaLengkap'=>$this->input->post('namaLengkapForm'),
				'user_level'=>$this->input->post('user_levelForm')
				);
				$result = $this->Manage_model->createUser($send);
				if ($result==1) {
					$this->session->set_flashdata('message', 'Berhasil membuat user baru');
				}
				redirect('manage');
		}
	}

/**
 * update data user
 * @method updateUser
 * @param  int     $id uid
 * @return string         message status
 */
	function updateUser($id)
	{
		if ($this->session->userdata('logged_in')) {
			$data['userLogin'] = $this->session->userdata('logged_in');
		}
		$this->load->library(array('form_validation', 'encrypt'));
		$this->form_validation->set_rules('usernameForm', 'Username', 'required');
		// $this->form_validation->set_rules('passwordForm', 'Password', 'required');
		$this->form_validation->set_rules('namaLengkapForm', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('user_levelForm', 'User Level', 'required');
		// $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
		// $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			// $data['dataPekerjaan'] = $this->Beranda_model->getPekerjaan((int)$kerja, 2);
			$data['all_user'] = $this->Manage_model->editUser($id);
			$data['mode'] = "edit";
			$this->load->view('template/header', $data);
			// $this->load->view('template/navigation', $data);
			$this->load->view('masuk/manage_form', $data);
			// $this->load->view('template/footer', $data);
			// $this->session->set_flashdata('proposal', $idProposal);
		} else {
			$send = array(
			'username'=>$this->input->post('usernameForm'),
			// 'password'=>md5($this->input->post('passwordForm')),
			'namaLengkap'=>$this->input->post('namaLengkapForm'),
			'user_level'=>$this->input->post('user_levelForm')
			);
			$result = $this->Manage_model->updateUser($id, $send);
			if ($result==1) {
				$this->session->set_flashdata('message', 'User berhasil di update');
			}
			redirect('manage');
			}
	}

/**
 * hapus user
 * @method deleteUser
 * @param  int     $id uid
 * @return string         message status
 */
	function deleteUser($id)
	{
		$result = $this->Manage_model->deleteUser($id);
		if ($result==1) {
			$this->session->set_flashdata('message', 'User berhasil dihapus');
		} else {
			$this->session->set_flashdata('message', 'Gagal');
		}
		redirect('manage','refresh');
	}

/**
 * reset user password '123qwe'
 * @method resetPassword
 * @param  string        $id uid
 */
	function resetPassword($id)
	{
		$result = $this->Manage_model->resetPwd($id);
		if ($result==1) {
			$this->session->set_flashdata('message', 'Password user telah di reset ke password default "123qwe"');
		} else {
			$this->session->set_flashdata('message', 'Gagal melakukan reset password');
		}
		redirect('manage','refresh');
	}

}

/* End of file Manage.php */
/* Location: ./application/controllers/Manage.php */
