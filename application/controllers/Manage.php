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
            	} else {
            		$data['all_user'][$u]['userLevel']='SARPRAS';
            	}
            	$u++;
            }
			$this->load->view('masuk/admin_view', $data);
        } else {
        	redirect('beranda','refresh');
        }
		// return true;
	}

	function createUser()
	{
		// $this->Manage_model->
		return true;
	}

	function updateUser($id)
	{
		return true;
	}

	function deleteUser($id)
	{
		$data['hasil'] = $this->Manage_model->deleteUser($id);
		$this->load->view('masuk/admin_view', $data);
	}

}

/* End of file Manage.php */
/* Location: ./application/controllers/Manage.php */