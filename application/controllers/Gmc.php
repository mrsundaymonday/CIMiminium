<?php
/**
 * Redy Chasby
 */
class Gmc extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('datatables');
		$this->load->model('Warna_model');
		$this->load->model('Gmc_model');
		$this->load->model('Line_model');
		$this->load->model('Destination_model');
	}
	/*public function index(){
		$data['content'] = 'admin/gmc';
  		$this->load->view('admin/include/template',$data);	
	}*/
	public function ajax_list()
    {
        $this->load->helper('url');
 
        $list = $this->Gmc_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$value->kode_gmc.'">';
            $row[] = $value->kode_gmc;
            $row[] = $value->nama_model;
            $row[] = $value->color_model;
            $row[] = $value->dest_model;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="return edit_value('."'".$value->kode_gmc."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_value('."'".$value->kode_gmc."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Gmc_model->count_all(),
                        "recordsFiltered" => $this->Gmc_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->Gmc_model->get_by_id($id);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
         
        $data = array(
                'kode_gmc' => $this->input->post('kode_gmc'),
                'nama_model' => $this->input->post('nama_model'),
                'color_model' => $this->input->post('color_model'),
                'dest_model' => $this->input->post('dest_model')
            );
 
        $insert = $this->Gmc_model->save($data);
 
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
 
        $data = array(
                'kode_gmc' => $this->input->post('kode_gmc'),
                'nama_model' => $this->input->post('nama_model'),
                'color_model' => $this->input->post('color_model'),
                'dest_model' => $this->input->post('dest_model')
            );
         $this->Gmc_model->update(array('kode_gmc' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->Gmc_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->Gmc_model->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kode_gmc') == '')
		{
			$data['inputerror'][] = 'kode_gmc';
			$data['error_string'][] = 'kode gmc is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_model') == '')
		{
			$data['inputerror'][] = 'nama_model';
			$data['error_string'][] = 'Nama model is required';
			$data['status'] = FALSE;
		}

		
		if($this->input->post('color_model') == '')
		{
			$data['inputerror'][] = 'color_model';
			$data['error_string'][] = 'Color model is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dest_model') == '')
		{
			$data['inputerror'][] = 'dest_model';
			$data['error_string'][] = 'Destination model is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
}