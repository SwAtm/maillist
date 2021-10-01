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
		$this->load->model('Mlist_model');
		$this->load->model('id_type_model');
		//$this->load->library('form_validation');	
}

	public function list_admin()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('mlist')
		     ->set_subject('Recepient')
			 ->columns('id', 'name', 'add1', 'add2', 'city', 'phone1')
			 ->display_as('id','Id')
 			 ->display_as('name','Name')
			 ->display_as('add1', 'Address1')
			 ->display_as('add2', 'Address2')
			 ->display_as('city', 'City')
			 ->display_as('phone1', 'Phone')
			 ->unset_clone()
			 ->unset_delete()
			 ->unset_add()
			 ->required_fields('name','city','dist','state','country','id_name')
			 ->field_type('city','dropdown', $this->city_model->list_all())
			 ->field_type('state','dropdown', $this->state_model->list_all())
			 ->field_type('dist','dropdown', $this->district_model->list_all())
			 ->field_type('country','dropdown', $this->country_model->list_all())
			 ->field_type('id_name','dropdown', $this->id_type_model->list_all())
			 ->field_type('id_code', 'invisible')		
			 ->field_type('deleted','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('send','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('initiated','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('japayajna','dropdown', array('Y'=>'Yes', 'N'=>'No'))
			 ->field_type('lang','dropdown', array('K'=>'Kannada', 'E'=>'English'))
			 ->callback_column('name',array($this,'_callback_change_color'))
			 ->add_action('receipt',base_url(IMGPATH.'rupee1.png'),'receipts/radd')
			 ->callback_before_insert(array($this,'toupper'))
			 ->callback_before_update(array($this,'toupper'));
			 //if id name is 'not available', id number should not be required, else it should be required.
			 /*
			 $id_no_req = $this->input->post('id_name')=='NOT AVAILABLE'?'':'|required';
			 $crud->set_rules('id_name', 'ID Name', 'trim');
			 $crud->set_rules('id_no', 'ID Number', 'trim'.$id_no_req);
			 */
			 $crud->set_rules('id_no', 'ID Number', 'trim|callback_idreq');
			 $crud->set_rules('city', 'City', 'callback_checkcity', array('checkcity'=>'Country is India and given City is name of  a country'));
			 $crud->set_rules('dist', 'District', 'callback_checkdistrict', array('checkdistrict'=>'Country is India and given District is name of a country'));
			 $crud->set_rules('state', 'State', 'callback_checkstate', array('checkstate'=>'Country is India and given State  is name of a country'));
			
			
			// Get state
	       $state = $crud->getState(); 


           // Call render function
               $output = $crud->render();

			
               if($state == 'add')
	       {
		$js='<script>$(\'select[name="country"] option[value="INDIA"]\').attr("selected", "selected");</script>';
		$js.='<script>$(\'select[name="id_name"] option[value="PAN"]\').attr("selected", "selected");</script>';
		$output->output .= $js;	
	       }
		$output->extra="<table width = 100% bgcolor=pink><tr><td align = center><a href = ".site_url('mlist/mlistadd').">Add Recepient</a href></td></tr></table>";			
			
			//$output = $crud->render();
			$this->_example_output_extra($output);                
			
			
	}



	function _example_output($output = null)
	{
		$this->load->view('templates/header');
		$this->load->view('our_template.php',$output);    
		$this->load->view('templates/footer');
	}    
	
	function _example_output_extra($output = null)
	{
		$this->load->view('templates/header');
		$this->load->view('our_template_extra.php',$output);    
		$this->load->view('templates/footer');
	}    
	
	public function toupper($post_array)
	{
	foreach ($post_array as $k=>$v):
	$post_array[$k]=strtoupper($post_array[$k]);
	$post_array[$k]=str_replace(",", '', $post_array[$k]);
	endforeach;
	$post_array['id_code']=$this->id_type_model->get_code_from_name($post_array['id_name']);
	return $post_array;
	}
	
	public function _callback_change_color($value, $row)
	{
	$det=$this->Mlist_model->get_details($row->id);
	if ("Y"==$det['deleted']):
	return '<span style="color:red">'.$value.'</span>';
	else:
	return $value;
	endif;
	}
	
	public function idreq($str){
	if ($this->input->post('id_name') == 'NOT AVAILABLE'):
		if ($str!=''):
			$this->form_validation->set_message('idreq', 'ID number not allowed for NOT AVAILABLE id name');
			return false;
		else:
			return true;
		endif;
	elseif ($str==''):
		$this->form_validation->set_message('idreq', 'ID Number cannot be blank');
		return false;
	else:
		return true;
	endif;
	
	}
	
	
	public function checkcity($str){
	
	if ($this->input->post('country')=='INDIA'):
		if ($this->country_model->findname($str)):
		return false;
		else:
		return true;
		endif;
	else:
		return true;
	endif;	
}

	public function checkdistrict($str){
	
	if ($this->input->post('country')=='INDIA'):
		if ($this->country_model->findname($str)):
		return false;
		else:
		return true;
		endif;
	else:
		return true;
	endif;	

}
	
	public function checkstate($str){
	
	if ($this->input->post('country')=='INDIA'):
		if ($this->country_model->findname($str)):
		return false;
		else:
		return true;
		endif;
	else:
		return true;
	endif;	
	
	
	
	
	
	
	}
	public function check_length()
	{
	$list=$this->mlist_model->list_all();
	$chkname = array();
	$chkadd1 = array();
	$chkadd2 = array();
	$chkadd3 = array();
	$chkadd4 = array();
	$chkcity = array();
	$chkphone1 = array();
	$chkphone2 = array();
	
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
	endforeach;
	
	$check=array('name'=>$chkname, 'add1'=>$chkadd1, 'add2'=>$chkadd2, 'add3'=>$chkadd3,'add4'=>$chkadd4, 'city'=>$chkcity, 'phone1'=>$chkphone1, 'phone2'=>$chkphone2);
	foreach ($check as $k=>$v):
		echo "<pre>";
		if (count($v)>0):
			print_r($k);
			echo "<br>";
			print_r($v);
		else:
			echo "All ".$k." within range<br>";
		endif;
	endforeach;
	echo "<br><a href=".site_url('login/home').">Go Home</a>";
	
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
	
		public function labels_kar_wo_blore_bgm()
		{
		$data['addresses']=$this->mlist_model->getkar_wo_blore_bgm();
		$data['place']='Karnataka without Blore and Belgaum';
		$this->load->view('mlist/lables',$data);
		$this->load->view('templates/header');
		$this->output->append_output("Labels printed at ".SAVEPATH."<a href=".site_url('login/home').">Go Home</a href>");	
			
		}	

		public function labels_ind_wo_karnataka()
		{
		$data['addresses']=$this->mlist_model->getind_wo_karnataka();
		$data['place']='India without Karnataka';
		$this->load->view('mlist/lables',$data);
		$this->load->view('templates/header');
		$this->output->append_output("Labels printed at ".SAVEPATH."<a href=".site_url('login/home').">Go Home</a href>");	
			
		}	

		public function mlistadd() {
		
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('city', 'City Name', 'required');
		$this->form_validation->set_rules('dist', 'District Name', 'required');
		$this->form_validation->set_rules('state', 'State Name', 'required');
		$this->form_validation->set_rules('country', 'Country Name', 'required');
		$this->form_validation->set_rules('id_no', 'ID No', 'callback_idcheck');
		$data['idtype']= $this->id_type_model->list_all();
		unset($data['idtype']['PAN']);
		$data['idtype'] = array(''=>'Please Selct Other Id Type')+$data['idtype'];
		//$data['city'] = $this->city_model->list_all();
		$data['yesno'] = array('Y'=>'Yes', 'N'=>'No');
		$data['city_india'] = $this->city_model->get_name_indian();
		$data['city_non_india'] = $this->city_model->get_name_non_indian();
		//new
		if ($this->form_validation->run()==false):
		$this->load->view('templates/header');
		$this->load->view('mlist/mlistadd', $data);
		$this->load->view('templates/footer');
		else:
		//all ok, prep
		//all cap
		$data=$_POST;
		foreach ($data as $k=>$v):
			/*if (''==$v):
			continue;
			endif;
			if ('pin'==$k OR 'id_code' == $k):
			continue;
			endif;*/
		$data[$k] = strtoupper($v);
		endforeach;
		//id name, no, code
		if (''!=trim($data['panno'])):
		$data['id_code'] = 1;
		$data['id_name'] = 'PAN';
		$data['id_no'] = $data['panno'];
		else:
		//$data['id_name'] = $_POST['id_name'];
		//$data['id_no'] = $_POST['id_no'];
		$data['id_code'] = $this->id_type_model->get_code_from_name($data['id_name']);
		endif;
		//if city, district, state, country are new, add to resp tables
		
		if (!$this->city_model->findname($data['city'])):
		$city['name'] = $data['city'];
		$this->city_model->add($city);
		endif;	
		
		if (!$this->district_model->findname($data['dist'])):
		$dist['name'] = $data['dist'];
		$this->district_model->add($dist);
		endif;	
		
		if (!$this->state_model->findname($data['state'])):
		$state['name'] = $data['state'];
		$this->state_model->add($state);
		endif;	
		
		if (!$this->country_model->findname($data['country'])):
		$country['name'] = $data['country'];
		$this->country_model->add($country);
		endif;	
		
		
		
		
		
		//add to mlist
		unset($data['panno']);
		$this->mlist_model->add($data);
		//print_r($data);
		echo "Data added successfully";
		$this->load->view('templates/footer');
		endif;
			
		}
		
		
		public function idcheck($str){
			if ($this->input->post('panno')=='' and $this->input->post('id_name')==''):
				$this->form_validation->set_message('idcheck', 'Please select an ID');
				return false;
			elseif ($this->input->post('panno')=='' and $this->input->post('id_name')!=='' and $this->		input->post('id_name')!=='NOT AVAILABLE' and $str==''):
				$this->form_validation->set_message('idcheck', 'Please enter ID No');
				return false;
			elseif ($this->input->post('panno')=='' and $this->input->post('id_name')=='NOT AVAILABLE' and $str!==''):
				$this->form_validation->set_message('idcheck', 'You cannot have ID No for Not available ID Type');
				return false;
			endif;
		
		
		
		
		}
}
?>
