<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

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
		//$this->output->enable_profiler(TRUE);
	}
	
	public function index(){
		$this->load->view('templates/header');
		$data['err']='';
		$this->load->view('login/login',$data);
		
	}
	
	public function verify(){
	$this->form_validation->set_rules('user', 'User Name', 'required');
	$this->form_validation->set_rules('pwd', 'Password', 'required');
	if ($this->form_validation->run()==false):
		$this->index();
	elseif ($pwd=$this->pwd_model->get_pwd($_POST['user'])):
		if(password_verify($_POST['pwd'],$pwd['pwd'])):
		$this->session->logged=$_POST['user'];
		$this->home();
		else:
		$data['err']="Wrong Password<br>";
		$this->load->view('templates/header');
		$this->load->view('login/login',$data);
		endif;
	else:
	$data['err']="Wrong User<br>";
	$this->load->view('templates/header');
	$this->load->view('login/login',$data);
	endif;
	 
	}
	
	public function home(){
		
		
		if (null!==$this->session->logged AND $this->session->logged=='admin'):
		$this->load->view('templates/header');
		$this->load->view('templates/menu_admin');
		elseif (null!==$this->session->logged AND $this->session->logged=='user1'):
		$this->load->view('templates/header');
		$this->load->view('templates/menu_guest');
		else:
		$this->index();
		endif;
	}

	public function logout(){
		unset ($_SESSION['logged']);
		$this->session->sess_destroy();
		$this->index();
}	
}
?>
