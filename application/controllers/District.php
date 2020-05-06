<?php
class District extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
}

	public function mdistrict()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('district')
		     ->set_subject('District')
			 ->columns('id', 'name')
			 ->display_as('id','District Id')
			->display_as('name','District Name')
			->set_rules('name', 'District Name', 'required|is_unique[district.name]')
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
	$post_array[$k]=ucwords($v);
	endforeach;
	return $post_array;
	}


}

