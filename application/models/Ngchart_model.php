<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Redy Chasby
 */
class Ngchart_model extends CI_Model
{
    
    var $table = 'tbl_ng';


    public function __construct()

    {
        parent::__construct();
        $this->load->database();
    }


   public function get_all()
    {
        $this->db->from($this->table);
        $query=$this->db->get();
        return $query->result();
    }


    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('kode_ng',$id);
        $query = $this->db->get();

        return $query->row();
    }
