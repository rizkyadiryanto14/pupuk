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
}
