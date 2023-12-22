<?php
class Pmode extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
		}

	public function mpmode()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('pmode')
		     ->set_subject('Payment Mode')
			 ->columns('id', 'name', 'G80')
			 ->display_as('id','Payment Mode Id')
			->display_as('name','Payment Mode Name')
			->display_as('G80','80G Applicable?')
			->unset_delete()
			->unset_edit()
			//->set_rules('name', 'Payment Mode Name', 'required|is_unique[pmode.name]')
			->set_rules('name', 'Payment Mode Name', 'required|callback_pmode_check')
			->set_rules('G80', '80G Applicablity', 'required|callback_G80')
			
			->callback_before_insert(array($this,'toupper'))
			->callback_before_update(array($this,'toupper'));
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
	if ($k=='name'):
	$post_array[$k]=ucwords($v);
	else:
	$post_array[$k]=strtoupper($v);
	endif;
	endforeach;
	return $post_array;
	}

	public function pmode_check($str)
	{
	$id = $this->uri->segment(4);
	
	$sql=$this->db->select('*');
	$sql=$this->db->from('pmode');
	$sql=$this->db->where('name',$str);
	
	if (!empty($id) && is_numeric($id)):
		$sql=$this->db->where('id !=',$id);
	endif;
	
	$res=$this->db->get();
	if ($res and $res->num_rows()>0):
		$this->form_validation->set_message('pmode_check','There is already an entry for same Payment Mode');
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

