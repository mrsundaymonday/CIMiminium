<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ngchart extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Ngchart_model');
		$this->load->model('Akses_anggota');
	}