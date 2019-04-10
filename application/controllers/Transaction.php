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

	public function add_pesanan()
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->add_pesanan();
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}
	}

	public function detail_penjualan($id_penjualan)
	{
		if($this->session->userdata('logged')){
			$query = $this->Admin_model->detail_penjualan($id_penjualan);
			$nomor_penjualan = $query->kode_penjualan;
			$data['title'] = 'Detail Penjualan '.$nomor_penjualan;
			$data['detail'] = $this->Admin_model->detail_penjualan($id_penjualan);
			$data['detail_produk'] = $this->Admin_model->detail_produk_penjualan($id_penjualan);
			$this->load->view('transaction/detail_penjualan', $data);
		}else{
			redirect('admin','refresh');
		}
	}

}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */