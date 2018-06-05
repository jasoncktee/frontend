<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

	function __construct()
  	{
		parent::__construct();
		$this->load->model("model_admin", 'model_admin');
		$this->lib_view->set_format($this->router->method, array('index'), lib_view::$TYPE_JSON, lib_view::$COND_EXCEPT);
  	}

	public function index()
	{
		$login  = $this->session->userdata('linda_admin_login', '');
        $id     = $this->session->userdata('linda_admin_id', '');
        if ($login == 1 && !empty($id)) 
        	return redirect(base_url() . 'page/index');
		
		$data = [];
		$this->load->view ('login', $data);
	}

	public function login()
	{
		$query 	= $this->model_admin->login();
		$row    = $query->row();

		if ($query->num_rows() <= 0)
			return $this->lib_util->return_fail('Access Denied.');
		
		$session = array(
				'linda_admin_login' 	=> 1,
				'linda_admin_id' 		=> $row->id,
				'linda_admin_level' 	=> $row->access_level,
				'linda_admin_name' 		=> $row->username
			);
		$this->session->set_userdata($session);
		$this->model_admin->update_login($row->id);

		echo json_encode(array(
				'status' 	=> 'success',
				'message' 	=> 'Login successfully.'
			));
	}

	public function logout()
	{
		$this->session->sess_destroy();

		return redirect(base_url() . 'admin');
	}

	public function delete_admin()
	{
		$rule = array(
				'user_id' => 'required',
			);
		$valid = $this->lib_util->check_validate($rule, $this->input->post());
		if (!$valid['status'])
			return $this->lib_util->return_fail($valid['message']);

		$userId = $this->input->post('user_id', TRUE);
		$user 	= $this->model_admin->find( $userId );
		if (empty($user))
			return $this->lib_util->return_fail('Invalid user id.');

		if ($user->id == 1) 
			return $this->lib_util->return_fail('Cannot delete superadmin.');

		$query = $this->model_admin->delete( $userId );
		if ($query)
			echo json_encode(array(
					'status' 	=> 'success',
					'message' 	=> 'User deleted successfully.'
				));
		else 
			return $this->lib_util->return_fail('User deleted failed.');
	}

	public function add_admin()
	{
		$rule = array(
				'name' 		=> 'required',
				'password' 	=> 'required',
			);
		$valid = $this->lib_util->check_validate($rule, $this->input->post());
		if (!$valid['status'])
			return $this->lib_util->return_fail($valid['message']);

		$query = $this->model_admin->check_exist();
		if ($query->num_rows() > 0)
			return $this->lib_util->return_fail('User already exists.');

		$query = $this->model_admin->create();
		if ($query)
			echo json_encode(array(
					'status' 	=> 'success',
					'message' 	=> 'New user inserted successfully.'
				));
		else 
			return $this->lib_util->return_fail('New user inserted failed.');
	}

	public function list_admin()
	{
		$where 	= '1=1';
		$params = array();
		$sort 	= 'id ASC';
		$index 	= $this->lib_util->post_default($this->input->post('start', TRUE), 0);
		$length = $this->lib_util->post_default($this->input->post('length', TRUE), 10);;

		$data = array( 'status' => 'success' );
		$data['recordsTotal'] = $this->model_admin->list_count($where, $params);

		$query 	= $this->model_admin->listing($where, $params, $sort, $index, $length);
		$rows 	= array();
		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			 	$rows[] = $row;
			}
		}

		$data['data'] = $rows;
		$data['recordsFiltered'] = $data['recordsTotal'];

		echo json_encode($data);
	}

	public function test()
	{
		print_r($this->session->userdata());
	}
}
