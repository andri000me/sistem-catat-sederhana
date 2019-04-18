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

	public function edit_produk($id_produk)
	{
		if($this->session->userdata('logged')){
			if($this->Admin_model->edit_produk($id_produk)){
				$this->session->set_flashdata('berhasil', 'Produk berhasil diperbarui');
				redirect('admin/detail_produk/'.$this->uri->segment(3));
			}else{
				$this->session->set_flashdata('gagal', 'Produk gagal diperbarui');
				redirect('admin/detail_produk/'.$this->uri->segment(3));
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

	public function edit_penjualan($id_penjualan)
	{
		if($this->session->userdata('logged')){
			$query = $this->Admin_model->detail_penjualan($id_penjualan);
			$nomor_penjualan = $query->kode_penjualan;
			$data['title'] = 'Detail Penjualan '.$nomor_penjualan;
			$data['detail'] = $this->Admin_model->detail_penjualan($id_penjualan);
			$data['detail_produk'] = $this->Admin_model->detail_produk_penjualan($id_penjualan);
			$data['city'] = $this->Admin_model->get_city();
			$this->load->view('transaction/edit_penjualan', $data);
		}else{
			redirect('admin','refresh');
		}
	}

	public function get_produk_list($id_detail_penjualan)
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->get_produk_list($id_detail_penjualan);
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

	public function edit_detail_penjualan()
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->edit_detail_penjualan();
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

	public function edit_pembeli()
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->edit_pembeli();
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */