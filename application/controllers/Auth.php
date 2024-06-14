<?php

/**
 * @property $input
 * @property $Auth_model
 * @property $session
 */
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

	public function index(): void
	{
		$this->load->view('auth/login');
	}

	public function logic_login(): void
	{
		$post = $this->input->post();

		$data_user = $this->Auth_model->get_email_user($post['email']);

		if ($data_user){
			if (password_verify($post['password'], $data_user['password'])){
				$sessionUser = [
					'id_user'	=> $data_user['id_users'],
					'username'	=> $data_user['username'],
					'nama'		=> $data_user['nama'],
					'role'		=> $data_user['role'],
				];
				$this->session->set_userdata($sessionUser);
				redirect(base_url('dashboard'));
			}else {
				$this->session->set_flashdata('gagal', 'Username atau password salah');
				redirect(base_url('auth'));
			}

		} else {
			$this->session->set_flashdata('gagal', 'Data User Tidak Ditemukan, Harap Menghubungi Admin Atau lakukan Registasi');
		}
		redirect(base_url('auth'));
	}

	public function logout(): void
	{
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}
	
}
