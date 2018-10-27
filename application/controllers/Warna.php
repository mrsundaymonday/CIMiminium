<?php
/**
 * Redy Chasby
 */
class Warna extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Warna_model');
		$this->load->model('Akses_anggota');
	}

	public function warna_add()
	{
		$data = array(
				'kode_warna' =>'',
				'nama_warna' => $this->input->post('nama_warna'));
		$insert = $this->Warna_model->warna_add($data);
		echo json_encode(array("status" => TRUE));
	}
 
}