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
			 ->columns('id', 'name')
			 ->display_as('id','Payment Mode Id')
			->display_as('name','Payment Mode Name')
			->set_rules('name', 'Payment Mode Name', 'required|is_unique[pmode.name]')
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

