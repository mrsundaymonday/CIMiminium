<?php
Class Mainmenu extends Ci_Controller
{
	function __construct() {   	
   		parent::__construct();		
		$this->load->helper(array('url','html'));		
		$this->uri->segment(4);
		$this->load->model('User_model');		
		//$this->load->model('Ngchart_model');
		$this->load->model('Daily_defect_model');
		$this->load->model('Menu_model');		
		$this->load->model('Gmc_model');		
		$this->load->model('Ng_model');			
		$this->load->model('User_model');	
		$this->load->model('Part_model');	
		$this->load->model('Hakakses_model');
		$this->load->model('Masalahng_model');	

		//$this->load->model('Ngchart_model');
		$this->isLoggedIn(FALSE);
	}
	
	Function index(){
		$data['content'] = 'admin/dashboard';
  		$this->load->view('admin/include/template',$data);	
	}

	Function masalahng(){	
		$data['query']=$this->db->get('test')->result();	
		$data['content'] = 'admin/masalahng';
  		$this->load->view('admin/include/template',$data);	
	}

	function test_save(){
        $this->_validate();
		$data=array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat')
		);
		$this->User_model->savetest($data);
        echo json_encode(array("status" => TRUE));
	}

	 private function _validate(){
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat is required';
			$data['status'] = FALSE;
		}			

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function isLoggedIn(){
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		if(!isset($isLoggedIn) || $isLoggedIn != true){
		//	echo '<scriYou don\'t have permission to access this page. <a href="../login">Login</a>';
	    echo "<script>alert('You don\'t have permission to access this page, please login');</script>";
		redirect('Login');
		}		
	}

	function controller_list(){
		$controllers = array();
	    $this->load->helper('file');

	    // Scan files in the /application/controllers directory
	    // Set the second param to TRUE or remove it if you 
	    // don't have controllers in sub directories
	    $files = get_dir_file_info(APPPATH.'controllers', FALSE);

	    // Loop through file names removing .php extension
	    foreach ( array_keys($files) as $file ) {
	        if ( $file != 'index.html' )
	            $controllers[] = str_replace('.php', '', $file);
	    }
	    print_r($controllers); 
	}

}