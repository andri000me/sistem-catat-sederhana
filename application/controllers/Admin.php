<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('User_model','Admin_model'));
	}

	public function index()
	{
		if($this->session->userdata('logged')){
			$data['title'] = 'Dashboard';
			$data['count_user'] = $this->Admin_model->count_all('ct_user');
			$this->load->view('data/dashboard', $data);
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

	public function tambah_foto_produk($id_produk)
	{
		if($this->session->userdata('logged')){
			$data['title'] = 'Tambah Foto Produk';
			$data['cek_foto'] = $this->Admin_model->cek_foto($id_produk);
			$this->load->view('transaction/tambah_foto_produk',$data);
		}else{
			redirect('admin','refresh');
		}
		
	}

	public function img_upload()
	{
		if($this->input->post('submit') && !empty($_FILES['img_produk']['name'])){
			$num = sizeof($_FILES['img_produk']['tmp_name']);
			$files = $_FILES['img_produk'];

			for($i=0;$i<$num;$i++){ 
				if($_FILES['img_produk']['error'][$i] != 0){
					$this->form_validation->set_message('img_produk','Gagal');
					return false;
				}
			}

			$config['upload_path'] = FCPATH.'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|bmp|png|gif|pdf';

			for($i=0;$i<$num;$i++){ 
				$_FILES['img_produk']['name'] = $files['name'][$i];
				$_FILES['img_produk']['type'] = $files['type'][$i];
				$_FILES['img_produk']['tmp_name'] = $files['tmp_name'][$i];
				$_FILES['img_produk']['error'] = $files['error'][$i];
				$_FILES['img_produk']['size'] = $files['size'][$i];

				
				$this->upload->initialize($config);

				if($this->upload->do_upload('img_produk')){
					$data = $this->upload->data();
					echo '<pre>';
					print_r($data);
					echo '</pre>';

					$insert[$i]['img_produk'] = $data['file_name'];
				}
				$insert[$i]['id_produk'] = $this->uri->segment(3);
			}

			$this->db->insert_batch('ct_detail_produk', $insert,array('id_produk' => $this->uri->segment(3)));
		}
	}

	public function data_produk()
	{
		if($this->session->userdata('logged')){
			$data['title'] = 'Data Produk';
			$data['produk'] = $this->Admin_model->get_produk();
			$this->load->view('data/data_produk', $data);
		}
	}

	public function delete_produk($id_produk)
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->delete_produk($id_produk);
			if($data){
				echo json_encode($data);
			}else{
				return false;
			}
		}
	}

	public function penjualan()
	{
		if ($this->session->userdata('logged')) {
			$data['title'] = 'Add Pesanan';
			$this->load->view('transaction/penjualan', $data);
		}else{
			redirect('admin','refresh');
		}
		
	}

	public function produk()
	{
		if ($this->session->userdata('logged')) {
			$data['title'] = 'Add Produk';
			$data['kategori'] = $this->Admin_model->get_all('ct_kategori_produk');
			$this->load->view('transaction/add_produk', $data, FALSE);
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */