<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(): void
	{
		$this->load->view('backend/dashboard');
	}
}
