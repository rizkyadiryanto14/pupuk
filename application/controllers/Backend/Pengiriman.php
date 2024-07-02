<?php

/**
 * @property $input
 * @property $Pengiriman_model
 * @property $Pemesanan_model
 * @property $session
 */

class Pengiriman extends  CI_Controller
{
	/**
	 * fungsi construct
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengiriman_model');
		$this->load->model('Pemesanan_model');
	}

	public function index(): void
	{
		$data = [
			'pemesanan'		=> $this->Pemesanan_model->get_all_join_pemesanan(),
		];
		$this->load->view('backend/pengiriman', $data);
	}

	/**
	 * @return void
	 */

	public function listing_pesanan():void
	{
		$data = $this->Pemesanan_model->get_all_join_pemesanan();
		echo json_encode($data);
	}

	/**
	 * fungsi insert pengiriman data
	 * @return void
	 */

	public function insert(): void
	{
		$post = $this->input->post();
		$insert_pengiriman = $this->Pengiriman_model->insert_pengiriman($post);

		if ($insert_pengiriman){
			$this->session->set_flashdata('sukses', 'Data Pengiriman Berhasil Ditambahkan');
		}else{
			$this->session->set_flashdata('gagal','Data Pengiriman Gagal Ditambahkan');
		}
		redirect(base_url('pengiriman'));
	}


	/**
	 * @param $id_pengiriman
	 * @return void
	 */
	public function delete($id_pengiriman):void
	{
		$delete = $this->Pengiriman_model->delete_pengiriman($id_pengiriman);

		if ($delete){
			$this->session->set_flashdata('sukses','Data Pengiriman berhasil dihapus');
		}else {
			$this->session->set_flashdata('gagal', 'Data Pengiriman gagal dihapus');
		}
		redirect(base_url('pengiriman'));
	}

	/**
	 * fungsi detail pengiriman berdasarkan ID
	 * @param $id_pengiriman
	 * @return void
	 */

	public function detail_pengiriman($id_pengiriman): void
	{
		$data_array = [
			'data_id_pengiriman'	=> $this->Pengiriman_model->get_id_pengiriman($id_pengiriman)
		];
		$this->load->view('backend/detail_pengiriman', $data_array);
	}

	/**
	 * @param $id_pengiriman
	 * @return void
	 */
	public function update_view($id_pengiriman):void
	{
		$data_array = [
			'data_pengiriman'	=> $this->Pengiriman_model->get_id_join_pengiriman($id_pengiriman)
		];
		$this->load->view('backend/update_pengiriman', $data_array);
	}


	/**
	 * @param $id_pengiriman
	 * @return void
	 */
	public function update($id_pengiriman):void
	{
		$post = $this->input->post();
		$insert_pengiriman = $this->Pengiriman_model->update_pengiriman($id_pengiriman,$post);

		if ($insert_pengiriman){
			$this->session->set_flashdata('sukses', 'Data Pengiriman Berhasil Diupdate');
		}else{
			$this->session->set_flashdata('gagal','Data Pengiriman Gagal Diupdate');
		}
		redirect(base_url('pengiriman'));
	}

	public function get_data_pengiriman(): void
	{
		$fetch_data = $this->Pengiriman_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_pupuk;
				$sub_array[] = $row->status_pengiriman;
				$sub_array[] = $row->timestamp;
				$sub_array[] = '<a href="' . site_url('pengiriman/update_view/' . $row->id_pengiriman) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('pengiriman/delete/' . $row->id_pengiriman) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}
			$output = array(
				"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0, // Periksa apakah 'draw' ada
				"recordsTotal" => $this->Pengiriman_model->get_all_data(),
				"recordsFiltered" => $this->Pengiriman_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}
}
