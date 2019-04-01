<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		if($this->session->userdata('logged')){
			// $data['title'] = 'Dashboard';
			// $this->load->view('dashboard', $data);
			echo 'Succes <a href="'.base_url().'admin/logout">Logout</a>';
		}else{
			$data['title'] = 'Login User';
			$data['main_view'] = 'transaction/login';
 			$this->load->view('transaction/template_login', $data);
		}		
	}

	public function login()
	{
		$data = $this->User_model->login();
		if($data){
			echo json_encode($data);
		}else{
			return FALSE;
		}
	}

	public function logout()
	{
		$data = array(
			'email' => '',
			'logged' => FALSE
			);

		$this->session->sess_destroy();
		redirect('admin','refresh');
	}

	public function register()
	{
		$data['title'] = 'Register User';
		$data['main_view'] = 'transaction/register';
		$this->load->view('transaction/template_login', $data);
	}

	public function check_email()
	{
		$num=(!empty($_POST["email"]))?$_POST["email"]:die('Search is empty');

		$email = $this->input->post('email');

		$query = $this->User_model->check_email($email);

		if($num == $email){
			foreach ($query as $data) {
				$data = array(
					'email' => $data->email
				);
			}
			echo json_encode($data);
		}
	}

	public function register_run()
	{	
		$data = $this->User_model->add_new_user();
		if($data){
			echo json_encode($data);
		}else{
			return FALSE;
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */