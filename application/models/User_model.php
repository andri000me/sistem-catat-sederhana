<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$get = $this->db->where('email', $email)
						->where('password',sha1($password))
						->where('status',1)
						->get('ct_user');

		if($get->num_rows()>0){
			$data = array(
				'id_user' => $get->row()->id_user,
				'nama_user' => $get->row()->nama_user,
				'logged' => TRUE,
				'email' => $email 
			);
			$this->session->set_userdata($data);
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_status($email)
	{
		$get = $this->db->select('status')
						->where('email',$email)
						->get('ct_user')
						->row();
	}

	public function add_new_user()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$nama_lengkap = $this->input->post('nama_lengkap');

		$data = array(
			'email' => $email,
			'password' => sha1($password),
			'nama_user' => $nama_lengkap
		);

		$this->db->insert('ct_user', $data);
		$id = $this->db->insert_id();
		$key = sha1((string)$id);

		// $config = Array(
		// 	  "protocol" => "smtp",
		// 	  "smtp_host" =>"ssl://smtp.googlemail.com",
		// 	  "smtp_port" => 465,
		// 	  "smtp_user" => "basicbasicco@gmail.com",
		// 	  "smtp_pass" => "basicclass13",
		// 	  "mailtype"  => "html",
	 //          "starttls"  => true,
	 //      	);

		// $this->load->library('email');
		// $this->email->initialize($config);
		// $this->email->set_newline("\r\n"); 
		// $this->email->from('basicbasicco@gmail.com', 'Admin : Basicclass.co');
		// $this->email->to($email);
		
		// $this->email->subject('Konfirmasi User Baru : Important');
		// $this->email->message('Mohon untuk konfirmasi agar akun anda dapat digunakan \r\n Silakan klik link <a href="'.base_url().'user/activate/'.$email.'/'.$key.'">Activate</a>');
		
		// $this->email->send();
		
		// echo $this->email->print_debugger();

		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function activate($email,$key)
	{
		$data = array('status' => '1');
		$this->db->where('email',$email);
		$this->db->where('md5(id_user)',$key);
		return $this->db->update('ct_user',$data);
	}

	public function check_email($email)
	{
		$this->db->select('email');
		$this->db->like('email', $email);
		$this->db->where('deleted',0);
		return $this->db->get('ct_user')->result();
	}	
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */