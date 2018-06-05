<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->view('welcome_message');
	}

	public function form()
	{
		$this->load->view('form');
	}

	public function success()
	{
		$this->load->view('success');
	}

	public function service()
	{
		header("Content-Type: application/json");

		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		if (empty($username) || empty($password)) {
			echo json_encode(array(
				'status'    => 'failed',
				'message'   => 'Invalid parameters'
			));
			return;
		}

		if ($username == 'admin' && $password == 'admin')
		{
			echo json_encode(array(
				'status'    => 'success',
				'message'   => 'Login successfully.'
			));
		}
		else {
			echo json_encode(array(
				'status'    => 'failed',
				'message'   => 'Username and password not match.'
			));
		}
	}
}
