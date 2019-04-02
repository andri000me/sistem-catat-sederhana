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
		$size_produk =$this->input->post('size_produk');
		$stok = $this->input->post('stok');
		$id_user = $this->input->post('id_user');

		$data = array(
			'kode_produk' => $kode_produk,
			'nama_produk' => $nama_produk,
			'id_kategori_produk' => $id_kategori_produk,
			'harga_produksi' => $harga_produksi,
			'harga_jual' => $harga_jual,
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
						->get('ct_detail_produk')
						->result();
	}

	public function delete_produk($id_produk)
	{
		return $this->db->update('ct_produk',array('deleted'=>'1'),array('id_produk'=>$id_produk));
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

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */