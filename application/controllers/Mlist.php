<?php
class Mlist extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		//$this->output->enable_profiler(TRUE);
		$this->load->library('session');
		$this->load->model('mlist_model');
		$this->load->model('city_model');
		$this->load->model('state_model');
		$this->load->model('district_model');
		$this->load->model('country_model');
		$this->load->helper('pdf_helper');
}

	public function list_admin()
	{
		
		$crud = new grocery_CRUD();
		$crud->set_table('mlist')
		     ->set_subject('Recepient')
			 ->columns('id', 'name', 'add1', 'add2', 'city')
			 ->display_as('id','Id')
 			 ->display_as('name','Name')
			 ->display_as('add1', 'Address1')
			 ->display_as('add2', 'Address2')
			 ->display_as('city', 'City')
			 ->unset_clone()
			 ->field_type('city','dropdown', $this->city_model->list_all())
			 ->field_type('state','dropdown', $this->state_model->list_all())
			 ->field_type('dist','dropdown', $this->district_model->list_all())
			 ->field_type('country','dropdown', $this->country_model->list_all())
			 ->field_type('deleted','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('send','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('initiated','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('japayajna','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('lang','dropdown', array('K'=>'Kannada', 'E'=>'English'))
			 //->add_action('receipt',base_url('application/rupee1.png'),'receipts/radd')
			 //->add_action('receipt',base_url('../web_images/rupee1.png'),'receipts/radd')
			 ->add_action('receipt',base_url(IMGPATH.'rupee1.png'),'receipts/radd')
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
	$post_array[$k]=strtoupper($v);
	endforeach;
	return $post_array;
	}
	
	public function check_length()
	{
	$list=$this->mlist_model->list_all();
	//echo "<pre>";
	//print_r($list);
	//echo "</pre>";
	foreach ($list as $k=>$v):
		$lenname=strlen($v['name']);
		if ($lenname>30):
			$chkname[$v['id']]=$lenname;
		endif;
		
		$lenadd1=strlen($v['add1']);
		if ($lenadd1>35):
			$chkadd1[$v['id']]=$lenadd1;
		endif;
		
		$lenadd2=strlen($v['add2']);
		if ($lenadd2>35):
			$chkadd2[$v['id']]=$lenadd2;
		endif;
		
		$lenadd3=strlen($v['add3']);
		if ($lenadd3>35):
			$chkadd3[$v['id']]=$lenadd3;
		endif;
		
		$lenadd4=strlen($v['add4']);
		if ($lenadd4>35):
			$chkadd4[$v['id']]=$lenadd4;
		endif;
		
		$lencity=strlen($v['city']);
		if ($lencity>25):
			$chkcity[$v['id']]=$lencity;
		endif;
		
		$lenphone1=strlen($v['phone1']);
		if ($lenphone1>30):
			$chkphone1[$v['id']]=$lenphone1;
		endif;
		
		$lenphone2=strlen($v['phone2']);
		if ($lenphone2>30):
			$chkphone2[$v['id']]=$lenphone2;
		endif;
				
		
		
	//echo strlen($v['add1'])."<br>";
	endforeach;
	echo "<pre>";
	echo "name";
	print_r($chkname);
	echo "add1";
	print_r($chkadd1);
	echo "add2";
	print_r($chkadd2);
	echo "add3";
	print_r($chkadd3);
	echo "add4";
	print_r($chkadd4);
	echo "city";
	print_r($chkcity);
	echo "phone1";
	print_r($chkphone1);
	echo "phone2";
	print_r($chkphone2);
	echo "<br><a href=".site_url('login/home').">Go Home</a>";
	/*
	echo "phone2";
	print_r($chkphone2);
	echo "ref";
	print_r($chkref);
	echo "</pre>";
	*/
}
	//not necessary, the option is removed
	public function list_guest()
	{
	$crud = new grocery_CRUD();
		$crud->set_table('mlist')
			 ->columns('id', 'name', 'add1', 'add2', 'city')
			 ->display_as('id','Id')
 			 ->display_as('name','Name')
			 ->display_as('add1', 'Address1')
			 ->display_as('add2', 'Address2')
			 ->display_as('city', 'City')
			 ->unset_edit()
			 ->unset_delete()
			 ->unset_add();
			 $output = $crud->render();
			$this->_example_output($output);                
		
	
	}
	
		public function labels_blore()
		{
		$data['addresses']=$this->mlist_model->getblore();
		$data['place']='Bangalore';
		$this->load->view('mlist/lables',$data);
		$this->load->view('templates/header');
		$this->output->append_output("Labels printed at ".SAVEPATH."<a href=".site_url('login/home').">Go Home</a href>");
		
		
		}
		
		
		
		public function labels_bgm()
		{
		$data['addresses']=$this->mlist_model->getbgm();
		$data['place']='Belgaum';
		$this->load->view('mlist/lables',$data);
		$this->load->view('templates/header');
		$this->output->append_output("Labels printed at ".SAVEPATH."<a href=".site_url('login/home').">Go Home</a href>");

		}
		
		public function labels_bgm_dist()
		{
		$data['addresses']=$this->mlist_model->getbgm_dist();
		$data['place']='Belgaum_Dist';
		$this->load->view('mlist/lables',$data);
		$this->load->view('templates/header');
		$this->output->append_output("Labels printed at ".SAVEPATH."<a href=".site_url('login/home').">Go Home</a href>");

		}
		
		public function labels_kar()
		{
		$data['addresses']=$this->mlist_model->getkar();
		$data['place']='Karnataka';
		$this->load->view('mlist/lables',$data);
		$this->load->view('templates/header');
		$this->output->append_output("Labels printed at ".SAVEPATH."<a href=".site_url('login/home').">Go Home</a href>");

		}	
		
		
		public function labels_ind()
		{
		$data['addresses']=$this->mlist_model->getindia();
		$data['place']='India';
		$this->load->view('mlist/lables',$data);
		$this->load->view('templates/header');
		$this->output->append_output("Labels printed at ".SAVEPATH."<a href=".site_url('login/home').">Go Home</a href>");	
			
		}	
	


}
?>
