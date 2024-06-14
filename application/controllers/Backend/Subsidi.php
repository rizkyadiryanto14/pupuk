<?php

/**
 * @property $Subsidi_model
 * @property $input
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
}
