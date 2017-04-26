<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function testOutput(){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$query = $this->db->get();
		return $query->result();
	}

}

/* End of file My_model.php */
/* Location: ./application/models/My_model.php */