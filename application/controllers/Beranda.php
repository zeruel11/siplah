<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
	/**
	 * load default model dan library CI
	 * @method __construct
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Beranda_model');
        $this->load->library('Encryption');
        // $this->load->library('breadcrumb');
        $this->load->library('pagination');
    }

    public function index()
    {
        
        if($this->session->flashdata('cari')){
            $data['listGedung'] = $this->session->flashdata('cari');
        }else{
            $data['listGedung'] = $this->Beranda_model->getListGedung(); 
        }

        if ($this->session->userdata('logged_in')) {
            $data['userLogin'] = $this->session->userdata('logged_in');

            // $data['testing'] = $this->session->userdata['logged_in']['uid'];
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('template/menu', $data);
            $this->load->view('masuk/beranda_view', $data);
            $this->load->view('template/footer', $data);
            // redirect('index.php/beranda/master','refresh');
        } else {
            // $data['userLogin'] = "false";
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('beranda_view', $data);
            $this->load->view('template/footer', $data);
        }
    }

/**
 * fungsi view data Gedung
 * @param  int $ged idGedung
 * @return array      array(namaGedung,luasGedung,jumlahLantai)
 */
function detailGedung($ged)
{
    $result = $this->Beranda_model->getDataGedung($ged);

    if ($result) {
        $data['detailGedung'] = $result;
    }else {
      $data['detailGedung'] = null;
  }
  $this->load->view('template/header', $data);
  $this->load->view('template/navigation', $data);
  $this->load->view('data_gedung_view', $data);
  $this->load->view('template/footer', $data);
}

function searchGedung()
{
    $search = $this->input->post('gedung');
    $result = $this->Beranda_model->searchListGedungByName($search);

    if ($result) {
      $data['listGedung'] = $result;
  } else {
      $data['listGedung'] = null;
  }
  $this->session->set_flashdata('cari', $result);
  redirect('beranda');
}

/**
 * fungsi login
 * @return array data_login
 */
public function masuk()
{
    if ($this->session->userdata('logged_in')) {
        redirect('beranda', 'refresh');
    } else {
        $data['validLogin']=$this->session->flashdata('validUser');
            // $this->load->helper(array('form'));
        $this->load->view('login_view', $data);
    }
}

/**
 * fungsi logout
 * @return [type] destroy session
 */
public function keluar()
{
    $user_data = $this->session->all_userdata();
    foreach ($user_data as $key => $value) {
        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
            $this->session->unset_userdata($key);
        }
    }
    $this->session->sess_destroy();
    $this->session->userdata('logged_in');
    redirect('beranda');
}

}

/* End of file beranda.php */
/* Location: ./application/controllers/beranda.php */
