<?php
/**
 * Redy Chasby
 */
class Unit_model extends CI_Model
{
	
	var $table = 'tbl_unit';


	public function __construct()

	{
		parent::__construct();
		$this->load->database();
	}


	public function get_all()
	{
	$this->db->select('*');
	$this->db->from($this->table);
	$this->db->join('tbl_line','tbl_line.kode_line=tbl_unit.kode_line');
	$query=$this->db->get();
	return $query->result();
	}



	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('kode_unit',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function unit_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function unit_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('kode_unit', $id);
		$this->db->delete($this->table);
	}

}