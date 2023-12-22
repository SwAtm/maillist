<?php
class Daccount extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
}

	public function mdaccount()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('daccount')
		     ->set_subject('Donation Account')
			 ->columns('id', 'name', 'G80')
			 ->display_as('id','Donation Account Id')
			->display_as('name','Donation Account Name')
			->display_as('G80','80G Applicable?')
			->set_rules('name', 'Donation Account Name', 'required|callback_isunique')
			->set_rules('G80', '80G Applicablity', 'required|callback_G80')
			->callback_before_insert(array($this,'toupper'))
			->callback_before_update(array($this,'toupper'))
			->callback_column('name', array($this, '_callback_width' ));
			$output = $crud->render();
			$this->_example_output($output);                
	}



	function _example_output($output = null)
	{
		$this->load->view('templates/header');
		$this->load->view('our_template.php',$output);    
		$this->load->view('templates/footer');
	}    
	
	public function toupper($post_array)
	{
	foreach ($post_array as $k=>$v):
	$post_array[$k]=ucwords($v);
	endforeach;
	return $post_array;
	}

	public function _callback_width($value, $row){

		return $value = wordwrap($row->name,50,"/n", true);
	}

	public function isunique($str){
		
	$id = $this->uri->segment(4);
	
	$sql=$this->db->select('*');
	$sql=$this->db->from('daccount');
	$sql=$this->db->where('name',$str);
	
	if (!empty($id) && is_numeric($id)):
		$sql=$this->db->where('id !=',$id);
	endif;
	
	$res=$this->db->get();
	if ($res and $res->num_rows()>0):
		$this->form_validation->set_message('isunique','There is already an entry for same Account Name');
		return false;
    else:
		return true;
	endif;

		
		}
	public function G80($value){
	if (strtoupper($value)=='Y' or strtoupper($value)=='N'):
	return true;
	else:
	$this->form_validation->set_message('G80','Only Y or N Accepted');
	return false;
	endif;
	}

}

