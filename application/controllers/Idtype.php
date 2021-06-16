<?php
class Idtype extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
		}

	public function midtype()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('id_type')
		     ->set_subject('ID Type')
			 ->columns('name', 'code')
			 ->display_as('name','Unique Identification Type')
			->display_as('code','ID Code')
			->unset_delete()
			->unset_edit()
			//->set_rules('name', 'Payment Mode Name', 'required|is_unique[pmode.name]')
			->set_rules('name', 'Unique Identification Type', 'required|callback_idtype_check')
			->set_rules('code', 'Id Code', 'required|callback_idcode_check')
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
	$post_array[$k]=strtoupper($v);
	endif;
	endforeach;
	return $post_array;
	}

	public function idtype_check($str)
	{
	$id = $this->uri->segment(4);
	
	$sql=$this->db->select('*');
	$sql=$this->db->from('id_type');
	$sql=$this->db->where('name',$str);
	
	if (!empty($id) && is_numeric($id)):
		$sql=$this->db->where('id !=',$id);
	endif;
	
	$res=$this->db->get();
	if ($res and $res->num_rows()>0):
		$this->form_validation->set_message('idtype_check','There is already an entry for same ID Type');
		return false;
    else:
		return true;
	endif;
}
	
	
	public function idcode_check($str)
	{
	$id = $this->uri->segment(4);
	
	$sql=$this->db->select('*');
	$sql=$this->db->from('id_type');
	$sql=$this->db->where('code',$str);
	
	if (!empty($id) && is_numeric($id)):
		$sql=$this->db->where('id !=',$id);
	endif;
	
	$res=$this->db->get();
	if ($res and $res->num_rows()>0):
		$this->form_validation->set_message('idcode_check','There is already an entry for same ID Code');
		return false;
    else:
		return true;
	endif;
}
  

	
	
	
	
}

