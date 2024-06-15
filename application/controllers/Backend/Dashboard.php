<?php

/**
 * @property $Pemesanan_model
 * @property $Pupuk_model
 * @property $Pengiriman_model
 * @property $Subsidi_model
 */

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pupuk_model');
		$this->load->model('Pemesanan_model');
		$this->load->model('Pengiriman_model');
		$this->load->model('Subsidi_model');
	}

	public function index(): void
	{
		$data  = [
			'pupuk'		=> $this->Pupuk_model->get_all_data(),
			'pemesanan'	=> $this->Pemesanan_model->get_all_data(),
			'pengirim'	=> $this->Pengiriman_model->get_all_data(),
			'penduduk'	=> $this->Subsidi_model->get_all_data(),
		];
		$this->load->view('backend/dashboard', $data);
	}
}
