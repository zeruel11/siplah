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
		$idProposal = $this->session->flashdata('proposal');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('detailPekerjaanForm', 'Detail Pekerjaan', 'required');

		if ($this->form_validation->run() == FALSE)
		{
				$data['mode']="insert";
				// $this->load->view('template/header', $data);
				// $this->load->view('template/navigation', $data);
				$this->load->view('masuk/manage_form', $data);
				// $this->load->view('template/footer', $data);
				// $this->session->set_flashdata('proposal', $idProposal);
		} else {
				$data = array(
				'idProposal'=>$idProposal,
				'detailPekerjaan'=>$this->input->post('detailPekerjaanForm')
				);
				$this->Manage_model->createUser($data);
				// $url = "renovasi/pekerjaan/".$idProposal;
				redirect('manage');
		}
	}

	function updateUser($id)
	{
		return true;
	}

	function deleteUser($id)
	{
		$result = $this->Manage_model->deleteUser($id);
		if ($result==1) {
			$data['hasil'] = "success";
		} else {
			$data['hasil'] = "fail";
		}


		redirect('manage','refresh');
	}

}

/* End of file Manage.php */
/* Location: ./application/controllers/Manage.php */
