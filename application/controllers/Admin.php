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
			$data['count_penjualan'] = $this->Admin_model->count_all('ct_penjualan');
			$data['count_produk_terjual'] = $this->Admin_model->count_produk_terjual();
			$data['sum_omset'] = $this->Admin_model->omset();
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

					$insert[$i]['img_produk'] = $data['file_name'];
				}
				$insert[$i]['id_produk'] = $this->uri->segment(3);
			}
			$this->db->insert_batch('ct_detail_produks', $insert,array('id_produk' => $this->uri->segment(3)));

			$this->session->set_flashdata('berhasil', 'Foto berhasil ditambahkan');
			redirect('admin/tambah_foto_produk/'.$this->uri->segment(3),'refresh');
		}
	}

	public function get_produk()
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->get_produk();
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}
	}

	public function data_produk()
	{
		if($this->session->userdata('logged')){
			$data['title'] = 'Data Produk';
			$data['produk'] = $this->Admin_model->get_produk();
			$this->load->view('data/data_produk', $data);
		}else{
			redirect('admin','refresh');
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

	public function add_kategori_produk()
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->add_kategori_produk();
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

	public function get_kategori_produk()
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->get_all('ct_kategori_produk');
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

	public function get_kategori_produk_by_id($id_kategori_produk)
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->get_kategori_by_id($id_kategori_produk);
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

	public function edit_kategori_produk($id_kategori_produk)
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->edit_kategori_produk($id_kategori_produk);
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

	public function delete_kategori_produk($id_kategori_produk)
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->delete_kategori_produk($id_kategori_produk);
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}else{
			redirect('admin','refresh');
		}
	}

	public function data_kategori_produk()
	{
		$data['title'] = 'Data Kategori Produk';
		$data['kategori'] = $this->Admin_model->get_all('ct_kategori_produk');
		$this->load->view('data/data_kategori_produk', $data);
	}

	public function penjualan()
	{
		if ($this->session->userdata('logged')) {
			$data['title'] = 'Add Pesanan';
			$data['city'] = $this->get_city();
			$this->load->view('transaction/add_penjualan', $data);
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

	public function get_penjualan()
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->get_penjualan();
			if($data){
				echo json_encode($data);
			}else{
				return FALSE;
			}
		}
	}

	public function data_penjualan()
	{
		if($this->session->userdata('logged')){
			$data['title'] = 'Data Penjualan';
			$data['penjualan'] = $this->Admin_model->get_penjualan();
			$this->load->view('data/data_penjualan', $data);
		}else{
			redirect('admin','refresh');
		}
	}

	public function delete_penjualan($id_penjualan)
	{
		if($this->session->userdata('logged')){
			$data = $this->Admin_model->delete_penjualan($id_penjualan);
			if($data){
				echo json_encode($data);
			}else{
				return false;
			}
		}
	}

	public function scan_data()
	{
		if($this->session->userdata('logged')){
			$scan_data = $this->input->post('search_data');

				$result = $this->Admin_model->scan_data($scan_data);

					if(!empty($result)){
						foreach ($result as $row) {
							echo '<li>
					               <a class="list" style="display:block;cursor:pointer" data-produkid="'.$row->id_produk.'" data-produkkode="'.$row->kode_produk.'" data-produknama="'.$row->nama_produk.'" data-produkharga="'.$row->harga_jual.'" onclick="add_barang(this);">
								        <div class="row">
									        <div class="col-sm-6">
									               ' . $row->nama_produk. '
									        </div>
									        <div class="col-sm-6">
								                		
							                </div>
						                </div>
					                </a>
					            </li>';
						}
					}else{
						echo '<li><i class="mdi mdi-close-circle text-danger"></i> Produk tidak ditemukan </li>';
					}
		}else{
			redirect('admin','refresh');
		}
	}

	public function get_city()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key:3275a8000010695a45f9ea333d0145f9"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		}else {
		  return json_decode($response,true);
		}
	}

	public function cetak_nota($id_penjualan)
	{
		$query = $this->Admin_model->detail_penjualan($id_penjualan);
		$nomor_penjualan = $query->kode_penjualan;
		$data['title'] = 'Nota '.$nomor_penjualan;
		$data['detail'] = $this->Admin_model->detail_penjualan($id_penjualan);
		$data['detail_produk'] = $this->Admin_model->detail_produk_penjualan($id_penjualan);
		$this->load->view('transaction/cetak_nota',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->setPaper('A4','portrait');
		$this->dompdf->set_option('isHtml5ParserEnabled', true);
		$this->dompdf->loadHtml($html);
		$this->dompdf->render();
		$this->dompdf->stream('Detail pesanan - '.$nomor_penjualan.'.pdf',array('Attachment'=>0));
	}

	public function delete_foto_produk($id_detail_produk)
	{
		if($this->session->userdata('logged')){
			$query = $this->db->select('*')->where('id_detail_produk',$id_detail_produk)->get('ct_detail_produks')->row();
			$id_produk = $query->id_produk;
			$nama_file = $query->img_produk;
			$file = FCPATH.'uploads/'.$nama_file;
			if(file_exists($file)){
				unlink($file);
				if($this->Admin_model->delete_foto_produk($id_detail_produk)){
					// $this->session->set_flashdata('berhasil', 'Foto berhasil dihapus!');
					redirect('admin/tambah_foto_produk/'.$id_produk,'refresh');
				}
			}else{
				// $this->session->set_flashdata('gagal', 'File tidak ditemukan!');
				redirect('admin/tambah_foto_produk/'.$id_produk,'refresh');
			}
		}else{
			redirect('admin','refresh');
		}
		
	}

	public function data_omset_user()
	{
		if($this->session->userdata('logged')){
			$data['title'] = 'Data Omset User';
			$data['omset'] = $this->Admin_model->data_omset_user();
			$this->load->view('data/data_omset_user', $data);
		}else{
			redirect('admin','refresh');
		}
	}

	public function laporan_penjualan()
	{
		$data['title'] = 'Laporan Penjualan';
		$this->load->view('transaction/laporan_penjualan', $data);
	}

	public function cari_laporan()
	{
		if($this->session->userdata('logged')){
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$output = '';
		$no = 0;
		$total = 0;

		$results = $this->Admin_model->cari_laporan($from_date,$to_date);
			$output .= '<br>
		      	<div style="width:100%">
		      		<h3 style="text-align:center">LAPORAN PENJUALAN</h3>
		      		<h4 style="text-align:center">Periode</h4>
		      		<h4 style="text-align:center">'.date('d F Y',strtotime($_POST["from_date"])).' s/d. '.date('d F Y',strtotime($_POST["to_date"])).'</h4>
		      	</div>
		      	<br>
		      	<table class="table table-bordered" border="1" cellpadding="3" style="width:100%;border-collapse:collapse" id="mytable">
		      	<thead>
		           <tr>
		            <th>No</th>
		            <th>Nomor Penjualan</th>
		            <th>Tanggal Penjualan</th>
		            <th>Pelanggan</th>
		            <th>Total</th>
		           </tr>
		         </thead>
		      ';
		if(!empty($results)){

			foreach ($results as $data) {
				$output .= '<tbody id="laporan_penjualan">
								<tr>
									<td>'.++$no.'</td>
									<td>'.$data->kode_penjualan.'</td>
									<td>'.date('d F Y',strtotime($data->tanggal_penjualan)).'</td>
									<td>'.$data->nama_pembeli.'</td>
									<td>Rp '.number_format($data->total).'</td>
								</tr>
							</tbody>';
							$total += $data->total;
			}
			$output .= '<tr>
							<td colspan="4" style="text-align: right;padding:5px"><b>Grand Total</b></td>
							<td>Rp '.number_format($total).'</td>
						</tr>';
		}else{
			$output .= '<tr>
							<td><i class="mdi mdi-close-circle text-danger"></i> Penjualan tidak ditemukan</td>
						</tr>';
		}
		$output .= '
		      </tbody>
		      </table>';
		      echo $output;
		}else{
			redirect('admin','refresh');
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */