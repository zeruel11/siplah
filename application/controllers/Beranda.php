<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    /**
     * global data variable
     * @var array
     */
    private $data;
    // public $foo;

    /**
     * load default model dan library CI
     * @method __construct
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Beranda_model');
        $this->load->library('Encryption');
        // $this->load->library('breadcrumb');
        $this->load->library('pagination');
        if ($this->session->userdata('logged_in')) {
            $this->data['userLogin'] = $this->session->userdata('logged_in');
        } elseif ($this->uri->uri_string() != '' && $this->uri->uri_string() != 'beranda' && $this->uri->uri_string() != 'login' && ! preg_match('/^gedung\/\d+/', $this->uri->uri_string())) {
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
 * @param  int       $ged idGedung
 * @return array            detail data gedung
 */
    function detailGedung($ged)
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
 * @return array       search result
 */
    public function searchGedung()
    {
        $data = $this->data;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cari_gedung', 'Search', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "Harap masukkan <strong>nama gedung</strong>");
        } else {
            $search = $this->input->post('cari_gedung');
            $result = $this->Beranda_model->searchListGedungByName($search);
            if ($result) {
                $this->session->set_flashdata('cari', $result);
            } else {
                $this->session->set_flashdata('message', "Gedung tidak ditemukan. Apakah anda yakin <strong>nama gedung</strong> benar?");
            }
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
     * @return null destroy session
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
        $result = $this->Beranda_model->updateStatusRenovasi($renovasi, 1);
        if ($result==1) {
            $this->session->set_flashdata('message', 'Proposal renovasi telah disetujui');
        }
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
        if ($result==1) {
            $this->session->set_flashdata('message', 'Proposal renovasi telah ditolak');
        }
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        redirect($this->session->userdata('refered_from'));
    }

/**
 * read renovasi/proposal
 * @method dataRenovasi
 * @param  string       $ged idGedung, 'ALL', 'proposal', atau 'kerja'
 * @return array            data renovasi
 */
    function dataRenovasi($ged)
    {
        $data = $this->data;
        if ($this->session->flashdata('message')) {
          $data['message'] = $this->session->flashdata('message');
        }

        if ($ged=='proposal') {
            $result = $this->Beranda_model->getListRenovasi((int)$ged, 3);
        } elseif ($ged=='kerja') {
            $result = $this->Beranda_model->getListRenovasi((int)$ged, 4);
        } else {
            $result = $this->Beranda_model->getListRenovasi($ged, 1);
        }
        $data['dataRenovasi'] = $result;

        if ($result!=null) {
            $d=0;
            foreach ($data['dataRenovasi'] as $row) {
                if ($row['kerja']!=0) {
                    $data['dataRenovasi'][$d]['progress'] = round(($row['done']/$row['kerja'])*100);
                }
                $date = new DateTime($row['dateCreated']);
                $data['dataRenovasi'][$d]['dateCreated'] = $date->format('d-m-Y');
                if ($row['dateDeleted']!=NULL) {
                    $date = new DateTime($row['dateDeleted']);
                    $data['dataRenovasi'][$d]['dateDeleted'] = $date->format('d-m-Y');
                }
                $d++;
            }
        }

        if ($ged!='ALL') {
            $renovasi = array(
            'id' => $data['dataRenovasi'][0]['idGedung'],
            'url' => base_url().$this->uri->uri_string()
            );
        } else {
            $renovasi = array(
            'url' => base_url().$this->uri->uri_string(),
            );
        }
        $this->session->set_userdata('refered_from', $renovasi);
        $this->session->set_userdata('refered_from_renovasi', base_url().$this->uri->uri_string());
        // $this->session->set_userdata('gedung', $data['dataRenovasi']);

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
        if ($result==1) {
            $this->session->set_flashdata('message', 'Renovasi telah selesai');
        } else {
            $this->session->set_flashdata('message', 'Update gagal!! Harap coba lagi');
        }
        // $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        redirect($this->session->userdata['refered_from']['url']);
    }

    /**
     * create renovasi/proposal
     * @method tambahRenovasi
     * @return string         message status
     */
    function tambahRenovasi()
    {
        $data = $this->data;
        $data['mode']="insert";
        $data['cancel'] = $this->session->userdata['refered_from']['url'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('judulProposalForm', 'Judul Proposal', 'required');
        $this->form_validation->set_rules('deskripsiProposalForm', 'Deskripsi Proposal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/renovasi_form', $data);
            $this->load->view('template/footer', $data);
        } else {
            // $id = $data['gedung_renovasi'][0]['idGedung'];
            $send = array(
            'idGedung'=>$this->session->userdata['refered_from']['id'],
            'judulProposal'=>$this->input->post('judulProposalForm'),
            'deskripsiProposal'=>$this->input->post('deskripsiProposalForm')
            );
            $result = $this->Beranda_model->createRenovasi($send);
            if ($result==1) {
              $this->session->set_flashdata('message', 'Renovasi berhasil ditambahkan');
            }

            redirect($this->session->userdata['refered_from']['url']);
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
        $data['dataRenovasi'] = $this->Beranda_model->getListRenovasi((int)$renovasi, 2);
        $data['mode'] = "edit";
        $data['cancel'] = $this->session->userdata['refered_from']['url'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('judulProposalForm', 'Judul Proposal', 'required');
        $this->form_validation->set_rules('deskripsiProposalForm', 'Deskripsi Proposal', 'required');

        if ($this->form_validation->run() == false) {
            if ($this->input->post()) {
              $data['dataRenovasi'][0]['judulProposal'] = $this->input->post('judulProposalForm');
              $data['dataRenovasi'][0]['deskripsiProposal'] = $this->input->post('deskripsiProposalForm');
              // $data['dataRenovasi'] = $this->Beranda_model->getListRenovasi((int)$renovasi, 2);
            }
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
            $result = $this->Beranda_model->updateRenovasi($renovasi, $send);
            if ($result==1) {
              $this->session->set_flashdata('message', 'Renovasi telah diubah');
            }
            redirect($this->session->userdata['refered_from']['url']);
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
        // $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        $result = $this->Beranda_model->deleteRenovasi((int)$renovasi);
        if ($result==1) {
          $this->session->set_flashdata('message', 'Renovasi telah dihapus');
        }
        redirect($this->session->userdata['refered_from']['url']);
    }

/**
 * read pekerjaan
 * @method listPekerjaan
 * @param  int        $kerja idPekerjaan
 * @return array               data pekerjaan
 */
    function listPekerjaan($kerja)
    {
        $data = $this->data;
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }
        $data['back'] = $this->session->userdata('refered_from_renovasi');
        $result = $this->Beranda_model->getPekerjaan((int)$kerja, 1);
        $data['dataPekerjaan'] = $result;

        $pekerjaan = array(
                'id' => $data['dataPekerjaan'][0]['idProposal'],
                'url' => base_url().$this->uri->uri_string()
            );
        $this->session->set_userdata('refered_from', $pekerjaan);

        if ($result!=null) {
            $d=0;
            foreach ($result as $row) {
                $date0 = new DateTime($row['dateCreated']);
                $date1 = new DateTime($row['dateDeleted']);
                $data['dataPekerjaan'][$d]['dateCreated'] = $date0->format('d-m-Y');
                $data['dataPekerjaan'][$d]['dateDeleted'] = $date1->format('d-m-Y');
            }
        }
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

        // $p=0; $b=0;
        // foreach ($data['dataPekerjaan'] as $row) {
        //     if ($data['dataPekerjaan'][$b]['status']=='1') {
        //         $b++;
        //     }
        //     $p++;
        // }
        // $data['proses'] = round($b/count($data['dataPekerjaan']), 2)*100;
    }

    /**
     * create pekerjaan
     * @method tambahPekerjaan
     * @return string          message status
     */
    function tambahPekerjaan()
    {
        $data = $this->data;
        $data['mode']="insert";
        $data['cancel'] = $this->session->userdata['refered_from']['url'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('detailPekerjaanForm', 'Detail Pekerjaan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/pekerjaan_form', $data);
            $this->load->view('template/footer', $data);
        } else {
            $send = array(
            'idProposal'=>$this->session->userdata['refered_from']['id'],
            'detailPekerjaan'=>$this->input->post('detailPekerjaanForm')
            );
            $result = $this->Beranda_model->createPekerjaan($send);
            if ($result==1) {
              $this->session->set_flashdata('message', 'Pekerjaan berhasil ditambahkan');
            }

            redirect($this->session->userdata['refered_from']['url']);
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
        $result = $this->Beranda_model->deletePekerjaan((int)$kerja);
        if ($result==1) {
            $this->session->set_flashdata('message', 'Pekerjaan telah dihapus');
        }
        redirect($this->session->userdata['refered_from']['url']);
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
        $data['mode'] = "edit";
        $data['cancel'] = $this->session->userdata['refered_from']['url'];

        $this->form_validation->set_rules('detailPekerjaanForm', 'Detail Pekerjaan', 'required');
        // $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));

        if ($this->form_validation->run() == false) {
            $data['dataPekerjaan'] = $this->Beranda_model->getPekerjaan($kerja, 2);
            $this->load->view('template/header', $data);
            $this->load->view('template/navigation', $data);
            $this->load->view('masuk/pekerjaan_form', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = array(
            'detailPekerjaan'=>$this->input->post('detailPekerjaanForm'),
            'status'=>'0'
            );
            $result = $this->Beranda_model->updatePekerjaan($kerja, $data);
            if ($result==1) {
                $this->session->set_flashdata('message', 'Pekerjaan telah diupdate');
            }
            
            redirect($this->session->userdata['refered_from']['url']);
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
            $result = $this->Beranda_model->donePekerjaan((int)$id, $send);
        }
        if ($result==1) {
            $this->session->set_flashdata('message', 'Update pekerjaan selesai');
        }
        
        redirect($this->session->userdata['refered_from']['url']);
    }

    public function test()
    {
        $this->load->view('template/header');
        $this->load->view('test');
    }
}

/* End of file beranda.php */
