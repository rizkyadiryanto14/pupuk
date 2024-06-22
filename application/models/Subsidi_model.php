<?php

/**
 * @property $db
 */
class Subsidi_model extends CI_Model
{
	public function get_all_subsidi()
	{
		return $this->db->get('penduduk')->result();
	}

	public function listing_penduduk()
	{
		return $this->db->get('penduduk')->result();
	}

	public function get_subsidi()
	{
		return $this->db->get('penduduk')->result_array();
	}

	public function insert_subsidi($data)
	{
		return $this->db->insert('penduduk', $data);
	}

	public function update_subsidi($id_subsidi, $data)
	{
		$this->db->where('id_subsidi', $id_subsidi);
		return $this->db->update('subsidi', $data);
	}

	public function delete_subsidi($id_subsidi)
	{
		$this->db->where('id_subsidi', $id_subsidi);
		return $this->db->delete('subsidi');
	}

	function make_query(): void
	{
		$this->db->select('penduduk.*, usaha_dagang.nama_kios, usaha_dagang.kode_kios')
			->from("penduduk")
			->join('usaha_dagang', 'penduduk.id_usaha_dagang = usaha_dagang.id_usaha_dagang');
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_penduduk', 'DESC');
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
		$this->db->from("penduduk");
		return $this->db->count_all_results();
	}
}
