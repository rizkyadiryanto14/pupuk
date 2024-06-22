<?php

/**
 * @property $db
 */

class Usaha_dagang_model extends CI_Model
{

	public function insert_usaha($data)
	{
		return $this->db->insert('usaha_dagang', $data);
	}

	public function get_usaha_by_id($id_usaha_dagang)
	{
		return $this->db->get_where('usaha_dagang', array('id_usaha_dagang' => $id_usaha_dagang))->row_array();
	}

	public function update_usaha($id_usaha_dagang, $data)
	{
		$this->db->where('id_usaha_dagang', $id_usaha_dagang);
		return $this->db->update('usaha_dagang', $data);
	}

	public function delete_usaha($id_usaha_dagang)
	{
		$this->db->where('id_usaha_dagang', $id_usaha_dagang);
		return $this->db->delete('usaha_dagang');
	}

	function make_query(): void
	{
		$this->db->select('usaha_dagang.*')
			->from("usaha_dagang");
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama_kios", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_usaha_dagang', 'ASC');
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
		$this->db->from("usaha_dagang");
		return $this->db->count_all_results();
	}
}
