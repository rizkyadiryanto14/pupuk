<?php

/**
 * @property $Users_model
 * @property $input
 * @property $session
 */

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
	}

	/**
	 * @return void
	 */
	public function index(): void
	{
		$this->load->view('backend/users');
	}

	/**
	 * @param $id_users
	 * @return void
	 */
	public function update_view($id_users):void
	{
		$data_users_by_id['data_users']	= $this->Users_model->get_users_by_id($id_users);
		$this->load->view('backend/update_users', $data_users_by_id);
	}

	/**
	 * @param $id_users
	 * @return void
	 */
	public function delete($id_users):void
	{
		$data_delete = $this->Users_model->delete_users($id_users);

		if ($data_delete){
			$this->session->set_flashdata('sukses', 'Data Users Berhasil Dihapus');
		}else {
			$this->session->set_flashdata('gagal', 'Data Users Gagal Dihapus');
		}

		redirect(base_url('users'));
	}

	/**
	 * @param $id_users
	 * @return void
	 */
	public function update_logic($id_users):void
	{
		$post = $this->input->post();

		$data_update = $this->Users_model->update_users($id_users, $post);

		if ($data_update){
			$this->session->set_flashdata('sukses', 'Data Users Berhasil Diupdate');
		}else {
			$this->session->set_flashdata('gagal', 'Data Users Gagal Diupdate');
		}

		redirect(base_url('users'));
	}

	public function get_data_users(): void
	{
		$fetch_data = $this->Users_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama;
				$sub_array[] = $row->username;
				$sub_array[] = $row->role;
				$sub_array[] = '<a href="' . site_url('users/update_view/' . $row->id_users) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('users/delete/' . $row->id_users) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0, // Periksa apakah 'draw' ada
				"recordsTotal" => $this->Users_model->get_all_data(),
				"recordsFiltered" => $this->Users_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}

	/**
	 * @return void
	 */
	public function ceknik():void
	{
		$cek_nik = $this->input->post('nik');

		$fungsi_cek = $this->Users_model->cek_nik($cek_nik);

		if ($fungsi_cek){
			$data = [
				'nama'		=> $fungsi_cek['nama'],
				'username'	=> $fungsi_cek['nik'],
				'password'	=> password_hash($fungsi_cek['nik'], PASSWORD_DEFAULT),
				'role'		=> 'user',
				'timestamp'	=> date('Y-m-d H:i:s')
			];

			$this->Users_model->insert_listing_users($data);
			$this->session->set_flashdata('sukses', 'Nik Berhasil Ditemukan, Anda Bisa Login Sekarang');
			redirect(base_url('auth'));
		}else {
			$this->session->set_flashdata('gagal', 'Nik Gagal Ditemukan');
			redirect(base_url('auth'));
		}
	}
}
