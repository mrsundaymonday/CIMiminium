<?php
/**
 * Redy Chasby
 */
class Ng extends CI_Controller
{
	
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('datatables');
		$this->load->model('Ng_model');
	}

	public function ajax_list()
    {
        $this->load->helper('url');
 
        $list = $this->Ng_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$value->nama_ng.'">';
            $row[] = $value->nama_ng;
            $row[] = $value->kategori_ng;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="return edit_value('."'".$value->nama_ng."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_value('."'".$value->nama_ng."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Ng_model->count_all(),
                        "recordsFiltered" => $this->Ng_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->Ng_model->get_by_id($id);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
         
        $data = array(
                'nama_ng' => $this->input->post('nama_ng'),
                'kategori_ng' => $this->input->post('kategori_ng')
            );
 
        $insert = $this->Ng_model->save($data);
 
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
 
        $data = array(
                'nama_ng' => $this->input->post('nama_ng'),
                'kategori_ng' => $this->input->post('kategori_ng')
            );
         $this->Ng_model->update(array('nama_ng' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->Ng_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->Ng_model->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_ng') == '')
		{
			$data['inputerror'][] = 'nama_ng';
			$data['error_string'][] = 'Nama NG is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('kategori_ng') == '')
		{
			$data['inputerror'][] = 'kategori_ng';
			$data['error_string'][] = 'Kategori NG is required';
			$data['status'] = FALSE;
		}	
		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
}