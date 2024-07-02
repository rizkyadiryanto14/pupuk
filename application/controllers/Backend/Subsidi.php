<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * @property $Subsidi_model
 * @property $input
 * @property $session
 * @property $db
 */

class Subsidi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subsidi_model');
	}

	/**
	 * @return void
	 */

	public function index(): void
	{
		$data_subsidi = [
			'data_subsidi'	=> $this->Subsidi_model->get_all_subsidi()
		];
		$this->load->view('backend/subsidi', $data_subsidi);
	}

	/**
	 * @return void
	 */

	public function daftar_penerima_subsidi():void
	{
		$data_penduduk['penduduk'] = $this->Subsidi_model->listing_penduduk();
		$this->load->view('daftar_penerima', $data_penduduk);
	}

	/**
	 * @return void
	 */

	public function insert(): void
	{
		$post = $this->input->post();
		$data_insert = $this->Subsidi_model->insert_subsidi($post);

		if ($data_insert){
			$this->session->set_flashdata('sukses' ,'Data penduduk berhasil ditambahkan');
		}else {
			$this->session->set_flashdata('gagal', 'Data penduduk gagal di tambahkan');
		}
		redirect(base_url('subsidi'));
	}

	public function listing_usahadagang():void
	{
		$data = $this->Subsidi_model->listing_usahadagang();
		echo json_encode($data);
	}

	/**
	 * @return void
	 */

	public function import(): void
	{
		try {
			if (isset($_FILES["file_import"]["name"])) {
				$path = $_FILES["file_import"]["tmp_name"];
				$reader = IOFactory::createReaderForFile($path);
				$spreadsheet = $reader->load($path);
				$worksheet = $spreadsheet->getActiveSheet();

				$highestRow = $worksheet->getHighestRow();
				for ($row = 2; $row <= $highestRow; $row++) { // Mulai dari baris ke-2 (baris 1 adalah header)
					$data = [
						'nama' 				=> $worksheet->getCellByColumnAndRow(1, $row)->getValue(), // Kolom B di Excel
						'nik' 				=> $worksheet->getCellByColumnAndRow(2, $row)->getValue(),  // Kolom C di Excel
						'alamat' 			=> $worksheet->getCellByColumnAndRow(3, $row)->getValue(), // Kolom D di Excel
						'tempat' 			=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),  // Kolom E di Excel
						'tanggal_lahir' 	=> $worksheet->getCellByColumnAndRow(5, $row)->getValue(), // Kolom F di Excel
						'id_usaha_dagang' 	=> $worksheet->getCellByColumnAndRow(6, $row)->getValue() // Kolom G di Excel
					];
					$this->Subsidi_model->insert_subsidi($data);
					// Logging untuk debugging
					log_message('debug', 'Query SQL: ' . $this->db->last_query());
					if ($this->db->error()['code'] !== 0) {
						log_message('error', 'Error saat insert data penduduk: ' . $this->db->error()['message']);
					}
				}
				$this->session->set_flashdata('sukses', 'Data Import Berhasil');
			} else {
				$this->session->set_flashdata('gagal', 'Data Import Gagal: Tidak ada file yang dipilih');
			}
		} catch (Exception $e) {
			$this->session->set_flashdata('gagal', 'Data Import Gagal: ' . $e->getMessage());
			log_message('error', 'Error saat import Excel: ' . $e->getMessage());
		}
		redirect(base_url('subsidi'));
	}

	public function get_data_subsidi(): void
	{
		$fetch_data = $this->Subsidi_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama;
				$sub_array[] = $row->nik;
				$sub_array[] = $row->alamat;
				$sub_array[] = $row->tempat;
				$sub_array[] = $row->tanggal_lahir;
				$sub_array[] = $row->kode_kios;
				$sub_array[] = $row->nama_kios;
				$sub_array[] = '<a href="' . site_url('subsidi/update_view/' . $row->id_penduduk) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('subsidi/delete/' . $row->id_penduduk) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0, // Periksa apakah 'draw' ada
				"recordsTotal" => $this->Subsidi_model->get_all_data(),
				"recordsFiltered" => $this->Subsidi_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}
}
