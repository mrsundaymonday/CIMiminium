<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 class Login_model extends CI_Model 
 {
  function __construct()
  {
    parent :: __construct();
  }

  public function getuser($uname,$pass)
  {
    $this->db->SELECT('*');
    $this->db->from('tbl_employee_departement');
    $this->db->join('tbl_departement','tbl_departement.kode_dept=tbl_employee_departement.kode_dept');
    $this->db->where('email_employee',$uname);
    $this->db->where('password',md5($pass));
    return $this->db->get()->result();

 /*   return $this->db->query("select *
      from tbl_employee_departement where email_employee = '$uname' and password = MD5('$pass')  ")->result();

    return $this->db->get('tbl_employee_departement')->result();*/

  }

  public function validate() 
  {
    //ambil data dari login

    //$username = $this->security->xss_clean($this->input->post('username'));
    //$password = $this->security->xss_clean($this->input->post('password'));

    $username = $this->input->post('username');
    $password = $this->input->post('password');

        //cek coba namanya
  //       var_dump($username);
    // echo "<br/>";
  //       var_dump($password); 
    // echo "<br/>";   
  //      echo "User Name = " .$username."</br>";
  //       echo "Password= " .$password ."</br>";

        //print_r($username);

     //   exit(); 

        // Prep the query
     
       // $this->db->where('no_anggota', $username);
      //  $this->db->where('barcode', $password);

      // Run the query
        //$query = $this->db->get('tbl_info_anggota');

        $query=$this->db->query(" SELECT DISTINCT no_anggota,barcode,Nama FROM tbl_info_anggota WHERE no_anggota = '" .$username. "' AND barcode = '".$password."'");

       // echo "User Name = " .$username."</br>";
        //echo "Password= " .$password ."</br>";
        if ($query->num_rows() == 1 )
        {
          //echo "Ada Datanya ";  
          return true;
        }
        else
        {
           //echo "Tidak Ada Datanya ";   
          return false;
        } 

        //exit();

  }

 }



?>