<?php
class Country extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
		$this->load->model('Country_model');
		$this->load->model('Mlist_model');

}

	public function mcountry()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('country')
		     ->set_subject('Country')
			 ->columns('id', 'name')
			 ->display_as('id','Country Id')
 			 ->display_as('name','Country Name')
			 ->set_rules('name', 'Country Name', 'required|callback_isunique')
			 ->callback_before_insert(array($this,'toupper'))
			 ->callback_before_update(array($this,'toupper'))
			 ->set_lang_string('delete_error_message','This data cannot be deleted, it is used in Maillist')
             ->callback_before_delete(array($this,'delete_check'));
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
	$post_array[$k]=strtoupper($v);
	endforeach;
	return $post_array;
	}

	public function delete_check($primary_key)
	{
	//return false;
	$country = $this->Country_model->get_details($primary_key);
	if ($this->Mlist_model->used_or_not_c($country)):	
		//echo $city;
		return false;
	else:
		//echo $city;
		return true;
	endif;
	
	
	}

	public function isunique($str){
		
	$id = $this->uri->segment(4);
	
	$sql=$this->db->select('*');
	$sql=$this->db->from('country');
	$sql=$this->db->where('name',$str);
	
	if (!empty($id) && is_numeric($id)):
		$sql=$this->db->where('id !=',$id);
	endif;
	
	$res=$this->db->get();
	if ($res and $res->num_rows()>0):
		$this->form_validation->set_message('isunique','There is already an entry for same Name');
		return false;
    else:
		return true;
	endif;

		
		}


}

