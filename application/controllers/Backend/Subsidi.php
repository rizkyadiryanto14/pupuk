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
		$this->load->view('backend/subsidi');
	}

	/**
	 * @return void
	 */
	public function insert(): void
	{
		$post = $this->input->post();

	}
}
