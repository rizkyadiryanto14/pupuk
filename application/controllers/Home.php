<?php

/**
 * @property $Subsidi_model
 */

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subsidi_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$this->load->view('home');
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
