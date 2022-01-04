<?php
class Api_model extends CI_Model
{
	function fetch_all()
	{
		$this->db->order_by('id_champion', 'DESC');
		return $this->db->get('champions');
	}

	function insert_api($data)
	{
		$this->db->insert('chamipons', $data);
	}

	function fetch_single_user($user_id)
	{
		$this->db->where('id_champion', $user_id);
		$query = $this->db->get('champions');
		return $query->result_array();
	}

	function update_api($user_id, $data)
	{
		$this->db->where('id_champion', $user_id);
		$this->db->update('champions', $data);
	}

	function delete_single_user($user_id)
	{
		$this->db->where('id_champion', $user_id);
		$this->db->delete('champions');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>