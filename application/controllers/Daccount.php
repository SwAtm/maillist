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
			 ->columns('id', 'name')
			 ->display_as('id','Donation Account Id')
			->display_as('name','Donation Account Name')
			->set_rules('name', 'Donation Account Name', 'required|is_unique[daccount.name]')
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

}

