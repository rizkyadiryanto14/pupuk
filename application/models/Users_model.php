<?php

/**
 * @property $db
 */
class Users_model extends CI_Model
{
	public function get_all_users()
	{
		return $this->db->get('users')->result_array();
	}

	public function get_users()
	{
		return $this->db->get('users')->result();
	}

	public function insert_listing_users($data)
	{
		return $this->db->insert('users', $data);
	}

	public function get_users_by_id($id_users)
	{
		return $this->db->get_where('users', array('id_users' => $id_users))->row_array();
	}

	public function delete_users($id_users)
	{
		$this->db->where('id_users', $id_users);
		return $this->db->delete('users');
	}


	public function cek_nik($nik)
	{
		return $this->db->get_where('penduduk', array('nik' => $nik))->row_array();
	}

	public function update_users($id_users, $data)
	{
		$this->db->where('id_users', $id_users);
		return $this->db->update('users', $data);
	}

	function make_query(): void
	{
		$this->db->select('users.*')
			->from("users");
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_users', 'DESC');
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
		$this->db->from("users");
		return $this->db->count_all_results();
	}

}
