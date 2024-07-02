<?php
use Midtrans\Notification;

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
		\Midtrans\Config::$serverKey 	= $this->config->item('midtrans')['server_key'];
		\Midtrans\Config::$isProduction = $this->config->item('midtrans')['is_production'];
		\Midtrans\Config::$isSanitized 	= $this->config->item('midtrans')['is_sanitized'];
		\Midtrans\Config::$is3ds 		= $this->config->item('midtrans')['is_3ds'];
	}

	public function index(): void
	{
		$data_array = [
			'pemesanan'  => $this->Pemesanan_model->get_all_pemesanan()
		];
		$this->load->view('backend/pemesanan', $data_array);
	}

	public function insert(): void
	{
		$data = [
			'id_users'       	=> $this->input->post("id_users"),
			'id_pupuk'        	=> $this->input->post("id_pupuk"),
			'jumlah'        	=> $this->input->post("jumlah"),
			'timestamp'        	=> date('Y-m-d H:i:s')
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
		$data = $this->Users_model->get_users();
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
			'id_users'        	=> $this->input->post("id_users"),
			'id_pupuk'        	=> $this->input->post("id_pupuk"),
			'jumlah'        	=> $this->input->post("jumlah"),
			'timestamp'        	=> date('Y-m-d H:i:s')
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
				if ($row->status == 0) {
					$sub_array[] = '<button class="btn btn-danger btn-xs bayar-sekarang" data-id-pesanan="' . $row->id_pesanan . '">Bayar Sekarang</button>';
				} elseif ($row->status == 2) {
					$sub_array[] = '<button class="btn btn-warning btn-xs" disabled>Menunggu Pembayaran</button>';
				} elseif ($row->status == 1) {
					$sub_array[] = '<button class="btn btn-success btn-xs" disabled>Pembayaran Berhasil</button>';
				}
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
	public function get_data_riwayat():void
	{
		$fetch_data = $this->Pemesanan_model->make_datatables_riwayat();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_pupuk;
				$sub_array[] = $row->jumlah;
				$sub_array[] = 'Rp.' . number_format($row->harga_pupuk);
				$sub_array[] = '<button class="btn btn-success btn-xs" disabled>Pembayaran Berhasil</button>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0, // Periksa apakah 'draw' ada
				"recordsTotal" => $this->Pemesanan_model->get_all_data_riwayat(),
				"recordsFiltered" => $this->Pemesanan_model->get_filtered_data_riwayat(),
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
	public function get_snap_token(): void
	{
		$id_pesanan = $this->input->post('id_pesanan');

		$pesanan = $this->Pemesanan_model->get_by_id($id_pesanan);

		if (!$pesanan) {
			echo json_encode([
				'success' => false,
				'message' => 'Pesanan tidak ditemukan.'
			]);
			return;
		}

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

	public function midtrans_callback(): void {
		$json_result = file_get_contents('php://input');

		$result = json_decode($json_result);

		if (json_last_error() !== JSON_ERROR_NONE || !is_object($result)) {
			log_message('error', "Invalid JSON response from Midtrans: " . $json_result);
			http_response_code(400);
			echo "Bad Request";
			return;
		}

		$signature_key = hash("sha512", $result->order_id . $result->status_code . $result->gross_amount . \Midtrans\Config::$serverKey);

		if ($signature_key != $result->signature_key) {
			log_message('error', "Invalid signature key from Midtrans");
			http_response_code(403); // Forbidden
			echo "Forbidden";
			return;
		}

		$order_id = $result->order_id;
		$transactionStatus = $result->transaction_status;

		log_message('debug', "Order ID diterima: " . $order_id);
		log_message('debug', "Transaction Status: " . $transactionStatus);

		$status = 0; // Default status: Unknown
		switch ($transactionStatus) {
			case 'capture':
			case 'settlement':
				$status = 1; // Success
				break;
			case 'pending':
				$status = 2; // Pending
				break;
			case 'deny':
			case 'expire':
			case 'cancel':
				$status = 3; // Failed
				break;
		}

		log_message('debug', "Status yang akan disimpan: " . $status);

		$insert = $this->Pemesanan_model->update_status_pesanan($order_id, $status);

		if ($insert){
			$this->session->set_flashdata('sukses', 'Pembayaran Berhasil');
		}else {
			$this->session->set_flashdata('gagal', 'Pembayaran Gagal');
		}
		http_response_code(200);
		echo "OK";
	}

	/**
	 * @return void
	 */

	public function finish(): void
	{
		$result = json_decode($this->input->post('result_data'));
	}
}
