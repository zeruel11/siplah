<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Manage_model');
	}

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
            	$u++;
            }
			$this->load->view('masuk/admin_view', $data);
        } else {
					$this->session->set_flashdata('message', 'Anda belum login');
        	redirect('beranda','refresh');
        }
		// return true;
	}

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
				$this->Manage_model->createUser($send);
				redirect('manage');
		}
	}

	function updateUser($id)
	{
		if ($this->session->userdata('logged_in')) {
			$data['userLogin'] = $this->session->userdata('logged_in');
		}
		// $data = $this->data;
        // $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        // $idProposal = $this->session->flashdata('proposal');
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
            $this->Manage_model->updateUser($id, $send);
            redirect('manage');
        }
	}

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

	function changePassword($id)
	{
		# code...
	}

}

/* End of file Manage.php */
/* Location: ./application/controllers/Manage.php */
