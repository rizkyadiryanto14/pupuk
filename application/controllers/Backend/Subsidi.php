<?php

/**
 * @property $Subsidi_model
 * @property $input
 * @property $session
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
