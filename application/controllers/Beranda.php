<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    /**
     * global variable data
     * @var array
     */
    var $data;
    public $foo;

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
        } elseif ($this->uri->uri_string() != '' && $this->uri->uri_string() != 'beranda' && $this->uri->uri_string() != 'login' && ! preg_match( '/^gedung\/\d+/', $this->uri->uri_string())) {
            // $this->data['message'] = "Anda belum login";
            $this->session->set_flashdata('warn', 'Anda belum login');
            // if ($_SERVER['URI_REQUEST'] != "/siplah/beranda") header("Location: /siplah/beranda");
            // redirect('beranda', 'location', 301);
            if ($this->uri->uri_string() != '') {
                redirect('');
            }
        }
        if ($this->session->flashdata('message')) {
            $this->data['message'] = $this->session->flashdata('message');
        }
    }

    public function index()
    {
        $data = $this->data;
        $data['luasTotal'] = $this->Beranda_model->totalLuas();
        // if ($this->session->flashdata('message')) {
        //     $data['message'] = $this->session->flashdata('message');
        // }
        if ($this->session->flashdata('warn')) {
            $data['warn'] = $this->session->flashdata('warn');
        }
        if ($this->session->flashdata('cari')) {
            $data['listGedung'] = $this->session->flashdata('cari');
        } else {
            $data['listGedung'] = $this->Beranda_model->getListGedung('full');
        }
        if (isset($this->data['userLogin'])) {
            if ($data['userLogin']['userLevel']==4) {
                // $data['listGedung'] = $this->Beranda_model->getListGedung('sarpras');
                if ($this->session->flashdata('cari')) {
                    $data['listGedung'] = $this->session->flashdata('cari');
                } else {
                    $data['listGedung'] = $this->Beranda_model->getListGedung('sarpras');
                }
                $this->load->view('template/header', $data);
                $this->load->view('template/navigation', $data);
                $this->load->view('template/menu', $data);
                $this->load->view('masuk/beranda_view', $data);
                $this->load->view('template/footer', $data);
            } elseif ($data['userLogin']['userLevel']==1 || $data['userLogin']['userLevel']==2 || $data['userLogin']['userLevel']==3 || $data['userLogin']['userLevel']==5) {
                if ($this->session->flashdata('cari')) {
                    $data['listGedung'] = $this->session->flashdata('cari');
                } else {
                    $data['listGedung'] = $this->Beranda_model->getListGedung('full');
                }
                $this->load->view('template/header', $data);
                $this->load->view('template/navigation', $data);
                $this->load->view('template/menu', $data);
                $this->load->view('masuk/beranda_view', $data);
                $this->load->view('template/footer', $data);
                // redirect('index.php/beranda/master','refresh');
            }
        } else {
            // $data['userLogin'] = "false";
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('beranda_view', $data);
            $this->load->view('template/footer', $data);
        }
    }

/**
 * read data gedung
 * @method detailGedung
 * @param  int       $ged $idGedung
 * @return int            detail data gedung
 */
    public function detailGedung($ged)
    {
        $data = $this->data;
        $result = $this->Beranda_model->getDataGedung($ged);

        if ($result) {
            $data['detailGedung'] = $result;
        } else {
            $data['detailGedung'] = null;
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation', $data);
        if ($this->session->userdata('logged_in')) {
            $this->load->view('template/menu', $data);
        }
        $this->load->view('data_gedung_view', $data);
        $this->load->view('template/footer', $data);
    }

/**
 * fungsi search
 * @method searchGedung
 * @return string       search result
 */
    public function searchGedung()
    {
        $data = $this->data;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cari_gedung', 'Search', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "Harap masukkan nama gedung");
        } else {
            $search = $this->input->post('cari_gedung');
            $result = $this->Beranda_model->searchListGedungByName($search);
            if ($result) {
                $this->session->set_flashdata('cari', $result);
            } else {
                $this->session->set_flashdata('message', "Gedung tidak ditemukan");
            }
        }

        redirect('beranda');
    }

    /**
     * fungsi login
     * @return mixed data_login
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
     * @return mixed destroy session
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

/**
 * update renovasi/proposal setuju
 * @method setuju
 * @param  int $renovasi idProposal
 * @return string           message status
 */
    function setuju($renovasi)
    {
        $this->Beranda_model->updateStatusRenovasi($renovasi, 1);
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        redirect($this->session->userdata('refered_from'));
    }

/**
 * update renovasi/proposal tolak
 * @method tolak
 * @param  int $renovasi idProposal
 * @return string           message status
 */
    function tolak($renovasi)
    {
        $this->Beranda_model->updateStatusRenovasi($renovasi, 0);
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        redirect($this->session->userdata('refered_from'));
    }

/**
 * read renovasi/proposal
 * @method dataRenovasi
 * @param  int       $ged idProposal, idPekerjaan, atau idGedung
 * @return mixed            load renovasi_view
 */
    function dataRenovasi($ged)
    {
        // if ($result) {
        // $data['dataRenovasi'] = $result;
        // }else {
        // $data['dataRenovasi'] = null;
        // }

        $data = $this->data;
        if ($ged=='proposal') {
            $data['dataRenovasi'] = $this->Beranda_model->getListRenovasi((int)$ged, 3);
        } elseif ($ged=='kerja') {
            $data['dataRenovasi'] = $this->Beranda_model->getListRenovasi((int)$ged, 4);
        } else {
            $data['dataRenovasi'] = $this->Beranda_model->getListRenovasi($ged, 1);
        }
        // if ($this->session->flashdata('hasil')) {
        // 	$data['hasil'] = $this->session->flashdata('hasil');
        // }
        // if (count($data['dataRenovasi'])==1) {
        // $this->foo=20;
        // }

        $this->session->set_userdata('gedung', $data['dataRenovasi']);

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('masuk/renovasi_view', $data);
        $this->load->view('template/footer', $data);
    }

/**
 * update renovasi/proposal selesai
 * @method doneRenovasi
 * @param  int       $renovasi idProposal
 * @return string                 message status
 */
    function doneRenovasi($renovasi)
    {
        $result = $this->Beranda_model->updateStatusRenovasi($renovasi, 2);
        if ($result>0) {
            $this->session->set_flashdata('message', 'Renovasi Selesai');
        } else {
            $this->session->set_flashdata('message', 'Update gagal!! Harap coba lagi');
        }
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        redirect($this->session->userdata('refered_from'));
    }

/**
 * create renovasi/proposal
 * @method tambahRenovasi
 * @return string         message status
 */
    function tambahRenovasi()
    {
        $data = $this->data;
        $data['gedung'] = $this->session->userdata('gedung');
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        // $data['idGed'] = $this->dataRenovasi();
        // if ($this->session->flashdata('gedung')) {
        //     $data['idGedung'] = $idGedung;
        // }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judulProposalForm', 'Judul Proposal', 'required');
        $this->form_validation->set_rules('deskripsiProposalForm', 'Deskripsi Proposal', 'required');

        if ($this->form_validation->run() == false) {
            $data['mode']="insert";
            $data['cancel'] = $this->session->userdata('refered_from');
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/renovasi_form', $data);
            $this->load->view('template/footer', $data);
        } else {
            // $id = $data['gedung_renovasi'][0]['idGedung'];
            $send = array(
            'idGedung'=>$data['gedung'][0]['idGedung'],
            'judulProposal'=>$this->input->post('judulProposalForm'),
            'deskripsiProposal'=>$this->input->post('deskripsiProposalForm')
            );
            $this->Beranda_model->createRenovasi($send);
            $url = "renovasi/".$data['gedung'][0]['idGedung'];
            redirect($url);
            // $data['mode']="insert";
            // $this->load->view('template/header', $data);
            // $this->load->view('template/navigation', $data);
            // $this->load->view('masuk/renovasi_form', $data);
            // $this->load->view('template/footer', $data);
            // $this->session->set_flashdata('gedung', $idGedung);
        }
    }

/**
 * update renovasi/proposal
 * @method ubahRenovasi
 * @param  int       $renovasi idProposal
 * @return string                 message status
 */
    function ubahRenovasi($renovasi)
    {
        $data = $this->data;
        $data['gedung'] = $this->session->userdata('gedung');
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        // if ($this->session->flashdata('gedung')) {
        //     $data['idGedung'] = $idGedung = $this->session->flashdata('gedung');
        // }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judulProposalForm', 'Judul Proposal', 'required');
        $this->form_validation->set_rules('deskripsiProposalForm', 'Deskripsi Proposal', 'required');

        if ($this->form_validation->run() == false) {
            $data['dataRenovasi'] = $this->Beranda_model->getListRenovasi((int)$renovasi, 2);
            $data['mode'] = "edit";
            $data['cancel'] = $this->session->userdata('refered_from');
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/renovasi_form', $data);
            $this->load->view('template/footer', $data);
            // $this->session->set_flashdata('gedung', $idGedung);
        } else {
            $send = array(
            // 'idGedung'=>$idGedung,
            'judulProposal'=>$this->input->post('judulProposalForm'),
            'deskripsiProposal'=>$this->input->post('deskripsiProposalForm')
            );
            $this->Beranda_model->updateRenovasi($renovasi, $send);
            $url = "renovasi/".$data['gedung'][0]['idGedung'];
            redirect($url);
        }
    }

/**
 * delete renovasi/proposal
 * @method hapusRenovasi
 * @param  int        $renovasi idProposal
 * @return string                  message status
 */
    function hapusRenovasi($renovasi)
    {
        $data = $this->data;
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        $result = $this->Beranda_model->deleteRenovasi((int)$renovasi);
        $this->session->set_flashdata('message', $result);
        redirect($this->session->userdata('refered_from'));
    }

/**
 * read pekerjaan
 * @method listPekerjaan
 * @param  int        $kerja idPekerjaan
 * @return mixed               data pekerjaan
 */
    function listPekerjaan($kerja)
    {
        $data = $this->data;
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }
        $result = $this->Beranda_model->getPekerjaan((int)$kerja, 1);
        if ($result!=null) {
            $data['dataPekerjaan'] = $result;
            $this->session->set_flashdata('proposal', (int)$data['dataPekerjaan'][0]['idProposal']);
            // TODO change this to session_userdata item
        } else {
            $data['dataPekerjaan'] = $this->Beranda_model->getListRenovasi((int)$kerja, 2);
            $this->session->set_flashdata('proposal', $kerja);
        }

        // $p=0; $b=0;
        // foreach ($data['dataPekerjaan'] as $row) {
        //     if ($data['dataPekerjaan'][$b]['status']=='1') {
        //         $b++;
        //     }
        //     $p++;
        // }
        // $data['proses'] = round($b/count($data['dataPekerjaan']), 2)*100;

        if ($data['userLogin']['userLevel']==4) {
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('template/menu', $data);
            $this->load->view('masuk/pekerjaan_ceklis', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('template/menu', $data);
            $this->load->view('masuk/pekerjaan_view', $data);
            $this->load->view('template/footer', $data);
        }
    }

/**
 * delete pekerjaan
 * @method hapusPekerjaan
 * @param  int         $kerja idPekerjaan
 * @return string                message status
 */
    function hapusPekerjaan($kerja)
    {
        $data = $this->data;
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        $data['hasil'] = $this->Beranda_model->deletePekerjaan((int)$kerja);
        $this->session->set_flashdata('hasil', $data['hasil']);
        redirect($this->session->userdata('refered_from'));
    }

/**
 * update pekerjaan
 * @method ubahPekerjaan
 * @param  int        $kerja idPekerjaan
 * @return string               message status
 */
    function ubahPekerjaan($kerja)
    {
        $data = $this->data;
        $idProposal = $this->session->flashdata('proposal');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('detailPekerjaanForm', 'Detail Pekerjaan', 'required');
        // $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));

        if ($this->form_validation->run() == false) {
            $data['dataPekerjaan'] = $this->Beranda_model->getPekerjaan($kerja, 2);
            $data['mode'] = "edit";
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/pekerjaan_form', $data);
            $this->load->view('template/footer', $data);
            $this->session->set_flashdata('proposal', $idProposal);
        } else {
            $data = array(
            'detailPekerjaan'=>$this->input->post('detailPekerjaanForm')
            );
            $this->Beranda_model->updatePekerjaan($kerja, $data);
            $url = "renovasi/pekerjaan/".$idProposal;
            redirect($url);
        }
    }

/**
 * update pekerjaan selesai
 * @method selesaiPekerjaan
 * @return string           message status
 */
    function selesaiPekerjaan()
    {
        $data=$this->data;
        $check = $this->input->post('pekerjaanCheck');
        foreach ($check as $id) {
          $send = array(
            'status'=>1
          );
          $this->Beranda_model->donePekerjaan((int)$id, $send);
        }
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        // $data['hasil'] = $this->Beranda_model->deletePekerjaan((int)$kerja);
        // $this->session->set_flashdata('hasil', $data['hasil']);
        redirect($this->session->userdata('refered_from'));
    }

/**
 * create pekerjaan
 * @method tambahPekerjaan
 * @return string          message status
 */
    function tambahPekerjaan()
    {
        $data = $this->data;
        $idProposal = $this->session->flashdata('proposal');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('detailPekerjaanForm', 'Detail Pekerjaan', 'required');

        if ($this->form_validation->run() == false) {
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


}

/* End of file beranda.php */
