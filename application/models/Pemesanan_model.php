<?php

/**
 * @property $db
 */

class Pemesanan_model extends  CI_Model
{

	public function update_status_pesanan($order_id, $status): void
	{
		$this->db->where('id_pesanan', $order_id);
		$this->db->update('pesanan', ['status' => $status]);
	}


	public function get_all_pemesanan()
	{
		return $this->db->get('pesanan')->result();
	}



	public function get_all_join_pemesanan()
	{
		$this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('pupuk', 'pesanan.id_pupuk=pupuk.id_pupuk', 'left');
		$this->db->join('users', 'pesanan.id_users=users.id_users', 'left');
		return $this->db->get()->result();
	}

	public function get_by_id($id_pesanan)
	{
		$this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('users', 'pesanan.id_users=users.id_users', 'left');
		$this->db->join('pupuk', 'pesanan.id_pupuk=pupuk.id_pupuk');
		$this->db->where('pesanan.id_pesanan', $id_pesanan);
		return $this->db->get()->row_array();
	}

	public function insert_pemesanan($data)
	{
		return $this->db->insert('pesanan', $data);
	}

	public function listing_all_pupuk()
	{
		return $this->db->get('pupuk')->result_array();
	}

	public function get_id_pemesanan($id_pemesanan)
	{
		return $this->db->get_where('pesanan', array('id_pesanan' => $id_pemesanan))->row_array();
	}

	public function update_pemesanan($id_pemesanan, $data)
	{
		$this->db->where('id_pesanan', $id_pemesanan);
		return $this->db->update('pesanan', $data);
	}

	public function delete_pemesanan($id_pemesanan)
	{
		$this->db->where('id_pesanan', $id_pemesanan);
		return $this->db->delete('pesanan');
	}

	function make_query(): void
	{
		$this->db->select('pesanan.*, pupuk.nama_pupuk, users.nama as nama_penduduk, pupuk.harga_pupuk')
			->from("pesanan")
			->join('pupuk', 'pesanan.id_pupuk=pupuk.id_pupuk')
			->join('users', 'pesanan.id_users=users.id_users');
		if (isset($_POST["search"]["value"])) {
			$this->db->like("jumlah", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_pesanan', 'DESC');
		}
	}

	public function make_datatables() {
		$this->make_query();
		if (isset($_POST["length"]) && $_POST["length"] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
		$query = $this->db->get();
		return $query->num_rows();
	}


	function get_filtered_data()
	{
		$this->make_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_data()
	{
		$this->db->select("*");
		$this->db->from("pesanan");
		return $this->db->count_all_results();
	}

	function make_query_riwayat(): void
	{
		$this->db->select('pesanan.*, pupuk.nama_pupuk, users.nama as nama_penduduk, pupuk.harga_pupuk')
			->from("pesanan")
			->join('pupuk', 'pesanan.id_pupuk=pupuk.id_pupuk')
			->join('users', 'pesanan.id_users=users.id_users')
			->where('pesanan.status', 1);
		if (isset($_POST["search"]["value"])) {
			$this->db->like("pupuk.nama_pupuk", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_pesanan', 'DESC');
		}
	}

	public function make_datatables_riwayat() {
		$this->make_query_riwayat();
		if (isset($_POST["length"]) && $_POST["length"] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_filtered_data_riwayat()
	{
		$this->make_query_riwayat();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_data_riwayat()
	{
		$this->db->select("*");
		$this->db->from("pesanan");
		return $this->db->count_all_results();
	}
}
