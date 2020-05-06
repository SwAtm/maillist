<?php
class Country extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
}

	public function mcountry()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('country')
		     ->set_subject('Country')
			 ->columns('id', 'name')
			 ->display_as('id','Country Id')
 			 ->display_as('name','Country Name')
			 ->set_rules('name', 'Country Name', 'required|is_unique[country.name]')
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

