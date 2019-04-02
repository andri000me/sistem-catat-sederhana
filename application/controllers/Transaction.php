<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}

	public function add_produk()
	{
		if($this->session->userdata('logged')){
			if($this->Admin_model->add_produk()){
				$this->session->set_flashdata('berhasil', 'Produk baru berhasil diinputkan');
				redirect('admin/produk');
			}else{
				$this->session->set_flashdata('gagal', 'Produk baru gagal diinputkan');
				redirect('admin/produk');
			}
		}
	}

}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */