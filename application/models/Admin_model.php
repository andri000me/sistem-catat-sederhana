<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function get_all($table)
	{
		return $this->db->select('*')
						->where('deleted',0)
						->get($table)
						->result();
	}
	
	public function count_all($table)
	{
		return $this->db->count_all_results($table);
	}

	public function count_produk_terjual()
	{
		$query  = $this->db->query("SELECT sum(ct_detail_penjualan.quantity) as terjual FROM ct_detail_penjualan")->result();
		foreach ($query as $data) {
			$jumlah = $data->terjual;
		}

		return $jumlah;
	}

	public function omset()
	{
		$query = $this->db->query("SELECT sum(ct_penjualan.total) as omset FROM ct_penjualan")->result();
		foreach ($query as $data) {
			$omset = $data->omset;
		}

		return $omset;
	}

	public function kode_produk()
    {
        $this->db->select('RIGHT(ct_produk.kode_produk,5) as kode_produk', FALSE);
        $this->db->order_by('kode_produk','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('ct_produk');   
        if($query->num_rows() <> 0){      
   
               $data = $query->row();      
               $kode = intval($data->kode_produk) + 1; 
          }
          else{      
               $kode = 1;
          } 
              $kode_produk_max = str_pad($kode, 5, "0", STR_PAD_LEFT);    
              $kode_tampil = "BSC-".$kode_produk_max;
              return $kode_tampil;  
    }

	public function add_produk()
	{
		$kode_produk = $this->kode_produk();
		$nama_produk = $this->input->post('nama_produk');
		$id_kategori_produk = $this->input->post('id_kategori_produk');
		$harga_produksi = $this->input->post('harga_produksi');
		$harga_jual = $this->input->post('harga_jual');
		$warna = $this->input->post('warna');
		$size_produk =$this->input->post('size_produk');
		$stok = $this->input->post('stok');
		$id_user = $this->input->post('id_user');

		$data = array(
			'kode_produk' => $kode_produk,
			'nama_produk' => $nama_produk,
			'id_kategori_produk' => $id_kategori_produk,
			'harga_produksi' => $harga_produksi,
			'harga_jual' => $harga_jual,
			'warna' => $warna,
			'size_produk' => $size_produk,
			'stok' => $stok,
			'id_user' => $id_user 
		);

		$this->db->insert('ct_produk', $data);
		$id = $this->db->insert_id();

		if($this->db->affected_rows()>0){
			return $id;
		}else{
			return FALSE;
		}
	}

	public function get_produk()
	{
		return $this->db->select('ct_produk.*,ct_kategori_produk.nama_kategori_produk,ct_user.nama_user')
						->from('ct_produk')
						->join('ct_kategori_produk','ct_kategori_produk.id_kategori_produk=ct_produk.id_kategori_produk')
						->join('ct_user','ct_user.id_user=ct_produk.id_user')
						->where('ct_produk.deleted',0)
						->get()
						->result();
	}

	public function cek_foto($id_produk)
	{
		return $this->db->select('*')
						->where('deleted',0)
						->where('id_produk',$id_produk)
						->get('ct_detail_produks')
						->result();
	}

	public function get_penjualan()
	{
		return $this->db->select('ct_penjualan.*,ct_user.nama_user')
						->from('ct_penjualan')
						->join('ct_user','ct_user.id_user=ct_penjualan.id_user')
						->where('ct_penjualan.deleted',0)
						->get()
						->result();
	}

	public function delete_penjualan($id_penjualan)
	{
		return $this->db->update('ct_penjualan',array('deleted'=>'1'),array('id_penjualan'=>$id_penjualan));
	}

	public function scan_data($scan_data)
	{
				$this->db->select('*');
				$this->db->like('nama_produk',$scan_data);
				$this->db->or_like('kode_produk',$scan_data);
				$this->db->where('deleted',0);
		return 	$this->db->get('ct_produk')->result();
	}

	public function kode_penjualan()
	{
		$this->db->select('RIGHT(ct_penjualan.kode_penjualan,5) as kode_penjualan', FALSE);
        $this->db->order_by('kode_penjualan','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('ct_penjualan');   
        if($query->num_rows() <> 0){      
   
               $data = $query->row();      
               $kode = intval($data->kode_penjualan) + 1; 
          }
          else{      
               $kode = 1;
          } 
              $kode_penjualan_max = str_pad($kode, 5, "0", STR_PAD_LEFT);    
              $kode_tampil = "PJ-".$kode_penjualan_max;
              return $kode_tampil;
	}

	public function add_pesanan()
	{
		$kode_penjualan = $this->kode_penjualan();
		$nama_pembeli = $this->input->post('nama_pembeli');
		$nomor_telepon = $this->input->post('nomor_telepon');
		$alamat_pembeli = $this->input->post('alamat_pembeli');
		$kota_tujuan = $this->input->post('kota_tujuan');
		$total  = $this->input->post('total');

		$data = array(
			'kode_penjualan' => $kode_penjualan,
			'tanggal_penjualan' => date('Y-m-d H:i:s'),
			'nama_pembeli' => $nama_pembeli,
			'alamat_pembeli' => $alamat_pembeli,
			'id_user' => $this->session->userdata('id_user'),
			'nomor_telepon' => $nomor_telepon,
			'kota_tujuan' => $kota_tujuan,
			'status' => 'Belum Terbayar',
			'total' => $total
		);

		$this->db->insert('ct_penjualan',$data);
		$id = $this->db->insert_id();

		$detail = array();
		$id_produk = $this->input->post('id_produk');
		$kode_produk = $this->input->post('kode_produk');
		$nama_produk = $this->input->post('nama_produk');
		$harga_produk = $this->input->post('harga_produk');
		$quantity = $this->input->post('quantity');
		$size = $this->input->post('size');
		$subtotal = $this->input->post('subtotal');

		foreach ($id_produk as $i => $item) {
			$detail[] = array(
				'id_produk' => $id_produk[$i],
				'kode_produk'=> $kode_produk[$i],
				'nama_produk' => $nama_produk[$i],
				'harga_produk' => $harga_produk[$i],
				'quantity' => $quantity[$i],
				'size' => $size[$i],
				'subtotal' => $subtotal[$i],
				'id_penjualan' => $id
			);
		}

		$this->db->insert_batch('ct_detail_penjualan', $detail, $id);

		$this->get_cost($id,$kota_tujuan);

		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_cost($id_penjualan,$kota_tujuan)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=444&destination=$kota_tujuan&weight=1000&courier=jne",
		  CURLOPT_HTTPHEADER => array(
		  	"content-type: application/x-www-form-urlencoded",
		    "key:3275a8000010695a45f9ea333d0145f9"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $hasil = json_decode($response,true);
		  
		  //Get Ongkir
		  $ongkir = $hasil['rajaongkir']['results'][0]['costs'][1]['cost'][0]['value'];
		  $this->db->update('ct_penjualan', array('ongkos_kirim' => $ongkir),array('id_penjualan'=>$id_penjualan));

		  //Generate Total Harga dengan Ongkir
		  $get_total = $this->db->query("SELECT total FROM ct_penjualan WHERE id_penjualan=$id_penjualan")->row();
		  $total = $get_total->total;
		  $new_total  = $total + $ongkir;
		  $this->db->update('ct_penjualan', array('total' => $new_total),array('id_penjualan'=>$id_penjualan));
		}

	}

	public function detail_penjualan($id_penjualan)
	{
		return $this->db->select('ct_penjualan.*,ct_user.nama_user')
						->from('ct_penjualan')
						->join('ct_user','ct_user.id_user=ct_penjualan.id_user')
						->where('ct_penjualan.id_penjualan',$id_penjualan)
						->get()
						->row();
	}

	public function detail_produk_penjualan($id_penjualan)
	{
		return $this->db->select('*')
						->where('id_penjualan',$id_penjualan)
						->get('ct_detail_penjualan')
						->result();
	}

	public function delete_foto_produk($id_detail_produk)
	{
		return $this->db->where('id_detail_produk',$id_detail_produk)
						->delete('ct_detail_produks');
	}

	public function delete_produk($id_produk)
	{
		$this->db->update('ct_produk',array('deleted'=>'1'),array('id_produk'=>$id_produk));
		$this->db->update('ct_detail_produks',array('deleted'=>'1'),array('id_produk'=>$id_produk));

		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function add_kategori_produk()
	{
		$nama_kategori_produk = $this->input->post('nama_kategori_produk');
		$data = array(
			'nama_kategori_produk' => $nama_kategori_produk,
			'id_user' => $this->session->userdata('id_user')
		);
		$this->db->insert('ct_kategori_produk', $data);

		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_kategori_by_id($id_kategori_produk)
	{
		return $this->db->where('id_kategori_produk',$id_kategori_produk)
						->get('ct_kategori_produk')
						->result();
	}

	public function edit_kategori_produk($id_kategori_produk)
	{
		$data = array(
			'nama_kategori_produk' => $this->input->post('edit_nama_kategori_produk'),
			'id_user' => $this->session->userdata('id_user')
		);

		$this->db->where('id_kategori_produk',$id_kategori_produk)
				 ->update('ct_kategori_produk',$data);

		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_kategori_produk($id_kategori_produk)
	{
		$this->db->update('ct_kategori_produk',array('deleted' => '1'),array('id_kategori_produk' => $id_kategori_produk));

		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function data_omset_user()
	{
		$query = $this->db->query("SELECT ct_user.*, count(ct_penjualan.id_user) as jumlah_penjualan, sum(ct_penjualan.total) as omset from ct_user left join ct_penjualan on (ct_user.id_user = ct_penjualan.id_user) group by ct_user.id_user order by count(ct_penjualan.id_user) DESC")->result();

        return $query;
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */