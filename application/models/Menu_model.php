<?php
class Menu_model extends CI_Model{

	var $tablemenu = 'tbl_menu';
	var $tbl_menuakses = 'tbl_menuakses';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_akses()
	{	
		$this->db->join($this->tablemenu,'tbl_menu.kode_menu=tbl_menuakses.kode_menu');
		$this->db->where('tbl_menuakses.id_user',$this->session->userdata('id_user'));
		return $this->db->get($this->tbl_menuakses)->result();
	}
	public function get_all()
	{	
		return $this->db->get($this->tablemenu)->result();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->tbl_menuakses);
		$this->db->where('kode_menu',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert($this->tbl_menuakses, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->tbl_menuakses, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_menuakses);
	}
}