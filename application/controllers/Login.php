<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('grocery_CRUD');
		$this->load->model('pwd_model');
		$this->load->library('session');
	}
	
	public function index(){
		$this->load->view('templates/header');
		$data['err']='';
		$this->load->view('login/login',$data);
		
	}
	
	public function verify(){
	$this->form_validation->set_rules('pwd', 'Password', 'required');
if ($this->form_validation->run()==false):
	$this->index();
else:
	//check if admin pwd is set
	if ($pwd=$this->pwd_model->get_pwd()):
	//print_r($pwd);
	//compare with input
		//if ($pwd['pwd']==password_hash($_POST['pwd'], PASSWORD_DEFAULT)):
		
		if(password_verify($_POST['pwd'],$pwd['pwd'])):
			//redirect to admin menu
		$this->session->logged='admin';
		$this->home();
		//$this->load->view('templates/header');
		//$this->load->view('templates/menu_admin');
		else:
		$data['err']="Wrong Password<br>";
		$this->load->view('templates/header');
		$this->load->view('login/login',$data);
		endif;
	else:
	Echo "Admin Password Not set. Contact Sysadmin";
	endif;
	 
endif;
	}
	
	public function home(){
		
		
		if (null!==$this->session->logged AND $this->session->logged=='admin'):
		$this->load->view('templates/header');
		$this->load->view('templates/menu_admin');
		else:
		$this->load->view('templates/header');
		$this->load->view('templates/menu_guest');
		//$this->index();
		endif;
	}

	public function logout(){
		unset ($_SESSION['logged']);
		$this->session->sess_destroy();
		$this->index();
}	
}
?>
