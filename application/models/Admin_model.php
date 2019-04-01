<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function get_all_produk()
	{
		return $this->db->select('*')
						->where('deleted',0)
						->get('ct_produk')
						->get();
	}

	public function get_kategori()
	{
		return $this->db->select('*')
						->where('deleted',0)
						->get('ct_kategori_produk')
						->result();
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */