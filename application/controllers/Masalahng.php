<?php
/**
 * Redy Chasby
 */
class Masalahng extends CI_Controller
{
	
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('datatables');
		$this->load->model('Masalahng_model');
	}

	public function ajax_list()
    {
        $this->load->helper('url');
 
        $list = $this->Masalahng_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$value->kode_laporan.'">';
            $row[] = $value->kode_laporan;
            $row[] = $value->item_part;
            $row[] = $value->nama_ng;
            $row[] = $value->posisi_ng;
            $row[] = $value->qty_ng;
            $row[] = $value->area_detec;
            $row[] = $value->root_cause;
            $row[] = $value->detail_problem;
            $row[] = $value->status;
            $row[] = $value->created_date;
            $row[] = $value->created_by;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="return edit_value('."'".$value->kode_laporan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_value('."'".$value->kode_laporan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Masalahng_model->count_all(),
                        "recordsFiltered" => $this->Masalahng_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->Masalahng_model->get_by_id($id);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $ng="NG";
        $lastcode = $this->db->order_by('created_date',"desc")->limit(1)->get('tbl_masalah_ng')->row();
        if(empty($lastcode)){
           
            $slipnumber=$ng.date("d").date("m").date("y").'001';
            $data = array(
                'kode_laporan' => $slipnumber,
                'item_part' => $this->input->post('item_part'),
                'nama_ng' => $this->input->post('nama_ng'),
                'posisi_ng' => $this->input->post('posisi_ng'),
                'qty_ng' => $this->input->post('qty_ng'),
                'area_detec' => $this->input->post('area_detec'),
                'root_cause' => $this->input->post('root_cause'),
                'detail_problem' => $this->input->post('detail_problem'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username')
            ); 
                $insert = $this->Masalahng_model->save($data); 
                echo json_encode(array("status" => TRUE));

           }else{
            $kode_laporan = substr($lastcode->kode_laporan,-3);
            $kode_laporan=$kode_laporan+1;
            $kode_laporan=sprintf('%03d',$kode_laporan);
            $slipnumber=$ng.date("d").date("m").date("y").$kode_laporan;
            $data = array(
                'kode_laporan' => $slipnumber,
                'item_part' => $this->input->post('item_part'),
                'nama_ng' => $this->input->post('nama_ng'),
                'posisi_ng' => $this->input->post('posisi_ng'),
                'qty_ng' => $this->input->post('qty_ng'),
                'area_detec' => $this->input->post('area_detec'),
                'root_cause' => $this->input->post('root_cause'),
                'detail_problem' => $this->input->post('detail_problem'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username')
            );
 
        $insert = $this->Masalahng_model->save($data); 
        echo json_encode(array("status" => TRUE));
        }       
    }
 
    public function ajax_update()
    {
        $this->_validate();
 
        $data = array(
                'item_part' => $this->input->post('item_part'),
                'nama_ng' => $this->input->post('nama_ng'),
                'posisi_ng' => $this->input->post('posisi_ng'),
                'qty_ng' => $this->input->post('qty_ng'),
                'area_detec' => $this->input->post('area_detec'),
                'root_cause' => $this->input->post('root_cause'),
                'detail_problem' => $this->input->post('detail_problem'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username')
            );
         $this->Masalahng_model->update(array('kode_laporan' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->Masalahng_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->Masalahng_model->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;	
     
        if($this->input->post('item_part') == '')
        {
            $data['inputerror'][] = 'item_part';
            $data['error_string'][] = 'Item Part is required';
            $data['status'] = FALSE;
        }   
           if($this->input->post('nama_ng') == '')
        {
            $data['inputerror'][] = 'nama_ng';
            $data['error_string'][] = 'Nama NG is required';
            $data['status'] = FALSE;
        }   
        
        if($this->input->post('posisi_ng') == '')
        {
            $data['inputerror'][] = 'posisi_ng';
            $data['error_string'][] = 'Posisi NG is required';
            $data['status'] = FALSE;
        }   
        
        if($this->input->post('qty_ng') == '')
        {
            $data['inputerror'][] = 'qty_ng';
            $data['error_string'][] = 'Qty NG is required';
            $data['status'] = FALSE;
        }   
        
        if($this->input->post('area_detec') == '')
        {
            $data['inputerror'][] = 'area_detec';
            $data['error_string'][] = 'Area detec is required';
            $data['status'] = FALSE;
        }   
        
        if($this->input->post('root_cause') == '')
        {
            $data['inputerror'][] = 'root_cause';
            $data['error_string'][] = 'Root cause is required';
            $data['status'] = FALSE;
        } 

        if($this->input->post('detail_problem') == '')
        {
            $data['inputerror'][] = 'detail_problem';
            $data['error_string'][] = 'Detail problem is required';
            $data['status'] = FALSE;
        }   

        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        } 
        

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
}