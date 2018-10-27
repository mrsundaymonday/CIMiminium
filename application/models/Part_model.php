<?php
/**
 * Redy Chasby
 */
class Part_model extends CI_Model
{
	var $table = 'tbl_part';

	function get_part($data){
		$this->db->like('item_part',$data);
		return $this->db->get($this->table)->result();

	}
	public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 

}