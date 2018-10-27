<?php
/**
 * Redy Chasby
 */
class Line_model extends CI_Model
{
	var $table = 'tbl_line';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all()
	{
		$query=$this->db->get($this->table);
		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('kode_line',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function line_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function line_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('kode_line', $id);
		$this->db->delete($this->table);
	}


	function get_kategori(){
		$hasil=$this->db->query(" SELECT * FROM tbl_line ");
		return $hasil;
	}

	function get_subkategori($id){
		$this->db->select('*');
		$this->db->from('tbl_model');
		$this->db->where('kode_line',$id);
		$query = $this->db->get();
		return $query->result();
	}
}