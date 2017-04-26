<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_oracle extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->oracle = $this->load->database('oracle',true);
	}

	public function testGetData(){
		// $this->oracle->select('dbekspor.car');
		// $this->oracle->from('dbekspor.tep_peb_proses');
		// $this->oracle->where('trunc(wk_rekam) = trunc(sysdate) and kd_kantor ='."'040300'");
		// $query = $this->oracle->get();
		$sql = "SELECT a.car,b.* from dbimpor.tid_pib_brg b, dbimpor.tip_pib_ctl a where a.car ='00000000732920161110000005' AND a.seq_pib = b.seq_pib";
		$query =  $this->oracle->query($sql);
		return $query->result_array();
	}

	public function getDataBarangByCar($car){
		$sql = "SELECT a.car,b.* from dbimpor.tid_pib_brg b, dbimpor.tip_pib_ctl a where a.car ='".$car."' AND a.seq_pib = b.seq_pib";
		$query = $this->oracle->query($sql);
		return $query->result_array();
		$query->free_result();
	}

}

/* End of file Model_oracle.php */
/* Location: ./application/models/Model_oracle.php */