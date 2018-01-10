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
		 $data['listGedung'] = $this->Beranda_model->getListGedung();

		//  if ($list) {
		//  	foreach ($list as $row) {
		//  		$data['listGedung'] = array(
		// 			'gedungId' => $row->idGedung,
		// 		'namaGedung' => $row->namaGedung,
		// 	'x' => $row->x,
		// 'y' => $row->y );
		//  	}
		//  }

		if ($this->session->userdata('logged_in')) {
			$data = $this->session->userdata('logged_in');
			if ($data['userLevel']==1) {
				$data['userAuth'] = "Admin";
			} elseif ($data['userLevel']==2) {
				$data['userAuth'] = "Pegawai";
			} else {
				$data['userAuth'] = "Pengguna Lain";
			}

			// $data['testing'] = $this->session->userdata['logged_in']['uid'];
			$this->load->view('header', $data);
			$this->load->view('navigation', $data);
			// $this->load->view('testpage', $data);
			$this->load->view('masuk/beranda_view', $data);
			$this->load->view('footer', $data);
			// redirect('index.php/beranda/master','refresh');
		} else {
			// $data['userLogin'] = "false";
			$this->load->view('header', $data);
			$this->load->view('navigation', $data);
			$this->load->view('beranda_view', $data);
			$this->load->view('footer', $data);
		}
	}

	function detailGedung($ged)
	{
		$result = $this->Beranda_model->getDataGedung($ged);

		if ($result) {
			$data['detailGedung'] = array();
			foreach ($result as $row) {
				$data['detailGedung'] = array(
					'idGedung' => $row->idGedung,
					'namaGedung' => $row->namaGedung);
			}
		}
		$this->load->view('data_gedung', $data);
	}

	function masuk()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('beranda','refresh');
		} else {
			$data['validLogin']=$this->session->flashdata('validUser');
			// $this->load->helper(array('form'));
			$this->load->view('login_view', $data);
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
