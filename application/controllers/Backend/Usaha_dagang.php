<?php

/**
 * @property $Usaha_dagang_model
 * @property $input
 * @property $session
 */

class Usaha_dagang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usaha_dagang_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$this->load->view('backend/usaha_dagang');
	}

	/**
	 * @return void
	 */
	public function insert():void
	{
		$post = $this->input->post();

		$data_usaha = $this->Usaha_dagang_model->insert_usaha($post);

		if ($data_usaha){
			$this->session->set_flashdata('sukses', 'Data Usaha Dagang Berhasil Ditambahkan');
		}else {
			$this->session->set_flashdata('gagal', 'Data Usaha Dagang Gagal Ditambahkan');
		}

		redirect(base_url('usaha_dagang'));
	}


	/**
	 * @param $id_usaha_dagang
	 * @return void
	 */
	public function update_view($id_usaha_dagang):void
	{
		$data_by_id['data_usaha_dagang'] = $this->Usaha_dagang_model->get_usaha_by_id($id_usaha_dagang);
		$this->load->view('backend/ubah_usaha_dagang', $data_by_id);
	}

	/**
	 * @param $id_usaha_dagang
	 * @return void
	 */
	public function update_logic($id_usaha_dagang):void
	{
		$post = $this->input->post();

		$data_update = $this->Usaha_dagang_model->update_usaha($id_usaha_dagang, $post);

		if ($data_update){
			$this->session->set_flashdata('sukses', 'Data Usaha Dagang Berhasil Diubah');
		}else {
			$this->session->set_flashdata('gagal', 'Data Usaha Dagang Gagal Diubah');
		}
		redirect(base_url('usaha_dagang'));
	}

	/**
	 * @param $id_usaha_dagang
	 * @return void
	 */
	public function delete($id_usaha_dagang):void
	{
		$data_delete = $this->Usaha_dagang_model->delete_usaha($id_usaha_dagang);

		if ($data_delete){
			$this->session->set_flashdata('sukses', 'Data Usaha Dagang Berhasil Dihapus');
		}else {
			$this->session->set_flashdata('gagal', 'Data Usaha Dagang Gagal Dihapus');
		}
		redirect(base_url('usaha_dagang'));
	}

	/**
	 * @return void
	 */
	public function get_data_usahadagang(): void
	{
		$fetch_data = $this->Usaha_dagang_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_kios;
				$sub_array[] = $row->kode_kios;
				$sub_array[] = $row->subsektor;
				$sub_array[] = '<a href="' . site_url('usaha_dagang/update_view/' . $row->id_usaha_dagang) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('usaha_dagang/delete/' . $row->id_usaha_dagang) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}
			$output = array(
				"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0, // Periksa apakah 'draw' ada
				"recordsTotal" => $this->Usaha_dagang_model->get_all_data(),
				"recordsFiltered" => $this->Usaha_dagang_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}
}
