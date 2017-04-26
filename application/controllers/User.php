<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_model','my');
	

	}

	public function index(){
		$this->load->helper('url');
		$this->load->view('my_dynamic');
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */