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
		 * load default model dan library CI, check user login, dan ambil message
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
						switch ($this->session->userdata['logged_in']['userLevel']) {
							case 1:
							case 2:
							case 5:
								if (is_numeric($this->uri->segment(2))) {
									$this->data['jumlah'] = $this->Beranda_model->jumlahRenovasi((int)$this->uri->segment(2));
								} else {
									$this->data['jumlah'] = $this->Beranda_model->jumlahRenovasi('ALL');
								}
								break;
							case 3:
								$this->data['jumlahBelum'] = $this->Beranda_model->jumlahRenovasi('0');
								$this->data['jumlahSetuju'] = $this->Beranda_model->jumlahRenovasi('2|6');
								break;
							case 4:
								$this->data['jumlahTersedia'] = $this->Beranda_model->jumlahRenovasi('spr');
								break;
							default:
								# code...
								break;
						}
				} elseif ($this->uri->uri_string() != '' && $this->uri->uri_string() != 'beranda' && $this->uri->uri_string() != 'login' && $this->uri->uri_string() != 'search' && ! preg_match('/^gedung\/\d+/', $this->uri->uri_string())) {
						// $this->data['message'] = "Anda belum login";
						// $this->session->set_flashdata('warn', 'Anda belum login');
						$this->session->set_flashdata('warn', 'logged_out');
						// if ($_SERVER['URI_REQUEST'] != "/siplah/beranda") header("Location: /siplah/beranda");
						// redirect('beranda', 'location', 301);
						// if ($this->uri->uri_string() != '' || $this->uri->uri_string() != 'beranda') {
						redirect('');
						// }
				}
				$this->data['message'] = $this->session->flashdata('message');
		}

/**
 * dashboard utama, load peta, list gedung, dan total luas terbangun
 * @method index
 * @return array data
 */
		public function index()
		{
				$data = $this->data;
				$data['luasTotal'] = $this->Beranda_model->totalLuas();
				// if ($this->session->flashdata('message')) {
				//     $data['message'] = $this->session->flashdata('message');
				// }
				if ($this->session->flashdata('cari')) {
						$data['listGedung'] = $this->session->flashdata('cari');
				} else {
						$data['invalid'] = $this->session->flashdata('invalid');
						if (isset($data['userLogin']) && $data['userLogin']['userLevel']==4) {
							$priority = $this->Beranda_model->getListGedung('sarpras');
							if ($priority!=NULL) {
								$data['listGedung'] = $priority;
							} else {
								$data['noPriority'];
								$data['listGedung'] = $this->Beranda_model->getListGedung();
							}
						} else {
							$data['listGedung'] = $this->Beranda_model->getListGedung();
						}
				}
				if (isset($this->data['userLogin'])) {
					// if ($this->session->userdata('pwd')) {
						$data['pwd'] = $this->session->userdata('pwd');
					// }
					$data['modal'] = $this->load->view('masuk/modal/modal_password', $data, TRUE);
					if ($data['userLogin']['userLevel']==4) {
						// $data['listGedung'] = $this->Beranda_model->getListGedung('sarpras');
						$this->load->view('template/header', $data);
						$this->load->view('template/navigation', $data);
						$this->load->view('template/menu', $data);
						$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
						$this->load->view('masuk/beranda_view', $data);
					} elseif ($data['userLogin']['userLevel']==1 || $data['userLogin']['userLevel']==2 || $data['userLogin']['userLevel']==5) {
						$this->load->view('template/header', $data);
						$this->load->view('template/navigation', $data);
						$this->load->view('template/menu', $data);
						$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
						$this->load->view('masuk/beranda_view', $data);
					} elseif ($data['userLogin']['userLevel']==3) {
						$this->load->view('template/header', $data);
						$this->load->view('template/navigation', $data);
						$this->load->view('template/menu', $data);
						$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
						$this->load->view('masuk/beranda_view', $data);
					}
				} else {
						// $data['userLogin'] = "false";
						if ($this->session->flashdata('warn')=='logged_out') {
							$data['warn'] = $this->session->flashdata('warn');
							$data['modal'] = $this->load->view('masuk/modal/modal_logged_out', NULL, TRUE);
						}
						$this->load->view('template/header', $data);
						$this->load->view('template/navigation', $data);
						$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
						$this->load->view('beranda_view', $data);
						// $data['footer'] = $this->load->view('template/footer', $data, TRUE);
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
						$data['detailGedung'] = NULL;
				}

				$array = array(
					'id' => $data['detailGedung'][0]['idGedung'],
					'url' => base_url().$this->uri->uri_string()
				);
				$this->session->set_userdata('refered_from', $array);

				$this->load->view('template/header', $data);
				$this->load->view('template/navigation', $data);
				if ($this->session->userdata('logged_in')) {
						$this->load->view('template/menu', $data);
				}
				$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
				$this->load->view('gedung_view', $data);
		}

		function tambahGedung()
		{
			$data = $this->data;
			$data['mode']="insert";
			$data['cancel'] = $this->session->userdata['refered_from']['url'];

			$this->load->library('form_validation');
			$this->form_validation->set_rules('namaGedungForm', 'nama gedung', array(
				'required', 'callback__regex_check'
			), array(
				'required' => 'Harap masukkan {field}'
			));
			// $this->form_validation->set_rules('kodeGedungForm', 'kode gedung', array(
			// 	'required', 'callback__regex_check'
			// ), array(
			// 	'required' => 'Harap masukkan {field}'
			// ));
			$this->form_validation->set_rules('luasGedungForm', 'luas gedung', array(
				'decimal'
			), array(
				'decimal' => 'Harap masukkan {field} dalam bentuk desimal'
			));
			$this->form_validation->set_rules('tinggiGedungForm', 'tinggi gedung', array(
				'decimal'
			), array(
				'decimal' => 'Harap masukkan {field} dalam bentuk desimal'
			));
			$this->form_validation->set_rules('jumlahLantaiForm', 'jumlah lantai', array(
				'decimal'
			), array(
				'decimal' => 'Harap masukkan {field} dalam bentuk desimal'
			));
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

			if ($this->form_validation->run() == false) {
					$this->load->view('template/header', $data);
					$this->load->view('template/navigation', $data);
					$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
					$this->load->view('masuk/gedung_form', $data);
			} else {
					$send = array(
					'namaGedung'=>$this->input->post('namaGedungForm'),
					'kodeGedung'=>$this->input->post('kodeGedungForm'),
					'luasGedung'=>$this->input->post('luasGedungForm'),
					'tinggiGedung'=>$this->input->post('tinggiGedungForm'),
					'jumlahLantai'=>$this->input->post('jumlahLantaiForm')
					);
					$result = $this->Beranda_model->createGedung($send);
					if ($result==1) {
						$this->session->set_flashdata('message', 'Gedung telah ditambahkan');
					}

					redirect($this->session->userdata['refered_from']['url']);
			}
		}

		function ubahGedung(string $ged)
		{
			$data = $this->data;
			$data['mode']="edit";
			$data['cancel'] = $this->session->userdata['refered_from']['url'];

			$data['dataGedung'] = $this->Beranda_model->getDataGedung($ged, 'edit');
			$from_db = array(
				'x' => $data['dataGedung'][0]['x'],
				'y' => $data['dataGedung'][0]['y'],
				'id' => $data['dataGedung'][0]['koordGedung']
			);
			// $this->session->set_userdata('loc', $array);

			$this->load->library('form_validation');
			$this->form_validation->set_rules('namaGedungForm', 'nama gedung', array(
				'required', 'regex_match[/^([[:alpha:]]|\W+[[:alpha:]]+)/]'
			), array(
				'required' => 'Harap masukkan {field}',
				'regex_match' => 'Format {field} salah'
			));
			$this->form_validation->set_rules('luasGedungForm', 'luas gedung', array(
				'regex_match[/(^\d+|^\d+[.]\d+)+$/]'
			), array(
				'regex_match' => 'Harap masukkan {field} dalam bentuk desimal'
			));
			$this->form_validation->set_rules('tinggiGedungForm', 'tinggi gedung', array(
				'regex_match[/(^\d+|^\d+[.]\d+)+$/]'
			), array(
				'regex_match' => 'Format {field} salah'
			));
			$this->form_validation->set_rules('jumlahLantaiForm', 'jumlah lantai', array(
				'integer'
			), array(
				'integer' => 'Format {field} salah'
			));
			$this->form_validation->set_rules('koordinatForm', 'lokasi gedung', array(
				'required'
			), array(
				'required' => 'Harap masukkan {field}'
			));
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

			if ($this->form_validation->run() == FALSE) {
					$this->load->view('template/header', $data);
					$this->load->view('template/navigation', $data);
					$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
					$this->load->view('masuk/gedung_form', $data);
			} else {
					$kode = ($this->input->post('kodeGedungForm')=='')?NULL:$this->input->post('kodeGedungForm');
					$luas = ($this->input->post('luasGedungForm')=='')?NULL:floatval($this->input->post('luasGedungForm'));
					$tinggi = ($this->input->post('tinggiGedungForm')=='')?NULL:floatval($this->input->post('tinggiGedungForm'));
					$kategori = ($this->input->post('kategoriCheck')==NULL)?0:(int)$this->input->post('kategoriCheck');

					$send = array(
					'idGedung'=>$this->session->userdata['refered_from']['id'],
					'namaGedung'=>$this->input->post('namaGedungForm'),
					'kodeGedung'=>$kode,
					'luasGedung'=>$luas,
					'tinggiGedung'=>$tinggi,
					'jumlahLantai'=>(int)$this->input->post('jumlahLantaiForm'),
					'kategoriGedung'=>$kategori
					);
					$result = $this->Beranda_model->updateGedung((int)$ged, $send);

					$koord = explode(' , ', $this->input->post('koordinatForm'));
					if ($koord[0]!=$from_db['x'] || $koord[1]!=$from_db['y']) {
						$send = array(
							'x' => $koord[0],
							'y' => $koord[1],
							'label' => $this->input->post('namaGedungForm')
						);
						$result = $this->Beranda_model->updateGedung((int)$from_db['id'], $send, 'koor');
					}

					if ($result==1) {
						$this->session->set_flashdata('message', 'Data gedung berhasil dirubah');
					} else {
						$this->session->set_flashdata('message', 'Data gedung gagal diubah, mohon coba kembali');
					}

					redirect($this->session->userdata['refered_from']['url']);
					// $data['testing'] = $koord;
					// $data['test'] = $send;
					// $this->load->view('test', $data, FALSE);
			}
		}

		function hapusGedung($ged)
		{
			$result = $this->Beranda_model->deleteGedung($ged);
			if ($result==1) {
				$this->session->set_flashdata('message', 'Gedung telah dihapus');
			} else {
				$this->session->set_flashdata('message', 'Gagal! Mohon coba kembali');
			}
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
						$this->session->set_flashdata('invalid', "Harap masukkan <strong>nama gedung</strong>");
				} else {
						$search = $this->input->post('cari_gedung');
						$result = $this->Beranda_model->searchListGedungByName($search);
						if ($result) {
								$this->session->set_flashdata('cari', $result);
						} else {
								$this->session->set_flashdata('invalid', "Gedung tidak ditemukan. Apakah anda yakin <strong>nama gedung</strong> benar?");
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
					$this->session->set_flashdata('message', 'Anda sudah login...');
					redirect('beranda', 'refresh');
				} else {
					$data['validLogin'] = $this->session->flashdata('validUser');
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
				switch ($ged) {
					case 'proposal':
						$result = $this->Beranda_model->getListRenovasi($ged, 2);
						break;
					case 'kerja':
						$result = $this->Beranda_model->getListRenovasi($ged, 3);
						break;
					case 'available':
						$result = $this->Beranda_model->getListRenovasi($ged, 4);
						break;
					default:
						$result = $this->Beranda_model->getListRenovasi($ged, 1);
						break;
				}

				if ($result!=null) {
						$data['dataRenovasi'] = $result;
						$d=0;
						foreach ($data['dataRenovasi'] as $row) {
								if ($row['kerja']!=0) {
										$data['dataRenovasi'][$d]['progress'] = round(($row['done']/$row['kerja'])*100);
								}
								$date = new DateTime($row['dateCreated']);
								$data['dataRenovasi'][$d]['dateCreated'] = $date->format('d-m-Y');
								if (isset($row['dateDeleted']) && $row['dateDeleted']!=NULL) {
										$date = new DateTime($row['dateDeleted']);
										$data['dataRenovasi'][$d]['dateDeleted'] = $date->format('d-m-Y');
								}
								$d++;
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

						foreach ($data['dataRenovasi'] as $row) {
							$data['idModal'] = $row['idProposal'];
							$data['modal'][$row['idProposal']] = $this->load->view('masuk/modal/modal_delete', $data, TRUE);
						}
				}

				$this->load->view('template/header', $data);
				$this->load->view('template/navigation', $data);
				$this->load->view('template/menu', $data);
				$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
				$this->load->view('masuk/renovasi_view', $data);
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
				$this->form_validation->set_rules('judulProposalForm', 'judul proposal', array(
					'required', 'callback__regex_check', 'min_length[5]'
				), array(
					'required' => 'Harap masukkan judul',
					'min_length' => 'Judul harus lebih deskriptif'
				));
				$this->form_validation->set_rules('deskripsiProposalForm', 'deskripsi proposal', array(
					'required', 'callback__regex_check'
				), array(
					'required' => 'Harap masukkan deskripsi renovasi'
				));
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

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
				$data['dataRenovasi'] = $this->Beranda_model->getListRenovasi((int)$renovasi, 0);
				$data['mode'] = "edit";
				$data['cancel'] = $this->session->userdata['refered_from']['url'];

				$this->load->library('form_validation');
				$this->form_validation->set_rules('judulProposalForm', 'judul proposal', array(
					'required', 'callback__regex_check', 'min_length[5]'
				), array(
					'required' => 'Harap masukkan judul',
					'min_length' => 'Judul harus lebih deskriptif'
				));
				$this->form_validation->set_rules('deskripsiProposalForm', 'deskripsi proposal', array(
					'required', 'callback__regex_check'
				), array(
					'required' => 'Harap masukkan deskripsi renovasi'
				));
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

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
								$date = new DateTime($row['dateCreated']);
								$data['dataPekerjaan'][$d]['dateCreated'] = $date->format('d-m-Y');
								if ($row['dateDeleted']!=NULL) {
										$date = new DateTime($row['dateDeleted']);
										$data['dataPekerjaan'][$d]['dateDeleted'] = $date->format('d-m-Y');
								}
								$data['idModal'] = $row['idPekerjaan'];
								$data['modal'][$row['idPekerjaan']] = $this->load->view('masuk/modal/modal_delete', $data, TRUE);
								$d++;
						}
				}
				if ($data['userLogin']['userLevel']==4 && $data['dataPekerjaan'][0]['dateDeleted']==NULL && $data['dataPekerjaan'][0]['idPekerjaan']!=NULL) {
						$this->load->view('template/header', $data);
						$this->load->view('template/navigation', $data);
						$this->load->view('template/menu', $data);
						$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
						$this->load->view('masuk/pekerjaan_ceklis', $data);
				} else {
						$this->load->view('template/header', $data);
						$this->load->view('template/navigation', $data);
						$this->load->view('template/menu', $data);
						$data['footer'] = $this->load->view('template/footer', NULL, TRUE);
						$data['modalUnggah'] = $this->load->view('masuk/modal/modal_upload', $data, TRUE);
						$this->load->view('masuk/pekerjaan_view', $data);
				}
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
				$this->form_validation->set_rules('detailPekerjaanForm', 'detail pekerjaan', array(
					'required', 'callback__regex_check'
				), array(
					'required' => 'Masukkan {field} yang harus dilakukan'
				));
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

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

				$this->form_validation->set_rules('detailPekerjaanForm', 'detail pekerjaan', array(
					'required', 'callback__regex_check'
				), array(
					'required' => 'Masukkan {field} yang harus dilakukan'
				));
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');
				// $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));

				if ($this->form_validation->run() == false) {
						$data['dataPekerjaan'] = $this->Beranda_model->getPekerjaan($kerja, 2);
						$this->load->view('template/header', $data);
						$this->load->view('template/navigation', $data);
						$this->load->view('masuk/pekerjaan_form', $data);
						$this->load->view('template/footer', $data);
				} else {
						$send = array(
						'detailPekerjaan'=>$this->input->post('detailPekerjaanForm'),
						'status'=>'0'
						);
						$result = $this->Beranda_model->updatePekerjaan($send, $kerja);
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

				$send = array();
     		foreach($check as $key=>$value) {
     		    $send[] = array(
     		    	'idPekerjaan'=>$value,
     		    	'status'=>'1'
     		    );
     		}

				$result = $this->Beranda_model->updatePekerjaan($send);

				// $data['test'] = $result;
				// $this->load->view('test', $data, FALSE);
				if ($result>0) {
						$this->session->set_flashdata('message', 'Update pekerjaan selesai');
				}

				redirect($this->session->userdata['refered_from']['url']);
		}

		function _regex_check(string $form_value)
		{
			if (preg_match('/^([[:alpha:]]|\W+[[:alpha:]]+)/', $form_value)) {
				return true;
			} else {
				$this->form_validation->set_message('_regex_check', 'Harap masukkan {field}');
				return false;
			}
		}

		public function testing()
		{
			$data=$this->data;
			// $this->load->view('template/header');
			// the "TRUE" argument tells it to return the content, rather than display it immediately
			// $data['modal'] = $this->load->view('masuk/modal/modal', NULL, TRUE);
			// $this->load->view('masuk/modal/modal');
			$this->load->view('template/header', $data);
      $this->load->view('template/navigation', $data);
      $this->load->view('masuk/modal/modal_upload', $data);
      $this->load->view('template/footer');

	   	// $spreadsheet = new Spreadsheet();
	   	// $sheet = $spreadsheet->getActiveSheet();
	   	// $sheet->setCellValue('A1', 'Hello World !');
      //
	   	// $writer = new Xlsx($spreadsheet);
	   	// $writer->save('hello world.xlsx');
		}

}

/* End of file beranda.php */
