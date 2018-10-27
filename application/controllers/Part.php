<?php
/**
 * Redy Chasby
 */
class Part extends CI_Controller
{
	
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('datatables');
		$this->load->model('Part_model');
	}

    function get_partdata(){
         if (isset($_GET['term'])) {
            $result = $this->Part_model->get_part($_GET['term']);
          /*  print_r($this->db->last_query());
            exit();*/
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'item_part'=>$row->item_part,
                    'nama_part'=>$row->nama_part,
                    'kode_gmc' => $row->kode_gmc
                );            
                echo json_encode($arr_result);
            }
        }
    }


	
}