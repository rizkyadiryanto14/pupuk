<?php

/**
 * @property $input
 * @property $Pemesanan_model
 * @property $session
 * @property $Users_model
 * @property $Pupuk_model
 * @property $Subsidi_model
 * @property $config
 */
class Pemesanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pemesanan_model');
		$this->load->model('Users_model');
		$this->load->model('Subsidi_model');
		$this->load->model('Pupuk_model');

		// Load Midtrans configuration
		$this->load->config('midtrans');

		// Set Midtrans configuration
		\Midtrans\Config::$serverKey = $this->config->item('midtrans')['server_key'];
		\Midtrans\Config::$isProduction = $this->config->item('midtrans')['is_production'];
		\Midtrans\Config::$isSanitized = $this->config->item('midtrans')['is_sanitized'];
		\Midtrans\Config::$is3ds = $this->config->item('midtrans')['is_3ds'];
	}

	public function index(): void
	{
		$data_array = [
			'data_pemesanan'  => $this->Pemesanan_model->get_all_pemesanan()
		];
		$this->load->view('backend/pemesanan', $data_array);
	}

	public function insert(): void
	{
		$data = [
			'id_users'        => $this->input->post("id_users"),
			'id_pupuk'        => $this->input->post("id_pupuk"),
			'jumlah'        => $this->input->post("jumlah"),
			'timestamp'        => date('Y-m-d H:i:s')
		];

		$insert_pemesanan = $this->Pemesanan_model->insert_pemesanan($data);

		if($insert_pemesanan){
			$this->session->set_flashdata('sukses', 'Data Pemesanan Berhasil Ditambahkan');
		}else {
			$this->session->set_flashdata('gagal', 'Data Pemesanan Gagal Ditambahkan');
		}
		redirect(base_url('pemesanan'));
	}

	public function listing_users(): void
	{
		$data = $this->Users_model->get_all_users();
		echo json_encode($data);
	}

	public function listing_pupuk(): void
	{
		$data = $this->Pemesanan_model->listing_all_pupuk();
		echo json_encode($data);
	}

	public function update_view($id_pemesanan): void
	{
		$data_pemesanan = [
			'data_pemesanan'	=> $this->Pemesanan_model->get_id_pemesanan($id_pemesanan),
			'data_users'		=> $this->Subsidi_model->get_all_subsidi(),
			'data_pupuk'		=> $this->Pupuk_model->get_all_pupuk()
		];
		$this->load->view('backend/update_pemesanan', $data_pemesanan);
	}

	/**
	 * @param $id_pemesanan
	 * @return void
	 */

	public function update_pemesanan($id_pemesanan): void
	{
		$data = [
			'id_users'        => $this->input->post("id_users"),
			'id_pupuk'        => $this->input->post("id_pupuk"),
			'jumlah'        => $this->input->post("jumlah"),
			'timestamp'        => date('Y-m-d H:i:s')
		];

		$update_pemesanan = $this->Pemesanan_model->update_pemesanan($id_pemesanan,$data);

		if($update_pemesanan){
			$this->session->set_flashdata('sukses', 'Data Pemesanan Berhasil Ditambahkan');
		}else {
			$this->session->set_flashdata('gagal', 'Data Pemesanan Gagal Ditambahkan');
		}
		redirect(base_url('pemesanan'));
	}

	public function get_data_pemesanan(): void
	{
		$fetch_data = $this->Pemesanan_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_pupuk;
				$sub_array[] = $row->jumlah;
				$sub_array[] = 'Rp.' . number_format($row->harga_pupuk);
				$sub_array[] = '<button class="btn btn-danger btn-xs bayar-sekarang" data-id-pesanan="' . $row->id_pesanan . '">Bayar Sekarang</button>';
				$sub_array[] = '<a href="' . site_url('pemesanan/update_view/' . $row->id_pesanan) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('pemesanan/delete/' . $row->id_pesanan) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0, // Periksa apakah 'draw' ada
				"recordsTotal" => $this->Pemesanan_model->get_all_data(),
				"recordsFiltered" => $this->Pemesanan_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}

	public function delete($id_pesanan): void
	{
		$hapus_data = $this->Pemesanan_model->delete_pemesanan($id_pesanan);

		if ($hapus_data){
			$this->session->set_flashdata('sukses', 'Data Pupuk Berhasil Dihapus');

		}else {
			$this->session->set_flashdata('gagal', 'Data Pupuk Gagal Dihapus');
		}
		redirect(base_url('pemesanan'));
	}

	/**
	 * @return void
	 */
	public function get_snap_token(): void
	{
		$id_pesanan = $this->input->post('id_pesanan');

		// Ambil data pesanan dari model
		$pesanan = $this->Pemesanan_model->get_by_id($id_pesanan);

		if (!$pesanan) {
			echo json_encode([
				'success' => false,
				'message' => 'Pesanan tidak ditemukan.'
			]);
			return;
		}

		// Siapkan parameter transaksi Midtrans
		$transaction_details = array(
			'order_id' => $id_pesanan,
			'gross_amount' => $pesanan['harga_pupuk'] * $pesanan['jumlah'],
		);

		$customer_details = array(
			'first_name' => $pesanan['nama'],
			'email' => 'emailcontoh@gmail.com',
			'phone' => '085333411680',
		);

		$params = array(
			'transaction_details' => $transaction_details,
			'customer_details' => $customer_details,
		);

		// Dapatkan Snap Token
		try {
			$snapToken = \Midtrans\Snap::getSnapToken($params);

			// Kirim response sukses dengan Snap Token
			echo json_encode([
				'success' => true,
				'snap_token' => $snapToken,
			]);
		} catch (Exception $e) {
			// Tangani kesalahan jika terjadi
			echo json_encode([
				'success' => false,
				'message' => 'Terjadi kesalahan saat membuat token pembayaran: ' . $e->getMessage()
			]);
		}
	}

	/**
	 * @return void
	 */
	public function finish(): void
	{
		$result = json_decode($this->input->post('result_data'));
	}
}
