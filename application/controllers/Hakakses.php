<?php
/**
 * Redy Chasby
 */
class Hakakses extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library('datatables');
        $this->load->model('Hakakses_model');
        $this->load->model('User_model');
	}

	public function ajax_list()
    {
        $this->load->helper('url');
 
        $list = $this->Hakakses_model->get_datatables();
     /*   print_r($this->db->last_query());
        exit();*/
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$value->id_tblmenuakses.'">';
            $row[] = $value->username;
            $row[] = $value->level;
            $row[] = $value->nama;
            $row[] = $value->nama_menu;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_value('."'".$value->id_tblmenuakses."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Hakakses_model->count_all(),
                        "recordsFiltered" => $this->Hakakses_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->Hakakses_model->get_by_id($id);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        for ($i=0; $i < count($this->input->post('kode_menu'));$i++) { 
                $data = array(
                    'id' =>'',
                    'id_user' => $this->input->post('id_user'),
                    'kode_menu' => $this->input->post('kode_menu')[$i]
                );                  
            $insert = $this->Hakakses_model->save($data);                
      //  print_r($this->db->last_query());      
            }  
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
 
        $data = array(
                'id' => '',
                'id_user' => $this->input->post('id_user'),
                'kode_menu' => $this->input->post('kode_menu')
            );
         $this->Hakakses_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->Hakakses_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->Hakakses_model->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_user') == '')
		{
			$data['inputerror'][] = 'id_user';
			$data['error_string'][] = 'user is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
}