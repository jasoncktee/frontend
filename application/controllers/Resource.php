<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource extends CI_Controller {

	function __construct()
  	{
		parent::__construct();
		$this->load->model("model_resource", 'model_resource');
  	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('resource');
	}

	public function listresource() {
		$query 	= $this->model_resource->listing();
		$rows 	= array();
		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			 	$rows[] = $row;
			}
		}

		$data['data'] = $rows;

		echo json_encode($data);
	}

	public function addservice()
	{
		header("Content-Type: application/json");

		$name = $this->input->post('name', TRUE);
		$age = $this->input->post('age', TRUE);
		$staffno = $this->input->post('staffno', TRUE);
		$phoneno = $this->input->post('phoneno', TRUE);
		$address = $this->input->post('address', TRUE);
		$gender = $this->input->post('gender', TRUE);
		$state = $this->input->post('state', TRUE);
		

		$query 	= $this->model_resource->create($name, $age, $staffno, $phoneno, $address, $gender, $state);

		echo json_encode(array(
				'status'    => 'Success',
				'message'   => 'Record Insert Successfully.'
			));

	}

	public function findresource() {
		header("Content-Type: application/json");

		$id = $this->input->post('id', TRUE);
		$rows 	= array();
		$query 	= $this->model_resource->find($id);
		// if($query->num_rows() > 0) {
		// 	foreach ($query->result() as $row) {
		// 	 	$rows[] = $row;
		// 	}
		// }

		// $data['data'] = $query;
		echo json_encode($query);
	}
}
