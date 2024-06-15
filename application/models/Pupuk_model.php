<?php

/**
 * @property $db
 */

class Pupuk_model extends CI_Model
{
	public function get_all_pupuk()
	{
		return $this->db->get('pupuk')->result();
	}

	public function get_id_pupuk($id_pupuk)
	{
		return $this->db->get_where('pupuk', array('id_pupuk' => $id_pupuk))->row_array();
	}

	public function insert_pupuk($data)
	{
		return $this->db->insert('pupuk',$data);
	}

	public function update_pupuk($id_pupuk, $data)
	{
		$this->db->where('id_pupuk', $id_pupuk);
		return $this->db->update('pupuk', $data);
	}

	public function delete_pupuk($id_pupuk)
	{
		$this->db->where('id_pupuk', $id_pupuk);
		return $this->db->delete('pupuk');
	}

	function make_query(): void
	{
		$this->db->select('pupuk.*')
			->from("pupuk");
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama_pupuk", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_pupuk', 'DESC');
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
		$this->db->from("pupuk");
		return $this->db->count_all_results();
	}
}
