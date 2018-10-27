<?php
/**
 * Redy Chasby
 */
class Daily_defect_model extends CI_Model
{
	var $table = 'tbl_masalah_ng';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
//ini san, nma tabelnya tbl_ng dan tbl_part

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		
		$this->db->join('tbl_ng','tbl_ng.nama_ng=tbl_masalah_ng.nama_ng');
		$this->db->join('tbl_part','tbl_part.kids_part=tbl_masalah_ng.kids_part');

		$query=$this->db->get();
		return $query->result();
	}

	/*
	SELECT * FROM `tbl_part` where kids_part=''
	*/

	public function search_kodegmc($kids_part){	
		$this->db->like('kids_part',$kids_part);
		return $this->db->get('tbl_part');
	}	


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('kode_laporan',$id);
		$query = $this->db->get();

		return $query->row();
	}  

	

	public function count_all()
	{
	$this->db->from($this->table);
	$query=$this->db->get();
	return $query->num_rows();
	}


	public function defect_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function defect_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('kode_laporan', $id);
		$this->db->delete($this->table);
	}

}