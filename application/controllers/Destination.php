<?php
/**
 * Redy Chasby
 */
class Destination extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Destination_model');
		$this->load->model('Akses_anggota');
	}

	public function destination_add()
	{
		$data =array(
			'kode_dest' =>'',
			'nama_warna' => $this->input->post('nama_dest'));
		$insert = $this->Destination_model->destination_add($data);
		echo json_encode(array("status" => TRUE));
	}
}