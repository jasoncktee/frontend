<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_admin extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function login()
	{
		$name 		= trim($this->input->post('a', TRUE));
		$password 	= trim($this->input->post('b', TRUE));
		$password 	= md5($password);

		$this->db->cache_on();
		
		$query = $this->db->query("SELECT * FROM admins WHERE 
			username = " . $this->db->escape($name) . " AND 
			password = " . $this->db->escape($password));

		return $query;
	}

	function update_login( $id )
	{
		$this->db->query("UPDATE admins SET 
			last_login = NOW() WHERE 
			id = ".$this->db->escape($id));
	}

	function check_exist()
	{
		$name = trim($this->input->post('name', TRUE));

		$this->db->cache_on();

		$query = $this->db->query("SELECT * FROM admins WHERE 
				username = " . $this->db->escape($name));

		return $query;
	}

	function create()
	{
		$name 			= 	trim($this->input->post('name', TRUE));
		$password 		= 	trim($this->input->post('password', TRUE));
		$password 		= 	md5($password);
		$access_level 	= 	'editor';

		$params	= array(
				$name,
				$password,
				$access_level,
			);
		$query 	= $this->db->query("INSERT INTO admins
				(username, password, access_level, created_at, updated_at) VALUES 
				(?, ?, ?, NOW(), NOW())", $params);

		return $query;
	}

	function listing( $where, $param, $sort, $index, $length )
	{
		$query = $this->db->query("SELECT id, username, access_level, last_login, created_at 
					FROM admins 
					WHERE " . $where . " 
					ORDER BY " . $sort . " 
					LIMIT " . $index . "," . $length, $param);

		return $query;
	}

	function find( $id )
	{
		$query = $this->db->query("SELECT * FROM admins WHERE id = ? LIMIT 1", array($id));

		if ($query->num_rows() <= 0)
			return null;
		else
			return $query->row();
	}

	function delete( $id )
	{
		return $this->db->query("DELETE FROM admins WHERE id = ?", array($id));
	}

	function list_count( $where, $param )
	{
		$query = $this->db->query("SELECT COUNT(*) AS count FROM admins WHERE " . $where, $param);

		$count = 0;
		foreach ($query->result() as $row) {
		   $count = $row->count;
		}
		return $count;
	}
}

?>