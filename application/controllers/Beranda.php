<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Beranda_model');
        $this->load->library('Encryption');
        // $this->load->library('breadcrumb');
        $this->load->library('pagination');
    }

	function index()
	{
		if ($this->session->userdata('logged_in')) {
			$data = $this->session->userdata('logged_in');
			// $data['nama'] = $this->session->userdata('namaLengkap');
			$this->load->view('header', $data);
			$this->load->view('masuk/beranda_login', $data);
			// redirect('index.php/beranda/master','refresh');
		} else {
			// $list = $this->model->getListGedung();
			$this->load->view('header');
			$this->load->view('beranda_view');
		}
	}

	function masuk()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('beranda','refresh');
		} else {
			$this->load->helper(array('form'));
			$this->load->view('login_view');
		}

	}

	function keluar()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		$this->session->sess_destroy();
		redirect('beranda');
	}

	/*function master()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('index.php/beranda','refresh');
		} else {
			$data = $this->session->userdata('logged_in');
			$this->load->view('masuk/beranda_login');
		}

	}*/

	/*function dataGedung()
	{

	}*/

}

/* End of file beranda.php */
/* Location: ./application/controllers/beranda.php */
