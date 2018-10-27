<?php
/**
 * Redy Chasby
 */
class Material extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('Departement_model');
		$this->load->model('Akses_anggota');
	}

	public function dept_add()
		{
			$data = array(
					'kode_dept' => '',
					'nama_dept' => $this->input->post('nama_dept')
				);	
			$insert = $this->Departement_model->dept_add($data);
			echo json_encode(array("status" => TRUE));		
		}

	public function ajax_edit($id)
		{
			$data = $this->Departement_model->get_by_id($id); 
			echo json_encode($data);
		}

	public function dept_update()
	{
		$data = array(
				'kode_dept' =>$this->input->post('id_dept'),
				'nama_dept' => $this->input->post('nama_dept')
			);
		$this->Departement_model->dept_update(array('kode_dept' => $this->input->post('id_dept')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function dept_delete($id)
	{
		$this->Departement_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_bulk_delete()
	{
		$list_id = $this->input->post('id');
		foreach ($list_id as $id) {
		$this->Departement_model->delete_by_id($id);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function getalldept(){
		$data = $this->Departement_model->get_all();
		echo json_encode($data);
	}
	
}