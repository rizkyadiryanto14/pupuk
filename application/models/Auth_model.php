<?php

/**
 * @property $db
 */
class Auth_model extends CI_Model
{
	public function get_all_user()
	{
		return $this->db->get('user')->result();
	}

	public function get_username_user($username)
	{
		return $this->db->get_where('users', ['username' => $username])->row_array();
	}

	public function get_id_user($id_users)
	{
		return $this->db->get_where('users', ['id_users' => $id_users])->row_array();
	}
}
