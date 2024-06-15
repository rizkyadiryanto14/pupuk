<?php

/**
 * @property $input
 * @property $Pupuk_model
 * @property $session
 */

class Pupuk extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pupuk_model');
	}

	public function index(): void
	{
		$data_array = [
			'data_pupuk'	=> $this->Pupuk_model->get_all_pupuk(),

		];
		$this->load->view('backend/pupuk', $data_array);
	}

	public function detail_view($id_pupuk): void
	{
		$data_array = [
			'data_id_pupuk'	=> $this->Pupuk_model->get_id_pupuk($id_pupuk)
		];
		$this->load->view('backend/detail_pupuk', $data_array);
	}

	public function update_view($id_pupuk)
	{
		$data_pupuk = [
			'data_pupuk'
		];
	}

	public function insert(): void
	{
		$post = $this->input->post();


		$insert_pupuk = $this->Pupuk_model->insert_pupuk($post);

		if ($insert_pupuk){
			$this->session->set_flashdata('sukses', 'Data Pupuk Berhasil Ditambahkan');
		}else {
			$this->session->set_flashdata('gagal', 'Data Pupuk Gagal Ditambahkan');
		}
		redirect(base_url('pupuk'));
	}

	public function get_data_pupuk(): void
	{
		$fetch_data = $this->Pupuk_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_pupuk;
				$sub_array[] = $row->jenis_pupuk;
				$sub_array[] = 'Rp.' . number_format($row->harga_pupuk);
				$sub_array[] = $row->status_pupuk;
				$sub_array[] = '<a href="' . site_url('pupuk/update_view/' . $row->id_pupuk) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('Belanja/delete/' . $row->id_pupuk) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0, // Periksa apakah 'draw' ada
				"recordsTotal" => $this->Pupuk_model->get_all_data(),
				"recordsFiltered" => $this->Pupuk_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}
}
