<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
  /**
   * global variable data
   * @var array
   */
  var $data;

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
        if ($this->session->userdata('logged_in')) {
            $this->data['userLogin'] = $this->session->userdata('logged_in');
        }
        if ($this->session->flashdata('message')) {
          $this->data['message'] = $this->session->flashdata('message');
        }
    }

    public function index()
    {
      $data = $this->data;
        if ($this->session->flashdata('cari')) {
            $data['listGedung'] = $this->session->flashdata('cari');
        } else {
            $data['listGedung'] = $this->Beranda_model->getListGedung();
        }
        if ($this->session->flashdata('not_found')) {
          $data['message'] = "Gedung tidak ditemukan";
        }

        if ($this->session->userdata('logged_in')) {
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
    public function detailGedung($ged)
    {
        $result = $this->Beranda_model->getDataGedung($ged);

        if ($result) {
            $data['detailGedung'] = $result;
        } else {
            $data['detailGedung'] = null;
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation', $data);
        $this->load->view('data_gedung_view', $data);
        $this->load->view('template/footer', $data);
    }

    public function searchGedung()
    {
        $search = $this->input->post('gedung');
        $result = $this->Beranda_model->searchListGedungByName($search);
        if ($result) {
          $this->session->set_flashdata('cari', $result);
        } else {
          $this->session->set_flashdata('not_found', 1);
        }

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

    function dataRenovasi($ged)
    {
        // if ($result) {
        // $data['dataRenovasi'] = $result;
        // }else {
        // $data['dataRenovasi'] = null;
        // }

        $data = $this->data;
        if ($this->session->flashdata('hasil')) {
        	$data['hasil'] = $this->session->flashdata('hasil');
        }
        $data['dataRenovasi'] = $this->Beranda_model->getListRenovasi((int)$ged);

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('masuk/renovasi_view', $data);
        $this->load->view('template/footer', $data);
    }

    function deleteRenovasi($renovasi)
    {
    	$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
    	$data['hasil'] = $this->Beranda_model->hapusProposal((int)$renovasi);
    	$this->session->set_flashdata('hasil', $data['hasil']);
    	redirect($this->session->userdata('refered_from'));
    }

    function listPekerjaan($kerja)
    {
        $data = $this->data;
        if ($this->session->flashdata('hasil')) {
        	$data['hasil'] = $this->session->flashdata('hasil');
        }
        $data['dataPekerjaan'] = $this->Beranda_model->getPekerjaan((int)$kerja, 1);

        // $p=0; $b=0;
        // foreach ($data['dataPekerjaan'] as $row) {
        //     if ($data['dataPekerjaan'][$b]['status']=='1') {
        //         $b++;
        //     }
        //     $p++;
        // }
        // $data['proses'] = round($b/count($data['dataPekerjaan']), 2)*100;
        $this->session->set_flashdata('proposal', (int)$data['dataPekerjaan'][0]['idProposal']);

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('masuk/pekerjaan_view', $data);
        $this->load->view('template/footer', $data);
    }

    function hapusPekerjaan($kerja)
    {
    	$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
    	$data['hasil'] = $this->Beranda_model->deletePekerjaan((int)$kerja);
    	$this->session->set_flashdata('hasil', $data['hasil']);
    	redirect($this->session->userdata('refered_from'));
    }

    function ubahPekerjaan($kerja)
    {
        $data = $this->data;
        // $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        $idProposal = $this->session->flashdata('proposal');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('detailPekerjaanForm', 'Detail Pekerjaan', 'required');
        // $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
        // $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            // $data['dataPekerjaan'] = $this->Beranda_model->getPekerjaan((int)$kerja, 2);
            $data['dataPekerjaan'] = $this->Beranda_model->getPekerjaan($kerja, 2);
            $data['mode'] = "edit";
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/pekerjaan_form', $data);
            $this->load->view('template/footer', $data);
            $this->session->set_flashdata('proposal', $idProposal);
        } else {
            // $this->load->model('Users_model');
            // $this->Users_model->insert_user();
            $data = array(
            'detailPekerjaan'=>$this->input->post('detailPekerjaanForm')
            );
            $this->Beranda_model->updatePekerjaan($kerja, $data);
            $url = "renovasi/pekerjaan/".$idProposal;
            redirect($url);
            // redirect($this->session->userdata('refered_from'));
        }
    }

    function tambahPekerjaan()
    {
        $data = $this->data;
        $idProposal = $this->session->flashdata('proposal');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('detailPekerjaanForm', 'Detail Pekerjaan', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['mode']="insert";
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/pekerjaan_form', $data);
            $this->load->view('template/footer', $data);
            $this->session->set_flashdata('proposal', $idProposal);
        } else {
            $data = array(
            'idProposal'=>$idProposal,
            'detailPekerjaan'=>$this->input->post('detailPekerjaanForm')
            );
            $this->Beranda_model->createPekerjaan($data);
            $url = "renovasi/pekerjaan/".$idProposal;
            redirect($url);
        }
    }

    // function allRenovasi()
    // {
    //     $result = $this->Beranda_model->getListRenovasi();

    //     if ($result) {
    //         $data['dataRenovasi'] = $result;
    //     }else {
    //       $data['dataRenovasi'] = null;
    //     }
    // if ($this->session->userdata('logged_in')) {
    //     $data['userLogin'] = $this->session->userdata('logged_in');
    // }
    // $this->load->view('template/header', $data);
    // $this->load->view('template/navigation', $data);
    // $this->load->view('data_renovasi_view', $data);
    // $this->load->view('template/footer', $data);
    // }
}

/* End of file beranda.php */
