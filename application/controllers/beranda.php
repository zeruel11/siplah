<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function beranda() {
        parent::__construct();
        $this->load->model('resits_model');
        $this->load->library('Encryption');
        $this->load->library('breadcrumb');
        $this->load->library('pagination');

	public function index()
	{
		// $this->session->userdata('logged_in');
		$this->load->view('beranda_view.php');
	}
}

/* End of file beranda.php */
/* Location: ./application/controllers/beranda.php */