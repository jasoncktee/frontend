<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_resource extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	

	function update_login( $id )
	{
		$this->db->query("UPDATE admins SET 
			last_login = NOW() WHERE 
			id = ".$this->db->escape($id));
	}

	function create($name, $age, $staffno, $phoneno, $address, $gender, $state)
	{
		$name 			= 	trim($this->input->post('name', TRUE));
		$password 		= 	trim($this->input->post('password', TRUE));
		$password 		= 	md5($password);
		$access_level 	= 	'editor';

		$params	= array(
				$name,
				$age,
				$staffno,
				$phoneno,
				$address,
				$gender,
				$state
			);
		$query 	= $this->db->query("INSERT INTO resource
				(id, name, age, staffno, phoneno, address, gender, state) VALUES 
				(null, ?, ?, ?, ?, ?, ?, ?)", $params);

		return $query;
	}

	function listing()
	{
		$query = $this->db->query("SELECT id, name, age, staffno, phoneno, address, gender, state 
					FROM resource");

		return $query;
	}

	function find( $id )
	{
		$query = $this->db->query("SELECT * FROM resource WHERE id = ".$this->db->escape($id));

		return $query;
	}
}

?>