<?php
/**
 * Redy Chasby
 */
class Destination_model extends CI_Model
{

	var $table = 'tbl_destination';

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
		$this->db->where('kode_dest',$id);
		$query = $this->db->get();

		return $query->row();
	}

	function get_kategori(){
		$hasil=$this->db->query(" SELECT * FROM tbl_destination ");
		return $hasil;
	}

	function get_subkategori($id){
		$this->db->select('*');
		$this->db->from('tbl_model');
		$this->db->where('kode_dest',$id);
		$query = $this->db->get();
		return $query->result();
	}
}