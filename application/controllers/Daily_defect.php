<?php
/**
 * Redy Chasby
 */
class Daily_defect extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('path');
		$this->load->helper(array('url','form'));
		$this->load->model('Ng_model');
		//$this->load->model('Warna_model');
		$this->load->model('Gmc_Model');
		//$this->load->model('Position_model');
		//$this->load->model('Line_model');
		//$this->load->model('Unit_model');
		//$this->load->model('Position_model');
		$this->load->model('Daily_defect_model');
		$this->load->model('Akses_anggota');
		date_default_timezone_set("Asia/Bangkok");
	}

	function search_modelpart(){
		//ini mas untuk proses searching column model kodegmc
		//nanti nilainya muncul ketika di ketik langsung muncul kayak autocomplete begitu dipilih data modelnya(kode_gmc ditampilkan di id textfield)
		//dalam bentuk json nilainya.. XD
		//proses menampilkannya kerjaan si view viewnya opo yo?
		//$query = $this->input->get('query');
		$keyword = $this->uri->segment(3);
		$data = $this->Daily_defect_model->search_kodegmc($keyword)->result();

		//$query = $this->input->get('query');
       // $this->db->like('kids_part', $query);
        //$data = $this->db->get("tbl_part")->result();

        foreach ($data as  $value) {
        	$arr['query'] = $keyword;
	      	$arr['part'][] = array(
	      			'kids_part'=>$value->kids_part,
	      			'kode_gmc'=>$value->kode_gmc
	      		);
        }

		echo json_encode($arr);
	}

	public function defect_add()
	{
		$defectnumber = $this->db->order_by('created_date',"desc")->limit(1)->get('tbl_masalah_ng')->row();
		if (empty($defectnumber)) {
			$data = array(
				'kode_laporan' =>'001'.'/'.date('m').'/'.date('Y'),
				//'kids_part' =>$this->input->post('kids_part'),
				'kids_part' =>'xx',
				'nama_ng' =>$this->input->post('nama_ng'),
				'posisi_ng' =>$this->input->post('posisi_ng'),
				'qty_ng' =>$this->input->post('qty_ng'),
				'area_detec' =>$this->input->post('area_detec'),
				'root_cause' =>$this->input->post('root_cause'),
				'detail_problem' =>$this->input->post('detail_problem'),
				'created_by' =>$this->session->userdata('nama_employee'),
				'created_date' =>date('Y-m-d H:i:s'),
				'status' =>'0'
			);
			$insert = $this->Daily_defect_model->defect_add($data);
			$this->session->set_flashdata('succes');
		}
		else
		{
			$defectnumber = explode('/', $defectnumber->kode_laporan);
			$data = array(
					'kode_laporan' =>sprintf("%'.03d",$defectnumber[0]+1).'/'.date("m").'/'.date('Y'),
					'kids_part' =>$this->input->post('kids_part'),
					'nama_ng' =>$this->input->post('nama_ng'),
					'posisi_ng' =>$this->input->post('posisi_ng'),
					'qty_ng' =>$this->input->post('qty_ng'),
					'area_detec' =>$this->input->post('area_detec'),
					'root_cause' =>$this->input->post('root_cause'),
					'detail_problem' =>$this->input->post('detail_problem'),
					'created_by' =>$this->session->userdata('nama_employee'),
					'created_date' =>date('Y-m-d H:i:s'),
					'status' =>'0'
					
				);
				$insert = $this->Daily_defect_model->defect_add($data);
				$this->session->set_flashdata('succes');

			}
			//$last = $this->db->order_by('create_date',"desc")->limit(1)->get('tbl_daily_d')->row();	
			echo json_encode(array("status" => TRUE));

		}

		public function defect_delete($id)
		{
			$this->Daily_defect_model->delete_by_id($id);
			print_r($this->db->last_query());
			exit();
			$this->session->set_flashdata('success', 'Data berhasil dihapus');	
			echo json_encode(array("status" => TRUE));
		}


		public function defect_update()
		{
			$date = array(
				'kode_laporan' =>$this->input->post('kode_laporan'),
				'kids_part' =>$this->input->post('kids_part'),
				'nama_ng' =>$this->input->post('nama_ng'),
				'posisi_ng' =>$this->input->post('posisi_ng'),
				'qty_ng' =>$this->input->post('qty_ng'),
				'area_detec' =>$this->input->post('area_detec'),
				'root_cause' =>$this->input->post('root_cause'),
				'detail_problem' =>$this->input->post('detail_problem')
			);
			$this->Daily_defect_model->defect_update(array('kode_laporan'=>$this->input->post('kode_laporan')),$data);
		}


	}