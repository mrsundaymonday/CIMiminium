<?php
/**
 * Redy Chasby
 */
class Line extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Line_model');
		$this->load->model('Akses_anggota');
	}

	public function line_add()
	{
		$data = array(
				'kode_line' =>'',
				'nama_line' => $this->input->post('nama_line'));
		$insert = $this->Line_model->line_add($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Line_model->get_by_id($id);
		echo json_encode($data);
	}

	public function line_update()
	{
		$data = array(
				'kode_line' => $this->input->post('kode_line'),
				'nama_line' => $this->input->post('nama_line'));
		$this->Line_model->line_update(array('kode_line' => $this->input->post('kode_line')),$data);
		echo json_encode(array("status" => TRUE));
	}

	public function line_delete($id)
	{
		$this->Line_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_bulk_delete()
	{
		$list_id = $this->input->post('id');
		foreach ($list_id as $id) {
			$this->Line_model->delete_by_id($id);
		}
		echo json_encode(array("status" => TRUE));
		
	}
}