<?php
class City extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
		$this->load->model('City_model');
		$this->load->model('Mlist_model');

}

	public function mcity()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('city')
		     ->set_subject('City')
			 ->columns('id', 'name')
			 ->display_as('id','City Id')
			 ->display_as('name','City Name')
			 ->set_rules('name', 'City Name', 'required|is_unique[city.name]')
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
	$post_array[$k]=ucwords($v);
	endforeach;
	return $post_array;
	}


	public function delete_check($primary_key)
	{
	//return false;
	$city = $this->City_model->get_details($primary_key);
	if ($this->Mlist_model->used_or_not($city)):	
		//echo $city;
		return false;
	else:
		//echo $city;
		return true;
	endif;
	
	
	}

}

