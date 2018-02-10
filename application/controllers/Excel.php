<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel extends CI_Controller
{

public $data;

	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		if ($this->session->userdata('logged_in')) {
			$this->data['userLogin'] = $this->session->userdata('logged_in');
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
	}
    function downloadExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="test_download.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
				header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header('Pragma: public'); // HTTP/1.0

				$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

		function writeExcel()
		{
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1', 'Hello World !');

			$writer = new Xlsx($spreadsheet);
			$writer->save('files/excel/hello world.xlsx');
		}

		function readExcel()
		{
			$data = $this->data;
			// $fileName = time() . $_FILES['excelFileForm']['name'];

      $config['upload_path'] = './files/excel/';
      // $config['file_name'] = $fileName;
      // $config['encrypt_name'] = TRUE;
      $config['allowed_types'] = 'xls|xlsx|csv';
      $config['max_size'] = 10000;

      $this->upload->initialize($config);

      if ( ! $this->upload->do_upload('excelFileForm')){
      	$data['error'] = array('error' => $this->upload->display_errors());
      	$this->load->view('template/header', $data);
      	$this->load->view('template/navigation', $data);
      	$this->load->view('template/modal_upload', $data);
      	$this->load->view('template/footer');
      }
      else{
      	$data['upload_data'] = $this->upload->data('file_name');
      	$new_name = $this->upload->data('file_path').'/uid'.$data['userLogin']['uid'].'_('.time().')_'.$this->upload->data('orig_name');
      	rename(
				    $this->upload->data('full_path'),
				    $new_name
				);
      	// $this->session->set_flashdata('message', $result);
      	$this->load->view('success', $data, FALSE);
      	// redirect('beranda','refresh');
      }
		}
}

/* End of file Excel.php */
/* Location: ./application/controllers/Excel.php */
