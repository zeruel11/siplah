<?php 
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
		$this->load->view('admin');
	}

	function createUser()
	{
		$this->Manage_model->
	}

	function updateUser()
	{
		# code...
	}

	function deleteUser()
	{
		# code...
	}

}

/* End of file Manage.php */
/* Location: ./application/controllers/Manage.php */
?>