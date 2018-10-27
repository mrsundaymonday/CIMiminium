<?php
Class Login extends Ci_Controller
{
	Function __construct()
	{
		Parent::__construct();
		$this->load->helper(array('url','form'));
        $this->load->library('session');     
        $this->load->model('User_model');      
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	

    function index($msg = NULL)
    {         
        $data['msg'] = $msg;    
        $this->load->view('view_login',$data);
    }
    
	function verify_login() {    
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
         if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('error','username atau password anda salah, silahkan hubungi administrator');
                $this->load->view('view_login');
                }
                else{
                     $result = $this->User_model->getuser($this->input->post('username'),$this->input->post('password'));
                    if($result){                       
                        foreach ($result as $value){                   
                                        $data=array(
                                            'username' => $value->username,
                                            'id_user' => $value->id_user,
                                            'level' => $value->level,
                                            'isLoggedIn'=>TRUE
                                        );
                                    } 
                                $this->session->set_userdata($data); 
                                redirect('Mainmenu');  
                            }else { 
                                $this->session->set_flashdata('error','username atau password anda salah, silahkan hubungi administrator');
                                $this->load->view('view_login');
                            }
                    }
	}

	function Mainmenu(){
		$this->isLoggedIn(FALSE);
		$this->load->view('view_mainmenu');  
		
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}

function isLoggedIn()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		if(!isset($isLoggedIn) || $isLoggedIn != true)
		{
		//	echo '<scriYou don\'t have permission to access this page. <a href="../login">Login</a>';
	    echo "<script>alert('You don\'t have permission to access this page, please login');</script>";
		redirect('Login');
		}		
	}



	
}
?>