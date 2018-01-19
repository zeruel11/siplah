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
		$data['all_user'] = $this->Manage_model->getUser();
		$this->load->view('masuk/admin_view', $data);
		// return true;
	}

	function createUser()
	{
		// $this->Manage_model->
		return true;
	}

	function updateUser()
	{
		return true;
	}

	function deleteUser()
	{
		return true;
	}

}

/* End of file Manage.php */
/* Location: ./application/controllers/Manage.php */
?>
