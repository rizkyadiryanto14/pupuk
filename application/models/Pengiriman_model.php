<?php

/**
 * @property $db
 */

class Pengiriman_model extends CI_Model
{
	public function get_all_pengiriman()
	{
		return $this->db->get('pengiriman')->result();
	}

	public function insert_pengiriman($data)
	{
		return $this->db->insert('pengiriman', $data);
	}

	public function get_id_pengiriman($id_pegiriman)
	{
		return $this->db->get_where('pengiriman',array('id_pengiriman' => $id_pegiriman))->row_array();
	}

	public function update_pengiriman($id_pengiriman, $data)
	{
		$this->db->update('id_pengiriman', $id_pengiriman);
		return $this->db->update('pengiriman', $data);
	}

	public function delete_pengiriman($id_pengiriman)
	{
		$this->db->where('id_pengiriman', $id_pengiriman);
		return $this->db->delete('pengiriman');
	}

	function make_query(): void
	{
		$this->db->select('pengiriman.*, pupuk.nama_pupuk')
			->from("pengiriman")
			->join('pesanan', 'pengiriman.id_pengiriman=pesanan.id_pesanan')
			->join('pupuk', 'pesanan.id_pupuk=pupuk.id_pupuk');
		if (isset($_POST["search"]["value"])) {
			$this->db->like("status_pengiriman", $_POST["search"]["value"]);
			$this->db->or_like("id_pengiriman", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_pengiriman', 'DESC');
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
		$this->db->from("pengiriman");
		return $this->db->count_all_results();
	}
}
